<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;


class ClienteController extends Controller
{
    public function registrar(Request $request){
        //validar datos enviados
        $validate = \Validator::make($request->all(),[
            'nombre'=> 'required',
            'apellido_pat'=> 'required',
            'apellido_mat'=> 'required',
            'nit_ci'=> 'required'
        ]);

        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{
            //si validacione s correcta procedemos a insertar a bd
            $cliente = new Cliente();
            $cliente->nombre = $request->input('nombre');
            $cliente->nit_ci = $request->input('nit_ci');
            $cliente->apellido_pat = $request->input('apellido_pat');
            $cliente->apellido_mat = $request->input('apellido_mat');
            $cliente->correo = $request->input('correo');
            $cliente->telefono = $request->input('telefono');
            $cliente->direccion = $request->input('direccion');
            $cliente->fecha_registro = new \DateTime();
            $cliente->estado_id = 1000;
            $cliente->save();
 
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Se ha guarado CLIENTE Correctamente',
                'cliente'=>$cliente
            );
        }

        //respuesta
        return response()->json($data,200);
     
    }

    public function actualizar ($id, Request $request){
        //validar datos enviados
        $validate = \Validator::make($request->all(),[
            'nombre'=> 'required',
            'apellido_pat'=> 'required',
            'apellido_mat'=> 'required',
            'nit_ci'=> 'required'
        ]);

        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{

            $cliente = Cliente::find($id);
            $cliente->nombre = $request->input('nombre');
            $cliente->nit_ci = $request->input('nit_ci');
            $cliente->apellido_pat = $request->input('apellido_pat');
            $cliente->apellido_mat = $request->input('apellido_mat');
            $cliente->correo = $request->input('correo');
            $cliente->telefono = $request->input('telefono');
            $cliente->direccion = $request->input('direccion');
            $cliente->fecha_modificacion = new \DateTime();
            $cliente->save();
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Actualizacion CLIENTE Exitosa',
                'cliente'=>$cliente
            );
        }

        //respuesta
        return response()->json($data,200);
    }

    public function eliminar ($id){
        //buscar el registro
        $cliente = Cliente::find($id);

        //borrar
        $cliente->delete();

        //respuesta
        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Eliminacion    CLIENTE Correcta',
            'cliente'=>$cliente
        );
        return response()->json($data,$data['code']);

    }
    
    public function obtener_todos(){
        $clientes = Cliente::all();

        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Obtencion de CLIENTES Exitoso',
            'clientes'=>$clientes
        );

        return response()->json($data,$data['code']);

    }

    public function buscar_cliente_by_nitci($nit_ci){
         //buscar el registro
      
        /*echo $nit_ci;
        die();*/
         
       

         $cliente = Cliente::where('nit_ci', $nit_ci)->get();

         
        if($cliente!=null && count($cliente)>0){
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Cliente encontrado correctamente',
                'cliente'=>$cliente[0]
            );
    
        }else{
            $data = array(
                'status'=>'success',
                'code'=>400,
                'message'=>'Cliente NO correctamente',
            );
        }
     
        return response()->json($data,200);
    }
}
