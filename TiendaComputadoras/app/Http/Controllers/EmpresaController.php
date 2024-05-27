<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Personas;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    //
    public function index()
    {
        $persona=Personas::first();
        $imagenes = Imagen::where('imagenable_type', 'App\Models\Personas')
        ->where('imagenable_id', $persona->id)
        ->get();
        return view('Gestion_Landing.Datos_empresas.index',compact('persona','imagenes'));
    }


    public function create()
    {

    }

    public function store()
    {

    }


    public function edit()
    {

    }

    public function update()
    {

    }
}
