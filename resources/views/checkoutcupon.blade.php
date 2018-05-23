@extends('layouts.front')

@section('content')




<div class="container">
	
<div class="row">
	
<div class="col-md-6 formulario">
	

	<h3>Productos</h3>
<div class="text-right">
	
	<a href="{{url('/')}}" class="btn btn-outline-danger">Seguir Comprando</a>
</div>

	<table class="table table-hover">
          <thead>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            
          </thead>
       <tbody>

        <?php $subtotal=0; ?>
        @foreach($compras as $compra)

        <tr>
          <td>{{$compra->producto->nombre}}</td>
          <td>{{$compra->cantidad}}</td>
          <td>${{$compra->cantidad*($compra->producto->precio)}}</td>
          
        </tr>
        

        <?php $subtotal = $subtotal + ($compra->cantidad*($compra->producto->precio)) ?>

          

      
                  
        @endforeach

        
        <tr>
        	<td></td>
        	<td>Subtotal</td>
        	<td>${{$subtotal}}</td>
        </tr>
        
        <tr>
        	<td>{{$cupon->cupon->nombre}}</td>
        	<td>- {{$cupon->cupon->porcentaje}}% Descuento</td>
        	
        	<?php 
        	//Variables
        	$porcentaje = $cupon->cupon->porcentaje;
        	$descuento = round(($subtotal * $porcentaje)/100 , 2);
        	$envio = $datos->envio;
        	$total = ($subtotal - $descuento) + $envio;        	
        	?>

        	<td>${{$descuento}}</td>
        </tr>

        <tr>
        	<td></td>
        	<td>Envío</td>
        	<td>${{$envio}}</td>
        </tr>

        <tr>
          <td></td>
          <td><strong>Total</strong></td>
          <td><strong>${{$total}}</strong></td>
          <td></td>
        </tr>
        

        

        
        
      </tbody>
        </table>



</div>
<div class="col-md-6 formulario">
	
	
	<h3>Seleccione su dirección</h3>

	@if(count(Auth::user()->direccion))
	<div class="text-right">
		<a href="#" data-toggle="modal" data-target="#direccion" class="btn btn-outline-danger">Nueva Dirección</a>
	</div>
	<table class="table table-hover">
		<form action="{{url('checkout')}}" method="post">
			<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
			<input type = 'hidden' name = 'descuento' value = '{{$cupon->id}}'>
			<input type = 'hidden' name = 'total' id="formtotal" value = '{{$total}}'>
		@foreach(Auth::user()->direccion as $direccion)
		<tr>
			<td>
				<input type="radio" name="direccion" value="{{$direccion->id}}">
			</td>
			<td>
				{{$direccion->direccion}}
			</td>
			<td>
				{{$direccion->zip}}
			</td>
		</tr>
		@endforeach

		<tr>
			<td colspan="3"><strong>Desea reservar para luego? indíquenos la fecha y hora</strong></td>
		</tr>
		<tr>
			<td>Día de Entrega</td>
			<td colspan="2">

				<select name="dia" class="form-control">
					<option value="">Días de Entrega</option>
					<option value="lunes">Lunes</option>
					<option value="martes">Martes</option>
					<option value="miercoles">Miércoles</option>
					<option value="jueves">Jueves</option>
					<option value="viernes">Viernes</option>
					<option value="sabado">Sábado</option>
					<option value="domingo">Domingo</option>
				</select>
			</td>
			
		</tr>

		<tr>
			<td>
				Hora de Entrega
			</td>

			<td colspan="2">
				<select name="hora" class="form-control">
					<option value="" selected="">- SELECCIONE HORA -</option>
							<option value="Hora-Man" disabled="disabled">Horario de Mañana</option>
							<option value="09:30 y 10:00">Entre 09:30 y 10:00 hs</option>
							<option value="10:00 y 10:30">Entre 10:00 y 10:30 hs</option>
							<option value="10:30 y 11:00">Entre 10:30 y 11:00 hs</option>
							<option value="11:00 y 11:30">Entre 11:00 y 11:30 hs</option>
							<option value="11:30 y 12:00">Entre 11:30 y 12:00 hs</option>
							<option value="12:00 y 12:30">Entre 12:00 y 12:30 hs</option>
							<option value="12:30 y 13:00">Entre 12:30 y 13:00 hs</option>
							<option value="13:00 y 13:30">Entre 13:00 y 13:30 hs</option>
							
							<option value="Hora-Tarde" disabled="disabled">Horario de Tarde</option>
							<option value="18:00 y 18:30">Entre 18:00 y 18:30 hs</option>
							<option value="18:30 y 19:00">Entre 18:30 y 19:00 hs</option>
							<option value="19:00 y 19:30">Entre 19:00 y 19:30 hs</option>
							<option value="19:30 y 20:00">Entre 19:30 y 20:00 hs</option>
							<option value="20:00 y 20:30">Entre 20:00 y 20:30 hs</option>
							<option value="20:30 y 21:00">Entre 20:30 y 21:00 hs</option>
							<option value="21:00 y 21:30">Entre 21:00 y 21:30 hs</option>
							<option value="21:30 y 22:00">Entre 21:30 y 22:00 hs</option>
							<option value="22:00 y 22:30">Entre 22:00 y 22:30 hs</option>
				</select>

			</td>
		</tr>
		
		@if(Auth::user()->dato->telefono1=='')

		<tr>
			<td colspan="3"> <div class="text-center">
	
		<a href="#" data-toggle="modal" data-target="#datos" class="btn btn-outline-danger">Completar Datos</a>

		</div>	</td>
		</tr>

	
	@else
	<tr>
			<td colspan="3"> <div class="text-center">
		<button type="submit" class="btn btn-outline-danger">Confirmar</button>
		
			</div>	</td>
		</tr>
	@endif
		<!--
			<tr>
				<td class="text-center">

				


	    </td>
				<td class="text-center">
				<a href="#" class="btn btn-warning text-white">Todopago</a>
				</td>
				<td class="text-center">
					<a href="#" class="btn btn-danger">Efectivo</a>
				</td>
			</tr>

		-->
		</form>
	</table>
	@else
	<a href="#" data-toggle="modal" data-target="#direccion" class="btn btn-outline-danger">Registrar Dirección</a>
	@endif
</div>
</div>

	


</div>
@endsection