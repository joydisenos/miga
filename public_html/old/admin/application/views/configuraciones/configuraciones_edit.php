<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.prettynumber.js"></script>
<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Editar Valor<strong>
						<div class="pull-right"><a href="<?php echo site_url('/configuraciones/')?>" class="btn btn-success">Configuraciones</a></div>
					</div>
					<?php if(form_error('valor')) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Se encontraron los siguientes errores:</strong><br>
							<?php echo form_error('valor'); ?>
						</div>
					</div>
					<?php } ?>
					<?php if($configuraciones){
					foreach ($configuraciones as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>configuraciones/actualizar/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('valor')) { echo 'has-error  has-feedback'; } ?>">
											<label for="valor">Valor</label>
											<input class="form-control" name="valor" id="valor" placeholder="Valor" value="<?php if(set_value('valor')) {echo set_value('valor');}else{echo $fila->valor;} ?>">
											<?php if(form_error('valor')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
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