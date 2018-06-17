@extends('layouts.front')

@section('content')

@include('includes.carteluser')


<div class="container">
	<div class="row">
		<div class="col-md-4 formulario">
			<a href="{{url('/usuario/actualizardatos')}}" class="btn btn-danger">Actualizar Datos</a>
			<a href="{{url('/')}}" class="btn btn-success">Ver Sabores & Promociones</a>
		</div>
		<div class="col-md-8 formulario">
			<div>
				<h3>Hola {{title_case(Auth::user()->name)}}!</h3>
			</div>
			
<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<td><font color="green"><strong>Puntos Acumulados</strong></font></td>
					<td><font color="green"><strong>{{Auth::user()->dato->puntos}}</strong></font></td>
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
		</div>
<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<th>Direcciones</th>
					<th><a href="{{url('usuario/direccion')}}" class="btn btn-outline-danger">Agregar Dirección</a></th>
				</thead>
				@foreach(Auth::user()->direccion->where('estatus','=',1) as $direccion)
				<tr>
					<td>{{$direccion->direccion}}, Código Postal {{$direccion->zip}}, {{$direccion->referencia}}</td>
					<td> <a href="{{url('usuario/direccion/borrar').'/'.$direccion->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
				</tr>
				@endforeach
			</table>
			</div>
		</div>
		<div class="col-md-4">
			<a href="{{url('usuario/compras')}}" class="btn btn-info">Mis Pedidos</a>
            <a href="{{url('usuario/canje')}}" class="btn btn-info">Canjear puntos</a>
		</div>
	</div>
</div>



@endsection