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
        'avatar',
        'bio',
        'legacy_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
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

    // Matrículas del estudiante
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Cursos donde está matriculado (Relación directa a través de enrollments)
    public function purchasedCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id')
            ->withPivot('status', 'price_paid', 'enrolled_at')
            ->withTimestamps();
    }

    // Relación muchos a muchos: Lecciones que el usuario ha marcado como completas
    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class)->withPivot('completed_at');
    }

    // Helper para calcular porcentaje en tiempo real
    public function courseProgress($course)
    {
        $totalLessons = $course->lessons->count();

        if ($totalLessons == 0) return 0;

        // Contamos cuántas lecciones completadas pertenecen a ESTE curso
        $completedCount = $this->completedLessons()
            ->where('course_section_id', '!=', null) // Filtro de seguridad
            ->whereHas('section', function ($q) use ($course) {
                $q->where('course_id', $course->id);
            })
            ->count();

        return round(($completedCount / $totalLessons) * 100);
    }

    // En App\Models\User.php
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id'); // Ajusta la clave foránea si es distinta
    }
}
