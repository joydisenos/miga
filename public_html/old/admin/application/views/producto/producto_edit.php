<div class="right_col" role="main" style="height:1540px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Editar Producto<strong>
						<div class="pull-right"><a href="<?php echo site_url('/producto/')?>" class="btn btn-success">Productos</a></div>
					</div>
					<?php if(form_error('nombre_producto') || form_error('desc_producto') ||
						form_error('precio_venta')) {?> 
					<div class="row mensajes-error">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Se encontraron los siguientes errores:</strong><br>
							<?php echo form_error('nombre_producto'); ?>
							<?php echo form_error('desc_producto'); ?>
							<?php echo form_error('precio_venta'); ?>
						</div>
					</div>
					<?php }?>
					<?php if($producto){
					foreach ($producto as $fila) { ?>
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>producto/actualizar/<?=$fila->id?>" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row" style="margin-bottom: 15px;">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<label for="categoria">Categor&iacute;a Principal</label>
										<select name="categoria" id="categoria" class="selectpicker form-control" data-live-search="true">
											<option value="0" >Seleccione..</option>											
											<?php if(isset($categoria_selec)) { ?>
											<?php foreach ($categorias_padre as $fila_categorias_padre) { ?>
											<option value="<?=$fila_categorias_padre->id?>" <?php if($fila_categorias_padre->id == $categoria_selec) echo 'selected';?>><?=$fila_categorias_padre->descripcion?></option>
											<?php } } else { ?>
											<?php foreach ($categorias_padre as $fila_categorias_padre) { ?>
											<option value="<?=$fila_categorias_padre->id?>" <?php if($fila_categorias_padre->id == $fila->id_categoria) echo 'selected';?>><?=$fila_categorias_padre->descripcion?></option>
											<?php } } ?>
										</select>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">					
										<label for="subcategoria">Subcategor&iacute;a</label>
										<select name="subcategoria" id="subcategoria" class="form-control">
											<?php if(isset($subcategoria_selec)) { ?>
											<?php foreach ($subcategorias as $fila_subcategoria) { ?>
											<option value="<?=$fila_subcategoria->id?>" <?php if($fila_subcategoria->id == $subcategoria_selec) echo 'selected';?>><?=$fila_subcategoria->descripcion?></option>
											<?php } } else {?>
											<?php foreach ($subcategorias as $fila_subcategoria) { ?>
											<option value="<?=$fila_subcategoria->id?>" <?php if($fila_subcategoria->id == $fila->id_subcategoria) echo 'selected';?>><?=$fila_subcategoria->descripcion?></option>
											<?php } } ?>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('nombre_producto')) { echo 'has-error  has-feedback'; } ?>">
											<label for="nombre_producto">Nombre Producto</label>
											<input class="form-control" name="nombre_producto" id="nombre_producto" placeholder="Nombre Producto" value="<?php if(set_value('nombre_producto')) {echo set_value('nombre_producto');}else{echo $fila->nombre_producto;} ?>">
											<?php if(form_error('nombre_producto')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('desc_producto')) { echo 'has-error  has-feedback'; } ?>">
											<label for="desc_producto">Descripci&oacute;n Producto</label>
											<input class="form-control" name="desc_producto" id="desc_producto" placeholder="Descripci&oacute;n Producto" value="<?php if(set_value('desc_producto')) {echo set_value('desc_producto');}else{echo $fila->desc_producto;} ?>">
											<?php if(form_error('desc_producto')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('cantidad')) { echo 'has-error  has-feedback'; } ?>">
											<label for="cantidad">Cantidad (separados por , )</label>
											<input class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad (separados por , )" value="<?php if(set_value('cantidad')) {echo set_value('cantidad');}else{echo $fila->cantidad;} ?>">
											<?php if(form_error('cantidad')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('cantidad_descripcion')) { echo 'has-error  has-feedback'; } ?>">
											<label for="cantidad_descripcion">Descripci&oacute;n Cantidad</label>
											<input class="form-control" name="cantidad_descripcion" id="cantidad_descripcion" placeholder="Descripci&oacute;n Cantidad" value="<?php if(set_value('cantidad_descripcion')) {echo set_value('cantidad_descripcion');}else{echo $fila->cantidad_descripcion;} ?>">
											<?php if(form_error('cantidad_descripcion')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('precio_venta')) { echo 'has-error  has-feedback'; } ?>">
											<label for="precio_venta">Precio Venta</label>
											<input class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio Venta" value="<?php if(set_value('precio_venta')) {echo set_value('precio_venta');}else{echo $fila->precio_venta;} ?>">
											<?php if(form_error('precio_venta')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group" style="margin-top:30px;">
											<div class="disponible">
												<label><input type="checkbox" id="disponible" name="disponible" <?php if($fila->disponible == 1) { ?> checked <?php } ?> value="<?php if(set_value('disponible')) {echo set_value('disponible');}else{echo $fila->disponible;} ?>">&nbsp;Disponible</label>
											</div>
										</div>
				                    </div>
								</div>
								<?php 
									$imagen = '../../../img/productos/producto_sin_foto.png';
									if (file_exists('../img/productos/' . $fila->id . '.jpg')) {
										$imagen = '../../../img/productos/' . $fila->id . '.jpg';
									} }} 
								?>
								<div class="row" style="margin-bottom: 15px;">
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="slim img-rounded"
											data-label="Seleccione una imagen de un producto"
											data-ratio="4:4"
											data-size="200,200">
											<img src="<?php echo $imagen; ?>" alt=""/>
											<input type="file" name="slim[]"/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<button type="button" id="btn-guardar" class="btn btn-success">Guardar</button>
									</div>
								</div>
							</div>
						</form> <!--final del form-->
					</div>
				</div>
				<br>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.solo-numero').keyup(function (){
			this.value = (this.value + '').replace(/[^0-9]/g, '');
		});

		$("#disponible").click(function() {
			if($("#disponible").is(':checked')) {
				$('#disponible').val('1');
			} else {  
				$('#disponible').val('0');
			}
		});

		$("#categoria").change(function() {
			$("#categoria option:selected").each(function() {
				categoria = $('#categoria').val();
				$.post("<?php echo site_url()?>producto/llena_categorias", {
					categoria : categoria
				}, function(data) {
					$("#subcategoria").html(data);
				});
			});
		});

		$("#btn-guardar").click(function(){
			$("#form-guardar").submit();
		});
	});
</script>