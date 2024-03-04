<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalarios;
use Illuminate\Http\Request;
use App\Models\Salarios;
use Illuminate\Support\Facades\Session;
use App\Models\Empleados;

class SalariosController extends Controller
{
    //
    public function index()
    {
        return view('Gestion_Negocio.Salarios.index');
    }
    public function create()
    {
        $empleados = Empleados::where('estado', 1)->with(['personas', 'personas.persona_naturales'])
            ->whereNotIn('id', function ($query) {
                $query->select('empleados_id')->from('salarios');
            })->get();
        return view('Gestion_Negocio.Salarios.create', compact('empleados'));
    }
    public function store(StoreSalarios $request)
    {
        $salarios = new Salarios();
        $salarios->empleados_id = $request->empleados;
        $salarios->salario = $request->salario;
        $salarios->estado = $request->estado;
        $salarios->save();
        Session::flash('success', 'Se ha registrado correctamente la operación');
        return redirect()->route('salarios.index');
    }

    public function show()
    {
        return view('Gestion_Negocio.Salarios.index');
    }

    public function edit(Salarios $salarios)
    {
        $empleados = Empleados::with(['personas', 'personas.persona_naturales'])
            ->find($salarios->empleados_id);
        $salarios = Salarios::where('empleados_id', $salarios->empleados_id)->get();

        return view('Gestion_Negocio.Salarios.edit', compact('empleados', 'salarios'));
    }

    public function update(StoreSalarios $request, $salarios)
    {

        $salario = Salarios::where('estado', 1)
            ->where('empleados_id', $salarios)
            ->first();
        // Verificar si se encontró el salario
        if ($salario) {

            $salario->estado = 2;
            $salario->save();
        }
        $nomina = new Salarios();
        $nomina->empleados_id = $request->empleados;
        $nomina->salario = $request->salario;
        $nomina->estado = $request->estado;
        $nomina->save();
        Session::flash('success', 'Se ha registrado correctamente la operación');
        return redirect()->route('salarios.edit', $nomina->empleados);
    }

    public function destroy($salarios)
    {
        $salario = Salarios::find($salarios);
        if ($salario) {

            $salario->estado = 2;
            $salario->save();
            Session::flash('success', 'Se ha registrado correctamente la operación');
            return redirect()->route('salarios.edit', $salario->empleados_id);
        }
    }
}
