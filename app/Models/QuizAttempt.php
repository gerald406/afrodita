<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'started_at',
        'completed_at',
        'score_obtained',
        'is_passed',
        'status',
        'current_question_index'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'is_passed' => 'boolean',
    ];

    // --- RELACIONES ---

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Respuestas detalladas de este intento
    public function answers()
    {
        return $this->hasMany(QuizAttemptAnswer::class);
    }
}
