<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcas;
use App\Models\Marcas;
use App\Models\Imagen;
use App\Models\Pais;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            $result = $request->file('logo')->storeOnCloudinary('marcas');

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marcas $marcas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marcas $marcas)
    {
        //
    }
}
