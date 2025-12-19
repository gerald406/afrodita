<?php

use Illuminate\Support\Facades\Route;

// --- CONTROLADORES WEB (Públicos) ---
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CourseController;
use App\Http\Controllers\Web\EnrollmentController;

// --- CONTROLADORES ESTUDIANTE ---
use App\Http\Controllers\Student\StudentController;
use App\Livewire\Student\CourseLearn; // Componente Livewire del Aula

// --- CONTROLADORES ADMIN ---
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;

use App\Http\Controllers\Web\TeacherController;
use App\Livewire\Admin\CategoryManager;

use App\Livewire\Admin\QuizList;
use App\Livewire\Admin\QuizForm;
use App\Livewire\Admin\QuizBuilder;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (Frontend)
|--------------------------------------------------------------------------
*/

// Página de Inicio (Home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catálogo de Cursos (Listado y Detalle)
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/course/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');

/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN Y REGISTRO (Jetstream/Fortify las maneja)
|--------------------------------------------------------------------------
*/
// Estas rutas (login, register, logout) ya vienen configuradas por Jetstream.

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (Usuarios Logueados)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // --- PROCESO DE MATRÍCULA (Botón "Comprar/Inscribirse") ---
    Route::post('/enroll/{course}', [EnrollmentController::class, 'store'])->name('enrollments.store');

    // --- ÁREA DE ESTUDIANTE (Solo rol: student) ---
    Route::middleware(['role:student'])->prefix('student')->name('student.')->group(function () {

        // Panel "Mis Cursos"
        Route::get('/my-courses', [StudentController::class, 'index'])->name('my-courses');

        // Aula Virtual (Reproductor de Video) - Full Page Livewire
        Route::get('/course/{course:slug}/learn/{lesson?}', CourseLearn::class)->name('course.learn');
    });

    // --- ÁREA DE ADMINISTRADOR (Solo rol: admin) ---
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard Principal
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Gestión de Contenido
        Route::view('/courses', 'admin.courses.index')->name('courses.index');
        Route::get('/courses/create', function () {
            return view('admin.courses.create');
        })->name('courses.create');
        Route::get('/courses/{course:slug}/edit', function (App\Models\Course $course) {
            return view('admin.courses.edit', compact('course'));
        })->name('courses.edit');

        // Gestión de Usuarios
        Route::view('/users', 'admin.users.index')->name('users.index');
        Route::get('/users/create', function () {
            return view('admin.users.create');
        })->name('users.create');
        Route::get('/users/{user}/edit', function (App\Models\User $user) {
            return view('admin.users.edit', compact('user'));
        })->name('users.edit');

        // Gestión Académica
        Route::view('/enrollments', 'admin.enrollments.index')->name('enrollments.index'); // Matrículas
        Route::view('/progress', 'admin.progress.index')->name('progress.index'); // Reporte Progreso

        // Gestión del Sistema Web
        Route::view('/settings', 'admin.settings.index')->name('settings.index');
        Route::view('/sliders', 'admin.sliders.index')->name('sliders.index');
        Route::view('/reviews', 'admin.reviews.index')->name('reviews.index');

        // Reportes Excel
        Route::get('/reports/students', [ReportController::class, 'downloadStudents'])->name('reports.students');
        Route::get('/reports/course/{course}', [ReportController::class, 'downloadCourseStudents'])->name('reports.course');

        Route::get('/categories', CategoryManager::class)->name('categories.index');
    });
});

// Redirección por defecto del Dashboard de Jetstream
// Si entran a /dashboard, los redirigimos según su rol
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('student.my-courses');
    }
})->middleware(['auth', 'verified'])->name('dashboard');
