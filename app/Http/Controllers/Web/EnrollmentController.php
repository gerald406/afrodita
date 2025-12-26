<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Procesa la inscripción al curso.
     */
    public function store(Request $request, Course $course)
    {
        // 1. Verificar si el usuario ya está inscrito (para evitar duplicados)
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            // Si ya está inscrito, lo enviamos directo a sus cursos
            return redirect()->route('student.my-courses')
                ->with('info', 'Ya estás registrado en este curso.');
        }

        // 2. Determinar el estado inicial
        // Si el curso es GRATIS (0), se activa automáticamente.
        // Si es de PAGO, queda 'pending' hasta que el admin apruebe.
        $initialStatus = ($course->price == 0) ? 'active' : 'pending';

        // 3. Crear la matrícula con todos los datos de forma segura
        $enrollment = Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => $initialStatus,
            'enrolled_at' => now(),
            'price_paid' => $course->price // Asignado directamente para prevenir manipulación
        ]);

        // Registrar log de auditoría
        \Log::info('Nueva inscripción', [
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => $initialStatus,
            'price_paid' => $course->price
        ]);

        // 4. Mensaje de feedback según el caso
        if ($initialStatus === 'active') {
            $message = '¡Te has inscrito correctamente! Ya puedes ver las clases.';
            $type = 'success';
        } else {
            // Mensaje para cursos de pago
            $message = 'Solicitud de inscripción enviada. Por favor contacta al administrador para validar tu pago y activar el acceso.';
            $type = 'warning';
        }

        // 5. Redirigir a "Mis Cursos"
        return redirect()->route('student.my-courses')->with($type, $message);
    }
}
