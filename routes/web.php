<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//ruta por defecto de prueba q hace laravel
Route::get('/', function () {
    return view('welcome');
});





//Rutas de Categorias
Route::post('/api/categoria/registrar', 'CategoriaController@registrar');
Route::put('/api/categoria/actualizar/{id}', 'CategoriaController@actualizar');
Route::delete('/api/categoria/eliminar/{id}', 'CategoriaController@eliminar');
Route::get('/api/categoria/obtener-todos', 'CategoriaController@obtener_todos');

//Rutas de Clientes
Route::post('/api/cliente/registrar', 'ClienteController@registrar');
Route::put('/api/cliente/actualizar/{id}', 'ClienteController@actualizar');
Route::delete('/api/cliente/eliminar/{id}', 'ClienteController@eliminar');
Route::get('/api/cliente/obtener-todos', 'ClienteController@obtener_todos');
Route::get('/api/cliente/buscar-cliente-por-nitci/{nit_ci}', 'ClienteController@buscar_cliente_by_nitci');


//Rutas de Productos
Route::post('/api/producto/registrar', 'ProductoController@registrar');
Route::put('/api/producto/actualizar/{id}', 'ProductoController@actualizar');
Route::delete('/api/producto/eliminar/{id}', 'ProductoController@eliminar');
Route::get('/api/producto/obtener-todos', 'ProductoController@obtener_todos');

//rutas para ventas cabecera
Route::post('/api/venta-cab/registrar', 'VentaCabController@registrar');
Route::get('/api/venta-cab/ventas-realizadas', 'VentaCabController@obtenerVentasRelizadas');


//rutas para ventasdetalle
Route::post('/api/venta-det/registrar', 'VentaDetController@registrar');

//rutas para Usuarios
Route::post('/api/usuario/registrar', 'UsuarioController@registrar');
Route::put('/api/usuario/actualizar/{id}', 'UsuarioController@actualizar');
Route::delete('/api/usuario/eliminar/{id}', 'UsuarioController@eliminar');
Route::get('/api/usuario/obtener-todos', 'UsuarioController@obtener_todos');

Route::post('/api/usuario/autenticar', 'UsuarioController@autenticar');


//rupa post para chat bot
Route::post('/api/producto/todos_chat', 'ProductoController@todos_chat');




