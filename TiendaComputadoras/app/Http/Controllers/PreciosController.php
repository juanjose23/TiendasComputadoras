<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrecios;
use App\Models\Colores;
use App\Models\Colores_productos;
use Illuminate\Http\Request;
use App\Models\Precios;

class PreciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $productos = Colores_productos::ObtenerProductosConCategorias();
        //return $productos;
        return view('Gestion_Catalogos.Precios.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrecios $request)
    {
        //
        if ($request->has('terminos')) {
            $precios = new Precios();
            $precios->precio = $request->precio;
            $Id = Colores_productos::BuscarIdproducto($request->producto);
            $coloresProductos = Colores_productos::where('productos_id', $Id)->get();
            foreach ($coloresProductos as $colorProducto) {
                $precio = new Precios();
                $precio->productos_id = $colorProducto->id;
                $precio->precio = $request->precio;
                $precio->estado = $request->estado;
                $precio->save();
            }
        } else {
            $precios = new Precios();
            $precios->precio = $request->precio;
            $precios->precio = $request->precio;
            $precios->estado = $request->estado;
        }



        return redirect()->route('precios.index');
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
