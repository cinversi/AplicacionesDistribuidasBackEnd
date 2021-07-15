<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Persona
Route::get('add-persona', 'App\Http\Controllers\PersonaController@addPersona');
Route::get('get-persona', 'App\Http\Controllers\PersonaController@getPersona');

//User
Route::get('add-user', 'App\Http\Controllers\UserController@addUser');
Route::get('login', 'App\Http\Controllers\UserController@login');
Route::get('generate-password', 'App\Http\Controllers\UserController@generatePassword');

//Login
Route::get('get-currentuser', 'App\Http\Controllers\Auth\LoginController@getCurrentUser');

//Cliente
Route::get('add-cliente', 'App\Http\Controllers\ClienteController@addCliente');
Route::get('admitir-cliente/{id}', 'App\Http\Controllers\ClienteController@admitirCliente');

//Subasta
Route::get('get-all-subastas', 'App\Http\Controllers\SubastaController@getAllSubastas');
Route::get('get-all-categoria-subastas', 'App\Http\Controllers\SubastaController@getAllCategoriaSubastas');
Route::get('cerrar-subasta/{id}', 'App\Http\Controllers\SubastaController@cerrarSubasta');

//Producto
Route::get('get-productos/{idUser}', 'App\Http\Controllers\ProductoController@getProductos');
Route::get('add-producto/{idUser}', 'App\Http\Controllers\ProductoController@addProducto');
Route::get('disponibilizar-producto/{id}', 'App\Http\Controllers\ProductoController@disponibilizarProducto');
Route::get('rechazar-producto/{id}', 'App\Http\Controllers\ProductoController@rechazarProducto');

//Catalogo
Route::get('get-catalogo/{id}', 'App\Http\Controllers\CatalogoController@getCatalogo');

//ItemsCatalogo
Route::get('get-items-catalogo/{id}', 'App\Http\Controllers\ItemsCatalogoController@getItemsCatalogo');

//Asistente

//Route::get('add-asistente/{id}', 'App\Http\Controllers\AsistenteController@addAsistente');
Route::get('abandonar-subasta/{id}', 'App\Http\Controllers\AsistenteController@abandonarSubasta');

//Pujo
Route::get('add-puja/{id}', 'App\Http\Controllers\PujoController@addPujo');

//RegistroDeSubastas
Route::get('get-ganador-subasta/{id}', 'App\Http\Controllers\RegistroDeSubastaController@getGanadorSubasta');

//MediosDePago
Route::get('add-mediopago', 'App\Http\Controllers\MedioDePagoController@addMedioPago');
Route::get('habilitar-mediopago/{id}', 'App\Http\Controllers\MedioDePagoController@habilitarMedioDePago');
Route::get('rechazar-mediopago/{id}', 'App\Http\Controllers\MedioDePagoController@rechazarMedioDePago');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
