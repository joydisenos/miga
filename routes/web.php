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
use Illuminate\Support\Facades\Auth;


Route::get('/', 'SiteController@index');
Route::get('/filtro/{categoria}', 'SiteController@filtro');

Auth::routes();

Route::get('/home', 'SiteController@index');
Route::get('/compra/{id}','SiteController@show');
Route::post('/comprar','SiteController@store')->middleware('auth');
Route::get('/checkout/c/{id}','UsuarioController@cupon_select')->middleware('auth');
Route::get('/checkout', function (){


  $compras = Auth::user()->compra->where('ordene_id','=',0);
  $datos = App\Principal::first();

  return view('checkout',compact('datos', 'compras'));

})->middleware('auth');

Route::post('checkout','UsuarioController@orden_store')->middleware('auth');

Route::get('/pago/{id}/{tipo}', 'UsuarioController@definir_pago');
Route::post('/pago/{id}/{tipo}', 'UsuarioController@mercadopago');
Route::get('/pagos/{id}/fail', 'UsuarioController@fail');
Route::get('/pagos/{id}/pendiente', 'UsuarioController@pendiente');
Route::get('/pagos/{id}/mercadopago', 'UsuarioController@success');

//User

Route::prefix('usuario')->middleware('auth')->group(function(){

  Route::get('/','UsuarioController@index');
  Route::get('/direccion','UsuarioController@direccion');
  Route::post('/direccion','UsuarioController@direccion_agregar');
  Route::get('/actualizar','UsuarioController@actualizar');
  Route::post('/actualizar','UsuarioController@actualizar_store');
  Route::get('direccion/borrar/{id}','UsuarioController@direccion_borrar');
  Route::get('compra/borrar/{id}','UsuarioController@compra_borrar');
  Route::get('compras','UsuarioController@compras');
  Route::get('canje','UsuarioController@canje');
  Route::get('/cupon/{id}','UsuarioController@canjear_cupon');
  
});


//Admin

Route::prefix('admin-panel')->group(function(){
  Route::get('/','AdminController@index');
  Route::get('/productos','AdminController@producto_index');
  Route::get('/producto','AdminController@producto_new');
  Route::get('/activar/{id}/{estatus}','AdminController@producto_activar');
  Route::get('/activarp/{id}/{estatus}','AdminController@premio_activar');
  Route::post('/producto','AdminController@producto_store');
  Route::get('/producto/{id}','AdminController@producto_editar');
  Route::post('/producto/{id}','AdminController@producto_actualizar');
   Route::get('/ventas','AdminController@ventas_index');
   Route::get('/premio', function(){
    return view('admin.premio');
   });
   Route::post('/premio','AdminController@premio_store');
   Route::get('/premios','AdminController@premio_index');
   Route::get('/premio/{id}','AdminController@premio_editar');
   Route::post('/premio/{id}','AdminController@premio_actualizar');


//Cupones

   Route::get('/cupon', function(){
    return view('admin.cupon');
   });
   Route::post('/cupon','AdminController@cupon_store');
   Route::get('/cupones','AdminController@cupon_index');
   Route::get('/cupon/{id}','AdminController@cupon_editar');
   Route::post('/cupon/{id}','AdminController@cupon_actualizar');
   Route::get('/activarc/{id}/{estatus}','AdminController@cupon_activar');


   Route::get('entregar/{id}/{estatus}','AdminController@entregar');
   
   Route::post('categoria','CategoriaController@store');

   Route::post('principal','AdminController@updateprincipal');

   Route::get('usuarios','AdminController@usuarios');

   Route::get('/categoria/edit/{id}','CategoriaController@edit');
   
   Route::get('/categoria/eliminar/{id}','CategoriaController@delete');
   
   Route::post('/categoria/{id}','CategoriaController@update');

   Route::get('/config','AdminController@config');


});

//dato Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('dato','\App\Http\Controllers\DatoController');
  Route::post('dato/{id}/update','\App\Http\Controllers\DatoController@update');
  Route::get('dato/{id}/delete','\App\Http\Controllers\DatoController@destroy');
  Route::get('dato/{id}/deleteMsg','\App\Http\Controllers\DatoController@DeleteMsg');
});

//direccione Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('direccione','\App\Http\Controllers\DireccioneController');
  Route::post('direccione/{id}/update','\App\Http\Controllers\DireccioneController@update');
  Route::get('direccione/{id}/delete','\App\Http\Controllers\DireccioneController@destroy');
  Route::get('direccione/{id}/deleteMsg','\App\Http\Controllers\DireccioneController@DeleteMsg');
});

//ordene Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('ordene','\App\Http\Controllers\OrdeneController');
  Route::post('ordene/{id}/update','\App\Http\Controllers\OrdeneController@update');
  Route::get('ordene/{id}/delete','\App\Http\Controllers\OrdeneController@destroy');
  Route::get('ordene/{id}/deleteMsg','\App\Http\Controllers\OrdeneController@DeleteMsg');
});

//compra Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('compra','\App\Http\Controllers\CompraController');
  Route::post('compra/{id}/update','\App\Http\Controllers\CompraController@update');
  Route::get('compra/{id}/delete','\App\Http\Controllers\CompraController@destroy');
  Route::get('compra/{id}/deleteMsg','\App\Http\Controllers\CompraController@DeleteMsg');
});

//cupone Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('cupone','\App\Http\Controllers\CuponeController');
  Route::post('cupone/{id}/update','\App\Http\Controllers\CuponeController@update');
  Route::get('cupone/{id}/delete','\App\Http\Controllers\CuponeController@destroy');
  Route::get('cupone/{id}/deleteMsg','\App\Http\Controllers\CuponeController@DeleteMsg');
});

//premio Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('premio','\App\Http\Controllers\PremioController');
  Route::post('premio/{id}/update','\App\Http\Controllers\PremioController@update');
  Route::get('premio/{id}/delete','\App\Http\Controllers\PremioController@destroy');
  Route::get('premio/{id}/deleteMsg','\App\Http\Controllers\PremioController@DeleteMsg');
});

//producto Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('producto','\App\Http\Controllers\ProductoController');
  Route::post('producto/{id}/update','\App\Http\Controllers\ProductoController@update');
  Route::get('producto/{id}/delete','\App\Http\Controllers\ProductoController@destroy');
  Route::get('producto/{id}/deleteMsg','\App\Http\Controllers\ProductoController@DeleteMsg');
});
