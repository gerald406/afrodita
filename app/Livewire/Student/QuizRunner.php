<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\QuestionAnswer; // Tu modelo de respuestas
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizRunner extends Component
{
    public Quiz $quiz;
    public $questions;
    public $currentQuestionIndex = 0;
    
    // Almacenamos el intento actual (Activo o el último completado)
    public ?QuizAttempt $currentAttempt = null;

    // Array para el binding de la vista (UI)
    public $selectedAnswers = [];

    // Estado visual
    public $isFinished = false;
    public $score = 0;
    
    // Contadores
    public $attemptsCount = 0;
    public $remainingAttempts = 0;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        // Cargamos preguntas y opciones
        $this->questions = $quiz->questions()->with('answers')->get(); // 'answers' rel en Question

        $this->initializeState();
    }

    public function initializeState()
    {
        // 1. Buscar si hay un intento EN PROGRESO (Para reanudar)
        $this->currentAttempt = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $this->quiz->id)
            ->where('status', 'in_progress')
            ->first();

        if ($this->currentAttempt) {
            // --- REANUDAR EXAMEN ---
            $this->currentQuestionIndex = $this->currentAttempt->current_question_index;
            
            // Cargar respuestas guardadas en la BD al array local
            $savedAnswers = $this->currentAttempt->answers; 
            foreach ($savedAnswers as $ans) {
                $this->selectedAnswers[$ans->question_id] = $ans->question_answer_id;
            }

        } else {
            // 2. Si no hay en progreso, buscar el ÚLTIMO intento (para mostrar resultados)
            $lastAttempt = QuizAttempt::where('user_id', Auth::id())
                ->where('quiz_id', $this->quiz->id)
                ->where('status', '!=', 'in_progress') // completed, timeout, etc.
                ->latest()
                ->first();

            if ($lastAttempt) {
                // Mostrar pantalla de resultados del último intento
                $this->currentAttempt = $lastAttempt;
                $this->score = $lastAttempt->score_obtained;
                $this->isFinished = true;
            } else {
                // 3. Usuario nuevo en este examen -> Iniciar primer intento automáticamente
                $this->startNewAttempt();
            }
        }

        $this->refreshAttemptsCount();
    }

    public function startNewAttempt()
    {
        $this->refreshAttemptsCount();

        // Validar si tiene intentos disponibles
        if ($this->quiz->max_attempts > 0 && $this->remainingAttempts <= 0) {
            return; // Bloquear si no hay intentos (la vista lo manejará también)
        }

        // Crear nuevo registro en BD
        $this->currentAttempt = QuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $this->quiz->id,
            'started_at' => Carbon::now(),
            'status' => 'in_progress',
            'current_question_index' => 0,
            'score_obtained' => 0,
        ]);

        // Resetear variables locales
        $this->currentQuestionIndex = 0;
        $this->selectedAnswers = [];
        $this->isFinished = false;
        $this->score = 0;
    }

    public function refreshAttemptsCount()
    {
        // Contamos todos los intentos (completados o en progreso)
        $this->attemptsCount = QuizAttempt::where('user_id', Auth::id())
                                          ->where('quiz_id', $this->quiz->id)
                                          ->count();
                                          
        $limit = $this->quiz->max_attempts > 0 ? $this->quiz->max_attempts : 9999;
        // Calculamos restantes (si max_attempts es 0, es ilimitado)
        $this->remainingAttempts = $this->quiz->max_attempts == 0 ? 9999 : max(0, $limit - $this->attemptsCount);
    }

    // --- PROPIEDADES COMPUTADAS ---
    public function getCurrentQuestionProperty()
    {
        return $this->questions[$this->currentQuestionIndex] ?? null;
    }

    // --- NAVEGACIÓN ---
    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < $this->questions->count() - 1) {
            $this->currentQuestionIndex++;
            // Guardar progreso de navegación en BD
            if($this->currentAttempt && $this->currentAttempt->status === 'in_progress'){
                $this->currentAttempt->update(['current_question_index' => $this->currentQuestionIndex]);
            }
        }
    }

    public function prevQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
            // Guardar progreso de navegación
            if($this->currentAttempt && $this->currentAttempt->status === 'in_progress'){
                $this->currentAttempt->update(['current_question_index' => $this->currentQuestionIndex]);
            }
        }
    }

    // --- SELECCIÓN DE RESPUESTA (Guardado en tiempo real) ---
    public function selectAnswer($questionId, $questionAnswerId)
    {
        // 1. Actualizar UI
        $this->selectedAnswers[$questionId] = $questionAnswerId;

        // 2. Guardar en BD (Tabla quiz_attempt_answers)
        if ($this->currentAttempt && $this->currentAttempt->status === 'in_progress') {
            
            QuizAttemptAnswer::updateOrCreate(
                [
                    'quiz_attempt_id' => $this->currentAttempt->id,
                    'question_id' => $questionId
                ],
                [
                    'question_answer_id' => $questionAnswerId
                ]
            );
        }
    }

    // --- FINALIZAR INTENTO ---
    public function submitQuiz()
    {
        if (!$this->currentAttempt || $this->currentAttempt->status !== 'in_progress') {
            return;
        }

        $correctCount = 0;
        $totalQuestions = $this->questions->count();

        // Calcular nota basándonos en las respuestas guardadas
        foreach ($this->questions as $question) {
            // Buscamos la respuesta del usuario para esta pregunta
            $userAnswerId = $this->selectedAnswers[$question->id] ?? null;

            if ($userAnswerId) {
                // Buscamos si esa opción es correcta en la tabla original de respuestas
                // Usamos la colección cargada en memoria para no hacer queries extra
                $selectedOption = $question->answers->where('id', $userAnswerId)->first();
                
                if ($selectedOption && $selectedOption->is_correct) {
                    $correctCount++;
                }
            }
        }

        // Calcular puntaje final (0 - 100)
        $finalScore = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 0;
        $isPassed = $finalScore >= $this->quiz->passing_score;

        // Actualizar el intento en BD
        $this->currentAttempt->update([
            'completed_at' => Carbon::now(),
            'score_obtained' => $finalScore,
            'is_passed' => $isPassed,
            'status' => 'completed',
            'current_question_index' => 0 // Resetear índice por si acaso
        ]);

        // Actualizar estado local
        $this->score = $finalScore;
        $this->isFinished = true;
        $this->refreshAttemptsCount();
    }

    // --- REINTENTAR ---
    public function retryQuiz()
    {
        $this->startNewAttempt();
    }

    public function backToCourse()
    {
        return redirect()->route('student.course.learn', ['course' => $this->quiz->course->slug]);
    }

    public function render()
    {
        return view('livewire.student.quiz-runner')->layout('layouts.app');
    }
}