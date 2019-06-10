<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Usuario;
class ConsultaController extends Controller
{
    public function index(Request $request){
        $dados = Consulta::with(['animal','usuario','admins.usuario'])->get();
        return response()->json($dados);    
    }
    
    public function ConsultarConsultas(Request $request){
        $dados = Consulta::with(['animal','usuario','admins.usuario'])->find($request->input('id')); 
        if($dados){
            return response()->json(['code'=> 200,'dados' =>$dados]);   
        }
        return response()->json(['code'=> 400 , 'message' => 'Consulta não encontrada']);   
    }
    
    public function CadastrarConsulta(Request $request){
        
        $data = new Consulta();
        $data->fill([
            'status' => 'A',
            'observacoes' => $request->input('observacoes'),
            'data_hora' => $request->input('data_hora'),
            'cliente' => $request->input('nome_usuario'),
            'id_animal' => $request->input('animal'),
            ]
        );
        
        if($data->save()){
            $dados = Usuario::with(['consulta'])->get()->find($request->input('nome_usuario'));

            return response()->json(['code'=> 200, 'message'=>'Consulta registrada com sucesso', 
            'dados' => $dados->consulta[0]]);
        }
        
        return response()->json(['code'=> 400, 'message'=>'Erro ao registrar consulta']);
    }
    
    public function EfetuarConsulta(Request $request){
        
        $data = Consulta::find($request->input('id'));
        if($data){
            $data->admin =  $request->input('nome_usuario');
            $data->observacoes =  $request->input('observacoes');
            $data->status =  'F';

            if($data->save()){
                return response()->json(['code'=> 200 , 'message'=>'Consulta Efetuada com Sucesso']);
            }
        }
        else{
            return response()->json(['code'=> 400 , 'message'=>'Erro ao concluir a consulta']);
        }
    }
}
