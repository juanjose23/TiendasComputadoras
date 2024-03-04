<?php

use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\SalariosController;
use App\Http\Controllers\ExportacionesController;

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

Route::resource('cargos', CargosController::class)->parameters(['cargos' => 'cargos'])->names('cargos');
Route::resource('colaboradores', ColaboradoresController::class)->parameters(['colaboradores' => 'colaboradores'])->names('colaboradores');
Route::resource('asignaciones', AsignacionesController::class)->parameters(['asignaciones' => 'asignaciones'])->names('asignaciones');
Route::resource('salarios', SalariosController::class)->parameters(['salarios' => 'salarios'])->names('salarios');



//Rutas para exportacion y reportes
Route::get('/exportcargosexcel', [ExportacionesController::class, 'exportcargosexcel'])->name('exportcargosexcel');
Route::get('/exportcargopdf', [ExportacionesController::class, 'exportcargopdf'])->name('exportcargopdf');
Route::get('/exportColaboradores', [ExportacionesController::class, 'exportColaboradores'])->name('exportColaboradores');
Route::get('/exportColaboradorespdf', [ExportacionesController::class, 'exportColaboradorespdf'])->name('exportColaboradorespdf');
Route::get('/exportasignaciones', [ExportacionesController::class, 'exportasignaciones'])->name('exportasignaciones');
Route::get('/exportsalarios', [ExportacionesController::class, 'exportsalarios'])->name('exportsalarios');
Route::get('/exportaciones/pdf/{colaboradores}', [ExportacionesController::class, 'pdf'])->name('exportaciones.pdf');