<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class CourseList extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('delete-confirmed')]
    public function deleteCourse($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => 'Curso eliminado',
                'text' => 'El curso ha sido eliminado correctamente'
            ]);

            $this->resetPage();
        } catch (\Exception $e) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'No se pudo eliminar el curso: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        $courses = Course::with(['teacher', 'students'])
            ->where('title', 'like', '%' . $this->search . '%')
            ->orWhereHas('teacher', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.course-list', compact('courses'));
    }
}
