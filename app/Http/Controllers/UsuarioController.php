<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Dato;
use App\Mail\Orden as OrdenMail;
use App\Compra;
use App\Ordene;
use App\Direccione;

class UsuarioController extends Controller
{
    //
    public function index()
    {
    	$dato = Auth::user()->dato;
    	if(!count($dato))
    	{
    		$dato = new Dato();
    		
    		$dato->user_id = Auth::user()->id;

    		$dato->telefono1 = '';

    		$dato->telefono2 = '';

    		$dato->puntos = 0;

    		$dato->save();

    		return redirect('usuario');
    	}

    	return view ('user.index');
    }

    public function direccion ()
    {
    	return view('user.direccion');
    }

	public function direccion_agregar (Request $request)
    {

    	$direccion = new Direccione();
    	$direccion->user_id = Auth::user()->id;
    	

        if(!$request->piso)
        {
        $direccion->direccion = 
        "Calle ".$request->calle.
        " Número ".$request->numero.
        " Departamento ".$request->departamento;
        }

        if(!$request->departamento)
        {
        $direccion->direccion = 
        "Calle ".$request->calle.
        " Número ".$request->numero.
        " Piso ".$request->piso;
        }

        if(!$request->piso and !$request->departamento)
        {
        $direccion->direccion = 
        "Calle ".$request->calle.
        " Número ".$request->numero;
        }

        $direccion->direccion = 

        "Calle ".$request->calle.
        " Número ".$request->numero.
        " Piso ".$request->piso.
        " Departamento ".$request->departamento;
    	
        $direccion->zip = $request->zip;
    	if($request->referencia)
        {$direccion->referencia = $request->referencia;}
        else
            {$direccion->referencia = ' ';}
    	$direccion->save();
    	return redirect()->back()->with('status','Dirección Registrada con éxito');
    }  
    public function direccion_borrar ($id)
    {
        $direccion = Direccione::findOrFail($id);
        $direccion->delete();
        return redirect('usuario');
    }
    public function actualizar()
    {
        return view('user.actualizar');
    } 
    public function actualizar_store(Request $request)
    {
       
        $dato = Auth::user()->dato;
        if(!count($dato))
        {
            $dato = new Dato();
            
            $dato->user_id = Auth::user()->id;

            $dato->telefono1 = '';

            $dato->telefono2 = '';

            $dato->puntos = 0;

            $dato->save();

            $id = $dato->id;
        if(is_null($request->telefono2))
        {
            $request->telefono2 = 'Sin número';
        }

        $dato = Dato::findOrFail($id);
        $dato->telefono1 = $request->telefono1;
        $dato->telefono2 = $request->telefono2;
        $dato->nacimiento = $request->nacimiento;
        $dato->save();

        return redirect('usuario')->with('status','Datos Actualizados Correctamente');
        }

        $id = Auth::user()->dato->id;
        if(is_null($request->telefono2))
        {
            $request->telefono2 = 'Sin número';
        }

        $dato = Dato::findOrFail($id);
        $dato->telefono1 = $request->telefono1;
        $dato->telefono2 = $request->telefono2;
        $dato->nacimiento = $request->nacimiento;
        $dato->save();

        
            
        

        return redirect()->back()->with('status','Datos Actualizados Correctamente');
    } 

    public function compra_borrar($id)
    {
        $compra = Compra::findOrFail($id);

        $compra->delete();

        return redirect()->back();
    }

    public function orden_store(Request $request)
    {


        $this->validate($request, [
        'direccion' => 'required',
        ]);

        
        $orden = new Ordene();

        $orden->user_id = Auth::user()->id;
        
        $orden->total = $request->total;

        $orden->direccione_id = $request->direccion;
        
        $orden->estatus = 0;

        $orden->pago = 'pendiente';

        $orden->save();



        return view('pagar',compact('orden'));


    }

    public function compras()
    {
        $compras = Auth::user()->ordenes;

        return view ('user.compras',compact('compras'));
    }

    public function definir_pago( $id, $tipo )
    {

        

        $user_id=Auth::user()->id;
        
        $orden = Ordene::findOrFail($id);
        $orden->pago = $tipo;
        $orden->estatus = 1;
        $orden->save();

        $productos = Compra::where('ordene_id','=','0')->where('user_id','=', $user_id)->get();

        foreach ($productos as $producto)
        {
            $producto->ordene_id = $id;
            $producto->save();
        }

        $puntos = Auth::user()->dato;

        $puntos->puntos = $puntos->puntos + (($orden->total)/2);
        $puntos->save();

        //mail

            Mail::to('pedidos@sondemiga.com','Sondemiga.com')

                   ->send(new OrdenMail($orden));


        

        return redirect ('usuario')->with('status','Compra realizada con éxito, en breves momentos se realizará el envío de su pedido');
    }
   
}
