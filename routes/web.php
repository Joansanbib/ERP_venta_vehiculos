<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PropuestaController;
use App\Http\Controllers\UsuarioController;
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

Route::middleware('auth')->group(function () {
    //Clientes
    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::get('/clientes/inventario', [ClienteController::class, 'inventario']);
    Route::get('/clientes/registro', [ClienteController::class, 'registro']);
    Route::post('/clientes/create', [ClienteController::class, 'store'])->middleware('preventDirectAccess');
    Route::get('/clientes/{num}/edit', [ClienteController::class, 'edit'])->middleware('preventDirectAccess');
    Route::get('/clientes/delete/{num}', [ClienteController::class, 'destroy'])->middleware('preventDirectAccess');
    Route::post('/clientes/{num}/update', [ClienteController::class, 'update'])->middleware('preventDirectAccess');
    Route::get('/clientes/validate_pob', [ClienteController::class, 'api_geocode'])->middleware('preventDirectAccess');
    Route::get('/clientes/mapa', [ClienteController::class, 'mapa']);

    //Productos
    Route::get('/', [ProductoController::class, 'index']);
    Route::get('/producto/{num}/edit', [ProductoController::class, 'edit'])->middleware('preventDirectAccess');
    Route::post('/producto/{num}/update', [ProductoController::class, 'update'])->middleware('preventDirectAccess');
    Route::get('/producto/delete/{num}', [ProductoController::class, 'destroy'])->middleware('preventDirectAccess');
    Route::get('/producto/create', [ProductoController::class, 'create']);
    Route::post('/create', [ProductoController::class, 'store'])->middleware('preventDirectAccess');
    Route::get('/charts', [ProductoController::class, 'show']);

    
    //Ventas y Propuestas
    Route::get('/propuestas', [PropuestaController::class, 'index']);
    Route::get('/propuestas/create', [PropuestaController::class, 'crear_propuesta']);
    Route::get('/propuestas/{num}/aceptar', [PropuestaController::class, 'aceptar_propuesta'])->middleware('preventDirectAccess');
    Route::post('/propuestas/store', [PropuestaController::class, 'store_propuesta'])->middleware('preventDirectAccess');
    Route::get('/propuestas/{num}/venta', [PropuestaController::class, 'crear_venta'])->middleware('preventDirectAccess');
    Route::post('/propuestas/{num}/venta/create', [PropuestaController::class, 'store'])->middleware('preventDirectAccess');

    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::get('/usuario/{id}/edit', [UsuarioController::class, 'edit'])->middleware('preventDirectAccess');
    Route::get('/perfil', [UsuarioController::class, 'edit_perfil']);
    Route::get('/cerrar_sesion', [UsuarioController::class, 'cerrar_sesion']);
    Route::get('/borrar_cuenta', [UsuarioController::class, 'borrar_cuenta'])->middleware('preventDirectAccess');
    Route::post('/eliminar-cuenta/{id}', [UsuarioController::class, 'eliminarCuenta'])->middleware('preventDirectAccess');
    Route::post('/perfil/update/{id}', [UsuarioController::class, 'perfil_update'])->middleware('preventDirectAccess');


});
 //Registro y login 
 Route::get('/registro', [UsuarioController::class, 'crear_registro']);
 Route::post('/registro/store', [UsuarioController::class, 'store_registro'])->middleware('preventDirectAccess');
 Route::get('/login', [UsuarioController::class, 'login_view'])->name('login');
 Route::post('/login/comprovacion', [UsuarioController::class, 'login'])->middleware('preventDirectAccess');






//Falta acabar venta y propuestas y crear usuaris