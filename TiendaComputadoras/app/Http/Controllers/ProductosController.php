<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductos;
use App\Http\Requests\UpdateProductos;
use App\Models\Colores;
use App\Models\Colores_productos;
use App\Models\Detalle_productos;
use App\Models\Modelos;
use App\Models\Productos;
use App\Models\Subcategorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $subcategorias = Subcategorias::ObtenerCategoriasConSubcategorias();
        $modelos = Modelos::ObtenerMarcasConModelos();
        $colores = Colores::where('estado', 1)->get();
        return view('Gestion_Catalogos.Productos.create', compact('modelos', 'colores', 'subcategorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductos $request)
    {
        //Productos
        $producto = new Productos();
        $producto->nombre = $request->nombre;
        $producto->subcategorias_id = $request->subcategoria;
        $producto->modelos_id = $request->modelo;
        $producto->codigo = $producto->generarSkuProducto($producto, $request->subcategoria, $request->modelo);
        $producto->fecha_lanzamiento = $request->fecha;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->save();
        //ID producto
        $Idproducto = $producto->id;
        //Detalles del productos
        $detalle = new Detalle_productos();
        $detalle->productos_id = $Idproducto;
        $detalle->dimensiones = $request->dimensiones;
        $detalle->peso = $request->peso;
        $detalle->material = $request->material;
        $detalle->instrucciones_cuidado = $request->instrucciones_cuidado;
        $detalle->instrucciones_montaje = $request->instrucciones_montaje;
        $detalle->caracteristicas_especiales = $request->caracteristicas_especiales;
        $detalle->compatibilidad = $request->compatibilidad;
        $detalle->save();

        //Tabla colores-productos
        $color = new Colores_productos();
        $color->productos_id = $Idproducto;
        $color->colores_id = $request->color;
        $color->estado = 1;
        $color->save();
        Session::flash('success', 'Se ha registrado la óperacion con éxito');
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos  $productos)
    {
        //
        $productos = Productos::with(['modelos', 'modelos.marcas', 'subcategorias', 'subcategorias.categorias', 'detalles','coloresproductos','imagenes'])
        ->findOrFail($productos->id);
        //return $productos;
        return view('Gestion_Catalogos.Productos.show', compact( 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $productos)
    {
        //
        $subcategorias = Subcategorias::ObtenerCategoriasConSubcategorias();
        $modelos = Modelos::ObtenerMarcasConModelos();
        $colores = Colores::where('estado', 1)->get();
        $productos = Productos::with(['modelos', 'modelos.marcas', 'subcategorias', 'subcategorias.categorias', 'detalles'])
            ->findOrFail($productos->id);
        return view('Gestion_Catalogos.Productos.edit', compact('modelos', 'colores', 'subcategorias', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductos $request, Productos $productos)
    {
        //
        if (!$productos->exists()) {
            // Producto no encontrado, redireccionar con un mensaje de error
            Session::flash('error', 'El producto que intentas actualizar no existe.');
            return redirect()->route('productos.index');
        }
        //Productos
        $producto = Productos::with(['detalles'])->findorFail($productos->id);
        $codigo = $producto->codigo;
        $producto->nombre = $request->nombre;
        $producto->subcategorias_id = $request->subcategoria;
        $producto->modelos_id = $request->modelo;
        $producto->codigo = $codigo;
        $producto->fecha_lanzamiento = $request->fecha;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->save();

        //Detalles del productos
        $producto->detalles->dimensiones = $request->dimensiones;
        $producto->detalles->peso = $request->peso;
        $producto->detalles->material = $request->material;
        $producto->detalles->instrucciones_cuidado = $request->instrucciones_cuidado;
        $producto->detalles->instrucciones_montaje = $request->instrucciones_montaje;
        $producto->detalles->caracteristicas_especiales = $request->caracteristicas_especiales;
        $producto->detalles->compatibilidad = $request->compatibilidad;
        $producto->detalles->save();
        Session::flash('success', 'Se ha registrado la óperacion con éxito');
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $productos)
    {
        //
        $producto = Productos::findOrFail($productos->id);
        // Cambia el estado del producto
        $producto->estado = $producto->estado == 1 ? 0 : 1;
        $producto->save();
        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado del producto ha sido cambiado exitosamente.');
        return redirect()->route('productos.index');
    }
    /**
     * Tratamiento de variacion de colores del producto
     */
    public function colores()
    {

    }

    public function storecolores()
    {

    }

    public function editcolores()
    {

    }

    public function destroycolores()
    {

    }
    public function imagenes()
    {

    }

    public function storeimagenes()
    {

    }

    public function editimagenes()
    {

    }

    public function destroyimagenes()
    {
        
    }
}
