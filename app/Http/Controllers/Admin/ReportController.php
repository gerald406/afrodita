<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\StudentsExport;
use App\Exports\CourseStudentsExport; // <--- Importar la nueva clase
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Course;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Reporte Global (Ya lo tenías)
    public function downloadStudents()
    {
        return Excel::download(new StudentsExport, 'todos_los_estudiantes_' . date('d-m-Y') . '.xlsx');
    }

    // NUEVO: Reporte Por Curso
    public function downloadCourseStudents($courseId)
    {
        try {
            $course = Course::findOrFail($courseId);

            // SEGURIDAD: Verificar autorización usando CoursePolicy
            if (!auth()->user()->can('view', $course)) {
                abort(403, 'No tienes permiso para acceder a este reporte.');
            }

            // Limpiamos el nombre del curso para que sea un nombre de archivo válido
            $fileName = 'curso_' . \Str::slug($course->title) . '_' . date('d-m-Y') . '.xlsx';

            return Excel::download(new CourseStudentsExport($courseId), $fileName);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Curso no encontrado');
        }
    }
}
