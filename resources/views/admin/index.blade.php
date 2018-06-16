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
										<a class="btn btn-danger" href="{{url('admin-panel/entregar').'/'.$notificacion->id.'/2'}}">Entregar</a>
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



@endsection