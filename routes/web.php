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

Route::get('/', 'SiteController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/compra/{id}','SiteController@show');
Route::post('/comprar','SiteController@store')->middleware('auth');
Route::get('/checkout', function (){

  return view('checkout');
})->middleware('auth');

Route::post('checkout','UsuarioController@orden_store');

Route::get('/pago/{id}/{tipo}', 'UsuarioController@definir_pago');

//User

Route::prefix('usuario')->group(function(){

  Route::get('/','UsuarioController@index');
  Route::get('/direccion','UsuarioController@direccion');
  Route::post('/direccion','UsuarioController@direccion_agregar');
  Route::get('/actualizar','UsuarioController@actualizar');
  Route::post('/actualizar','UsuarioController@actualizar_store');
  Route::get('direccion/borrar/{id}','UsuarioController@direccion_borrar');
  Route::get('compra/borrar/{id}','UsuarioController@compra_borrar');
  Route::get('compras','UsuarioController@compras');
  
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

   Route::get('/cupon', function(){
    return view('admin.cupon');
   });
   Route::post('/cupon','AdminController@cupon_store');
   Route::get('/cupones','AdminController@cupon_index');
   Route::get('/cupon/{id}','AdminController@cupon_editar');
   Route::post('/cupon/{id}','AdminController@cupon_actualizar');
   Route::get('entregar/{id}/{estatus}','AdminController@entregar');
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
