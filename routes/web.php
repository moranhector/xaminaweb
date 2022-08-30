<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';








Route::resource('artesanos', App\Http\Controllers\ArtesanoController::class);


Route::resource('rubros', App\Http\Controllers\RubroController::class);



Route::resource('tipopiezas', App\Http\Controllers\TipopiezaController::class);


Route::resource('cheques', App\Http\Controllers\ChequeController::class);


Route::resource('recibos', App\Http\Controllers\ReciboController::class);

Route::get('preparar_recibo','App\Http\Controllers\ReciboController@preparar')->name('preparar.recibo');   

Route::post('guardar_recibo','App\Http\Controllers\ReciboController@guardar')->name('guardar.recibo');   


Route::resource('recibosLineas', App\Http\Controllers\RecibosLineasController::class);

/* Incorporo una función de búsqueda para seleccionar artesanos */
Route::get('/seleccionarartesanos', 'App\Http\Controllers\ArtesanoController@seleccionar')->name('seleccionar_artesanos');



Route::resource('depositos', App\Http\Controllers\DepositoController::class);


Route::resource('inventarios', App\Http\Controllers\InventarioController::class);


Route::resource('talonarios', App\Http\Controllers\TalonarioController::class);
