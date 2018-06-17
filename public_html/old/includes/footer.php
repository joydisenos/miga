<div class="col-md-12">
	<div class="container">
		<footer>
			<div class="row">
				<hr>
				<p><b>Sondemiga.com &copy; </b>Fábrica de Sandwiches en Azul | Tel.: 02281 15 31 8667</p>
				<div class="hidden-xs">
					<button type="button" class="btn btn-default" onclick="window.location.href='https://www.facebook.com/sondemiga/reviews';"><b><i class="fa fa-star" aria-hidden="true"></i> Calificanos</b></button>
					<button type="button" class="btn btn-default" onclick="window.location.href='/presupuesto.php';"><b><i class="fa fa-money" aria-hidden="true"></i> Presupuestos</b></button>
					<a href="tel:02281318667">
						<button type="button" class="btn btn-default"><b>
							<i class="fa fa-phone" aria-hidden="true"></i> 02281 15 31 8667</b>
						</button>
					</a>
				</div>
				<br>
			</div>
		</footer>
	</div>
</div>

<!-- /.container -->
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Include SmartCart -->
<script src="js/jquery.smartCart.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
<script src="js/sweetAlert.js"></script>
    <link rel="stylesheet" href="js/sweetalert.css">
<!-- Initialize -->
<script type="text/javascript">
	$(document).ready(function(){
		// Initialize Smart Cart    	
		$('#smartcart').smartCart();
	});
</script>

<!-- end SmartCart -->
<script>
	$(document).ready(function(){
		$('.carousel').carousel({
			interval: 3000
		});

		$("#cerrar_modal_producto").click(function(){
			$('#modalVerProducto').modal('hide');
		});

		// Modificado -- 
		$('#cantidad_modal').change(function(){
			var precio_producto = $("#precio_hidden_modal").val();
			var selected_value = $("input[name='product_quantity']:checked").val();
			var subtotal_pedido = parseFloat(precio_producto * selected_value).toFixed(2);
			$(".modal-body #subtotal_carrito_modal").text("($" + subtotal_pedido + ")");
		});
	});
</script>
<script type="text/javascript">
	function ver_producto(boton){
		id_producto = boton.value;
		$.ajax({
			url: "admin/producto/verproductomodal",
			type:"POST",
			data:{id_producto:id_producto},
			dataType: 'json',
			success:function(respuesta){
				var precio = parseFloat(respuesta[0].precio_venta).toFixed(2);
				var cantidad = respuesta[0].cantidad;
				var cantidad_array = cantidad.split(',');
				// Modificado --
				$('#cantidad_modal').html('');

				var iter_cantidad = 1;
				var primera_cantidad = 1;
				var estilo_radio = 'warning';
				$.each(cantidad_array,function(index,contenido){
					// Modificado -- 
					if(iter_cantidad == 1) {
						var radioBtn = $('<div class="funkyradio-'+ estilo_radio + '"><input id="radio' + iter_cantidad + '" type="radio" name="product_quantity" checked value="' + contenido + '"/><label for="radio' + iter_cantidad + '">' + contenido + ' ' + respuesta[0].cantidad_descripcion + '</label></div>');
						primera_cantidad = contenido;
					} else {
						var radioBtn = $('<div class="funkyradio-'+ estilo_radio + '"><input id="radio' + iter_cantidad + '" type="radio" name="product_quantity" value="' + contenido + '"/><label for="radio' + iter_cantidad + '">' + contenido + ' ' + respuesta[0].cantidad_descripcion + '</label></div>');
					}
					radioBtn.appendTo('#cantidad_modal');
					iter_cantidad++;
				});
				var disponible = respuesta[0].disponible;

				if(disponible == 1) {
					$('.modal-body #disponible_modal').show();
					$('.modal-body #no_disponible_modal').hide();
				} else {
					$('.modal-body #disponible_modal').modal('hide');
					$('.modal-body #no_disponible_modal').modal('show');
				}
				var subtotal_pedido = parseFloat(respuesta[0].precio_venta * primera_cantidad).toFixed(2);

				//$(".modal-body #imagen_producto_modal").attr("src", "img/productos/" + respuesta[0].id + ".jpg");
				$(".modal-body #titulo_producto_modal").html(respuesta[0].nombre_producto);
				$(".modal-body #precio_modal").text('$' + precio);
				$(".modal-body #descripcion_producto_modal").html(respuesta[0].desc_producto);
				$(".modal-body #subtotal_carrito_modal").text("($" + subtotal_pedido + ")");
				$(".modal-body #id_hidden_modal").val(respuesta[0].id);
				$(".modal-body #imagen_producto_modal").val("img/productos/" + respuesta[0].id + ".jpg");
				$(".modal-body #precio_hidden_modal").val(precio);
				$('#modalVerProducto').modal('show');
			}
		});
	}
</script>
		
<!-- SCRIPT CARGANDO BOTON!-->
<script>
$('.btn').on('click', function() {
	var $this = $(this);
	$this.button('loading');
	setTimeout(function() {
		$this.button('reset');
	}, 4000);
});
</script>


<script type="text/javascript">
	$(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
        });
	</script>
	
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>