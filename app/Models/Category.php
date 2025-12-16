<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'color'];

    // Relación con cursos (ya la tenías, la mantenemos)
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
