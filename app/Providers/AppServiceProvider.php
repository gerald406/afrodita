<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;    // Necesario para compartir variables
use Illuminate\Support\Facades\Cache;   // Necesario para rendimiento
use Illuminate\Support\Facades\Schema;  // Necesario para evitar errores de longitud en BD

// --- IMPORTACIONES PARA EL LOGIN TRACKING ---
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Listeners\LogUserLogin;

use App\Models\GeneralSetting;          // Tu modelo de configuración

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Configuración de longitud de strings
        Schema::defaultStringLength(191);

        // 2. --- REGISTRAR EL LISTENER DE LOGIN --- (NUEVO)
        // Esto conecta el evento de Login de Laravel con tu listener personalizado
        Event::listen(
            Login::class,
            LogUserLogin::class
        );

        // 3. COMPARTIR VARIABLE GLOBAL $web_settings
        try {
            View::composer('*', function ($view) {
                // Usamos Cache para no consultar la base de datos en cada recarga
                $settings = Cache::remember('web_settings', 3600, function () {
                    return GeneralSetting::first() ?? new GeneralSetting();
                });

                // Inyectamos la variable $web_settings en la vista
                $view->with('web_settings', $settings);
            });
        } catch (\Exception $e) {
            // Si ocurre un error (ej. tabla no existe), no hacemos nada
        }
    }
}
