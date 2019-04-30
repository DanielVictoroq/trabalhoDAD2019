<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
    public function index(){
        $data = Usuario::with('endereco')->get();
        return response()->json($data);
    }
    
    public function CriarUsuario(Request $request){
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
    public function AtualizarValor(){
        $data = Usuario::with('endereco')->get();
        return response()->json($data);
    }
    public function DeletarUsuario(){
        $data = Usuario::with('endereco')->get();
        return response()->json($data);
    }
}
