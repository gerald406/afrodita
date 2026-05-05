<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'content',
        'type',
        'points',
        'feedback',
        'sort_order',
        'question_image', // ← FIX CRÍTICO: faltaba este campo
    ];

    // --- RELACIONES ---

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class)
            ->orderBy('sort_order'); // orden garantizado
    }
}
