<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuizBuilder extends Component
{
    use WithFileUploads;

    public $quiz;

    // Formulario
    public $question_id = null;
    public $content;
    public $points = 1;
    public $type = 'single_choice';

    // Imágenes
    public $question_image = null;
    public $temporary_question_image = null;

    public $answers = [];
    public $isModalOpen = false;

    /**
     * Validación dinámica según contexto
     */
    protected function rules()
    {
        $hasQuestionImage = !empty($this->temporary_question_image)
            || !empty($this->question_image);

        $rules = [
            'points'                    => 'required|integer|min:1',
            'type'                      => 'required|in:single_choice,multiple_choice,true_false',
            'temporary_question_image'  => 'nullable|image|max:2048',
            // Si hay imagen, el texto es opcional
            'content' => $hasQuestionImage
                ? 'nullable|string'
                : 'required|string|min:3',
        ];

        foreach ($this->answers as $index => $answer) {
            $hasAnswerImage = !empty($answer['image']) || !empty($answer['image_url']);

            if ($this->type === 'true_false') {
                $rules["answers.{$index}.answer_text"] = 'nullable|string';
            } else {
                // Si hay imagen en la respuesta, el texto es opcional
                $rules["answers.{$index}.answer_text"] = $hasAnswerImage
                    ? 'nullable|string'
                    : 'required|string';
            }

            $rules["answers.{$index}.is_correct"] = 'boolean';
            $rules["answers.{$index}.image"]      = 'nullable|image|max:1024';
        }

        return $rules;
    }

    protected function messages()
    {
        $messages = [
            'content.required' => 'Debes ingresar un texto o subir una imagen para el enunciado.',
        ];

        foreach ($this->answers as $index => $answer) {
            $messages["answers.{$index}.answer_text.required"] =
                'Debes escribir una opción o subir una imagen.';
        }

        return $messages;
    }

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset([
            'question_id',
            'content',
            'points',
            'type',
            'question_image',
            'temporary_question_image',
        ]);
        $this->points  = 1;
        $this->type    = 'single_choice';
        $this->answers = [
            ['answer_text' => '', 'is_correct' => false, 'image_url' => null, 'image' => null],
            ['answer_text' => '', 'is_correct' => false, 'image_url' => null, 'image' => null],
        ];
    }

    public function createQuestion()
    {
        $this->resetInput();
        $this->isModalOpen = true;
    }

    public function updatedType($value)
    {
        if ($value === 'true_false') {
            $this->answers = [
                ['answer_text' => 'Verdadero', 'is_correct' => true,  'image_url' => null, 'image' => null],
                ['answer_text' => 'Falso',     'is_correct' => false, 'image_url' => null, 'image' => null],
            ];
        } elseif (count($this->answers) < 2) {
            $this->resetInput();
        }
    }

    public function removeQuestionImage()
    {
        $this->temporary_question_image = null;
        $this->question_image = null;
    }

    public function removeAnswerImage($index)
    {
        $this->answers[$index]['image']     = null;
        $this->answers[$index]['image_url'] = null;
    }

    public function addAnswer()
    {
        if ($this->type !== 'true_false') {
            $this->answers[] = [
                'answer_text' => '',
                'is_correct'  => false,
                'image_url'   => null,
                'image'       => null,
            ];
        }
    }

    public function removeAnswer($index)
    {
        if ($this->type !== 'true_false' && count($this->answers) > 2) {
            unset($this->answers[$index]);
            $this->answers = array_values($this->answers);
        }
    }

    public function editQuestion($id)
    {
        $this->resetInput();
        $question = Question::with('answers')->findOrFail($id);

        $this->question_id    = $question->id;
        $this->content        = $question->content;
        $this->points         = $question->points;
        $this->type           = $question->type;
        $this->question_image = $question->question_image;

        $this->answers = $question->answers->map(fn($a) => [
            'id'          => $a->id,
            'answer_text' => $a->answer_text,
            'is_correct'  => (bool) $a->is_correct,
            'image_url'   => $a->answer_image, // ruta guardada en BD
            'image'       => null,             // archivo temporal (vacío al editar)
        ])->toArray();

        $this->isModalOpen = true;
    }

    public function saveQuestion()
    {
        $this->validate();

        if (!collect($this->answers)->contains('is_correct', true)) {
            $this->addError('answers_general', 'Debes marcar al menos una respuesta como correcta.');
            return;
        }

        DB::transaction(function () {

            $questionImagePath = $this->question_image;


            if ($this->temporary_question_image) {
                try {
                    if ($questionImagePath) {
                        Storage::disk('public')->delete($questionImagePath);
                    }

                    $questionImagePath = $this->temporary_question_image
                        ->store('quizzes/questions', 'public');
                } catch (\Exception $e) {
                    \Log::error('=== store() FALLÓ ===', [
                        'error'   => $e->getMessage(),
                        'archivo' => $e->getFile(),
                        'linea'   => $e->getLine(),
                    ]);
                    throw $e; // Re-lanzar para rollback
                }
            }

            $contentToSave = ($this->content !== '' && $this->content !== null)
                ? $this->content
                : null;

            if ($this->question_id) {
                $question = Question::findOrFail($this->question_id);
                $question->update([
                    'content'        => $contentToSave,
                    'points'         => $this->points,
                    'type'           => $this->type,
                    'question_image' => $questionImagePath,
                ]);
            } else {
                $question = Question::create([
                    'quiz_id'        => $this->quiz->id,
                    'content'        => $contentToSave,
                    'points'         => $this->points,
                    'type'           => $this->type,
                    'question_image' => $questionImagePath,
                ]);
            }

            $keepIds = [];
            foreach ($this->answers as $index => $ansData) {
                $ansImagePath = $ansData['image_url'] ?? null;

                if (!empty($ansData['image'])) {
                    if ($ansImagePath) {
                        Storage::disk('public')->delete($ansImagePath);
                    }
                    $ansImagePath = $ansData['image']->store('quizzes/answers', 'public');
                }

                $answerText = ($ansData['answer_text'] !== '' && $ansData['answer_text'] !== null)
                    ? $ansData['answer_text']
                    : null;

                if (!empty($ansData['id'])) {
                    $answer = QuestionAnswer::findOrFail($ansData['id']);
                    $answer->update([
                        'answer_text'  => $answerText,
                        'is_correct'   => $ansData['is_correct'],
                        'answer_image' => $ansImagePath,
                        'sort_order'   => $index,
                    ]);
                } else {
                    $answer = $question->answers()->create([
                        'answer_text'  => $answerText,
                        'is_correct'   => $ansData['is_correct'],
                        'answer_image' => $ansImagePath,
                        'sort_order'   => $index,
                    ]);
                }

                $keepIds[] = $answer->id;
            }

            $question->answers()
                ->whereNotIn('id', $keepIds)
                ->each(function ($ans) {
                    if ($ans->answer_image) {
                        Storage::disk('public')->delete($ans->answer_image);
                    }
                    $ans->delete();
                });
        });

        $this->isModalOpen = false;
        $this->quiz->refresh();
        $this->dispatch('swal:toast', [
            'type'  => 'success',
            'title' => 'Pregunta guardada correctamente',
        ]);
    }

    public function deleteQuestion($id)
    {
        $question = Question::with('answers')->findOrFail($id);

        // Eliminar imagen del enunciado del disco
        if ($question->question_image) {
            Storage::disk('public')->delete($question->question_image);
        }

        // Eliminar imágenes de cada respuesta del disco
        foreach ($question->answers as $answer) {
            if ($answer->answer_image) {
                Storage::disk('public')->delete($answer->answer_image);
            }
        }

        $question->delete();
        $this->quiz->refresh();

        $this->dispatch('swal:toast', [
            'type'  => 'info',
            'title' => 'Pregunta eliminada',
        ]);
    }

    public function render()
    {
        // Eager load para evitar N+1 queries
        $this->quiz->loadMissing('questions.answers');

        return view('livewire.admin.quiz-builder')->layout('layouts.app');
    }
}
