@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">

		<div class="col-md-6 formulario">
			<div>
			<input type="text" id="filtro" placeholder="Buscar nombres de productos" class="form-control">
		</div>
		<div class="table-responsive">
			<table class="table table-hover" id="registros">
		<thead>
			<th data-sort="integer" style="cursor: pointer;">Orden</th>
			<th data-sort="float" style="cursor: pointer;">Pago</th>
			<th data-sort="float" style="cursor: pointer;">Total</th>
			<th>Mes</th>
			
			

			<th>Detalles</th>
			

		</thead>
		@foreach($ventas as $venta)
		<tr>
			<td>{{$venta->id}}</td>
			<td>{{$venta->pago}}</td>
			<td>{{$venta->total}}</td>
			
			<td>{{$venta->created_at->format('m')}}</td>
			
			
			
			<td><button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#orden{{$venta->id}}">Detalles</button></td>
			
		</tr>

		


		
		@endforeach
	</table>
	</div>
		</div>
		<div class="col-md-6">
			
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
       	<li><strong>Fecha de Nacimiento:</strong> {{$venta->user->dato->nacimiento}}</li>
       	<li><strong>Fecha:</strong> {{$venta->created_at->format('d/m/y H:i')}}</li>
       	<li><strong>Dirección:</strong> {{$venta->direccion->direccion}}</li>
       	<li><strong>Día Solicitado:</strong> {{$venta->entrega}}</li>
       </ul>
			<div class="table-responsive">
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

			<tr>
				<td>Descuento</td>
				<td>{{$venta->descuento}}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

			<tr>
				<td>Envío</td>
				<td>{{$venta->envio}}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

			<tr>
				<td>Total</td>
				<td>{{$venta->total}}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			
		</table>
		</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
        
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection
@section('scripts')

<script>
				
//tables
				$(".dinamica").stupidtable();
				$(".dinamica").on("aftertablesort", function (event, data) {
        var th = $(this).find("th");
        th.find(".arrow").remove();
        var dir = $.fn.stupidtable.dir;

        var arrow = data.direction === dir.ASC ? "&uarr;" : "&darr;";
        th.eq(data.column).append('<span class="arrow">' + arrow +'</span>');
      });

						
</script>
@endsection