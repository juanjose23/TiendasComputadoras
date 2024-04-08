<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorias;
use App\Http\Requests\UpdateCategorias;
use App\Models\Categorias;
use App\Models\Subcategorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriasController extends Controller
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

        return view('Gestion_Catalogos.Categorias.index');
    }
    //
    public function create()
    {
        return view('Gestion_Catalogos.Categorias.create');
    }
    //
    public function store(StoreCategorias $request)
    {
        $categoria = new Categorias();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->estado = $request->estado;
        $categoria->save();
        Session::flash('success', 'Se ha registado correctamente la operación');
        return redirect()->route('categorias.index');
    }
    //
    public function show($categorias)
    {
        $categoria = Categorias::findOrFail($categorias);
        $subcategorias = Subcategorias::where('categorias_id', $categorias)->get();

        return view('Gestion_Catalogos.Categorias.show', compact('categoria', 'subcategorias'));
    }
    //
    public function edit($categorias)
    {
        $categorias = Categorias::findOrFail($categorias);

        return view('Gestion_Catalogos.Categorias.edit', compact('categorias'));
    }
    //
    public function update(UpdateCategorias $request, $categorias)
    {
        $categoria = Categorias::findOrFail($categorias);
        // Verificar si los datos han cambiado
        if (

            $categoria->nombre != $request->nombre ||
            $categoria->descripcion != $request->descripcion ||
            $categoria->estado != $request->estado
        ) {


            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->estado = $request->estado;
            $categoria->save();

            // Mostrar mensaje solo si hay cambios
            Session::flash('success', 'El proceso se ha completado exitosamente.');
        }

        return redirect()->route('categorias.index');
    }
    //
    public function destroy($categorias)
    {
        // Encuentra el cargo por su ID
        $categoria = Categorias::findOrFail($categorias);

        // Cambia el estado del cargo
        $categoria->estado = $categoria->estado == 1 ? 0 : 1;
        $categoria->save();
        Subcategorias::where('categorias_id', $categorias)->update(['estado' => 2]);
        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado del categoria ha sido cambiado exitosamente.');

        return redirect()->route('categorias.index');
    }
}
