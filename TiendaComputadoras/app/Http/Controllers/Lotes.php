<?php

namespace App\Http\Controllers;

use App\Models\Detalles_Lotes;
use App\Models\Precios;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Lotes AS lote;
class Lotes extends Controller
{
    //
    public function index()
    {
        return view('Gestion_inventario.Lotes.index');
    }
    public function create()
    {
        $Precios = new Precios();
        $productos = $Precios->ObtenerProductosConCategoriasInventario();
        $proveedores = Proveedores::where('estado', 1)->get();

        return view('Gestion_inventario.Lotes.create', compact('productos', 'proveedores'));
    }

    public function store(Request $request)
    {
        $productos = json_decode($request->input('productos'), true);
        $subtotal = 0;
        foreach ($productos as $producto) {
            $subtotal += $producto['precio'];
        }
        $iva = $request->iva / 100;

        $maxId = \App\Models\Lotes::max('id');
        $solicitud = new \App\Models\Lotes();
        $solicitud->numero_lote = 'LT-' . $maxId + 1;
        $solicitud->empleados_id = Session::get('id');
        $solicitud->proveedores_id = $request->proveedores;
        $solicitud->subtotal = $subtotal;
        $solicitud->iva = $subtotal * $iva;
        $solicitud->total = $subtotal + $subtotal * $iva;
        $solicitud->estado = 1;
        $solicitud->save();

        $productos = json_decode($request->input('productos'), true);

        foreach ($productos as $producto) {
            $detalle = new Detalles_Lotes();
            $detalle->lotes_id = $solicitud->id;
            $detalle->productosdetalles_id = $producto['id'];
            $detalle->cantidad = $producto['cantidad'];
            $detalle->precio = $producto['precio'];
            $detalle->save();
        }

        Session::flash('success', 'Se ha realizado la operación');
        return redirect()->route('lotes.index');
    }



    public function show(Lote $lotes)
    {
        $Precios = new Precios();
        $productos = $Precios->ObtenerProductosConCategoriasInventario();
        $solicitudes= Lote::findOrFail($lotes->id);
        $detalles=Detalles_Lotes::where('lotes_id',$lotes->id)->get();
        return view('Gestion_inventario.Lotes.show', compact('productos','solicitudes','detalles'));
    }

    public function destroy(Lote $lotes)
    {
       
          // Encuentra el cargo por su ID
          $rol = Lote::findOrFail($lotes->id);

          // Cambia el estado del cargo
          $rol->estado = $rol->estado == 1 ? 0 : 1;
          $rol->save();
          // Redirige de vuelta a la página de índice con un mensaje flash
          Session::flash('success', 'El estado del lote ha sido cambiado exitosamente.');
  
          return redirect()->route('lotes.index');
    }
}
