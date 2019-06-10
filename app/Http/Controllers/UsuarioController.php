<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\UsuarioAdmin;
use App\Usuario;

class UsuarioController extends Controller
{
    public function index(Request $request){
        $usuario = $request->input('usuario');
        $data = Usuario::with('endereco')->get()->find($usuario);
        if(!$data){
            
            return response()->json(['code'=> 200 , 'message'=>'Usuario não existe em nossa base de dados']);
        }   
        
        return response()->json(['code'=> 400 , 'message'=>'Usuário Existente']);
    }
    
    public function validation($request){
        
        return Validator::make($request, 
        [
            'nome_usuario' =>['required', 'max:12'],
            'nome' => ['required'],
            'sobrenome' => ['required'],
            'cpf' => ['required','max:15'],
            'data_nascimento' => ['required','date'],
            'email' => ['email,required'],
            'senha' => ['required'],
            'logradouro'  => ['required'],
            'bairro'  => ['required'],
            'cidade'  => ['required'],
            'estado'  => ['required'],
            'cep'  => ['required','max:8'],
            ]
        );
    }
    
    public function AlterarSenha(Request $request){
        
        $data = Usuario::find($request->input('nome_usuario'));
        if($data){
            $data->senha =  Hash::make($request->input('senha'));
            if($data->save()){
                return response()->json(['code'=> 200 , 'message'=>'Alterado com Sucesso']);
            }
        }
        else{
            return response()->json(['code'=> 400 , 'message'=>'Usuário não existe']);
        }
        
    }
    public function RealizarLogin(Request $request){
        
        if(!$request->input('nome_usuario') || !$request->input('senha')){
            return response()->json(['code'=> 400 , 'message'=>'Usuário e senha não foram informados']);
        }
        
        $usuario = Usuario::find($request->input('nome_usuario'));
        if(!$usuario){
            return response()->json(['code'=> 400 , 'message'=>'Usuário não encontrado']);
        }
        else if(!Hash::check($request->input('senha'), $usuario->senha)){
            return response()->json(['code'=> 400 , 'message'=>'Senha Incorreta']);
        }
        $data = Usuario::with('endereco','animal.consulta', 'consulta')->get()->find($request->input('nome_usuario'));
        $dataAnimal = Usuario::with('animal')->get()->find($request->input('nome_usuario'));
        
        if($data){
            $dados = [
                'nome_usuario' => $data->nome_usuario,
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
                'numero' => $data->endereco->numero,
                'admin' => false,
                
            ];
            if(UsuarioAdmin::find($request->input('nome_usuario'))){
                $dados['admin'] = true;
                $dado = Usuario::with('admin')->get()->find($request->input('nome_usuario'));
                $dados['adminDados'] = $dado->admin;
            }
            
            if(isset($data->animal)){
                foreach($data->animal as $value){
                    $dados['animal'][] =[
                        'nome' => $value->nome,
                        'historico' => $value->historico,
                        'data_nascimento' => $value->data_nascimento,
                        'id' => $value->id_animal,
                    ];
                }    
            }
            if(isset($data->consulta[0])){
                $dados['consulta'] = [
                    'status' => $data->consulta[0]->cidade,
                    'observacoes' => $data->consulta[0]->observacoes,
                    'data_hora' => $data->consulta[0]->data_hora,
                    'admin' =>  $data->consulta[0]->admin,
                ];
            }
            return response()->json(['code'=> 200 , 'dados'=> $dados]);
        }
        else{
            return response()->json(['code'=> 400 , 'message'=>'Erro ao buscar dados no banco']);
        }
    }
}
