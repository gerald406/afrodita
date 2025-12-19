<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_section_id',
        'title',
        'slug',
        'type',
        'video_url',
        'video_iframe',
        'content',
        'duration_minutes',
        'is_free',
        'sort_order'
    ];

    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'course_section_id');
    }

    // Materiales adjuntos (PDFs)
    public function resources()
    {
        return $this->hasMany(LessonResource::class);
    }

    // Foro de dudas de la lección
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }

    public function usersCompleted()
    {
        return $this->belongsToMany(User::class, 'lesson_user')->withPivot('completed_at');
    }

    public function users()
    {
        // Relación con la tabla pivote 'lesson_user' que creamos
        return $this->belongsToMany(User::class)->withPivot('completed_at');
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }
}
