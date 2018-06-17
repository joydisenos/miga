<div class="right_col" role="main" style="height:1880px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<strong>Agregar Producto<strong>
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
					<div class="form-container table-container">
						<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>producto/guardar" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row" style="margin-bottom: 15px;">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<?php 
										$categoria_selec_page = 0;
										if(isset($categoria_selec)) {
											$categoria_selec_page = $categoria_selec;
										}
										?>
										<label for="categoria">Categor&iacute;a Principal</label>
										<select name="categoria" id="categoria" class="selectpicker form-control" data-live-search="true">
											<option value="0" >Seleccione..</option>
											<?php foreach ($categorias_padre as $fila_categoria_padre) { ?>
											<option <?php if($categoria_selec_page == $fila_categoria_padre->id) echo 'selected';?> value="<?=$fila_categoria_padre->id?>"><?=$fila_categoria_padre->descripcion?></option>
											<?php } ?>
										</select>
									</div>
									<?php 
										if(isset($subcategoria_selec)) {
									?>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<?php 
										$subcategoria_selec_page = 0;
										if(isset($subcategoria_selec)) {
											$subcategoria_selec_page = $subcategoria_selec;
										}
										?>
										<label for="subcategoria">Subcategor&iacute;a</label>
										<select name="subcategoria" id="subcategoria" class="form-control" data-live-search="true" data-size="5">
											<option value="0" >Seleccione..</option>
											<?php foreach ($subcategorias as $fila_subcategoria) { ?>
											<option <?php if($subcategoria_selec_page == $fila_subcategoria->id) echo 'selected';?> value="<?=$fila_subcategoria->id?>"><?=$fila_subcategoria->descripcion?></option>
											<?php } ?>
										</select>
									</div>
									<?php } else{ ?>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<?php 
										$marca_selec_page = 0;
										if(isset($marca_selec)) {
											$marca_selec_page = $marca_selec;
										}
										?>
										<label for="subcategoria">Subcategor&iacute;a</label>
										<select name="subcategoria" id="subcategoria" class="form-control" data-live-search="true" data-size="5">
											<option value="0">Selecciona la categor&iacute;a principal</option>
										</select>
									</div>
									<?php } ?>
								</div>
								<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('nombre_producto')) { echo 'has-error  has-feedback'; } ?>">
											<label for="nombre_producto">Nombre Producto</label>
											<input class="form-control" name="nombre_producto" id="nombre_producto" placeholder="Nombre Producto" value="<?php echo set_value('nombre_producto'); ?>">
											<?php if(form_error('nombre_producto')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('desc_producto')) { echo 'has-error  has-feedback'; } ?>">
											<label for="desc_producto">Descripci&oacute;n Producto</label>
											<input class="form-control" name="desc_producto" id="desc_producto" placeholder="Descripci&oacute;n Producto" value="<?php echo set_value('desc_producto'); ?>">
											<?php if(form_error('desc_producto')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('cantidad')) { echo 'has-error  has-feedback'; } ?>">
											<label for="cantidad">Cantidad (separados por , )</label>
											<input class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad (separados por , )" value="<?php echo set_value('cantidad'); ?>">
											<?php if(form_error('cantidad')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('cantidad_descripcion')) { echo 'has-error  has-feedback'; } ?>">
											<label for="cantidad_descripcion">Descripci&oacute;n Cantidad</label>
											<input class="form-control" name="cantidad_descripcion" id="cantidad_descripcion" placeholder="Descripci&oacute;n Cantidad" value="<?php echo set_value('cantidad_descripcion'); ?>">
											<?php if(form_error('cantidad_descripcion')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group <?php if(form_error('precio_venta')) { echo 'has-error  has-feedback'; } ?>">
											<label for="precio_venta">Precio Venta</label>
											<input class="form-control solo-numero" name="precio_venta" id="precio_venta" placeholder="Precio Venta" value="<?php echo set_value('precio_venta'); ?>">
											<?php if(form_error('precio_venta')) { ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php } ?>
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group" style="margin-top:30px;">
											<div class="disponible">
												<label><input type="checkbox" id="disponible" name="disponible" <?php if(form_error('disponible')) { ?> checked <?php } ?> value="">&nbsp;Disponible</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="slim img-rounded"
											data-label="Seleccione una imagen de un producto"
											data-ratio="4:4"
											data-size="200,200">
											<input type="file" name="slim[]"/>
										</div>
									</div>
								</div>
								<div class="row" style="margin-top: 15px;">
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

<?php 
$imagen = base_url() . 'img/productos/producto_sin_foto.png';
if (isset($_POST['imagen'])) {
	$imagen = $_POST['imagen'];
}
?>

<script>
	$(document).ready(function() {		

		$("#disponible").prop('checked', true);
		$('#disponible').val('1');

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

		$("#disponible").click(function() {
			if($("#disponible").is(':checked')) {
				$('#disponible').val('1');
			} else {  
				$('#disponible').val('0');
			}
		});

		$("#btn-guardar").click(function(){
			$("#form-guardar").submit();
		});
	});
</script>