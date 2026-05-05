<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer_text',
        'is_correct',
        'sort_order',
        'answer_image', // ← FIX CRÍTICO: faltaba este campo
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    // --- RELACIONES ---

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
