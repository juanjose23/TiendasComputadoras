<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductos;
use App\Http\Requests\UpdateProductos;
use App\Models\Colores;
use App\Models\Colores_productos;
use App\Models\Cortes;
use App\Models\Cortes_productos;
use App\Models\Cortesproductos;
use App\Models\Detalle_productos;
use App\Models\Genero;
use App\Models\Imagen;
use App\Models\Modelos;
use App\Models\Productos;
use App\Models\Subcategorias;
use App\Models\Tallas;
use App\Models\Tallas_productos;
use App\Models\Tallasproductos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $cortes = Cortes::where('estado', 1)->get();
        $tallas = Tallas::where('estado', 1)->get();
        $generos = Genero::obtenerGenero();
        return view('Gestion_Catalogos.Productos.create', compact('modelos', 'colores', 'subcategorias', 'generos', 'cortes', 'tallas'));
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


        //Tabla colores-productos
        $color = new Colores_productos();
        $color->productos_id = $Idproducto;
        $color->colores_id = $request->color;
        $color->estado = 1;
        $color->save();
        $Idcolor = $color->id;

        //Tabla cortes-productos
        $corte = new Cortes_productos();
        $corte->productos_id = $Idproducto;
        $corte->cortes_id = $request->corte;
        $corte->estado = 1;
        $corte->save();
        $Idcorte = $corte->id;

        //Tabla -productos
        $talla = new Tallas_productos();
        $talla->productos_id = $Idproducto;
        $talla->tallas_id = $request->talla;
        $talla->estado = 1;
        $talla->save();
        $Idtalla = $talla->id;

        //Detalles del productos
        $detalle = new Detalle_productos();
        $detalle->productos_id = $Idproducto;
        $detalle->coloresproductos_id = $Idcolor;
        $detalle->tallasproductos_id = $Idtalla;
        $detalle->cortesproductos_id = $Idcorte;
        $detalle->generos_id = $request->generos;
        $detalle->estado = 1;

        $detalle->save();
        Session::flash('success', 'Se ha registrado la óperacion con éxito');
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos  $productos)
    {
        //
        $productos = Productos::with(['modelos', 'modelos.marcas', 'subcategorias', 'subcategorias.categorias', 'detalles', 'coloresproductos', 'imagenes'])
            ->findOrFail($productos->id);

        $imagenes = Imagen::where('imagenable_type', 'App\Models\Productos')
            ->where('imagenable_id', $productos->id)
            ->get();



        return view('Gestion_Catalogos.Productos.show', compact('productos',  'imagenes'));
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
    public function multimedia($productos)
    {
        $producto = Productos::with(['modelos', 'modelos.marcas'])->find($productos);

        return view('Gestion_Catalogos.Productos.image.create', compact('producto'));
    }
    public function guardarmultimedia(Request $request)
    {
        $producto = Productos::findOrFail($request->producto);
        if ($request->hasFile('foto')) {
            // Subir la imagen a Cloudinary y obtener el resultado
            $result = $request->file('foto')->storeOnCloudinary('productos');

            // Crear una nueva entrada de imagen en la base de datos
            $imagen = new Imagen();
            $imagen->url = $result->getSecurePath();
            $imagen->public_id = $result->getPublicId();
            $imagen->imagenable_id = $producto->id;
            $imagen->imagenable_type = get_class($producto);
            $imagen->save();
            // Verificar si la imagen se guardó correctamente en la base de datos
            Session::flash('success', 'Se ha registrado correctamente la operación');
            return redirect()->route('productos.show', $producto->id);
        }
    }
    public function destroyimg($id)
    {
        // Lógica para eliminar la imagen asociada al producto con el ID proporcionado
        $logo =   Imagen::find($id);
        $public_id = $logo->public_id;
        Cloudinary::destroy($public_id);
        Imagen::destroy($logo->id);
        return redirect()->route('productos.show', $logo->imagenable_id);
    }

    /**
     *  Guardar detalles
     */

    public function agregarCorte($id)
    {
        $producto = Detalle_productos::with(['productos'])->find($id);
        $Idproductos = $producto->productos_id;
        $corte = Cortes_productos::ObtenerCortes($Idproductos);
        $cortes = Cortes_productos::with(['cortes'])->where('productos_id', $Idproductos)->get();

        return view('Gestion_Catalogos.Productos.Cortes.cortes', compact('producto', 'corte', 'cortes'));
    }

    public function guardarcorte(Request $request)
    {
        // Validar los campos de la solicitud
        $request->validate([
            'producto' => 'required|exists:productos,id',
            'cortes' => 'required|exists:colores,id',
            'estado' => 'required|in:0,1',
        ], [
            'producto.required' => 'El campo producto es obligatorio.',
            'producto.exists' => 'El producto seleccionado no existe en la base de datos.',
            'cortes.required' => 'El campo cortes es obligatorio.',
            'cortes.exists' => 'El corte seleccionado no existe en la base de datos.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.in' => 'El campo estado no esta seleccionado',
        ]);

        $corte = new Cortes_productos();
        $corte->productos_id = $request->producto;
        $corte->cortes_id = $request->cortes;
        $corte->estado = 1;
        $corte->save();
        $Idcorte = $corte->id;

        $Detalle = Detalle_productos::find($request->detalle);
        $detalle = new Detalle_productos();
        $detalle->productos_id = $Detalle->productos_id;
        $detalle->coloresproductos_id = $Detalle->coloresproductos_id;
        $detalle->tallasproductos_id = $Detalle->tallasproductos_id;
        $detalle->cortesproductos_id = $Idcorte;
        $detalle->generos_id = $Detalle->generos_id;
        $detalle->estado = 1;
        $detalle->save();
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
    }

    public function destroycortes($id)
    {
        $producto = Cortes_productos::findOrFail($id);
        // Cambia el estado del producto
        $producto->estado = $producto->estado == 1 ? 0 : 1;
        $producto->save();
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
    }

    //Tallas

    public function agregartallas($id)
    {
        $producto = Detalle_productos::with(['productos'])->find($id);
        $Idproductos = $producto->productos_id;
        $talla = Tallas_productos::ObtenerTallas($Idproductos);
        $tallas = Tallas_productos::with(['tallas'])->where('productos_id', $Idproductos)->get();

        return view('Gestion_Catalogos.Productos.Tallas.tallas', compact('producto', 'talla', 'tallas'));
    }
    public function guardartallas(Request $request)
    {
        $request->validate([
            'producto' => 'required|exists:productos,id',
            'tallas' => 'required|exists:colores,id',
            'estado' => 'required|in:0,1',
        ], [
            'producto.required' => 'El campo producto es obligatorio.',
            'producto.exists' => 'El producto seleccionado no existe en la base de datos.',
            'cortes.required' => 'El campo cortes es obligatorio.',
            'cortes.exists' => 'El corte seleccionado no existe en la base de datos.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.in' => 'El campo estado no esta seleccionado',
        ]);

        $talla = new Tallas_productos();
        $talla->productos_id = $request->producto;
        $talla->tallas_id = $request->tallas;
        $talla->estado = 1;
        $talla->save();
        $Idtalla = $talla->id;

        $Detalle = Detalle_productos::find($request->detalle);
        $detalle = new Detalle_productos();
        $detalle->productos_id = $Detalle->productos_id;
        $detalle->coloresproductos_id = $Detalle->coloresproductos_id;
        $detalle->tallasproductos_id = $Idtalla;
        $detalle->cortesproductos_id = $Detalle->cortesproductos_id;
        $detalle->generos_id = $Detalle->generos_id;
        $detalle->estado = 1;
        $detalle->save();
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
    }
    public function destroytallas($id)
    {
        $producto = Tallas_productos::findOrFail($id);
        // Cambia el estado del producto
        $producto->estado = $producto->estado == 1 ? 0 : 1;
        $producto->save();
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
    }


    // Nuevos detalles
    public function agregardetalles($id)
    {
        $producto = Productos::with(['subcategorias', 'subcategorias.categorias', 'modelos', 'modelos.marcas'])->find($id);
        $colores = Colores_productos::ObtenerColoresProductos($id);
        $tallas = Tallas_productos::ObtenerTallas($id);
        $cortes = Cortes_productos::ObtenerCortes($id);
        $generos = Genero::obtenerGenero();
        return view('Gestion_Catalogos.Productos.Detalles.detalles', compact('colores', 'tallas', 'cortes', 'generos', 'producto'));
    }

    public function guardardetalles(Request $request)
    {
        $request->validate([
            'productos' => 'required',
            'corte' => 'required',
            'color' => 'required',
            'genero' => 'required',
            'talla' => 'required'
        ]);

        $Idproducto = $request->productos;
        //Tabla colores-productos
        $color = new Colores_productos();
        $color->productos_id = $Idproducto;
        $color->colores_id = $request->color;
        $color->estado = 1;
        $color->save();
        $Idcolor = $color->id;

        //Tabla cortes-productos
        $corte = new Cortes_productos();
        $corte->productos_id = $Idproducto;
        $corte->cortes_id = $request->corte;
        $corte->estado = 1;
        $corte->save();
        $Idcorte = $corte->id;

        //Tabla -productos
        $talla = new Tallas_productos();
        $talla->productos_id = $Idproducto;
        $talla->tallas_id = $request->talla;
        $talla->estado = 1;
        $talla->save();
        $Idtalla = $talla->id;

        //Detalles del productos
        $detalle = new Detalle_productos();
        $detalle->productos_id = $Idproducto;
        $detalle->coloresproductos_id = $Idcolor;
        $detalle->tallasproductos_id = $Idtalla;
        $detalle->cortesproductos_id = $Idcorte;
        $detalle->generos_id = $request->genero;
        $detalle->estado = 1;

        $detalle->save();
        Session::flash('success', 'Se ha registrado la óperacion con éxito');
        return redirect()->route('productos.index');
    }

    public function destroydetalles($id)
    {
        $detalles = Detalle_productos::findorfail($id);
        // Cambia el estado del detalle
        $detalles->estado = $detalles->estado == 1 ? 0 : 1;
        $detalles->save();
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
    }
}
