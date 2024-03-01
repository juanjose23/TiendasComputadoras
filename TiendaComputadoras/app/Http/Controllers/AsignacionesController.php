<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionCargos;
use App\Http\Requests\StoreAsignacion;
use App\Models\Cargos;
use App\Models\Empleados;
use Illuminate\Support\Facades\Session;

class AsignacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('Gestion_Negocio.Historial_cargos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $datos = [
            'empleados' => Empleados::where('estado', 1)->with(['personas', 'personas.persona_naturales'])
                ->whereNotIn('id', function ($query) {
                    $query->select('empleados_id')->from('asignacion_cargos');
                })->get(),
            'cargos' => Cargos::where('estado', 1)->get(),
        ];
        // return $datos;
        return view('Gestion_Negocio.Historial_cargos.create', compact('datos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAsignacion $request)
    {

        $asignacion = new AsignacionCargos();
        $asignacion->empleados_id = $request->empleados;
        $asignacion->cargos_id = $request->cargos;
        $asignacion->estado = $request->estado;
        $asignacion->save();
        Session::flash('success', 'Se ha registrado la operación con éxito');
        return redirect()->route('asignaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $empleados = Empleados::with(['personas', 'personas.persona_naturales'])
        ->find($id);
        $asignacion=AsignacionCargos::with(['empleados','empleados.personas','cargos'])->where('empleados_id',$id)->get();
        return view('Gestion_Negocio.Historial_cargos.show', compact('empleados','asignacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $cargos = Cargos::where('estado', 1)->whereNotIn('id', function ($query) use ($id) {
            $query->select('cargos_id')->from('asignacion_cargos')->where('empleados_id', $id);
        })->get();
    
        $empleados = Empleados::with(['personas', 'personas.persona_naturales'])
        ->find($id);
        $asignacion=AsignacionCargos::with(['empleados','empleados.personas','cargos'])->where('empleados_id',$id)->get();
        //return $empleados;
        return view('Gestion_Negocio.Historial_cargos.edit', compact('cargos','empleados','asignacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAsignacion $request, string $id)
    {
        //
        $asignacion = new AsignacionCargos();
        $asignacion->empleados_id = $request->empleados;
        $asignacion->cargos_id = $request->cargos;
        $asignacion->estado = $request->estado;
        $asignacion->save();
        Session::flash('success', 'Se ha registrado la operación con éxito');
        return redirect()->route('asignaciones.edit',$id);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($asignaciones)
    {
        //
        //
         // Encuentra el cargo por su ID
         $empleados = AsignacionCargos::findOrFail($asignaciones);

         // Cambia el estado del cargo
         $empleados->estado = $empleados->estado == 1 ? 2 : 1;
         $empleados->save();
         
         // Redirige de vuelta a la página de índice con un mensaje flash
         Session::flash('success', 'El estado de la asignación ha sido cambiado exitosamente.');
 
         return redirect()->route('asignaciones.edit',$empleados->empleados_id);
    }
}
