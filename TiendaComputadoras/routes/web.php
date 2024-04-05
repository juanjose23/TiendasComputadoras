<?php

use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\ColoresController;
use App\Http\Controllers\Coloresproductos;
use App\Http\Controllers\CortesController;
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
use App\Http\Controllers\TallasController;
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
Route::get('/login',[PaginaController::class,'login'])->name('login');
Route::post('/validarLogin', [PaginaController::class, 'validarLogin'])->name('validarLogin');
Route::get('/logout',[PaginaController::class,'logout']);
Route::get('/error403',[PaginaController::class,'error403']);

//Controller del modulo de Gestion de Negocio
Route::resource('cargos', CargosController::class)->parameters(['cargos' => 'cargos'])->names('cargos')->middleware('checkRole:18');
Route::resource('colaboradores', ColaboradoresController::class)->parameters(['colaboradores' => 'colaboradores'])->names('colaboradores')->middleware('checkRole:19');
Route::resource('asignaciones', AsignacionesController::class)->parameters(['asignaciones' => 'asignaciones'])->names('asignaciones')->middleware('checkRole:20');
Route::resource('salarios', SalariosController::class)->parameters(['salarios' => 'salarios'])->names('salarios')->middleware('checkRole:21');
//Controller de Catalogos
Route::resource('categorias', CategoriasController::class)->parameters(['categorias' => 'categorias'])->names('categorias')->middleware('checkRole:1');
Route::resource('subcategorias', SubcategoriasController::class)->parameters(['subcategorias' => 'subcategorias'])->names('subcategorias')->middleware('checkRole:2');
Route::resource('marcas', MarcasController::class)->parameters(['marcas' => 'marcas'])->names('marcas')->middleware('checkRole:3');
Route::resource('modelos', ModelosController::class)->parameters(['modelos' => 'modelos'])->names('modelos')->middleware('checkRole:4');
Route::resource('colores', ColoresController::class)->parameters(['colores' => 'colores'])->names('colores')->middleware('checkRole:5');
Route::resource('tallas', TallasController::class)->parameters(['tallas'=>'tallas'])->names('tallas')->middleware('checkRol:6');
Route::resource('cortes',CortesController::class)->parameters(['cortes'=> 'cortes'])->names('cortes')->middleware('checkRol:6');
Route::resource('productos',ProductosController::class)->parameters(['productos' => 'productos'])->names('productos')->middleware('checkRole:7');
Route::resource('coloresproductos',Coloresproductos::class)->parameters(['coloresproductos' => 'coloresproductos'])->names('coloresproductos')->middleware('checkRole:7');
Route::get('/productos/{id}/multimedia', [ProductosController::class, 'multimedia'])->name('productos.multimedia')->middleware('checkRole:7');
Route::post('/guardarmultimedia', [ProductosController::class, 'guardarmultimedia'])->name('productos.guardarmultimedia')->middleware('checkRole:7');
Route::delete('/productos/destroyimg/{id}', [ProductosController::class, 'destroyimg'])->name('productos.destroyimg')->middleware('checkRole:7');
Route::resource('precios',PreciosController::class)->parameters(['precios' => 'precios'])->names('precios')->middleware('checkRole:8');


//Controller del modulo de usuarios
Route::resource('roles',RolesController::class)->parameters(['roles' => 'roles'])->names('roles')->middleware('checkRole:31');
Route::resource('privilegios',PrivilegiosController::class)->parameters(['privilegios' => 'privilegios'])->names('privilegios')->middleware('checkRole:32');
Route::resource('/permisos',PermisoController::class)->parameters(['permisos'=>'permisos'])->names('permisos')->middleware('checkRole:33');
Route::resource('/usuarios',UsersController::class)->parameters(['usuarios'=>'usuarios'])->names('usuarios')->middleware('checkRole:34');
Route::delete('/usuarios/destroyroles/{id}', [UsersController::class, 'destroyroles'])->name('usuarios.destroyroles')->middleware('checkRole:35');


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
Route::get('/exporttallas', [ExportacionesController::class, 'exporttallas'])->name('exporttallas');
Route::get('/exportcortes', [ExportacionesController::class,'exportcortes'])->name('exportcortes')/*->middleware('auth')*/;
Route::get('/exportproductos', [ExportacionesController::class, 'exportproductos'])->name('exportproductos')->middleware('auth');
Route::get('/exportprecios', [ExportacionesController::class, 'exportprecios'])->name('exportprecios')->middleware('auth');
Route::get('/exportaciones/pdf/{colaboradores}', [ExportacionesController::class, 'pdf'])->name('exportaciones.pdf')->middleware('auth');
Route::get('/exportroles', [ExportacionesController::class, 'exportroles'])->name('exportroles')->middleware('auth');
Route::get('/exportusuarios', [ExportacionesController::class, 'exportusuarios'])->name('exportusuarios')->middleware('auth');
