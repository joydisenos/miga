@extends('layouts.front')

@section('content')


@include('includes.carousel')

<div class="bg-danger text-center text-white">
      <p><span class="text-yellow">Sondemiga.com - <strong>CERRADO</strong></span>
      <br>
      Reservalos para después! - También puede consultar al 02281 318667 (whatsapp disponible)
      </p>

</div>


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