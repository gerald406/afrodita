<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonResource extends Model
{
    protected $fillable = ['lesson_id', 'title', 'type', 'path_or_url'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
