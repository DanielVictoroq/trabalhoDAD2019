<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'usuario'], function () {
    Route::get('/', 'UsuarioController@index');
    Route::post('/', 'UsuarioController@CadastrarAssociado');
    Route::post('/login', 'UsuarioController@RealizarLogin');
    Route::put('/', 'UsuarioController@AlterarSenha');
});

Route::group(['prefix' => 'gestor'], function () {
    Route::get('/', 'UsuarioAdminController@index');
    Route::post('/', 'UsuarioAdminController@CadastrarAssociado');
    Route::post('/login', 'UsuarioAdminController@RealizarLogin');
    Route::put('/', 'UsuarioAdminController@AlterarSenha');
});

Route::get('/', function() {
    return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);
});
