<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Gestión de Evaluaciones</h2>
            
            <div class="flex gap-4 w-full md:w-auto">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar examen..." class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-full md:w-64">
                
                <a href="{{ route('admin.quizzes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-plus"></i> Nuevo Examen
                </a>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Examen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso Asignado</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Preguntas</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($quizzes as $quiz)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $quiz->title }}</div>
                                    <div class="text-xs text-gray-500">{{ $quiz->duration_minutes }} min | {{ $quiz->passing_score }} pts para aprobar</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                        {{ $quiz->course->title ?? 'Sin Curso' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm text-gray-700 font-bold">{{ $quiz->questions->count() }}</span>
                                    <span class="text-xs text-gray-400 block">en banco</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $quiz->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $quiz->status === 'published' ? 'Publicado' : 'Borrador' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                    {{-- Botón Constructor (Builder) --}}
                                    <a href="{{ route('admin.quizzes.builder', $quiz) }}" class="text-indigo-600 hover:text-indigo-900 border border-indigo-200 bg-indigo-50 px-3 py-1 rounded hover:bg-indigo-100 transition" title="Gestionar Preguntas">
                                        <i class="fas fa-layer-group"></i> Preguntas
                                    </a>
                                    
                                    {{-- Botón Editar Configuración --}}
                                    <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-gray-600 hover:text-gray-900 p-1" title="Configuración">
                                        <i class="fas fa-cog"></i>
                                    </a>

                                    {{-- Botón Eliminar --}}
                                    <button onclick="confirmDelete({{ $quiz->id }}, 'quiz', 'deleteQuiz')" class="text-red-600 hover:text-red-900 p-1" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-clipboard-list text-4xl mb-3 text-gray-300"></i>
                                    <p>No se encontraron exámenes.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>
</div>