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
			<th>Fecha</th>
			
			<th>Dirección</th>
			<th>Estatus</th>
			<th>Detalles</th>

		</thead>
		@foreach($ventas as $venta)
		<tr>
			<td>{{$venta->id}}</td>
			<td>{{$venta->pago}}</td>
			<td>{{$venta->total}}</td>
			
			<td>{{$venta->created_at->format('d/m/y')}}</td>
			
			<td>{{$venta->direccion->direccion}} Código Postal: {{$venta->direccion->zip}} Referencia: {{$venta->direccion->referencia}}</td>
			<td>
				
				@if($venta->estatus==1)
				
				<a class="btn btn-danger" href="{{url('admin-panel/entregar').'/'.$venta->id.'/2'}}">Por Entregar</a>

				@elseif($venta->estatus==2)
				

				<button class="btn btn-success">Entregado</button>

				@endif
			</td>
			<td><button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#orden{{$venta->id}}">Detalles</button></td>
		</tr>

		


		
		@endforeach
	</table>
		</div>
	</div>
</div>


@foreach($ventas as $venta)
<!-- Modal -->
<div class="modal fade" id="orden{{$venta->id}}" tabindex="-1" role="dialog" aria-labelledby="orden{{$venta->id}}Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Orden N°{{$venta->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       <ul>
       	<li><strong>Usuario:</strong> {{title_case($venta->user->name)}}</li>
       	<li><strong>Email:</strong> {{$venta->user->email}}</li>
       	<li><strong>Teléfono 1:</strong> {{$venta->user->dato->telefono1}}</li>
       	<li><strong>Teléfono 2:</strong> {{$venta->user->dato->telefono2}}</li>
       	<li><strong>Fecha:</strong> {{$venta->created_at->format('d/m/y H:i')}}</li>
       	<li><strong>Dirección:</strong> {{$venta->direccion->direccion}}</li>
       	<li><strong>Día Solicitado:</strong> {{$venta->entrega}}</li>
       </ul>
			<table class="table table-hover">
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
			
		</table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
        
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection