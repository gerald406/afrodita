<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'image_path',
        'price',
        'compare_price',
        'status'
    ];

    // Para usar el slug en las rutas en lugar del ID
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // --- Relaciones ---

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sections()
    {
        return $this->hasMany(CourseSection::class)->orderBy('sort_order');
    }

    // Obtener todas las lecciones a través de las secciones (muy útil para contar total de clases)
    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, CourseSection::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

    // --- Atributos Virtuales ---

    // Promedio de estrellas (ej: 4.5)
    public function getRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1) ?? 0;
    }
}
