@extends('layouts.admin')

@section('content')

<div class="container">
	<div class="row">
		


	<div class="col-md-4 formulario">
		<a href="{{url('admin-panel/productos')}}" class="btn btn-danger">Listado</a>
	</div>

	<div class="col-md-8">
		
		<div class="formulario">
			

				<h3>Agregar Premio</h3>

		<form action="{{url('admin-panel/premio')}}" method="post" enctype="multipart/form-data">

		<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
			
		<div class="form-group">
		
				<label for="foto" class="form-control">Foto del Premio</label>
				<input type="file" id="foto" class="form-control" name="foto" required>
		
		</div>

		<div class="form-group">
			<label for="nombre" class="form-control">Nombre del Premio</label>
			<input type="text" id="nombre" class="form-control" name="nombre" required>
		</div>

		
		<div class="form-group">
			<label for="puntos" class="form-control">Puntos</label>
			<input type="number" id="puntos" class="form-control" name="puntos" required>
		</div>

		<div class="form-group">
			<label for="descripcion" class="form-control">Descripción del Premio</label>
			<textarea type="text" id="descripcion" class="form-control" name="descripcion" required></textarea>
		</div>

		
		<button class="btn btn-danger" type="submit">Agregar</button>

		
		</form>


		</div>
	</div>




	</div>
</div>




@endsection
