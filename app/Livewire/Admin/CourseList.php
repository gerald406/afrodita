<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseList extends Component
{
    use WithPagination;

    // Vinculado al input de búsqueda en la vista
    public $search = '';

    // Resetear paginación al buscar para no quedar en la página 2 de un resultado vacío
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $courses = Course::where('title', 'like', '%' . $this->search . '%')
            ->orWhereHas('teacher', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.course-list', compact('courses'));
    }
}
