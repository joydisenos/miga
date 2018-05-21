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
		</div>
	</div>
</div>



@endsection