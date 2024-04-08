<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCortes;
use App\Http\Requests\UpdateCortes;
use App\Models\Cortes;
use Illuminate\Http\Request;

class CortesController extends Controller
{
    //
    public function __construct()
    {
        // Aplica el middleware de autorización solo a los métodos "create" y "store"
        $this->middleware('can:create,App\Models\Productos')->only(['create', 'store']);
        $this->middleware('can:update,App\Models\Productos')->only(['edit', 'update']);
        $this->middleware('can:delete,App\Models\Productos')->only(['destroy']);
        // Aplica el middleware de autorización a todos los métodos excepto "index" y "show"
        $this->middleware('can:viewAny,App\Models\Productos')->except(['index', 'show']);
    }
    public function index()
    {
        return view("Gestion_Catalogos.Cortes.index");
    }

    public function create()
    {
        return view("Gestion_Catalogos.Cortes.create");
    }
    public function store(StoreCortes $request)
    {
        $corte = new Cortes();
        $corte->nombre = $request->nombre;
        $corte->descripcion = $request->descripcion;
        $corte->estado = $request->estado;
        $corte->save();
        return redirect()->route("cortes.index")->with("success", "Se ha realizado la operación con éxito");
    }



    public function edit(Cortes $cortes)
    {
        $cortes = Cortes::find($cortes->id);
        return view("Gestion_Catalogos.Cortes.edit", compact("cortes"));
    }

    public function update(UpdateCortes $request, $cortes)
    {
        $cortes = Cortes::findOrFail( $cortes);
        $cortes->nombre = $request->nombre;
        $cortes->descripcion = $request->descripcion;
        $cortes->estado = $request->estado;
        $cortes->save();
        return redirect()->route("cortes.index")->with("success","Se ha realizado la actulización con éxito");
    }

    public function destroy(Cortes $cortes)
    {
        $corte = Cortes::findOrFail( $cortes->id);
        $corte->estado = $corte->estado == 1 ? 0 : 1;
        $corte->save();
        return redirect()->route("cortes.index")->with("success","Se ha cambiado el estado correctamente");
    }
}
