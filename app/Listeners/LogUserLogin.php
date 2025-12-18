<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\LoginActivity;

class LogUserLogin
{
    public function handle(Login $event): void
    {
        // 1. Actualizar la "última vez visto" en la tabla users
        $event->user->forceFill([
            'last_login_at' => now(),
        ])->save();

        // 2. Guardar el historial para el gráfico
        LoginActivity::create([
            'user_id' => $event->user->id
        ]);
    }
}
