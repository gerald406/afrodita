<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'dni',
        'phone',
        'avatar', // Si usas Jetstream, este campo podría ser redundante con profile_photo_path, pero lo dejamos si lo usas para otra cosa.
        'bio',
        'legacy_id',
        'total_points', // [NECESARIO] Para mostrar los puntos en el header del Aula
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'total_points' => 'integer', // [RECOMENDADO] Castear a entero
    ];

    // --- Helpers de Roles ---
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isInstructor(): bool
    {
        return $this->role === 'instructor' || $this->role === 'admin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    // --- Relaciones ---

    // Cursos que enseña (si es profesor)
    public function coursesTeaching()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    // [NOTA] Esta función es duplicada de coursesTeaching. 
    // Se recomienda usar solo una, pero la dejo por si la usas en otra parte.
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    // Matrículas del estudiante
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Cursos donde está matriculado (Relación directa a través de enrollments)
    public function purchasedCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id')
            ->withPivot('status', 'proof_payment', 'enrolled_at') // Agregué proof_payment por si acaso
            ->withTimestamps();
    }

    // [ACTUALIZADO] Relación muchos a muchos: Lecciones completadas
    // Especificamos la tabla 'lesson_user' para evitar ambigüedades
    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user')
            ->withPivot('completed_at');
    }

    // [NUEVO] Relación con el Historial de Puntos
    // Necesaria para el sistema de gamificación en el Aula Virtual
    public function pointLogs()
    {
        return $this->hasMany(UserPointLog::class);
    }

    // --- Helpers de Progreso ---

    /**
     * Calcula el porcentaje de avance de un curso específico para este usuario.
     * Optimizado para usar la colección de lecciones del curso.
     */
    public function courseProgress(Course $course)
    {
        // 1. Obtener IDs de todas las lecciones del curso (a través de secciones)
        $courseLessonIds = $course->lessons->pluck('id');
        // Nota: Asegúrate que Course tenga la relación hasManyThrough 'lessons' definida.

        $totalLessons = $courseLessonIds->count();

        if ($totalLessons == 0) return 0;

        // 2. Contar cuántas de esas lecciones están en la lista de completadas del usuario
        // Usamos whereIn para filtrar solo las lecciones que pertenecen a ESTE curso
        $completedCount = $this->completedLessons()
            ->whereIn('lesson_id', $courseLessonIds)
            ->count();

        return round(($completedCount / $totalLessons) * 100);
    }
}
