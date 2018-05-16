@extends('layouts.front')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-4 formulario">
			<a href="{{url('/usuario/actualizar')}}" class="btn btn-danger">Actualizar Datos</a>
		</div>
		<div class="col-md-8 formulario">
			<div>
				<h3>Perfil {{title_case(Auth::user()->name)}}</h3>
			</div>
			

			<table class="table table-hover">
				<tr>
					<td><strong>Puntos Acumulados</strong></td>
					<td><strong>{{Auth::user()->dato->puntos}}</strong></td>
				</tr>
				<tr>
					<td>Teléfono 1</td>
					<td>{{Auth::user()->dato->telefono1}}</td>
				</tr>
				<tr>
					<td>Teléfono 2</td>
					<td>{{Auth::user()->dato->telefono2}}</td>
				</tr>
				<tr>
					<td>Fecha de Nacimiento</td>
					<td>{{date('d-m-Y' , strtotime(Auth::user()->dato->nacimiento))}}</td>
				</tr>

			</table>

			<table class="table table-hover">
				<thead>
					<th>Direcciones</th>
					<th><a href="{{url('usuario/direccion')}}" class="btn btn-outline-danger">Agregar Dirección</a></th>
				</thead>
				@foreach(Auth::user()->direccion as $direccion)
				<tr>
					<td>{{$direccion->direccion}}, Código Postal {{$direccion->zip}}, {{$direccion->referencia}}</td>
					<td> <a href="{{url('usuario/direccion/borrar').'/'.$direccion->id}}" class="btn btn-danger">X</a></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>



@endsection