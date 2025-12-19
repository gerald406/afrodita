<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;    // Necesario para compartir variables
use Illuminate\Support\Facades\Cache;   // Necesario para rendimiento
use Illuminate\Support\Facades\Schema;  // Necesario para evitar errores de longitud en BD

use App\Models\Category;
use App\Models\WebSetting;

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

        // 2. Listener de Login
        Event::listen(
            Login::class,
            LogUserLogin::class
        );

        // 3. VARIABLES GLOBALES (Optimizadas)
        try {
            // Usamos view composer para inyectar datos en TODAS las vistas ('*')
            View::composer('*', function ($view) {

                // A. Configuración Global (Cacheado por 24h o hasta que se limpie)
                $web_settings = Cache::remember('web_settings', 86400, function () {
                    return GeneralSetting::first() ?? new GeneralSetting();
                });

                // B. Categorías Globales (Cacheado por 24h)
                // Solo traemos categorías que tengan al menos un curso
                $globalCategories = Cache::remember('global_categories', 86400, function () {
                    return Category::has('courses')->get();
                });

                // Inyectamos ambas variables de forma consistente
                $view->with('web_settings', $web_settings)
                    ->with('globalCategories', $globalCategories);
            });
        } catch (\Exception $e) {
            // Evita errores si se ejecuta antes de correr migraciones
        }
    }
}
