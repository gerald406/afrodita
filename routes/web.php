<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

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

    // Alternativa: Si prefieres usar ID en lugar de slug, usa esta ruta:
    // Route::get('/courses/{course}/edit', function (App\Models\Course $course) {
    //     return view('admin.courses.edit', compact('course'));
    // })->name('courses.edit');
});
