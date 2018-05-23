@extends('layouts.front')

@section('content')

	<div class="container">
		<div class="row">
			
			
			<div class="col-md-2 formulario">
		<a href="{{url('usuario')}}" class="btn btn-danger">Mi Cuenta</a>
	</div>


	<div class="col-md-10 formulario">

		<h3>Historial de Compras</h3>
	
			<table class="table table-hover">
		<thead>
			<th>Orden</th>
			<th>Tipo de Pago</th>
			<th>Total</th>
			<th>Fecha</th>
			<th>Dirección</th>
			<th>Detalles</th>

		</thead>
		@foreach($compras as $compra)
		<thead>
			<th>{{$compra->id}}</th>
			<th>{{$compra->pago}}</th>
			<th>{{$compra->total}}</th>
			<th>{{$compra->created_at->format('d/m/y')}}</th>
			<th>{{$compra->direccion->direccion}}</th>
			
			<th><button class="btn btn-outline-danger" type="button" data-toggle="collapse" data-target="#collapse{{$compra->id}}" aria-expanded="false" aria-controls="collapse{{$compra->id}}">Detalles</button></th>
		</thead>
			<tbody class="collapse" id="collapse{{$compra->id}}">
				@foreach($compra->compras as $pcompra)
			<tr >
				<td>{{$pcompra->producto->nombre}}</td>
				<td>{{$pcompra->cantidad}}</td>
				<td>${{($pcompra->cantidad)*($pcompra->producto->precio)}}</td>
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