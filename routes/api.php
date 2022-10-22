<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReservadoidaController;
use App\Http\Controllers\WebController;
use App\Models\ReservaModel;

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
Route::get('/restaurantes', [AppController::class, 'getRestaurants'])->name('getRestaurants');
Route::post('/loginCliente', [AppController::class, 'loginCliente'])->name('loginCliente');
Route::post('/uploadImage', [AppController::class, 'uploadImage'])->name('uploadImage');
Route::get('/getRestaurantsByType', [AppController::class, 'getRestaurantesByType'])->name('getRestaurantesByType');
Route::get('/getRestaurantsByName', [AppController::class, 'getRestaurantsByName'])->name('getRestaurantsByName');

// user
Route::post('/cadastroCliente', [AppController::class, 'cadastroCliente'])->name('cadastroCliente');
Route::delete('/deleteUser', [AppController::class, 'deleteUserById'])->name('deleteUserById');
Route::patch('/updateUser', [AppController::class, 'updateUserData'])->name('updateUserData');
Route::patch('/updateUserById', [AppController::class, 'updateUserById'])->name('updateUserById');
Route::get('/getUser', [AppController::class, 'getUserData'])->name('getUserData');
Route::get('/getUserById/{id}', [AppController::class, 'getUserById'])->name('getUserById');
Route::post('/resetPassword', [AppController::class, 'resetPassword'])->name('resetPassword');

//token
Route::get('/getToken/{emailCliente}', [AppController::class, 'getToken'])->name('getToken');

// reservas
Route::post('/reserva', [ReservadoidaController::class, 'create']);
Route::post('/reserva2', [ReservaController::class, 'reserva'])->name('reserva');
Route::get('/getReservas', [ReservadoidaController::class, 'getReservas'])->name('getReservas');
Route::get('/getReserva/{id}', [ReservadoidaController::class, 'getReserva'])->name('getReserva');
Route::get('/getReservasByRestaurante/{id}', [ReservadoidaController::class, 'getReservasByRestaurante'])->name('getReservasByRestaurante');
Route::get('/getReservasByCliente/{id}', [ReservadoidaController::class, 'getReservasByCliente'])->name('getReservasByCliente');
Route::get('/getReservasByStatus/{id}', [ReservadoidaController::class, 'getReservasByStatus'])->name('getReservasByStatus');
Route::get('/getReservasByData/{id}', [ReservadoidaController::class, 'getReservasByData'])->name('getReservasByData');
Route::get('/getLatestReservasCliente', [ReservadoidaController::class, 'getLatestReservasCliente'])->name('getLatestReservasCliente');
Route::get('/getLatestReservasRestaurante', [ReservadoidaController::class, 'getLatestReservasRestaurante'])->name('getLatestReservasRestaurante');
Route::get('/getReservasByRestauranteAndStatus', [ReservadoidaController::class, 'getReservasByRestauranteAndStatus'])->name('getReservasByRestauranteAndStatus');
Route::get('/aceitarReserva/{id}', [ReservadoidaController::class, 'aceitarReserva'])->name('aceitarReserva');
Route::get('/rejeitarReserva/{id}', [ReservadoidaController::class, 'rejeitarReserva'])->name('rejeitarReserva');


Route::resource('reservas', ReservadoidaController::class);
