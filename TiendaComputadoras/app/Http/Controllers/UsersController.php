<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsers;
use App\Http\Requests\UpdateUser;
use App\Models\Empleados;
use App\Models\RolesModel;
use App\Models\RolesUsuarios;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;


class UsersController extends Controller
{
    //
    public function index()
    {
        return view('Gestion_usuarios.usuarios.index');
    }

    public function create()
    {
        $colaborador = new Empleados();
        $empleados = $colaborador->empleadosSinUsuarios();
        $roles = RolesModel::where('estado', 1)->whereNotIn('id', [1])->get();
        return view('Gestion_usuarios.usuarios.create', compact('empleados', 'roles'));
    }

    public function store(StoreUsers $request)
    {
        $user = new User();
        $user->personas_id = $request->empleados;
        $usuario = $user->generarNombreusuarios($request->empleados);
        $contraseña = $user->generarContrasenaSegura();
        $user->usuario = $usuario;
        $user->password =  bcrypt($contraseña);
        $user->estado = $request->estado;
        $user->save();

        // Obtener el último ID después de guardar el usuario
        $userId = $user->id;

        $userRol = new RolesUsuarios();
        $userRol->roles_id = $request->roles;
        $userRol->users_id = $userId;
        $userRol->estado = 1;
        $userRol->save();

        // Carga la vista para generar el PDF
        $pdf = Pdf::loadView('Report.Credenciales', compact('usuario', 'contraseña'));
        $pdf->setPaper('A5'); // Establece el tamaño del papel como A5

        // Obtén el contenido del PDF generado
        $pdfOutput = $pdf->output();

        // Nombre del archivo PDF
        $fileName = 'credenciales_usuario_' . $userId . '.pdf';

        // Devuelve una respuesta HTTP con el PDF adjunto para descargar
        $response = response()->make($pdfOutput, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);

        // Redirige a la ruta usuarios.index después de enviar el PDF adjunto
        Session::flash('success', 'Se ha registrado con éxito el usuario');
        Session(['pdf_sent' => true]);
        return $response->send();
    }

    public function edit($usuarios)
    {
        //Roles
        $roles = new RolesModel();
        $usuario = User::with(['personas', 'personas.persona_naturales', 'personas.empleados'])->findOrFail($usuarios);
        $rolesusuarios = RolesUsuarios::where('users_id', $usuarios)->get();
        $rolesdisponibles = $roles->obtenerRolesDisponiblesParaUsuario($usuarios);
        // return $usuario;
        return view('Gestion_usuarios.usuarios.edit', compact('usuario', 'rolesusuarios', 'rolesdisponibles'));
    }
    public function update(UpdateUser $request, $usuarios)
    {
        $userRol = new RolesUsuarios();
        $userRol->roles_id = $request->roles;
        $userRol->users_id = $usuarios;
        $userRol->estado = 1;
        $userRol->save();
        return redirect()->back()->with('success', 'Nuevo rol asignado correctamente');
    }
    public function destroy()
    {
    }


    public function destroyroles($id)
    {

        $rol = RolesUsuarios::findOrFail($id);

        // Cambia el estado del cargo
        $rol->estado = $rol->estado == 1 ? 0 : 1;
        $rol->save();
        return redirect()->back()->with('success', 'Rol desactivado correctamente');
    }
}
