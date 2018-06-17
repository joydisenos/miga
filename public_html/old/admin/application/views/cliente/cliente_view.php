<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.prettynumber.js"></script>
<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Ver Cliente<strong>
						<div class="pull-right"><a href="<?php echo site_url('/cliente/')?>" class="btn btn-success">Clientes</a></div>
					</div>
					<?php if($cliente){
					foreach ($cliente as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>cliente/editar/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="nombre">Nombre</label>
											<input class="form-control" disabled value="<?=$fila->nombre?>">
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="correo">Correo</label>
											<input class="form-control" disabled value="<?=$fila->email?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="direccion">Direcci&oacute;n</label>
											<input class="form-control" disabled value="<?=$fila->direccion?>">
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="telefono">Tel&eacute;fono</label>
											<input class="form-control" disabled value="<?=$fila->telefono?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="puntos_acumulados">Puntos Acumulados</label>
											<input class="form-control" disabled value="<?=$fila->puntos_acumulados?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
									<button type="submit" class="btn btn-success">Editar</button>
									</div>
								</div>
							</div>
						</form> <!--final del form-->
					</div>
					<?php } } ?>
				</div>
				<br>
			</div>
		</div>
	</div>
</div>