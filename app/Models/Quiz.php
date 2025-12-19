<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        // 'lesson_id',
        'title',
        'slug',
        'description',
        'duration_minutes',
        'start_time',
        'end_time',
        'passing_score',
        'max_attempts',
        'is_randomized',
        'questions_to_show',
        'status',
    ];

    // Casting de tipos para asegurar que las fechas sean objetos Carbon
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_randomized' => 'boolean',
    ];

    // --- RELACIONES ---

    // Un quiz pertenece a un curso
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Un quiz tiene muchas preguntas (Banco de preguntas)
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Un quiz tiene muchos intentos realizados por estudiantes
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
