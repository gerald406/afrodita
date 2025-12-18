<?php

namespace App\Livewire\Student;

use App\Models\Comment;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LessonComments extends Component
{
    use WithPagination;

    public Lesson $lesson;

    public $body = '';          // Texto para comentario nuevo
    public $replyBody = '';     // Texto para respuesta
    public $replyingToId = null; // ID del comentario al que estamos respondiendo

    protected $rules = [
        'body' => 'required|min:3|max:1000',
    ];

    // Publicar comentario nuevo (Principal)
    public function postComment()
    {
        $this->validate(['body' => 'required|min:3|max:1000']);

        $this->lesson->comments()->create([
            'user_id' => Auth::id(),
            'body' => $this->body,
            'parent_id' => null // Es un hilo nuevo
        ]);

        $this->reset('body');
        $this->resetPage(); // Volver al inicio para ver el nuevo

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Pregunta publicada']);
    }

    // Activar modo respuesta
    public function setReply($commentId)
    {
        $this->replyingToId = $commentId;
        $this->replyBody = ''; // Limpiar campo anterior
    }

    // Cancelar respuesta
    public function cancelReply()
    {
        $this->replyingToId = null;
        $this->replyBody = '';
    }

    // Publicar Respuesta (Hijo)
    public function postReply()
    {
        $this->validate(['replyBody' => 'required|min:3|max:1000']);

        $this->lesson->comments()->create([
            'user_id' => Auth::id(),
            'body' => $this->replyBody,
            'parent_id' => $this->replyingToId // Aquí vinculamos la respuesta
        ]);

        $this->cancelReply(); // Cerrar formulario de respuesta

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Respuesta enviada']);
    }

    public function delete($commentId)
    {
        $comment = Comment::find($commentId);

        if ($comment && ($comment->user_id === Auth::id() || Auth::user()->role === 'admin')) {
            $comment->delete();
            $this->dispatch('swal:toast', ['type' => 'info', 'title' => 'Comentario eliminado']);
        }
    }

    public function render()
    {
        // Obtener solo comentarios RAÍZ (parent_id = null)
        // Cargamos ansiosamente las respuestas y sus usuarios para evitar el problema N+1
        $comments = $this->lesson->comments()
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->latest()
            ->paginate(10);

        return view('livewire.student.lesson-comments', [
            'comments' => $comments
        ]);
    }
}
