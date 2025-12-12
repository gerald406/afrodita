<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="text-gray-500">Estudiantes</div>
                    <div class="text-2xl font-bold">{{ $stats['total_students'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="text-gray-500">Instructores</div>
                    <div class="text-2xl font-bold">{{ $stats['total_instructors'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="text-gray-500">Cursos Totales</div>
                    <div class="text-2xl font-bold">{{ $stats['total_courses'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="text-gray-500">Pendientes Revisión</div>
                    <div class="text-2xl font-bold text-orange-500">{{ $stats['pending_courses'] }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900">Bienvenido, Administrador</h3>
                <p class="mt-2 text-gray-600">
                    Desde aquí podrás gestionar cursos, usuarios y la configuración del "Día de Puertas Abiertas".
                </p>
                
                <div class="mt-6">
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Gestionar Cursos (Pronto)
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>