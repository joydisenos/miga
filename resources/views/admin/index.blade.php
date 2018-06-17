@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-4 formulario">
			<h3>Bienvenido, {{title_case(Auth::user()->name)}}</h3>
		</div>
		<div class="col-md-8 formulario">
			<table class="table table-hover">
				
					<tr>
						<td><a href="{{url('admin-panel/usuarios')}}">Usuarios Registrados</a></td>
						<td>{{$usuarios}}</td>
					</tr>
				
				<tr>
					<td><a href="{{url('admin-panel/ventas')}}">Ventas Realizadas</a></td>
					<td>{{$ventas}}</td>
				</tr>
				<tr>
					<td><a href="{{url('admin-panel/productos')}}">Productos Registrados</a></td>
					<td>{{$productos}}</td>
				</tr>

				
			</table>

			@if(count($notificaciones))
			<div class="container">
				<div class="text-center">
					<h6>Ordenes Pendientes</h6>
				</div>
				@foreach($notificaciones->chunk(3) as $row)
					<div class="row">
						@foreach($row as $notificacion)
						<div class="col-sm-4">
						<div class="border border-danger">
							
							
								<div class="notificacion formulario">
									<p><strong>Orden:</strong> {{$notificacion->id}}</p>
									<p><strong>Pago:</strong> {{$notificacion->pago}}</p>
									<p><strong>Total:</strong> {{$notificacion->total}}</p>
									<div class="text-center">
										<!--<a class="btn btn-danger" href="{{url('admin-panel/entregar').'/'.$notificacion->id.'/2'}}">Entregar</a>-->
										<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#orden{{$notificacion->id}}">Detalles</button>
									</div>
								</div>
								
								
							
						
						</div>
						</div>
						@endforeach			
					</div>
				@endforeach
			</div>
			@endif

			
		</div>
	</div>
</div>

@foreach($notificaciones as $notificacion)
<!-- Modal -->
<div class="modal fade" id="orden{{$notificacion->id}}" tabindex="-1" role="dialog" aria-labelledby="orden{{$notificacion->id}}Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Orden N°{{$notificacion->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       <ul>
       	<li><strong>Usuario:</strong> {{title_case($notificacion->user->name)}}</li>
       	<li><strong>Email:</strong> {{$notificacion->user->email}}</li>
       	<li><strong>Teléfono 1:</strong> {{$notificacion->user->dato->telefono1}}</li>
       	<li><strong>Teléfono 2:</strong> {{$notificacion->user->dato->telefono2}}</li>
       	<li><strong>Fecha de Nacimiento:</strong> {{$notificacion->user->dato->nacimiento}}</li>
       	<li><strong>Fecha:</strong> {{$notificacion->created_at->format('d/m/y H:i')}}</li>
       	<li><strong>Dirección:</strong> {{$notificacion->direccion->direccion}}</li>
       	<li><strong>Día Solicitado:</strong> {{$notificacion->entrega}}</li>
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
			@foreach($notificacion->compras as $vendido)
			
			
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
				<td>{{$notificacion->descuento}}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

			<tr>
				<td>Envío</td>
				<td>{{$notificacion->envio}}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

			<tr>
				<td>Total</td>
				<td>{{$notificacion->total}}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			
		</table>
		</div>
        
      </div>
      <div class="modal-footer">
      <a class="btn btn-outline-danger entregar" href="{{url('admin-panel/entregar').'/'.$notificacion->id.'/2'}}">Entregar</a>
      <a class="btn btn-outline-danger cancelar" href="{{url('admin-panel/entregar').'/'.$notificacion->id.'/3'}}">Cancelar</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
        
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection

@section('scripts')

<script>
				
const swalWithBootstrapButtons = swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
});


      //panic


$('.entregar').click(function(){
								event.preventDefault();
								var href = $(this).attr('href');
								

								





swalWithBootstrapButtons({
  title: 'Marcar como entregado?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Entregar',
  cancelButtonText: 'Cancelar',
  reverseButtons: true
}).then((result) => {
  if (result.value) {

    location.href = href;

  } else if (
    
    result.dismiss === swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons(
      'Cancelado'
    )
  }
});
									      
									    	});


$('.cancelar').click(function(){
								event.preventDefault();
								var href = $(this).attr('href');
								

								





swalWithBootstrapButtons({
  title: 'Cancelar esta orden?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Marcar Cancelado',
  cancelButtonText: 'Cancelar',
  reverseButtons: true
}).then((result) => {
  if (result.value) {

    location.href = href;

  } else if (
    
    result.dismiss === swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons(
      'Cancelado'
    )
  }
});
									      
									    	});


$('.eliminar').click(function(){
								event.preventDefault();
								var href = $(this).attr('href');
								

								





swalWithBootstrapButtons({
  title: 'Eliminar Orden?',
  type: 'danger',
  showCancelButton: true,
  confirmButtonText: 'Eliminar',
  cancelButtonText: 'Cancelar',
  reverseButtons: true
}).then((result) => {
  if (result.value) {

    location.href = href;

  } else if (
    
    result.dismiss === swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons(
      'Cancelado'
    )
  }
});
									      
									    	});
						
</script>
@endsection