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
    public function ConsultarConsultas($dados){
        $usuario = Usuario::find($dados['nome_usuario']);
        if(!Hash::check($dados['senha'], $usuario->senha)){
            return false;
        }
        $data = Usuario::with('endereco', 'animal.consulta', 'consulta')->get()->find($dados['nome_usuario']);
        $dados = [
            'nome' => $data->nome,
            'sobrenome' => $data->sobrenome,
            'data_nascimento' => $data->data_nascimento,
            'cpf' => $data->cpf,
            'email' => $data->email,
            'qtdanimais' => $data->qtdanimais,
            'logradouro' => $data->endereco->logradouro,
            'bairro' => $data->endereco->bairro,
            'cidade' => $data->endereco->cidade,
            'estado' => $data->endereco->estado,
            'cep' => $data->endereco->cep,
            'animal' => [
                'nome' => $data->animal[0]->nome,
                'historico' => $data->animal[0]->historico,
                'data_nascimento' => $data->animal[0]->data_nascimento,
            ],
            'consulta' => [
                'status' => $data->consulta[0]->cidade,
                'observacoes' => $data->consulta[0]->observacoes,
                'data_hora' => $data->consulta[0]->data_hora,
                'admin' =>  $data->consulta[0]->admin,
            ],
        ];
        return $dados;
    }
    
    public function EfetuarConsulta(Request $request){
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
    public function ConsultarRelatoriosDeConsultas(Request $request){
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
    public function GerarRelatorio(Request $request){
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
