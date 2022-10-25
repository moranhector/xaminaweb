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
Route::get('rendir_cheque/{id}','App\Http\Controllers\ChequeController@rendir')->name('cheques.rendir');   

Route::post('rendicion_guardar','App\Http\Controllers\ChequeController@rendicion_guardar')->name('rendicion_guardar');   

// IMPRIMIR RENDICION
Route::get('cheques/imprimir_rendicion/{id}','App\Http\Controllers\ChequeController@imprimir')->name('imprimir_rendicion');   



Route::resource('recibos', App\Http\Controllers\ReciboController::class);

Route::get('preparar_recibo','App\Http\Controllers\ReciboController@preparar')->name('preparar.recibo');   

// FACTURAS
Route::get('preparar_factura','App\Http\Controllers\FacturaController@preparar')->name('preparar.factura');   

Route::post('guardar_recibo','App\Http\Controllers\ReciboController@guardar')->name('guardar.recibo');   
Route::post('guardar_factura','App\Http\Controllers\FacturaController@guardar')->name('guardar.factura');   


Route::resource('recibosLineas', App\Http\Controllers\RecibosLineasController::class);

/* Incorporo una función de búsqueda para seleccionar artesanos */
Route::get('/seleccionarartesanos', 'App\Http\Controllers\ArtesanoController@seleccionar')->name('seleccionar_artesanos');
Route::get('/seleccionarclientes', 'App\Http\Controllers\ClienteController@seleccionar')->name('seleccionar_clientes');



Route::resource('depositos', App\Http\Controllers\DepositoController::class);


Route::resource('inventarios', App\Http\Controllers\InventarioController::class);


//use App\Http\Controllers\InventarioController;

Route::get('inventario_fecha','App\Http\Controllers\InventarioController@inventario_fecha')->name('inventario_fecha');;



Route::resource('talonarios', App\Http\Controllers\TalonarioController::class);


Route::resource('rendiciones', App\Http\Controllers\RendicionController::class);




Route::resource('clientes', App\Http\Controllers\ClienteController::class);


Route::resource('facturas', App\Http\Controllers\FacturaController::class);


Route::resource('faclineas', App\Http\Controllers\FaclineaController::class);




Route::resource('existencias', App\Http\Controllers\ExistenciaController::class);



 

use App\Http\Controllers\InventarioController;
Route::get('fetch-pieza/{pieza}', [InventarioController::class, 'fetchpieza']);
Route::get('ajax_pieza_deposito/{pieza}/{deposito}', [InventarioController::class, 'ajax_pieza_deposito']);




Route::resource('remitos', App\Http\Controllers\RemitoController::class);


Route::resource('remitoLineas', App\Http\Controllers\Remito_lineaController::class);


 