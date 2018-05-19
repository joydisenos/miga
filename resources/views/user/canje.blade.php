@extends('layouts.front')

@section('content')

	<div class="container">
		<div class="row">
			
			
			<div class="col-md-4 formulario">
		<a href="{{url('usuario')}}" class="btn btn-danger">Mi Cuenta</a>
	</div>


	<div class="col-md-8 formulario">
		<h3>Canje de puntos</h3>

		<p>Cuando tengas suficientes puntos acumulados, puedes canjearlos por premios o cupones de descuentos</p>


		<!-- Canje de Productos -->
		
		<h4>Productos</h4>

		<!-- Canje de Cupones -->
		
		<h4>Cupones</h4>

	</div>



		</div>
	</div>


@endsection