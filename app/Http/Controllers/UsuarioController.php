<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EnderecoController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Endereco;
use App\Usuario;
use Input;
use DB;

class UsuarioController extends Controller
{
    private $enderecoController;

    public function __construct(EnderecoController $enderecoController){
        $this->enderecoController = $enderecoController;
    }

    public function index(){
        // $data = Usuario::with('endereco')->get();
        
        $usuario = Usuario::where('nome_usuario' ,'danielvqw')->where('senha','$2y$10$VNn6iRrtAdOszN4lRxYsSuBRRcOAnHHo.vRSO.4vghiU/Z7yCC02.')->get();
        if(isset($usuario[0])){

            return response($usuario);
        }
        else{
            
            return response()->json(["dasdasdas", $usuario]);
        }
        
        return response()->json($dados);
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
                return response()->json(['code'=> '200 ', 'message'=>'Usuário Cadastrado com Sucesso']);
            }
        }
        
        return response()->json(['code'=> '401 ', 'message'=>'Erro ao cadastrar Usuário']);
        
    }
    public function AlterarSenha(Request $request){
        
        $data = Usuario::find($request->input('nome_usuario'));
        if($data){
            $data->senha =  Hash::make($request->input('password'));
            if($data->save()){
                return response()->json(['code'=> '200 ', 'message'=>'Alterado com Sucesso']);
            }
        }
        else{
            return response()->json(['code'=> '400 ', 'message'=>'Usuário não existe']);
        }
        
    }
    public function RealizarLogin(Request $request){
        
        if(!$request->input('nome_usuario') || !$request->input('senha')){
            return response()->json(['code'=> '400 ', 'message'=>'Usuário e senha não encontrados']);
        }

        $usuario = Usuario::where('nome_usuario' , $request->input('nome_usuario'))->where('senha', Hash::make($request->input('password')))->get();
        if(!isset($usuario[0])){
            return response()->json(['code'=> '400 ', 'message'=>'Usuário e senha não encontrados']);
        }
        $data = Usuario::with('endereco', 'animal.consulta', 'consulta')->get()->find($request->input('nome_usuario'));

        if($data){
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
            return response()->json(['code'=> '200 ', 'dados'=> $dados]);
        }
        else{
            return response()->json(['code'=> '400 ', 'message'=>'Usuário e senha não encontrados']);
        }
    }
}
