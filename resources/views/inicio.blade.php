@extends('layouts.front')

@section('content')


@include('includes.carousel')


<?php 

  use Carbon\Carbon;
  $hora = Carbon::now(-3);
  $principal = App\Principal::first();

?>




  


  @if(

  $hora->format('l') == 'Monday' && 
  $hora->format('H:i') >= $principal->lunesa && 
  $hora->format('H:i') < $principal->lunesc

  ||

  $hora->format('l') == 'Monday' && 
  $hora->format('H:i') >= $principal->lunesat && 
  $hora->format('H:i') < $principal->lunesct

  ||

  $hora->format('l') == 'Tuesday' && 
  $hora->format('H:i') >= $principal->martesa && 
  $hora->format('H:i') < $principal->martesc

  ||

  $hora->format('l') == 'Tuesday' && 
  $hora->format('H:i') >= $principal->martesat && 
  $hora->format('H:i') < $principal->martesct

  ||

  $hora->format('l') == 'Wednesday' && 
  $hora->format('H:i') >= $principal->miercolesa && 
  $hora->format('H:i') < $principal->miercolesc

  ||

  $hora->format('l') == 'Wednesday' && 
  $hora->format('H:i') >= $principal->miercolesat && 
  $hora->format('H:i') < $principal->miercolesct

  ||

  $hora->format('l') == 'Thursday' && 
  $hora->format('H:i') >= $principal->juevesa && 
  $hora->format('H:i') <= $principal->juevesc

  ||

  $hora->format('l') == 'Thursday' && 
  $hora->format('H:i') >= $principal->juevesat && 
  $hora->format('H:i') < $principal->juevesct

  ||

  $hora->format('l') == 'Friday' && 
  $hora->format('H:i') >= $principal->viernesa && 
  $hora->format('H:i') < $principal->viernesc

  ||

  $hora->format('l') == 'Friday' && 
  $hora->format('H:i') >= $principal->viernesat && 
  $hora->format('H:i') < $principal->viernesct

  ||

  $hora->format('l') == 'Saturday' && 
  $hora->format('H:i') >= $principal->sabadoa && 
  $hora->format('H:i') < $principal->sabadoc

  ||

  $hora->format('l') == 'Saturday' && 
  $hora->format('H:i') >= $principal->sabadoat && 
  $hora->format('H:i') < $principal->sabadoct

  ||

  $hora->format('l') == 'Sunday' && 
  $hora->format('H:i') >= $principal->domingoa && 
  $hora->format('H:i') < $principal->domingoc
  
  ||

  $hora->format('l') == 'Sunday' && 
  $hora->format('H:i') >= $principal->domingoat && 
  $hora->format('H:i') < $principal->domingoct

  )

  <div class="bg-personalizado text-center text-white cartel">

   

    
      <p>
	  <br><span class="text-yellow">ESTAMOS ATENDIENDO - <strong>¡ABIERTO!</strong></span>
	  <br>
	  La mejor forma de pedir sandwiches de miga a domicilio
	  </p>
  

</div>
  <section class="navscroll">
  <div class="container">
    <a href="#" class="cat-pri">Categorías -></a>
  <nav class="cat">
  @foreach($categorias as $categoria)
    <a href="{{url('/filtro').'/'.$categoria->id}}">{{$categoria->nombre}}</a>
  @endforeach
   
  </nav>
  </div>
</section>


@include('includes.cartelfront')






  @else


  <div class="bg-danger text-center text-white cartel">

    
    
      <p><span class="text-yellow">Sondemiga.com - <strong>CERRADO</strong></span>
      <br>
      Reservalos para después! - También puede consultar al 02281 318667 (whatsapp disponible)
      </p>
  

</div>
  <section class="navscroll">
  <div class="container">
    <a href="#" class="cat-pri"><b>Categorías -></b></a>
  <nav class="cat">
  @foreach($categorias as $categoria)
    <a href="{{url('/filtro').'/'.$categoria->id}}">{{$categoria->nombre}}</a>
  @endforeach
   
  </nav>
  </div>
</section>

@include('includes.cartelfront')
 
  @endif




  


<div class="container">
<br>
<h3>Pedi Online y sumá puntos</h3>
<hr>

@if(count($destacados))
<h4>Productos Recomendados</h4>
 <section class="navscroll" style="background:#fff;">
  <div class="container">
  <nav class="cat">
  @foreach($destacados as $destacado)
    
      <div class="text-center">
        <a href="#" data-toggle="modal" data-target="#producto{{$destacado->id}}" class="d-block">
        <img height="150" src="{{asset('storage').'/'.$destacado->foto}}" alt="{{$destacado->nombre}}">
      </a>
      <a href="#" data-toggle="modal" data-target="#producto{{$destacado->id}}" class="d-block" style="color:#000">
        {{$destacado->nombre}}
      </a>
      </div>
    
  @endforeach
   
  </nav>
  </div>
</section>
<hr>
@endif


    <div class="row">
       <div class="col-md-8 d-none d-md-block">
           
           @foreach($productos->chunk(3) as $row)

           <div class="row">
           
             

             @foreach($row as $producto)
             <div class="col-md-4">

              <div class="card item-Height">
                <div class="img-Height">
                  <img class="card-img-top" src="{{asset('storage').'/'.$producto->foto}}" alt="{{$producto->nombre}}">
                </div>
                <div class="card-body">
				<p class="text-right"><font color="green"><i class="fas fa-truck"></i> Delivery disponible</font></p>
                  <h5 class="card-title"><b>{{title_case($producto->nombre)}}</b></h5>
				  <p><strong>Precio:</strong> ${{$producto->precio}}</p>
                  <p class="card-text">{{str_limit($producto->descripcion, 100)}}</p>
                  <center>
				  <a href="#" data-toggle="modal" data-target="#producto{{$producto->id}}" class="btn btn-danger">Ver Producto</a>
				  </center>
                </div>
              </div>

             </div>
             @endforeach
          
           </div>


           @endforeach

       </div>
       <div class="col-md-8 d-block d-md-none">
         @foreach($productos as $producto)
             

      <div class="container">
         <div class="row">
                <div class="col">
                  <a href="#" data-toggle="modal" data-target="#producto{{$producto->id}}">
                  <img class="img-fluid" src="{{asset('storage').'/'.$producto->foto}}" alt="{{$producto->nombre}}">
                  </a>
                </div>
                <div class="col">
                  <h5 class=""><b>{{title_case($producto->nombre)}}</b></h5>
				  
				  <p>
				  <strong>Precio:</strong> ${{$producto->precio}} <br>
					<font color="green"><i class="fas fa-truck"></i> Delivery disponible</font> <br>
				  	
					<font color="orange"><i class="fas fa-star"></i></font>
					<font color="orange"><i class="fas fa-star"></i></font>
					<font color="orange"><i class="fas fa-star"></i></font>
					<font color="orange"><i class="fas fa-star"></i></font>
					<font color="orange"><i class="fas fa-star"></i></font>
				  </p>
				
				
				
                  
				  <p class="d-none d-sm-block">
                    {{str_limit($producto->descripcion, 100)}}</p>
                  <a href="#" data-toggle="modal" data-target="#producto{{$producto->id}}" class="btn btn-danger">Ver producto</a>
                </div>
               
                  
               
           
</div>
<hr>
      </div>
            
             @endforeach
       </div>
       <div class="col-md-4 d-none d-sm-block">
           <div class="apk bg-danger text-white">
               <h5>LLEVÁ SONDEMIGA EN TU BOLSILLO!</h5>
               <p>Descargá nuestra aplicacion para Android desde Google Play y llevá sondemiga siempre con vos!, recibi importantes descuentos, novedades, nuevas promociones, hacé tu pedido desde cualquier lugar y mucho más.</p>
               <hr>
               <a href="https://play.google.com/store/apps/details?id=com.sondemiga.app">
                   <img src="{{asset('storage/gp.png')}}" class="btn-gplay" alt="sondemiga disponible en google play" class="img-fluid">
               </a>
           </div>
       </div>
    </div>
</div>

@foreach($productos as $producto)

<!-- Modal -->
<div class="modal fade" id="producto{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="producto{{$producto->id}}CenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{title_case($producto->nombre)}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="container">

          <div class="row">
            <div class="col">
              <img class="img-fluid" src="{{asset('storage').'/'.$producto->foto}}" alt="{{$producto->nombre}}">
            </div>
          </div>
          <div class="row">
            <div class="col">
               <h4 class="text-left"><b>Precio: $<span @guest @else id="precio{{$producto->id}}" @endguest >{{$producto->precio}}</span></b></h4>
            </div>
          </div>
          <div class="row">
            <div class="col md-6">
              <p class="text-right"><font color="green"><i class="fas fa-truck"></i> Delivery disponible</font></p>
              <p>{{$producto->descripcion}}</p>
            </div>
            <div class="col md-6">
              @guest
              <h4>Para realizar compras debes iniciar sesión</h4>
              <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12 control-label">Correo Electrónico</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar usuario
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-danger">
                                    Iniciar sesión
                                </button>
                
                                <a href="{{url('register')}}" class="btn btn-outline-danger">
                                    Regístrate
                                </a>
                                <br>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Olvido su clave?
                                </a>
                            </div>
                        </div>
                    </form>
              @else
              <form action="{{url('comprar')}}" method="post">
            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
            <input type="hidden" name="producto_id" value="{{$producto->id}}">
            <select class="form-control" name="cantidad" id="cantidad{{$producto->id}}">
              <?php 
              $cantidades = explode(',',$producto->cantidades);
               ?>
              @foreach($cantidades as $cantidad)
              <option value="{{$cantidad}}">{{$cantidad}} {{$producto->cantidadesdesc}}</option>
              @endforeach
            </select>
            <br> 
            <button class="btn btn-danger"><i class="fas fa-shopping-cart"></i> Añadir al pedido</button>
           
          </form>
         
              @endguest
            </div>
          </div>
        </div>        
      </div>
      
        
      
    </div>
  </div>
</div>

@endforeach

@endsection
@section('scripts')
<script src="{{asset('/vendor/height/jquery.matchHeight-min.js')}}"></script>
<script>
  $(function() {
    $('.item-Height').matchHeight();
});
  $('.slider_categorias').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  arrows: false,
});

@foreach($productos as $producto)
            var precio{{$producto->id}} = {{$producto->precio}};
              var value{{$producto->id}} = $('#cantidad{{$producto->id}}').val();
              $('#precio{{$producto->id}}').text(value{{$producto->id}}*precio{{$producto->id}});

                $('#cantidad{{$producto->id}}').change(function(){

                var precio{{$producto->id}} = {{$producto->precio}};
                var value{{$producto->id}} = $('#cantidad{{$producto->id}}').val();

                $('#precio{{$producto->id}}').text(value{{$producto->id}}*precio{{$producto->id}});
              
                });
@endforeach
          
</script>
@endsection