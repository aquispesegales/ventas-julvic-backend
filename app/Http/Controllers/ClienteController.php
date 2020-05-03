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
            'direccion'=> 'required',
            'telefono'=> 'required',
            'correo'=> 'email',
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
        return response()->json($data,$data['code']);
     
    }

    public function actualizar ($id, Request $request){
        //validar datos enviados
        $validate = \Validator::make($request->all(),[
            'nombre'=> 'required',
            'direccion'=> 'required',
            'telefono'=> 'required',
            'correo'=> 'email',
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
        return response()->json($data,$data['code']);
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
}
