@extends('layouts.admin')

@section('content')

<div class="container">
	<div class="row">
		


	<div class="col-md-4 formulario">
		<a href="{{url('admin-panel/productos')}}" class="btn btn-danger">Listado</a>
	</div>

	<div class="col-md-8">
		
		<div class="formulario">
			

				<h3>Agregar producto</h3>

		<form action="{{url('admin-panel/producto')}}" method="post" enctype="multipart/form-data">

		<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>

		<div class="form-group">
			<div class="row">
				<div class="col-md-8">
				<label for="categoria_id" class="form-control">Categoría</label>
			<select id="categoria_id" class="form-control" name="categoria_id">
				

				@foreach($categorias as $categoria)

				<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>

				@endforeach

			</select>
			</div>
			<div class="col-md-4">
				<button class="btn btn-danger" data-toggle="modal" data-target="#categorias">+ Agregar</button>
				<button class="btn btn-danger" data-toggle="modal" data-target="#categoriaindex">Listado</button>
			</div>
			</div>
			
		</div>
			
		<div class="form-group">
		
				<label for="foto" class="form-control">Foto del Producto</label>
				<input type="file" id="foto" class="form-control" name="foto" required>
		
		</div>

		<div class="form-group">
			<label for="nombre" class="form-control">Nombre del Producto</label>
			<input type="text" id="nombre" class="form-control" name="nombre" required>
		</div>

		

		<div class="form-group">
			<label for="precio" class="form-control">Precio</label>
			<input type="number" id="precio" class="form-control" name="precio" required>
		</div>

		<div class="form-group">
			<label for="descripcion" class="form-control">Descripción del Producto</label>
			<textarea type="text" id="descripcion" class="form-control" name="descripcion" required></textarea>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
			<label for="cantidades" class="form-control">Cantidades (separadas por coma ",")</label>
			<input type="text" id="cantidades" class="form-control" name="cantidades" required>
		</div>
			</div>

		<div class="col-md-4">
			<div class="form-group">
			<label for="cantidadesdesc" class="form-control">Descripción</label>
			<input type="text" id="cantidadesdesc" class="form-control" name="cantidadesdesc" placeholder="Unidades / Promo" required>
		</div>
		</div>
		</div>

		<button class="btn btn-danger" type="submit">Guardar</button>

		
		</form>


		</div>
	</div>




	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="categorias" tabindex="-1" role="dialog" aria-labelledby="categoriasTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('admin-panel/categoria')}}" method="post">
        	<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>

		<div class="form-group">
			<label for="nombrecat" class="form-control">Nombre</label>
			<input type="text" id="nombrecat" class="form-control" name="nombre" placeholder="Nombre de Categoría" required>
		</div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="categoriaindex" tabindex="-1" role="dialog" aria-labelledby="categoriaindexTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		<table class="table table-hover">

			<thead>
				<th>
					Nombre
				</th>
				<th>
					Modificar
				</th>
			</thead>

			@foreach($categorias as $categoria)
			<tr>
				<td>{{$categoria->nombre}}</td>
				<td>
					<a class="btn btn-outline-danger" href="{{url('admin-panel/categoria').'/edit/'.$categoria->id}}"><i class="far fa-edit"></i></a>
					<a class="btn btn-danger" href="{{url('admin-panel/categoria').'/eliminar/'.$categoria->id}}">x</a>
				</td>
			</tr>
			@endforeach
			
		</table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>

@endsection
