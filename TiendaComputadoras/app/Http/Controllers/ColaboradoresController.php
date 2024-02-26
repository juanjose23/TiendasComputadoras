<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColaborador;
use App\Models\Direcciones;
use App\Models\Empleados;
use App\Models\Departamentos;
use App\Models\Estado_civiles;
use App\Models\Pais;
use App\Models\Genero;
use App\Models\Personas;
use App\Models\Persona_Naturales;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class ColaboradoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos = Personas::with(['persona_natural','empleados'])
            ->get();
        return view('Gestion_Negocio.Colaborador.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datos = [
            'departamentos' => Departamentos::obtenerDepartamentosConMunicipios(),
            'paises' => Pais::obtenerPaises(),
            'generos' => Genero::obtenerGenero(),
            'estadosCiviles' => Estado_civiles::obtenerEstados(),
        ];


        return view('Gestion_Negocio.Colaborador.Create', compact('datos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColaborador $request)
    {
        // Crear una nueva instancia del modelo Persona
        $persona = new Personas();
        // Establecer los valores de los atributos
        $persona->nombre = $request->nombre;
        $persona->correo = $request->correo;
        $persona->telefono = $request->telefono;
        // Subir y guardar la foto en Cloudinary si se ha proporcionado
        if ($request->hasFile('foto')) {
            $foto = $request->foto;
            $result = $request->file('foto')->storeOnCloudinary('empleados');
            $persona->foto = $result->getSecurePath();
        }

        // Guardar la persona en la base de datos
        $persona->save();
        $ultimoId = $persona->id;
        // Crear una nueva instancia del modelo PersonaNatural
        $personaNatural = new Persona_Naturales();
        // Establecer los valores de los atributos de PersonaNatural
        $personaNatural->personas_id = $ultimoId;
        $personaNatural->apellido = $request->apellido;
        $personaNatural->fecha_nacimiento = $request->fecha;
        $personaNatural->tipo_identificacion = $request->tipo;
        $personaNatural->identificacion = $request->identificacion;
        $personaNatural->paises_id = $request->pais;
        $personaNatural->generos_id = $request->genero;
        $personaNatural->save();
        // Crear una nueva instancia del modelo Empleados
        $empleado = new Empleados();
        // Establecer los valores de los atributos de Empleados
        $empleado->personas_id = $ultimoId;
        $empleado->estado_civiles_id = $request->estado_civil;
        $empleado->codigo = $empleado->generarCodigo(); // Debes generar un código único aquí
        $empleado->codigo_inss = $request->inss;
        $empleado->estado = $request->estado;

        // Guardar el empleado en la base de datos
        $empleado->save();
        $direcciones = new Direcciones();
        $direcciones->municipios_id = $request->departamentos;
        $direcciones->personas_id = $ultimoId;
        $direcciones->punto_referencia = $request->punto;
        $direcciones->direccion = $request->direccion;
        $direcciones->estado = 1;
        $direcciones->save();
        Session::flash('success', 'Sea registrado correctamente el colaborador.');
        return redirect()->route('colaboradores.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Empleados $colaboradores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleados $colaboradores)
    {
        //
        $datos = [
            'departamentos' => Departamentos::obtenerDepartamentosConMunicipios(),
            'paises' => Pais::obtenerPaises(),
            'generos' => Genero::obtenerGenero(),
            'estadosCiviles' => Estado_civiles::obtenerEstados(),
        ];


        return view('Gestion_Negocio.Colaborador.edit', compact('datos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleados $colaboradores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleados $colaboradores)
    {
        //
    }
}
