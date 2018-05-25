@extends('layouts.front')

@section('content')


@include('includes.carousel')


<?php 

  use Carbon\Carbon;
  $hora = Carbon::now(-3);
  $principal = App\Principal::first();

?>




  


  @if(

  $hora->format('l') >= 'Monday' && 
  $hora->format('H:i') >= $principal->lunesa && 
  $hora->hour <= $principal->lunesc

  ||

  $hora->format('l') >= 'Monday' && 
  $hora->format('H:i') >= $principal->lunesat && 
  $hora->hour <= $principal->lunesct

  ||

  $hora->format('l') >= 'Tuesday' && 
  $hora->format('H:i') >= $principal->martesa && 
  $hora->hour <= $principal->martesc

  ||

  $hora->format('l') >= 'Tuesday' && 
  $hora->format('H:i') >= $principal->martesat && 
  $hora->hour <= $principal->martesct

  ||

  $hora->format('l') >= 'Wednesday' && 
  $hora->format('H:i') >= $principal->miercolesa && 
  $hora->hour <= $principal->miercolesc

  ||

  $hora->format('l') >= 'Wednesday' && 
  $hora->format('H:i') >= $principal->miercolesat && 
  $hora->hour <= $principal->miercolesct

  ||

  $hora->format('l') >= 'Thursday' && 
  $hora->format('H:i') >= $principal->juevesa && 
  $hora->hour <= $principal->juevesc

  ||

  $hora->format('l') >= 'Thursday' && 
  $hora->format('H:i') >= $principal->juevesat && 
  $hora->hour <= $principal->juevesct

  ||

  $hora->format('l') >= 'Friday' && 
  $hora->format('H:i') >= $principal->viernesa && 
  $hora->hour <= $principal->viernesc

  ||

  $hora->format('l') >= 'Friday' && 
  $hora->format('H:i') >= $principal->viernesat && 
  $hora->hour <= $principal->viernesct

  ||

  $hora->format('l') >= 'Saturday' && 
  $hora->format('H:i') >= $principal->sabadoa && 
  $hora->hour <= $principal->sabadoc

  ||

  $hora->format('l') >= 'Saturday' && 
  $hora->format('H:i') >= $principal->sabadoat && 
  $hora->hour <= $principal->sabadoct

  ||

  $hora->format('l') >= 'Sunday' && 
  $hora->format('H:i') >= $principal->domingoa && 
  $hora->hour <= $principal->domingoc
  
  ||

  $hora->format('l') >= 'Sunday' && 
  $hora->format('H:i') >= $principal->domingoat && 
  $hora->hour <= $principal->domingoct

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

              <div class="card">
                <img class="card-img-top" src="{{asset('storage').'/'.$producto->foto}}" alt="{{$producto->nombre}}">
                <div class="card-body">
                  <h5 class="card-title">{{title_case($producto->nombre)}}</h5>
                  <p class="card-text">{{str_limit($producto->descripcion, 10)}}</p>
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