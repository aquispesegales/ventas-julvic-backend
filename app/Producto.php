<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';

    //un producto puede tener muchas ventas detalle
    public function VentasDet(){
        return $this->hasMany('App\VentaDet');
    }

    //muchos productos pude tener una categroai
    public function categoria(){
        return $this->belongsTo('App\Categoria','categoria_id');
    }

    //MODIFICANDO CONVENCIONES
    //deshabilita campos fech apor defecto
    public $timestamps = false;
    //sobre escribe el campo key
    public function getKeyName(){
        return "producto_id";
    }
}
