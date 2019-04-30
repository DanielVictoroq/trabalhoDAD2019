<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'endereco';
    
    public $incrementing = false;
    
    protected $fillable = [
        'logradouro', 'bairro', 'numero','cidade', 'estado', 'cep'
    ];
    
    protected $primaryKey = 'id_endereco';
    
    function usuario() {
        return $this->hasMany('App\Usuario','nome_usuario');
    }
}
