@extends('layouts.front')

@section('content')

<?php
$compras = Auth::user()->compra->where('ordene_id','=',0);
?>


<div class="container">
	
<div class="row">
	
<div class="col-md-6 formulario">
	

	<h3>Productos</h3>

	<table class="table table-hover">
          <thead>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            
          </thead>
       <tbody>

        <?php $total=0; ?>
        @foreach($compras as $compra)

        <tr>
          <td>{{$compra->producto->nombre}}</td>
          <td>{{$compra->cantidad}}</td>
          <td>${{$compra->cantidad*($compra->producto->precio)}}</td>
          
        </tr>
        <?php $total = $total + ($compra->cantidad*($compra->producto->precio)) ?>

          

      
                  
        @endforeach

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
			<input type = 'hidden' name = 'total' value = '{{$total}}'>
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
		<a href="{{url('/')}}" class="btn btn-outline-danger">Seguir Comprando</a>
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