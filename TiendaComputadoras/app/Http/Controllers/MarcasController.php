<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcas;
use App\Http\Requests\UpdateMarcas;
use App\Models\Marcas;
use App\Models\Imagen;
use App\Models\Pais;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Transformation\Resize;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class MarcasController extends Controller
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
       
        return view('Gestion_Catalogos.Marcas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $paises = Pais::where('estado', 1)->get();
        return view('Gestion_Catalogos.Marcas.create', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarcas $request)
    {
        //
        $marcas = new Marcas();
        $marcas->nombre = $request->nombre;
        $marcas->paises_id = $request->pais;
        $marcas->descripcion = $request->descripcion;
        $marcas->sitio_web = $request->sitio;
        $marcas->estado = $request->estado;
        $marcas->save(); // Guardar el modelo Marcas en la base de datos

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('logo')) {
            // Subir la imagen a Cloudinary y obtener el resultado
            $result = $request->file('logo')->storeOnCloudinary('marcas', [
                'transform' => [
                    // Resize options here
                    'width' => 100, // Resize to 200px width
                    'height' => 100, // Resize to 100px height
                    'crop' => 'fill' // Maintain aspect ratio (optional)
                ]
            ]);

            // Crear una nueva entrada de imagen en la base de datos
            $imagen = new Imagen();
            $imagen->url = $result->getSecurePath();
            $imagen->public_id = $result->getPublicId();
            $imagen->imagenable_id = $marcas->id;
            $imagen->imagenable_type = get_class($marcas);
            $imagen->save();
            // Verificar si la imagen se guardó correctamente en la base de datos
           
        }
        Session::flash('success', 'Se ha registrado correctamente la operación');
        return redirect()->route('marcas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Marcas $marcas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marcas $marcas)
    {
        //
        $imagen = $marcas->imagenes;
        $paises = Pais::where('estado', 1)->get();
        return view('Gestion_Catalogos.Marcas.edit', compact('paises','imagen','marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarcas $request, Marcas $marcas)
    {
        // Encuentra la marca existente
        $marcas = Marcas::findOrFail($marcas->id);
        //return $marcas->imagenes;
        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('logo')) {
            // Subir la nueva imagen a Cloudinary y obtener el resultado
            $imagenes = $marcas->imagenes;

            foreach ($imagenes as $imagen) {
                $public_id = $imagen['public_id'];
                Cloudinary::destroy($public_id);
                Imagen::destroy($imagen['id']);
                
            }
            $result = $request->file('logo')->storeOnCloudinary('marcas');
    
            // Crear una nueva entrada de imagen en la base de datos
            $imagen = new Imagen();
            $imagen->url = $result->getSecurePath();
            $imagen->public_id = $result->getPublicId();
            $imagen->imagenable_id = $marcas->id;
            $imagen->imagenable_type = get_class($marcas);
            $imagen->save();
        }
    
        // Actualizar los campos de la marca con los datos del formulario
        $marcas->nombre = $request->nombre;
        $marcas->paises_id = $request->pais;
        $marcas->sitio_web = $request->sitio;
        $marcas->descripcion = $request->descripcion;
        $marcas->estado = $request->estado;
        $marcas->save();
    
        // Mostrar mensaje solo si hay cambios
        Session::flash('success', 'El proceso se ha completado exitosamente.');
    
        return redirect()->route('marcas.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($marcas)
    {
        //
          // Encuentra el cargo por su ID
          $marca = Marcas::findOrFail($marcas);

          // Cambia el estado del cargo
          $marca->estado = $marca->estado == 1 ? 0 : 1;
          $marca->save();
          // Redirige de vuelta a la página de índice con un mensaje flash
          Session::flash('success', 'El estado del marcas ha sido cambiado exitosamente.');
  
          return redirect()->route('marcas.index');
    }
}
