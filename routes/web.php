<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImovelController;
use App\Http\Controllers\TipoImovelController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('welcome2');
});

Route::get('/teste', function () {
    return view('teste');
});

Auth::routes();

Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')->middleware('CheckAdmin');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('login.logout')->middleware('auth');

Route::controller(ImovelController::class)->group(function () {
    Route::get('/imovel', 'index')->name('imovel.index');
    Route::get('/imovel/create', 'create')->name('imovel.create');
    Route::post('/imovel/salvar', 'store')->name('imovel.store');
    Route::get('/imovel/{imovel}/edit', 'edit')->name('imovel.edit');
    Route::delete('/imovel/{imovel}', 'destroy')->name('imovel.destroy');
    Route::get('/anunciar', 'anunciar')->name('imovel.anunciar');
    Route::get('/imovel/anuncios', 'anuncios')->name('imovel.anuncios');
});

Route::controller(TipoImovelController::class)->group(function () {
    Route::get('/tipoimovel', 'index')->name('tipoimovel.index');
    Route::get('/tipoimovel/create', 'create')->name('tipoimovel.create');
    Route::post('/tipoimovel/salvar', 'store')->name('tipoimovel.store');
    Route::get('/tipoimovel/{tipoimovel}/edit', 'edit')->name('tipoimovel.edit');
    Route::delete('/tipoimovel/{tipoimovel}', 'destroy')->name('tipoimovel.destroy');
});

Route::controller(AnuncioController::class)->group(function () {
    Route::get('/anunciar', 'anunciar')->name('anuncio.anunciar')->middleware('CheckVendedor');
    Route::get('/anuncios', 'anuncios')->name('anuncio.anuncios');
    Route::get('/visualizar/{id}', 'visualizar')->name('anuncio.visualizar');
    Route::get('/meusimoveis', 'meusimoveis')->name('anuncio.meusimoveis')->middleware('CheckVendedor');
    Route::post('/anuncio/salvar', 'store')->name('anuncio.store')->middleware('CheckVendedor');
});

Route::controller(RegisterController::class)->group(function () {
    Route::post('/register/salvar', 'store')->name('register.store');
});
