@extends('layouts.front')

@section('content')
<div class="container">
	

<h1 class="mt-4 mb-3">{{$producto->nombre}}
        <small>

         {{$producto->categoria->nombre}}
        
        </small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{url('/')}}">Compra</a>
        </li>
        <li class="breadcrumb-item active">{{$producto->nombre}}</li>
      </ol>

      <!-- Intro Content -->
      <div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="{{asset('storage').'/'.$producto->foto}}" alt="">
        </div>
        <div class="col-lg-6">

          <h4 class="text-right">Precio: $<span id="precio">{{$producto->precio}}</span></h4>
          <p>{{$producto->descripcion}}</p>

          <form action="{{url('comprar')}}" method="post">
          	<input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
          	<input type="hidden" name="producto_id" id="producto_id" value="{{$producto->id}}">
          	<select class="form-control" name="cantidad" id="cantidad">
              <?php 

              $cantidades = explode(',',$producto->cantidades);

               ?>
          		@foreach($cantidades as $cantidad)
              <option value="{{$cantidad}}">{{$cantidad}} {{$producto->cantidadesdesc}}</option>
              @endforeach
          	</select>
          	<br>
          	@guest
          	<a href="{{url('login')}}" class="btn btn-outline-danger">Iniciar Sesión</a>
          	@else
          	<button class="btn btn-danger">Comprar</button>
          	@endguest
          </form>
          
        </div>
      </div>
      <!-- /.row -->
<div class="text-center">
  <h5>Más Productos</h5>
</div>

	<div class="slider">
   @foreach($sliders as $slide)
   <div>
   <a href="{{url('compra').'/'.$slide->id}}">
     <div style="max-height: 300px; overflow: hidden;">
        <img src="{{asset('storage').'/'.$slide->foto}}" class="img-fluid" alt="{{$slide->nombre}}">
     </div>
     <div class="title text-center"> <h4>{{$slide->nombre}}</h4></div>
   </a>
   </div>
   @endforeach 
  </div>


</div>
@endsection

@section('scripts')
<script>



  var precio = {{$producto->precio}};
  var value = $('#cantidad').val();
  $('#precio').text(value*precio);

    $('#cantidad').change(function(){

    var precio = {{$producto->precio}};
    var value = $('#cantidad').val();

    $('#precio').text(value*precio);
  
    });


    $(document).ready(function(){
        
          $('.slider').slick({
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true
        });
    });

</script>
@endsection