<?php

namespace App\Http\Controllers;

use App\Models\Detalle_solicitud_compra;
use App\Models\Precios;
use App\Models\Solicitud_compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SolicitudCompraController extends Controller
{
    //
    public function index()
    {
        return view('Gestion_Compras.Solicitudes.index');
    }



    public function create()
    {
        $Precios = new Precios();
        $productos = $Precios->ObtenerProductosConCategorias();

        return view('Gestion_Compras.Solicitudes.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $solicitud = new Solicitud_compra();
        $solicitud->empleados_id = Session::get('id');
        $solicitud->fecha_entrega_esperada = $request->fecha;
        $solicitud->notas = $request->descripcion;
        $solicitud->estado = 1;
        $solicitud->save();

        $productos = json_decode($request->input('productos'), true);
        $detalle = new Detalle_solicitud_compra();
        foreach ($productos as $producto) {


            $detalle->solicitud_compras_id = $solicitud->id;

            $detalle->productosdetalles_id = $producto['id'];
            $detalle->cantidad = $producto['cantidad'];
            $detalle->save();

        }

        Session::flash('success', 'Se ha realizado la operación');
        return redirect()->route('solicitud.index');
    }


    public function edit()
    {

    }

    public function show()
    {

    }
    public function update()
    {

    }

    public function destroy()
    {

    }
}
