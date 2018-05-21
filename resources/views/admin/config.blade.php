@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		
		<div class="col-md-12 formulario">
			<table class="table table-hover">
				

				<form action="{{url('admin-panel/principal')}}" method="post">
				<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>

				
				<tr>
					<th colspan="2" class="text-center">General</th>
				</tr>
				<tr>
					<td>
						Mensaje de Bienvenida
					</td>

					<td>
						<textarea name="bienvenida" class="form-control" id="bienvenida" cols="30" rows="10" required>{{$principal->bienvenida}}</textarea>
					</td>
				</tr>

				<tr>
					<th colspan="2" class="text-center">Ventas</th>
				</tr>

				<tr>
					<td>
						Monto mínimo para descuento
					</td>
					<td>
						<input type="number" step="0.01" name="monto" id="monto" class="form-control" value="{{$principal->monto}}" required>
					</td>
				</tr>

				<tr>
					<td>
						Descuento (%)
					</td>
					<td>
						<input type="number" name="descuento" id="descuento" class="form-control" value="{{$principal->descuento}}" required>
					</td>
				</tr>

				<tr>
					<td>
						Costo de envío
					</td>

					<td>
						<input type="number" step="0.01" name="envio" id="envio" class="form-control" value="{{$principal->envio}}" required>
					</td>
				</tr>

				<tr>
					<th colspan="2" class="text-center">Horario</th>
				</tr>
				<tr>
					<td>Día</td>
					<td>Mañana</td>
					<td>Tarde</td>
				</tr>
</table>
<table class="table table-hover">
				<tr>
					
					<td>
					Lunes
				</td>
				<td>
					<input type="time" name="lunesa" placeholder="inicio" value="{{$principal->lunesa}}" required> - 
					<input type="time" name="lunesc" placeholder="final" value="{{$principal->lunesc}}" required>
				</td>

				<td>
					<input type="time" name="lunesat" placeholder="inicio" value="{{$principal->lunesat}}" required> - 
					<input type="time" name="lunesct" placeholder="final" value="{{$principal->lunesct}}" required>
				</td>


				</tr>

				<tr>	
					<td>
						Martes
					</td>
					<td>
						<input type="time" name="martesa" placeholder="inicio" value="{{$principal->martesa}}" required> - 
						<input type="time" name="martesc" placeholder="final" value="{{$principal->martesc}}" required>
					</td>

					<td>
						<input type="time" name="martesat" placeholder="inicio" value="{{$principal->martesat}}" required> - 
						<input type="time" name="martesct" placeholder="final" value="{{$principal->martesct}}" required>
					</td>
				</tr>

				<tr>	
					<td>
						Miércoles
					</td>
					<td>
						<input type="time" name="miercolesa" placeholder="inicio" value="{{$principal->miercolesa}}" required> - 
						<input type="time" name="miercolesc" placeholder="final" value="{{$principal->miercolesc}}" required>
					</td>

					<td>
						<input type="time" name="miercolesat" placeholder="inicio" value="{{$principal->miercolesat}}" required> - 
						<input type="time" name="miercolesct" placeholder="final" value="{{$principal->miercolesct}}" required>
					</td>
				</tr>

				<tr>	
					<td>
						Jueves
					</td>
					<td>
						<input type="time" name="juevesa" placeholder="inicio" value="{{$principal->juevesa}}" required> - 
						<input type="time" name="juevesc" placeholder="final" value="{{$principal->juevesc}}" required>
					</td>

					<td>
						<input type="time" name="juevesat" placeholder="inicio" value="{{$principal->juevesat}}" required> - 
						<input type="time" name="juevesct" placeholder="final" value="{{$principal->juevesct}}" required>
					</td>
				</tr>

				<tr>	
					<td>
						Viernes
					</td>
					<td>
						<input type="time" name="viernesa" placeholder="inicio" value="{{$principal->viernesa}}" required> - 
						<input type="time" name="viernesc" placeholder="final" value="{{$principal->viernesc}}" required>
					</td>

					<td>
						<input type="time" name="viernesat" placeholder="inicio" value="{{$principal->viernesat}}" required> - 
						<input type="time" name="viernesct" placeholder="final" value="{{$principal->viernesct}}" required>
					</td>
				</tr>

				<tr>	
					<td>
						Sábado
					</td>
					<td>
						<input type="time" name="sabadoa" placeholder="inicio" value="{{$principal->sabadoa}}" required> - 
						<input type="time" name="sabadoc" placeholder="final" value="{{$principal->sabadoc}}" required>
					</td>

					<td>
						<input type="time" name="sabadoat" placeholder="inicio" value="{{$principal->sabadoat}}" required> - 
						<input type="time" name="sabadoct" placeholder="final" value="{{$principal->sabadoct}}" required>
					</td>
				</tr>

				<tr>	
					<td>
						Domingo
					</td>
					<td>
						<input type="time" name="domingoa" placeholder="inicio" value="{{$principal->domingoa}}" required> - 
						<input type="time" name="domingoc" placeholder="final" value="{{$principal->domingoc}}" required>
					</td>

					<td>
						<input type="time" name="domingoat" placeholder="inicio" value="{{$principal->domingoat}}" required> - 
						<input type="time" name="domingoct" placeholder="final" value="{{$principal->domingoct}}" required>
					</td>
				</tr>



				<tr>
					<td colspan="3">
						<button class="btn btn-outline-danger">Guardar</button>
					</td>
				</tr>
				</form>
			</table>
		</div>
	</div>
</div>



@endsection