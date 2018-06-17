@extends('layouts.front')

@section('content')

	<div class="container">
		<div class="row">
			
			
			<div class="col-md-4 formulario">
		<!--<a href="{{url('usuario')}}" class="btn btn-danger">Mi Cuenta</a>-->
		<p><strong>Genial!</strong> Estás a un paso de finalizar tu registro, completa los siguientes datos:</p>
	</div>


	<div class="col-md-8 formulario">
		<form action="{{url('usuario/actualizar')}}" method="post">
			<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
			<input type = 'hidden' name = 'modal' value = '0'>
			<div class="table-responsive">
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
		</div>

		</form>
	</div>



		</div>
	</div>


@endsection