<h2>Nuevo Premio Canjeado</h2>

<h3>Orden número {{$premiosuser->id}}</h3>
<h3>Tipo de Pago {{$premiosuser->pago}}</h3>

<p>Dirección a enviar: {{$premiosuser->direccion->direccion}} Código Postal: {{$premiosuser->direccion->zip}} Referencia: {{$premiosuser->direccion->referencia}}</p>

<p>Usuario: {{$premiosuser->user->name}}</p>
<p>Teléfono: {{$premiosuser->user->dato->telefono1}}</p>
<p>Email: {{$premiosuser->user->email}}</p>
<p>Dirección: {{$premiosuser->direccion->direccion}} Código Postal: {{$premiosuser->direccion->zip}} Referencia: {{$premiosuser->direccion->referencia}}</p>

<table style="width:100%; max-width: 600px; text-align: center;" class="table">
	<thead>
		<th>Premio</th>
	</thead>
	

	<tr>
		
		
		<td>{{$premiosuser->premio->nombre}}</td>
	</tr>
</table>

