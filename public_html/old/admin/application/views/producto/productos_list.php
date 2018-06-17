<div class="right_col" role="main" style="height:1750px;">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" >
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-label titulo-table">
							<h4><strong>Productos<strong></h4>
						</div>
						<?php if($this->session->flashdata('mensaje_producto') == 'A') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se agreg&oacute; el producto correctamente.
							</div>
						<?php }?>
						<?php if($this->session->flashdata('mensaje_producto') == 'B') { ?>
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se elimin&oacute; el producto correctamente.
							</div>
						<?php }?>
						<?php if($this->session->flashdata('mensaje_producto') == 'M') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se modificaron correctamente los datos del producto.
							</div>
						<?php }?>
						<div class="row">
							<div class="row" style="padding-left: 10px;">
								<div class="col-lg-12">
									<a href="<?php echo site_url('/producto/agregar/')?>" class="btn btn-success">
										<i class="fa fa-fw fa-plus"></i> Agregar Productos
									</a>
									<button data-toggle="collapse" type="button" data-target="#busqueda" class="btn btn-primary">Buscar Productos</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<button type="button" class="btn btn-success" id="btn_activar_seleccionados" onclick="activar_seleccionados()">Activar Seleccionados</button>
									<button type="button" class="btn btn-danger" id="btn_desactivar_seleccionados" onclick="desactivar_seleccionados()">Desactivar Seleccionados</button>
								</div>
							</div>
							<div id="busqueda" class="collapse">
							<div class="row busqueda">
								<?php $attributes = array('role' => 'form'); ?>
								<?php echo form_open('producto/buscarproducto', $attributes); ?>
								<div class="row">
									<div class="col-lg-12">
										<h4><strong>Buscar Productos</strong></h4>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Por C&oacute;digo" name="codigo" id="codigo" value="<?php if($this->session->userdata('buscador_codigo_productos') != null) {echo $this->session->userdata('buscador_codigo_productos');} else {echo '';}?>">
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Por Descripci&oacute;n" name="titulo" id="titulo" value="<?php if($this->session->userdata('buscador_titulo_productos') != null) {echo $this->session->userdata('buscador_titulo_productos');} else {echo '';}?>">
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="form-group">
											<select name="categoria" id="categoria" class="selectpicker form-control" data-live-search="true" data-size="5">
												<option value="0">-- Seleccione Categor&iacute;a</option>
												<?php foreach ($categorias as $fila_categoria) { ?>
												<option value="<?=$fila_categoria->id?>" <?php if($this->session->userdata('buscador_categoria_productos') == $fila_categoria->id) echo 'selected';?>><?=$fila_categoria->descripcion?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-xs-12 col-sm-12">
									<button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
									<a href="<?php echo site_url('/producto/')?>" class="btn btn-primary">Todos</a>
									<a href="<?php echo site_url('/producto/excel')?>" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</a>									
								</div>
								</form>
							</div>
							</div>
							<br>
							<?php 
							$tmpl = array (
								'table_open' => '<table class="table table-bordered table-hover table-sad">',
							);
							?>
							<div>
							<?php if($productos) { ?>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-sad">
											<thead><tr>
											<th><input type="checkbox" id="check_principal"/></th><th>C&oacute;digo</th><th>Categor&iacute;a</th><th>Producto</th><th>Precio Venta</th><th>Opciones</th></tr>
											</thead>
											<tbody>
									<?php
									foreach ($productos as $fila) {
										$boton_habilitar = '<li><a href="'. site_url('/producto/habilitar/'. $fila->id) .'"><i class="fa fa fa-check"></i> Habilitar</a></li>';

										if($fila->disponible == 1) {
											$boton_habilitar = '<li><a href="'. site_url('/producto/deshabilitar/'. $fila->id) .'"><i class="fa fa fa-times"></i> Deshabilitar</a></li>';
										}

										$boton_editar_eliminar = '<div class="btn-group" role="group">
											<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu dropdown-menu-left">' .
												$boton_habilitar .
												'<li><a href="'. site_url('/producto/editar/'. $fila->id) .'"><i class="fa fa fa-edit"></i> Editar</a></li>
						  						<li><a href="#" data-toggle="modal" data-target="#modalEliminar' . $fila->id . '"><i class="fa fa fa-trash-o"></i> Eliminar</a></li>
											</ul>
										</div>';

										$botones = '<div class="btn-group" role="group" aria-label="...">' .
											$boton_editar_eliminar .
											'<a href="'. site_url('/producto/ver/'. $fila->id) .'" class="btn btn-default btn-sm">Ver Producto</a>
											</div>';

										if(0 < $fila->disponible == 0) {
											echo '<tr class="fila-sin-stock">';
										} else {
											echo '<tr>';
										}

										echo '<td><input type="checkbox" class="check_productos"/></td>';
										echo '<td>' . $fila->id . '</td>';
										echo '<td>' . $fila->categoria_desc . '</td>';
										echo '<td>' . $fila->nombre_producto . '</td>';
										echo '<td>' . '$ ' . number_format($fila->precio_venta, 2, ".", "") . '</td>';
										echo '<td>' . $botones . '</td>';
										echo '</tr>';

										?>
										<div id="modalEliminar<?php echo $fila->id;?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-body">
														<h3 style="color: #000;">¿Est&aacute; seguro que desea eliminar el producto?</h3>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location='<?php echo site_url('/producto/eliminar/'. $fila->id)?>';">Si</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
													</div>
												</div>
											</div>
										</div>

										<?php 
									}

									echo '</tbody></table>';
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

$(document).ready(function() {
	$("#check_principal").click(function() {
		checkboxes = document.getElementsByClassName("check_productos");   
		if($("#check_principal").is(':checked')) {  
			$('#check_principal').val('1');
			for (var i = 0; i < checkboxes.length; i++) {
				var checkbox = checkboxes[i];
				checkbox.checked = true;
			}
		} else {  
			$('#check_principal').val('0');
			for (var i = 0; i < checkboxes.length; i++) {
				var checkbox = checkboxes[i];
				checkbox.checked = false;
			}
		}
	});
});

function activar_seleccionados() {
	checkboxes = document.getElementsByClassName("check_productos"); 

	var ids_eliminar = "0";
	for (var i = 0; i < checkboxes.length; i++) {
		var checkbox = checkboxes[i];
		if(checkbox.checked) {
			var currentRow = checkbox.parentNode.parentNode;
			var id_producto = currentRow.getElementsByTagName("td")[1].textContent;
			ids_eliminar = ids_eliminar + '|' + id_producto;
		}
	}

	$.ajax({
		url: "<?php echo base_url()?>producto/habilitar_masivo",
		type:"POST",
		data:{ids_eliminar:ids_eliminar},
		success:function(data){
			var resultado = JSON.parse(data);
		}
	});

	location.reload();
}
function desactivar_seleccionados() {
	checkboxes = document.getElementsByClassName("check_productos"); 

	var ids_eliminar = "0";
	for (var i = 0; i < checkboxes.length; i++) {
		var checkbox = checkboxes[i];
		if(checkbox.checked) {
			var currentRow = checkbox.parentNode.parentNode;
			var id_producto = currentRow.getElementsByTagName("td")[1].textContent;
			ids_eliminar = ids_eliminar + '|' + id_producto;
		}
	}

	$.ajax({
		url: "<?php echo base_url()?>producto/deshabilitar_masivo",
		type:"POST",
		data:{ids_eliminar:ids_eliminar},
		success:function(data){
			var resultado = JSON.parse(data);
		}
	});

	location.reload();
}
</script>