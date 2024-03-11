<?php

namespace App\Http\Controllers;

use App\Models\Colores;
use App\Models\Colores_productos;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Coloresproductos extends Controller
{
    //
    public function index()
    {
    }

    public function create(Productos $colores_productos)
    {
    }
    public function edit( $colores_productos)
    {
        $producto = Productos::find($colores_productos);
      
        $colores = Colores::whereNotIn('id', function($query) {
            $query->select('colores_id')
                  ->from('colores_productos');
        })->where('estado', 1)
        ->get();
        
        return view('Gestion_Catalogos.Productos.colores', compact('colores', 'producto'));
    }

    public function store(Request $request)
    {
        $color = new Colores_productos();
        $color->productos_id=$request->producto;
        $color->colores_id=$request->color;
        $color->estado=$request->estado;
        $color->save();
        Session::flash('success', 'Se ha registrado la variante correctamente exitosamente.');
        return redirect()->route('productos.show', $color->productos_id);
    }

    public function destroy($colores_productos)
    {
        //
        $producto = Colores_productos::findOrFail($colores_productos);
        // Cambia el estado del producto
        $producto->estado = $producto->estado == 1 ? 0 : 1;
        $producto->save();
        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado del color del producto ha sido cambiado exitosamente.');
        return redirect()->route('productos.show', $producto->productos_id);
    }
}
