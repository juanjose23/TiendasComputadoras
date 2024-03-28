<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsers;
use App\Models\Empleados;
use App\Models\RolesModel;
use Illuminate\Http\Request;

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
        $empleados=$colaborador->empleadosSinUsuarios();
        $roles=RolesModel::where('estado',1)   ->whereNotIn('id', [1])->get();
        return view('Gestion_usuarios.usuarios.create',compact('empleados','roles'));
    }

    public function store(StoreUsers $request)
    {
         
    }
    public function edit()
    {

    }

    public function destroy()
    {

    }
}
