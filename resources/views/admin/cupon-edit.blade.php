@extends('layouts.admin')

@section('content')

<div class="container">
	<div class="row">
		


	<div class="col-md-4 formulario">
		<a href="{{url('admin-panel/cupones')}}" class="btn btn-danger">Listado</a>
	</div>

	<div class="col-md-8">
		
		<div class="formulario">
			

				<h3>Modificar Cupón</h3>

		<form action="{{url('admin-panel/cupon').'/'.$cupon->id}}" method="post" enctype="multipart/form-data">

		<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
			
		<div class="form-group">
			<label for="nombre" class="form-control">Nombre</label>
			<input type="text" id="nombre" class="form-control" name="nombre" value="{{$cupon->nombre}}" required>
		</div>
			
		<div class="form-group">
			<label for="puntos" class="form-control">Puntos</label>
			<input type="number" id="puntos" class="form-control" name="puntos" value="{{$cupon->puntos}}" required>
		</div>	

		<div class="form-group">
			<label for="porcentaje" class="form-control">Porcentaje</label>
			<input type="number" id="porcentaje" class="form-control" name="porcentaje" value="{{$cupon->porcentaje}}" required>
		</div>

		

		
		<button class="btn btn-danger" type="submit">Guardar</button>

		
		</form>


		</div>
	</div>




	</div>
</div>




@endsection
