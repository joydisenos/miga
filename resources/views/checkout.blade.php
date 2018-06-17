@extends('layouts.front')

@section('content')




<div class="container">
	
<div class="row">
	
<div class="col-md-6 formulario">
	

	<h3>Su pedido</h3>
<div class="text-right">
	
	@if(count(Auth::user()->cupon->where('estatus','=','1')))
	<a href="{{url('/')}}" class="btn btn-outline-danger" data-toggle="modal" data-target="#cupones">Cupón de Descuento</a>
	<!--Modal-->

	<div class="modal fade" id="cupones" tabindex="-1" role="dialog" aria-labelledby="cuponesTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cupones de Descuento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
          <thead>
            <th>Cupón</th>
            <th>Descuento</th>
            <th>Seleccionar</th>
          </thead>
       <tbody>

        
        @foreach(Auth::user()->cupon->where('estatus','=','1') as $cupon)

        <tr>
          <td>{{$cupon->cupon->nombre}}</td>
          <td>{{$cupon->cupon->porcentaje}}%</td>
          
          <td><a href="{{url('checkout/c').'/'.$cupon->id}}" class="btn btn-outline-danger">Seleccionar</a></td>
        </tr>
       
          

      
                  
        @endforeach

        
      </tbody>
        </table>
                  
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-outline-danger" data-dismiss="modal" aria-label="Close">Cerrar</a>
      </div>
    </div>
  </div>
</div>

	<!--/Modal-->
	@endif
	<a href="{{url('/')}}" class="btn btn-outline-danger">Seguir Comprando</a>
</div>
<div class="table-responsive">

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

        @if($subtotal >= $datos->monto)
        <tr>
        	<td></td>
        	<td>Subtotal</td>
        	<td>${{$subtotal}}</td>
        </tr>
        
        <tr>
        	<td></td>
        	<td>- {{$datos->descuento}}% Descuento</td>
        	
        	<?php 
        	//Variables
        	$porcentaje = $datos->descuento;
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
        

        

        
        @else

        <?php 

        //Variables
        $porcentaje=0;
        $envio = $datos->envio; 
        $total = $subtotal + $envio; 
        ?>

        
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

        @endif
      </tbody>
        </table>
        </div>



</div>
<div class="col-md-6 formulario">
	
	
	<h3>Seleccione su dirección</h3>

	@if(count(Auth::user()->direccion->where('estatus','=','1')))
	<div class="text-right">
		<a href="#" data-toggle="modal" data-target="#direccion" class="btn btn-outline-danger">Nueva Dirección</a>
	</div>
	<div class="table-responsive">
	<table class="table table-hover">
		<form action="{{url('checkout')}}" method="post">
			<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
			<input type = 'hidden' name = 'descuentoid' value = '0'>
			<input type = 'hidden' name = 'descuento' value = '{{$porcentaje}}'>
			<input type = 'hidden' name = 'envio' value = '{{$envio}}'>
			<input type = 'hidden' name = 'total' id="formtotal" value = '{{$total}}'>
		@foreach(Auth::user()->direccion->where('estatus','=','1') as $direccion)
		<tr>
			<td>
				<input type="radio" name="direccion" id="direccion{{$direccion->id}}" value="{{$direccion->id}}">
			</td>
			<td>
				<label for="direccion{{$direccion->id}}">{{$direccion->direccion}}</label>
			</td>
			<td>
				@if($direccion->zip == 0) @else {{$direccion->zip}} @endif
			</td>
		</tr>
		@endforeach

		<tr>
			<td colspan="3"><strong>Seleccione la fecha y hora</strong></td>
		</tr>
		<tr>
			<td>Día de Entrega</td>
			<td colspan="2">

				<select name="dia" class="form-control">
					<option value="">- SELECCIONE DIA -</option>
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
		
		@if(Auth::user()->dato)
    @if(Auth::user()->dato->telefono1=='')

    <tr>
      <td colspan="3"> <div class="text-center">
  
    <a href="#" data-toggle="modal" data-target="#datos" class="btn btn-outline-danger">Completar Datos</a>

    </div>  </td>
    </tr>

  
  @else
  <tr>
      <td colspan="3"> <div class="text-center">
    <button type="submit" class="btn btn-outline-danger">Confirmar Pedido</button>
    
      </div>  </td>
    </tr>
  @endif
    @else
   <tr>
     <td colspan="3">
       <div class="text-center">
         <p style="color:rgba(255,0,0,1.0);">Por Favor complete su registro para poder realizar la compra</p>
         <a data-toggle="modal" data-target="#datos2" class="btn btn-outline-danger">Completa tus datos!</a>
       </div>
     </td>
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
	</div>
	@else
	<a href="#" data-toggle="modal" data-target="#direccion" class="btn btn-outline-danger">Registrar Dirección</a>
	@endif
</div>
</div>

	


</div>
@endsection
@section('scripts')
<?php 

  use Carbon\Carbon;
  $hora = Carbon::now(-3);
  $principal = App\Principal::first();

?>
@if(

  $hora->format('l') == 'Monday' && 
  $hora->format('H:i') >= $principal->lunesa && 
  $hora->format('H:i') <= $principal->lunesc

  ||

  $hora->format('l') == 'Monday' && 
  $hora->format('H:i') >= $principal->lunesat && 
  $hora->format('H:i') <= $principal->lunesct

  ||

  $hora->format('l') == 'Tuesday' && 
  $hora->format('H:i') >= $principal->martesa && 
  $hora->format('H:i') <= $principal->martesc

  ||

  $hora->format('l') == 'Tuesday' && 
  $hora->format('H:i') >= $principal->martesat && 
  $hora->format('H:i') <= $principal->martesct

  ||

  $hora->format('l') == 'Wednesday' && 
  $hora->format('H:i') >= $principal->miercolesa && 
  $hora->format('H:i') <= $principal->miercolesc

  ||

  $hora->format('l') == 'Wednesday' && 
  $hora->format('H:i') >= $principal->miercolesat && 
  $hora->format('H:i') <= $principal->miercolesct

  ||

  $hora->format('l') == 'Thursday' && 
  $hora->format('H:i') >= $principal->juevesa && 
  $hora->format('H:i') <= $principal->juevesc

  ||

  $hora->format('l') == 'Thursday' && 
  $hora->format('H:i') >= $principal->juevesat && 
  $hora->format('H:i') <= $principal->juevesct

  ||

  $hora->format('l') == 'Friday' && 
  $hora->format('H:i') >= $principal->viernesa && 
  $hora->format('H:i') <= $principal->viernesc

  ||

  $hora->format('l') == 'Friday' && 
  $hora->format('H:i') >= $principal->viernesat && 
  $hora->format('H:i') <= $principal->viernesct

  ||

  $hora->format('l') == 'Saturday' && 
  $hora->format('H:i') >= $principal->sabadoa && 
  $hora->format('H:i') <= $principal->sabadoc

  ||

  $hora->format('l') == 'Saturday' && 
  $hora->format('H:i') >= $principal->sabadoat && 
  $hora->format('H:i') <= $principal->sabadoct

  ||

  $hora->format('l') == 'Sunday' && 
  $hora->format('H:i') >= $principal->domingoa && 
  $hora->format('H:i') <= $principal->domingoc
  
  ||

  $hora->format('l') == 'Sunday' && 
  $hora->format('H:i') >= $principal->domingoat && 
  $hora->format('H:i') <= $principal->domingoct

  )

  @else
 <script>
	$(document).ready(function(){
		swal(
          'Estamos Cerrados!',
          'Pero puedes ordenar tu pedido para después, indíquenos el día y la hora'
        )
	});
</script>
  @endif


@endsection