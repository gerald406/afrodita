<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Quiz;
use App\Models\QuizAttempt;

class QuizGrades extends Component
{
    use WithPagination;

    public Quiz $quiz;
    public $search = '';

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\QuizGradesExport($this->quiz->id), 
            'notas-' . $this->quiz->slug . '.xlsx'
        );
    }

    public function render()
    {
        // Consultamos los intentos relacionados a este examen
        // Incluimos la relación con el usuario para mostrar sus datos
        $attempts = QuizAttempt::with('user')
            ->where('quiz_id', $this->quiz->id)
            ->when($this->search, function ($query) {
                // Buscador por nombre o email del estudiante
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->latest('completed_at') // Ordenar por los más recientes
            ->paginate(10);

        return view('livewire.admin.quiz-grades', compact('attempts'))
            ->layout('layouts.app');
    }
}