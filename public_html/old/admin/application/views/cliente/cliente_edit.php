<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.prettynumber.js"></script>
<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Editar Cliente<strong>
						<div class="pull-right"><a href="<?php echo site_url('/cliente/')?>" class="btn btn-success">Clientes</a></div>
					</div>
					<?php if(form_error('nombre') || form_error('correo') || 
						form_error('direccion') || form_error('telefono') || 
						form_error('puntos_acumulados') || form_error('codigo_area')) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Se encontraron los siguientes errores:</strong><br>
						  <?php echo form_error('nombre'); ?>
						  <?php echo form_error('direccion'); ?>
						  <?php echo form_error('codigo_area'); ?>
						  <?php echo form_error('telefono'); ?>
						  <?php echo form_error('correo'); ?>
						  <?php echo form_error('puntos_acumulados'); ?>
						</div>
					</div>
					<?php }?>
					<?php if(isset($errorCliente)) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong><?=$errorCliente?></strong><br>
						</div>
					</div>
					<?php }?>
					<?php if($cliente){
					foreach ($cliente as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>cliente/actualizar/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('nombre')) { echo 'has-error  has-feedback'; } ?>">
											<label for="nombre">Nombre</label>
											<input class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php if(set_value('nombre')) {echo set_value('nombre');}else{echo $fila->nombre;} ?>">
											<?php if(form_error('nombre')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('correo')) { echo 'has-error  has-feedback'; } ?>">
											<label for="correo">Correo</label>
											<input class="form-control" name="correo" id="correo" placeholder="Correo" value="<?php if(set_value('correo')) {echo set_value('correo');}else{echo $fila->email;} ?>">
											<?php if(form_error('correo')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('direccion')) { echo 'has-error  has-feedback'; } ?>">
											<label  for="direccion">Direcci&oacute;n</label>
											<input class="form-control" name="direccion" id="direccion" placeholder="Direcci&oacute;n" value="<?php if(set_value('direccion')) {echo set_value('direccion');}else{echo $fila->direccion;} ?>">
											<?php if(form_error('direccion')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-2 col-xs-4 col-sm-2">
										<div class="form-group <?php if(form_error('codigo_area')) { echo 'has-error  has-feedback'; } ?>">
											<label for="codigo_area">C&oacute;digo de Area</label>
											<input class="form-control" name="codigo_area" id="codigo_area" placeholder="C&oacute;digo de Area" value="<?php if(set_value('codigo_area')) {echo set_value('codigo_area');}else{echo $fila->codigo_area;} ?>">
											<?php if(form_error('codigo_area')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-4 col-xs-8 col-sm-4">
										<div class="form-group <?php if(form_error('telefono')) { echo 'has-error  has-feedback'; } ?>">
											<label for="telefono">Tel&eacute;fono</label>
											<input class="form-control" name="telefono" id="telefono" placeholder="Tel&eacute;fono" value="<?php if(set_value('telefono')) {echo set_value('telefono');}else{echo $fila->telefono;} ?>">
											<?php if(form_error('telefono')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('puntos_acumulados')) { echo 'has-error  has-feedback'; } ?>">
											<label  for="puntos_acumulados">Puntos Acumulados</label>
											<input class="form-control" name="puntos_acumulados" id="puntos_acumulados" placeholder="Puntos Acumulados" value="<?php if(set_value('puntos_acumulados')) {echo set_value('puntos_acumulados');}else{echo $fila->puntos_acumulados;} ?>">
											<?php if(form_error('puntos_acumulados')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<button type="submit" class="btn btn-success">Guardar</button>
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