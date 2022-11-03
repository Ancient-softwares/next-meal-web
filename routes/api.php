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
Route::post('/getRestaurantByCep', [AppController::class, 'getRestaurantByCep'])->name('getRestaurantByCep');
Route::post('/getRestaurantsByType', [AppController::class, 'getRestaurantsByType'])->name('getRestaurantsByType');
Route::get('/getRestaurantsByName', [AppController::class, 'getRestaurantsByName'])->name('getRestaurantsByName');
Route::post('/getTipoRestaurantes', [AppController::class, 'getTipoRestaurantes'])->name('getTipoRestaurantes');
Route::post('/getPratosByRestaurante', [AppController::class, 'getPratosByRestaurante'])->name('getPratosByRestaurante');
Route::post('/getAvaliacoesByRestaurante', [AppController::class, 'getAvaliacoesByRestaurante'])->name('getAvaliacoesByRestaurante');

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
Route::post('/bearerTokenVerify', [ReservadoidaController::class, 'bearerTokenVerify'])->name('bearerTokenVerify');

// reservas
Route::post('/reserva', [ReservadoidaController::class, 'create'])->name('create');
Route::post('/reserva2', [ReservaController::class, 'reserva'])->name('reserva');
Route::post('/reserva3', [ReservadoidaController::class, 'store'])->name('store');
Route::get('/getReservas', [ReservadoidaController::class, 'getReservas'])->name('getReservas');
Route::get('/getReserva/{id}', [ReservadoidaController::class, 'getReserva'])->name('getReserva');
Route::get('/getClientesFieis/{id}', [ReservadoidaController::class, 'getClientesFieis'])->name('getClientesFieis');
Route::get('/getReservasByDate/{id}', [ReservadoidaController::class, 'getReservasByDate'])->name('getReservasByDate');
Route::get('/getReservasByRestaurante', [ReservadoidaController::class, 'getReservasByRestaurante'])->name('getReservasByRestaurante');
Route::post('/getReservasByCliente', [ReservadoidaController::class, 'getReservasByCliente'])->name('getReservasByCliente');
Route::get('/getReservasByStatus', [ReservadoidaController::class, 'getReservasByStatus'])->name('getReservasByStatus');
Route::get('/getReservasByData', [ReservadoidaController::class, 'getReservasByData'])->name('getReservasByData');
Route::post('/getLatestReservasCliente', [ReservadoidaController::class, 'getLatestReservasCliente'])->name('getLatestReservasCliente');
Route::get('/getLatestReservasRestaurante', [ReservadoidaController::class, 'getLatestReservasRestaurante'])->name('getLatestReservasRestaurante');
Route::get('/getReservasByRestauranteAndStatus', [ReservadoidaController::class, 'getReservasByRestauranteAndStatus'])->name('getReservasByRestauranteAndStatus');
Route::delete('/deleteReserva/{id}', [ReservadoidaController::class, 'deleteReserva'])->name('deleteReserva');
Route::get('/getRestaurantesMaisReservados', [ReservadoidaController::class, 'getRestaurantesMaisReservados'])->name('getRestaurantesMaisReservados');
Route::get('/getRestaurantesMelhoresAvaliados', [ReservadoidaController::class, 'getRestaurantesMelhoresAvaliados'])->name('getRestaurantesMelhoresAvaliados');
Route::get('/getRestaurantesMaisReservadosMelhoresAvaliados', [ReservadoidaController::class, 'getRestaurantesMaisReservadosMelhoresAvaliados'])->name('getRestaurantesMaisReservadosMelhoresAvaliados');
Route::put('/updateReserva/{id}', [ReservadoidaController::class, 'update'])->name('update');
Route::post('/checkReserva', [ReservadoidaController::class, 'checkReserva'])->name('checkReserva');
Route::get('/aceitarReserva/{id}', [ReservadoidaController::class, 'aceitarReserva'])->name('aceitarReserva');
Route::get('/rejeitarReserva/{id}', [ReservadoidaController::class, 'rejeitarReserva'])->name('rejeitarReserva');


Route::resource('reservas', ReservadoidaController::class);
