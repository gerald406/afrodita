<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Support\Str;

class QuizForm extends Component
{
    public $quiz;
    public $courses;

    // Campos del formulario
    public $course_id, $title, $slug, $description, $duration_minutes, $passing_score, $max_attempts, $status;

    protected $rules = [
        'course_id' => 'required|exists:courses,id',
        'title' => 'required|string|min:3',
        'slug' => 'required|string|unique:quizzes,slug',
        'duration_minutes' => 'required|integer|min:1',
        'passing_score' => 'required|integer|min:1|max:100',
        'max_attempts' => 'required|integer|min:1',
        'status' => 'required|in:draft,published',
    ];

    public function mount(Quiz $quiz = null)
    {
        $this->courses = Course::all(); // En producción usar select(['id','title'])

        if ($quiz && $quiz->exists) {
            $this->quiz = $quiz;
            $this->course_id = $quiz->course_id;
            $this->title = $quiz->title;
            $this->slug = $quiz->slug;
            $this->description = $quiz->description;
            $this->duration_minutes = $quiz->duration_minutes;
            $this->passing_score = $quiz->passing_score;
            $this->max_attempts = $quiz->max_attempts;
            $this->status = $quiz->status;

            // Ignorar el slug actual en la validación unique
            $this->rules['slug'] = 'required|string|unique:quizzes,slug,' . $quiz->id;
        } else {
            // Valores por defecto
            $this->duration_minutes = 60;
            $this->passing_score = 70;
            $this->max_attempts = 3;
            $this->status = 'draft';
        }
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'course_id' => $this->course_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'duration_minutes' => $this->duration_minutes,
            'passing_score' => $this->passing_score,
            'max_attempts' => $this->max_attempts,
            'status' => $this->status,
        ];

        if ($this->quiz && $this->quiz->exists) {
            $this->quiz->update($data);
            $message = 'Examen actualizado correctamente.';
            $route = 'admin.quizzes.index';
        } else {
            $quiz = Quiz::create($data);
            $message = 'Examen creado. Ahora agrega las preguntas.';
            // Redirigir al constructor de preguntas al crear
            return redirect()->route('admin.quizzes.builder', $quiz);
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => $message]);
        return redirect()->route('admin.quizzes.index');
    }

    public function render()
    {
        return view('livewire.admin.quiz-form')->layout('layouts.app');
    }
}
