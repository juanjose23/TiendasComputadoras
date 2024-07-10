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
    public function __construct()
    {
        // Aplica el middleware de autorización solo a los métodos "create" y "store"
        $this->middleware('can:create,App\Models\Solicitud_compra')->only(['create', 'store']);
        $this->middleware('can:update,App\Models\Solicitud_compra')->only(['edit', 'update']);
        $this->middleware('can:delete,App\Models\Solicitud_compra')->only(['destroy']);
        // Aplica el middleware de autorización a todos los métodos excepto "index" y "show"
        $this->middleware('can:viewAny,App\Models\Solicitud_compra')->except(['index', 'show']);
    }
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
      
        foreach ($productos as $producto) {
            $detalle = new Detalle_solicitud_compra();
            $detalle->solicitud_compras_id = $solicitud->id;
            $detalle->productosdetalles_id = $producto['id'];
            $detalle->cantidad = $producto['cantidad'];
            $detalle->save();
        }

        Session::flash('success', 'Se ha realizado la operación');
        return redirect()->route('solicitud.index');
    }


    public function edit(Solicitud_compra $solicitud)
    {
        $Precios = new Precios();
        $productos = $Precios->ObtenerProductosConCategorias();
        $solicitudes= Solicitud_compra::findOrFail($solicitud->id);
        $detalles=Detalle_solicitud_compra::where('solicitud_compras_id',$solicitud->id)->get();
      
        return view('Gestion_Compras.Solicitudes.edit', compact('productos','solicitudes','detalles'));
    }

    public function show(Solicitud_compra $solicitud)
    {
        $Precios = new Precios();
        $productos = $Precios->ObtenerProductosConCategorias();
        $solicitudes= Solicitud_compra::findOrFail($solicitud->id);
        $detalles=Detalle_solicitud_compra::where('solicitud_compras_id',$solicitud->id)->get();
        return view('Gestion_Compras.Solicitudes.show', compact('productos','solicitudes','detalles'));
    }
    public function update(Solicitud_compra $solicitud,Request $request)
    {
        $solicitudes= Solicitud_compra::findOrFail($solicitud->id);
        $solicitudes->fecha_entrega_esperada = $request->fecha;
        $solicitudes->notas = $request->descripcion;
        $solicitudes->save();

        $productos = json_decode($request->input('productos'), true);
      
        foreach ($productos as $producto) {
          
          $detalle = Detalle_solicitud_compra::where('solicitud_compras_id', $solicitud->id)
                        ->where('productosdetalles_id', $producto['id'])
                        ->first();
        
            if ($detalle) {
                // Si el detalle existe, actualizar la cantidad
                $detalle->cantidad = $producto['cantidad'];
                $detalle->save();
            } else {
               
                // Si el detalle no existe, crear un nuevo registro
                Detalle_solicitud_compra::create([
                    'solicitud_compras_id' => $solicitud->id,
                    'productosdetalles_id' => $producto['id'],
                    'cantidad' => $producto['cantidad'],
                   
                ]);
            }
        }
       
        Session::flash('success', 'Se ha realizado la operación');
        return redirect()->route('solicitud.index');
    }

    public function destroy(request $request ,Solicitud_compra $solicitud)
    {
        $tallas = Solicitud_compra::findOrFail( $solicitud->id);
        $tallas->estado = $request->estado;
        $tallas->save();
        Session::flash('success', 'Se ha realizado la operación');
        return redirect()->route('solicitud.index');
    }
}
