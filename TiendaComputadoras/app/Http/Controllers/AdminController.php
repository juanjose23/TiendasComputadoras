<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargos;
use App\Models\Departamentos;
use App\Models\Empleados;
use App\Models\Estado_civiles;
use App\Models\Genero;
use App\Models\Imagen;
use App\Models\Pais;
use App\Models\Salarios;
use App\Models\session as inicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;

class AdminController extends Controller
{
    //

    public function inicio()
    {
        return view('Admin.index');
    }

    public function perfil()
    {
        $idUsuario = session('id');

        $empleados = Empleados::with(['personas', 'personas.persona_naturales', 'personas.direcciones'])
            ->find($idUsuario);
        $salario = Salarios::ObtenerSalarioColaborador($idUsuario);
        $cargo = AsignacionCargos::obtenerAsignacionesCargos($idUsuario);
        $imagenes = Imagen::where('imagenable_type', 'App\Models\Empleados')
            ->where('imagenable_id', $idUsuario)
            ->get();

        $sessiones = inicio::where('user_id', $idUsuario)->where('active', true)->orderBy('last_activity', 'DESC')->get();

        $agent = new Agent();
        foreach ($sessiones as $session) {
            $agent->setUserAgent($session->user_agent);
            $session->browser_name = $agent->browser();
            $session->platform_name = $agent->platform();
        }
        return view('Admin.perfil', compact('empleados', 'salario', 'cargo', 'imagenes', 'sessiones'));
    }



    //
    public function actualizarperfil()
    {
        $idUsuario = session('id');
        $empleados = Empleados::with(['personas', 'personas.persona_naturales', 'personas.direcciones'])
            ->find($idUsuario);
        $datos = [
            'departamentos' => Departamentos::obtenerDepartamentosConMunicipios(),
            'paises' => Pais::obtenerPaises(),
            'generos' => Genero::obtenerGenero(),
            'estadosCiviles' => Estado_civiles::obtenerEstados(),

        ];
        $imagenes = Imagen::where('imagenable_type', 'App\Models\Empleados')
            ->where('imagenable_id', $idUsuario)
            ->get();

        return view('Admin.edit', compact('empleados', 'datos', 'imagenes'));
    }


    //
    public function cambiarClave()
    {
    }



    public function closeSessionForDevice(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Verificar la contraseña proporcionada
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return redirect()->route('perfil')->with('error', 'Se ha ingresado la contraseña incorrecta.');
            }


            // Cerrar la sesión en otros dispositivos
            Auth::logoutOtherDevices($request->current_password);

            // Eliminar los registros de sesión en otros dispositivos
            $this->deleteOtherSessionRecords($request);

            // Redirigir al usuario con un mensaje de éxito
            return redirect()->route('perfil')->with('success', 'Sesiones en otros dispositivos cerradas exitosamente.');
        } else {
            // El usuario no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }
    }
    protected function deleteOtherSessionRecords(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::table(config('session.table', 'sessions'))

            ->where('id', '!=', $request->session()->getId())
            ->delete();
    }
}
