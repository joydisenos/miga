@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-3 formulario">
			
			<a href="{{url('admin-panel/cupon')}}" class="btn btn-danger">Agregar Cupón</a>
			
		</div>
		<div class="col-md-9 formulario">
			<h3>Cupones</h3>
			<table class="table table-hover">
				<thead>
				
						
						<th>Nombre</th>
						
						<th>Puntos</th>

						<th>Porcentaje</th>
						
						<th>Visibilidad</th>
						<th></th>
				
				</thead>
				<tbody>
					

						@foreach($cupones as $cupon)
						<tr>

						<td>
							{{$cupon->nombre}}
						</td>

						<td>
							{{$cupon->puntos}}
						</td>

						<td>
							{{$cupon->porcentaje}}
						</td>
						
						<td>
							@if($cupon->estatus==1)
							<a class="btn btn-success" href="{{url('admin-panel/activarc').'/'.$cupon->id.'/2'}}">Activo</a>
							@elseif($cupon->estatus==2)
							<a class="btn btn-danger" href="{{url('admin-panel/activarc').'/'.$cupon->id.'/1'}}">Oculto</a>
							@endif
						</td>
						
						

						
						
						<td>
							<a class="btn btn-outline-danger" href="{{url('admin-panel/cupon').'/'.$cupon->id}}">Editar</a>
						</td>

						</tr>
						@endforeach
						
					
				</tbody>
			</table>
					
						{{ $cupones->links() }}
					
		</div>
	</div>
</div>



@endsection