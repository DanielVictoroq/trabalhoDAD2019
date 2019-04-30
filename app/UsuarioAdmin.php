<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioAdmin extends Model
{
    protected $table = 'admin';
    
    public $incrementing = false;
    
    protected $fillable = [
        'CRMV', 'matricula',
    ];
    
    protected $primaryKey = 'nome_usuario';
    
    function usuario() {
        return $this->belongsTo('App\Usuario','nome_usuario');
    }

}
