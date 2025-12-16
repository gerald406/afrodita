<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use App\Models\GeneralSetting; // Importante para el modo gratis

class CoursePolicy
{
    /**
     * Determina si el usuario puede ver el contenido del curso (Videos, recursos).
     */
    public function view(User $user, Course $course): bool
    {
        // 1. EL "DIOS" (Admin)
        // El administrador siempre puede ver todo para moderar.
        if ($user->role === 'admin') {
            return true;
        }

        // 2. EL DUEÑO (Profesor)
        // El instructor que creó el curso siempre tiene acceso.
        if ($user->id === $course->user_id) {
            return true;
        }

        // 3. MODO GRATIS (NETFLIX MODE)
        // Si la configuración global tiene activo el modo gratis hoy, todos pasan.
        $settings = GeneralSetting::first();
        if ($settings && $settings->isFreeModeActive()) {
            return true;
        }

        // 4. EL ALUMNO LEGÍTIMO
        // Verifica si tiene una matrícula ACTIVA o COMPLETADA.
        // Si está "pending" (no ha pagado) o "cancelled", esto devolverá false.
        return $user->hasActiveEnrollment($course->id);
    }

    // Opcional: Proteger quién puede editar el curso
    public function update(User $user, Course $course): bool
    {
        return $user->role === 'admin' || $user->id === $course->user_id;
    }
}
