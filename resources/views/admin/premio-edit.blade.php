@extends('layouts.admin')

@section('content')

<div class="container">
	<div class="row">
		


	<div class="col-md-4 formulario">
		<a href="{{url('admin-panel/premios')}}" class="btn btn-danger">Listado</a>
	</div>

	<div class="col-md-8">
		
		<div class="formulario">
			

				<h3>Editar {{$premio->nombre}}</h3>

		<form action="{{url('admin-panel/premio').'/'.$premio->id}}" method="post" enctype="multipart/form-data">

		<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
			
		<div class="form-group">
				<img src="{{asset('storage').'/'.$premio->foto}}" width="80" alt="">
		
				<label for="foto" class="form-control">Foto del Premio</label>
				<input type="file" id="foto" class="form-control" name="foto">
		
		</div>

		<div class="form-group">
			<label for="nombre" class="form-control">Nombre del Premio</label>
			<input value="{{$premio->nombre}}" type="text" id="nombre" class="form-control" name="nombre" required>
		</div>

		
		<div class="form-group">
			<label for="puntos" class="form-control">Puntos</label>
			<input type="number" value="{{$premio->puntos}}" id="puntos" class="form-control" name="puntos" required>
		</div>

		<div class="form-group">
			<label for="descripcion" class="form-control">Descripción del Producto</label>
			<textarea type="text" id="descripcion" class="form-control" name="descripcion">{{$premio->descripcion}}</textarea>
		</div>

		

		<button class="btn btn-danger" type="submit">Actualizar</button>

		
		</form>


		</div>
	</div>




	</div>
</div>




@endsection