<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        // Campos existentes (si tienes nombre del sitio, logo, etc.)
        'site_name',
        'site_logo',

        // --- CAMPOS NUEVOS PARA MODO NETFLIX (Gratuito) ---
        'free_mode_active',
        'free_mode_start',
        'free_mode_end',
        'free_mode_message',
    ];

    /**
     * Casteos para manejar tipos de datos automáticamente.
     * Esto permite usar $setting->free_mode_start->isPast(), por ejemplo.
     */
    protected $casts = [
        'free_mode_active' => 'boolean',
        'free_mode_start' => 'datetime',
        'free_mode_end' => 'datetime',
    ];

    /**
     * Helper para verificar si el modo gratuito está activo AHORA MISMO.
     * Retorna true si el switch está ON y la fecha actual está dentro del rango.
     */
    public function isFreeModeCurrentlyActive(): bool
    {
        if (!$this->free_mode_active) {
            return false;
        }

        $now = now();

        // Si no hay fechas definidas, pero está activo, asumimos que es indefinido (siempre activo)
        if (!$this->free_mode_start && !$this->free_mode_end) {
            return true;
        }

        // Verificar rango de fechas
        return $now->between($this->free_mode_start, $this->free_mode_end);
    }
}
