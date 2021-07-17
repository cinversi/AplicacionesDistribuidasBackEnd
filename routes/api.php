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
Route::get('get-user-bypersona', 'App\Http\Controllers\UserController@getUserByPersona');

//Login
Route::get('get-currentuser', 'App\Http\Controllers\Auth\LoginController@getCurrentUser');

//Cliente
Route::get('add-cliente', 'App\Http\Controllers\ClienteController@addCliente');
Route::get('admitir-cliente/{id}', 'App\Http\Controllers\ClienteController@admitirCliente');
Route::get('get-cliente', 'App\Http\Controllers\ClienteController@getCliente');

//Subasta
Route::get('get-all-subastas', 'App\Http\Controllers\SubastaController@getAllSubastas');
Route::get('get-all-categoria-subastas', 'App\Http\Controllers\SubastaController@getAllCategoriaSubastas');
Route::get('add-subasta', 'App\Http\Controllers\SubastaController@addSubasta');
Route::get('cerrar-subasta', 'App\Http\Controllers\SubastaController@cerrarSubasta');

//Producto
Route::get('get-productos', 'App\Http\Controllers\ProductoController@getProductos');
Route::get('add-producto', 'App\Http\Controllers\ProductoController@addProducto');
Route::get('disponibilizar-producto/{id}', 'App\Http\Controllers\ProductoController@disponibilizarProducto');
Route::get('rechazar-producto/{id}', 'App\Http\Controllers\ProductoController@rechazarProducto');

//Foto
Route::get('add-foto', 'App\Http\Controllers\FotoController@addFoto');

//Catalogo
Route::get('get-catalogo/{id}', 'App\Http\Controllers\CatalogoController@getCatalogo');

//ItemsCatalogo
Route::get('get-itemscatalogo-producto', 'App\Http\Controllers\ItemsCatalogoController@getItemsCatalogoProducto');
Route::get('get-items-catalogo/{id}', 'App\Http\Controllers\ItemsCatalogoController@getItemsCatalogo');
Route::get('add-items-catalogo', 'App\Http\Controllers\ItemsCatalogoController@addItemsCatalogo');

//Asistente

Route::get('add-asistente', 'App\Http\Controllers\AsistenteController@addAsistente');
Route::get('abandonar-subasta', 'App\Http\Controllers\AsistenteController@abandonarSubasta');

//Pujo
Route::get('add-puja', 'App\Http\Controllers\PujoController@addPujo');

//RegistroDeSubastas
Route::get('get-ultima-puja', 'App\Http\Controllers\RegistroDeSubastaController@getUltimaPuja');
Route::get('get-ganador-subasta/{id}', 'App\Http\Controllers\RegistroDeSubastaController@getGanadorSubasta');

//MediosDePago
Route::get('add-mediopago', 'App\Http\Controllers\MedioDePagoController@addMedioPago');
Route::get('habilitar-mediopago/{id}', 'App\Http\Controllers\MedioDePagoController@habilitarMedioDePago');
Route::get('rechazar-mediopago/{id}', 'App\Http\Controllers\MedioDePagoController@rechazarMedioDePago');
Route::get('get-mediosdepago', 'App\Http\Controllers\MedioDePagoController@getMediosDePago');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
