@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-3 formulario">
			<a href="{{url('admin-panel/producto')}}" class="btn btn-danger">Agregar Producto</a>
			
		</div>
		<div class="col-md-9 formulario">
			<h3>Productos</h3>
			<table class="table table-hover">
				<thead>
				
						<th>Foto</th>
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Precio</th>
						<th>Cantidades</th>
						<th>Visibilidad</th>
						<th></th>
				
				</thead>
				<tbody>
					

						@foreach($productos as $producto)
						<tr>

						<td>
							<img width="60" src="{{asset('storage').'/'.$producto->foto}}" alt="">
						</td>
						<td>
							{{$producto->nombre}}
						</td>
						<td>
							@if($producto->tipo == 1)
							Producto
							@elseif($producto->tipo == 2)
							Combo
							@elseif($producto->tipo == 3)
							Promoción
							@endif
						</td>
						<td>
							$ {{$producto->precio}}
						</td>
						
						<td>
							
							{{$producto->cantidades}}
						</td>

						<td>
							@if($producto->estatus==1)
							<a class="btn btn-success" href="{{url('admin-panel/activar').'/'.$producto->id.'/2'}}">Activo</a>
							@elseif($producto->estatus==2)
							<a class="btn btn-danger" href="{{url('admin-panel/activar').'/'.$producto->id.'/1'}}">Oculto</a>
							@endif
						</td>
						
						<td>
							<a class="btn btn-outline-danger" href="{{url('admin-panel/producto').'/'.$producto->id}}">Editar</a>
						</td>

						</tr>
						@endforeach
						
					
				</tbody>
			</table>
					
						{{ $productos->links() }}
					
		</div>
	</div>
</div>



@endsection