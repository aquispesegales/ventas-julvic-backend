<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VentaDet;

class VentaDetController extends Controller
{
    public function registrar(Request $request){
        
    
        foreach( $request->all() as $key=>$item){
           $venta_det = new VentaDet();
           $venta_det->venta_cab_id = $item['venta_cab_id'];
           $venta_det->producto_id = $item['producto_id'];
           $venta_det->cantidad = $item['cantidad'];
           $venta_det->fecha_registro = new \DateTime();
           $venta_det->estado_id = 1000;
           $venta_det->save();
        }

        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Se ha guarado VENTA DETALLE Correctamente'
        );

        //respuesta
        return response()->json($data,$data['code']);
     
    }
}
