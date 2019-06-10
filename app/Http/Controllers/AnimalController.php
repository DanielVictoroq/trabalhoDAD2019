<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\Usuario;

class AnimalController extends Controller
{
    public function index(Request $request){
        $dados = Usuario::with(['animal'])->get()->find($request->input('nome_usuario'));
        return response()->json(['dados' => $dados->animal]);    
    }
    
    public function CadastrarAnimal(Request $request){
        $data = new Animal();
        $data->fill([
            'nome_usuario' => $request->input('nome_usuario'),
            'historico' => $request->input('historico'),
            'nome' => $request->input('nome'),
            'data_nascimento' => $request->input('data_nascimento'),
            ]
        );
        
        if($data->save()){
            $dados = Usuario::with(['animal'])->get()->find($request->input('nome_usuario'));
            return response()->json(['code'=> 200 , 'message'=>'Animal Cadastrado com Sucesso', 
            'dados' => $dados->animal[0]]);
        }
        return response()->json(['code'=> 400 , 'message'=>'Erro ao cadastrar Animal']);
        
    }
    
    public function RetirarAnimal(Request $request){
        $data = Animal::find($request->input('id'));
        if($data){
            $data->delete();
            return response()->json(['code'=> 200 , 'message'=>'Animal excluído com sucesso']);
        }
        return response()->json(['code'=> 400 , 'message'=>'Erro ao excluir animal']);
    }
    
    
}
