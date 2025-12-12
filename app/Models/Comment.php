<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'lesson_id', 'parent_id', 'body'];

    // --- Relaciones ---

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // Relación recursiva: El comentario padre
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relación recursiva: Las respuestas (hijos)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'asc');
    }
}
