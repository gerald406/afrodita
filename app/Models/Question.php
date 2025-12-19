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
        'sort_order'
    ];

    // --- RELACIONES ---

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Una pregunta tiene múltiples opciones de respuesta
    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }
}
