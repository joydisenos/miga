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
            "currency_id" => "ARS",
            "category_id" => "Venta Sondemiga",
            "quantity" => 1,
            "unit_price" => (int)$orden->total
        )
    )
);

$preference = $mp->create_preference($preference_data);



?>


<div class="container">
	
<div class="row">
	
<div class="col-md-6 formulario">
	

	<h3>Elegir Método de Pago</h3>

	<table class="table table-hover">
          <thead>
            <th><a href="{{url('pago').'/'.$orden->id.'/'.'efectivo'}}">Efectivo</a></th>
            <th>Mercadolibre</th>
            <th>Todopago</th>
            
          </thead>
       <tbody>

        <tr>
          <td></td>
          <td><strong>Total</strong></td>
          <td><strong>${{$orden->total}}</strong></td>
          <td></td>
        </tr>
      </tbody>
        </table>

</div>
<div class="col-md-6 formulario">
	
	
</div>
</div>

	


</div>
@endsection