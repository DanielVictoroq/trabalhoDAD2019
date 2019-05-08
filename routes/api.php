<?php

use Illuminate\Http\Request;

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

// Route::resource('usuario', 'UsuarioController');
// Route::resource('consulta', 'ConsultaController');
// Route::resource('animal', 'AnimalController');
// Route::resource('endereco', 'EnderecoController');
// Route::resource('usuario-admin', 'UsuarioAdminController');
Route::group(['prefix' => 'usuario'], function () {
    Route::get('/', 'UsuarioController@index');
    Route::post('/', 'UsuarioController@CadastrarAssociado');
    Route::put('/', 'UsuarioController@AlterarSenha');
    Route::delete('/', 'UsuarioController@DeletarUsuario');
});

Route::get('/', function() {
    return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);
});
