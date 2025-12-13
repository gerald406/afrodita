<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'price_paid',
        'status',
        'progress_percent',
        'enrolled_at'
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
