<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- ═══════════════════════════════════════ --}}
        {{-- CABECERA                                --}}
        {{-- ═══════════════════════════════════════ --}}
        <div class="bg-white shadow-sm rounded-xl p-6 mb-6 flex justify-between items-center border-l-8 border-indigo-600">
            <div>
                <h2 class="text-2xl font-black text-gray-800">{{ $quiz->title }}</h2>
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">
                    Editor de Contenido Multimedia
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.quizzes.index') }}"
                   class="px-4 py-2 text-gray-600 font-bold hover:bg-gray-100 rounded-lg transition">
                    Salir
                </a>
                <button wire:click="createQuestion"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i> Nueva Pregunta
                </button>
            </div>
        </div>

        {{-- ═══════════════════════════════════════ --}}
        {{-- LISTADO DE PREGUNTAS                    --}}
        {{-- ═══════════════════════════════════════ --}}
        <div class="space-y-4">
            @forelse($quiz->questions as $index => $question)

                <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100
                            hover:border-indigo-300 transition relative">

                    {{-- Botones editar / eliminar --}}
                    <div class="absolute top-4 right-4 flex gap-2">
                        <button wire:click="editQuestion({{ $question->id }})"
                                class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                title="Editar pregunta">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="if(confirm('¿Estás seguro de eliminar esta pregunta?'))
                                        { @this.deleteQuestion({{ $question->id }}) }"
                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                title="Eliminar pregunta">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <div class="flex gap-4 pr-16">

                        {{-- Número --}}
                        <span class="flex-shrink-0 w-10 h-10 bg-indigo-100 text-indigo-700
                                     rounded-full flex items-center justify-center font-black shadow-sm">
                            {{ $index + 1 }}
                        </span>

                        <div class="flex-1">

                            {{-- ══════════════════════════════════════════ --}}
                            {{-- ENUNCIADO + IMAGEN DE PREGUNTA             --}}
                            {{-- ══════════════════════════════════════════ --}}
                            <div class="flex flex-col md:flex-row gap-4 mb-4 items-start">

                                {{-- Texto del enunciado --}}
                                <div class="flex-1 text-gray-800 font-bold">
                                    @if($question->content)
                                        <div class="prose prose-sm">
                                            {!! $question->content !!}
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic font-normal text-sm">
                                            <i class="fas fa-image mr-1 text-indigo-400"></i>
                                            Solo imagen
                                        </span>
                                    @endif
                                </div>

                                {{-- Imagen del enunciado --}}
                                @if($question->question_image)
                                    <div class="flex-shrink-0">
                                        <img
                                            src="{{ Storage::url($question->question_image) }}"
                                            alt="Imagen del enunciado"
                                            class="w-40 h-28 object-cover rounded-xl border-2
                                                   border-indigo-200 shadow-md"
                                            onerror="this.src='/storage/{{ $question->question_image }}'"
                                        >
                                    </div>
                                @endif
                            </div>

                            {{-- ══════════════════════════════════════════ --}}
                            {{-- RESPUESTAS                                 --}}
                            {{-- ══════════════════════════════════════════ --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-4">
                                @foreach($question->answers as $answer)
                                    <div class="flex items-center gap-3 p-2 rounded-lg border
                                        {{ $answer->is_correct
                                            ? 'bg-green-50 border-green-200'
                                            : 'bg-gray-50 border-gray-200' }}">

                                        {{-- Correcto/incorrecto --}}
                                        @if($answer->is_correct)
                                            <i class="fas fa-check-circle text-green-500 flex-shrink-0"></i>
                                        @else
                                            <i class="far fa-circle text-gray-300 flex-shrink-0"></i>
                                        @endif

                                        {{-- Imagen de la respuesta --}}
                                        @if($answer->answer_image)
                                            <div class="flex-shrink-0">
                                                <img
                                                    src="{{ Storage::url($answer->answer_image) }}"
                                                    alt="Imagen opción"
                                                    class="w-16 h-16 object-cover rounded-lg border-2
                                                           {{ $answer->is_correct
                                                               ? 'border-green-300'
                                                               : 'border-gray-200' }} shadow-sm"
                                                    onerror="this.src='/storage/{{ $answer->answer_image }}'"
                                                >
                                            </div>
                                        @endif

                                        {{-- Texto de la respuesta --}}
                                        @if($answer->answer_text)
                                            <span class="text-xs
                                                {{ $answer->is_correct
                                                    ? 'font-black text-green-800'
                                                    : 'text-gray-600' }}">
                                                {{ $answer->answer_text }}
                                            </span>
                                        @endif

                                    </div>
                                @endforeach
                            </div>

                            {{-- Metadata --}}
                            <div class="mt-4 flex gap-3 text-xs text-gray-400 font-bold
                                        uppercase tracking-wider">
                                <span>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    {{ $question->points }} pt(s)
                                </span>
                                <span>
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $question->type === 'true_false'
                                        ? 'Verdadero/Falso'
                                        : ($question->type === 'multiple_choice'
                                            ? 'Múltiple'
                                            : 'Única') }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

            @empty
                <div class="text-center py-20 bg-white rounded-xl border-2
                            border-dashed border-gray-300">
                    <i class="fas fa-vial text-5xl text-gray-200 mb-4"></i>
                    <p class="text-gray-500 font-medium">
                        Aún no has agregado preguntas a este examen.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- ═══════════════════════════════════════ --}}
        {{-- MODAL                                   --}}
        {{-- ═══════════════════════════════════════ --}}
        <x-dialog-modal wire:model="isModalOpen" maxWidth="2xl">
            <x-slot name="title">
                <span class="text-xl font-black text-gray-800">
                    {{ $question_id ? 'Editar Pregunta' : 'Configurar Pregunta' }}
                </span>
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {{-- Contenido (2/3) --}}
                    <div class="md:col-span-2 space-y-5">
                        <div>
                            <x-label value="Texto del Enunciado" class="font-bold text-indigo-700" />
                            <div class="mt-1">
                                <x-rich-text wire:model="content" />
                            </div>
                            <x-input-error for="content" class="mt-1" />
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 flex flex-col gap-2">
                            <x-label value="Imagen de Apoyo (Opcional)" class="font-bold text-gray-700" />
                            <div class="flex items-center gap-4">
                                <div class="relative w-24 h-16 bg-white border rounded-lg
                                            flex items-center justify-center overflow-hidden">
                                    <div wire:loading wire:target="temporary_question_image"
                                         class="absolute inset-0 bg-white/80 flex items-center
                                                justify-center z-10">
                                        <i class="fas fa-spinner fa-spin text-indigo-600"></i>
                                    </div>
                                    @if($temporary_question_image)
                                        <img src="{{ $temporary_question_image->temporaryUrl() }}"
                                             class="w-full h-full object-cover">
                                    @elseif($question_image)
                                        <img src="{{ Storage::url($question_image) }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-image text-gray-300 text-2xl"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" wire:model="temporary_question_image"
                                           accept="image/*"
                                           class="text-xs text-gray-500 w-full file:mr-3 file:py-1.5
                                                  file:px-3 file:rounded-lg file:border-0 file:text-xs
                                                  file:font-bold file:bg-indigo-50 file:text-indigo-700
                                                  hover:file:bg-indigo-100 transition">
                                    @if($temporary_question_image || $question_image)
                                        <button type="button" wire:click="removeQuestionImage"
                                                wire:loading.remove
                                                wire:target="temporary_question_image"
                                                class="text-red-500 font-bold text-xs mt-2 hover:underline">
                                            <i class="fas fa-trash-alt mr-1"></i> Quitar imagen
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <x-input-error for="temporary_question_image" class="mt-1" />
                        </div>
                    </div>

                    {{-- Config (1/3) --}}
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 space-y-5 h-fit">
                        <div>
                            <x-label value="Puntaje" class="font-bold" />
                            <x-input type="number" wire:model="points" min="1" class="w-full mt-1" />
                            <x-input-error for="points" class="mt-1" />
                        </div>
                        <div>
                            <x-label value="Tipo de Pregunta" class="font-bold" />
                            <select wire:model.live="type"
                                    class="w-full rounded-md border-gray-300 shadow-sm mt-1
                                           focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="single_choice">Opción Única</option>
                                <option value="multiple_choice">Múltiple Selección</option>
                                <option value="true_false">Verdadero / Falso</option>
                            </select>
                            <x-input-error for="type" class="mt-1" />
                        </div>
                    </div>

                    {{-- Respuestas --}}
                    <div class="md:col-span-3">
                        <div class="flex justify-between items-end border-b pb-2 mb-4">
                            <x-label value="Opciones de Respuesta"
                                     class="font-black text-lg text-gray-800" />
                            @error('answers_general')
                                <span class="text-red-600 font-bold text-sm bg-red-50
                                             px-3 py-1 rounded-lg">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="space-y-3">
                            @foreach($answers as $idx => $ans)
                                <div class="flex items-center gap-3 p-3 bg-white border-2 rounded-xl
                                    {{ $answers[$idx]['is_correct']
                                        ? 'border-green-500 shadow-sm bg-green-50/30'
                                        : 'border-gray-200 hover:border-gray-300' }} transition">

                                    {{-- Checkbox --}}
                                    <div class="pt-1" title="Marcar como correcta">
                                        <input type="checkbox"
                                               wire:model="answers.{{ $idx }}.is_correct"
                                               class="w-5 h-5 text-green-600 rounded border-gray-300
                                                      focus:ring-green-500 cursor-pointer">
                                    </div>

                                    {{-- Input texto --}}
                                    <div class="flex-1">
                                        <input type="text"
                                               wire:model="answers.{{ $idx }}.answer_text"
                                               aria-label="Texto de la opción {{ $idx + 1 }}"
                                               class="w-full border-none focus:ring-0 bg-transparent
                                                      px-2 placeholder-gray-400 font-medium"
                                               placeholder="Escribe la opción aquí..."
                                               {{ $type === 'true_false' ? 'readonly' : '' }}>
                                        <x-input-error for="answers.{{ $idx }}.answer_text" />
                                    </div>

                                    {{-- Imagen de la respuesta --}}
                                    <div class="flex items-center gap-2 bg-gray-50 p-1.5
                                                rounded-lg border border-gray-200">
                                        <div class="relative w-8 h-8 rounded overflow-hidden
                                                    flex items-center justify-center bg-white
                                                    border border-gray-100">
                                            <div wire:loading wire:target="answers.{{ $idx }}.image"
                                                 class="absolute inset-0 bg-white/80 flex items-center
                                                        justify-center z-10">
                                                <i class="fas fa-spinner fa-spin text-indigo-500 text-xs"></i>
                                            </div>
                                            @if(isset($ans['image']) && $ans['image'])
                                                <img src="{{ $ans['image']->temporaryUrl() }}"
                                                     class="w-full h-full object-cover">
                                            @elseif(isset($ans['image_url']) && $ans['image_url'])
                                                <img src="{{ Storage::url($ans['image_url']) }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <i class="fas fa-image text-gray-300 text-xs"></i>
                                            @endif
                                        </div>

                                        <label class="cursor-pointer bg-white border shadow-sm px-2 py-1
                                                      rounded text-xs font-bold text-gray-600
                                                      hover:bg-gray-100 transition"
                                               title="Subir imagen">
                                            <i class="fas fa-upload"></i>
                                            <input type="file"
                                                   wire:model="answers.{{ $idx }}.image"
                                                   accept="image/*" class="hidden">
                                        </label>

                                        @if((isset($ans['image']) && $ans['image']) ||
                                            (isset($ans['image_url']) && $ans['image_url']))
                                            <button type="button"
                                                    wire:click="removeAnswerImage({{ $idx }})"
                                                    wire:loading.remove
                                                    wire:target="answers.{{ $idx }}.image"
                                                    class="text-red-400 hover:text-red-600 px-1 transition"
                                                    title="Eliminar imagen">
                                                <i class="fas fa-minus-circle"></i>
                                            </button>
                                        @endif
                                    </div>

                                    {{-- Eliminar opción --}}
                                    @if($type !== 'true_false' && count($answers) > 2)
                                        <div class="border-l pl-3 ml-1">
                                            <button type="button"
                                                    onclick="if(confirm('¿Eliminar esta opción?'))
                                                            { @this.removeAnswer({{ $idx }}) }"
                                                    class="text-gray-300 hover:text-red-600 transition p-1"
                                                    title="Eliminar fila completa">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <x-input-error for="answers.{{ $idx }}.image" class="ml-10" />
                            @endforeach
                        </div>

                        @if($type !== 'true_false')
                            <button type="button" wire:click="addAnswer"
                                    class="mt-4 w-full py-2 border-2 border-dashed border-indigo-200
                                           text-indigo-600 font-bold rounded-xl hover:bg-indigo-50
                                           transition flex items-center justify-center gap-2">
                                <i class="fas fa-plus"></i> Agregar otra opción
                            </button>
                        @endif
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('isModalOpen', false)">
                    Cancelar
                </x-secondary-button>
                <x-button wire:click="saveQuestion"
                          class="ml-3 bg-indigo-600 hover:bg-indigo-700">
                    <span wire:loading.remove wire:target="saveQuestion">
                        <i class="fas fa-save mr-2"></i> Guardar Pregunta
                    </span>
                    <span wire:loading wire:target="saveQuestion">
                        <i class="fas fa-spinner fa-spin mr-2"></i> Guardando...
                    </span>
                </x-button>
            </x-slot>
        </x-dialog-modal>

    </div>
</div>