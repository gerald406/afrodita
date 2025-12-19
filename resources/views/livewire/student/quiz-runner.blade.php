<div class="max-w-3xl mx-auto px-4 py-8">
    
    {{-- PANTALLA DE RESULTADOS (Se muestra al finalizar) --}}
    {{-- PANTALLA DE RESULTADOS (Se muestra al finalizar) --}}
    @if($isFinished)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden text-center p-8 animate-fade-in-up">
            
            {{-- 1. Icono y Mensaje de Estado (Aprobado/Reprobado) --}}
            <div class="mb-6">
                @if($score >= $quiz->passing_score)
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100">
                        <i class="fas fa-trophy text-5xl text-green-600"></i>
                    </div>
                    <h2 class="mt-4 text-3xl font-extrabold text-gray-900">¡Felicidades!</h2>
                    <p class="mt-2 text-lg text-gray-600">Has aprobado el examen.</p>
                @else
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-red-100">
                        <i class="fas fa-times-circle text-5xl text-red-600"></i>
                    </div>
                    <h2 class="mt-4 text-3xl font-extrabold text-gray-900">Sigue intentando</h2>
                    <p class="mt-2 text-lg text-gray-600">No has alcanzado el puntaje mínimo de {{ $quiz->passing_score }}%.</p>
                @endif
            </div>

            {{-- 2. Puntaje Grande y Detalles --}}
            <div class="border-t border-gray-200 pt-6 pb-6">
                <div class="text-6xl font-bold {{ $score >= $quiz->passing_score ? 'text-green-600' : 'text-red-600' }}">
                    {{ $score }}%
                </div>
                <p class="text-sm text-gray-500 uppercase tracking-wide mt-1">Puntaje Final</p>
                
                {{-- NUEVO: Información de intentos --}}
                <div class="mt-4 inline-flex items-center px-4 py-2 bg-blue-50 rounded-lg text-blue-700 text-sm font-medium">
                    <i class="fas fa-history mr-2"></i>
                    @if($quiz->max_attempts > 0)
                        Intentos restantes: {{ $remainingAttempts }}
                    @else
                        Intentos ilimitados
                    @endif
                </div>
            </div>

            {{-- 3. Botones de Acción (Volver y Reintentar) --}}
            <div class="mt-4 flex flex-col sm:flex-row justify-center gap-4">
                
                {{-- Botón Volver --}}
                <a href="{{ route('student.my-courses') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                    Volver al Curso
                </a>

                {{-- NUEVO: Botón Reintentar (Solo si cumple la condición) --}}
                @if($remainingAttempts > 0 || $quiz->max_attempts == 0)
                    <button 
                        wire:click="retryQuiz"
                        wire:confirm="¿Estás seguro de que deseas realizar un nuevo intento? Tu nota actual quedará registrada en el historial."
                        class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <i class="fas fa-redo mr-2"></i> Intentar de nuevo
                    </button>
                @endif
                
            </div>
        </div>

    @else
    {{-- PANTALLA DEL EXAMEN (Preguntas) --}}
        
        <div class="mb-6">
            <div class="flex justify-between text-xs font-medium text-gray-500 mb-1">
                <span>Pregunta {{ $currentQuestionIndex + 1 }} de {{ $questions->count() }}</span>
                <span>{{ round((($currentQuestionIndex + 1) / $questions->count()) * 100) }}% completado</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-indigo-600 h-2.5 rounded-full transition-all duration-300 ease-in-out" 
                     style="width: {{ (($currentQuestionIndex + 1) / $questions->count()) * 100 }}%"></div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 min-h-[400px] flex flex-col">
            
            <div class="p-6 md:p-8 border-b border-gray-100">
                <div class="prose prose-lg max-w-none text-gray-800">
                    {{-- IMPORTANTE: Renderizar HTML del editor enriquecido --}}
                    {!! $this->currentQuestion->content !!}
                </div>
            </div>

            <div class="p-6 md:p-8 flex-1 bg-gray-50">
                <div class="space-y-3">
                    @foreach($this->currentQuestion->answers as $answer)
                        <label 
                            class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 group
                            {{ isset($selectedAnswers[$this->currentQuestion->id]) && $selectedAnswers[$this->currentQuestion->id] == $answer->id 
                                ? 'border-indigo-500 bg-indigo-50 ring-1 ring-indigo-500' 
                                : 'border-gray-200 bg-white hover:border-indigo-300 hover:bg-indigo-50' 
                            }}"
                        >
                            <input 
                                type="radio" 
                                name="question_{{ $this->currentQuestion->id }}" 
                                value="{{ $answer->id }}"
                                wire:click="selectAnswer({{ $this->currentQuestion->id }}, {{ $answer->id }})"
                                class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500 mt-0.5"
                                {{ isset($selectedAnswers[$this->currentQuestion->id]) && $selectedAnswers[$this->currentQuestion->id] == $answer->id ? 'checked' : '' }}
                            >
                            
                            <span class="ml-3 text-gray-700 font-medium group-hover:text-indigo-900">
                                {{ $answer->answer_text }} 
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="bg-white px-6 py-4 border-t border-gray-100 flex justify-between items-center">
                
                {{-- Botón Anterior --}}
                <button 
                    wire:click="prevQuestion" 
                    @if($currentQuestionIndex === 0) disabled @endif
                    class="flex items-center px-4 py-2 text-sm font-medium rounded-md
                    {{ $currentQuestionIndex === 0 
                        ? 'text-gray-300 cursor-not-allowed' 
                        : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }}"
                >
                    <i class="fas fa-arrow-left mr-2"></i> Anterior
                </button>

                {{-- Botón Siguiente o Finalizar --}}
                @if($currentQuestionIndex < $questions->count() - 1)
                    <button 
                        wire:click="nextQuestion"
                        class="inline-flex items-center px-5 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Siguiente <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                @else
                    <button 
                        wire:click="submitQuiz"
                        wire:confirm="¿Estás seguro de que deseas enviar el examen? No podrás cambiar tus respuestas."
                        class="inline-flex items-center px-5 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    >
                        Finalizar Examen <i class="fas fa-check-circle ml-2"></i>
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>