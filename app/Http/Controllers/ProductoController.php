<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function registrar(Request $request){
        //validar datos enviados

        $validate = \Validator::make($request->all(),[
            'nombre'=> 'required',
            'descripcion'=> 'required',
            'precio'=> 'required',
            'stock'=> 'required',
            'categoria_id'=>'required'
        ]);

        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{

            //si validacione s correcta procedemos a insertar a bd
            $producto = new Producto();
            $producto->nombre = $request->input('nombre');
            $producto->descripcion = $request->input('descripcion');
            $producto->precio = $request->input('precio');
            $producto->stock = $request->input('stock');
            $producto->categoria_id = $request->input('categoria_id');
           

            $producto->fecha_registro = new \DateTime();
            $producto->estado_id = 1000;
            $producto->save();
 
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Se ha guarado PRODUCTO Correctamente',
                'producto'=>$producto
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
            'precio'=> 'required',
            'stock'=> 'required',
            'categoria_id'=>'required'
        ]);

        if($validate->fails()){
            $data = array(
                'status'=>'error',
                'code'=>404,
                'message'=>$validate->errors()
            );
        }else{

            $producto = Producto::find($id);
            $producto->nombre = $request->input('nombre');
            $producto->descripcion = $request->input('descripcion');
            $producto->precio = $request->input('precio');
            $producto->stock = $request->input('stock');
            $producto->categoria_id = $request->input('categoria_id');
            $producto->fecha_modificacion = new \DateTime();
            $producto->save();
            $data = array(
                'status'=>'success',
                'code'=>200,
                'message'=>'Actualizacion PRODUCTO Exitosa',
                'producto'=>$producto
            );
        }

        //respuesta
        return response()->json($data,$data['code']);
    }

    public function eliminar ($id){
        //buscar el registro
        $producto = Producto::find($id);

        //borrar
        $producto->delete();

        //respuesta
        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Eliminacion   PRODUCTO Correcta',
            'producto'=>$producto
        );
        return response()->json($data,$data['code']);

    }
    
    public function obtener_todos(){
        //$productos = Producto::all();
       

        $productos = Producto::with('categoria')->get();


        $data = array(
            'status'=>'success',
            'code'=>200,
            'message'=>'Obtencion de PRODUCTOS Exitoso',
            'productos'=>$productos
        );

        return response()->json($data,$data['code']);

    }
}
