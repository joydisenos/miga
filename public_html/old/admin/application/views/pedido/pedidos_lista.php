<div class="right_col" role="main" style="height:1040px;">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" >
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-label titulo-table">
							<h4><strong>Pedidos<strong></h4>
						</div>
						<?php if($this->session->flashdata('mensaje_pedido') == 'A') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se gener&oacute; correctamente el pedido.
							</div>
						<?php }?>
						<?php if($this->session->flashdata('mensaje_pedido') == 'B') { ?>
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se elimin&oacute; correctamente el pedido.
							</div>
						<?php }?>
						<?php if($this->session->flashdata('mensaje_pedido') == 'M') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se modificaron correctamente los datos del pedido.
							</div>
						<?php }?>
						<?php if($this->session->flashdata('mensaje_pedido') == 'E') { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Se cambio correctamente el estado del pedido.
							</div>
						<?php }?>
						<div class="row">
							<div class="row" style="padding-left: 10px;">
								<div class="col-lg-12">
									<a href="<?php echo site_url('/pedidos/agregar/')?>" class="btn btn-success">
										<i class="fa fa-fw fa-plus"></i> Agregar Pedido
									</a>
									<button data-toggle="collapse" type="button" data-target="#busqueda" class="btn btn-primary">Buscar Pedidos</button>
								</div>
							</div>
							<br>
							<div id="busqueda" class="collapse">
							<div class="row busqueda">
								<div class="row">
									<div class="col-lg-12">
										<h4><strong>Buscar Pedidos</strong></h4>
									</div>
								</div>
								<div class="row">
									<?php $attributes = array('role' => 'form'); ?>
									<?php echo form_open('pedidos/buscarpedido', $attributes); ?>
									<div class="col-md-8 col-xs-12 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-xs-12 col-sm-6">
												<div class="form-group">
												<input type="text" class="form-control" placeholder="Por N&uacute;mero" name="numero" id="numero" 
													value="<?php if($this->session->userdata('buscador_numero_pedido') != null) {echo $this->session->userdata('buscador_numero_pedido');} else {echo '';}?>">
												</div>
											</div>
											<div class="col-md-6 col-xs-12 col-sm-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Por Cliente" name="cliente" id="cliente" 
													value="<?php if($this->session->userdata('buscador_cliente_pedido') != null) {echo $this->session->userdata('buscador_cliente_pedido');} else {echo '';}?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-12 col-sm-6">
												<div class="form-group">
												<select name="estado" id="estado" class="selectpicker form-control" data-live-search="true" data-size="5">
													<option value="0">Seleccione Estado</option>
													<?php foreach ($estados as $fila_estado) { ?>
													<option value="<?=$fila_estado->id?>" <?php if($this->session->userdata('buscador_estado_pedido') == $fila_estado->id) echo 'selected';?>><?=$fila_estado->descripcion?></option>
													<?php } ?>
												</select>
												</div>
											</div>
											<div class="col-md-6 col-xs-12 col-sm-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Por Teléfono Cliente" name="telefono_cliente" id="telefono_cliente" 
													value="<?php if($this->session->userdata('buscador_telefono_cliente_pedido') != null) {echo $this->session->userdata('buscador_telefono_cliente_pedido');} else {echo '';}?>">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-12">
										<button class="btn btn-primary" type="submit">Buscar</button>
										<a href="<?php echo site_url('/pedidos/')?>" class="btn btn-primary">Todos</a>
									</div>
									</form>
									
								</div>
							</div>
							</div>
							<?php 
							$tmpl = array (
								'table_open' => '<table class="table table-bordered table-hover table-sad">',
							);
							?>
							<div>
							<?php if($pedidos) { ?>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
									<?php
									foreach ($pedidos as $fila) {
										$botones = '<div class="btn-group" role="group" aria-label="...">
											<div class="btn-group" role="group">
												<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu dropdown-menu-left">
													<li><a href="#" data-toggle="modal" data-target="#modalEliminar' . $fila->id_pedido . '"><i class="fa fa-trash-o"></i> Eliminar</a></li>
													<li><a href="'. site_url('/pedidos/verpdf/'. $fila->id_pedido) .'" target="_blank"><i class="fa fa-eye"></i> Ver PDF</a></li>
													<li><a href="'. site_url('/pedidos/descargarpdf/'. $fila->id_pedido) .'"><i class="fa fa-file-pdf-o"></i> Descargar PDF</a></li>
													<li><a href="'. site_url('/pedidos/ticket/'. $fila->id_pedido) .'"><i class="fa fa-file-pdf-o"></i> Generar Ticket</a></li>
												</ul>
											</div>
											<button type="button" OnClick="ver_pedido(this)" class="btn btn-default btn-sm" value="' . $fila->id_pedido . '">Ver Pedido</button>
											</div>';

										$boton_cambiar_estado = '<a type="button" class="cambiar_estado open-modal btn '.$fila->class_btn_estado.' btn-xs" data-toggle="modal" ' .
											'data-id="'.$fila->id_pedido. '" data-estadoactual="'.$fila->desc_estado_pedido. '" data-id-estado="' . $fila->id_estado_pedido . '" ' .
											'data-target="#modalCambiarEstado" data-hover="tooltip" data-placement="top" title="Cambiar estado">'.$fila->desc_estado_pedido.'</a>';

										$this->table->add_row(
										$fila->id_pedido,
										$fila->cliente_nombre,
										'$ ' . number_format($fila->total_pedido, 2, ",", "."),
										date('d/m/Y', strtotime($fila->fecha_pedido)),
										$fila->dia_pedido,
										$fila->hora_pedido,
										$fila->tipo_pago_pedido,
										$boton_cambiar_estado,
										$botones);?>

										
										<div id="modalEliminar<?php echo $fila->id_pedido;?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-body">
														<h3 style="color: #000;">¿Est&aacute; seguro que desea eliminar el pedido?</h3>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location='<?php echo site_url('/pedidos/eliminar/'. $fila->id_pedido)?>';">Si</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
													</div>
												</div>
											</div>
										</div>
										<?php 
									}

									$this->table->set_template($tmpl);
									$this->table->set_heading(array('N&uacute;mero','Cliente', 'Total', 'Fecha', 'D&iacute;a Pedido', 'Hora Pedido', 'Tipo de Pago', 'Estado', 'Opciones'));
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
								<div id="modalCambiarEstado" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<?php echo form_open('pedidos/cambiarestado'); ?>
												<div class="modal-body">
													<h3 id="titulo_cambiar_estado">Cambiar estado del pedido</h3>
													<div class="row">
														<input type="hidden" id="id_serv" name="id_serv" value="" />
														<div class="col-md-4 col-sm-6">
															<div class="form-group">
																<label for="estado_actual">Estado Actual:</label>
																<label id="estado_actual"></label>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<div class="form-group">
																<label for="estado_pedido" id="lbl_nuevo_estado">Nuevo estado</label>
																<select name="estado_pedido" id="estado_pedido" class="form-control">
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-success" id="btn_cambiar_estado">Aceptar</button>
												</div>
											</form>
										</div>
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
<div id="modalVerPedido" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h3 id="titulo_cambiar_estado">Pedido #<label id="id_pedido_modal">Nombre</label></h3>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<h2>Cliente</h2>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="nombre_cliente">Nombre Cliente:</label>
							<label id="nombre_cliente"></label>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="direccion_cliente">Dirección Cliente:</label>
							<label id="direccion_cliente"></label>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="telefono_cliente">Teléfono Cliente:</label>
							<label id="telefono_cliente"></label>
						</div>
					</div>
				</div>
				<hr>
				<br>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div id="det_cotizacion">
							<br>
							<hr>
							<table id='mytable' class="table table-condensed table-bordered table-hover table-sad">
								<thead>
									<tr>
										<th class='col-md-5' style='text-align: left;'><strong>Producto</strong></th>
										<th><strong>Cantidad</strong></th>
										<th><strong>P. Unitario</strong></th>
										<th><strong>Subtotal</strong></th>
										<th><strong>Descuento</strong></th>
										<th><strong>Total</strong></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-4 col-sm-4 col-xs-6 col-md-offset-8 col-sm-offset-8 col-xs-offset-5">
							<table class="table table-condensed table-bordered ">
							<thead>
								<tr>
									<th class="info col-md-2">Total Neto</th>
									<th class="precios col-md-1"><div id="sub_total"></div></th>
								</tr>
								<tr id="txt_descuento">
									<th class="info col-md-2">Total Descuento</th>
									<th class="precios col-md-1"><div id="total_descuento"></div></th>
								</tr>
								<tr id="txt_envio">
									<th class="info col-md-2">Total Env&iacute;o</th>
									<th class="precios col-md-1"><div id="total_envio"></div></th>
								</tr>
								<tr>
									<th class="info col-md-2">Monto Total</th>
									<th class="precios col-md-1"><div id="total"></th>
								</tr>
							</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>js/jquery.prettynumber.js"></script>

<script type="text/javascript">
if($(window).width() <= 767) {
	$('#menunav').show();
}
		
$(document).ready(function () {
	//$('#modalVerPedido').modal('show');
	$(document).on("click", ".open-modal", function () {
		var id_serv = $(this).data('id');
		var id_estado = $(this).data('id-estado');
		var estado_actual = $(this).data('estadoactual');
		$(".modal-body #estado_actual").text( estado_actual );
		$(".modal-body #id_serv").val( id_serv );
		
		$('select option').remove();

		$('#estado_pedido').append($('<option>', {
			value: "2",
			text: 'A Entregar'
		}));
		$('#estado_pedido').append($('<option>', {
			value: "3",
			text: 'Entregado'
		}));
		$('#estado_pedido').append($('<option>', {
			value: "1",
			text: 'Completado'
		}));
		$('#estado_pedido').append($('<option>', {
			value: "4",
			text: 'Cancelado'
		}));
	});

});
function ver_pedido(boton){
	id_pedido = boton.value;
	$.ajax({
		url: "<?php echo base_url()?>pedidos/verpedidomodal",
		type:"POST",
		data:{id_pedido:id_pedido},
		dataType: 'json',
		success:function(respuesta){
			//respuesta.cliente;
			$(".modal-body #id_pedido_modal").text(respuesta.id_pedido);
			$.each(respuesta.cliente,function(index,contenido){
				$(".modal-body #nombre_cliente").text(contenido.nombre);
				$(".modal-body #direccion_cliente").text(contenido.direccion);
				$(".modal-body #telefono_cliente").text(contenido.telefono);
			});
			
			var registro = eval(respuesta.detalle_pedido);
			html = "<hr><table id='mytable' class='table table-condensed table-bordered table-hover table-sad'>";
			html += "<thead><tr>";
			html += "<th class='col-md-5' style='text-align: left;'>Producto</th>"; //la columna de articulo
			html += "<th>Cantidad</th>"; //la columna de cantidad
			html += "<th>P Unitario</th>"; //la columna de Precio Unitario.
			html += "<th>Subtotal </th>"; //la columna de Total.
			html += "<th>Descuento</th>"; //la columna de Descuento.
			html += "<th>Total</th>"; //la columna de Total.
			html += "</thead><tbody>";
			//si hay un registro
			if (registro) {
				for (var i = 0; i < registro.length; i++) {
					html += "<tr><td style='text-align: left;'>" + registro[i]["descripcion"] + "</td>";
					html += "<td>" + registro[i]["cantidad"] + "</td>";
					html += "<td>" + registro[i]["precio_unitario"] + "</td>";
					html += "<td>" + registro[i]["sub_total"] + "</td>";
					html += "<td>" + registro[i]["descuento"] + "</td>";
					html += "<td>" + registro[i]["total"] + "</td>";
					$("#det_cotizacion").html(html);
				}
			}

			$.each(respuesta.pedido,function(index,contenido){
				$("#sub_total").html(contenido.pedido_sub_total);
				$("#total_descuento").html(contenido.total_descuento);
				$("#total_envio").html(contenido.total_envio);
				$("#total").html(contenido.total_pedido);
			});

			$("#sub_total").prettynumber();
			$("#total_descuento").prettynumber();
			$("#total_envio").prettynumber();
			$("#total").prettynumber();

			$('#modalVerPedido').modal('show');
		}
	});
}
</script>