<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    //un cliente puede tener muchasventas cabecera
    public function VentasCab(){
        return $this->hasMany('App\VentaCab');
    }

    //MODIFICANDO CONVENCIONES
    //deshabilita campos fech apor defecto
    public $timestamps = false;
    //sobre escribe el campo key
    public function getKeyName(){
        return "cliente_id";
    }
}
