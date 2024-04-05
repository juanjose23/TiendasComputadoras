<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    public function handle($request, Closure $next, $privilegeId)
    {
        $UserId = Auth::id();
        // Verificar si el usuario está autenticado
        if (!$UserId) {
            // El usuario no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->route('login');
        }
        // Obtener el ID del usuario de la sesión
       
        // Verificar si el usuario tiene el privilegio con el ID especificado
        if (!User::hasPrivilege($UserId, $privilegeId)) {
            // El usuario no tiene el privilegio necesario, redirigir a una página de acceso denegado
            return redirect()->route('error403');
        }


        // El usuario está autenticado y tiene el privilegio necesario, continuar con la solicitud
        return $next($request);
    }
}
