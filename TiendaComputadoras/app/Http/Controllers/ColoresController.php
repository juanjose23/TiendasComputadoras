<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColores;
use App\Http\Requests\UpdateColores;
use App\Models\Colores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ColoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // Aplica el middleware de autorización solo a los métodos "create" y "store"
        $this->middleware('can:create,App\Models\Productos')->only(['create', 'store']);
        $this->middleware('can:update,App\Models\Productos')->only(['edit', 'update']);
        $this->middleware('can:delete,App\Models\Productos')->only(['destroy']);
        // Aplica el middleware de autorización a todos los métodos excepto "index" y "show"
        $this->middleware('can:viewAny,App\Models\Productos')->except(['index', 'show']);
    }
    public function index()
    {
        //
        return view('Gestion_Catalogos.Color.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Gestion_Catalogos.Color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColores $request)
    {
        //
        $color = new Colores();
        $color->nombre=$request->nombre;
        $color->codigo=$request->codigo;
        $color->estado =$request->estado;
        $color->save();
        Session::flash('success','Se realizado la operación con éxito');
        return redirect()->route('colores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colores $colores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colores $colores)
    {
        //
        $colores=Colores::findOrFail($colores->id);
        return view('Gestion_Catalogos.Color.edit',compact('colores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColores $request, Colores $colores)
    {
        //
        $color=Colores::findOrFail($colores->id);
        $color->nombre=$request->nombre;
        $color->codigo=$request->codigo;
        $color->estado =$request->estado;
        $color->save();
        Session::flash('success','Se realizado la operación con éxito');
        return redirect()->route('colores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colores $colores)
    {
        //
        // Encuentra el cargo por su ID
        $color = Colores::findOrFail($colores->id);

        // Cambia el estado del cargo
        $color->estado = $color->estado == 1 ? 0 : 1;
        $color->save();
      
        Session::flash('success', 'El estado del color ha sido cambiado exitosamente.');

        return redirect()->route('colores.index');
    }
}
