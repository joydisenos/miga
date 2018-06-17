<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Ver Horarios<strong>						
					</div>
					<?php if($horarios){
					foreach ($horarios as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>horarios/editar/" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="lunes">Lunes</label>
											<input class="form-control" disabled name="lunes" id="lunes"  value="<?=$fila->lunes?>">
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="martes">Martes</label>
											<input class="form-control" disabled name="martes" value="<?=$fila->martes?>">
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="miercoles">Miercoles</label>
											<input class="form-control" disabled name="miercoles" id="miercoles" value="<?=$fila->miercoles?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="jueves">Jueves</label>
											<input class="form-control" disabled name="jueves" id="jueves" value="<?=$fila->jueves?>">
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="viernes">Viernes</label>
											<input class="form-control" disabled name="viernes" id="viernes" value="<?=$fila->viernes?>">
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="sabado">S&aacute;bado</label>
											<input class="form-control" disabled name="sabado" id="sabado" value="<?=$fila->sabado?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="domingo">Domingo</label>
											<input class="form-control" disabled name="domingo" id="domingo" value="<?=$fila->domingo?>">
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