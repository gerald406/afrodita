<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Maneja la petición entrante.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Verificar si el usuario está logueado y tiene el rol correcto
        // Nota: $request->user() funciona porque este middleware se ejecutará después de 'auth'
        if (! $request->user() || $request->user()->role !== $role) {
            // Si intenta entrar a /admin y no es admin, lo mandamos al dashboard normal (estudiante)
            // o lanzamos un error 403 (Prohibido)
            abort(403, 'No tienes permiso para acceder a esta área.');
        }

        return $next($request);
    }
}
