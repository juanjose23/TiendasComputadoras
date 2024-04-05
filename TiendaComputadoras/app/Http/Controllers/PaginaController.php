<?php

namespace App\Http\Controllers;

use App\Models\Privilegios;
use App\Models\RolesUsuarios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaginaController extends Controller
{
    //
    public function login()
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
        $InformacionPersonal = $usuarios->ObtenerInformacionUsuario($personasId);
        $informacionDetallada = $usuarios->ObtenerCodigoCliente($personasId) ?? $usuarios->ObtenerCodigoEmpleados($personasId);

        if (!$validarcontraseña) {
            return redirect()->back()->withInput()->with('error', 'Credenciales incorrectas');
        }

        $validarRol = RolesUsuarios::where('users_id', $userId)
            ->where('roles_id', '!=', 1)
            ->where('estado', 1)
            ->exists();


        $redirectRoute = $validarRol ? 'cargos.index' : '/';
        $redirectMessage = $validarRol ? '¡Bienvenido!' : '¡Bienvenido!'; 

        // Iniciar sesión manualmente
        Auth::loginUsingId($userId);

        // Crear las sesiones
        session(['personas_id' => $personasId]);
        session(['IdUser' => $userId]);
        session(['nombre' => $InformacionPersonal['nombre']]);
        session(['Apellido' => $InformacionPersonal['apellido_razon_social']]);
        session(['Foto' => $informacionDetallada['foto']]);
        session(['Codigo' => $informacionDetallada['codigo']]);
        session(['id' => $informacionDetallada['id']]);
       
        return redirect()->route($redirectRoute)->with('success', $redirectMessage);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function error403()
    {
        return view('Error.403');
    }
}
