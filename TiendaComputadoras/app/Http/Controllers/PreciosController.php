<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrecios;
use App\Http\Requests\UpdatePrecios;
use App\Models\Colores_productos;
use App\Models\Detalle_productos;
use App\Models\Precios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PreciosController extends Controller
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
        return view('Gestion_Catalogos.Precios.index');
    }

    //
    public function create()
    {
        $Precios = new Precios();
        $productos=$Precios->ObtenerProductosConCategorias();
        //return $productos;
       return view('Gestion_Catalogos.Precios.create', compact('productos'));
    }

    public function store(StorePrecios $request)
    {
        try {

           
           
            // Verificar si se aceptaron los términos
            if ($request->filled('terminos')) {
               
                // Obtener el ID del producto
                $idProducto = Detalle_productos::BuscarIdproducto($request->producto);

                $coloresOmitir = $request->input('colores-omitir', []);

                // Buscar todos los colores relacionados con el producto excluyendo aquellos que se deben omitir
                $coloresProductos = Detalle_productos::where('productos_id', $idProducto)
                    ->whereNotIn('id', $coloresOmitir)
                    ->get();

                // Guardar el precio para cada color
                foreach ($coloresProductos as $colorProducto) {
                    Precios::BuscarPreciosProductos($colorProducto->id);
                    $this->guardarPrecio($colorProducto->id, $request->precio, $request->estado);
                }
            } else {
               
                // Si no se aceptaron los términos, guardar solo un precio sin asociarlo a un color específico
                $this->guardarPrecio($request->producto, $request->precio, $request->estado);
            }
            
            Session::flash('success', 'Se ha registrado el precio de manera exitosa.');
            return redirect()->route('precios.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Ocurrió un error al intentar registrar el precio.');
          echo $e->getMessage();
           // return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
    //
    public function edit(Precios $precios)
    {
        $precio = Precios::with([
        'productosdetalles',
        'productosdetalles.coloresproductos.colores',
        'productosdetalles.productos',
        'productosdetalles.productos.modelos',
        'productosdetalles.productos.modelos.marcas',
        'productosdetalles.productos.subcategorias',
        'productosdetalles.productos.subcategorias.categorias'])->findOrFail($precios->id);
        $idProducto = Detalle_productos::BuscarIdproducto($precios->productosdetalles_id);
        $excluirId = $precios->productosdetalles_id;

        $colores = Detalle_productos::with([
            'productos', 
            'tallasproductos', 
            'cortesproductos', 
            'tallasproductos.tallas', 
            'cortesproductos.cortes', 
            'coloresproductos', 
            'coloresproductos.colores', 
            'productos.modelos.marcas', 
            'productos.subcategorias.categorias', 
            'productos.subcategorias', 
            'generos'
        ])
        ->where('productos_id', $idProducto)
        ->where('id', '!=', $excluirId)
        ->where('estado',1)
        ->get();
   
        return view('Gestion_Catalogos.Precios.edit', compact('precio', 'colores'));
    }
    public function update(UpdatePrecios $request, $precios)
    {
        //Cambiar estado del precio anterior
        $precio = Precios::findOrFail($precios);
        $precio->estado = 2;
        $precio->save();
        //Establecer Los nuevos precios
        try {
            // Verificar si se aceptaron los términos
            if ($request->filled('terminos')) {
                // Obtener el ID del producto
                $idProducto = Colores_productos::BuscarIdproducto($request->producto);

                $coloresOmitir = $request->input('colores-omitir', []);

                // Buscar todos los colores relacionados con el producto excluyendo aquellos que se deben omitir
                $coloresProductos = Detalle_productos::where('productos_id', $idProducto)
                    ->whereNotIn('id', $coloresOmitir)
                    ->get();

                // Guardar el precio para cada color
                foreach ($coloresProductos as $colorProducto) {
                    Precios::BuscarPreciosProductos($colorProducto->id);
                    $this->guardarPrecio($colorProducto->id, $request->precio, $request->estado);
                }
            } else {
                // Si no se aceptaron los términos, guardar solo un precio sin asociarlo a un color específico
                $this->guardarPrecio($request->producto, $request->precio, $request->estado);
            }

            Session::flash('success', 'Se ha registrado el precio de manera exitosa.');
            return redirect()->route('precios.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Ocurrió un error al intentar registrar el precio.');
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
    public function show(Precios $precios)
    {
        $precio = Precios::with([
            'productosdetalles',
            'productosdetalles.coloresproductos.colores',
            'productosdetalles.productos',
            'productosdetalles.productos.modelos',
            'productosdetalles.productos.modelos.marcas',
            'productosdetalles.productos.subcategorias',
            'productosdetalles.productos.subcategorias.categorias'])->findOrFail($precios->id);
        $historial = Precios::where('productosdetalles_id',$precio->productosdetalles_id)->get();

        return  view('Gestion_Catalogos.Precios.show', compact('precio', 'historial'));
    }
    public function destroy(Precios $precios)
    {
         //Cambiar estado del precio anterior
         $precio = Precios::findOrFail($precios->id);
         $precio->estado = 2;
         $precio->save();

         Session::flash('success', 'Se ha registrado el cambio de estado de manera exitosa.');
         return redirect()->route('precios.index');
    }
    protected function guardarPrecio($productoId, $precio, $estado)
    {
        $nuevoPrecio = new Precios();
        $nuevoPrecio->productosdetalles_id = $productoId;
        $nuevoPrecio->precio = $precio;
        $nuevoPrecio->estado = $estado;
        // Guardar el precio
        $nuevoPrecio->save();
    }
}
