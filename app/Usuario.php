<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    public $incrementing = false;
    
    protected $fillable = [
        'nome_usuario','nome', 'sobrenome', 'cpf','data_nascimento', 'email', 'senha','qtdanimais', 'id_endereco'
    ];

    protected $primaryKey = 'nome_usuario';

    function endereco() {
        return $this->belongsTo('App\Endereco','id_endereco');
    }
    function animal() {
        return $this->hasMany('App\Animal','nome_usuario');
    }
    function consulta() {
        return $this->hasMany('App\Consulta','cliente');
    }
    function admin() {
        return $this->hasMany('App\Admin','nome_usuario');
    }
}
