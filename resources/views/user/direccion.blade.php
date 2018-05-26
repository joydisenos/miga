@extends('layouts.front')

@section('content')

	<div class="container">
		<div class="row">
			
			
			<div class="col-md-4 formulario">
		<a href="{{url('usuario')}}" class="btn btn-danger">Mi Cuenta</a>
	</div>


	<div class="col-md-8 formulario">
		<h3>Agregar Dirección</h3>
		<form action="{{url('usuario/direccion')}}" method="post">
			<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
			<div class="table-responsive">
			
			<table class="table table-hover">
			
			<tr>
				<td>
					Calle
				</td>
				<td>
					<input type="text" name="calle" class="form-control" required>
				</td>
			</tr>
			<tr>
				<td>
					Número
				</td>
				<td>
					<input type="number" name="numero" class="form-control" required>
				</td>
			</tr>
			<tr>
				<td>
					Piso
				</td>
				<td>
					<input type="text" name="piso" class="form-control">
				</td>
			</tr>
			<tr>
				<td>
					Departamento
				</td>
				<td>
					<input type="text" name="departamento" class="form-control">
				</td>
			</tr>
			<tr>
				<td>
					Código Postal
				</td>
				<td>
					<input type="text" class="form-control" name="zip" placeholder="Su Código postal / Zip">
				</td>
			</tr>
			<tr>
				<td>
					Observaciones
				</td>
				<td>
					<input type="text" class="form-control" name="referencia" placeholder="Sitios de referencia">
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
		</div>

		</form>
	</div>



		</div>
	</div>


@endsection