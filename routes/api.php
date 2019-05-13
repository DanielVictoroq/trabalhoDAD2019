<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'usuario'], function () {
    Route::get('/', 'UsuarioController@index');
    Route::post('/', 'AssociadoController@CadastrarAssociado');
    Route::post('/login', 'UsuarioController@RealizarLogin');
    Route::post('/consultar', 'ConsultaController@CadastrarConsulta');
    Route::put('/', 'UsuarioController@AlterarSenha');
});

Route::group(['prefix' => 'gestor'], function () {
    Route::get('/consultas', 'ConsultaController@index');
    Route::get('/consulta', 'ConsultaController@ConsultarConsultas');
    Route::get('/relatorio-consulta', 'ConsultaController@ConsultarRelatoriosdeConsultas');
    Route::get('/gerar-relatorio', 'ConsultaController@GerarRelatorio');
    Route::post('/efetuar-consulta', 'ConsultaController@EfetuarConsulta');
    Route::post('/', 'UsuarioAdminController@CadastrarGestor');
});

Route::get('/', function() {
    return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);
});
