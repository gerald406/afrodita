<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determina si el usuario actual puede actualizar (editar) a otro usuario.
     * 
     * Reglas:
     * - Solo los admins pueden editar usuarios
     * - Los admins NO pueden editar a otros admins (excepto a sí mismos)
     * - Pueden editar estudiantes e instructores libremente
     */
    public function update(User $currentUser, User $targetUser): bool
    {
        // Solo los admins tienen permiso de edición
        if ($currentUser->role !== 'admin') {
            return false;
        }
        
        // El admin puede editar estudiantes e instructores
        // Pero NO puede editar a otros admins (excepto a sí mismo)
        if ($targetUser->role === 'admin') {
            return $currentUser->id === $targetUser->id;
        }
        
        return true;
    }

    /**
     * Determina si el usuario actual puede eliminar a otro usuario.
     * Misma lógica que update.
     */
    public function delete(User $currentUser, User $targetUser): bool
    {
        // No se puede eliminar a sí mismo
        if ($currentUser->id === $targetUser->id) {
            return false;
        }
        
        // Misma lógica que update
        return $this->update($currentUser, $targetUser);
    }
}
