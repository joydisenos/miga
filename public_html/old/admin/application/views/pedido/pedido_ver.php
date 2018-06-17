<div class="right_col" role="main" style="height:1040px;">
	<?php 
		$id_pedido = 0;
		$neto_cotizacion = 0;
		$total_cotizacion = 0;
		$descuento_cotizacion = 0;
		$numero_pedido = 0;
		$total_envio = 0;
		
		foreach ($pedido as $data): 
		$id_pedido = $data->id_pedido;
		$numero_pedido = $data->numero_pedido;
		$neto_cotizacion = $data->pedido_sub_total;
		$total_cotizacion = $data->total_pedido;
		$descuento_cotizacion = $data->total_descuento;
		$total_envio = $data->total_envio;
		endforeach; 
	?>
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label titulo-table">
						<h4><strong>Pedido #<span id="id_pedido"><?=$numero_pedido?></span><strong></h4>
					</div>
					<div >
						<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="titulos-symba"></div>
						</div>
						<?php foreach ($cliente as $fila) { ?>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h2>Cliente</h2>
							<div class="col-md-3 col-sm-6">
								<div class="form-group">
									<label class="control-lable">Nombre</label>
									<input type="text" id="nombre_cliente" name="nombre_cliente" class="form-control input-sm" disabled value="<?=$fila->nombre?>">
								</div>
							</div>
							<div class="col-md-3 col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="direccion_cliente">Direcci&oacute;n</label>
									<input class="form-control input-sm" name="direccion_cliente" id="direccion_cliente" disabled value="<?=$fila->direccion?>">
								</div>
							</div>
							<div class="col-md-3 col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="telefono_cliente">Tel&eacute;fono</label>
									<input class="form-control input-sm" name="telefono_cliente" id="telefono_cliente" disabled value="<?=$fila->telefono?>">
								</div>
							</div>
						</div>
						<?php } ?>
						<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="titulos-symba"></div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<hr>
								<table class="table table-bordered table-hover table-sad">
									<thead>
										<tr>
											<th>Producto / Servicio</th>
											<th>Cantidad</th>
											<th>P. Unitario</th>
											<th>Descuento</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($detalle_factura): ?>
										<?php foreach ($detalle_factura as $detalle): ?>
										<tr>
											<td><?=$detalle->descripcion?></td>
											<td><?=$detalle->cantidad?></td>
											<td><?php echo '$ ' . number_format($detalle->precio_unitario, 0, ",", ".");?></td>
											<td><?php echo '$ ' . number_format($detalle->descuento, 0, ",", ".");?></td>
											<td><?php echo '$ ' . number_format($detalle->total, 0, ",", ".");?></td>
										</tr>
										<?php endforeach ?>
										<?php endif ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-4 col-sm-4 col-xs-6 col-md-offset-8 col-sm-offset-8 col-xs-offset-5">
								<table class="table table-condensed table-bordered ">
								<thead>
									<tr>
										<th class="info col-md-2">Total Neto</th>
										<th class="precios col-md-1"><div id="sub_total"><?php echo '$ ' . number_format($neto_cotizacion, 0, ",", ".");?></div></th>
									</tr>
									<?php if($descuento_cotizacion > 0) { ?>
									<tr>
										<th class="info col-md-2">Total Descuento</th>
										<th class="precios col-md-1"><div id="total_descuento"><?php echo '$ ' . number_format($descuento_cotizacion, 0, ",", ".");?></div></th>
									</tr>
									<?php } ?>
									<?php if($total_envio > 0) { ?>
									<tr>
										<th class="info col-md-2">Total Env&iacute;o</th>
										<th class="precios col-md-1"><div id="total_envio"><?php echo '$ ' . number_format($total_envio, 0, ",", ".");?></div></th>
									</tr>
									<?php } ?>
									<tr>
										<th class="info col-md-2">Monto Total</th>
										<th class="precios col-md-1"><div id="total"><?php echo '$ ' . number_format($total_cotizacion, 0, ",", ".");?></th>
										<input type="hidden" id="txt_sub_total"name="txt_sub_total" value="">
										<input type="hidden" id="txt_total" name="txt_total" value="">
									</tr>
								</thead>
								</table>
							</div>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
</div>