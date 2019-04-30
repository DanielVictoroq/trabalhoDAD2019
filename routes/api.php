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

Route::get('/usuario', 'UsuarioController@index');
Route::post('/usuario', 'UsuarioController@CriarUsuario');
Route::put('/usuario', 'UsuarioController@AtualizarValor');
Route::delete('/usuario', 'UsuarioController@DeletarUsuario');

Route::get('/', function() {
    return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);
});
