@extends('layouts.front')

@section('content')

	<div class="container">
		<div class="row">
			
			
			<div class="col-md-4 formulario">
		<a href="{{url('usuario')}}" class="btn btn-danger">Mi Cuenta</a>

    @if(count(Auth::user()->cupon->where('estatus','=',1)))
    <h6>Cupones Disponibles</h6>
    <div class="table-responsive">
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
    </div>
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


		@foreach($premios as $premio)

           <div class="row">
             

            
             <div class="col-md-12 formulario">

              <div class="card">
                <img class="card-img-top" src="{{asset('storage/').'/'.$premio->foto}}" alt="{{$premio->nombre}}">
                <div class="card-body">
                  <h6 class="card-title">{{title_case($premio->nombre)}}</h6>
                  <p class="card-text">{{$premio->descripcion}}</p>
                  <div class="text-center">
                    <a href="#" data-toggle="modal" data-target="#premio{{$premio->id}}" class="btn btn-outline-danger">Puntos {{$premio->puntos}}</a>
                  </div>
                </div>
              </div>

              

              <!-- Modal -->
<div class="modal fade" id="premio{{$premio->id}}" tabindex="-1" role="dialog" aria-labelledby="premio{{$premio->id}}Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{$premio->nombre}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h5>Seleccione la dirección de entrega</h5>
      <form action="{{url('usuario/premio').'/'.$premio->id}}" method="post">
      <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
      <table class="table table-hover">
        @foreach(Auth::user()->direccion as $direccion)
          <tr>
            <td>
              <input type="radio" name="direccion" id="direccion{{$direccion->id}}" value="{{$direccion->id}}">
            </td>
            <td>
              <label for="direccion{{$direccion->id}}">{{$direccion->direccion}}</label>
            </td>
            <td>
              {{$direccion->zip}}
            </td>
          </tr>
        @endforeach
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button href="#" type="submit"  class="btn btn-danger">Solicitar</button>

      </div>
      </form>
    </div>
  </div>
</div>

             </div>
            
           </div>


           @endforeach



		@endif



	</div>



		</div>
	</div>


@endsection