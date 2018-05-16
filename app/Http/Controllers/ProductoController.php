<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class ProductoController.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:52:13pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - producto';
        $productos = Producto::paginate(6);
        return view('producto.index',compact('productos','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - producto';
        
        return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();

        
        $producto->foto = $request->foto;

        
        $producto->estatus = $request->estatus;

        
        $producto->tipo = $request->tipo;

        
        $producto->descripcion = $request->descripcion;

        
        $producto->precio = $request->precio;

        
        $producto->nombre = $request->nombre;

        
        
        $producto->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new producto has been created !!']);

        return redirect('producto');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - producto';

        if($request->ajax())
        {
            return URL::to('producto/'.$id);
        }

        $producto = Producto::findOrfail($id);
        return view('producto.show',compact('title','producto'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - producto';
        if($request->ajax())
        {
            return URL::to('producto/'. $id . '/edit');
        }

        
        $producto = Producto::findOrfail($id);
        return view('producto.edit',compact('title','producto'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $producto = Producto::findOrfail($id);
    	
        $producto->foto = $request->foto;
        
        $producto->estatus = $request->estatus;
        
        $producto->tipo = $request->tipo;
        
        $producto->descripcion = $request->descripcion;
        
        $producto->precio = $request->precio;
        
        $producto->nombre = $request->nombre;
        
        
        $producto->save();

        return redirect('producto');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/producto/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$producto = Producto::findOrfail($id);
     	$producto->delete();
        return URL::to('producto');
    }
}
