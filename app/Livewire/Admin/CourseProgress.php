<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseProgress extends Component
{
    use WithPagination;

    public $courseId;       // ID del curso seleccionado
    public $search = '';    // Buscador de alumnos

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingCourseId()
    {
        $this->resetPage();
    }

    public function render()
    {
        // 1. Cargar todos los cursos para el Select
        $courses = Course::orderBy('title')->get(['id', 'title']);

        $students = [];

        // 2. Si hay un curso seleccionado, cargar sus estudiantes
        if ($this->courseId) {
            $selectedCourse = Course::find($this->courseId);

            if ($selectedCourse) {
                // Obtenemos los estudiantes matriculados (status active o completed)
                $query = $selectedCourse->students()
                    ->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    });

                $students = $query->paginate(10);

                // Optimizacion: Pre-cargar las lecciones completadas para evitar N+1 queries
                // Nota: Esto es avanzado, por ahora usaremos el método del modelo user->courseProgress()
                // que aunque hace consultas extra, es más legible para esta etapa.
            }
        }

        return view('livewire.admin.course-progress', compact('courses', 'students'));
    }
}
