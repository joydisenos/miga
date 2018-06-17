<div class="right_col" role="main" style="height:1800px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Ver Im&aacute;genes<strong>
						<div class="pull-right"><a href="<?php echo site_url('/imagenes/')?>" class="btn btn-success">Im&aacute;genes</a></div>
					</div>
					<?php if($imagen){
					foreach ($imagen as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>imagenes/editar/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="descripcion_imagen">Descripci&oacute;n Im&aacute;gen</label>
											<input class="form-control" disabled value="<?=$fila->descripcion_imagen?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="link">Link</label>
											<input class="form-control" disabled value="<?=$fila->link?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="posicion">Posici&oacute;n</label>
											<input class="form-control" type="number" disabled value="<?=$fila->posicion?>">
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-8 col-sm-12 col-xs-12 col-lg-8" id="respuesta">
									<img class="img img-responsive" src="<?php echo base_url() . 'img/slides/' . $fila->url_imagen?>"><input type="hidden" name="url_imagen" value="<?=$fila->url_imagen?>">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
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