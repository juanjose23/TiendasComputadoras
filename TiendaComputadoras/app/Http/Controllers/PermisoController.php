<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermisos;
use App\Models\permisosmodulos;
use App\Models\permisosroles;
use App\Models\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermisoController extends Controller
{
    //
    public function index()
    {
        return view('Gestion_usuarios.Permisos.index');
    }


    public function create()
    {
        $rol = new RolesModel();
        $roles = $rol->obtenerRolesSinPermisos();
        $permisos = permisosroles::obtenerPermisosModulos();
        return view('Gestion_usuarios.Permisos.create', compact('roles', 'permisos'));
    }


    public function edit($permisos)
    {
        $rol = RolesModel::findOrFail($permisos);
        $permiso = new permisosroles();
        $permisos = $permiso->obtenerpermisosfaltantes($permisos);
        return view('Gestion_usuarios.Permisos.edit', compact('permisos', 'rol'));
    }


    public function store(StorePermisos $request)
    {
        $submodulo = $request->submodulos;
        foreach ($submodulo as $submoduloIds) {
            foreach ($submoduloIds as $id_submodulo) {
                $privilegios = new permisosroles();
                $privilegios->roles_id = $request->rol;
                $privilegios->permisosmodulos_id = $id_submodulo;
                $privilegios->estado = 1;
                $privilegios->save();
            }
        }
        Session::flash('success', 'Se ha realizado la operación');
        return redirect()->route('permisos.index');
    }
    public function show($permisos)
    {
        $rol=RolesModel::findOrFail($permisos);

        $permiso= new permisosroles();
        $permisos=$permiso->mostrarpermisosrol($permisos);
       // return $permisos;
        return view('Gestion_usuarios.Permisos.show',compact('rol','permisos'));

    }
    public function destroy($permisos)
    {
        try {
           
            $privilegio = permisosroles::findOrFail($permisos); 
            $privilegio->delete();
    
            return redirect()->back()->with('success', 'Permiso eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el permiso: ' . $e->getMessage());
        }
    }
}
