<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class UserList extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = ''; // Filtro por rol

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    #[On('delete-confirmed')]
    public function deleteUser($id)
    {
        // Verificar que el usuario sea admin
        if (!auth()->user()->isAdmin()) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => 'Acción denegada',
                'text' => 'No tienes permiso para realizar esta acción.'
            ]);
            return;
        }

        // Evitar que el admin se borre a sí mismo
        if ($id == auth()->id()) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => 'Acción denegada',
                'text' => 'No puedes eliminar tu propia cuenta.'
            ]);
            return;
        }

        try {
            $user = User::findOrFail($id);
            // Opcional: Borrar foto de perfil si existe
            $user->delete();

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => 'Usuario eliminado',
                'text' => 'El registro ha sido borrado correctamente.'
            ]);
        } catch (\Exception $e) {
            // Registrar el error para debugging
            \Log::error('Error al eliminar usuario', [
                'user_id' => $id,
                'error' => $e->getMessage()
            ]);

            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'Ocurrió un problema al eliminar.'
            ]);
        }
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->roleFilter, function ($q) {
                $q->where('role', $this->roleFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.user-list', compact('users'));
    }
}
