<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Endereco;
use DB;

class EnderecoController extends Controller
{
    public function CadastrarEndereco($request){
        Endereco::create([
            'logradouro' => $request->input('logradouro'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
            'cep' => $request->input('cep'),
            'numero' => $request->input('numero'),
            ]
        );
        
        $id = DB::getPDO()->lastInsertId();
        return $id;
    }
}
