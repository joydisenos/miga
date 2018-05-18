<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Premio;
use App\Cupone;
use App\Ordene;
use App\User;

class AdminController extends Controller
{
    //

    public function index()
    {
        $usuarios = User::all()->count();
        $productos = Producto::all()->count();

    	return view('admin.index',compact('usuarios','productos'));
    }

    public function producto_activar($id, $estatus)
    {
        $producto = Producto::findOrFail($id);
        $producto->estatus = $estatus;
        $producto->save();

        return redirect('admin-panel/productos');
    }

    public function premio_activar($id, $estatus)
    {
        $premio = Premio::findOrFail($id);
        $premio->estatus = $estatus;
        $premio->save();

        return redirect('admin-panel/premios');
    }

    public function producto_index()
    {
        $productos = Producto::paginate(10);

        
        return view('admin.productos', compact('productos','cantidades'));
    }

    public function cupon_index()
    {
        $cupones = Cupone::paginate(10);

        
        return view('admin.cupones', compact('cupones'));
    }    

    public function producto_new()
    {
    	return view('admin.producto');
    }

    public function cupon_new()
    {
        return view('admin.cupon');
    }

    public function cupon_store(Request $request)
    {
        $cupon = new Cupone();
        $cupon->estatus = 1;
        $cupon->porcentaje = $request->porcentaje;
        $cupon->puntos = $request->puntos;
        $cupon->save();

        return redirect('admin-panel/cupones')->with('status','Cupón Creado con éxito');
    }

    public function producto_editar($id)
    {
        $producto = Producto::findOrFail($id);

        return view('admin.producto-edit',compact('producto'));
    }

    public function producto_actualizar($id, Request $request)
    {
        $this->validate($request, [
        'foto' => 'image|unique:productos',
        'nombre' => 'required',
        'tipo' => 'required',
        'descripcion' => 'required',
        'precio' => 'required',
        'cantidades' => 'required',
        'cantidadesdesc' => 'required',
    ]);

        $producto = Producto::findOrFail($id);

        if($request->hasFile('foto'))
        {

        $file = $request->file('foto');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('public')->put($nombre,  \File::get($file));

        }

        if($request->hasFile('foto'))

        {
            $producto->foto = $nombre;
        }

        $producto->nombre = $request->nombre;

        $producto->tipo = $request->tipo;

        $producto->descripcion = $request->descripcion;

        $producto->precio = $request->precio;

        $producto->cantidades = $request->cantidades;
        
        $producto->cantidadesdesc = $request->cantidadesdesc;

        $producto->save();

        return redirect('admin-panel/productos');
    }

    public function producto_store(Request $request)
    {


        $this->validate($request, [
        'foto' => 'required|image|unique:productos,foto',
        'nombre' => 'required',
        'tipo' => 'required',
        'descripcion' => 'required',
        'precio' => 'required',
        'cantidades' => 'required',
        'cantidadesdesc' => 'required',
    ]);

        $file = $request->file('foto');
        $nombre = $file->getClientOriginalName();

        \Storage::disk('public')->put($nombre,  \File::get($file));

    	$producto = new Producto();

    	$producto->foto = $nombre;

    	$producto->nombre = $request->nombre;

    	$producto->estatus = 1;

    	$producto->tipo = $request->tipo;

    	$producto->descripcion = $request->descripcion;

    	$producto->precio = $request->precio;

        $producto->cantidades = $request->cantidades;
        
        $producto->cantidadesdesc = $request->cantidadesdesc;

    	$producto->save();

    	return redirect('admin-panel/productos');

    }
    public function ventas_index()
    {
        $ventas = Ordene::all();

        return view('admin.ventas',compact('ventas'));
    }
    public function premio_index()
    {
        $premios = Premio::paginate(10);

        return view('admin.premios', compact('premios'));
    }
    public function premio_store(Request $request)
    {

        $file = $request->file('foto');

        $nombre = $file->getClientOriginalName();

        \Storage::disk('public')->put($nombre,  \File::get($file));

        $premio = new Premio();

        $premio->foto = $nombre;

        $premio->nombre = $request->nombre;

        $premio->estatus = 1;

        $premio->descripcion = $request->descripcion;

        $premio->puntos = $request->puntos;

        $premio->save();

        return redirect('admin-panel/productos');


    }

    public function premio_editar($id)
    {
        $premio = Premio::findOrFail($id);

        return view('admin.premio-edit',compact('premio'));
    }

    public function premio_actualizar($id, Request $request)
    {
        $this->validate($request, [
        'nombre' => 'required',
        'descripcion' => 'required',
        'puntos' => 'required',
        ]);

        $premio = Premio::findOrFail($id);

        if($request->hasFile('foto'))
        {

        $file = $request->file('foto');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('public')->put($nombre,  \File::get($file));

        }

        if($request->hasFile('foto'))

        {
            $premio->foto = $nombre;
        }

        $premio->nombre = $request->nombre;

        $premio->descripcion = $request->descripcion;

        $premio->puntos = $request->puntos;

        $premio->save();

        return redirect('admin-panel/premios');
    }
    public function entregar($id , $estatus)
    {
        $venta= Ordene::findOrFail($id);
        $venta->estatus = $estatus;
        $venta->save();

        return redirect()->back()->with('status','Orden Marcada como Entregado');
    }
}
