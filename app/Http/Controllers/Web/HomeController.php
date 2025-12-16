<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Course;
use App\Models\User;
use App\Models\Lesson;

class HomeController extends Controller
{
    /**
     * Muestra la página de inicio del sitio web.
     */
    public function index()
    {
        // 1. Obtener los Sliders activos ordenados por su posición
        $sliders = Slider::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        // 2. Calcular las estadísticas para la sección de contadores
        $stats = [
            'courses'  => Course::where('status', 'published')->count(),
            'students' => User::where('role', 'student')->count(),
            'lessons'  => Lesson::count(),
            // Sumamos todos los minutos de todas las lecciones y dividimos entre 60 para horas
            'hours'    => round(Lesson::sum('duration_minutes') / 60),
        ];

        // 3. Obtener los últimos 6 cursos publicados para el grid
        $courses = Course::where('status', 'published')
            ->with('teacher') // Cargamos la relación del profesor para mostrar su foto/nombre
            ->latest()
            ->take(6)
            ->get();

        // 4. Retornar la vista 'web.home' pasando los datos
        return view('web.home', compact('sliders', 'stats', 'courses'));
    }
}
