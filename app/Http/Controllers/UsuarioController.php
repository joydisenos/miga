<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Dato;
use App\Mail\Orden as OrdenMail;
use App\Mail\Premiosuser as PremiosuserMail;
use App\Compra;
use App\Principal;
use App\Ordene;
use App\Cuponesuser;
use App\Userpremio;
use App\Premio;
use App\Cupone;
use App\Direccione;

$mp = base_path("/vendor/mercadopago/sdk/lib/mercadopago.php");
require_once $mp;

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

    public function canje ()
    {

        $puntos= Auth::user()->dato->puntos;
        $premios = Premio::where('estatus','=','1')->where('puntos', '<=' , $puntos)->get();
        $cupones = Cupone::where('estatus','=','1')->where('puntos', '<=' , $puntos)->get();

        return view('user.canje',compact('premios','cupones'));
    }

    public function cupon_select($id)
    {
        $cupon = Cuponesuser::findOrFail($id);
        $compras = Auth::user()->compra->where('ordene_id','=',0);
        $datos = Principal::first();
        return view('checkoutcupon',compact('cupon','compras','datos'));
    }

    public function canjear_cupon($id)
    {
        $puntos = Auth::user()->dato;
        $cupon= Cupone::findOrFail($id);


        if($puntos->puntos >= $cupon->puntos)
        {
            $puntos->puntos = $puntos->puntos - $cupon->puntos;
            $puntos->save();

            $cuponesuser = new Cuponesuser();
            $cuponesuser->user_id = Auth::user()->id;
            $cuponesuser->cupone_id = $id;
            $cuponesuser->save();

            return redirect ('usuario/canje')->with('status','Cupón Obtenido, en tu próximo pedido podrás usar este cupón de descuento! ');

        }else{
        
            return redirect()->back()->with('status','Hubo un error por favor intente nuevamente!');
        }
    }

    

    public function canjear_premio($id, Request $request)
    {

           $this->validate($request, [
        'direccion' => 'required',
        ]);


        $puntos = Auth::user()->dato;
        $premio= Premio::findOrFail($id); 
        if($puntos->puntos >= $premio->puntos)
        {
            $puntos->puntos = $puntos->puntos - $premio->puntos;
            $puntos->save();

            $premiosuser = new Userpremio();
            $premiosuser->user_id = Auth::user()->id;
            $premiosuser->premio_id = $id;
            $premiosuser->direccione_id = $request->direccion;
            $premiosuser->save();


            Mail::to('pedidos@sondemiga.com','Sondemiga.com')

                   ->send(new PremiosuserMail($premiosuser));


            return redirect ('usuario/canje')->with('status','Premio Obtenido! estamos procesando su solicitud para hacerle llegar su pedido');

        }else{
        
            return redirect()->back()->with('status','Hubo un error por favor intente nuevamente!');
        }

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
    	
        if (!$direccion->zip)
            {
                $direccion->zip = 0;
            }else{
                    $direccion->zip = $request->zip;}
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
        $direccion->estatus = 2;
        $direccion->save();
        
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

        if($request->modal == 1){
            return redirect()->back()->with('status','Datos Actualizados Correctamente');    
        }else{
            return redirect('usuario')->with('status','Datos Actualizados Correctamente');}
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

    public function actualizar2()
    {
        $dato = Auth::user()->dato;

        return view('user.actualizardatos',compact('dato'));
    }

    public function actualizar_store2(Request $request)
    {
       
        $dato = Auth::user()->dato;
        
        $dato = Dato::findOrFail($id);
        $dato->telefono1 = $request->telefono1;
        if(is_null($request->telefono2))
        {
            $request->telefono2 = 'Sin número';
        }else{
            $dato->telefono2 = $request->telefono2;
        }
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

        if($request->descuentoid != 0)
        {
            $cupon = Cuponesuser::findOrFail($request->descuentoid);
            $cupon->estatus = 2;
            $cupon->save();
        }

        $datos = Principal::first();

        $orden = new Ordene();
        
        $orden->descuento = $request->descuento;

        $orden->envio = $request->envio;
        
        $orden->user_id = Auth::user()->id;
        
        $orden->total = $request->total;

        $orden->direccione_id = $request->direccion;
        
        $orden->estatus = 0;

        if(!$request->dia && $request->hora)
        {
            $orden->entrega = 'inmediata';
        }
        $orden->entrega = 'Día de Entrega: '.$request->dia.' Hora:'.$request->hora;

        $orden->pago = 'pendiente';

        $orden->save();

        


        return view('pagar',compact('orden','datos'));


    }

    public function compras()
    {
        $compras = Auth::user()->ordenes->Where('pago','!=','pendiente');

        return view ('user.compras',compact('compras'));
    }

    public function fail( $id , Request $request)
    {
            return redirect('usuario')->with('status','Hubo un error durante el pago por favor intente nuevamente');
    }

    public function pendiente( $id , Request $request)
    {

        

        $user_id=Auth::user()->id;
        
                        $orden = Ordene::findOrFail($id);
                        $orden->pago = 'mercadopago N°'.$request->id;
                        $orden->estatus = 3;
                        $orden->save();

                        $productos = Compra::where('ordene_id','=','0')->where('user_id','=', $user_id)->get();

                        foreach ($productos as $producto)
                        {
                            $producto->ordene_id = $id;
                            $producto->save();
                        }

         Mail::to('pedidos@sondemiga.com','Sondemiga.com')

                   ->send(new OrdenMail($orden));

        return redirect('usuario')->with('status','Su pago se encuentra pendiente, en breve verificaremos su transacción y nos comunicaremos con usted');
    }

    public function pedido_mp($id)
    {



            $user_id=Auth::user()->id;
                
            $orden = Ordene::findOrFail($id);
            $orden->pago = 'mercadopago';
            $orden->estatus = 1;
            $orden->save();

            $productos = Compra::where('ordene_id','=','0')->where('user_id','=', $user_id)->get();

            foreach ($productos as $producto)
            {
                $producto->ordene_id = $id;
                $producto->save();
            }       
      

            Mail::to('pedidos@sondemiga.com','Sondemiga.com')

                   ->send(new OrdenMail($orden));


        

        return view ('mporden',compact('orden'));

    }

    public function success( $id , Request $request)
    {

        

        $user_id=Auth::user()->id;
        
                        $orden = Ordene::findOrFail($id);
                        $orden->pago = 'mercadopago N°'.$request->id;
                        $orden->estatus = 1;
                        $orden->save();

                         Mail::to('pedidos@sondemiga.com','Sondemiga.com')

                   ->send(new OrdenMail($orden));


        return redirect('usuario')->with('status','Fué Exitoso en breves nos pondremos en contacto para realizar su envío!');
    }

    public function mercadopago($id,$tipo, Request $request)
    {
        $mp = new MP("1787728543868124", "6nXoG9IfPRwUL4BXWW2IDkweUSH40Hn6");
            $params = ["access_token" => $mp->get_access_token()];

            if($_GET["topic"] == 'payment'){
                $payment_info = $mp->get("/collections/notifications/" . $_GET["id"], $params, false);
                $merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["collection"]["merchant_order_id"], $params, false);
            // Get the merchant_order reported by the IPN. Glossary of attributes response in https://developers.mercadopago.com    
            }else if($_GET["topic"] == 'merchant_order'){
                $merchant_order_info = $mp->get("/merchant_orders/" . $_GET["id"], $params, false);
            }

            //If the payment's transaction amount is equal (or bigger) than the merchant order's amount you can release your items 
            if ($merchant_order_info["status"] == 200) {
                $transaction_amount_payments= 0;
                $transaction_amount_order = $merchant_order_info["response"]["total_amount"];
                $payments=$merchant_order_info["response"]["payments"];
                foreach ($payments as  $payment) {
                    if($payment['status'] == 'approved'){
                        $transaction_amount_payments += $payment['transaction_amount'];
                    }   
                }
               
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
                        return redirect('usuario')->with('status','su compra esta siendo procesada, en breve tramitaremos su solicitud');
                }
                else{
                        return redirect('usuario')->with('status','Hubo un error durante la operación, por favor intente de nuevo!'); 
                }
    }

    public function definir_pago ($id, $tipo)
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
        
       

            Mail::to('pedidos@sondemiga.com','Sondemiga.com')

                   ->send(new OrdenMail($orden));


        

        return redirect ('usuario')->with('status','Compra realizada con éxito, enseguida recibirás la confirmación de tu pedido por teléfono. Tus puntos serán actualizados cuando se entregue el pedido. Muchas gracias');
    }
   
}
