<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = ['site_name', 'site_logo', 'site_favicon', 'popup_active', 'popup_image', 'popup_link'];
}
