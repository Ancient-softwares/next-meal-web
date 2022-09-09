<?php

use App\Http\Controllers\CrudMesa;
use App\Http\Controllers\CrudPrato;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CrudUsuario;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerfilPageController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [LoginController::class, 'indexLogin'])->name('login');
Route::post('autenticar', [LoginController::class, 'autenticar'])->name('autenticar');
Route::post('registrar', [LoginController::class, 'registrar'])->name('registrar');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/index', [LoginController::class, 'dashboard'])->name('index');


Route::get('/perfil-page', [PerfilPageController::class, 'index'])->name('perfil-page');


Route::get('/editar-perfil', [PerfilPageController::class, 'editarPerfil'])->name('editar-perfil');
Route::post('/editar-perfil', [PerfilPageController::class, 'editou'])->name('editou');


// Cruds
Route::resource('mesas', CrudMesa::class);
Route::resource('cardapio', CrudPrato::class);
