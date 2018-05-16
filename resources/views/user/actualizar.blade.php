@extends('layouts.front')

@section('content')

	<div class="container">
		<div class="row">
			
			
			<div class="col-md-4 formulario">
		<a href="{{url('usuario')}}" class="btn btn-danger">Mi Cuenta</a>
	</div>


	<div class="col-md-8 formulario">
		<form action="{{url('usuario/actualizar')}}" method="post">
			<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
			
			<table class="table table-hover">
			
			<tr>
				<td>
					Teléfono 1
				</td>
				<td>
					<input type="number" placeholder="Ingrese un número de teléfono"  name="telefono1" class="form-control" required>
				</td>
			</tr>
			<tr>
				<td>
					Teléfono 2
				</td>
				<td>
					<input type="number" placeholder="Ingrese un número de teléfono"  name="telefono2" class="form-control">
				</td>
			</tr>
			<tr>
				<td>
					Fecha de Nacimiento
				</td>
				<td>
					<input type="date" class="form-control" name="nacimiento" placeholder="AAAA/MM/DD" required>
				</td>
			</tr>
			<tr>
				<td>
					
				</td>
				<td>
					<button type="submit" class="btn btn-outline-danger">Guardar</button>
				</td>
			</tr>

		</table>

		</form>
	</div>



		</div>
	</div>


@endsection