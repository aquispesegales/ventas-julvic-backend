<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    //MODIFICANDO CONVENCIONES
    //deshabilita campos fech apor defecto
    public $timestamps = false;
    //sobre escribe el campo key
    public function getKeyName(){
        return "usuario_id";
    }
}
