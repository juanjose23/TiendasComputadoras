<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storeprivilegios;
use App\Models\Privilegios;
use App\Models\RolesModel;
use App\Models\submodulos;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

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
        FacadesSession::flash('success','Se ha realizado la operación');
        return redirect()->route('privilegios.index');
    }

    public function edit()
    {

    }
    
}
