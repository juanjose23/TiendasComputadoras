<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColaborador;
use App\Http\Requests\UpdateColaborador;
use App\Models\AsignacionCargos;
use App\Models\Direcciones;
use App\Models\Empleados;
use App\Models\Departamentos;
use App\Models\Estado_civiles;
use App\Models\Pais;
use App\Models\Genero;
use App\Models\Personas;
use App\Models\Persona_Naturales;
use App\Models\Imagen;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Salarios;


class ColaboradoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // Aplica el middleware de autorización solo a los métodos "create" y "store"
        $this->middleware('can:create,App\Models\Empleados')->only(['create', 'store']);
        $this->middleware('can:update,App\Models\Empleados')->only(['edit', 'update']);
        $this->middleware('can:delete,App\Models\Empleados')->only(['destroy']);
        // Aplica el middleware de autorización a todos los métodos excepto "index" y "show"
        $this->middleware('can:viewAny,App\Models\Empleados')->except(['index', 'show']);
    }

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


        // Guardar la persona en la base de datos
        $persona->save();
        $ultimoId = $persona->id;
        // Subir y guardar la foto en Cloudinary si se ha proporcionado
        
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
            $imagen->imagenable_type = get_class($empleado);
            

            // Crear una nueva entrada de imagen en la base de datos
            $imagen = new Imagen();
            $imagen->url = $result->getSecurePath();
            $imagen->public_id = $result->getPublicId();
            $imagen->imagenable_id = $ultimoId;
            $imagen->imagenable_type = get_class($empleado);
            $imagen->save();
        }
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
        $salario = Salarios::ObtenerSalarioColaborador($colaboradores->id);
        $cargo = AsignacionCargos::obtenerAsignacionesCargos($colaboradores->id);

        $historial = Salarios::obtenerHistorialSalarios($colaboradores->id);
        $imagenes = Imagen::where('imagenable_type', 'App\Models\Empleados')
            ->where('imagenable_id', $colaboradores->id)
            ->get();


        $cargos = AsignacionCargos::with(['cargos'])->where('empleados_id', $colaboradores->id)->get();
        return view('Gestion_Negocio.Colaborador.show', compact('empleados', 'salario', 'cargo', 'historial', 'cargos', 'imagenes'));
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

        $imagenes = Imagen::where('imagenable_type', 'App\Models\Empleados')
            ->where('imagenable_id', $colaboradores->id)
            ->get();
        return view('Gestion_Negocio.Colaborador.edit', compact('datos', 'empleados', 'imagenes'));
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

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('foto')) {
            // Subir la nueva imagen a Cloudinary y obtener el resultado
            $imagenes = $empleados->imagenes;

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
            $imagen->imagenable_id = $empleados->id;
            $imagen->imagenable_type = get_class($empleados);
            $imagen->save();
            //return $result->getSecurePath();
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
        $empleados->estado_civiles_id = $request->estado_civil;
        $empleados->codigo_inss = $request->inss;
        $empleados->estado = $request->estado;

        // Guardar los cambios en la base de datos
        $empleados->personas->save();
        $empleados->personas->persona_naturales->save();
        $empleados->personas->direcciones->each->save();
        $empleados->save();

        // Comparar los atributos originales con los nuevos valores

        Session::flash('success', 'Se ha actualizado correctamente el colaborador.');

        // Redireccionar de vuelta a la página de edición
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
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

    public function pdf($colaboradores)
    {
        $empleados = Empleados::with(['personas', 'personas.persona_naturales', 'personas.direcciones'])
            ->find($colaboradores);
        $salario = Salarios::ObtenerSalarioColaborador($colaboradores->id);
        $cargo = AsignacionCargos::obtenerAsignacionesCargos($colaboradores->id);

        $historial = Salarios::obtenerHistorialSalarios($colaboradores->id);
        $imagenes = Imagen::where('imagenable_type', 'App\Models\Empleados')
            ->where('imagenable_id', $colaboradores->id)
            ->get();
            $cargos = AsignacionCargos::with(['cargos'])->where('empleados_id', $colaboradores->id)->get();
        $pdf = Pdf::loadView('Gestion_Negocio.Colaborador.pdf', compact('empleados', 'salario', 'cargo', 'historial', 'cargos','imagenes'));
        $pdf->set_paper('A5');

        // Envía el PDF generado al navegador
        return $pdf->download('empleado'+''+$empleados->codigo+'.pdf');
    }
}
