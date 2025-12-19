<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white shadow-sm rounded-lg p-6 mb-6 flex justify-between items-center border-l-4 border-indigo-500">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $quiz->title }}</h2>
                <p class="text-sm text-gray-500">
                    <span class="font-bold">{{ $quiz->questions->count() }}</span> preguntas en total | 
                    Puntaje total: <span class="font-bold">{{ $quiz->questions->sum('points') }}</span> pts
                </p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.quizzes.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4">
                    Salir
                </a>
                <button wire:click="createQuestion" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow transition">
                    <i class="fas fa-plus mr-2"></i> Agregar Pregunta
                </button>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($quiz->questions as $index => $question)
                <div class="bg-white shadow rounded-lg p-6 relative group transition hover:shadow-md">
                    
                    <div class="absolute top-4 right-4 flex gap-2 opacity-50 group-hover:opacity-100 transition">
                        <button wire:click="editQuestion({{ $question->id }})" class="text-blue-600 hover:text-blue-800 bg-blue-50 p-2 rounded">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button onclick="confirmDelete({{ $question->id }}, 'question', 'deleteQuestion')" class="text-red-600 hover:text-red-800 bg-red-50 p-2 rounded">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <span class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full font-bold text-gray-600">
                                {{ $index + 1 }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{!! $question->content !!}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-3">
                                @foreach($question->answers as $answer)
                                    <div class="flex items-center gap-2 p-2 rounded border {{ $answer->is_correct ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-100' }}">
                                        @if($answer->is_correct)
                                            <i class="fas fa-check-circle text-green-500"></i>
                                        @else
                                            <i class="far fa-circle text-gray-400"></i>
                                        @endif
                                        <span class="text-sm {{ $answer->is_correct ? 'font-bold text-green-800' : 'text-gray-600' }}">
                                            {{ $answer->answer_text }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="mt-3 text-xs text-gray-400 font-medium uppercase tracking-wide">
                                Valor: {{ $question->points }} pt(s)
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-lg border-2 border-dashed border-gray-300">
                    <i class="fas fa-layer-group text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Este examen aún no tiene preguntas.</p>
                    <button wire:click="createQuestion" class="mt-4 text-indigo-600 font-bold hover:underline">
                        Comenzar a agregar
                    </button>
                </div>
            @endforelse
        </div>

        <x-dialog-modal wire:model="isModalOpen" maxWidth="2xl">
            <x-slot name="title">
                {{ $question_id ? 'Editar Pregunta' : 'Nueva Pregunta' }}
            </x-slot>

            <x-slot name="content">
                <div class="space-y-4">
                    {{-- <div>
                        <label class="block text-sm font-bold text-gray-700">Enunciado de la Pregunta</label>

                        <textarea wire:model="content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Escribe la pregunta aquí..."></textarea>

                        @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div> --}}

                    <div class="mb-4"> 
                        <label class="block text-sm font-bold text-gray-700">Enunciado de la Pregunta
                        </label>

                        <div class="mt-1">
                            <x-rich-text 
                                wire:model.defer="content" 
                                placeholder="Escribe la pregunta aquí..." 
                            />
                        </div>

                        @error('content') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>


                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Puntaje</label>
                            <input wire:model="points" type="number" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Tipo</label>
                            <select wire:model="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="single_choice">Opción Única</option>
                                <option value="multiple_choice">Opción Múltiple</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Opciones de Respuesta</label>
                        @error('answers') <span class="block text-red-500 text-xs mb-2">{{ $message }}</span> @enderror

                        <div class="space-y-2">
                            @foreach($answers as $index => $answer)
                                <div class="flex items-center gap-2">
                                    {{-- Radio/Checkbox para marcar correcta --}}
                                    <div class="pt-1">
                                        <input type="checkbox" wire:model="answers.{{ $index }}.is_correct" class="rounded text-green-600 focus:ring-green-500 w-5 h-5 cursor-pointer" title="Marcar como correcta">
                                    </div>
                                    
                                    {{-- Texto de la respuesta --}}
                                    <input type="text" wire:model="answers.{{ $index }}.answer_text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="Opción {{ $index + 1 }}">
                                    
                                    {{-- Botón eliminar opción --}}
                                    <button wire:click="removeAnswer({{ $index }})" class="text-gray-400 hover:text-red-500 px-2" title="Eliminar opción">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @error('answers.'.$index.'.answer_text') <span class="text-red-500 text-xs ml-8">El texto es obligatorio</span> @enderror
                            @endforeach
                        </div>

                        <button wire:click="addAnswer" class="mt-3 text-sm text-indigo-600 font-bold hover:underline flex items-center gap-1">
                            <i class="fas fa-plus-circle"></i> Agregar otra opción
                        </button>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('isModalOpen', false)" wire:loading.attr="disabled">
                    Cancelar
                </x-secondary-button>

                <x-button class="ml-2 bg-indigo-600" wire:click="saveQuestion" wire:loading.attr="disabled">
                    Guardar Pregunta
                </x-button>
            </x-slot>
        </x-dialog-modal>

    </div>
</div>