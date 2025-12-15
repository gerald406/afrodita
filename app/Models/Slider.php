<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'image_path',
        'title',
        'subtitle',
        'link_url',
        'sort_order',
        'is_active'
    ];
}
