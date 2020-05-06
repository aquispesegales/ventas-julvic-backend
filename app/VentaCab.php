<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaCab extends Model
{
    protected $table = 'venta_cab';

    //una vecnta cabeceera puede tener muchas ventas detalle
    public function VentasDet(){
        return $this->hasMany('App\VentaDet','venta_cab_id','venta_cab_id');

    }

    //muchas ventas detalle peude tener un cliente
    public function cliente(){
        return $this->belongsTo('App\Cliente','cliente_id');
    }

    //laravle espera por defecto las columnas created_at & updated_at, con este codigo se anula
    public $timestamps = false;
}
