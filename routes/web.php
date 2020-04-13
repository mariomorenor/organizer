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

Route::get('lista/obtenerCodigos','ListaController@obtener_Codigos')->name('codigos');
Route::get('pagos/comprobarSaldo/{cliente}','PagoController@comprobarSaldo')->name('comprobarSaldo');

Route::resources([
    'clientes'=>'ClienteController',
    'listas'=>'ListaController',
    'pagos'=>'PagoController'
]);

Route::get('clientes/comprobarCliente/{cliente}','ClienteController@comprobarCliente');
