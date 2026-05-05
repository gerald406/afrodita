<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\QuestionAnswer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizRunner extends Component
{
    public Quiz $quiz;
    public $questions;
    public $currentQuestionIndex = 0;

    public ?QuizAttempt $currentAttempt = null;
    public $selectedAnswers = [];

    public $isFinished = false;
    public $score = 0;

    public $attemptsCount     = 0;
    public $remainingAttempts = 0;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;

        // FIX: eager load answers con sus imágenes para evitar N+1
        // orderBy sort_order garantiza orden correcto de opciones
        $this->questions = $quiz->questions()
            ->with(['answers' => fn($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        $this->initializeState();
    }

    public function initializeState()
    {
        $this->currentAttempt = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $this->quiz->id)
            ->where('status', 'in_progress')
            ->first();

        if ($this->currentAttempt) {
            $this->currentQuestionIndex = $this->currentAttempt->current_question_index;

            foreach ($this->currentAttempt->answers as $ans) {
                $this->selectedAnswers[$ans->question_id] = $ans->question_answer_id;
            }
        } else {
            $lastAttempt = QuizAttempt::where('user_id', Auth::id())
                ->where('quiz_id', $this->quiz->id)
                ->where('status', '!=', 'in_progress')
                ->latest()
                ->first();

            if ($lastAttempt) {
                $this->currentAttempt = $lastAttempt;
                $this->score          = $lastAttempt->score_obtained;
                $this->isFinished     = true;
            } else {
                $this->startNewAttempt();
            }
        }

        $this->refreshAttemptsCount();
    }

    public function startNewAttempt()
    {
        $this->refreshAttemptsCount();

        if ($this->quiz->max_attempts > 0 && $this->remainingAttempts <= 0) {
            return;
        }

        $this->currentAttempt = QuizAttempt::create([
            'user_id'                => Auth::id(),
            'quiz_id'                => $this->quiz->id,
            'started_at'             => Carbon::now(),
            'status'                 => 'in_progress',
            'current_question_index' => 0,
            'score_obtained'         => 0,
        ]);

        $this->currentQuestionIndex = 0;
        $this->selectedAnswers      = [];
        $this->isFinished           = false;
        $this->score                = 0;
    }

    public function refreshAttemptsCount()
    {
        $this->attemptsCount = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $this->quiz->id)
            ->count();

        $this->remainingAttempts = $this->quiz->max_attempts == 0
            ? 9999
            : max(0, $this->quiz->max_attempts - $this->attemptsCount);
    }

    public function getCurrentQuestionProperty()
    {
        return $this->questions[$this->currentQuestionIndex] ?? null;
    }

    // FIX: calcula cuántas preguntas ya fueron respondidas (para barra de progreso real)
    public function getAnsweredCountProperty(): int
    {
        return count($this->selectedAnswers);
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < $this->questions->count() - 1) {
            $this->currentQuestionIndex++;
            if ($this->currentAttempt?->status === 'in_progress') {
                $this->currentAttempt->update([
                    'current_question_index' => $this->currentQuestionIndex,
                ]);
            }
        }
    }

    public function prevQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
            if ($this->currentAttempt?->status === 'in_progress') {
                $this->currentAttempt->update([
                    'current_question_index' => $this->currentQuestionIndex,
                ]);
            }
        }
    }

    public function selectAnswer($questionId, $questionAnswerId)
    {
        $this->selectedAnswers[$questionId] = $questionAnswerId;

        if ($this->currentAttempt?->status === 'in_progress') {
            QuizAttemptAnswer::updateOrCreate(
                [
                    'quiz_attempt_id' => $this->currentAttempt->id,
                    'question_id'     => $questionId,
                ],
                [
                    'question_answer_id' => $questionAnswerId,
                ]
            );
        }
    }

    public function submitQuiz()
    {
        if (!$this->currentAttempt || $this->currentAttempt->status !== 'in_progress') {
            return;
        }

        $correctCount   = 0;
        $totalQuestions = $this->questions->count();

        foreach ($this->questions as $question) {
            $userAnswerId  = $this->selectedAnswers[$question->id] ?? null;
            if ($userAnswerId) {
                $selectedOption = $question->answers->firstWhere('id', $userAnswerId);
                if ($selectedOption?->is_correct) {
                    $correctCount++;
                }
            }
        }

        $finalScore = $totalQuestions > 0
            ? round(($correctCount / $totalQuestions) * 100, 2)
            : 0;

        $this->currentAttempt->update([
            'completed_at'           => Carbon::now(),
            'score_obtained'         => $finalScore,
            'is_passed'              => $finalScore >= $this->quiz->passing_score,
            'status'                 => 'completed',
            'current_question_index' => 0,
        ]);

        $this->score      = $finalScore;
        $this->isFinished = true;
        $this->refreshAttemptsCount();
    }

    public function retryQuiz()
    {
        $this->startNewAttempt();
    }

    public function backToCourse()
    {
        return redirect()->route('student.my-courses');
    }

    public function render()
    {
        return view('livewire.student.quiz-runner')->layout('layouts.app');
    }
}
