<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Editar Horarios<strong>
					</div>
					<?php if(form_error('lunes') || form_error('martes') || 
						form_error('miercoles') || form_error('jueves') || 
						form_error('viernes') || form_error('sabado') || 
						form_error('domingo')) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Se encontraron los siguientes errores:</strong><br>
							<?php echo form_error('lunes'); ?>
							<?php echo form_error('martes'); ?>
							<?php echo form_error('miercoles'); ?>
							<?php echo form_error('jueves'); ?>
							<?php echo form_error('viernes'); ?>
							<?php echo form_error('sabado'); ?>
							<?php echo form_error('domingo'); ?>
						</div>
					</div>
					<?php }?>
					<?php if($horarios){
					foreach ($horarios as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>horarios/actualizar/" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('lunes')) { echo 'has-error  has-feedback'; } ?>">
											<label for="lunes">Lunes</label>
											<input class="form-control" name="lunes" id="lunes" placeholder="Lunes" value="<?php if(set_value('lunes')) {echo set_value('lunes');}else{echo $fila->lunes;} ?>">
											<?php if(form_error('lunes')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('martes')) { echo 'has-error  has-feedback'; } ?>">
											<label for="martes">Martes</label>
											<input class="form-control" name="martes" id="martes" placeholder="Martes" value="<?php if(set_value('martes')) {echo set_value('martes');}else{echo $fila->martes;} ?>">
											<?php if(form_error('martes')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('miercoles')) { echo 'has-error  has-feedback'; } ?>">
											<label for="miercoles">Miercoles</label>
											<input class="form-control" name="miercoles" id="miercoles" placeholder="Miercoles" value="<?php if(set_value('miercoles')) {echo set_value('miercoles');}else{echo $fila->miercoles;} ?>">
											<?php if(form_error('miercoles')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('jueves')) { echo 'has-error  has-feedback'; } ?>">
											<label for="jueves">Jueves</label>
											<input class="form-control" name="jueves" id="jueves" placeholder="Jueves" value="<?php if(set_value('jueves')) {echo set_value('jueves');}else{echo $fila->jueves;} ?>">
											<?php if(form_error('jueves')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('viernes')) { echo 'has-error  has-feedback'; } ?>">
											<label for="viernes">Viernes</label>
											<input class="form-control" name="viernes" id="viernes" placeholder="Viernes" value="<?php if(set_value('viernes')) {echo set_value('viernes');}else{echo $fila->viernes;} ?>">
											<?php if(form_error('viernes')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('sabado')) { echo 'has-error  has-feedback'; } ?>">
											<label for="sabado">S&aacute;bado</label>
											<input class="form-control" name="sabado" id="sabado" placeholder="S&aacute;bado" value="<?php if(set_value('sabado')) {echo set_value('sabado');}else{echo $fila->sabado;} ?>">
											<?php if(form_error('sabado')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('domingo')) { echo 'has-error  has-feedback'; } ?>">
											<label for="domingo">Domingo</label>
											<input class="form-control" name="domingo" id="domingo" placeholder="Domingo" value="<?php if(set_value('domingo')) {echo set_value('domingo');}else{echo $fila->domingo;} ?>">
											<?php if(form_error('domingo')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
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