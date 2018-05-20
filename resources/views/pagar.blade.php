@extends('layouts.front')

@section('content')

<?php

$mp = base_path("/vendor/mercadopago/sdk/lib/mercadopago.php");
  
require_once $mp;

$mp = new MP("1787728543868124", "6nXoG9IfPRwUL4BXWW2IDkweUSH40Hn6");


$preference_data = array(
    

"items" => array(
        array(
            "title" => "Title of what you are paying for",
            "currency_id" => "USD",
            "category_id" => "Category",
            "quantity" => 1,
            "unit_price" => 10.2
        )
    ),

  "back_urls" => array(
            "success" => url('pago').'/'.$orden->id.'/'.'mercadopago',
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
            <th><a href="{{url('pago').'/'.$orden->id.'/'.'efectivo'}}">Efectivo</a></th>
            <th><a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="orange-ar-m-sq-arall">Tarjeta de Crédito Online Mercadopago</a>
        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script></th>
            <th><a href="{{url('pago').'/'.$orden->id.'/'.'tarjetaAlDelivery'}}">Tarjeta de Crédito al Delivery</a></th>
            
          </thead>
       <tbody>

        <tr>
         
          <td><strong>Total</strong></td>
          <td><strong>${{$orden->total}}</strong></td>
          <td></td>

        </tr>
      </tbody>
        </table>

</div>

</div>

	


</div>
@endsection