<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Agregar Horarios Especiales<strong>
						<div class="pull-right"><a href="<?php echo site_url('/horarios/especiales/')?>" class="btn btn-success">Horarios Especiales</a></div>
					</div>
					<?php if(form_error('dia') || form_error('mes') || 
						form_error('horario')) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Se encontraron los siguientes errores:</strong><br>
							<?php echo form_error('dia'); ?>
							<?php echo form_error('mes'); ?>
							<?php echo form_error('horario'); ?>
						</div>
					</div>
					<?php }?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>horarios/guardarespeciales" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-2 col-xs-6 col-sm-4">
										<div class="form-group <?php if(form_error('dia')) { echo 'has-error  has-feedback'; } ?>">
											<label for="dia">D&iacute;a</label>
											<input class="form-control" name="dia" id="dia" placeholder="D&iacute;a" value="<?php echo set_value('dia'); ?>">
											<?php if(form_error('dia')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-2 col-xs-6 col-sm-4">
										<div class="form-group <?php if(form_error('mes')) { echo 'has-error  has-feedback'; } ?>">
											<label for="mes">Mes</label>
											<input class="form-control" name="mes" id="mes" placeholder="Mes" value="<?php echo set_value('mes'); ?>">
											<?php if(form_error('mes')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>								
									<div class="col-md-4 col-xs-12 col-sm-4">
										<div class="form-group <?php if(form_error('horario')) { echo 'has-error  has-feedback'; } ?>">
											<label for="horario">Horario</label>
											<input class="form-control" name="horario" id="horario" placeholder="Horario" value="<?php echo set_value('horario'); ?>">
											<?php if(form_error('horario')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
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
				</div>
				<br>
			</div>
		</div>
	</div>
</div>