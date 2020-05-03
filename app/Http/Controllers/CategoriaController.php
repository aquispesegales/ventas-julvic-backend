<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    public function registrar(Request $request){
        //validar datos enviados
        $validate = \Validator::make($request->all(),[
            'nombre'=> 'required',
            'descripcion'=> 'required',
        ]);
        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{
            //si validacione s correcta procedemos a insertar a bd
            $categoria = new Categoria();
            $categoria->nombre = $request->input('nombre');
            $categoria->descripcion = $request->input('descripcion');
            $categoria->fecha_registro = new \DateTime();
            $categoria->estado_id = 1000;
            $categoria->save();
 
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Se ha guarado correctamente',
                'categoria'=>$categoria
            );
        }

        //respuesta
        return response()->json($data,$data['code']);
     
    }

    public function actualizar ($id, Request $request){
        //validar datos enviados
        $validate = \Validator::make($request->all(),[
            'nombre'=> 'required',
            'descripcion'=> 'required',
        ]);

        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{

            $categoria = Categoria::find($id);
            $categoria->nombre = $request->input('nombre');
            $categoria->descripcion = $request->input('descripcion');
            $categoria->fecha_modificacion = new \DateTime();
            $categoria->save();
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Actualizacion Correcta',
                'categoria'=>$categoria
            );
        }

        //respuesta
        return response()->json($data,$data['code']);
    }

    public function eliminar ($id){
        //buscar el registro
        $categoria = Categoria::find($id);

        //borrar
        $categoria->delete();

        //respuesta
        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Eliminacion Correcta',
            'categoria'=>$categoria
        );
        return response()->json($data,$data['code']);

    }

    public function obtener_todos(){
        $categorias = Categoria::all();

        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Obtencion de Categoria Exitoso',
            'categorias'=>$categorias
        );

        return response()->json($data,$data['code']);

    }
   
}
