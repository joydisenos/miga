<div class="right_col" role="main" style="height:1800px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Ver Categor&iacute;a<strong>
						<div class="pull-right"><a href="<?php echo site_url('/categoria/')?>" class="btn btn-success">Categor&iacute;as</a></div>
					</div>
					<?php if($categoria){
					foreach ($categoria as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>categoria/editar/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="descripcion">Descripci&oacute;n</label>
											<input class="form-control" disabled value="<?=$fila->descripcion?>">
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="href">Href</label>
											<input class="form-control" disabled value="<?=$fila->href?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12 col-sm-12">
										<div class="form-group">
											<label for="texto">Texto</label>
											<input type="" class="form-control" disabled value="<?=$fila->texto?>">
										</div>
									</div>
								</div>
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