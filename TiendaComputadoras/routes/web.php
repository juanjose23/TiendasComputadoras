<?php

use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\ColoresController;
use App\Http\Controllers\Coloresproductos;
use App\Http\Controllers\SalariosController;
use App\Http\Controllers\ExportacionesController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModelosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ImgController;
use App\Http\Controllers\PreciosController;
use App\Http\Controllers\SubcategoriasController;
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
//Controller del modulo de Gestion de Negocio
Route::resource('cargos', CargosController::class)->parameters(['cargos' => 'cargos'])->names('cargos');
Route::resource('colaboradores', ColaboradoresController::class)->parameters(['colaboradores' => 'colaboradores'])->names('colaboradores');
Route::resource('asignaciones', AsignacionesController::class)->parameters(['asignaciones' => 'asignaciones'])->names('asignaciones');
Route::resource('salarios', SalariosController::class)->parameters(['salarios' => 'salarios'])->names('salarios');
//Controller de Catalogos
Route::resource('categorias', CategoriasController::class)->parameters(['categorias' => 'categorias'])->names('categorias');
Route::resource('subcategorias', SubcategoriasController::class)->parameters(['subcategorias' => 'subcategorias'])->names('subcategorias');
Route::resource('marcas', MarcasController::class)->parameters(['marcas' => 'marcas'])->names('marcas');
Route::resource('modelos', ModelosController::class)->parameters(['modelos' => 'modelos'])->names('modelos');
Route::resource('colores', ColoresController::class)->parameters(['colores' => 'colores'])->names('colores');
Route::resource('productos',ProductosController::class)->parameters(['productos' => 'productos'])->names('productos');
Route::resource('coloresproductos',Coloresproductos::class)->parameters(['coloresproductos' => 'coloresproductos'])->names('coloresproductos');
Route::get('/productos/{id}/multimedia', [ProductosController::class, 'multimedia'])->name('productos.multimedia');
Route::post('/guardarmultimedia', [ProductosController::class, 'guardarmultimedia'])->name('productos.guardarmultimedia');
Route::delete('/productos/destroyimg/{id}', [ProductosController::class, 'destroyimg'])->name('productos.destroyimg');
Route::resource('precios',PreciosController::class)->parameters(['precios' => 'precios'])->names('precios');
//Controller del modulo de usuarios

//Controller para multimedia
Route::resource('img',ImgController::class)->parameters(['img' => 'img'])->names('img');
//Rutas para exportacion y reportes
Route::get('/exportcargosexcel', [ExportacionesController::class, 'exportcargosexcel'])->name('exportcargosexcel');
Route::get('/exportcargopdf', [ExportacionesController::class, 'exportcargopdf'])->name('exportcargopdf');
Route::get('/exportColaboradores', [ExportacionesController::class, 'exportColaboradores'])->name('exportColaboradores');
Route::get('/exportColaboradorespdf', [ExportacionesController::class, 'exportColaboradorespdf'])->name('exportColaboradorespdf');
Route::get('/exportasignaciones', [ExportacionesController::class, 'exportasignaciones'])->name('exportasignaciones');
Route::get('/exportsalarios', [ExportacionesController::class, 'exportsalarios'])->name('exportsalarios');
Route::get('/exportcategorias', [ExportacionesController::class, 'exportcategorias'])->name('exportcategorias');
Route::get('/exportsubcategorias', [ExportacionesController::class, 'exportsubcategorias'])->name('exportsubcategorias');
Route::get('/exportmarcas', [ExportacionesController::class, 'exportmarcas'])->name('exportmarcas');
Route::get('/exportmodelos', [ExportacionesController::class, 'exportmodelos'])->name('exportmodelos');
Route::get('/exportcolores', [ExportacionesController::class, 'exportcolores'])->name('exportcolores');
Route::get('/exportproductos', [ExportacionesController::class, 'exportproductos'])->name('exportproductos');
Route::get('/exportaciones/pdf/{colaboradores}', [ExportacionesController::class, 'pdf'])->name('exportaciones.pdf');