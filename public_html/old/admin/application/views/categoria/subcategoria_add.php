<div class="right_col" role="main" style="height:1880px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Agregar Categor&iacute;a<strong>
						<div class="pull-right"><a href="<?php echo site_url('/categoria/sub/' . $categoria_selec)?>" class="btn btn-success">Subcategor&iacute;as</a></div>
					</div>
					<?php if(form_error('descripcion') || form_error('href') ||
						form_error('texto')) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Se encontraron los siguientes errores:</strong><br>
							<?php echo form_error('descripcion'); ?>
							<?php echo form_error('href'); ?>
							<?php echo form_error('texto'); ?>
						</div>
					</div>
					<?php }?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>categoria/guardarsub" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<?php 
										$categoria_selec_page = 0;
										if(isset($categoria_selec)) {
											$categoria_selec_page = $categoria_selec;
										}
										?>
										<label for="categoria">Categor&iacute;a Principal</label>
										<select name="categoria" id="categoria" class="form-control">
											<option value="0" >Seleccione..</option>
											<?php foreach ($categorias_padre as $fila_categoria_padre) { ?>
											<option <?php if($categoria_selec_page == $fila_categoria_padre->id) echo 'selected';?> value="<?=$fila_categoria_padre->id?>"><?=$fila_categoria_padre->descripcion?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('descripcion')) { echo 'has-error  has-feedback'; } ?>">
											<label for="descripcion">Descripci&oacute;n</label>
											<input class="form-control" name="descripcion" id="descripcion" placeholder="Descripci&oacute;n" value="<?php echo set_value('descripcion'); ?>">
											<?php if(form_error('descripcion')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('href')) { echo 'has-error  has-feedback'; } ?>">
											<label for="href">Href</label>
											<input class="form-control" name="href" id="href" placeholder="Href" value="<?php echo set_value('href'); ?>">
											<?php if(form_error('href')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('texto')) { echo 'has-error  has-feedback'; } ?>">
											<label for="texto">Texto</label>
											<input class="form-control" name="texto" id="texto" placeholder="Texto" value="<?php echo set_value('texto'); ?>">
											<?php if(form_error('texto')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row" style="margin-top: 15px;">
									<div class="col-md-6">
										<button type="button" id="btn-guardar" class="btn btn-success">Guardar</button>
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

<script>
	$(document).ready(function() {
		$("#btn-guardar").click(function(){
			$("#form-guardar").submit();
		});
	});
</script>