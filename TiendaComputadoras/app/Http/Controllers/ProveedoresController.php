<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedores;
use App\Models\Departamentos;
use App\Models\Direcciones;
use App\Models\Imagen;
use App\Models\Pais;
use App\Models\Persona_Juridicas;
use App\Models\Persona_Naturales;
use App\Models\Personas;
use App\Models\proveedores;

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
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(proveedores $proveedores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, proveedores $proveedores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(proveedores $proveedores)
    {
        //
    }
}
