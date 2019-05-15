<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EnderecoController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Endereco;
use App\Usuario;

class AssociadoController extends Controller
{
    
    private $enderecoController;
    
    public function __construct(EnderecoController $enderecoController){
        $this->enderecoController = $enderecoController;
    }
    
    public function CadastrarAssociado(Request $request){
        $endereco = $this->enderecoController->CadastrarEndereco($request);
        if($endereco){
            $data = new Usuario();
            $data->fill([
                'nome_usuario' => $request->input('nome_usuario'),
                'nome' => $request->input('nome'),
                'sobrenome' => $request->input('sobrenome'),
                'cpf' => $request->input('cpf'),
                'data_nascimento' => $request->input('data_nascimento'),
                'email' => $request->input('email'),
                'senha' => Hash::make($request->input('password')),
                'qtdanimais'=> $request->input('qtdanimais'),
                'id_endereco'=> $endereco
                ]
            );
            
            if($data->save()){
                return response()->json(['code'=> 200 , 'message'=>'Usuário Cadastrado com Sucesso']);
            }
        }
        
        return response()->json(['code'=> 400 , 'message'=>'Erro ao cadastrar Usuário']);
        
    }
}