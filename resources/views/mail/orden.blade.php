<h2>Nueva Orden de Compra</h2>

<h3>Orden número {{$orden->id}}</h3>
<h3>Tipo de Pago {{$orden->pago}}</h3>

<p>Dirección a enviar: {{$orden->direccion->direccion}} Código Postal: {{$orden->direccion->zip}} Referencia: {{$orden->direccion->referencia}}</p>

<p>Usuario: {{$orden->user->name}}</p>
<p>Teléfono: {{$orden->user->dato->telefono1}}</p>
<p>Email: {{$orden->user->email}}</p> 
<p>Dirección: {{$orden->direccion->direccion}} Código Postal: {{$orden->direccion->zip}} Referencia: {{$orden->direccion->referencia}}</p> 
<p>Solicitado para: {{$orden->entrega}}</p> 

<table style="width:100%; max-width: 600px; text-align: center;" class="table">
	<thead>
		<th>Producto</th>
		<th>Cantidad</th>
		<th>Monto</th>
	</thead>
	@foreach($orden->compras as $compra)
		
		<tr>
			<td>{{$compra->producto->nombre}}</td>
			<td>{{$compra->cantidad}}</td>
			<td>${{($compra->cantidad)*($compra->producto->precio)}}</td>
		</tr>

	@endforeach

	<tr>
		<td></td>
		<td><strong>Total</strong></td>
		<td>{{$orden->total}}</td>
	</tr>
</table>

