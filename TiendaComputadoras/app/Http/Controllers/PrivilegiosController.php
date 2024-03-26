<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storeprivilegios;
use App\Models\Privilegios;
use App\Models\RolesModel;
use App\Models\submodulos;
use Illuminate\Support\Facades\Session;

class PrivilegiosController extends Controller
{
    //
    public function index()
    {

        return view('Gestion_usuarios.Privilegios.index');
    }
    public function create()
    {
        $rolesModel = new RolesModel();
        $modulos = submodulos::ObtenerModulosConSubmodulos();
        $Roles = $rolesModel->obtenerRolesSinPrivilegios();
        return view('Gestion_usuarios.Privilegios.create', compact('modulos', 'Roles'));
    }

    public function store(Storeprivilegios $request)
    {
        $submodulo = $request->submodulos;
        foreach ($submodulo as $submoduloIds) {
            foreach ($submoduloIds as $id_submodulo) {
                $privilegios = new Privilegios();
                $privilegios->roles_id = $request->rol;
                $privilegios->submodulos_id = $id_submodulo;
                $privilegios->estado = 1;
                $privilegios->save();
            }
        }
        Session::flash('success', 'Se ha realizado la operación');
        return redirect()->route('privilegios.index');
    }

    public function edit($privilegios)
    {
        $privilegio = new Privilegios();
        $rol=RolesModel::findOrFail($privilegios);
        $modulos= $privilegio->ObtenerModulosConSubmodulosFaltantes($privilegios);
        return view('Gestion_usuarios.Privilegios.edit',compact('modulos','rol'));
    }
    public function show($privilegios)
    {
        $rol=RolesModel::findOrFail($privilegios);
        $privielgio= new Privilegios();
        $modulos=$privielgio->ObtenerPrivilegiosRol($privilegios);
        return view('Gestion_usuarios.Privilegios.show',compact('modulos','rol'));
      
    }
    public function destroy($privilegios)
    {
        try {
           
            $privilegio = Privilegios::findOrFail($privilegios); 
            $privilegio->delete();
    
            return redirect()->back()->with('success', 'Privilegio eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el privilegio: ' . $e->getMessage());
        }
    }

}
