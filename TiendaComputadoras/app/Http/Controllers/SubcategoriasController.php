<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Http\Requests\StoreSubcategoriasRequest;
use App\Http\Requests\UpdateSubcategoriasRequest;
use Illuminate\Support\Facades\Session;

class SubcategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('Gestion_Catalogos.Subcategorias.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categorias::where('estado', 1)->get();
        return view('Gestion_Catalogos.Subcategorias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubcategoriasRequest $request)
    {
        //
        $subcategoria = new Subcategorias();
        $subcategoria->categorias_id = $request->categoria;
        $subcategoria->nombre = $request->nombre;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->estado = $request->estado;
        $subcategoria->save();
        Session::flash('success', 'Se ha registado correctamente la operación');
        return redirect()->route('subcategorias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategorias $subcategorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($subcategorias)
    {
        //
        $subcategoria = Subcategorias::findOrFail($subcategorias);

        $categorias = Categorias::where('estado', 1)->get();
        return view('Gestion_Catalogos.Subcategorias.edit', compact('categorias', 'subcategoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcategoriasRequest $request, $subcategorias)
    {
        //

        $subcategoria =SubCategorias::findOrFail($subcategorias);
        // Verificar si los datos han cambiado
        if (
            $subcategoria->categorias_id != $request->categoria ||
            $subcategoria->nombre != $request->nombre ||
            $subcategoria->descripcion != $request->descripcion ||
            $subcategoria->estado != $request->estado
        ) {

            $subcategoria->categorias_id = $request->categoria;
            $subcategoria->nombre = $request->nombre;
            $subcategoria->descripcion = $request->descripcion;
            $subcategoria->estado = $request->estado;
            $subcategoria->save();

            // Mostrar mensaje solo si hay cambios
            Session::flash('success', 'El proceso se ha completado exitosamente.');
        }

        return redirect()->route('subcategorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($subcategorias)
    {
        //
        // Encuentra el cargo por su ID
        $subcategoria = Subcategorias::findOrFail($subcategorias);

        // Cambia el estado del cargo
        $subcategoria->estado = $subcategoria->estado == 1 ? 0 : 1;
        $subcategoria->save();
        

        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado del subcategoria ha sido cambiado exitosamente.');

        return redirect()->route('subcategorias.index');
    }
}
