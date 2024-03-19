<?php

namespace App\Http\Controllers;

use App\Models\RolesModel;
use App\Models\submodulos;
use Illuminate\Http\Request;

class PrivilegiosController extends Controller
{
    //
    public function index()
    {
        return view('Gestion_usuarios.Privilegios.index');
    }
    public function create()
    {
        $modulos = submodulos::ObtenerModulosConSubmodulos();
        $Roles=RolesModel::all();
       // return $modulos;
        return view('Gestion_usuarios.Privilegios.create',compact('modulos','Roles'));
    }
}
