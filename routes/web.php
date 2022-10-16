<?php

use App\Http\Controllers\CrudMesa;
use App\Http\Controllers\CrudPrato;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PerfilPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/reserva', function () {
    return view('reserva');
});

Route::get('/', [WebController::class, 'indexLogin'])->name('login');
Route::post('/autenticar', [WebController::class, 'autenticar'])->name('autenticar');
Route::post('/registrar', [WebController::class, 'registrar'])->name('registrar');
Route::get('/logout', [WebController::class, 'logout'])->name('logout');

Route::get('/index', [WebController::class, 'dashboard'])->name('index');


Route::get('/perfil-page', [PerfilPageController::class, 'index'])->name('perfil-page');


Route::get('/editar-perfil', [PerfilPageController::class, 'editarPerfil'])->name('editar-perfil');
Route::post('/editar-perfil', [PerfilPageController::class, 'editou'])->name('editou');


// Cruds
Route::resource('mesas', CrudMesa::class);
Route::resource('cardapio', CrudPrato::class);

// mobile
Route::get('/mobile/teste', [WebController::class, 'testeMobile'])->name('testeMobile');
Route::post('/mobile/soma', [WebController::class, 'soma'])->name('soma');
Route::post('/mobile/cadastroCliente', [WebController::class, 'cadastroCliente'])->name('cadastroCliente');


//RESERVAS
Route::get('/reserva','App\Http\Controllers\ReservaController@index');
