<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'progress_percent',
        'enrolled_at',
        'price_paid' // Agregado para prevenir mass assignment vulnerability
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
    ];

    // --- RELACIONES QUE FALTABAN ---

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
