<?php

namespace App\Http\Controllers;

use App\Models\Colores;
use App\Models\Colores_productos;
use App\Models\Detalle_productos;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Coloresproductos extends Controller
{
    //
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
    }

    public function create(Productos $colores_productos)
    {
    }
    public function edit( $colores_productos)
    {
        $producto = Detalle_productos::with(['productos'])->find($colores_productos);
        $Idproducto= $producto->productos->id;
        $colores = Colores::whereNotIn('id', function($query) use ($Idproducto) {
            $query->select('colores_id')
                  ->from('colores_productos')
                  ->where('productos_id', $Idproducto);
        })->where('estado', 1)
        ->get();
        $listacolores=Colores_productos::with(['colores'])->where('productos_id', $Idproducto)->get();
        return view('Gestion_Catalogos.Productos.colores', compact('colores', 'producto','listacolores'));
    }

    public function store(Request $request)
    {
        // Validar los campos de la solicitud
        $request->validate([
            'producto' => 'required|exists:productos,id',
            'color' => 'required|exists:colores,id',
            'estado' => 'required|in:0,1',
        ]);
    
       
        $color = new Colores_productos();
        $color->productos_id = $request->producto;
        $color->colores_id = $request->color;
        $color->estado = $request->estado;
        $color->save();
        $Idcolor = $color->id;


        $Detalle = Detalle_productos::find($request->detalle);
        $detalle = new Detalle_productos();
        $detalle->productos_id = $Detalle->productos_id;
        $detalle->coloresproductos_id = $Idcolor;
        $detalle->tallasproductos_id = $Detalle->tallasproductos_id;
        $detalle->cortesproductos_id = $Detalle->cortesproductos_id;
        $detalle->generos_id = $Detalle->generos_id;
        $detalle->estado = 1;
        $detalle->save();
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
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
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
    }
}
