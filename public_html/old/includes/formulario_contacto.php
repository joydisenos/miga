<div class="col-md-12">			
	<small>¿Tenes alguna consulta?</small>
	<h3>Formulario de Contacto</h3>
	<form method="POST" action="contactoprincipal.php" autocomplete="on" class="form-horizontal" role="form">
		<input type="hidden" value="form_data" name="contacto">
		<hr>
		<div class="col-md-12">
			<div class="input-group">
				<span class="input-group-addon">Nombre</span>
				<input id="nombre" type="text" class="form-control" name="nombre" placeholder="" required="required">
			</div>
			<br>
			<div class="input-group">
				<span class="input-group-addon">Email</span>
				<input id="email" type="email" class="form-control" name="email" placeholder="">
			</div>
			<br>
			<div class="input-group">
				<span class="input-group-addon">Telefono</span>
				<input id="telefono" type="tel" class="form-control" name="telefono" placeholder="" required="required">
			</div>
			<br>
			<div class="form-group">
				<div class="col-lg-10">
					<textarea class="form-control" name="consulta" rows="7" id="consulta" placeholder="Deje aqui su consulta."></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<button type="submit" name="enviar" class="btn btn-success" style="width:100%">
						<li class="fa fa-envelope"></li> <b>Enviar!</b>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>