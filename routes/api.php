<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// mobile
Route::get('/teste', [LoginController::class, 'testeMobile'])->name('testeMobile');
Route::post('/soma', [LoginController::class, 'soma'])->name('soma');
Route::post('/cadastroCliente', [LoginController::class, 'cadastroCliente'])->name('cadastroCliente');
Route::post('/loginCliente', [LoginController::class, 'loginCliente'])->name('loginCliente');
Route::post('/reserva', [ReservaController::class, 'reserva'])->name('reserva');
