<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'animal';
    
    public $incrementing = false;
    
    protected $fillable = [
        'nome', 'data_nascimento', 'historico','nome_usuario',
    ];
    
    protected $primaryKey = 'id_animal';
    
    function usuario() {
        return $this->belongsTo('App\Usuario','nome_usuario');
    }
    function consulta() {
        return $this->hasMany('App\Consulta','id_consulta');
    }
}
