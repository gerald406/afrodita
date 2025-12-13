<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        // Listado de cursos con filtros simples
        $query = Course::where('status', 'published')
            ->with('teacher'); // Eager loading

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->get('search') . '%');
        }

        $courses = $query->latest()->paginate(12);

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        // Verificar que esté publicado (o que el usuario sea el dueño/admin)
        if ($course->status !== 'published') {
            abort_if(!auth()->check() || (auth()->id() !== $course->user_id && !auth()->user()->isAdmin()), 404);
        }

        // Cargar relaciones necesarias para la vista de detalle
        $course->load(['teacher', 'sections.lessons', 'reviews.user']);

        // Calcular si el usuario ya compró este curso
        $isEnrolled = auth()->check() ? auth()->user()->purchasedCourses->contains($course->id) : false;

        return view('courses.show', compact('course', 'isEnrolled'));
    }
}
