<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            
            <div class="mb-6 pb-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">
                    {{ $quiz ? 'Editar Configuración' : 'Nuevo Examen' }}
                </h2>
                <a href="{{ route('admin.quizzes.index') }}" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Curso Asociado</label>
                        <select wire:model="course_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Seleccionar Curso --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Título del Examen</label>
                        <input wire:model.live="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Slug (URL)</label>
                        <input wire:model="slug" type="text" class="mt-1 block w-full bg-gray-50 text-gray-500 rounded-md border-gray-300 cursor-not-allowed" readonly>
                        @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Instrucciones / Descripción</label>
                        <textarea wire:model="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>

                    <div class="col-span-2 border-t border-gray-100 my-2 pt-4">
                        <h3 class="text-sm font-bold text-gray-900 uppercase mb-3">Reglas de Evaluación</h3>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Duración (minutos)</label>
                        <input wire:model="duration_minutes" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Puntaje para aprobar (0-100)</label>
                        <input wire:model="passing_score" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Intentos Máximos</label>
                        <input wire:model="max_attempts" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estado</label>
                        <select wire:model="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="draft">Borrador</option>
                            <option value="published">Publicado</option>
                        </select>
                    </div>

                </div>

                <div class="flex items-center justify-end mt-8">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md shadow transition">
                        Guardar Configuración
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>