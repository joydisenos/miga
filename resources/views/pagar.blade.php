@extends('layouts.front')

@section('content')



<div class="container">
	
<div class="row">
	
<div class="col-md-12 formulario">
	

	<h3>Elegir Método de Pago</h3>
<div class="table-responsive">
	<table class="table table-hover">
          
       <tbody>

        @foreach(Auth::user()->compra->where('ordene_id','=',0) as $compra)
        <tr>
          <td>{{$compra->producto->nombre}}</td>
          <td>{{$compra->cantidad}}</td>
          <td>${{$compra->cantidad*($compra->producto->precio)}}</td>
        </tr>

        @endforeach

        <tr>
          <td></td>
          <td>Envío</td>
          <td>{{$datos->envio}}</td>
        </tr>

        <tr>
         
         <td></td>
          <td><strong>Total</strong></td>
          <td><strong>${{$orden->total}}</strong></td>
          

        </tr>
        <tr>
        <td colspan="3"><a href="{{url('pago').'/'.$orden->id.'/'.'efectivo'}}">Efectivo</a>
       
        <img src="{{asset('/storage/cash.png')}}" width="30px" alt="">
        </td>
        
        </tr>
        
        <tr>
        <td colspan="3"><a href="{{url('/mp/pagos').'/'.$orden->id}}">Tarjeta de Crédito Online Mercadopago</a><br>
        <img src="{{asset('/storage/p1.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p2.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p3.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p4.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p5.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p7.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p8.png')}}" alt="" width="30px">



        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>

        <script>
          function execute_my_onreturn (json) {
            if (json.collection_status=='approved'){
                alert ('Pago acreditado');
            } else if(json.collection_status=='pending'){
                alert ('El usuario no completó el pago');
            } else if(json.collection_status=='in_process'){    
                alert ('El pago está siendo revisado');    
            } else if(json.collection_status=='rejected'){
                alert ('El pago fué rechazado, el usuario puede intentar nuevamente el pago');
            } else if(json.collection_status==null){
                alert ('El usuario no completó el proceso de pago, no se ha generado ningún pago');
            }
        }
        </script>

      </td>
        </tr>
        
        <tr>
        <td colspan="3"><a href="{{url('pago').'/'.$orden->id.'/'.'tarjetaAlDelivery'}}">Tarjeta de Crédito al Delivery</a><br>

        <img src="{{asset('/storage/p2.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p3.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p4.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p5.png')}}" alt="" width="30px">
        <img src="{{asset('/storage/p7.png')}}" alt="" width="30px">
        </td>
        </tr>

            
            
          
      </tbody>
        </table>
        </div>



</div>

</div>

	


</div>
@endsection