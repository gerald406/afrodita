<div class="max-w-3xl mx-auto px-4 py-8">

    {{-- ══════════════════════════════════════════════════════ --}}
    {{-- PANTALLA DE RESULTADOS                                 --}}
    {{-- ══════════════════════════════════════════════════════ --}}
    @if($isFinished)

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden text-center">

            {{-- Banner de estado (verde/rojo) --}}
            <div class="{{ $score >= $quiz->passing_score
                ? 'bg-gradient-to-r from-green-500 to-emerald-600'
                : 'bg-gradient-to-r from-red-500 to-rose-600' }}
                px-8 py-10">

                @if($score >= $quiz->passing_score)
                    <div class="mx-auto w-20 h-20 rounded-full bg-white/20 flex items-center justify-center mb-4">
                        <i class="fas fa-trophy text-4xl text-white"></i>
                    </div>
                    <h2 class="text-3xl font-extrabold text-white">¡Felicidades!</h2>
                    <p class="mt-1 text-green-100 text-lg">Has aprobado el examen</p>
                @else
                    <div class="mx-auto w-20 h-20 rounded-full bg-white/20 flex items-center justify-center mb-4">
                        <i class="fas fa-times-circle text-4xl text-white"></i>
                    </div>
                    <h2 class="text-3xl font-extrabold text-white">Sigue intentando</h2>
                    <p class="mt-1 text-red-100 text-lg">
                        Necesitas {{ $quiz->passing_score }}% para aprobar
                    </p>
                @endif

                {{-- Puntaje circular --}}
                <div class="mt-6 inline-flex flex-col items-center bg-white/20 rounded-2xl px-8 py-4">
                    <span class="text-6xl font-black text-white">{{ $score }}%</span>
                    <span class="text-white/80 text-sm uppercase tracking-widest mt-1">
                        Puntaje Final
                    </span>
                </div>
            </div>

            {{-- Estadísticas --}}
            <div class="grid grid-cols-2 divide-x divide-gray-100 border-b border-gray-100">
                <div class="py-6 px-4">
                    <div class="text-2xl font-bold text-gray-800">
                        {{ $attemptsCount }}
                    </div>
                    <div class="text-xs text-gray-400 uppercase tracking-wide mt-1">
                        <i class="fas fa-history mr-1"></i> Intentos realizados
                    </div>
                </div>
                <div class="py-6 px-4">
                    <div class="text-2xl font-bold
                        {{ $remainingAttempts > 0 || $quiz->max_attempts == 0
                            ? 'text-indigo-600' : 'text-red-500' }}">
                        {{ $quiz->max_attempts == 0 ? '∞' : $remainingAttempts }}
                    </div>
                    <div class="text-xs text-gray-400 uppercase tracking-wide mt-1">
                        <i class="fas fa-redo mr-1"></i> Intentos restantes
                    </div>
                </div>
            </div>

            {{-- Botones --}}
            <div class="p-8 flex flex-col sm:flex-row justify-center gap-3">
                <button
                    wire:click="backToCourse"
                    class="inline-flex justify-center items-center px-6 py-3 border border-gray-300
                           text-base font-medium rounded-xl text-gray-700 bg-white
                           hover:bg-gray-50 transition shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i> Volver
                </button>

                @if($remainingAttempts > 0 || $quiz->max_attempts == 0)
                    <button
                        wire:click="retryQuiz"
                        wire:confirm="¿Estás seguro? Tu nota actual quedará registrada en el historial."
                        class="inline-flex justify-center items-center px-6 py-3
                               border border-transparent text-base font-medium rounded-xl
                               shadow-sm text-white bg-indigo-600 hover:bg-indigo-700
                               transition focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="fas fa-redo mr-2"></i> Intentar de nuevo
                    </button>
                @else
                    <div class="inline-flex items-center px-6 py-3 rounded-xl
                                bg-gray-100 text-gray-400 text-sm font-medium">
                        <i class="fas fa-lock mr-2"></i> Sin intentos disponibles
                    </div>
                @endif
            </div>
        </div>

    @else
    {{-- ══════════════════════════════════════════════════════ --}}
    {{-- PANTALLA DEL EXAMEN                                    --}}
    {{-- ══════════════════════════════════════════════════════ --}}

        {{-- Cabecera: título + progreso --}}
        <div class="mb-5">
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-lg font-bold text-gray-800 truncate pr-4">
                    {{ $quiz->title }}
                </h1>
                <span class="flex-shrink-0 text-xs font-bold text-indigo-600
                             bg-indigo-50 px-3 py-1 rounded-full">
                    {{ $currentQuestionIndex + 1 }} / {{ $questions->count() }}
                </span>
            </div>

            {{-- Barra de progreso de NAVEGACIÓN --}}
            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                <div class="bg-indigo-500 h-2 rounded-full transition-all duration-500 ease-out"
                     style="width: {{ (($currentQuestionIndex + 1) / $questions->count()) * 100 }}%">
                </div>
            </div>

            {{-- Indicador de respondidas --}}
            <div class="mt-2 flex justify-between text-xs text-gray-400 font-medium">
                <span>
                    <i class="fas fa-check-circle text-green-500 mr-1"></i>
                    {{ $this->answeredCount }} respondida(s)
                </span>
                <span>
                    {{ $questions->count() - $this->answeredCount }} sin responder
                </span>
            </div>
        </div>

        {{-- Tarjeta de pregunta --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100
                    flex flex-col min-h-[480px]">

            {{-- ══════════════════════════════════════════════════ --}}
            {{-- ENUNCIADO DE LA PREGUNTA                           --}}
            {{-- ══════════════════════════════════════════════════ --}}
            <div class="p-6 md:p-8 border-b border-gray-100">

                {{-- Número y tipo de pregunta --}}
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-8 h-8 rounded-full bg-indigo-600 text-white
                                 flex items-center justify-center text-sm font-black flex-shrink-0">
                        {{ $currentQuestionIndex + 1 }}
                    </span>
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 bg-gray-100
                                 px-2 py-1 rounded-lg">
                        {{ $this->currentQuestion->type === 'multiple_choice'
                            ? 'Múltiple selección'
                            : ($this->currentQuestion->type === 'true_false'
                                ? 'Verdadero / Falso'
                                : 'Selección única') }}
                    </span>
                    <span class="ml-auto text-xs font-bold text-yellow-600 bg-yellow-50
                                 px-2 py-1 rounded-lg flex-shrink-0">
                        <i class="fas fa-star mr-1"></i>
                        {{ $this->currentQuestion->points }} pt(s)
                    </span>
                </div>

                {{-- Texto del enunciado --}}
                @if($this->currentQuestion->content)
                    <div class="prose prose-base max-w-none text-gray-800 leading-relaxed">
                        {!! $this->currentQuestion->content !!}
                    </div>
                @endif

                {{-- ════════════════════════════════════════════ --}}
                {{-- IMAGEN DE LA PREGUNTA — RESPONSIVE           --}}
                {{-- ════════════════════════════════════════════ --}}
                @if($this->currentQuestion->question_image)
                    <div class="mt-4 flex justify-center">
                        <div class="relative w-full max-w-lg">
                            <img
                                src="{{ Storage::url($this->currentQuestion->question_image) }}"
                                alt="Imagen de la pregunta"
                                class="w-full h-auto max-h-72 object-contain rounded-xl border
                                       border-gray-200 shadow-sm bg-gray-50"
                                loading="lazy"
                                onerror="this.closest('div').innerHTML =
                                    '<div class=\'flex items-center justify-center h-24 bg-gray-50
                                     rounded-xl border border-dashed border-gray-300 text-gray-400\'>' +
                                    '<i class=\'fas fa-image text-2xl mr-2\'></i>' +
                                    '<span class=\'text-sm\'>Imagen no disponible</span></div>'"
                            >
                        </div>
                    </div>
                @endif

            </div>{{-- fin enunciado --}}

            {{-- ══════════════════════════════════════════════════ --}}
            {{-- OPCIONES DE RESPUESTA                              --}}
            {{-- ══════════════════════════════════════════════════ --}}
            <div class="p-6 md:p-8 flex-1 bg-gray-50/50">
                <div class="space-y-3">
                    @foreach($this->currentQuestion->answers as $answer)

                        @php
                            $isSelected = isset($selectedAnswers[$this->currentQuestion->id])
                                && $selectedAnswers[$this->currentQuestion->id] == $answer->id;
                            $hasImage   = !empty($answer->answer_image);
                            $hasText    = !empty($answer->answer_text);
                        @endphp

                        {{-- Opción clickeable completa --}}
                        <label
                            wire:click="selectAnswer({{ $this->currentQuestion->id }}, {{ $answer->id }})"
                            class="flex items-center gap-4 p-4 border-2 rounded-xl cursor-pointer
                                   transition-all duration-200 select-none
                                   {{ $isSelected
                                       ? 'border-indigo-500 bg-indigo-50 shadow-sm ring-2 ring-indigo-200'
                                       : 'border-gray-200 bg-white hover:border-indigo-300 hover:bg-indigo-50/50 hover:shadow-sm' }}"
                        >
                            {{-- Radio button visual --}}
                            <div class="flex-shrink-0 w-5 h-5 rounded-full border-2 transition-all
                                        flex items-center justify-center
                                        {{ $isSelected
                                            ? 'border-indigo-600 bg-indigo-600'
                                            : 'border-gray-300 bg-white' }}">
                                @if($isSelected)
                                    <div class="w-2 h-2 rounded-full bg-white"></div>
                                @endif
                            </div>

                            {{-- ══════════════════════════════════════ --}}
                            {{-- IMAGEN DE LA RESPUESTA — RESPONSIVE    --}}
                            {{-- ══════════════════════════════════════ --}}
                            @if($hasImage)
                                <div class="flex-shrink-0">
                                    <img
                                        src="{{ Storage::url($answer->answer_image) }}"
                                        alt="Imagen de la opción"
                                        class="w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-lg
                                               border-2 shadow-sm transition-all duration-200
                                               {{ $isSelected
                                                   ? 'border-indigo-400'
                                                   : 'border-gray-200' }}"
                                        loading="lazy"
                                        onerror="this.outerHTML =
                                            '<div class=\'w-20 h-20 sm:w-24 sm:h-24 rounded-lg
                                             bg-gray-100 border border-dashed border-gray-300
                                             flex items-center justify-center\'>' +
                                            '<i class=\'fas fa-image text-gray-300 text-xl\'></i></div>'"
                                    >
                                </div>
                            @endif

                            {{-- Texto de la opción --}}
                            @if($hasText)
                                <span class="flex-1 text-sm sm:text-base font-medium leading-snug
                                             {{ $isSelected ? 'text-indigo-900' : 'text-gray-700' }}">
                                    {{ $answer->answer_text }}
                                </span>
                            @elseif(!$hasImage)
                                <span class="flex-1 text-sm text-gray-400 italic">
                                    Sin contenido
                                </span>
                            @endif

                            {{-- Check de seleccionada --}}
                            @if($isSelected)
                                <i class="fas fa-check-circle text-indigo-500 flex-shrink-0 text-lg"></i>
                            @endif

                        </label>
                    @endforeach
                </div>
            </div>{{-- fin opciones --}}

            {{-- ══════════════════════════════════════════════════ --}}
            {{-- NAVEGACIÓN INFERIOR                                --}}
            {{-- ══════════════════════════════════════════════════ --}}
            <div class="bg-white px-6 py-4 border-t border-gray-100
                        flex justify-between items-center">

                {{-- Anterior --}}
                <button
                    wire:click="prevQuestion"
                    @if($currentQuestionIndex === 0) disabled @endif
                    class="flex items-center gap-2 px-4 py-2 text-sm font-semibold
                           rounded-xl transition
                           {{ $currentQuestionIndex === 0
                               ? 'text-gray-300 cursor-not-allowed'
                               : 'text-gray-600 hover:text-indigo-600 hover:bg-indigo-50' }}">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden sm:inline">Anterior</span>
                </button>

                {{-- Indicador de punto --}}
                <div class="flex gap-1.5">
                    @foreach($questions as $qi => $q)
                        @php
                            $answered = isset($selectedAnswers[$q->id]);
                            $isCurrent = $qi === $currentQuestionIndex;
                        @endphp
                        <div class="rounded-full transition-all duration-300
                            {{ $isCurrent
                                ? 'w-5 h-2.5 bg-indigo-600'
                                : ($answered
                                    ? 'w-2.5 h-2.5 bg-green-500'
                                    : 'w-2.5 h-2.5 bg-gray-200') }}">
                        </div>
                    @endforeach
                </div>

                {{-- Siguiente / Finalizar --}}
                @if($currentQuestionIndex < $questions->count() - 1)
                    <button
                        wire:click="nextQuestion"
                        class="flex items-center gap-2 px-5 py-2 text-sm font-semibold
                               rounded-xl shadow-sm text-white bg-indigo-600
                               hover:bg-indigo-700 transition focus:outline-none
                               focus:ring-2 focus:ring-indigo-500">
                        <span class="hidden sm:inline">Siguiente</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                @else
                    <button
                        wire:click="submitQuiz"
                        wire:confirm="¿Estás seguro de que deseas enviar el examen? No podrás cambiar tus respuestas."
                        class="flex items-center gap-2 px-5 py-2 text-sm font-semibold
                               rounded-xl shadow-sm text-white bg-green-600
                               hover:bg-green-700 transition focus:outline-none
                               focus:ring-2 focus:ring-green-500">
                        <i class="fas fa-check-circle"></i>
                        <span>Finalizar</span>
                    </button>
                @endif
            </div>

        </div>{{-- fin tarjeta --}}

        {{-- Aviso si no respondió la pregunta actual --}}
        @if(!isset($selectedAnswers[$this->currentQuestion->id]))
            <p class="mt-3 text-center text-xs text-amber-600 font-medium">
                <i class="fas fa-exclamation-circle mr-1"></i>
                Esta pregunta aún no ha sido respondida
            </p>
        @endif

    @endif
</div>