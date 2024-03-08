<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModelos;
use App\Http\Requests\UpdateModelos;
use App\Models\Marcas;
use App\Models\Modelos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ModelosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       
       
        return view('Gestion_Catalogos.Modelos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
        $marcas=Marcas::where('estado',1)->get();
        return view('Gestion_Catalogos.Modelos.create',compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModelos $request)
    {
        //
        $modelo = new Modelos();
        $modelo->nombre=$request->nombre;
        $modelo->marcas_id=$request->marca;
        $modelo->descripcion=$request->descripcion;
        $modelo->estado=$request->estado;
        $modelo->save();
        Session::flash('success','Se ha registrado la operación con éxito');
        return redirect()->route('modelos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modelos $modelos)
    {
        //
        $modelos=Modelos::findOrFail($modelos->id);
        $marcas=Marcas::where('estado',1)->get();
        return view('Gestion_Catalogos.Modelos.edit',compact('modelos','marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModelos $request,Modelos $modelos )
    {
        //
        $Modelo=Modelos::findOrFail($modelos->id);
        $Modelo->nombre=$request->nombre;
        $Modelo->marcas_id=$request->marca;
        $Modelo->descripcion=$request->descripcion;
        $Modelo->estado=$request->estado;
        $Modelo->save();
        Session::flash('success','Se ha registrado la operación');
        return redirect()->route('modelos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modelos $modelos)
    {
        //
        $modelo = Modelos::findOrFail($modelos->id);

        // Cambia el estado del cargo
        $modelo->estado = $modelo->estado == 1 ? 0 : 1;
        $modelo->save();
        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado del modelo ha sido cambiado exitosamente.');

        return redirect()->route('modelos.index');
    }
}
