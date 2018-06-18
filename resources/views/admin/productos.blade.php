@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-3 formulario">
			<a href="{{url('admin-panel/producto')}}" class="btn btn-danger">Agregar Producto</a>
			
		</div>
		<div class="col-md-9 formulario">
			<h3>Productos</h3>
			<div>
			<input type="text" id="filtro" placeholder="Buscar nombres de productos" class="form-control">
		</div>
			<div class="table-responsive">
				<table class="table table-hover" id="registros">
					<thead>
					
							<th>Foto</th>
							<th>Nombre</th>
							<th>Categorías</th>
							<th>Precio</th>
							<th>Cantidades</th>
							<th>Visibilidad</th>
							<th>Destacar</th>
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
								{{$producto->categoria->nombre}}
							</td>
							<td>
								${{$producto->precio}}
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
								@if($producto->destacado==0)
								<a class="btn btn-outline-success" href="{{url('admin-panel/destacar').'/'.$producto->id.'/1'}}">Destacar</a>
								@elseif($producto->estatus==1)
								<a class="btn btn-outline-warning" href="{{url('admin-panel/destacar').'/'.$producto->id.'/0'}}">Destacado</a>
								@endif
							</td>
							
							<td>
								<a class="btn btn-outline-danger" href="{{url('admin-panel/producto').'/'.$producto->id}}">Editar</a>
							</td>

							</tr>
							@endforeach
							
						
					</tbody>
				</table>
			</div>
					
						
					
		</div>
	</div>
</div>



@endsection