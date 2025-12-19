<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Course;
use App\Models\User;
use App\Models\Lesson;
// use App\Models\Category; // Ya no es necesario instanciarlo aquí para la vista

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Sliders
        $sliders = Slider::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        // 2. Query de Cursos
        $courseQuery = Course::where('status', 'published')
            ->with(['teacher', 'category']);

        // Filtro por categoría
        if ($request->has('category') && $request->category != null) {
            $courseQuery->where('category_id', $request->category);
        }

        $courses = $courseQuery->latest()->paginate(12)->withQueryString();

        // 3. Stats (Opcional)
        $stats = [
            'courses'  => Course::where('status', 'published')->count(),
            'students' => User::where('role', 'student')->count(),
        ];

        // NOTA: Ya no pasamos 'categories' en el compact porque usamos $globalCategories
        return view('web.home', compact('sliders', 'courses', 'stats'));
    }
}
