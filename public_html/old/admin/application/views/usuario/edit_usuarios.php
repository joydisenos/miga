<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Editar Usuario<strong>
						<div class="pull-right"><a href="<?php echo site_url('/usuario/')?>" class="btn btn-success">Usuarios</a></div>
					</div>
					<?php if(form_error('password') || 
						form_error('nombre') || form_error('telefono')) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Se encontraron los siguientes errores:</strong><br>
							<?php echo form_error('password'); ?>
							<?php echo form_error('nombre'); ?>
						</div>
					</div>
					<?php }?>
					<?php if(isset($errorPerfil)) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong><?=$errorPerfil?></strong><br>
						</div>
					</div>
					<?php }?>
					<?php if(isset($errorUsuario)) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong><?=$errorUsuario?></strong><br>
						</div>
					</div>
					<?php }?>
					<?php if($usuario){
					foreach ($usuario as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>usuario/actualizar/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="usuario">Usuario</label><span class="mensajes-obligatorios"> (*)</span>
											<input class="form-control" disabled name="usuario" id="usuario" placeholder="Usuario" value="<?=$fila->usuario?>">
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('password')) { echo 'has-error  has-feedback'; } ?>">
											<label id="lbl_password" for="password">Contrase&ntilde;a</label><span class="mensajes-obligatorios"> (*)</span>
											<input class="form-control" type="password" name="password" placeholder="Contrase&ntilde;a" value="<?php if(set_value('password')) {echo set_value('password');}else{echo $fila->password;} ?>">
											<?php if(form_error('password')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('nombre')) { echo 'has-error  has-feedback'; } ?>">
											<label id="lbl_nombre" for="nombre">Nombre</label><span class="mensajes-obligatorios"> (*)</span>
											<input class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php if(set_value('nombre')) {echo set_value('nombre');}else{echo $fila->nombre;} ?>">
											<?php if(form_error('nombre')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<button type="submit" class="btn btn-success">Guardar</button>
									</div>
								</div>
								<div class="row" style="margin-top: 10px;">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<p class="mensajes-obligatorios">(*) Campos obligatorios</p>
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