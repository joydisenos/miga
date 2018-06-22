<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Userpremio;
use App\Premio;
use App\Cupone;
use App\Principal;
use App\Categoria;
use App\Ordene;
use App\Compra;
use App\Dato;
use App\User;

class AdminController extends Controller
{
    //



    public function index()
    {
        $usuarios = User::where('estatus','!=', 0)->count();
        $productos = Producto::all()->count();
         $ventas = Ordene::where('pago','!=','pendiente')->where('estatus','!=',4)->count();
         $notificaciones = Ordene::where('estatus','=',1)->get();
        $principal = Principal::first();
         if(!$principal)
         {
            $principal = new Principal();
            $principal->lunesa = '8:00';
            $principal->lunesc = '18:00';
            $principal->bienvenida = 'Mensaje de Bienvenida';
            $principal->save();
         }

    	return view('admin.index',compact('usuarios','productos','ventas','principal','notificaciones'));
    }

    public function eliminar_user($id)
    {
        $user=User::findOrFail($id);
        $user->estatus= 0;
        $user->save();

        return redirect()->back()->with('status','Usuario eliminado exitosamente');
    }

    public function updateprincipal(Request $request)
    {
        $principal = Principal::first();
        $principal->update($request->all());

        return redirect()->back()->with('status' , 'Configuración Actualizada');

    }

    public function usuarios()
    {
        $usuarios = User::where('estatus','!=', 0)->get();

        return view('admin.usuarios',compact('usuarios'));
    }

    public function producto_activar($id, $estatus)
    {
        $producto = Producto::findOrFail($id);
        $producto->estatus = $estatus;
        $producto->save();

        return redirect()->back()->with('status','Estatus modificado exitosamente');
    }

    public function producto_destacar($id, $estatus)
    {
        $producto = Producto::findOrFail($id);
        $producto->destacado = $estatus;
        $producto->save();

        return redirect()->back()->with('status','Estatus modificado exitosamente');
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
        $productos = Producto::all();

        
        return view('admin.productos', compact('productos'));
    }

    public function canje_index()
    {
        $canjes = Userpremio::paginate(10);

        
        return view('admin.canje', compact('canjes'));
    }

    public function entregar_premio( $id , $estatus )
    {
        $premio = Userpremio::findOrFail($id);
        $premio->estatus = $estatus;
        $premio->save();

        return redirect()->back()->with('status','Premio entregado');
    }

    public function cupon_index()
    {
        $cupones = Cupone::paginate(10);

        
        return view('admin.cupones', compact('cupones'));
    }    

    public function producto_new()
    {

        $categorias = Categoria::where('estatus','=',1)->get();

    	return view('admin.producto', compact('categorias'));
    }

    public function cupon_new()
    {
        return view('admin.cupon');
    }

    public function cupon_store(Request $request)
    {

        $this->validate($request, [
        
        'nombre' => 'required',
        'porcentaje' => 'required',
        'puntos' => 'required',
    ]);
        $cupon = new Cupone();
        $cupon->nombre= $request->nombre;
        $cupon->estatus = 1;
        $cupon->porcentaje = $request->porcentaje;
        $cupon->puntos = $request->puntos;
        $cupon->save();

        return redirect('admin-panel/cupones')->with('status','Cupón Creado con éxito');
    }

    public function producto_editar($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::where('estatus','=',1)->get();

        return view('admin.producto-edit',compact('producto','categorias'));
    }

    public function cupon_editar($id)
    {
        $cupon = Cupone::findOrFail($id);
       

        return view('admin.cupon-edit',compact('cupon'));
    }

    public function producto_actualizar($id, Request $request)
    {
        $this->validate($request, [
        'foto' => 'image|unique:productos',
        'nombre' => 'required',
        'categoria_id' => 'required',
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

        $producto->categoria_id = $request->categoria_id;

        $producto->descripcion = $request->descripcion;

        $producto->precio = $request->precio;

        $producto->cantidades = $request->cantidades;
        
        $producto->cantidadesdesc = $request->cantidadesdesc;

        $producto->save();

        return redirect('admin-panel/productos');
    }

    public function cupon_activar($id, $estatus)
    {
        $cupon = Cupone::findOrFail($id);
        $cupon->estatus = $estatus;
        $cupon->save();

        return redirect('admin-panel/cupones');
    }

    public function cupon_actualizar ($id, Request $request)
    {


        $this->validate($request, [
        'nombre' => 'required',
        'puntos' => 'required',
        'porcentaje' => 'required',
    ]);

        $cupon = Cupone::findOrFail($id);

        $cupon->nombre = $request->nombre;

        $cupon->porcentaje = $request->porcentaje;

        $cupon->puntos = $request->puntos;

        $cupon->save();

        return redirect('admin-panel/cupones')->with('status','Cupón Actualizado con Éxito!');

    }

    public function producto_store(Request $request)
    {


        $this->validate($request, [
        'foto' => 'required|image|unique:productos,foto',
        'nombre' => 'required',
        'categoria_id' => 'required',
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

    	$producto->categoria_id = $request->categoria_id;

    	$producto->descripcion = $request->descripcion;

    	$producto->precio = $request->precio;

        $producto->cantidades = $request->cantidades;
        
        $producto->cantidadesdesc = $request->cantidadesdesc;

    	$producto->save();

    	return redirect('admin-panel/productos');

    }
    public function ventas_index()
    {
        $ventas = Ordene::where('pago','!=','pendiente')->where('estatus','!=',4)->orderBy('id','desc')->get();

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

        return redirect('admin-panel/premios')->with('status','Premio agregado con éxito');


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

        if($estatus == 2)
        {

        $userid = $venta->user_id;

        $dato = Dato::where('user_id', '=', $userid)->first();
        $dato->puntos = $dato->puntos + ($venta->total / 2);
        $dato->save();

        
            return redirect()->back()->with('status','Orden Marcada como Entregado');
        }
        elseif($estatus == 3)
        {
            return redirect()->back()->with('status','Orden Cancelada');
        }
        elseif($estatus == 4)
        {
            return redirect()->back()->with('status','Orden Eliminada');
        }
    }
    public function config()
    {
        $principal = Principal::first();

        return view('admin.config',compact('principal'));
    }

    public function reportes()
    {
         $ventas = Ordene::where('pago','!=','pendiente')->where('estatus','!=',4)->orderBy('id','desc')->get();

        return view('admin.reportes',compact('ventas'));
    }
}
