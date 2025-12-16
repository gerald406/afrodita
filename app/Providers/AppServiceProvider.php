<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;    // Necesario para compartir variables
use Illuminate\Support\Facades\Cache;   // Necesario para rendimiento
use Illuminate\Support\Facades\Schema;  // Necesario para evitar errores de longitud en BD
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
        // 1. Configuración de longitud de strings (Previene error "key too long" en MySQL viejos)
        Schema::defaultStringLength(191);

        // 2. COMPARTIR VARIABLE GLOBAL $web_settings
        // Usamos un try-catch para evitar errores si la tabla aún no existe (ej. al migrar)
        try {
            // View::composer('*', ...) significa "en todas las vistas"
            View::composer('*', function ($view) {

                // Usamos Cache para no consultar la base de datos en cada recarga
                // 'web_settings' es la clave del caché, 3600 son segundos (1 hora)
                $settings = Cache::remember('web_settings', 3600, function () {
                    // Intentamos obtener la configuración, si no existe, creamos un objeto vacío
                    return GeneralSetting::first() ?? new GeneralSetting();
                });

                // Inyectamos la variable $web_settings en la vista
                $view->with('web_settings', $settings);
            });
        } catch (\Exception $e) {
            // Si ocurre un error (ej. tabla no existe), no hacemos nada para permitir migraciones
        }
    }
}
