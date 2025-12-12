<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        
        <div class="relative w-full sm:w-96">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input wire:model.live.debounce.300ms="search" 
                    type="text" 
                    class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                    placeholder="Buscar por título o profesor...">
        </div>

        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none transition-colors">
            <i class="fas fa-plus mr-2"></i> Nuevo Curso
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider text-left">
                    <tr>
                        <th scope="col" class="px-6 py-3">Curso</th>
                        <th scope="col" class="px-6 py-3">Precio</th>
                        <th scope="col" class="px-6 py-3">Estado</th>
                        <th scope="col" class="px-6 py-3">Alumnos</th>
                        <th scope="col" class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($courses as $course)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-16 bg-gray-100 rounded-md overflow-hidden relative">
                                        @if($course->image_path)
                                            <img class="h-12 w-16 object-cover" src="{{ $course->image_path }}" alt="">
                                        @else
                                            <div class="flex items-center justify-center h-full w-full text-gray-300">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                            {{ $course->title }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Por: {{ $course->teacher->name ?? 'Sin asignar' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-bold">
                                    {{ $course->price == 0 ? 'GRATIS' : '$' . number_format($course->price, 2) }}
                                </div>
                                @if($course->compare_price)
                                    <div class="text-xs text-gray-400 line-through">
                                        ${{ number_format($course->compare_price, 2) }}
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($course->status === 'published')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Publicado
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Borrador
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-users text-gray-300 text-xs"></i>
                                    {{ $course->students->count() }}
                                </div>
                                <div class="flex items-center gap-1 mt-1">
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    {{ $course->rating }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3" title="Editar Contenido">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button class="text-red-500 hover:text-red-700" title="Eliminar" onclick="confirm('¿Seguro?') || event.stopImmediatePropagation()">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 rounded-full p-4 mb-3">
                                        <i class="fas fa-folder-open text-gray-400 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-500 text-lg">No se encontraron cursos</p>
                                    <p class="text-gray-400 text-sm">Intenta con otra búsqueda o crea uno nuevo.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $courses->links() }} 
        </div>
    </div>
</div>