<?php

namespace App\Http\Controllers;

use App\Models\Privilegios;
use App\Models\RolesUsuarios;
use App\Models\User;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
    //
    public function loginadmin()
    {
        return view("Auth.login");
    }
    public function validarLogin(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario' => 'required|string',
            'contraseña' => 'required',
        ]);

        $usuarios = new User();
        $user = $usuarios->ValidarUsuario($request->usuario);

        if ($user === null) {
            return redirect()->back()->withInput()->with('error', 'Usuario no encontrado');
        }

        $userId = $user['id'];
        $personasId = $user['personas_id'];
        $validarcontraseña = $usuarios->ValidarContrasena($userId, $request->contraseña);

        if (!$validarcontraseña) {
            return redirect()->back()->withInput()->with('error', 'Credenciales incorrectas');
        }

        $validarRol = RolesUsuarios::where('users_id', $userId)
            ->where('roles_id', '!=', 1)
            ->where('estado', 1)
            ->exists();

        $redirectRoute = $validarRol ? 'cargos.index' : '/';
        
        $redirectMessage = $validarRol ? '¡Bienvenido!' : '¡Bienvenido!'; // Puedes personalizar el mensaje según el caso

        return redirect()->route($redirectRoute)->with('success', $redirectMessage);
    }
}
