@extends('layouts.front')

@section('content')

<!--<script src="https://simplewebrtc.com/latest-v2.js"></script>
-->

<script src="https://cdn.jsdelivr.net/rtc/latest/rtc.min.js"></script>

<div class="container">
	

	
        
    
    
  <div class="row">
	<div class="col-md-8 bg-gray">
			
<div class="embed-responsive embed-responsive-4by3">
  <iframe src="https://tokbox.com/embed/embed/ot-embed.js?embedId=d7aad0d1-860e-49cb-a156-c560d82194ab&room={{hashid()->encode($user->id)}}&iframe=true"  allow="microphone; camera" ></iframe>


</div>

		</div>

		<div class="col-md-4">
			
		</div>
	</div>

	<div class="controles-chat">
		
	<div class="row">
		<div class="col-md-8">
			
			<!--
			<div class="d-flex justify-content-between">
			<button class="btn btn-primary">Iniciar Show Privado</button>
			<button class="btn btn-primary">Seguir</button>
			<button class="btn btn-outline-primary">Me gusta</button>
			<button class="btn btn-primary">Comprar Créditos</button>
			-->
			
			<div class="row">
				<div class="col">
				Show Privado
			</div>
			<div class="col">
				Seguir
			</div>
			<div class="col">
				Me gusta
			</div>
			<div class="col">
				Comprar Créditos
			</div>
			</div>

			</div>
		
		<div class="col-md-4">
			<input type="text" class="form-control" placeholder="Escriba aquí...">
		</div>
		</div>
	</div>
	</div>

</div>



<div class="container">

		
	<div class="bg-gray">
		
<ul class="nav nav-tabs" id="myTab" role="tablist">

	  
	  <li class="nav-item">
	    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Perfil</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="fotos-tab" data-toggle="tab" href="#fotos" role="tab" aria-controls="fotos" aria-selected="false">Fotos</a>
	  </li>

	</ul>

	<div class="tab-content" id="myTabContent">
	 
	  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

		
<div class="row">
	<div class="col">
		
		<table class="table table-hover">
			
			
			<tr>
				<td>Año de Nacimiento:</td>
				<td>{{$user->dato->nacimiento_ano}}</td>
			</tr>
			<tr>
				<td>Sexo:</td>
				<td>{{$user->dato->sexo}}</td>
			</tr>
			<tr>
				<td>Localidad:</td>
				<td>{{$user->dato->localidad}}</td>
			</tr>
			<tr>
				<td>Interés:</td>
				<td>{{$user->dato->interes}}</td>
			</tr>
		</table>
	</div>
	<div class="col">
			<h3>Biografía</h3>
			<p>{{$user->dato->biografia}}</p>
	</div>
</div>
	

	  </div>
	  <div class="tab-pane fade" id="fotos" role="tabpanel" aria-labelledby="fotos-tab">

		@foreach ($user->foto->chunk(3) as $row)
		<div class="row">
			@foreach ($row as $foto)
			<div class="col-md-4">
				<div class="imagen">
					<img src="{{asset('storage').'/'.$foto->url}}" class="d-inline-block align-top" width="100%" alt="">
				</div>
			</div>
			@endforeach
		</div>
		@endforeach

	  </div>
	</div>


	</div>






	</div>
	 
	  


<script src="{{asset('/js/cam.js')}}"></script>

@endsection