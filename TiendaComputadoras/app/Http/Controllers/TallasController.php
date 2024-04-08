<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTallas;
use App\Http\Requests\Updatetallas;
use App\Models\Tallas;
use Illuminate\Http\Request;

class TallasController extends Controller
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
        return view("Gestion_Catalogos.Tallas.index");
    }

    public function create()
    {
        return view("Gestion_Catalogos.Tallas.create");
    }
    public function store(StoreTallas $request)
    {
        $talla = new Tallas();
        $talla->nombre = $request->nombre;
        $talla->descripcion = $request->descripcion;
        $talla->estado = $request->estado;
        $talla->save();
        return redirect()->route("tallas.index")->with("success", "Se ha realizado la operación con éxito");
    }



    public function edit( Tallas $tallas)
    {
        $tallas = Tallas::find($tallas->id);
        return view("Gestion_Catalogos.Tallas.edit", compact("tallas"));
    }

    public function update(Updatetallas $request, $tallas)
    {
        $tallas = Tallas::findOrFail( $tallas);
        $tallas->nombre = $request->nombre;
        $tallas->descripcion = $request->descripcion;
        $tallas->estado = $request->estado;
        $tallas->save();
        return redirect()->route("tallas.index")->with("success","Se ha realizado la actulización con éxito");
    }

    public function destroy(Tallas $tallas)
    {
        $tallas = Tallas::findOrFail( $tallas->id);
        $tallas->estado = $tallas->estado == 1 ? 0 : 1;
        $tallas->save();
        return redirect()->route("tallas.index")->with("success","Se ha cambiado el estado correctamente");
    }
}
