<?php

namespace App\Exports;

use App\Models\Enrollment;
use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromQuery; // Usamos FromQuery para mejor rendimiento
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CourseStudentsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $courseId;
    protected $courseName;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
        // Obtenemos el nombre para ponerlo en el archivo si fuera necesario, 
        // o simplemente para validar que existe.
        $this->courseName = Course::find($courseId)?->title ?? 'Curso';
    }

    public function query()
    {
        // Consultamos la tabla 'enrollments' filtrando por el curso
        // y cargamos la relación 'user' para obtener los datos personales.
        // Solo traemos los activos o completados (opcional, según tu lógica).
        return Enrollment::query()
            ->with('user')
            ->where('course_id', $this->courseId)
            ->whereIn('status', ['active', 'completed']);
    }

    public function headings(): array
    {
        return [
            'DNI',
            'Nombres y Apellidos',
            'Email',
            'Celular',
            'Pago Matrícula',
            'Fecha Matrícula',
            'Estado'
        ];
    }

    public function map($enrollment): array
    {
        return [
            $enrollment->user->dni ?? 'S/N',
            $enrollment->user->name,
            $enrollment->user->email,
            $enrollment->user->phone ?? '-',

            // Datos propios de la matrícula (Enrollment)
            number_format($enrollment->price_paid, 2),
            $enrollment->enrolled_at ? $enrollment->enrolled_at->format('d/m/Y H:i') : '-',

            // Estado traducido
            match ($enrollment->status) {
                'active' => 'Activo',
                'completed' => 'Completado',
                'cancelled' => 'Cancelado',
                default => 'Pendiente'
            }
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Poner en negrita la primera fila (encabezados)
            1 => ['font' => ['bold' => true]],
        ];
    }
}
