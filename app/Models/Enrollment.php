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
}
