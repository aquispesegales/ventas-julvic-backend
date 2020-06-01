<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{

    public function registrar(Request $request){
        //validar datos enviados
        $validate = \Validator::make($request->all(),[
            'ci'=> 'required',
            'nombre'=> 'required',
            'usuario_pc'=> 'required'
        ]);

        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{
            //si validacione s correcta procedemos a insertar a bd
            $usuario = new Usuario();
            $usuario->ci = $request->input('ci');
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido_pat = $request->input('apellido_pat');
            $usuario->apellido_mat = $request->input('apellido_mat');
            $usuario->usuario_pc = $request->input('usuario_pc');
            $usuario->es_admin = $request->input('es_admin');
            $usuario->fecha_registro = new \DateTime();
            $usuario->estado_id = 1000;
            $usuario->save();
 
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Se ha guarado USUARIO Correctamente',
                'usuario'=>$usuario
            );
        }

        //respuesta
        return response()->json($data,200);
     
    }

    public function actualizar ($id, Request $request){
        //validar datos enviados
        
        $validate = \Validator::make($request->all(),[
            'ci'=> 'required',
            'nombre'=> 'required',
            'usuario_pc'=> 'required'
        ]);

        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{

            $usuario = Usuario::find($id);
            $usuario->ci = $request->input('ci');
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido_pat = $request->input('apellido_pat');
            $usuario->apellido_mat = $request->input('apellido_mat');
            $usuario->usuario_pc = $request->input('usuario_pc');
            $usuario->es_admin = $request->input('es_admin');
            $usuario->fecha_modificacion = new \DateTime();
            $usuario->save();
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Actualizacion USUARIO Exitosa',
                'usuario'=>$usuario
            );
        }

        //respuesta
        return response()->json($data,200);
    }

    public function eliminar ($id){
        //buscar el registro
        $usuario = Usuario::find($id);

        //borrar
        $usuario->delete();

        //respuesta
        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Eliminacion USUARIO Correcta',
            'usuario'=>$usuario
        );
        return response()->json($data,$data['code']);

    }


    public function obtener_todos(){
        $usuarios = Usuario::all();

        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Obtencion de USUARIOS Exitoso',
            'usuarios'=>$usuarios
        );

        return response()->json($data,$data['code']);

    }

    public function autenticar(Request $request){



        $validate = \Validator::make($request->all(),[
            'usuario_pc'=> 'required',
            'ci'=> 'required',
        ]);

        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{
            $usuario = Usuario::where('usuario_pc','=',$request->input('usuario_pc'))
                                ->where('ci','=',$request->input('ci'))
                                ->get();
            if(count($usuario)>0){
                $data = array('status'=>'success',
                'code'=>200,
                'message'=>'Autenticacion correcta',
                'usuario'=>$usuario
              );
            }else{
                $data = array('status'=>'success',
                'code'=>400,
                'message'=>'Usuario No Existe',
                'usuario'=>$usuario
              );
            }

            
        }
        return response()->json($data,200);
    }
}
