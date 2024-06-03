<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Lotes extends Controller
{
    //
    public function index()
    {
        return view('Gestion_inventario.Lotes.index');
    }
}
