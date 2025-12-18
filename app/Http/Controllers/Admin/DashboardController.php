<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\LoginActivity; // [IMPORTANTE] Importar el modelo de actividad
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Estadísticas Generales (Tarjetas Superiores)
        $stats = [
            'total_students'    => User::where('role', 'student')->count(),
            'total_instructors' => User::where('role', 'instructor')->count(),
            'total_courses'     => Course::count(),
            // Cursos en borrador o pendientes de aprobación
            'pending_courses'   => Course::where('status', 'draft')->count(),
        ];

        // 2. Gráfico: Últimos 7 días (Logins vs Registros)
        $chartData = $this->getChartData();

        // 3. Usuarios Recientes 
        // Ordenados por la fecha de último login (que configuramos en el modelo User)
        $latestUsers = User::orderByDesc('last_login_at')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'chartData', 'latestUsers'));
    }

    private function getChartData()
    {
        $dates = collect();
        $registrations = collect(); // Nuevos usuarios registrados
        $logins = collect();        // Inicios de sesión (Actividad)

        // Recorrer los últimos 7 días
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $formattedDate = $date->format('Y-m-d');
            $displayDate = $date->format('d/m'); // Ejemplo: 18/12

            // A. Contar usuarios registrados ese día
            $registrationsCount = User::whereDate('created_at', $formattedDate)->count();

            // B. Contar ingresos (logins) ese día usando la tabla LoginActivity
            $loginsCount = LoginActivity::whereDate('created_at', $formattedDate)->count();

            // Agregar a las colecciones
            $dates->push($displayDate);
            $registrations->push($registrationsCount);
            $logins->push($loginsCount);
        }

        // Retornamos los datos con las claves exactas que espera el Javascript de la vista
        return [
            'labels' => $dates,
            'registrations' => $registrations, // Línea punteada verde en el gráfico
            'logins' => $logins                // Línea azul rellena en el gráfico
        ];
    }
}
