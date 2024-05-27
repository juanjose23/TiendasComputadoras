<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use App\Models\Imagen;
use App\Models\Pais;
use App\Models\Personas;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Session;
class EmpresaController extends Controller
{
    //
    public function index()
    {
        $persona = Personas::first();
        $imagenes = Imagen::where('imagenable_type', 'App\Models\Personas')
            ->where('imagenable_id', $persona->id)
            ->get();
        return view('Gestion_Landing.Datos_empresas.index', compact('persona', 'imagenes'));
    }


    public function create()
    {

    }

    public function store()
    {

    }


    public function edit($empresa)
    {
        $personas=Personas::with(['persona_juridicas', 'direcciones'])->findOrFail($empresa);

        $datos = [
            'departamentos' => Departamentos::obtenerDepartamentosConMunicipios(),
            'paises' => Pais::obtenerPaises(),

        ];
        $imagenes = Imagen::where('imagenable_type', 'App\Models\Personas')
        ->where('imagenable_id', $empresa)
        ->get();
        return view('Gestion_Landing.Datos_empresas.edit', compact('datos','personas','imagenes'));
    }

    public function update($persona, Request $request)
    {
        // Obtener el empleado existente con sus relaciones
        $personas = Personas::with(['persona_juridicas', 'direcciones','imagenes'])
            ->find($persona);
        // Actualizar los valores de los atributos de la persona
        $personas->nombre = $request->nombre;
        $personas->correo = $request->correo;
        $personas->telefono = $request->telefono;

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('foto')) {
            // Subir la nueva imagen a Cloudinary y obtener el resultado
            $imagenes = $personas->imagenes;

            if ($imagenes) {
                $public_id = $imagenes['public_id'];
                cloudinary::destroy($public_id);
                Imagen::destroy($imagenes['id']);
            }


            $result = $request->file('foto')->storeOnCloudinary('empresa');

            // Crear una nueva entrada de imagen en la base de datos
            $imagen = new Imagen();
            $imagen->url = $result->getSecurePath();
            $imagen->public_id = $result->getPublicId();
            $imagen->imagenable_id = $personas->id;
            $imagen->imagenable_type = get_class($personas);
            $imagen->save();
            //return $result->getSecurePath();
        }


        // Actualizar los valores de los atributos de Persona juridica
        $personas->persona_juridicas->fecha_constitucional = $request->fecha;
        $personas->persona_juridicas->razon_social = $request->apellido;
        $personas->persona_juridicas->ruc = $request->identificacion;
        $personas->persona_juridicas->save();

        // Actualizar los valores de los atributos de las direcciones
        $personas->direcciones[0]->municipios_id = $request->departamentos;
        $personas->direcciones[0]->punto_referencia = $request->punto;
        $personas->direcciones[0]->direccion = $request->direccion;
        $personas->direcciones->each->save();
        Session::flash('success', 'Se ha actualizado correctamente el colaborador.');

        // Redireccionar de vuelta a la página de edición
        return redirect()->route('proveedores.index');
    }
}
