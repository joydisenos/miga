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
          <thead>
            <th><a href="{{url('pago').'/'.$orden->id.'/'.'efectivo'}}" class="btn btn-outline-danger">Efectivo</a></th>
            <th><a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="orange-ar-m-sq-arall">Tarjeta de Crédito Online Mercadopago</a>

        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script></th>
            <th><a href="{{url('pago').'/'.$orden->id.'/'.'tarjetaAlDelivery'}}" class="btn btn-outline-danger">Tarjeta de Crédito al Delivery</a></th>
            
          </thead>
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
      </tbody>
        </table>



</div>

</div>

	


</div>
@endsection