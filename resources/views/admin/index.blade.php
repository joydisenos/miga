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
					<td>Usuarios Registrados</td>
					<td>{{$usuarios}}</td>
				</tr>
				<tr>
					<td>Ventas Realizadas</td>
					<td>0</td>
				</tr>
				<tr>
					<td>Productos Registrados</td>
					<td>{{$productos}}</td>
				</tr>
			</table>
		</div>
	</div>
</div>



@endsection