<div class="right_col" role="main" style="height:1880px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Agregar Im&aacute;gen<strong>
						<div class="pull-right"><a href="<?php echo site_url('/imagenes/')?>" class="btn btn-success">Im&aacute;genes</a></div>
					</div>
					<?php if(form_error('descripcion_imagen') || form_error('link')) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Se encontraron los siguientes errores:</strong><br>
							<?php echo form_error('descripcion_imagen'); ?>
							<?php echo form_error('link'); ?>
						</div>
					</div>
					<?php }?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>imagenes/guardar" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('descripcion_imagen')) { echo 'has-error  has-feedback'; } ?>">
											<label for="descripcion_imagen">Descripci&oacute;n Im&aacute;gen (Alt)</label>
											<input class="form-control" name="descripcion_imagen" id="descripcion_imagen" placeholder="Descripci&oacute;n Im&aacute;gen (Alt)" value="<?php echo set_value('descripcion_imagen'); ?>">
											<?php if(form_error('descripcion_imagen')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('link')) { echo 'has-error  has-feedback'; } ?>">
											<label for="link">Link</label>
											<input class="form-control" name="link" id="link" placeholder="Link" value="<?php if(set_value('link')) { echo set_value('link'); } else {echo '#';}?>">
											<?php if(form_error('link')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="posicion">Posici&oacute;n</label>
											<input type="number" name="posicion" min="1" max="99" class="form-control" value="1" id="posicion" value="<?php echo set_value('posicion'); ?>">
										</div>
									</div>
								</div>
								<div class="row" style="margin-top: 15px;">
									<div class="col-md-6" id="respuesta"></div>
								</div>
							</div>
						</form> <!--final del form-->
						<form method="post" id="formulario" enctype="multipart/form-data">
							Subir imagen principal: <input type="file" name="file">
						</form>
						<br><br>
						<div class="row">
							<div class="col-md-6">
							<input type="button" id="btn-guardar" class="btn btn-success" value="Guardar" />
							</div>
						</div>
					</div>
				</div>
				<br>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#btn-guardar").click(function(){
			$("#form-guardar").submit();
		});
	});
</script>
