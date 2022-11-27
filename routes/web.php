<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CrudMesa;
use App\Http\Controllers\CrudPrato;
use App\Http\Controllers\CrudTipoRestaurante;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PerfilPageController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AvaliacaoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

// Autenticação
Route::get('/', [WebController::class, 'indexLogin'])->name('login');
Route::post('/autenticar', [WebController::class, 'autenticar'])->name('autenticar');
Route::post('/registrar', [WebController::class, 'registrar'])->name('registrar');
Route::get('/logout', [WebController::class, 'logout'])->name('logout');

// Rotas do administrador
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/restaurantes', [AdminController::class, 'pagrestaurantes'])->name('pagrestaurante');
    Route::get('/clientes', [AdminController::class, 'pagclientes'])->name('pagclientes');
    Route::resource('tipo-restaurante', CrudTipoRestaurante::class);

    Route::post('/editar-tipo/{$id}', [AdminController::class, 'editartipo'])->name('editar-tipo');
    Route::post('/deletar-tipo/{$id}', [AdminController::class, 'deletartipo'])->name('deletar-tipo');
});

Route::get('/index', [DashboardController::class, 'index'])->name('index');


// Perfil do restaurante
Route::get('/perfil-page', [PerfilPageController::class, 'index'])->name('perfil-page');
Route::post('/atualizar-descricao', [PerfilPageController::class, 'atualizarDescricao'])->name('atualizar-descricao');
Route::get('/editar-perfil', [PerfilPageController::class, 'editarPerfil'])->name('editar-perfil');
Route::post('/editar-perfil', [PerfilPageController::class, 'editou'])->name('editou');


// Cruds
Route::resource('mesas', CrudMesa::class);
Route::resource('cardapio', CrudPrato::class);
Route::resource('reservas', ReservadoidaController::class);

// Reservas
Route::get('/reservas', [ReservaController::class, 'index'])->name('reserva');
Route::get('/aceitar-reserva', [ReservaController::class, 'aceitarReserva'])->name('aceitar-reserva');
Route::get('/finalizar-reserva', [ReservaController::class, 'finalizarReserva'])->name('finalizar-reserva');
Route::get('/rejeitar-reserva', [ReservaController::class, 'rejeitarReserva'])->name('rejeitar-reserva');

// Avaliações
Route::get('/avaliacao', [AvaliacaoController::class, 'index'])->name('index');


// Rota para se caso ocorrer o erro 404 temos uma página personalizada
Route::fallback(function () {
    return view('404page');
});