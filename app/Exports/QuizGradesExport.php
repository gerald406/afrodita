<?php
namespace App\Exports;

use App\Models\QuizAttempt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QuizGradesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $quizId;

    public function __construct($quizId)
    {
        $this->quizId = $quizId;
    }

    public function collection()
    {
        return QuizAttempt::with('user')
            ->where('quiz_id', $this->quizId)
            ->where('status', 'completed')
            ->get();
    }

    public function headings(): array
    {
        return ['Fecha', 'Estudiante', 'Email', 'Nota', 'Resultado'];
    }

    public function map($attempt): array
    {
        return [
            $attempt->completed_at,
            $attempt->user->name,
            $attempt->user->email,
            $attempt->score_obtained,
            $attempt->is_passed ? 'Aprobado' : 'Reprobado',
        ];
    }
}