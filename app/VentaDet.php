<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaDet extends Model
{
    protected $table = 'venta_det';

    //muchos ventas detalle peude tener una cabecera
    public function VentaCab(){
        return $this->belongsTo('App\VentaCab','venta_cab_id');
    }

    //muchos ventas detalles peuden tener un producto
    public function Producto(){
        return $this->belongsTo('App\Producto','producto_id');
    }

    //laravle espera por defecto las columnas created_at & updated_at, con este codigo se anula
    public $timestamps = false;

}
