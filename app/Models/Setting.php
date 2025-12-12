<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Permitimos asignación masiva para estos campos
    protected $fillable = ['key', 'value', 'description'];

    /**
     * Helper estático para verificar si hoy es el día de puertas abiertas.
     * Uso en código: Setting::isOpenDay()
     */
    public static function isOpenDay(): bool
    {
        $freeDate = self::where('key', 'free_course_access_date')->value('value');

        // Retorna true solo si hay fecha configurada Y coincide con hoy
        return $freeDate && $freeDate === now()->toDateString();
    }
}
