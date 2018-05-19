@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		
		<div class="formulario text-center">
			<h3>Usuarios Registrados</h3>
		</div>
		
		<div class="col-md-12 formulario">
			<table class="table table-hover">
				<thead>
					<th>Usuario</th>
					<th>Email</th>
					<th>Teléfono 1</th>
					<th>Teléfono 2</th>
					<th>puntos</th>
				</thead>

				@foreach($usuarios as $usuario)
					

				<tr>
					<td>{{$usuario->name}}</td>
					<td>{{$usuario->email}}</td>
					<td>{{$usuario->dato->telefono1}}</td>
					<td>{{$usuario->dato->telefono2}}</td>
					<td>{{$usuario->dato->puntos}}</td>
				</tr>

				@endforeach
				
			</table>
		</div>
	</div>
</div>



@endsection