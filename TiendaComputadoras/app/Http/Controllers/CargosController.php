<?php

namespace App\Http\Controllers;

use App\Http\Requests\CargoStore;
use App\Http\Requests\UpdateCargos;
use App\Models\Cargos;
use Illuminate\Support\Facades\Session;

class CargosController extends Controller
{


    //Metodos para la vista.
    public function index()
    {

        return view('Gestion_Negocio.Cargos.index');
    }
    public function create()
    {
        return view('Gestion_Negocio.Cargos.create');
    }
    public function store(CargoStore $request)
    {
        $Cargos = new Cargos();
        $perfil = $request->perfil;
        $Cargos->codigo = $Cargos->generarCodigo($perfil);
        $Cargos->nombre = $request->nombre;
        $Cargos->perfil = $request->perfil;
        $Cargos->descripcion = $request->descripcion;
        $Cargos->estado = $request->estado;
        $Cargos->save();
        Session::flash('success', 'El proceso se ha completado exitosamente.');
        return redirect()->route('cargos.index');
    }
    public function edit($cargos)
    {
        $cargos = Cargos::findOrFail($cargos);

        return view('Gestion_Negocio.Cargos.edit', compact('cargos'));
    }

    public function update(UpdateCargos $request, $cargos)
    {
        $cargo = Cargos::findOrFail($cargos);

        // Verificar si los datos han cambiado
        if (
            $cargo->codigo != $request->codigo ||
            $cargo->nombre != $request->nombre ||
            $cargo->perfil != $request->perfil ||
            $cargo->descripcion != $request->descripcion ||
            $cargo->estado != $request->estado
        ) {

            // Actualizar los campos del cargo con los datos del formulario
            $cargo->codigo = $request->codigo;
            $cargo->nombre = $request->nombre;
            $cargo->perfil = $request->perfil;
            $cargo->descripcion = $request->descripcion;
            $cargo->estado = $request->estado;
            $cargo->save();

            // Mostrar mensaje solo si hay cambios
            Session::flash('success', 'El proceso se ha completado exitosamente.');
        }

        return redirect()->route('cargos.index');
    }

    public function destroy($cargos)
    {
        // Encuentra el cargo por su ID
        $cargo = Cargos::findOrFail($cargos);

        // Cambia el estado del cargo
        $cargo->estado = $cargo->estado == 1 ? 0 : 1;
        $cargo->save();

        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado del cargo ha sido cambiado exitosamente.');

        return redirect()->route('cargos.index');
        
    }
}
