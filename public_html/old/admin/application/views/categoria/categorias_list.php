<div class="right_col" role="main" style="height:1050px;">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" >
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-label titulo-table">
							<h4><strong>Categor&iacute;as<strong></h4>
						</div>
						<?php if($this->session->flashdata('mensaje_categoria') == 'A') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se agreg&oacute; la categor&iacute;a correctamente.
							</div>
						<?php }?>
						<?php if($this->session->flashdata('mensaje_categoria') == 'B') { ?>
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se elimin&oacute; la categor&iacute;a correctamente.
							</div>
						<?php }?>
						<?php if($this->session->flashdata('mensaje_categoria') == 'M') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se modificaron correctamente los datos de la categor&iacute;a.
							</div>
						<?php }?>
						<div class="row">
							<div class="row" style="padding-left: 10px;">
								<div class="col-lg-12">
									<a href="<?php echo site_url('/categoria/agregar/')?>" class="btn btn-success">
										<i class="fa fa-fw fa-plus"></i> Agregar Categor&iacute;as
									</a>
								</div>
							</div>
							<br>
							<?php 
							$tmpl = array (
								'table_open' => '<table class="table table-bordered table-hover table-sad">',
							);
							?>
							<div>
							<?php if($categorias) { ?>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
									<?php
									foreach ($categorias as $fila) {
										$boton_editar_eliminar = '<div class="btn-group" role="group">
											<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu dropdown-menu-left">
												<li><a href="'. site_url('/categoria/sub/'. $fila->id) .'"><i class="fa fa fa-eye"></i> Ver Subcategor&iacute;as</a></li>
												<li><a href="'. site_url('/categoria/agregarsub/'. $fila->id) .'"><i class="fa fa fa-plus"></i> Agregar Subcategor&iacute;a</a></li>
												<li><a href="'. site_url('/categoria/editar/'. $fila->id) .'"><i class="fa fa fa-edit"></i> Editar Categor&iacute;a</a></li>
						  						<li><a href="#" data-toggle="modal" data-target="#modalEliminar' . $fila->id . '"><i class="fa fa fa-trash-o"></i> Eliminar Categor&iacute;a</a></li>
											</ul>
										</div>';

										$botones = '<div class="btn-group" role="group" aria-label="...">' .
											$boton_editar_eliminar .
											'<a href="'. site_url('/categoria/ver/'. $fila->id) .'" class="btn btn-default btn-sm">Ver Categor&iacute;a</a>
											</div>';

										$this->table->add_row(
										$fila->id,
										$fila->descripcion,
										$fila->href,
										$botones);
										?>
										<div id="modalEliminar<?php echo $fila->id;?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-body">
														<h3 style="color: #000;">¿Est&aacute; seguro que desea eliminar la categor&iacute;a?</h3>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location='<?php echo site_url('/categoria/eliminar/'. $fila->id)?>';">Si</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
													</div>
												</div>
											</div>
										</div>

										<?php 
									}

									$this->table->set_template($tmpl);
									$this->table->set_heading(array('Id', 'Descripción', 'Href', 'Opciones'));
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
