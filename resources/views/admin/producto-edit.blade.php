@extends('layouts.admin')

@section('content')

<div class="container">
	<div class="row">
		


	<div class="col-md-4 formulario">
		<a href="{{url('admin-panel/productos')}}" class="btn btn-danger">Listado</a>
	</div>

	<div class="col-md-8">
		
		<div class="formulario">
			

				<h3>Editar {{$producto->nombre}}</h3>

		<form action="{{url('admin-panel/producto').'/'.$producto->id}}" method="post" enctype="multipart/form-data">

		<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
			
		<div class="form-group">
				<img src="{{asset('storage').'/'.$producto->foto}}" width="80" alt="">
		
				<label for="foto" class="form-control">Foto del Producto</label>
				<input type="file" id="foto" class="form-control" name="foto">
		
		</div>

		<div class="form-group">
			<label for="nombre" class="form-control">Nombre del Producto</label>
			<input value="{{$producto->nombre}}" type="text" id="nombre" class="form-control" name="nombre" required>
		</div>

		<div class="form-group">
			<label for="categoria_id" class="form-control">Categoria</label>
			<select id="categoria_id" class="form-control" name="categoria_id">
				@foreach($categorias as $categoria)

				<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>

				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="precio" class="form-control">Precio</label>
			<input type="number" step="0.01" value="{{$producto->precio}}" id="precio" class="form-control" name="precio" required>
		</div>

		<div class="form-group">
			<label for="descripcion" class="form-control">Descripción del Producto</label>
			<textarea type="text" id="descripcion" class="form-control" name="descripcion">{{$producto->descripcion}}</textarea>
		</div>

		<div class="form-group">
			<label for="cantidades" class="form-control">Cantidades (separadas por coma ",")</label>
			<input type="text" id="cantidades" class="form-control" name="cantidades" value="{{$producto->cantidades}}" required>
		</div>

		<div class="form-group">
			<label for="cantidadesdesc" class="form-control">Descripción de Cantidades</label>
			<input type="text" id="cantidadesdesc" class="form-control" name="cantidadesdesc" value="{{$producto->cantidadesdesc}}" required>
		</div>

		<button class="btn btn-danger" type="submit">actualizar</button>

		
		</form>


		</div>
	</div>




	</div>
</div>




@endsection