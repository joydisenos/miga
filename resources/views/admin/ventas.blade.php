@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">

		<div class="col-md-12 formulario">
			<table class="table table-hover">
		<thead>
			<th>Orden</th>
			<th>Pago</th>
			<th>Total</th>
			
			<th>Dirección</th>
			<th>Estatus</th>
			<th>Detalles</th>

		</thead>
		@foreach($ventas as $venta)
		<thead>
			<th>{{$venta->id}}</th>
			<th>{{$venta->pago}}</th>
			<th>{{$venta->total}}</th>
			
			<th>{{$venta->direccion->direccion}} Código Postal: {{$venta->direccion->zip}} Referencia: {{$venta->direccion->referencia}}</th>
			<th>
				
				@if($venta->estatus==1)
				
				<a class="btn btn-danger" href="{{url('admin-panel/entregar').'/'.$venta->id.'/2'}}">Por Entregar</a>

				@elseif($venta->estatus==2)
				

				<button class="btn btn-success">Entregado</button>

				@endif
			</th>
			<th><button class="btn btn-outline-danger" type="button" data-toggle="collapse" data-target="#collapse{{$venta->id}}" aria-expanded="false" aria-controls="collapse{{$venta->id}}">Detalles</button></th>
		</thead>
		<tbody class="collapse" id="collapse{{$venta->id}}">
			<tr>
				<td>Nombre</td>
				<td>Cantidad</td>
				<td>Subtotales</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			@foreach($venta->compras as $vendido)
			
			
			<tr>
				<td>{{$vendido->producto->nombre}}</td>
				<td>{{$vendido->cantidad}}</td>
				<td>${{($vendido->cantidad)*($vendido->producto->precio)}}</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			
			@endforeach
			</tbody>
		@endforeach
	</table>
		</div>
	</div>
</div>



@endsection