<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener estadísticas rápidas para los widgets del admin
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_instructors' => User::where('role', 'instructor')->count(),
            'total_courses' => Course::count(),
            'pending_courses' => Course::where('status', 'draft')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
