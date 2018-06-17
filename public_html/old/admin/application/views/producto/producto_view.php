<div class="right_col" role="main" style="height:1800px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Ver Producto<strong>
						<div class="pull-right"><a href="<?php echo site_url('/producto/')?>" class="btn btn-success">Productos</a></div>
					</div>
					<?php if($producto){
					foreach ($producto as $fila) { ?>
					<?php 
						$imagen = 'producto_sin_foto.png';
						if (file_exists('../img/productos/' . $fila->id . '.jpg')) {		
							$imagen = $fila->id . '.jpg';
						}
					?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>producto/editar/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="categoria">Categor&iacute;a</label>
											<input class="form-control" disabled value="<?=$fila->categoria_desc?>">
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="subcategoria">Subcategor&iacute;a</label>
											<input class="form-control" disabled value="<?=$fila->subcategoria_desc?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="nombre_producto">Nombre Producto</label>
											<input class="form-control" disabled value="<?=$fila->nombre_producto?>">
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="desc_producto">Descripci&oacute;n Producto</label>
											<input class="form-control" disabled value="<?=$fila->desc_producto?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="cantidad">Cantidad (separados por , )</label>
											<input class="form-control" disabled value="<?=$fila->cantidad?>">
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="cantidad_descripcion">Descripci&oacute;n Cantidad</label>
											<input class="form-control" disabled value="<?=$fila->cantidad_descripcion?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group">
											<label for="precio_venta">Precio Venta</label>
											<input class="form-control" disabled value="<?=$fila->precio_venta?>">
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group" style="margin-top:30px;">
											<div class="disponible">
												<label><input type="checkbox" id="disponible" name="disponible" <?php if($fila->disponible == 1) { ?> checked <?php } ?> disabled>&nbsp;Disponible</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="thumbnail producto-thumb">
											<img class="result img-responsive" src="../../../img/productos/<?=$imagen?>">
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