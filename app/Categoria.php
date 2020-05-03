<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
 
    protected $table = 'categoria';

   

    //una categoria puede tener muchos productos
    public function productos(){
        return $this->hasMany('App\Producto');
    }
 


     //MODIFICANDO CONVENCIONES
     //deshabilita campos fech apor defecto
     public $timestamps = false;
     //sobre escribe el campo key
     public function getKeyName(){
        return "categoria_id";
    }
   
}
