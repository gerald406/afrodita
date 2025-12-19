<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Quiz;

class QuizList extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::find($id);
        if ($quiz) {
            $quiz->delete();
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => 'Examen eliminado correctamente'
            ]);
        }
    }

    public function render()
    {
        $quizzes = Quiz::with('course')
            ->where('title', 'like', '%' . $this->search . '%')
            ->orWhereHas('course', function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.quiz-list', compact('quizzes'))
            ->layout('layouts.app');
    }
}
