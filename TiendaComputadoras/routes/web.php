<?php

use App\Http\Controllers\CargosController;
use App\Http\Controllers\ColaboradoresController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cargos',CargosController::class)->parameters(['cargos'=>'cargos'])->names('cargos');
Route::resource('colaboradores',ColaboradoresController::class)->parameters(['colaboradores'=>'colaboradores'])->names('colaboradores');