<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
            <i class="fas fa-tachometer-alt text-indigo-600"></i>
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border-l-4 border-indigo-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Estudiantes</p>
                            <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['total_students'] }}</h3>
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border-l-4 border-purple-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Instructores</p>
                            <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['total_instructors'] }}</h3>
                        </div>
                        <div class="p-3 bg-purple-50 rounded-lg text-purple-600">
                            <i class="fas fa-chalkboard-teacher text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border-l-4 border-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Cursos Publicados</p>
                            <div class="flex items-baseline gap-2 mt-1">
                                <h3 class="text-3xl font-extrabold text-gray-800">{{ $stats['published_courses'] }}</h3>
                                <span class="text-xs text-gray-400">de {{ $stats['total_courses'] }} totales</span>
                            </div>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg text-green-600">
                            <i class="fas fa-book-open text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-xl p-6 border-l-4 border-orange-500 relative">
                    @if($stats['pending_courses'] > 0)
                        <span class="absolute top-3 right-3 flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                        </span>
                    @endif
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pendientes Revisión</p>
                            <h3 class="text-3xl font-extrabold text-orange-600 mt-1">{{ $stats['pending_courses'] }}</h3>
                        </div>
                        <div class="p-3 bg-orange-50 rounded-lg text-orange-600">
                            <i class="fas fa-clipboard-check text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-white shadow-sm rounded-xl p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-800 text-lg">Actividad de la Plataforma</h3>
                        <span class="text-xs font-medium bg-gray-100 text-gray-500 px-2 py-1 rounded">Últimos 7 días</span>
                    </div>
                    <div class="relative h-72 w-full">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>

                <div class="lg:col-span-1 bg-white shadow-sm rounded-xl p-6">
                    <h3 class="font-bold text-gray-800 text-lg mb-6">Accesos Rápidos</h3>
                    
                    <div class="space-y-4">
                        <a href="{{ route('admin.courses.create') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-indigo-500 hover:bg-indigo-50 transition group cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-bold text-gray-700">Crear Nuevo Curso</p>
                                <p class="text-xs text-gray-500">Agregar contenido al catálogo</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition group cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-bold text-gray-700">Gestionar Usuarios</p>
                                <p class="text-xs text-gray-500">Ver estudiantes y docentes</p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition group cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-bold text-gray-700">Configuración Global</p>
                                <p class="text-xs text-gray-500">Ajustes del sitio web</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Últimos Accesos al Sistema</h3>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Ver reporte completo &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Usuario</th>
                                <th class="px-6 py-3">Rol</th>
                                <th class="px-6 py-3">Fecha y Hora</th>
                                <th class="px-6 py-3">IP</th>
                                <th class="px-6 py-3">Navegador</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestLogins as $login)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 flex items-center gap-3">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ $login->user->profile_photo_url }}" alt="{{ $login->user->name }}" />
                                        {{ $login->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $login->user->role === 'admin' ? 'bg-red-100 text-red-800' : 
                                               ($login->user->role === 'instructor' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800') }}">
                                            {{ ucfirst($login->user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $login->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 text-xs font-mono">
                                        {{ $login->ip_address }}
                                    </td>
                                    <td class="px-6 py-4 text-xs truncate max-w-xs" title="{{ $login->user_agent }}">
                                        {{ Str::limit($login->user_agent, 30) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-400 italic">
                                        No hay registros de actividad reciente.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('activityChart');

            if (!ctx) {
                console.error("Error: No se encontró el canvas del gráfico.");
                return;
            }

            // Recuperar datos pasados desde el controlador
            // Al quitar array_values(), evitamos el error de sintaxis de Blade
            const labels = @json($chartData['labels']);
            const registrationsData = @json($chartData['registrations']);
            const loginsData = @json($chartData['logins']);

            console.log("Gráfico inicializado con:", { labels, registrationsData, loginsData });

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Nuevos Registros',
                            data: registrationsData,
                            borderColor: '#10B981', // Verde
                            backgroundColor: '#10B981',
                            borderWidth: 2,
                            tension: 0.4,
                            borderDash: [5, 5],
                            pointRadius: 4,
                            pointHoverRadius: 6
                        },
                        {
                            label: 'Inicios de Sesión',
                            data: loginsData,
                            borderColor: '#4F46E5', // Indigo
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true,
                            pointRadius: 3,
                            pointHoverRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'end',
                            labels: { usePointStyle: true, boxWidth: 8 }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f3f4f6', borderDash: [2, 2] },
                            ticks: { precision: 0 }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>