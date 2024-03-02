<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColaborador;
use App\Http\Requests\UpdateColaborador;
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
use Barryvdh\DomPDF\Facade\Pdf;



class ColaboradoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

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
        $empleados = Empleados::with(['personas', 'personas.persona_naturales', 'personas.direcciones'])
        ->find($colaboradores->id);
        return view('Gestion_Negocio.Colaborador.show',compact('empleados'));
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
        $empleados = Empleados::with(['personas', 'personas.persona_naturales', 'personas.direcciones'])
        ->find($colaboradores->id);
    
       
        return view('Gestion_Negocio.Colaborador.edit', compact('datos', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColaborador $request, Empleados $colaboradores)
    {
        // Obtener el empleado existente con sus relaciones
        $empleados = Empleados::with(['personas', 'personas.persona_naturales', 'personas.direcciones'])
            ->find($colaboradores->id);


        // Actualizar los valores de los atributos de la persona
        $empleados->personas->nombre = $request->nombre;
        $empleados->personas->correo = $request->correo;
        $empleados->personas->telefono = $request->telefono;

        // Subir y guardar la nueva foto en Cloudinary si se ha proporcionado
        if ($request->hasFile('foto')) {
            $foto = $request->foto;
            $result = $request->file('foto')->storeOnCloudinary('empleados');

            // Eliminar la foto anterior de Cloudinary
            if ($empleados->personas->foto_id) {
                Cloudinary::destroy($empleados->personas->foto_id);
            }

            // Guardar la nueva URL de la foto
            $empleados->personas->foto = $result->getSecurePath();
        }
        
        // Actualizar los valores de los atributos de la persona natural
        $empleados->personas->persona_naturales->apellido = $request->apellido;
        $empleados->personas->persona_naturales->fecha_nacimiento = $request->fecha;
        $empleados->personas->persona_naturales->tipo_identificacion = $request->tipo;
        $empleados->personas->persona_naturales->identificacion = $request->identificacion;
        $empleados->personas->persona_naturales->paises_id = $request->pais;
        $empleados->personas->persona_naturales->generos_id = $request->genero;

        // Actualizar los valores de los atributos de las direcciones
        $empleados->personas->direcciones[0]->municipios_id = $request->departamentos;
        $empleados->personas->direcciones[0]->punto_referencia = $request->punto;
        $empleados->personas->direcciones[0]->direccion = $request->direccion;
        //Actualizar los valores de los atributos de los empleados
        $empleados->estado_civiles_id=$request->estado_civil;
        $empleados->codigo_inss=$request->inss;
        $empleados->estado=$request->estado;

        // Guardar los cambios en la base de datos
        $empleados->personas->save();
        $empleados->personas->persona_naturales->save();
        $empleados->personas->direcciones->each->save();
        $empleados->save();

        // Comparar los atributos originales con los nuevos valores

        Session::flash('success', 'Se ha actualizado correctamente el colaborador.');

        // Redireccionar de vuelta a la página de edición
        return redirect()->route('colaboradores.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($colaboradores)
    {
        //
         // Encuentra el cargo por su ID
         $empleados = Empleados::findOrFail($colaboradores);

         // Cambia el estado del cargo
         $empleados->estado = $empleados->estado == 1 ? 2 : 1;
         $empleados->save();
 
         // Redirige de vuelta a la página de índice con un mensaje flash
         Session::flash('success', 'El estado del colaborador ha sido cambiado exitosamente.');
 
         return redirect()->route('colaboradores.index');
         
    }

    public function pdf()
    {
        $pdf = Pdf::loadView('report.empleados');
        $pdf->set_paper('A3', 'landscape');
      
       // Envía el PDF generado al navegador
       return $pdf->stream('documento.pdf');
    }
}
