@extends('layouts.front')

@section('content')

<?php

$mp = new MP("1787728543868124", "6nXoG9IfPRwUL4BXWW2IDkweUSH40Hn6");

$preference_data = array(
    

"items" => array(
        array(
            "id" => $orden->id,
            "title" => 'Orden '.$orden->id,
            "currency_id" => "ARS",
            "category_id" => "Alimentos",
            "quantity" => Auth::user()->compra->where('ordene_id','=',0)->count(),
            "unit_price" => (float)$orden->total
        )
    ),

  "back_urls" => array(
            "success" => url('pago'.'/'.$orden->id.'/'.'mercadopago'),
            "failure" => url('pago/fail'),
            "pending" => url('pago/pendiente')
        )




);

$preference = $mp->create_preference($preference_data);



?>


<div class="container">
	
<div class="row">
	
<div class="col-md-12 formulario">
	

	<h3>Elegir Método de Pago</h3>

	<table class="table table-hover">
          
       <tbody>

        @foreach(Auth::user()->compra->where('ordene_id','=',0) as $compra)
        <tr>
          <td>{{$compra->producto->nombre}}</td>
          <td>{{$compra->cantidad}}</td>
          <td>${{$compra->cantidad*($compra->producto->precio)}}</td>
        </tr>

        @endforeach

        <tr>
          <td></td>
          <td>Envío</td>
          <td>{{$datos->envio}}</td>
        </tr>

        <tr>
         
         <td></td>
          <td><strong>Total</strong></td>
          <td><strong>${{$orden->total}}</strong></td>
          

        </tr>
        <tr>
        <td colspan="3"><a href="{{url('pago').'/'.$orden->id.'/'.'efectivo'}}">Efectivo</a>
       
        <img src="{{asset('/storage/cash.png')}}" width="30px" alt="">
        </td>
        
        </tr>
        
        <tr>
        <td colspan="3"><a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout">Tarjeta de Crédito Online Mercadopago</a><br>
        <img src="{{asset('/storage/p1.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p2.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p3.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p4.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p5.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p7.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p8.png')}}" alt="" width="30px">

        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script></td>
        </tr>
        
        <tr>
        <td colspan="3"><a href="{{url('pago').'/'.$orden->id.'/'.'tarjetaAlDelivery'}}">Tarjeta de Crédito al Delivery</a><br>

        <img src="{{asset('/storage/p2.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p3.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p4.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p5.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p7.png')}}" alt="" width="30px">
        </td>
        </tr>

            
            
          
      </tbody>
        </table>



</div>

</div>

	


</div>
@endsection