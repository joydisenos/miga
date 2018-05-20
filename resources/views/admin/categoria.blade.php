@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-4 formulario">
			<h3>Bienvenido, {{title_case(Auth::user()->name)}}</h3>
		</div>
		<div class="col-md-8 formulario">
		
			<form action="{{url('admin-panel/categoria').'/'.$categoria->id}}" method="post">
        	<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
		<div class="form-group">
				<label for="nombrecat" class="form-control">Nombre</label>
				<input type="text" id="nombrecat" class="form-control" name="nombre" value="{{$categoria->nombre}}" required>
		</div>
		
		<div class="form-group">
			<button class="btn btn-danger" type="submit">Guardar</button>
		</div>

			</form>
		</div>
	</div>
</div>



@endsection