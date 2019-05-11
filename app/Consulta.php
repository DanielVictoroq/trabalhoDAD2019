<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consulta';
    
    public $incrementing = false;
    
    protected $fillable = [
        'status', 'observacoes', 'data_hora','admin', 'cliente', 'id_animal'
    ];
    
    protected $primaryKey = 'id_consulta';
    
    function animal() {
        return $this->belongsTo('App\Animal','id_animal');
    }
    function usuario() {
        return $this->belongsTo('App\Usuario','nome_usuario');
    }
    function admin() {
        return $this->belongsTo('App\UsuarioAdmin','nome_usuario');
    }
}
