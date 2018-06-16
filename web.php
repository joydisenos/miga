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

Auth::routes();

Route::get('/', 'CamController@index');
Route::get('/filtrar/{filtro}', 'CamController@filtrar');



Route::resource('camara', 'CamController');


Route::group(['middleware'=> 'auth'],function(){

Route::get('/usuario', 'HomeController@index');
Route::get('/dato/{id}','DatoController@editar');
Route::post('/dato/{id}/actualizar','DatoController@actualizar');
Route::get('/comprar','MovimientoController@comprar');
Route::post('/comprar','MovimientoController@store');

Route::get('/movimientos', 'MovimientoController@listausuario');

});

//abono

Route::group(['middleware'=> ['role:admin|superadmin|dev']],function(){
Route::get('/abonar/{id}','BilleteraController@aprobar');
Route::get('/negar/{id}','BilleteraController@negar');
});

//dato Routes
Route::group(['middleware'=> ['role:admin|superadmin|dev']],function(){
  Route::resource('dato','\App\Http\Controllers\DatoController');
  Route::post('dato/{id}/update','\App\Http\Controllers\DatoController@update');
  Route::get('dato/{id}/delete','\App\Http\Controllers\DatoController@destroy');
  Route::get('dato/{id}/deleteMsg','\App\Http\Controllers\DatoController@DeleteMsg');
  Route::get('perfil',
  		'DatoController@mostrar');
  Route::get('perfil/{id}',
  	  '\App\Http\Controllers\DatoController@edit');
});

//movimiento Routes
Route::group(['middleware'=> ['role:admin|superadmin|dev']],function(){
  Route::resource('movimiento','\App\Http\Controllers\MovimientoController');
  Route::post('movimiento/{id}/update','\App\Http\Controllers\MovimientoController@update');
  Route::get('movimiento/{id}/delete','\App\Http\Controllers\MovimientoController@destroy');
  Route::get('movimiento/{id}/deleteMsg','\App\Http\Controllers\MovimientoController@DeleteMsg');
});
//billetera Routes
Route::group(['middleware'=> ['role:admin|superadmin|dev']],function(){
  Route::resource('billetera','\App\Http\Controllers\BilleteraController');
  Route::post('billetera/{id}/update','\App\Http\Controllers\BilleteraController@update');
  Route::get('billetera/{id}/delete','\App\Http\Controllers\BilleteraController@destroy');
  Route::get('billetera/{id}/deleteMsg','\App\Http\Controllers\BilleteraController@DeleteMsg');
});

//foto Routes
Route::group(['middleware'=> 'auth'],function(){
  Route::resource('foto','\App\Http\Controllers\FotoController');
  Route::post('foto/guardar','\App\Http\Controllers\FotoController@store');
  Route::post('foto/{id}/update','\App\Http\Controllers\FotoController@update');
  Route::get('foto/{id}/delete','\App\Http\Controllers\FotoController@destroy');
  Route::get('foto/{id}/deleteMsg','\App\Http\Controllers\FotoController@DeleteMsg');
});
