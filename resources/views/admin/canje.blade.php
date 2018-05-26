@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">

		<div class="col-md-12 formulario">
			<div class="table-responsive">
			<table class="table table-hover">
		<thead>
			<th>Orden</th>
			<th>Premio</th>
			
			<th>Fecha</th>
			
			<th>Dirección</th>
			<th>Estatus</th>
			<th>Detalles</th>

		</thead>
		@foreach($canjes as $canje)
		<tr>
			<td>{{$canje->id}}</td>
			<td>{{$canje->premio->nombre}}</td>
			
			
			<td>{{$canje->created_at->format('d/m/y')}}</td>
			
			<td>{{$canje->direccion->direccion}} Código Postal: {{$canje->direccion->zip}} Referencia: {{$canje->direccion->referencia}}</td>
			<td>
				
				@if($canje->estatus==1)
				
				<a class="btn btn-danger" href="{{url('admin-panel/cambiar').'/'.$canje->id.'/2'}}">Por Entregar</a>

				@elseif($canje->estatus==2)
				

				<button class="btn btn-success">Entregado</button>

				@endif
			</td>
			<td><button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#orden{{$canje->id}}">Detalles</button></td>
		</tr>

		


		
		@endforeach
	</table>
	</div>
		</div>
	</div>
</div>


@foreach($canjes as $canje)
<!-- Modal -->
<div class="modal fade" id="orden{{$canje->id}}" tabindex="-1" role="dialog" aria-labelledby="orden{{$canje->id}}Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Orden N°{{$canje->id}} Premio: {{title_case($canje->premio->nombre)}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       <ul>
       	<li><strong>Usuario:</strong> {{title_case($canje->user->name)}}</li>
       	<li><strong>Email:</strong> {{$canje->user->email}}</li>
       	<li><strong>Teléfono 1:</strong> {{$canje->user->dato->telefono1}}</li>
       	<li><strong>Teléfono 2:</strong> {{$canje->user->dato->telefono2}}</li>
       	<li><strong>Fecha de Nacimiento:</strong> {{$canje->user->dato->nacimiento}}</li>
       	<li><strong>Fecha:</strong> {{$canje->created_at->format('d/m/y H:i')}}</li>
       	<li><strong>Dirección:</strong> {{$canje->direccion->direccion}}</li>
       	<li><strong>Día Solicitado:</strong> {{$canje->entrega}}</li>
       </ul>
			
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
        
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection