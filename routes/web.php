<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ProductoController;
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

Route::get('/', [ProductoController::class, 'index']);
Route::get('/producto/{num}/edit', [ProductoController::class, 'edit']);
Route::post('/producto/{num}/update', [ProductoController::class, 'update']);
Route::get('/producto/delete/{num}', [ProductoController::class, 'destroy']);
Route::get('/producto/create', [ProductoController::class, 'create']);
Route::post('/create', [ProductoController::class, 'store']);


Route::get('/charts', [ProductoController::class, 'show']);