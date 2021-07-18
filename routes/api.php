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
Route::get('update-datos-persona', 'App\Http\Controllers\PersonaController@updateDatosPersona');

//User
Route::get('add-user', 'App\Http\Controllers\UserController@addUser');
Route::get('login', 'App\Http\Controllers\UserController@login');
Route::get('generate-password', 'App\Http\Controllers\UserController@generatePassword');
Route::get('get-user-bypersona', 'App\Http\Controllers\UserController@getUserByPersona');
Route::get('changeemail-user', 'App\Http\Controllers\UserController@changeEmail');

//Login
Route::get('get-currentuser', 'App\Http\Controllers\Auth\LoginController@getCurrentUser');

//Cliente
Route::get('add-cliente', 'App\Http\Controllers\ClienteController@addCliente');
Route::get('admitir-cliente/{id}', 'App\Http\Controllers\ClienteController@admitirCliente');
Route::get('get-cliente', 'App\Http\Controllers\ClienteController@getCliente');
Route::get('actualizar-categoria-cliente', 'App\Http\Controllers\ClienteController@actualizarCategoriaCliente');

//Subasta
Route::get('get-all-subastas', 'App\Http\Controllers\SubastaController@getAllSubastas');
Route::get('get-all-categoria-subastas', 'App\Http\Controllers\SubastaController@getAllCategoriaSubastas');
Route::get('add-subasta', 'App\Http\Controllers\SubastaController@addSubasta');
Route::get('cerrar-subasta', 'App\Http\Controllers\SubastaController@cerrarSubasta');
Route::get('abandonar-subasta', 'App\Http\Controllers\SubastaController@abandonarSubasta');
Route::get('get-subasta-producto', 'App\Http\Controllers\SubastaController@getSubastaProducto');
Route::get('get-ganador-subasta', 'App\Http\Controllers\SubastaController@getGanadorSubasta');
Route::get('get-subasta-cliente', 'App\Http\Controllers\SubastaController@getSubastaDeCliente');

//Producto
Route::get('get-productos', 'App\Http\Controllers\ProductoController@getProductos');
Route::get('add-producto', 'App\Http\Controllers\ProductoController@addProducto');
Route::get('aceptar-producto', 'App\Http\Controllers\ProductoController@aceptarProducto');
Route::get('rechazar-producto', 'App\Http\Controllers\ProductoController@rechazarProducto');
Route::get('get-es-duenio', 'App\Http\Controllers\ProductoController@getEspectadorEsDuenio');

//Foto
Route::get('add-foto', 'App\Http\Controllers\FotoController@addFoto');

//Catalogo
Route::get('get-catalogo/{id}', 'App\Http\Controllers\CatalogoController@getCatalogo');

//ItemsCatalogo
Route::get('get-itemscatalogo-producto', 'App\Http\Controllers\ItemsCatalogoController@getItemsCatalogoProducto');
Route::get('get-items-catalogo/{id}', 'App\Http\Controllers\ItemsCatalogoController@getItemsCatalogo');
Route::get('add-items-catalogo', 'App\Http\Controllers\ItemsCatalogoController@addItemsCatalogo');
Route::get('item-subastado', 'App\Http\Controllers\ItemsCatalogoController@itemSubastado');

//Asistente
Route::get('add-asistente', 'App\Http\Controllers\AsistenteController@addAsistente');

//Pujo
Route::get('add-puja', 'App\Http\Controllers\PujoController@addPujo');

//RegistroDeSubastas
Route::get('get-ultima-puja', 'App\Http\Controllers\RegistroDeSubastaController@getUltimaPuja');
Route::get('get-ganador-subasta/{id}', 'App\Http\Controllers\RegistroDeSubastaController@getGanadorSubasta');

//MediosDePago
Route::get('add-mediopago', 'App\Http\Controllers\MedioDePagoController@addMedioPago');
Route::get('habilitar-mediopago', 'App\Http\Controllers\MedioDePagoController@habilitarMedioDePago');
Route::get('rechazar-mediopago', 'App\Http\Controllers\MedioDePagoController@rechazarMedioDePago');
Route::get('get-mediosdepago', 'App\Http\Controllers\MedioDePagoController@getMediosDePago');
Route::get('default-mediosdepago', 'App\Http\Controllers\MedioDePagoController@defaultMedioDePago');
Route::get('eliminar-mediosdepago', 'App\Http\Controllers\MedioDePagoController@eliminarMedioDePago');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
