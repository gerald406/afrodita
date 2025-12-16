<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPointLog extends Model
{
    protected $fillable = ['user_id', 'points', 'event_type', 'reference_id'];
}
