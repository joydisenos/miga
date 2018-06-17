<div class="right_col" role="main" style="height:890px;">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" >
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-label titulo-table">
							<h4><strong>Configuraciones<strong></h4>
						</div>
						<?php if($this->session->flashdata('mensaje_configuracion') == 'M') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Se modificaron correctamente los datos de la configuraci&oacute;n.
							</div>
						<?php }?>
							<?php 
							$tmpl = array (
								'table_open' => '<table class="table table-bordered table-hover table-sad">',
							);
							?>
							<div>
							<?php if($configuraciones) { ?>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
									<?php
									foreach ($configuraciones as $fila) {
										
										$botones = '<a href="'. site_url('/configuraciones/editar/'. $fila->id) .'" class="btn btn-default btn-sm">Editar</a>';

										$this->table->add_row(
										$fila->descripcion,
										$fila->valor,
										$botones);
									}

									$this->table->set_template($tmpl);
									$this->table->set_heading(array('Descripci&oacute;n', 'Valor', 'Opciones'));
									echo $this->table->generate();
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