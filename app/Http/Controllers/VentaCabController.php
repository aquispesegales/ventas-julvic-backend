<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VentaCab;
use App\VentaDet;

class VentaCabController extends Controller
{
    public function registrar(Request $request){
        //validar datos enviados

        $validate = \Validator::make($request->all(),[
            'nit_ci'=> 'required',
            'cliente_id'=> 'required'
        ]);

        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{

            //si validacione s correcta procedemos a insertar a bd
            $venta_cab = new VentaCab();
            $venta_cab->nit_ci = $request->input('nit_ci');
            $venta_cab->cliente_id = $request->input('cliente_id');
            $venta_cab->fecha_registro = new \DateTime();
            $venta_cab->con_factura = $request->input('con_factura');
            $venta_cab->estado_id = 1000;
            $venta_cab->save();
 
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Se ha guarado VENTA CABECERA Correctamente',
                'venta_cab'=>$venta_cab
            );
        }

        //respuesta
        return response()->json($data,200);
     
    }

    public function obtenerVentasRelizadas(){

        
        


        $ventas_realizadas = VentaCab::with(['VentasDet.Producto','cliente'])->get();
        //$ventas_realizadas = VentaCab::all();
        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Se ha Obtenito ventas Relizadas',
            'ventas_cab'=>$ventas_realizadas
        );
        return response()->json($data,$data['code']);
    }
}
