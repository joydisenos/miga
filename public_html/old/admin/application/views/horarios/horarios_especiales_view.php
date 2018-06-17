<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Ver Horarios Especiales<strong>						
					</div>
					<?php if($horarios){
					foreach ($horarios as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>horarios/editarespeciales/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-2 col-xs-6 col-sm-4">
										<div class="form-group">
											<label for="dia">D&iacute;a</label>
											<input class="form-control" disabled name="dia" id="dia"  value="<?=$fila->dia?>">
										</div>
									</div>
									<div class="col-md-2 col-xs-6 col-sm-4">
										<div class="form-group">
											<label for="mes">Mes</label>
											<input class="form-control" disabled name="mes" value="<?=$fila->mes?>">
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-4">
										<div class="form-group">
											<label for="horario">Horarios</label>
											<input class="form-control" disabled name="horario" id="horario" value="<?=$fila->horario?>">
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