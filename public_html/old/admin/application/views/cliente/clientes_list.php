<div class="right_col" role="main" style="height:890px;">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" >
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-label titulo-table">
							<h4><strong>Clientes<strong></h4>
						</div>
						<?php if($this->session->flashdata('mensaje_cliente') == 'A') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Se agreg&oacute; el cliente correctamente.
							</div>
						<?php }?>
						<?php if($this->session->flashdata('mensaje_cliente') == 'B') { ?>
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Se elimin&oacute; el cliente correctamente.
							</div>
						<?php }?>
						<?php if($this->session->flashdata('mensaje_cliente') == 'M') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Se modificaron correctamente los datos del cliente.
							</div>
						<?php }?>
						<div class="row">
							<div class="row" style="padding-left: 10px;">
								<div class="col-lg-12">
									<a href="<?php echo site_url('/cliente/agregar/')?>" class="btn btn-success">
										<i class="fa fa-fw fa-plus"></i> Agregar Clientes
									</a>
									<button data-toggle="collapse" type="button" data-target="#busqueda" class="btn btn-primary">Buscar Clientes</button>
								</div>
							</div>
							<div id="busqueda" class="collapse">
							<div class="row busqueda">
								<div class="row">
									<div class="col-lg-12">
										<h4><strong>Buscar Clientes</strong></h4>
									</div>
								</div>
								<div class="row">
									<?php $attributes = array('role' => 'form'); ?>
									<?php echo form_open('cliente/buscarclientes', $attributes); ?>
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Por Nombre" name="nombre" id="nombre_b" value="<?php if($this->session->userdata('buscador_nombre_clientes') != null) {echo $this->session->userdata('buscador_nombre_clientes');} else {echo '';}?>">
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Por Correo" name="correo" id="correo_b" value="<?php if($this->session->userdata('buscador_correo_clientes') != null) {echo $this->session->userdata('buscador_correo_clientes');} else {echo '';}?>">
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Por Teléfono" name="telefono" id="telefono_b" value="<?php if($this->session->userdata('buscador_telefono_clientes') != null) {echo $this->session->userdata('buscador_telefono_clientes');} else {echo '';}?>">
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-12">
										<button class="btn btn-primary" type="submit">Buscar</button>
										<a href="<?php echo site_url('/cliente/')?>" class="btn btn-primary">Todos</a>											
									</div>
									</form>
								</div>
							</div>
							</div>
							<br>
							<?php 
							$tmpl = array (
								'table_open' => '<table class="table table-bordered table-hover table-sad">',
							);
							?>
							<div>
							<?php if($clientes) { ?>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
									<?php
									foreach ($clientes as $fila) {
										$boton_editar_eliminar = '<div class="btn-group" role="group">
											<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu dropdown-menu-left">
												<li><a href="'. site_url('/cliente/editar/'. $fila->id) .'"><i class="fa fa fa-edit"></i> Editar</a></li>
						  						<li><a href="#" data-toggle="modal" data-target="#modalEliminar' . $fila->id . '"><i class="fa fa fa-trash-o"></i> Eliminar</a></li>
											</ul>
										</div>';
										
										$botones = '<div class="btn-group" role="group" aria-label="...">' .
											$boton_editar_eliminar .
											'<a href="'. site_url('/cliente/ver/'. $fila->id) .'" class="btn btn-default btn-sm">Ver Cliente</a>
											</div>';
										

										$this->table->add_row(
										$fila->nombre,
										$fila->direccion,
										$fila->codigo_area . $fila->telefono,
										$fila->puntos_acumulados,
										$botones);
										?>
										<div id="modalEliminar<?php echo $fila->id;?>" class="modal fade" role="dialog">
										  <div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-body">
												<h3>¿Est&aacute; seguro que desea eliminar el cliente?</h3>
											  </div>
											  <div class="modal-footer">
												<button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location='<?php echo site_url('/cliente/eliminar/'. $fila->id)?>';">Si</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
											  </div>
											</div>
										  </div>
										</div>
										
										<?php 
									}

									$this->table->set_template($tmpl);
									$this->table->set_heading(array('Nombre', 'Direcci&oacute;n', 'Tel&eacute;fono', 'Puntos',  'Opciones'));
									echo $this->table->generate();
									echo $this->pagination->create_links();
									?>
									<br>
									<br>
									<br>
									<br>
									<br>
									</div>
								</div>
							<?php }	?>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
</div>

<script type="text/javascript">
if($(window).width() <= 767) {
	$('#menunav').show();
}
</script>