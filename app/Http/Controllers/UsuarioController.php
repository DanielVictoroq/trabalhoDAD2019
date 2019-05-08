<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Endereco;
use App\Usuario;
use Input;
use DB;

class UsuarioController extends Controller
{
    public function index(){
        $data = Usuario::with('endereco')->get();
        return response()->json($data);
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
        $endereco = Endereco::create([
            'logradouro' => $request->input('logradouro'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
            'cep' => $request->input('cep'),
            'numero' => $request->input('numero'),
            ]
        );
        
        $id = DB::getPDO()->lastInsertId();
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
                'id_endereco'=> $id
                ]
            );
            
            if($data->save()){
                return response()->json(['code'=> '200 ', 'message'=>'Usuário Cadastrado com Sucesso']);
            }
        }
        
        return response()->json(['code'=> '401 ', 'message'=>'Erro ao cadastrar Usuário']);
        
    }
    public function AlterarSenha(Request $request){

        $data = Usuario::where('nome_usuario', $request->input('nome_usuario'))->update([$request]);

        if($data){
            return response()->json(['code'=> '200 ', 'message'=>'Alterado com Sucesso']);
        }
    }
    public function RealizarLogin(){
        $data = Usuario::with('endereco')->get();
        return response()->json($data);
    }
    public function logout(){
        $data = Usuario::with('endereco')->get();
        return response()->json($data);
    }
}
