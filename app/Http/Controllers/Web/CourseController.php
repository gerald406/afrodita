<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Muestra el catálogo de cursos (index).
     */
    public function index()
    {
        // Solo retornamos la vista contenedora. Livewire se encarga del resto.
        return view('web.courses.index');
    }

    /**
     * Muestra el detalle de un curso específico (show).
     */
    public function show(Course $course)
    {
        // 1. Cargar relaciones necesarias para la vista (Secciones, Lecciones, Profesor, Reseñas)
        $course->load([
            'teacher',
            'sections.lessons', // Cargar lecciones dentro de secciones
            'reviews.user'      // Cargar reseñas y sus autores
        ])->loadCount(['students', 'reviews']);

        // 2. Lógica de Matrícula (¿El usuario ya compró este curso?)
        $isEnrolled = false;
        $enrollmentStatus = null;

        if (Auth::check()) {
            // Buscamos si existe una matrícula para este usuario y curso
            $enrollment = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->first();

            if ($enrollment) {
                $isEnrolled = true;
                $enrollmentStatus = $enrollment->status; // 'pending', 'active', etc.
            }
        }

        // 3. Retornar la vista pasando todas las variables
        return view('web.courses.show', compact('course', 'isEnrolled', 'enrollmentStatus'));
    }
}
