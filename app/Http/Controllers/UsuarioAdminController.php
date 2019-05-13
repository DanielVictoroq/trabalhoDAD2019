<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioAdminController extends Controller
{
    public function CadastrarGestor(Request $request){
        $data = new Usuario();
        
        $data->fill([
            'nome_usuario' => 'daniel',
            'nome' => 'nome',
            'sobrenome' => 'sobrenome',
            'cpf' => 10924707607,
            'data_nascimento' => '28/08/1992',
            'email' => 'email',
            'senha' => Hash::make('usuario'),
            'qtdanimais'=> 2
            ]
        );
    }

}
