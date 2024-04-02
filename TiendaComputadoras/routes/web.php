<?php

use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\ColoresController;
use App\Http\Controllers\Coloresproductos;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\SalariosController;
use App\Http\Controllers\ExportacionesController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModelosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ImgController;
use App\Http\Controllers\PreciosController;
use App\Http\Controllers\PrivilegiosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SubcategoriasController;
use App\Http\Controllers\UsersController;
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

//Controller de validacion de inicio de session
Route::get('/loginadmin',[PaginaController::class,'loginadmin'])->name('login');
Route::post('/validarLogin', [PaginaController::class, 'validarLogin'])->name('validarLogin');
//Controller del modulo de Gestion de Negocio
Route::resource('cargos', CargosController::class)->parameters(['cargos' => 'cargos'])->names('cargos')->middleware('auth');
Route::resource('colaboradores', ColaboradoresController::class)->parameters(['colaboradores' => 'colaboradores'])->names('colaboradores')->middleware('auth');
Route::resource('asignaciones', AsignacionesController::class)->parameters(['asignaciones' => 'asignaciones'])->names('asignaciones')->middleware('auth');
Route::resource('salarios', SalariosController::class)->parameters(['salarios' => 'salarios'])->names('salarios')->middleware('auth');
//Controller de Catalogos
Route::resource('categorias', CategoriasController::class)->parameters(['categorias' => 'categorias'])->names('categorias')->middleware('auth');
Route::resource('subcategorias', SubcategoriasController::class)->parameters(['subcategorias' => 'subcategorias'])->names('subcategorias')->middleware('auth');
Route::resource('marcas', MarcasController::class)->parameters(['marcas' => 'marcas'])->names('marcas')->middleware('auth');
Route::resource('modelos', ModelosController::class)->parameters(['modelos' => 'modelos'])->names('modelos')->middleware('auth');
Route::resource('colores', ColoresController::class)->parameters(['colores' => 'colores'])->names('colores')->middleware('auth');
Route::resource('productos',ProductosController::class)->parameters(['productos' => 'productos'])->names('productos')->middleware('auth');
Route::resource('coloresproductos',Coloresproductos::class)->parameters(['coloresproductos' => 'coloresproductos'])->names('coloresproductos')->middleware('auth');
Route::get('/productos/{id}/multimedia', [ProductosController::class, 'multimedia'])->name('productos.multimedia')->middleware('auth');
Route::post('/guardarmultimedia', [ProductosController::class, 'guardarmultimedia'])->name('productos.guardarmultimedia')->middleware('auth');
Route::delete('/productos/destroyimg/{id}', [ProductosController::class, 'destroyimg'])->name('productos.destroyimg')->middleware('auth');
Route::resource('precios',PreciosController::class)->parameters(['precios' => 'precios'])->names('precios')->middleware('auth');


//Controller del modulo de usuarios
Route::resource('roles',RolesController::class)->parameters(['roles' => 'roles'])->names('roles')->middleware('auth');
Route::resource('privilegios',PrivilegiosController::class)->parameters(['privilegios' => 'privilegios'])->names('privilegios')->middleware('auth');
Route::resource('/permisos',PermisoController::class)->parameters(['permisos'=>'permisos'])->names('permisos')->middleware('auth');
Route::resource('/usuarios',UsersController::class)->parameters(['usuarios'=>'usuarios'])->names('usuarios')/*->middleware('auth')*/;
Route::delete('/usuarios/destroyroles/{id}', [UsersController::class, 'destroyroles'])->name('usuarios.destroyroles')->middleware('auth');


//Controller para multimedia
Route::resource('img',ImgController::class)->parameters(['img' => 'img'])->names('img')->middleware('auth');
//Rutas para exportacion y reportes
Route::get('/exportcargosexcel', [ExportacionesController::class, 'exportcargosexcel'])->name('exportcargosexcel')->middleware('auth');
Route::get('/exportcargopdf', [ExportacionesController::class, 'exportcargopdf'])->name('exportcargopdf')->middleware('auth');
Route::get('/exportColaboradores', [ExportacionesController::class, 'exportColaboradores'])->name('exportColaboradores')->middleware('auth');
Route::get('/exportColaboradorespdf', [ExportacionesController::class, 'exportColaboradorespdf'])->name('exportColaboradorespdf')->middleware('auth');
Route::get('/exportasignaciones', [ExportacionesController::class, 'exportasignaciones'])->name('exportasignaciones')->middleware('auth');
Route::get('/exportsalarios', [ExportacionesController::class, 'exportsalarios'])->name('exportsalarios')->middleware('auth');
Route::get('/exportcategorias', [ExportacionesController::class, 'exportcategorias'])->name('exportcategorias')->middleware('auth');
Route::get('/exportsubcategorias', [ExportacionesController::class, 'exportsubcategorias'])->name('exportsubcategorias')->middleware('auth');
Route::get('/exportmarcas', [ExportacionesController::class, 'exportmarcas'])->name('exportmarcas')->middleware('auth');
Route::get('/exportmodelos', [ExportacionesController::class, 'exportmodelos'])->name('exportmodelos')->middleware('auth');
Route::get('/exportcolores', [ExportacionesController::class, 'exportcolores'])->name('exportcolores')->middleware('auth');
Route::get('/exportproductos', [ExportacionesController::class, 'exportproductos'])->name('exportproductos')->middleware('auth');
Route::get('/exportprecios', [ExportacionesController::class, 'exportprecios'])->name('exportprecios')->middleware('auth');
Route::get('/exportaciones/pdf/{colaboradores}', [ExportacionesController::class, 'pdf'])->name('exportaciones.pdf')->middleware('auth');
Route::get('/exportroles', [ExportacionesController::class, 'exportroles'])->name('exportroles')->middleware('auth');
Route::get('/exportusuarios', [ExportacionesController::class, 'exportusuarios'])->name('exportusuarios')->middleware('auth');
