<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\ColoresController;
use App\Http\Controllers\Coloresproductos;
use App\Http\Controllers\CortesController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Lotes;
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
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SolicitudCompraController;
use App\Http\Controllers\SubcategoriasController;
use App\Http\Controllers\TallasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Stripe\StripeController;
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

/*Route::get('/', function () {
    return view('welcome');
});
*/
//CONTROLLER DE TIENDA
Route::get('/',[PaginaController::class, 'index'])->name('inicios');
Route::get('nosotros',[PaginaController::class, 'nosotros'])->name('nosotros');
Route::get('contactos',[PaginaController::class, 'contactos'])->name('contactos');
Route::get('shop',[PaginaController::class, 'shop'])->name('shop');


//Controller DEL CARRITO
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

//CONTROLLER DE LA PASARELA DE PAGO
Route::post('stripe', [StripeController::class, 'stripe'])->name('stripe');
Route::get('success', [StripeController::class, 'success'])->name('success');
Route::get('cancel', [StripeController::class, 'cancel'])->name('cancel');

//Controller de validacion de inicio de session
Route::get('/login',[PaginaController::class,'login'])->name('login');
Route::post('/validarLogin', [PaginaController::class, 'validarLogin'])->name('validarLogin');
Route::post('/logout',[PaginaController::class,'logout'])->name('logout');
Route::get('/error403',[PaginaController::class,'error403'])->name('error403');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Validacion en dos pasos
Route::get('/dospasos',[\App\Http\Controllers\loginController::class,'dospasos'])->name('dospasos');

//Usuarios admin
Route::get('/perfil', [AdminController::class, 'perfil'])->name('perfil')->middleware('auth');
Route::get('/actualizarperfil', [AdminController::class, 'actualizarperfil'])->name('actualizarperfil')->middleware('auth');
Route::get('inicio',[AdminController::class,'inicio'])->name('inicio')->middleware('auth');
Route::post('/cerrar-sesion-dispositivo', [AdminController::class, 'closeSessionForDevice'])->name('cerrar_sesion_dispositivo')->middleware('auth');


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
Route::resource('tallas', TallasController::class)->parameters(['tallas'=>'tallas'])->names('tallas')->middleware('checkRole:6');
Route::resource('cortes',CortesController::class)->parameters(['cortes'=> 'cortes'])->names('cortes')->middleware('checkRole:7');
Route::resource('productos',ProductosController::class)->parameters(['productos' => 'productos'])->names('productos')->middleware('checkRole:7');
Route::resource('coloresproductos',Coloresproductos::class)->parameters(['coloresproductos' => 'coloresproductos'])->names('coloresproductos')->middleware('checkRole:8');

//Controller de tablas de catalogos auxiliares
Route::get('/productos/{id}/multimedia', [ProductosController::class, 'multimedia'])->name('productos.multimedia')->middleware('checkRole:8');
Route::get('/productos/{id}/agregarCorte', [ProductosController::class, 'agregarCorte'])->name('productos.agregarCorte')->middleware('checkRole:8');
Route::get('/productos/{id}/agregartallas', [ProductosController::class, 'agregartallas'])->name('productos.agregartallas')->middleware('checkRole:8');
Route::get('/productos/{id}/agregardetalles', [ProductosController::class, 'agregardetalles'])->name('productos.agregardetalles')->middleware('checkRole:8');

Route::post('/guardarmultimedia', [ProductosController::class, 'guardarmultimedia'])->name('productos.guardarmultimedia')->middleware('checkRole:8');
Route::post('/productos/guardarcorte', [ProductosController::class, 'guardarcorte'])->name('productos.guardarcorte')->middleware('checkRole:8');
Route::post('/productos/guardartallas', [ProductosController::class, 'guardartallas'])->name('productos.guardartallas')->middleware('checkRole:8');
Route::post('/productos/guardardetalles', [ProductosController::class, 'guardardetalles'])->name('productos.guardardetalles')->middleware('checkRole:8');

Route::delete('/productos/destroyimg/{id}', [ProductosController::class, 'destroyimg'])->name('productos.destroyimg')->middleware('checkRole:8');
Route::delete('/productos/destroycortes/{id}', [ProductosController::class, 'destroycortes'])->name('productos.destroycortes')->middleware('checkRole:8');
Route::delete('/productos/destroytallas/{id}', [ProductosController::class, 'destroytallas'])->name('productos.destroytallas')->middleware('checkRole:8');
Route::delete('/productos/destroydetalles/{id}', [ProductosController::class, 'destroydetalles'])->name('productos.destroydetalles')->middleware('checkRole:8');

//Controller de los precios
Route::resource('precios',PreciosController::class)->parameters(['precios' => 'precios'])->names('precios')->middleware('checkRole:9');

//Controller de gestion de compras
Route::resource('proveedores',ProveedoresController::class)->parameters(['proveedores' => 'proveedores'])->names('proveedores')->middleware('checkRole:10');
Route::resource('solicitud',SolicitudCompraController::class)->parameters(['solicitud' => 'solicitud'])->names('solicitud')->middleware('checkRole:13');
Route::resource('lotes',Lotes::class)->parameters(['lotes' => 'lotes'])->names('lotes')->middleware('checkRole:10');



//Controller del modulo de usuarios
Route::resource('roles',RolesController::class)->parameters(['roles' => 'roles'])->names('roles')->middleware('checkRole:26');
Route::resource('privilegios',PrivilegiosController::class)->parameters(['privilegios' => 'privilegios'])->names('privilegios')->middleware('checkRole:28');
Route::resource('/permisos',PermisoController::class)->parameters(['permisos'=>'permisos'])->names('permisos')->middleware('checkRole:29');
Route::resource('/usuarios',UsersController::class)->parameters(['usuarios'=>'usuarios'])->names('usuarios')->middleware('checkRole:27');
Route::delete('/usuarios/destroyroles/{id}', [UsersController::class, 'destroyroles'])->name('usuarios.destroyroles')->middleware('checkRole:28');


//Controller para multimedia
Route::resource('img',ImgController::class)->parameters(['img' => 'img'])->names('img')->middleware('auth');
//Controller para la administracion de la pagina
Route::resource('empresa', EmpresaController::class)->parameters(['empresa' => 'empresa'])->names('empresa')->middleware('checkRole:18');

//Controller para exportacion y reportes
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
Route::get('/exportproveedores',[ExportacionesController::class,'exportproveedores'])->name('exportproveedores');