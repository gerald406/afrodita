<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        // Buscamos usuarios que tengan rol 'instructor' o 'teacher' (ajusta según tu BD)
        // También cargamos el conteo de cursos para mostrar "X Cursos creados"
        $teachers = User::whereIn('role', ['instructor', 'teacher', 'admin'])
            ->withCount('courses') // Asegúrate de tener la relación en el modelo User
            ->latest()
            ->paginate(12);

        return view('web.teachers.index', compact('teachers'));
    }
}
