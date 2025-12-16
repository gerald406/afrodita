<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{

    protected $fillable = [
        // ...
        'total_points',
    ];

    // Relación con el historial
    public function pointLogs()
    {
        return $this->hasMany(UserPointLog::class);
    }

    // Método para otorgar puntos (lo usaremos cuando el estudiante termine una lección)
    public function awardPoints($amount, $type, $referenceId = null)
    {
        // Crear registro en historial
        $this->pointLogs()->create([
            'points' => $amount,
            'event_type' => $type,
            'reference_id' => $referenceId
        ]);

        // Actualizar total (increment)
        $this->increment('total_points', $amount);
    }
}
