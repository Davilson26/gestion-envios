<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/login'); // O donde quieras redirigir
        }

        // Obtiene el rol del usuario actual
        $userRole = Auth::user()->rol_id; // Asumiendo que tienes un campo rol_id en la tabla users

        // Verifica si el rol del usuario está en los roles permitidos
        foreach ($roles as $role) {
            if ($userRole == $role) {
                return $next($request);
            }
        }

        // Si no tiene permiso, redirigir o lanzar un 403
        abort(403, 'Unauthorized action.');
    }
}
