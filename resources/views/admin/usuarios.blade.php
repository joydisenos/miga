@extends('layouts.admin')

@section('content')


<div class="container">
	<div class="row">
		
		<div class="formulario text-center">
			<h3>Usuarios Registrados</h3>
		</div>


		
		<div class="col-md-12 formulario">
			<div>
			<input type="text" id="filtro" placeholder="Buscar nombres de usuario" class="form-control">
		</div>
			<div class="table-responsive">
			<table class="table table-hover dinamica" id="registros">
				<thead>
					<th style="cursor: pointer;" data-sort="string">Usuario</th>
					<th style="cursor: pointer;" data-sort="string">Email</th>
					<th>Teléfono 1</th>
					<th>Teléfono 2</th>
					<th>Fecha de Nacimiento</th>
					<th style="cursor: pointer;" data-sort="float">puntos</th>
					<th>Eliminar</th>
				</thead>

				@foreach($usuarios as $usuario)
					
				
				<tr>
					<td>{{title_case($usuario->name)}}</td>
					<td>{{$usuario->email}}</td>
					<td>@if($usuario->dato)
						{{$usuario->dato->telefono1}}@endif
					</td>
					<td>@if($usuario->dato)
						{{$usuario->dato->telefono2}}@endif</td>
					<td>@if($usuario->dato)
						{{date('d/m/y' , strtotime($usuario->dato->nacimiento))}}@endif</td>
					<td>@if($usuario->dato)
						{{$usuario->dato->puntos}}@endif</td>
					<td>
						<a class="btn btn-danger users" data="{{title_case($usuario->name)}}" href="usuario/eliminar/{{$usuario->id}}"><i class="fas fa-trash-alt"></i></a>
					</td>
				</tr>

				@endforeach
				
			</table>
		</div>
		</div>
	</div>
</div>


@endsection
@section('scripts')

<script>
				
const swalWithBootstrapButtons = swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
});
				//tables
				$(".dinamica").stupidtable();
				$(".dinamica").on("aftertablesort", function (event, data) {
        var th = $(this).find("th");
        th.find(".arrow").remove();
        var dir = $.fn.stupidtable.dir;

        var arrow = data.direction === dir.ASC ? "&uarr;" : "&darr;";
        th.eq(data.column).append('<span class="arrow">' + arrow +'</span>');
      });
				//users panic
				$('.users').click(function(){
								event.preventDefault();
								var href = $(this).attr('href');
								var nombre = $(this).attr('data');
swalWithBootstrapButtons({
  title: 'Eliminar usuario '+nombre+'?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Eliminar',
  cancelButtonText: 'Cancelar',
  reverseButtons: true
}).then((result) => {
  if (result.value) {

    location.href = href;

  } else if (
    
    result.dismiss === swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons(
      'Cancelado'
    )
  }
});
									      
									    	});
						
</script>
@endsection