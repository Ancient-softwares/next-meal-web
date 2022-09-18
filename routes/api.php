<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\WebController;

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
Route::get('/teste', [AppController::class, 'testeMobile'])->name('testeMobile');
Route::post('/soma', [AppController::class, 'soma'])->name('soma');
Route::get('/restaurantes', [AppController::class, 'getRestaurants'])->name('getRestaurants');
Route::post('/cadastroCliente', [AppController::class, 'cadastroCliente'])->name('cadastroCliente');
Route::post('/loginCliente', [AppController::class, 'loginCliente'])->name('loginCliente');
Route::post('/reserva', [AppController::class, 'reserva'])->name('reserva');

// web
Route::get('/teste', [WebController::class, 'teste'])->name('teste');
