<?php

namespace App\Http\Controllers;

use App\Models\Colores;
use App\Models\Modelos;
use App\Models\Subcategorias;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('Gestion_Catalogos.Productos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $subcategorias=Subcategorias::ObtenerCategoriasConSubcategorias();
        $modelos=Modelos::ObtenerMarcasConModelos();
        $colores=Colores::where('estado',1)->get();
        return view('Gestion_Catalogos.Productos.create',compact('modelos','colores','subcategorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
