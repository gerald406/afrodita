<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Reporte de Calificaciones
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Examen: <span class="font-semibold text-indigo-600">{{ $quiz->title }}</span>
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                <i class="fas fa-arrow-left mr-2"></i> Volver al listado
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow px-4 py-5 sm:p-6 mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        
        <div class="relative max-w-sm w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input 
                wire:model.live="search" 
                type="text" 
                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
                placeholder="Buscar estudiante..."
            >
        </div>

        <div>
            <button 
                wire:click="exportExcel" 
                wire:loading.attr="disabled"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors"
            >
                <i wire:loading.remove wire:target="exportExcel" class="fas fa-file-excel mr-2"></i>
                
                <i wire:loading wire:target="exportExcel" class="fas fa-spinner fa-spin mr-2"></i>

                <span wire:loading.remove wire:target="exportExcel">Exportar Excel</span>
                <span wire:loading wire:target="exportExcel">Generando...</span>
            </button>
        </div>

    </div>

    <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        @if($attempts->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estudiante
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nota Obtenida
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($attempts as $attempt)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $attempt->user->profile_photo_url }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $attempt->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $attempt->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-lg font-bold text-gray-900">{{ $attempt->score_obtained }}%</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($attempt->is_passed)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Aprobado
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Reprobado
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                {{ $attempt->completed_at ? $attempt->completed_at->format('d/m/Y H:i') : 'En progreso' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6">
                {{ $attempts->links() }}
            </div>
        @else
            <div class="px-4 py-12 text-center text-gray-500">
                <i class="fas fa-clipboard-list text-4xl mb-4 text-gray-300"></i>
                <p>No hay intentos registrados para este examen aún.</p>
            </div>
        @endif
    </div>
</div>