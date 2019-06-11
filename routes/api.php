<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'usuario'], function () {
    Route::post('/', 'UsuarioController@index');
    Route::post('/cadastro', 'AssociadoController@CadastrarAssociado');
    Route::post('/login', 'UsuarioController@RealizarLogin');
    Route::post('/consultar', 'ConsultaController@CadastrarConsulta');
    Route::put('/', 'UsuarioController@AlterarSenha');
    Route::get('/get','UsuarioController@buscarUsuarios');
});
Route::group(['prefix' => 'animal'], function () {
    Route::get('/', 'AnimalController@index');
    Route::post('/', 'AnimalController@CadastrarAnimal');
    Route::delete('/', 'AnimalController@RetirarAnimal');
});

Route::group(['prefix' => 'gestor'], function () {
    Route::get('/consultas', 'ConsultaController@index');
    Route::get('/consulta', 'ConsultaController@ConsultarConsultas');
    Route::post('/efetuar-consulta', 'ConsultaController@EfetuarConsulta');
    Route::post('/', 'UsuarioAdminController@CadastrarGestor');
});

Route::post('/u','UsuarioController@index');
