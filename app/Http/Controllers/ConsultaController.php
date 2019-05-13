<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Usuario;
class ConsultaController extends Controller
{
    public function index(Request $request){
        $dados = Consulta::all();
        return response()->json($dados);    
    }
    
    public function ConsultarConsultas(Request $request){
        $dados = Usuario::with('consulta')->get();
        return response()->json($dados);   
        $dados = Consulta::with(['animal','usuario'])->find($request->input('id'));
        if($dados){
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
            return response()->json(['code'=> '200 ', 'message'=>'Consulta registrada com sucesso']);
        }
        
        return response()->json(['code'=> '400 ', 'message'=>'Erro ao registrar consulta']);
    }
    
    public function ConsultarRelatoriosdeConsultas(){
        
    }
    
    public function EfetuarConsulta(){
        
    }
    
    public function GerarRelatorio(){
        
    }
}
