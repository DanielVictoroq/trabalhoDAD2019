<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table = 'usuario';

    public $incrementing = false;
    
    protected $fillable = [
        'nome', 'sobrenome', 'cpf','data_nascimento', 'email', 'senha','qtdanimais', 'id_endereco'
    ];

    protected $primaryKey = 'nome_usuario';

    function endereco() {
        return $this->belongsTo('App\Endereco','id_endereco');
    }
    function admin() {
        return $this->hasMany('App\Admin','nome_usuario');
    }
}
