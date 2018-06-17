<!-- Modal CARRITO -->
<div class="modal right fade in" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="exampleModalLabel"><b><i class="fas fa-cart-arrow-down"></i> Su carrito de compras</b></h4>
			</div>
			<div class="modal-body">
				<center><img src="https://www.sondemiga.com/logo.svg" class="visible-xs" width="200px" height="auto"></center>
				<br>
				<!-- Cart submit form -->
				<form action="repcionProd.php" method="POST"> 
					<!-- SmartCart element -->
					<div id="smartcart"></div>
				</form>
				<p>
					<b>Haga click en el botón 
					<font color="green">
						<i class="fa fa-paper-plane" aria-hidden="true"></i> 
						"Continuar"</font> para completar su pedido</b>
				</p>
				<center>
					<button type="button" class="btn btn-primary btn-lg" style="width:100%;" data-dismiss="modal">Agregar más productos...</button>
				</center>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>