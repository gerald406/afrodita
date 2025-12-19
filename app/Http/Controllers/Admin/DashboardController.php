<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\LoginActivity;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. TARJETAS SUPERIORES (KPIs)
        $stats = [
            'total_students'    => User::where('role', 'student')->count(),
            'total_instructors' => User::where('role', 'instructor')->count(),
            'total_courses'     => Course::count(),
            'published_courses' => Course::where('status', 'published')->count(),
            'pending_courses'   => Course::where('status', 'draft')->count(),
            // Ingresos totales (simulado, si tuvieras tabla orders)
            'total_revenue'     => 0,
        ];

        // 2. DATOS PARA EL GRÁFICO (Últimos 7 días)
        $chartData = $this->getChartData();
        // 3. ÚLTIMOS USUARIOS (Tabla inferior)
        // Usamos LoginActivity para ver quién entró realmente
        $latestLogins = LoginActivity::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'chartData', 'latestLogins'));
    }

    private function getChartData()
    {
        $dates = [];
        $registrations = [];
        $logins = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $formattedDate = $date->format('Y-m-d');

            // Labels para el eje X (Ej: "Lun 12")
            $dates[] = ucfirst($date->translatedFormat('D d'));

            // Datos
            $registrations[] = User::whereDate('created_at', $formattedDate)->count();
            $logins[] = LoginActivity::whereDate('created_at', $formattedDate)->count();
        }

        return [
            'labels' => $dates,
            'registrations' => $registrations,
            'logins' => $logins
        ];
    }
}
