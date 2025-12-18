<?php

namespace App\Livewire\Web;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CourseReviews extends Component
{
    use WithPagination;

    public $course;
    public $rating = 5; // Valor por defecto
    public $comment = '';

    // Variables de estado
    public $canReview = false;
    public $userReview = null; // Si ya reseñó, guardamos la reseña aquí para editarla

    // Reglas de validación
    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|min:5|max:500',
    ];

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->checkReviewStatus();
    }

    /**
     * Verifica si el usuario puede reseñar o si ya lo hizo.
     */
    public function checkReviewStatus()
    {
        if (Auth::check()) {
            // 1. Verificar si está matriculado (ajusta según tu lógica de Enrollment)
            $isEnrolled = \App\Models\Enrollment::where('user_id', Auth::id())
                ->where('course_id', $this->course->id)
                ->exists(); // Ojo: podrías validar que status == 'active'

            // 2. Buscar si ya dejó reseña
            $this->userReview = Review::where('user_id', Auth::id())
                ->where('course_id', $this->course->id)
                ->first();

            if ($this->userReview) {
                // Si ya existe, cargamos los datos para editar
                $this->rating = $this->userReview->rating;
                $this->comment = $this->userReview->comment;
            }

            // Puede reseñar si está matriculado
            $this->canReview = $isEnrolled;
        }
    }

    public function save()
    {
        // Solo usuarios logueados
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Validación
        $this->validate();

        // Crear o Actualizar (UpdateOrCreate usa el índice unique [user_id, course_id])
        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'course_id' => $this->course->id
            ],
            [
                'rating' => $this->rating,
                'comment' => $this->comment
            ]
        );

        // Recalcular estado y limpiar
        $this->checkReviewStatus();

        // Notificación Toast
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => '¡Gracias por tu opinión!'
        ]);

        // Opcional: Recargar la página si quieres actualizar el promedio global del header
        // $this->redirect(request()->header('Referer')); 
    }

    public function render()
    {
        // Obtenemos las reseñas ordenadas por fecha, paginadas
        $reviews = $this->course->reviews()
            ->with('user') // Eager loading del autor
            ->latest()
            ->paginate(5);

        return view('livewire.web.course-reviews', compact('reviews'));
    }
}
