<!-- PRINCIPAL -->
<div class="right_col" role="main" style="height:1200px;">
	<!-- CONTENEDOR PRINCIPAL -->
	<div class="x_panel">
		<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>pedidos/guardar" method="POST">
			<!-- AGREGAR COTIZACION -->
			<input type="hidden" name="txt_id_pedido" id="txt_id_pedido" value="<?=$id_pedido?>">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 ">
					<div class="table-label">
						<h4><strong>Agregar Pedido<strong></h4>
					</div>
					<!-- CONTENEDOR AGREGAR COTIZACION -->
					<div class="form-container table-container">
						<!-- CLIENTE -->
						<div class="row">
							<div class="col-md-4 col-sm-6 col-xs-12" id="select_cliente">
								<h5><P><label>Cliente</label></P></h5 >
								<div class="input-group my-group">
									<select name="id_cliente_pedido" id="id_cliente_pedido" class="form-control selectpicker show-menu-arrow" data-size="5" required data-live-search="true" >
									<?php if ($clientes): ?>
									<?php foreach ($clientes as $data_cliente): ?>
										<option value="<?=$data_cliente->id?>"><?=$data_cliente->id?> - <?=$data_cliente->codigo_area?><?=$data_cliente->telefono?> - <?=$data_cliente->nombre?></option>
									<?php endforeach ?>
									<?php endif ?>
									</select>
									<span class="input-group-btn">
										<a id="boton_agregar_cliente" data-toggle="modal" data-target="#agregar_cliente" class="btn btn-success">Agregar</a>
									</span>
								</div>
							</div>
							<div class="col-md-2 col-sm-6 col-xs-12" id="select_dia">
								<h5><P><label>D&iacute;a de Entrega</label></P></h5 >
								<div class="form-group">
									<select name="dia_pedido" id="dia_pedido" class="form-control selectpicker show-menu-arrow" data-size="10" required data-live-search="true" >
										<option value="Hoy">- HOY -</option>
										<option value="Lunes">Lunes</option>
										<option value="Martes">Martes</option>
										<option value="Miercoles">Miercoles</option>
										<option value="Jueves">Jueves</option>
										<option value="Viernes">Viernes</option>
										<option value="Sábado">Sábado</option>
										<option value="Domingo">Domingo</option>
									</select>
								</div>
							</div>
							<div class="col-md-2 col-sm-6 col-xs-12" id="select_cliente">
								<h5><P><label>Hora de Entrega</label></P></h5 >
								<div class="form-group">
									<select name="hora_pedido" id="hora_pedido" class="form-control selectpicker show-menu-arrow" data-size="10" required data-live-search="true" >
										<option value="Sin Seleccionar">- Hora de Entrega -</option>
										<option value="Entre 09:30 y 10:00">Entre 09:30 y 10:00</option>
										<option value="Entre 10:00 y 10:30">Entre 10:00 y 10:30</option>
										<option value="Entre 10:30 y 11:00">Entre 10:30 y 11:00</option>
										<option value="Entre 11:00 y 11:30">Entre 11:00 y 11:30</option>
										<option value="Entre 11:30 y 12:00">Entre 11:30 y 12:00</option>
										<option value="Entre 12:00 y 12:30">Entre 12:00 y 12:30</option>
										<option value="Entre 12:30 y 13:00">Entre 12:30 y 13:00</option>
										<option value="Entre 13:00 y 13:30">Entre 13:00 y 13:30</option>
										<option value="Entre 13:30 y 14:00">Entre 13:30 y 14:00</option>
										<option value="Entre 14:00 y 14:30">Entre 14:00 y 14:30</option>
										<option value="Entre 14:30 y 15:00">Entre 14:30 y 15:00</option>
										<option value="Entre 15:00 y 15:30">Entre 15:00 y 15:30</option>
										<option value="Entre 15:30 y 16:00">Entre 15:30 y 16:00</option>
										<option value="Entre 16:00 y 16:30">Entre 16:00 y 16:30</option>
										<option value="Entre 16:30 y 17:00">Entre 16:30 y 17:00</option>
										<option value="Entre 17:00 y 17:30">Entre 17:00 y 17:30</option>
										<option value="Entre 17:30 y 18:00">Entre 17:30 y 18:00</option>
										<option value="Entre 18:30 y 18:30">Entre 18:00 y 18:30</option>
										<option value="Entre 18:30 y 19:00">Entre 18:30 y 19:00</option>
										<option value="Entre 19:00 y 19:30">Entre 19:00 y 19:30</option>
										<option value="Entre 19:30 y 20:00">Entre 19:30 y 20:00</option>
										<option value="Entre 20:00 y 20:30">Entre 20:00 y 20:30</option>
										<option value="Entre 20:30 y 21:00">Entre 20:30 y 21:00</option>
										<option value="Entre 21:00 y 21:30">Entre 21:00 y 21:30</option>
										<option value="Entre 21:30 y 22:00">Entre 21:30 y 22:00</option>
										<option value="Entre 22:00 y 22:30">Entre 22:00 y 22:30</option>
										<option value="Entre 22:30 y 23:00">Entre 22:30 y 23:00</option>
									</select>
								</div>
							</div>
							<div class="col-md-2 col-sm-6 col-xs-12" id="select_envio">
								<h5><P><label>Agrega Env&iacute;o</label></P></h5 >
								<div class="form-group">
									<select name="agrega_envio" id="agrega_envio" class="form-control selectpicker show-menu-arrow" data-size="10" required data-live-search="true" >
										<option value="1">Si</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-md-2 col-sm-6 col-xs-12" id="select_pago">
								<h5><P><label>Tipo de pago</label></P></h5 >
								<div class="form-group">
									<select name="tipo_pago" id="tipo_pago" class="form-control selectpicker show-menu-arrow" data-size="10" required data-live-search="true" >
										<option value="Efectivo">Efectivo</option>
										<option value="tarjeta">Tarjeta</option>
										<option value="tarjeta al delivery">Tarjeta al delivery</option>
									</select>
								</div>
							</div>
						</div>
						<!-- FIN CLIENTE -->
						<div class="titulos-symba"></div>
						<!-- PRODUCTOS REGISTRADOS -->
						<div class="row">
							<div class="alert alert-danger alert-dismissible" role="alert" id="no_stock">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  No hay stock para la cantidad ingresada.
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<h5><P><label>Producto</label></P></h5 >
									<select name="id_producto" id="id_producto" class="form-control selectpicker show-menu-arrow" data-size="5" required data-live-search="true" >
									<?php if ($productos): ?>
									<?php foreach ($productos as $data): ?>
										<option value="<?=$data->id?>"><?=$data->nombre_producto?></option>
									<?php endforeach ?>
									<?php endif ?>
									</select>
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="form-group">
									<h5 ><P><label>Cantidad:</label></P></h5 >
									<input type="number" name="txt_cantidad" id="txt_cantidad" class="form-control" min="1" max="" step="1" value="1">
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="form-group">
									<h5 ><P><label>% Desc</label></P></h5 >
									<input type="number" name="txt_descuento" id="txt_descuento" class="form-control" min="0" max="100" step="1" value="0">
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<div class="form-group">
									<h5 ><P><label>&nbsp;</label></P></h5 >
									<button class="btn btn-success" onclick="guardar_det_producto()" name="btn_enviar_producto"id="btn_enviar_producto" type="button">Agregar</button>
								</div>
							</div>
						</div>
						<!-- FIN PRODUCTOS REGISTRADOS -->
						<hr>
						<!-- PRODUCTOS FUERA DE INVENTARIO -->
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<button data-toggle="collapse" type="button" data-target="#demo" class="btn btn-primary">Productos fuera de stock</button>
							</div>
							<div id="demo" class="collapse">
								<div class="col-md-6 col-sm-12 col-xs-12"style="padding-right: 5px;">
									<div class="form-group">
										<h5 ><P><label>Producto</label></P></h5 >
										<input type="text" name="txt_producto_manual" id="txt_producto_manual" class="form-control">
									</div>
								</div>
								<div class="col-md-1 col-sm-6 col-xs-6" style="padding-left: 5px;padding-right: 5px;">
									<div class="form-group">
										<h5 ><P><label>Cantidad</label></P></h5 >
										<input type="number" name="txt_cantidad_manual" id="txt_cantidad_manual" class="form-control" min="1" max="" value="1" step="1">
									</div>
								</div>
								<div class="col-md-2 col-sm-6 col-xs-6" style="padding-left: 5px;padding-right: 5px;">
									<div class="form-group">
										<h5 ><P><label>P. Neto</label></P></h5 >
										<input type="text" name="txt_precio_neto_manual" id="txt_precio_neto_manual" class="form-control">
									</div>
								</div>
								<div class="col-md-1 col-sm-6 col-xs-6" style="padding-left: 5px;padding-right: 5px;">
									<div class="form-group">
										<h5 ><P><label>% Desc</label></P></h5 >
										<input type="text" name="txt_porc_desc_manual" id="txt_porc_desc_manual" class="form-control">
									</div>
								</div>
								
								<div class="col-md-1 col-sm-12 col-xs-12" style="padding-left: 5px;">
									<div class="form-group">
										<h5 ><P><label>&nbsp;</label></P></h5 >
										<button class="btn btn-success " onclick="guardar_det_producto_manual()" name="btn_enviar_producto_manual"id="btn_enviar_producto_manual" type="button">Agregar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- DETALLE DE COTIZACION -->
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
												<th><strong>Acciones</strong></th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- FIN DETALLE DE COTIZACION -->
						<div class="titulos-symba"></div>
						<!-- OBSERVACIONES, DESCUENTOS Y TOTALES -->
						<div class="row">
							<!-- OBSERVACIONES Y BOTON GUARDAR-->
							<div class="col-md-8 col-sm-8 col-xs-12">
								<div class="row">
									<div class="col-md-8">
										<label>Observaciones:</label>
										<textarea name="txt_observaciones" id="txt_observaciones" class="form-control" rows="4"></textarea>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="txt_descuento_general">Descuento (%)</label>
										<input class="form-control" onkeyup="calculardescuento();" name="txt_descuento_general" id="txt_descuento_general" value="">
									</div>
									</div>
								</div>
								<br>
								<div class="row">
									<P ALIGN="RIGHT">
									<button type="submit" id="procesar-cotizacion" class="btn btn-primary">Guardar Pedido</button>
									<a href="<?php echo $this->config->base_url();?>pedidos"><button type="button" class="btn btn-danger">Cancelar</button></a>
									</P>
								</div>
							</div>
							<!-- FIN OBSERVACIONES Y BOTON GUARDAR -->
							<!-- TOTALES -->
							<div class="col-md-4 col-sm-4 col-xs-12">
								<table class="table table-condensed table-bordered ">
									<thead>
										<tr>
											<th class="info col-md-2">Sub Total</th>
											<th class="col-md-1"><div id="sub_total">0</div></th>
										</tr>
										<tr id="row_descuento">
											<th class="info col-md-2">Descuento</th>
											<th class="precios col-md-1"><div id="total_descuento">0</div></th>
										</tr>
										<tr id="row_envio">
											<th class="info col-md-2">Env&iacute;o</th>
											<th class="precios col-md-1"><div id="total_envio"><?php echo '$ ' . number_format($costo_envio, 0, ",", ".");?></div></th>
										</tr>
										<tr>
											<th class="info col-md-2">Total</th>
											<th class="precios col-md-1"><div id="total">0</div></th>
											<input type="hidden" id="txt_sub_total"name="txt_sub_total" value="">
											<input type="hidden" id="txt_descuento_total" name="txt_descuento_total" value="0">
											<input type="hidden" id="txt_sub_total_con_desc" name="txt_sub_total_con_desc" value="">
											<input type="hidden" id="txt_costo_envio" name="txt_costo_envio" value="<?=$costo_envio?>">
											<input type="hidden" id="txt_total" name="txt_total" value="">
										</tr>
									</thead>
								</table>
							</div> <!-- FIN TOTALES -->
						</div> <!-- FIN OBSERVACIONES, DESCUENTOS Y TOTALES -->
					</div> <!-- FIN CONTENEDOR AGREGAR COTIZACION -->
				</div>
			</div> <!-- FIN AGREGAR COTIZACION -->
		</form>
	</div> <!-- FIN CONTENEDOR PRINCIPAL -->
</div> <!-- CONTENEDOR PRINCIPAL -->

<!-- Modal -->
<div id="agregar_cliente" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agregar Cliente</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
					<?php $attributes = array('role' => 'form', 'id' => 'form-agregar-cliente'); ?>
					<?php echo form_open('cotizacion/agregarcliente', $attributes); ?>
						<div class="row">
							<div class="col-md-12 col-xs-12 col-sm-12">
								<div class="alert alert-danger alert-dismissible" role="alert" id="error_rut_ingresado">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									El RUT ingresado ya existe.
								</div>
							</div>
						</div>
						<div class="row">							
							<div class="col-md-6 col-xs-12 col-sm-6">
								<div class="form-group">
									<label id="lbl_nombre" for="nombre-agregar">Nombre</label>
									<input class="form-control" name="nombre-agregar" id="nombre-agregar" placeholder="Nombre" required="required">
								</div>
							</div>
							<div class="col-md-6 col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="correo-agregar">Correo</label>
									<input class="form-control" name="correo-agregar" id="correo-agregar" placeholder="Correo">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-xs-4 col-sm-2">
								<div class="form-group">
									<label for="area-agregar">Area</label>
									<input class="form-control" name="area-agregar" id="area-agregar" placeholder="Area" >
								</div>
							</div>
							<div class="col-md-4 col-xs-8 col-sm-4">
								<div class="form-group">
									<label for="telefono-agregar">Tel&eacute;fono</label>
									<input class="form-control" name="telefono-agregar" id="telefono-agregar" placeholder="Tel&eacute;fono" >
								</div>
							</div>
							<div class="col-md-6 col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="direccion-agregar">Direcci&oacute;n</label>
									<input class="form-control" name="direccion-agregar" id="direccion-agregar" placeholder="Direcci&oacute;n" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
							<button type="submit" class="btn btn-success">Guardar</button>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>js/jquery.prettynumber.js"></script>
<script src="<?php echo base_url();?>js/bootstrap-select.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#no_stock').hide();
	$('#row_descuento').hide();
	$('#procesar-cotizacion').prop('disabled', true);

	$("#form-agregar-cliente").submit(function(e) {
		$.ajax({
			url: "<?php echo base_url()?>pedidos/agregarcliente",
			type:"POST",
			data: $("#form-agregar-cliente").serialize(),
			success: function(data) {
				var clientes = JSON.parse(data);
				$('#agregar_cliente').modal('hide');
				var options = [];
				clientes.forEach(function (item) {
				var option = '<option value"' + item.id + '">' + item.id + ' - ' + item.nombre + '</option>'
				options.push(option);
				});
				$('#id_cliente_pedido').html(options);
				$('#id_cliente_pedido').selectpicker('refresh');
			}
		});

		e.preventDefault();
	});

	$("#agrega_envio").change(function() {
		mostrardatos("");
	});
});

function mostrardatos(datos) {
	$.ajax({
		url: "<?php echo base_url()?>pedidos/mostrar_det_pedido",
		type: 'POST',
		data: $("#form-guardar").serialize(),
		success: function(respuesta) {
			var registro = eval(respuesta);
			html = "<hr><table id='mytable' class='table table-condensed table-bordered table-hover table-sad'>";
			html += "<thead><tr>";
			html += "<th class='col-md-5' style='text-align: left;'>Producto</th>"; //la columna de articulo
			html += "<th>Cantidad</th>"; //la columna de cantidad
			html += "<th>P Unitario</th>"; //la columna de Precio Unitario.
			html += "<th>Subtotal </th>"; //la columna de Total.
			html += "<th>Descuento</th>"; //la columna de Descuento.
			html += "<th>Total</th>"; //la columna de Total.
			html += "<th>Acciones</th>"; //la columna de las accion borrar.
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
				html += "<td><button class='btn btn-danger btn-xs glyphicon glyphicon-trash' name='btn_eliminar'id='btn_eliminar'OnClick='eliminar_det_cotizacion(this)' type='button' value='" + registro[i]["id"] + "' title='ELiminar Item'></button></td>";
				$("#det_cotizacion").html(html);
			}

			tabla = document.getElementById("mytable");

			// Precios
			var sub_total = 0;
			var sub_total_con_desc = 0;
			var descuento = 0;

			// Suma los subtotales
			for(var i = 1; tabla.rows[i]; i++) {
				sub_total+=Number(tabla.rows[i].cells[3].innerHTML);
				sub_total_con_desc+=Number(tabla.rows[i].cells[5].innerHTML);

				descuento+=Number(tabla.rows[i].cells[4].innerHTML);
			}

			var id_cliente = $("#id_cliente_pedido").val();

			if(sub_total >= 0 && id_cliente > 0) {
				// Si hay productos y esta seleccionado el cliente se habilita el boton de guardar
				$('#procesar-cotizacion').prop('disabled', false);
				
			} else {
				// Si no hay productos o no esta seleccionado el cliente se deshabilita el boton de guardar
				$('#procesar-cotizacion').prop('disabled', true);
			}

			var descuento_global = document.getElementById("txt_descuento_general").value;
			//var descuento_global = 0;

			if(descuento_global == '' || descuento_global == 0) {
				descuento_global = 0;
			}

			var descuento_global_precio = sub_total_con_desc * descuento_global / 100;

			sub_total_con_desc = sub_total_con_desc - descuento_global_precio;

			var total = sub_total - descuento - descuento_global_precio;

			descuento = descuento + descuento_global_precio;

			if(descuento > 0) {
				$('#row_subtotal_descuento').show();
				$('#row_descuento').show();
			} else {
				$('#row_subtotal_descuento').hide();
				$('#row_descuento').hide();
			}

			var agregaenvio = $( "#agrega_envio" ).val();

			// Agrega costo de envio
			if($("#agrega_envio" ).val() == 1) {
				total = total  + parseInt(document.getElementById("txt_costo_envio").value);
				$('#row_envio').show();
			} else {
				$('#row_envio').hide();
			}

			//descuento = descuento + descuento_global_precio;

			$("#sub_total").html(sub_total);
			$("#total_descuento").html(descuento);
			$("#sub_total_con_desc").html(sub_total_con_desc);
			$("#total").html(total);

			$("#sub_total").prettynumber();
			$("#total_descuento").prettynumber();
			$("#sub_total_con_desc").prettynumber();
			$("#total").prettynumber();

			document.getElementById("txt_sub_total").value =(sub_total);
			document.getElementById("txt_descuento_total").value =(descuento);
			document.getElementById("txt_sub_total_con_desc").value =(sub_total_con_desc);
			document.getElementById("txt_total").value =(total);
			document.getElementById("txt_cantidad").value = 1;
			document.getElementById("txt_cantidad_manual").value = 1;

			//si no lo hay XD
			}else{
				var sub_total = 0;				
				var total=0;
				
				$("#det_cotizacion").html(html);
				$("#sub_total").html(sub_total);
				$("#total").html(total);

				document.getElementById("txt_sub_total").value =(sub_total);
				document.getElementById("txt_total").value =(total);

				// Si los valores totales estan en 0 es porque no hay productos, se deshabilita el boton de guardar
				$('#procesar-cotizacion').prop('disabled', true);
			};
		}
	});
}

function calculardescuento(){
	mostrardatos("");
}

function guardar_det_producto(datos){
	event.preventDefault();
	$.ajax({
		url: "<?php echo base_url()?>pedidos/guardar_det_pedido_item",
		type:"POST",
		data: $("#form-guardar").serialize(),
		success:function(respuesta){
			if(respuesta == "0") {
				$('#no_stock').show();
			} else {
				$('#no_stock').hide();
			}

			mostrardatos("");
		}
	});
}
function guardar_det_producto_manual(datos){
	event.preventDefault();
	$.ajax({
		url: "<?php echo base_url()?>pedidos/guardar_det_pedido_item_manual",
		type:"POST",
		data: $("#form-guardar").serialize(),
		success:function(respuesta){
		mostrardatos("");
		$("#txt_producto_manual").val('');
		$("#txt_precio_neto_manual").val('');
		$("#txt_porc_desc_manual").val('');
		$("#txt_cantidad_manual").val('');
	}
	});
}
function eliminar_det_cotizacion(boton){
	ID=boton.value;
	$.ajax({
		url: "<?php echo base_url()?>pedidos/eliminar_det_pedido",
		type:"POST",
		data:{id:ID},
		success:function(respuesta){
			mostrardatos("");
		}
});
}

function eliminar_cotizacion(boton){
	var respuesta = confirm("Desea Salir?");
	if(respuesta){
	ID=boton.value;
		$.ajax({
			url: "<?php echo base_url()?>notaventa/eliminar_toda_cotizacion",
			type:"POST",
			data:{id:ID},
			success:function(respuesta){
			top.location.href="<?php echo base_url()?>cotizacion";//redirection
			}
		});
	}
}
</script>