<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrecios;
use App\Models\Colores;
use App\Models\Colores_productos;
use Illuminate\Http\Request;
use App\Models\Precios;
use Illuminate\Support\Facades\Session;

class PreciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       /* $productos = Precios::with([
            'productoscolores',
            'productoscolores.colores',
            'productoscolores.productos',
            'productoscolores.productos.modelos',
            'productoscolores.productos.modelos.marcas',
            'productoscolores.productos.subcategorias',
            'productoscolores.productos.subcategorias.categorias',
            'productoscolores.productos.detalles'
        ])->get();
        
        return $productos;*/
        
         return view('Gestion_Catalogos.Precios.index');
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
        // Verificar si se aceptaron los términos
        if ($request->has('terminos')) {
            // Obtener el ID del producto
            $idProducto = Colores_productos::BuscarIdproducto($request->producto);

            $coloresOmitir = $request->input('colores-omitir');

            // Verificar si hay valores para colores-omitir y convertirlo en un array vacío si es null
            if ($coloresOmitir === null) {
                $coloresOmitir = [];
            }

            // Buscar todos los colores relacionados con el producto excluyendo aquellos que se deben omitir
            $coloresProductos = Colores_productos::where('productos_id', $idProducto)
                ->whereNotIn('id', $coloresOmitir)
                ->get();

            // Guardar el precio para cada color
            foreach ($coloresProductos as $colorProducto) {
                var_dump($colorProducto);
                $this->guardarPrecio($colorProducto->id, $request->precio, $request->estado);
            }
        } else {
            // Si no se aceptaron los términos, guardar solo un precio sin asociarlo a un color específico
            $this->guardarPrecio($request->producto, $request->precio, $request->estado);
        }
        Session::flash('success','Se ha registrado el precio de manera éxitosa');
        return redirect()->route('precios.index');
    }
    protected function guardarPrecio($productoId, $precio, $estado)
    {
        $nuevoPrecio = new Precios();
        $nuevoPrecio->productoscolores_id = $productoId; 
        $nuevoPrecio->precio = $precio;
        $nuevoPrecio->estado = $estado;
        // Guardar el precio
        $nuevoPrecio->save();
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
