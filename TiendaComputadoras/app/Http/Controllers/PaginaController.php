<?php

namespace App\Http\Controllers;

use App\Models\Privilegios;
use App\Models\RolesUsuarios;
use App\Models\User;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer as BaconQrCodeWriter;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Crypt;

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
            'password' => 'required',
        ]);

        $usuarios = new User();
        $user = $usuarios->ValidarUsuario($request->usuario);
        $privilegio = new Privilegios();
        $userId = $user['id'];
        $personasId = $user['personas_id'];
        $InformacionPersonal = $usuarios->ObtenerInformacionUsuario($personasId);
        $informacionDetallada = $usuarios->ObtenerCodigoCliente($personasId) ?? $usuarios->ObtenerCodigoEmpleados($personasId);
        $privilegios = $privilegio->ObtenerPrivilegiosUsuario($userId);
        $credenciales = $request->only('usuario', 'password');
        if (!Auth::attempt($credenciales, $request->filled('recordar'))) {
            return redirect()->back()->withInput()->with('error', 'Credenciales incorrectas');
        }
        $request->session()->regenerate();
       // request()->session()->regenerate();
      
        $validarRol = RolesUsuarios::where('users_id', $userId)
            ->where('roles_id', '!=', 1)
            ->where('estado', 1)
            ->exists();


        $redirectRoute = $validarRol ? 'inicio' : '/';
        $redirectMessage = $validarRol ? '¡Bienvenido!' : '¡Bienvenido!';

        // Crear las sesiones
        Session::put('personas_id', $personasId);
        Session::put('IdUser', $userId);
        Session::put('nombre', $InformacionPersonal['nombre']);
        Session::put('Apellido', $InformacionPersonal['apellido_razon_social']);
        Session::put('Foto', $informacionDetallada['foto']);
        Session::put('Codigo', $informacionDetallada['codigo']);
        Session::put('id', $informacionDetallada['id']);
        Session::put('privilegios', $privilegios);


        // Obtener los datos de sesión y agregar los datos adicionales al payload
        $sessionData = [
            'personas_id' => $personasId,
            'IdUser' => $userId,
            'nombre' => $InformacionPersonal['nombre'],
            'Apellido' => $InformacionPersonal['apellido_razon_social'],
            'Foto' => $informacionDetallada['foto'],
            'Codigo' => $informacionDetallada['codigo'],
            'id' => $informacionDetallada['id'],
            'privilegios' => $privilegios
        ];
        $sessionId = $request->session()->getId();
        $payload = Crypt::encrypt(json_encode($sessionData));

        // Almacenar los datos en la tabla sessions
        DB::table('sessions')->insert([
            'id' => $sessionId,
            'user_id' => $userId,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'payload' => $payload,
            'last_activity' => now()->timestamp,
            'active' => true,
        ]);

        return redirect()->route($redirectRoute)->with('success', $redirectMessage);
    }

    public function logout(Request $request)
    {
        // Obtener el identificador único de la sesión actual
        $sessionId = $request->session()->getId();

       
     

        // Cerrar la sesión del usuario
        Auth::logout();
        DB::table('sessions')
        ->where('id', $sessionId)
        ->delete();
        // Invalidar la sesión actual
        $request->session()->invalidate();

        // Regenerar el token de CSRF
        $request->session()->regenerateToken();


        // Redirigir al usuario a la página de inicio
        return redirect('/');
    }

    public function admin()
    {
    }
    public function error403()
    {
        return view('Error.403');
    }
}
