<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoles;
use App\Http\Requests\UpdateRoles;
use App\Models\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RolesController extends Controller
{
    //
    public function __construct()
    {
        // Aplica el middleware de autorización solo a los métodos "create" y "store"
        $this->middleware('can:create,App\Models\permisos')->only(['create', 'store']);
        $this->middleware('can:update,App\Models\permisos')->only(['edit', 'update']);
        $this->middleware('can:delete,App\Models\permisos')->only(['destroy']);
        // Aplica el middleware de autorización a todos los métodos excepto "index" y "show"
        $this->middleware('can:viewAny,App\Models\permisos')->except(['index', 'show']);
    }
    public function index()
    {
        return view('Gestion_usuarios.Roles.index');
    }

    public function create()
    {
        
        return view('Gestion_usuarios.Roles.create');
    }

    public function store(StoreRoles $request)
    {
        $roles = new RolesModel();
        $roles->nombre = $request->nombre;
        $roles->descripcion = $request->descripcion;
        $roles->estado = $request->estado;
        $roles->save();
        Session::flash('success', 'Se ha registrado con éxito la operación');
        return redirect()->route('roles.index');
    }

    public function edit($roles)
    {
        $rol=RolesModel::findOrFail($roles);
        return view('Gestion_usuarios.Roles.edit',compact('rol'));
    }

    public function update(UpdateRoles $request, RolesModel $roles)
    {
        $roles=RolesModel::findOrFail($roles->id);
        $roles->nombre = $request->nombre;
        $roles->descripcion = $request->descripcion;
        $roles->estado = $request->estado;
        $roles->save();
        Session::flash('success', 'Se ha registrado con éxito la operación');
        return redirect()->route('roles.index');
    }

   

    public function destroy(RolesModel $roles)
    {
          // Encuentra el cargo por su ID
          $rol = RolesModel::findOrFail($roles->id);

          // Cambia el estado del cargo
          $rol->estado = $rol->estado == 1 ? 0 : 1;
          $rol->save();
          // Redirige de vuelta a la página de índice con un mensaje flash
          Session::flash('success', 'El estado del rol ha sido cambiado exitosamente.');
  
          return redirect()->route('roles.index');
    }
}
