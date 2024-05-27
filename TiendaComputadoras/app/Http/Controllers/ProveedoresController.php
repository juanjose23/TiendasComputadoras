<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedores;
use App\Http\Requests\Updateproveedor;
use App\Models\Departamentos;
use App\Models\Direcciones;
use App\Models\Imagen;
use App\Models\Pais;
use App\Models\Persona_Juridicas;
use App\Models\Persona_Naturales;
use App\Models\Personas;
use App\Models\proveedores;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('Gestion_Compras.Proveedores.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $datos = [
            'departamentos' => Departamentos::obtenerDepartamentosConMunicipios(),
            'paises' => Pais::obtenerPaises(),

        ];

        return view('Gestion_Compras.Proveedores.create', compact('datos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedores $request)
    {

        // Crear una nueva instancia del modelo Persona
        $persona = new Personas();
        // Establecer los valores de los atributos
        $persona->nombre = $request->nombre;
        $persona->correo = $request->correo;
        $persona->telefono = $request->telefono;
        // Guardar la persona en la base de datos
        $persona->save();
        $ultimoId = $persona->id;

        if ($request->has('juridico')) {
            $personaJuridica = new Persona_Juridicas();
            // Establecer los valores de los atributos de PersonaNatural
            $personaJuridica->personas_id = $ultimoId;
            $personaJuridica->razon_social = $request->apellido;
            $personaJuridica->fecha_constitucional = $request->fecha;
            $personaJuridica->razon_social = $request->apellido;
            $personaJuridica->ruc = $request->identificacion;
            $personaJuridica->save();
        } else {
            // Crear una nueva instancia del modelo PersonaNatural
            $personaNatural = new Persona_Naturales();
            // Establecer los valores de los atributos de PersonaNatural
            $personaNatural->personas_id = $ultimoId;
            $personaNatural->apellido = $request->apellido;
            $personaNatural->fecha_nacimiento = $request->fecha;
            $personaNatural->tipo_identificacion = $request->tipo;
            $personaNatural->identificacion = $request->identificacion;
            $personaNatural->paises_id = $request->pais;
            $personaNatural->generos_id = 19;
            $personaNatural->save();
        }


        // Crear una nueva instancia del modelo proveedor
        $proveedor = new proveedores();
        // Establecer los valores de los atributos de proveedor
        $proveedor->personas_id = $ultimoId;
        $proveedor->paises_id = $request->pais;
        $proveedor->sector_comercial = $request->sector;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->estado = $request->estado;

        // Guardar el empleado en la base de datos
        $proveedor->save();
        if ($request->hasFile('foto')) {
            $result = $request->file('foto')->storeOnCloudinary('empleados', [
                'transformation' => [
                    [
                        'width' => 200,
                        'height' => 200,
                        'crop' => 'fill', // Esto llenará la imagen en lugar de cortarla
                        'gravity' => 'auto' // Esto centrará la imagen si la relación de aspecto cambia
                    ]
                ]
            ]);

            // Crear una nueva entrada de imagen en la base de datos
            $imagen = new Imagen();
            $imagen->url = $result->getSecurePath();
            $imagen->public_id = $result->getPublicId();
            $imagen->imagenable_id = $ultimoId;
            $imagen->imagenable_type = get_class($proveedor);
        }
        $direcciones = new Direcciones();
        $direcciones->municipios_id = $request->departamentos;
        $direcciones->personas_id = $ultimoId;
        $direcciones->punto_referencia = $request->punto;
        $direcciones->direccion = $request->direccion;
        $direcciones->estado = 1;
        $direcciones->save();
        Session::flash('success', 'Sea registrado correctamente el colaborador.');
        return redirect()->route('proveedores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(proveedores $proveedores)
    {
        //
        $imagenes = Imagen::where('imagenable_type', 'App\Models\Proveedores')
        ->where('imagenable_id', $proveedores->id)
        ->get();
        $proveedores = Proveedores::with(['personas', 'personas.persona_naturales', 'personas.persona_juridicas', 'personas.direcciones'])
        ->find($proveedores->id);

        return view('Gestion_Compras.Proveedores.show',compact('proveedores','imagenes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(proveedores $proveedores)
    {
        //
        $datos = [
            'departamentos' => Departamentos::obtenerDepartamentosConMunicipios(),
            'paises' => Pais::obtenerPaises()

        ];
        $proveedores = Proveedores::with(['personas', 'personas.persona_naturales', 'personas.persona_juridicas', 'personas.direcciones'])
            ->find($proveedores->id);

        $imagenes = Imagen::where('imagenable_type', 'App\Models\Proveedores')
            ->where('imagenable_id', $proveedores->id)
            ->get();

        return view('Gestion_Compras.Proveedores.edit', compact('datos', 'imagenes', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateproveedor $request, proveedores $proveedores)
    {
        //
        // Obtener el empleado existente con sus relaciones
        $proveedores = Proveedores::with(['personas', 'personas.persona_naturales', 'personas.persona_juridicas', 'personas.direcciones'])
            ->find($proveedores->id);
        // Actualizar los valores de los atributos de la persona
        $proveedores->personas->nombre = $request->nombre;
        $proveedores->personas->correo = $request->correo;
        $proveedores->personas->telefono = $request->telefono;

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('foto')) {
            // Subir la nueva imagen a Cloudinary y obtener el resultado
            $imagenes = $proveedores->imagenes;

            if ($imagenes) {
                $public_id = $imagenes['public_id'];
                Cloudinary::destroy($public_id);
                Imagen::destroy($imagenes['id']);
            }


            $result = $request->file('foto')->storeOnCloudinary('empleados');

            // Crear una nueva entrada de imagen en la base de datos
            $imagen = new Imagen();
            $imagen->url = $result->getSecurePath();
            $imagen->public_id = $result->getPublicId();
            $imagen->imagenable_id = $proveedores->id;
            $imagen->imagenable_type = get_class($proveedores);
            $imagen->save();
            //return $result->getSecurePath();
        }
        if ($request->has('juridico')) {

            // Actualizar los valores de los atributos de Persona juridica
            $proveedores->personas->persona_juridicas->fecha_constitucional = $request->fecha;
            $proveedores->personas->persona_juridicas->razon_social = $request->apellido;
            $proveedores->personas->persona_juridicas->ruc = $request->identificacion;
            $proveedores->personas->persona_juridicas->save();
        } else {

            // Actualizar los valores de los atributos de la persona natural
            $proveedores->personas->persona_naturales->apellido = $request->apellido;
            $proveedores->personas->persona_naturales->fecha_nacimiento = $request->fecha;
            $proveedores->personas->persona_naturales->tipo_identificacion = $request->tipo;
            $proveedores->personas->persona_naturales->identificacion = $request->identificacion;
            $proveedores->personas->persona_naturales->paises_id = $request->pais;
            $proveedores->personas->persona_naturales->generos_id = 19;
            $proveedores->personas->persona_naturales->save();
        }
        // Actualizar los valores de los atributos de las direcciones
        $proveedores->personas->direcciones[0]->municipios_id = $request->departamentos;
        $proveedores->personas->direcciones[0]->punto_referencia = $request->punto;
        $proveedores->personas->direcciones[0]->direccion = $request->direccion;

        $proveedores->paises_id = $request->pais;
        $proveedores->sector_comercial = $request->sector;
        $proveedores->descripcion = $request->descripcion;
        $proveedores->estado = $request->estado;

        // Guardar los cambios en la base de datos
        $proveedores->personas->save();

        $proveedores->personas->direcciones->each->save();
        $proveedores->save();

        // Comparar los atributos originales con los nuevos valores

        Session::flash('success', 'Se ha actualizado correctamente el colaborador.');

        // Redireccionar de vuelta a la página de edición
        return redirect()->route('proveedores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(proveedores $proveedores)
    {
        // Encuentra el cargo por su ID
        $proveedor = Proveedores::findOrFail($proveedores->id);
        // Cambia el estado del cargo
        $proveedor->estado = $proveedor->estado == 1 ? 0 : 1;
        $proveedor->save();
        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado del proveedor ha sido cambiado exitosamente.');

        return redirect()->route('proveedores.index');
    }
}
