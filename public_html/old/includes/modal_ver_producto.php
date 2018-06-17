<div id="modalVerProducto" class="modal right fade in" role="dialog" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<!-- Modal content-->
		<div class="modal-content">
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		<h4 class="modal-title" id="exampleModalLabel"><b>Detalle del Producto</b></h4>
      </div>
			<div class="modal-body">
				<div class="sc-product-item">
					<div class="media-body">
						<input name="product_image" id="imagen_producto_modal" data-name="product_image" value="" type="hidden"/>
						<h2 id="titulo_producto_modal" class="media-heading" data-name="product_name"></h2>
						<h4 id="disponible_modal"><span class="label label-success"><font color="white"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Disponible</font></span> <span id="precio_modal" class="label label-danger"></span> <span class="label label-warning"><font color="white">Envio S/Cargo</font></span></h4>
						<h4 id="no_disponible_modal"><span class="label label-danger"><font color="white"><i class="fa fa-hand-o-right" aria-hidden="true"></i> No Disponible</font></span></h4>
						<p id="descripcion_producto_modal" class="list-group-item-text" data-name="product_desc"></p><br>
						

						<div class="cart-action-btn-wrapper">
							<div class="item-wrapper">
							
						
								<h4><b>Seleccionar cantidad</b></h4>
								<div class="form-group2" style="margin-bottom: 33px;">
									<form id="cantidad_modal" class="funkyradio"></form>
								</div>
								<button class="sc-add-to-cart btn btn-danger btn-lg" style="width:100%;margin-bottom: 10px;">
									<span class="glyphicon glyphicon-shopping-cart"></span> Agregar al pedido <span id="subtotal_carrito_modal"></span> 
								</button>
								<button class="btn btn-primary btn-lg" id="cerrar_modal_producto" style="width:100%">
									<b><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver</b> 
								</button>
								<input name="product_price" id="precio_hidden_modal" value="" type="hidden" />
								<input name="product_id" id="id_hidden_modal" value="" type="hidden" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>