<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Support\Facades\DB;

class QuizBuilder extends Component
{
    public $quiz;

    // Variables para el formulario de Nueva/Editar Pregunta
    public $question_id = null; // Si tiene valor, estamos editando
    public $content;
    public $points = 1;
    public $type = 'single_choice'; // single_choice, multiple_choice, true_false
    public $answers = []; // Array dinámico para las respuestas

    // Control de UI
    public $isModalOpen = false;

    protected $rules = [
        'content' => 'required|min:3',
        'points' => 'required|integer|min:1',
        'answers' => 'required|array|min:2',
        'answers.*.answer_text' => 'required|string',
        'answers.*.is_correct' => 'boolean',
    ];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->question_id = null;
        $this->content = '';
        $this->points = 1;
        $this->type = 'single_choice';
        // Inicializamos con 2 respuestas vacías por defecto
        $this->answers = [
            ['answer_text' => '', 'is_correct' => false],
            ['answer_text' => '', 'is_correct' => false],
        ];
    }

    // --- LÓGICA DE RESPUESTAS DINÁMICAS ---

    public function addAnswer()
    {
        $this->answers[] = ['answer_text' => '', 'is_correct' => false];
    }

    public function removeAnswer($index)
    {
        // Evitar dejar menos de 2 opciones
        if (count($this->answers) > 2) {
            unset($this->answers[$index]);
            $this->answers = array_values($this->answers); // Reindexar
        }
    }

    // --- CRUD PREGUNTAS ---

    public function createQuestion()
    {
        $this->resetInput();
        $this->isModalOpen = true;
    }

    public function editQuestion($id)
    {
        $question = Question::with('answers')->find($id);
        $this->question_id = $question->id;
        $this->content = $question->content;
        $this->points = $question->points;
        $this->type = $question->type;

        // Cargar respuestas existentes al array temporal
        $this->answers = $question->answers->map(function ($a) {
            return ['answer_text' => $a->answer_text, 'is_correct' => (bool)$a->is_correct];
        })->toArray();

        $this->isModalOpen = true;
    }

    public function saveQuestion()
    {
        $this->validate();

        // Validación extra: Al menos una respuesta correcta
        $hasCorrect = collect($this->answers)->contains('is_correct', true);
        if (!$hasCorrect) {
            $this->addError('answers', 'Debes marcar al menos una respuesta como correcta.');
            return;
        }

        DB::transaction(function () {
            // 1. Guardar/Actualizar Pregunta
            $question = Question::updateOrCreate(
                ['id' => $this->question_id],
                [
                    'quiz_id' => $this->quiz->id,
                    'content' => $this->content,
                    'points' => $this->points,
                    'type' => $this->type,
                ]
            );

            // 2. Sincronizar Respuestas (Estrategia: Borrar y Recrear para simplificar lógica de orden/ids)
            // En un sistema muy grande esto se optimizaría, pero para un LMS estándar es seguro.
            $question->answers()->delete();

            foreach ($this->answers as $ans) {
                $question->answers()->create([
                    'answer_text' => $ans['answer_text'],
                    'is_correct' => $ans['is_correct']
                ]);
            }
        });

        $this->isModalOpen = false;
        $this->quiz->refresh(); // Recargar relación
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Pregunta guardada']);
    }

    public function deleteQuestion($id)
    {
        Question::find($id)->delete();
        $this->quiz->refresh();
        $this->dispatch('swal:toast', ['type' => 'info', 'title' => 'Pregunta eliminada']);
    }

    public function render()
    {
        return view('livewire.admin.quiz-builder')->layout('layouts.app');
    }
}
