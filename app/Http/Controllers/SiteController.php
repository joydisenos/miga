<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producto;
use App\Compra;
use App\Categoria;

class SiteController extends Controller
{
    //

    public function index()
    {
    	//principal
        $productos = Producto::where('estatus','=','1')->get();
    	$destacados = Producto::where('estatus','=','1')->where('destacado','=','1')->get();
        $categorias = Categoria::where('estatus','=','1')->get();

        return view('inicio',compact('productos','categorias','destacados'));
    }

    public function filtro($categoria)
    {
        $productos = Producto::where('estatus','=','1')->where('categoria_id','=',$categoria)->get();
        $destacados = Producto::where('estatus','=','1')->where('destacado','=','1')->get();
        $categorias = Categoria::where('estatus','=','1')->get();

        return view('inicio',compact('productos','categorias','destacados'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
    	$sliders = Producto::where('estatus','=','1')->get();

    	return view ('compra' , compact('producto','sliders'));
    }
    public function store(Request $request)
    {
    	$compra = new Compra();
    	$compra->user_id = Auth::user()->id;
    	$compra->ordene_id = 0;
    	$compra->producto_id = $request->producto_id;
    	$compra->cantidad = $request->cantidad;
    	$compra->save();
    	return redirect()->back()->with('status','Producto agregado al carrito exitosamente!');
    }

    public function cupon ($id)
    {
        
    }
}
