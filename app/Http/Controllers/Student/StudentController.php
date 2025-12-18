<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Muestra la lista de cursos del estudiante.
     * El error pedía el método 'index', así que lo renombramos de 'myCourses' a 'index'.
     */
    public function index()
    {
        // Obtener las matrículas del usuario logueado
        $enrollments = Auth::user()->enrollments()
            ->where('status', 'active') // Solo cursos activos/pagados
            ->with(['course.teacher', 'course.sections.lessons']) // Carga profunda
            ->latest()
            ->paginate(9);

        return view('student.my-courses', compact('enrollments'));
    }
}
