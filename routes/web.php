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
    ->prefix('admin') // URL será /admin/dashboard
    ->name('admin.')  // Nombres de ruta serán admin.dashboard
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::view('/courses', 'admin.courses.index')->name('courses.index');
    });
