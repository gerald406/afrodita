<?php

namespace App\Livewire\Student;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\UserPointLog;   // [IMPORTANTE] Para el historial
use App\Models\GeneralSetting; // [IMPORTANTE] Para el Modo Netflix
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Para transacciones seguras
use Livewire\Component;

class CourseLearn extends Component
{
    public $course;
    public $currentLesson;
    public $activeTab = 'options';

    public function mount(Course $course, $lesson = null)
    {
        $this->course = $course;

        // 1. Autorización (Incluye lógica "Modo Netflix")
        $this->authorizeAccess();

        // 2. Cargar lección
        if ($lesson) {
            // Aseguramos que la lección pertenezca a este curso
            $this->currentLesson = Lesson::whereIn('course_section_id', $course->sections->pluck('id'))
                ->findOrFail($lesson);
        } else {
            // Cargar la primera lección ordenada
            $this->currentLesson = $course->lessons->sortBy('sort_order')->first();
        }
    }

    /**
     * Verifica acceso: Admin O Matriculado O "Modo Gratuito" activo
     */
    public function authorizeAccess()
    {
        $user = Auth::user();

        // A. Si es admin, pasa
        if ($user->role === 'admin') return;

        // B. Verificar Matrícula Activa
        $isEnrolled = $user->enrollments()
            ->where('course_id', $this->course->id)
            ->where('status', 'active')
            ->exists();

        if ($isEnrolled) return;

        // C. Verificar "Modo Netflix" (Días Gratis) [FALTABA ESTO]
        $settings = GeneralSetting::first();

        // Usamos el helper que creamos en el modelo GeneralSetting
        if ($settings && $settings->isFreeModeCurrentlyActive()) {
            return; // Acceso concedido por promoción
        }

        // Si no cumple nada, fuera
        abort(403, 'No tienes acceso a este contenido. Inscríbete o espera una promoción.');
    }

    public function changeLesson($lessonId)
    {
        // Buscamos la lección asegurando que sea de este curso
        $this->currentLesson = $this->course->lessons->where('id', $lessonId)->firstOrFail();

        // Evento para que el frontend actualice el reproductor Plyr
        $this->dispatch('lesson-changed', url: $this->getVideoUrl());
    }

    public function markAsCompleted()
    {
        $user = Auth::user();

        // Verificar si YA estaba completada (evitar farmear puntos)
        $isAlreadyCompleted = $this->currentLesson->users()
            ->where('user_id', $user->id)
            ->exists();

        if (!$isAlreadyCompleted) {
            // Usamos transacción para asegurar que todo se guarde o nada
            DB::transaction(function () use ($user) {
                // 1. Registrar en tabla pivote (Lección completada)
                $this->currentLesson->users()->attach($user->id);

                // 2. Sumar puntos (Columna correcta: total_points)
                $pointsToAdd = 100;
                $user->increment('total_points', $pointsToAdd);

                // 3. Crear registro en el historial (Tabla: user_point_logs)
                UserPointLog::create([
                    'user_id' => $user->id,
                    'points' => $pointsToAdd,
                    'event_type' => 'lesson_completed',
                    'reference_id' => $this->currentLesson->id
                ]);
            });

            // Feedback Visual
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => '¡Lección Completada!',
                'text' => 'Has ganado +100 puntos de experiencia.'
            ]);

            // Verificar si terminó el curso al 100%
            // Nota: courseProgress es el método helper en tu modelo User
            if ($user->courseProgress($this->course) == 100) {
                $this->dispatch('swal:modal', [
                    'type' => 'success',
                    'title' => '¡Curso Finalizado!',
                    'text' => 'Felicidades, has completado todo el contenido.'
                ]);
            }
        }
    }

    public function getVideoUrl()
    {
        return $this->currentLesson->video_iframe ?? $this->currentLesson->video_url;
    }

    // Propiedades computadas para navegación
    public function getPreviousLessonProperty()
    {
        return $this->course->lessons
            ->where('sort_order', '<', $this->currentLesson->sort_order)
            ->sortByDesc('sort_order')
            ->first();
    }

    public function getNextLessonProperty()
    {
        return $this->course->lessons
            ->where('sort_order', '>', $this->currentLesson->sort_order)
            ->sortBy('sort_order')
            ->first();
    }

    public function render()
    {
        return view('livewire.student.course-learn')
            ->layout('layouts.classroom');
    }
}
