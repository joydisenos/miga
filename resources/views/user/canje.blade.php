@extends('layouts.front')

@section('content')

	<div class="container">
		<div class="row">
			
			
			<div class="col-md-4 formulario">
		<a href="{{url('usuario')}}" class="btn btn-danger">Mi Cuenta</a>

    @if(count(Auth::user()->cupon->where('estatus','=',1)))
    <h6>Cupones Disponibles</h6>
    <table class="table table-hover">
      <thead>
        <th>Nombre</th>
        <th>Porcentaje</th>
      </thead>
      @foreach(Auth::user()->cupon->where('estatus','=',1) as $cuponuser)
      <tr>
        <td>{{title_case($cuponuser->cupon->nombre)}}</td>
        <td>{{$cuponuser->cupon->porcentaje}}%</td>
      </tr>
      @endforeach
    </table>
    @endif
	</div>


	<div class="col-md-8 formulario">
		<h3>Canje de puntos</h3>

		@if(count($cupones)==0 && count($premios)==0)
		<p>Cuando acumules puntos suficientes podrás cambiarlo por premios o cupones de descuento disponibles!
		</p>
		@endif

		@if(count($cupones))

	
		
		<h4>Cupones</h4>


		@foreach($cupones->chunk(2) as $row)

           <div class="row">
             

             @foreach($row as $cupon)
             <div class="col-md-6 formulario">

              <div class="card">
                <img class="card-img-top" src="{{asset('storage/logo.svg')}}" alt="{{$cupon->nombre}}">
                <div class="card-body">
                  <h6 class="card-title">{{title_case($cupon->nombre)}}</h6>
                  
                    <div class="text-center">
                  
                        <a href="{{url('usuario/cupon').'/'.$cupon->id}}" class="btn btn-outline-danger">Puntos {{$cupon->puntos}}</a>
                      
                    </div>
                </div>
              </div>

             </div>
             @endforeach
           </div>


           @endforeach

		@endif

		@if(count($premios))
		<!-- Canje de Productos -->
		
		<h4>Premios</h4>


		@foreach($premios->chunk(2) as $row)

           <div class="row">
             

             @foreach($row as $premio)
             <div class="col-md-6 formulario">

              <div class="card">
                <img class="card-img-top" src="{{asset('storage/').'/'.$premio->foto}}" alt="{{$premio->nombre}}">
                <div class="card-body">
                  <h6 class="card-title">{{title_case($premio->nombre)}}</h6>
                  <p class="card-text">{{str_limit($premio->descripcion, 10)}}</p>
                  <a href="{{url('cupon').'/'.$cupon->id}}" class="btn btn-outline-danger">Puntos {{$premio->puntos}}</a>
                </div>
              </div>

             </div>
             @endforeach
           </div>


           @endforeach



		@endif



	</div>



		</div>
	</div>


@endsection