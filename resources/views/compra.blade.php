@extends('layouts.front')

@section('content')
<div class="container">
	

<h1 class="mt-4 mb-3">{{title_case($producto->nombre)}}
        <small>

         {{title_case($producto->categoria->nombre)}}
        
        </small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{url('/')}}">Inicio</a>
        </li>
        <li class="breadcrumb-item active">{{title_case($producto->nombre)}}</li>
      </ol>

      <!-- Intro Content -->
      <div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="{{asset('storage').'/'.$producto->foto}}" alt="">
        </div>
        <div class="col-lg-6">

          <h4 class="text-right"><b>Precio: $<span id="precio">{{$producto->precio}}</span></b></h4>
		  <p class="text-right"><font color="green"><i class="fas fa-truck"></i> Delivery disponible</font></p>
          <p>{{$producto->descripcion}}</p>
		  <p><b>Seleccionar cantidad</b></p>
		
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
          	<a href="{{url('login')}}" class="btn btn-outline-danger"><i class="fas fa-shopping-cart"></i> Añadir al pedido</a>
          	@else
          	<button class="btn btn-danger"><i class="fas fa-shopping-cart"></i> Añadir al pedido</button>
          	@endguest
          </form>
        <br>
		<a class="d-block d-sm-none" href="whatsapp://send?text=Mirá lo que encontré para vos! - {{title_case($producto->nombre)}} - {{url('compra').'/'.$producto->id}}" data-action="share/whatsapp/share"><font color="green"><b><i class="fab fa-whatsapp"></i> Compartir</b></font></a>
        </div>
      </div>
      <!-- /.row -->
	  
	  <hr>
<div class="text-center">
  <h5>Más Productos</h5>
</div>

	<div class="slider">
   @foreach($sliders as $slide)
   <div>
   <a href="{{url('compra').'/'.$slide->id}}">
     <div style="padding:10px; max-height: 250px; overflow: hidden;">
        <img src="{{asset('storage').'/'.$slide->foto}}" class="img-fluid" alt="{{$slide->nombre}}">
     </div>
     <div class="title text-center d-none d-md-block"> <p>{{title_case($slide->nombre)}}</p></div>
     <div class="title text-center d-md-none"> <p>{{title_case($slide->nombre)}}</p></div>
   </a>
   <p class="text-center"><font color="green"><i class="fas fa-truck"></i> Delivery disponible</font></p>
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
          slidesToScroll: 2,
          autoplay: true,
          arrows: true,
          lazyLoad: 'ondemand',
           responsive: [
           {
                  breakpoint: 600,
                      settings: {
                          slidesToShow: 2,
                          slidesToScroll: 2,
                          infinite: true,
						  arrows: false,
                      }
                },
                ]
        });
    });

</script>
@endsection