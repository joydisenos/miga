@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-3 formulario">
			
			<a href="{{url('admin-panel/premio')}}" class="btn btn-danger">Agregar Premio</a>
			
		</div>
		<div class="col-md-9 formulario">
			<h3>Productos</h3>
			<table class="table table-hover">
				<thead>
				
						<th>Foto</th>
						<th>Nombre</th>
						
						<th>Puntos</th>
						
						<th>Visibilidad</th>
						<th></th>
				
				</thead>
				<tbody>
					

						@foreach($premios as $premio)
						<tr>

						<td>
							<img width="60" src="{{asset('storage').'/'.$premio->foto}}" alt="">
						</td>
						<td>
							{{$premio->nombre}}
						</td>
						
						<td>
							{{$premio->puntos}}
						</td>
						
						

						<td>
							@if($premio->estatus==1)
							<a class="btn btn-success" href="{{url('admin-panel/activarp').'/'.$premio->id.'/2'}}">Activo</a>
							@elseif($premio->estatus==2)
							<a class="btn btn-danger" href="{{url('admin-panel/activarp').'/'.$premio->id.'/1'}}">Oculto</a>
							@endif
						</td>
						
						<td>
							<a class="btn btn-outline-danger" href="{{url('admin-panel/premio').'/'.$premio->id}}">Editar</a>
						</td>

						</tr>
						@endforeach
						
					
				</tbody>
			</table>
					
						{{ $premios->links() }}
					
		</div>
	</div>
</div>



@endsection