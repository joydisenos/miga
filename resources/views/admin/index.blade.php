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

				<form action="{{url('admin-panel/principal')}}" method="post">
				<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>

				<tr>
					
					<td>
					Horario
				</td>
				<td>
					<input type="time" name="apertura" placeholder="inicio" value="{{$principal->apertura}}" required>
					<input type="time" name="cierre" placeholder="final" value="{{$principal->cierre}}" required>
				</td>


				</tr>

				<tr>
					<td>
						Mensaje de Bienvenida
					</td>

					<td>
						<textarea name="bienvenida" id="bienvenida" cols="30" rows="10" required>{{$principal->bienvenida}}</textarea>
					</td>
				</tr>

				<tr>
					<td>
						
					</td>
					<td>
						<button class="btn btn-outline-danger">Guardar</button>
					</td>
				</tr>
				</form>
			</table>
		</div>
	</div>
</div>



@endsection