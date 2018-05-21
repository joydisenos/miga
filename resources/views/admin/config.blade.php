@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-4 formulario">
			<h3>Configuración General</h3>
		</div>
		<div class="col-md-8 formulario">
			<table class="table table-hover">
				

				<form action="{{url('admin-panel/principal')}}" method="post">
				<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>

				

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
					Horario
				</td>
				<td>
					<input type="time" name="lunesa" placeholder="inicio" value="{{$principal->lunesa}}" required> - 
					<input type="time" name="lunesc" placeholder="final" value="{{$principal->lunesc}}" required>
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