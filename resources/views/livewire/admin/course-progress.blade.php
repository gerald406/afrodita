<div class="space-y-6">
    
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Seguimiento de Avance Académico</h2>
        
        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/2">
                <label class="block text-sm font-bold text-gray-700 mb-1">Seleccionar Curso</label>
                <select wire:model.live="courseId" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">-- Elige un curso para ver reporte --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            @if($courseId)
                <div class="w-full md:w-1/2">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Buscar Estudiante</label>
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Nombre o correo..." class="w-full rounded-md border-gray-300 pl-10 shadow-sm focus:border-indigo-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($courseId && isset($students))
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase">
                        <tr>
                            <th class="px-6 py-3 text-left">Estudiante</th>
                            <th class="px-6 py-3 text-left">DNI / Contacto</th>
                            <th class="px-6 py-3 text-left w-1/3">Progreso</th> <th class="px-6 py-3 text-right">Detalle</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($students as $student)
                            @php
                                // Calcular progreso usando el curso seleccionado actualmente
                                $progress = $student->courseProgress(\App\Models\Course::find($courseId));
                                
                                // Determinar color de la barra
                                $barColor = 'bg-indigo-600';
                                if($progress == 100) $barColor = 'bg-green-500';
                                elseif($progress < 20) $barColor = 'bg-red-500';
                                elseif($progress < 50) $barColor = 'bg-yellow-500';
                            @endphp
                            
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img src="{{ $student->profile_photo_url }}" class="h-10 w-10 rounded-full object-cover border">
                                        <div class="ml-3">
                                            <div class="text-sm font-bold text-gray-900">{{ $student->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $student->dni ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500">{{ $student->phone ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-full">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-xs font-medium {{ $progress == 100 ? 'text-green-700' : 'text-gray-700' }}">
                                                {{ $progress }}% Completado
                                            </span>
                                            @if($progress == 100)
                                                <i class="fas fa-medal text-yellow-500" title="Curso Completado"></i>
                                            @endif
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="{{ $barColor }} h-2.5 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <button class="text-gray-400 hover:text-indigo-600 font-medium" title="Ver detalle (Futura implementación)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-users-slash text-4xl mb-3 text-gray-300"></i>
                                    <p>No hay estudiantes matriculados en este curso que coincidan con la búsqueda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $students->links() }}
            </div>
        </div>
    @elseif(!$courseId)
        <div class="text-center py-20 bg-white rounded-lg border-2 border-dashed border-gray-300">
            <i class="fas fa-chart-pie text-gray-300 text-5xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900">Selecciona un curso</h3>
            <p class="text-gray-500">Elige un curso del listado superior para ver el rendimiento de los alumnos.</p>
        </div>
    @endif
</div>