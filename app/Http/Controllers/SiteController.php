<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producto;
use App\Compra;

class SiteController extends Controller
{
    //

    public function index()
    {
    	//principal
    	$productos = Producto::where('estatus','=','1')->get();

    	return view('inicio',compact('productos'));
    }

    public function show($id)
    {
    	$producto = Producto::findOrFail($id);
    	return view ('compra' , compact('producto'));
    }
    public function store(Request $request)
    {
    	$compra = new Compra();
    	$compra->user_id = Auth::user()->id;
    	$compra->ordene_id = 0;
    	$compra->producto_id = $request->producto_id;
    	$compra->cantidad = $request->cantidad;
    	$compra->save();
    	return redirect('/')->with('status','Producto agregado al carrito exitosamente!');
    }
}