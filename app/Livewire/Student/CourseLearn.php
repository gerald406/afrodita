<?php

namespace App\Livewire\Student;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\UserPointLog;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CourseLearn extends Component
{
    public $course;
    public $currentLesson;
    public $activeTab = 'options';

    public function mount(Course $course, $lesson = null)
    {
        $this->course = $course;
        $this->authorizeAccess();

        if ($lesson) {
            $this->currentLesson = Lesson::whereIn('course_section_id', $course->sections->pluck('id'))
                ->findOrFail($lesson);
        } else {
            $this->currentLesson = $course->lessons->sortBy('sort_order')->first();
        }
    }

    public function authorizeAccess()
    {
        $user = Auth::user();
        if ($user->role === 'admin') return;

        $isEnrolled = $user->enrollments()
            ->where('course_id', $this->course->id)
            ->where('status', 'active')
            ->exists();

        if ($isEnrolled) return;

        $settings = GeneralSetting::first();
        if ($settings && $settings->isFreeModeCurrentlyActive()) {
            return;
        }

        abort(403, 'No tienes acceso a este contenido.');
    }

    /**
     * Método principal para cambiar de lección (usado por Sidebar y Botones Manuales)
     */
    public function changeLesson($lessonId)
    {
        // Validamos y buscamos la lección
        $this->currentLesson = $this->course->lessons->where('id', $lessonId)->firstOrFail();

        // [CORRECCIÓN] Disparamos el evento enviando la data necesaria para el reproductor
        // 'autoplay' => false (porque el usuario hizo clic manual, no queremos sustos, o true si prefieres)
        $this->dispatch('lesson-changed', [
            'url' => $this->getVideoUrl(),
            'iframe' => $this->currentLesson->video_iframe,
            'autoplay' => false
        ]);
    }

    /**
     * [NUEVO] Método llamado automáticamente cuando el video finaliza
     */
    public function autocompleteLesson()
    {
        // 1. Marcar la lección actual como completada
        $this->markAsCompleted(false); // false = no mostrar alerta visual (swal) para no interrumpir flujo

        // 2. Buscar la siguiente lección
        $nextLesson = $this->getNextLessonProperty();

        if ($nextLesson) {
            // 3. Si hay siguiente, cambiamos a ella
            $this->currentLesson = $nextLesson;

            // 4. Disparamos evento para recargar reproductor Y activar autoplay
            $this->dispatch('lesson-changed', [
                'url' => $this->getVideoUrl(),
                'iframe' => $this->currentLesson->video_iframe,
                'autoplay' => true // [IMPORTANTE] Esto hará que el siguiente video arranque solo
            ]);
        } else {
            // 5. Si no hay siguiente (fin del curso), buscamos la primera para reiniciar ciclo (opcional)
            // O simplemente mostramos la alerta de finalización
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => '¡Curso Completado!',
                'text' => 'Has finalizado todas las lecciones del curso.'
            ]);
        }
    }

    /**
     * Modificado para aceptar un parámetro $showNotification
     */
    public function markAsCompleted($showNotification = true)
    {
        $user = Auth::user();
        $isAlreadyCompleted = $this->currentLesson->users()
            ->where('user_id', $user->id)
            ->exists();

        if (!$isAlreadyCompleted) {
            DB::transaction(function () use ($user) {
                $this->currentLesson->users()->attach($user->id);
                $pointsToAdd = 100;
                $user->increment('total_points', $pointsToAdd);

                UserPointLog::create([
                    'user_id' => $user->id,
                    'points' => $pointsToAdd,
                    'event_type' => 'lesson_completed',
                    'reference_id' => $this->currentLesson->id
                ]);
            });

            // Solo mostramos el toast si es una acción manual, en automático puede ser molesto
            if ($showNotification) {
                $this->dispatch('swal:toast', [
                    'type' => 'success',
                    'title' => '¡Lección Completada!',
                    'text' => 'Has ganado +100 puntos.'
                ]);
            }

            // Verificar progreso total
            // (Tu lógica existente de courseProgress está bien)
        }
    }

    public function getVideoUrl()
    {
        return $this->currentLesson->video_iframe ?? $this->currentLesson->video_url;
    }

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
