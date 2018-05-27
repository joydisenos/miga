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

  <div class="bg-success text-center text-white">

   

    
      <p><span class="text-yellow">Sondemiga.com - <strong>ABIERTO</strong></span>
      <br>
      También puede consultar al 02281 318667 (whatsapp disponible)
      </p>
  

</div>









  @else


  <div class="bg-danger text-center text-white">

    
    
      <p><span class="text-yellow">Sondemiga.com - <strong>CERRADO</strong></span>
      <br>
      Reservalos para después! - También puede consultar al 02281 318667 (whatsapp disponible)
      </p>
  

</div>

 
  @endif



<div class="container">
    <div class="row">
       <div class="col-md-8">
           
           @foreach($productos->chunk(3) as $row)

           <div class="row">
           
             

             @foreach($row as $producto)
             <div class="col-md-4">

              <div class="card item-Height">
                <div class="img-Height">
                  <img class="card-img-top" src="{{asset('storage').'/'.$producto->foto}}" alt="{{$producto->nombre}}">
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{title_case($producto->nombre)}}</h5>
                  <p class="card-text">{{str_limit($producto->descripcion, 100)}}</p>
                  <a href="{{url('compra').'/'.$producto->id}}" class="btn btn-danger">Comprar ${{$producto->precio}}</a>
                </div>
              </div>

             </div>
             @endforeach
          
           </div>


           @endforeach

       </div>
       <div class="col-md-4">
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
@endsection
@section('scripts')
<script src="{{asset('/vendor/height/jquery.matchHeight-min.js')}}"></script>
<script>
  $(function() {
    $('.item-Height').matchHeight();
});
</script>
@endsection