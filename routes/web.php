<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;

// Página de inicio (Pública)
Route::get('/', function () {
    return view('welcome');
});

// Rutas de Usuarios Autenticados (Cualquier rol)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Panel de Estudiante (Por defecto al login)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// --- RUTAS DE ADMINISTRADOR ---
// Protegidas por 'auth' Y 'role:admin'
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Lista de cursos (con componente Livewire)
    Route::view('/courses', 'admin.courses.index')->name('courses.index');

    // Crear curso
    Route::get('/courses/create', function () {
        return view('admin.courses.create');
    })->name('courses.create');

    // Editar curso - USANDO SLUG (Recomendado para URLs amigables)
    Route::get('/courses/{course:slug}/edit', function (App\Models\Course $course) {
        return view('admin.courses.edit', compact('course'));
    })->name('courses.edit');

    // --- RUTAS DE USUARIOS ---
    Route::view('/users', 'admin.users.index')->name('users.index');

    Route::get('/users/create', function () {
        return view('admin.users.create');
    })->name('users.create');

    Route::get('/users/{user}/edit', function (App\Models\User $user) {
        return view('admin.users.edit', compact('user'));
    })->name('users.edit');
    // Gestión de Matrículas
    Route::view('/enrollments', 'admin.enrollments.index')->name('enrollments.index');
    //reportes
    Route::get('/reports/students', [ReportController::class, 'downloadStudents'])->name('reports.students');
    Route::get('/reports/course/{course}', [ReportController::class, 'downloadCourseStudents'])->name('reports.course');

    // Reporte de Progreso
    Route::view('/progress', 'admin.progress.index')->name('progress.index');

    // 1. Configuración Web (General)
    Route::view('/settings', 'admin.settings.index')->name('settings.index');

    // 2. Sliders
    Route::view('/sliders', 'admin.sliders.index')->name('sliders.index');

    // 3. Moderación (Reseñas)
    Route::view('/reviews', 'admin.reviews.index')->name('reviews.index');
});
