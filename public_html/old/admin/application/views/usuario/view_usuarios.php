<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Agregar Usuario<strong>
						<div class="pull-right"><a href="<?php echo site_url('/usuario/')?>" class="btn btn-success">Usuarios</a></div>
					</div>
					<?php if($usuario){
					foreach ($usuario as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>usuario/editar/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="usuario">Usuario</label>
											<input class="form-control" disabled name="usuario" id="usuario"  value="<?=$fila->usuario?>">
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label id="lbl_password" for="password">Contrase&ntilde;a</label>
											<input class="form-control" disabled type="password" name="password" value="<?=$fila->password?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label id="lbl_nombre" for="nombre">Nombre</label>
											<input class="form-control" disabled name="nombre" id="nombre" value="<?=$fila->nombre?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
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