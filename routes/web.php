<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
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

//Productos
Route::get('/', [ProductoController::class, 'index']);
Route::get('/producto/{num}/edit', [ProductoController::class, 'edit']);
Route::post('/producto/{num}/update', [ProductoController::class, 'update']);
Route::get('/producto/delete/{num}', [ProductoController::class, 'destroy']);
Route::get('/producto/create', [ProductoController::class, 'create']);
Route::post('/create', [ProductoController::class, 'store']);
Route::get('/charts', [ProductoController::class, 'show']);

//Clientes
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/registro', [ClienteController::class, 'registro']);
Route::post('/clientes/create', [ClienteController::class, 'store']);
Route::get('/clientes/validate_pob', [ClienteController::class, 'api_geocode']);
Route::get('/clientes/mapa', [ClienteController::class, 'mapa']);