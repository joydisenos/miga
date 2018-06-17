<?php require_once("librerias/cargar_librerias.php"); ?>
<?php
	// Consulta de categorias
	$query_categorias = "SELECT * FROM categoria where id_padre = 0 and estado_logico = 'A'";
	$categorias = $conex->query($query_categorias);
?>
<?php
	include("horas/horas.php");//colocar la ruta del archivo
	$class= new h();
?>

<?php include 'includes/header.php';?>
<body>
<?php include 'includes/modal_bienvenidos.php';?>
<?php include 'includes/menu.php';?>

<div class="tabbable">
	<div class="tab-content"> 
		<div id="tab2" class="tab-pane active"> <!-- TAB SABORES -->
			<header>
				<?php 
				// Consulta de categorias
				$query_imagenes = "SELECT * FROM imagenes where estado_logico = 'A' order by posicion asc";
				$imagenes = $conex->query($query_imagenes);
				?>
				<?php if ($imagenes->num_rows > 0) { // if de categorias principales ?>
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<?php $iterador = 1; ?>
						<?php while($row_imagenes = $imagenes->fetch_assoc()) { ?>
							<li data-target="#myCarousel" data-slide-to="<?php echo $iterador;?>" <?php if($iterador == 1) { echo 'class="active"';}?>></li>
						<?php $iterador++; ?>
						<?php } ?>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">
					<?php 
				// Consulta de categorias
				$query_imagenes = "SELECT * FROM imagenes where estado_logico = 'A' order by posicion asc";
				$imagenes = $conex->query($query_imagenes);
				?>
					<?php $iterador = 1; ?>
					<?php while($row_imagenes = $imagenes->fetch_assoc()) { ?>
						<?php if($row_imagenes["link"] == "#") { ?>
							<div class="item <?php if($iterador == 1) { echo 'active';}?>">
							<img src="admin/img/slides/<?php echo $row_imagenes['url_imagen']?>" alt="<?php echo $row_imagenes['descripcion_imagen']?>">
						</div>
						<?php } else { ?>
						<div class="item <?php if($iterador == 1) { echo 'active';}?>">
							<a href="<?php echo $row_imagenes['link']?>"><img src="admin/img/slides/<?php echo $row_imagenes['url_imagen']?>" alt="<?php echo $row_imagenes['descripcion_imagen']?>"></a>
						</div>
						<?php } ?>
					<?php $iterador++; ?>
					<?php } ?>
					</div>
					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
				<?php } ?>
			</header>
							
			<center>
			<span id='bodyC'>
						<?php echo $class->returnDisplay(); ?>
					</span>
			</center>
			
			
			<!-- Contenido -->
			
			<div class="col-md-3 hidden">
			<center>
				<?php if ($categorias->num_rows > 0) { ?>
				<div class="list-group">
					<a href="#" class="list-group-item active">Todos</a>
					<?php while($row = $categorias->fetch_assoc()) { ?>
					<a href="#<?php echo $row["href"]; ?>" class="list-group-item"><?php echo $row["descripcion"]; ?></a>
					<?php } ?>
				</div>
				<?php } ?>
			</center>
			</div>
			
			<!-- PRODUCTOS -->
			<div class="col-md-6 col-md-offset-3">
				<?php 
				// Consulta de categorias
				$query_categorias_productos = "SELECT * FROM categoria where id_padre = 0 and estado_logico = 'A'";
				$categorias_productos = $conex->query($query_categorias_productos);
				?>
				<?php if ($categorias_productos->num_rows > 0) { // if de categorias principales ?>
				<?php while($row_categorias = $categorias_productos->fetch_assoc()) { ?>
				<!-- Categorias -->
				<a name="<?php echo $row_categorias["href"];?>"></a>
				<h3><b><?php echo $row_categorias["descripcion"];?></b></h3>
				<p><?php echo $row_categorias["texto"];?></p>
				<hr>
				<?php
					// Consulta si tiene subcategorias
					$query_subcategorias = "SELECT * FROM categoria where id_padre = " . $row_categorias["id"] . " and estado_logico = 'A'";
					$subcategorias = $conex->query($query_subcategorias);
					// Si no tiene subcategorias muestra los productos de la categoria principal
					if ($subcategorias->num_rows == 0) { // if subcategorias
						// Consulta de productos
						$query_producto_1 = "SELECT * FROM producto where id_categoria = " . $row_categorias["id"] . " and estado_logico = 'A' and disponible = '1'";
						$productos = $conex->query($query_producto_1);
						if ($productos->num_rows > 0) { // if productos sin subcategorias
							while($row_productos = $productos->fetch_assoc()) { // while productos sin subcategorias
						?>
						<!-- INFORMACION PRODUCTO -->
						<div class="sc-product-item" id="sc_product_item_<?php echo $row_productos["id"]; ?>">
								<div class="media-rigth">
								<?php
									if($row_productos["disponible"] == 1) {
									?>
									<div class="cart-action-btn-wrapper" style="float:right; ">
										<div class="item-wrapper" style="margin-right: 0px;">
											<br>
											<button class="btn btn-danger btn-sm" <?php if($row_productos["disponible"] == 0){echo 'disabled';}?> OnClick="ver_producto(this)" value="<?php echo $row_productos["id"]; ?>" style="width:100%;" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> cargando">
												<b>VER <span class="fa fa-chevron-right"></span></b> 
											</button>
											
											
											<input name="product_price" value="<?php echo number_format($row_productos["precio_venta"], 2, ".", "") ?>" type="hidden" />
											<input name="product_id" value="<?php echo $row_productos["id"]; ?>" type="hidden" />
										</div>
									</div>
									<?php
									} else {
									?>
									<h4><font color="orange"><i class="fa fa-hand-o-right" aria-hidden="true"></i> No Disponible</font> <?php echo '$' . number_format($row_productos["precio_venta"], 2, ".", "") ?></h4>
									<?php } ?>
								</div>
								<div class="media-left">
								<img data-name="product_image" class="media-object" src="img/productos/<?php echo $row_productos["id"]; ?>.jpg" alt="" style="width:90px; height:90px;">
								</div>
								<div class="media-body">
									
									<h4 class="media-heading" data-name="product_name"><b><?php echo $row_productos["nombre_producto"]; ?></b></h4>
									<h4><span class="label label-success"><font color="white"> <?php echo '$' . number_format($row_productos["precio_venta"], 2, ".", "") ?></font></span></h4>
								
								<img src="/img/p1.png" width="24px" height="auto"/>
								<img src="/img/p2.png" width="24px" height="auto"/>
								<img src="/img/p8.png" width="24px" height="auto"/>
								
								</div>
								
									
								
							</div>
						<!-- FIN INFORMACION PRODUCTO -->
						<hr>
						<?php } // fin while productos sin subcategorias ?>
					<?php } // fin if productos sin subcategorias?>
					<?php
					}
					// FIN - Si no tiene subcategorias muestra los productos de la categoria principal
					// Si tiene subcategorias se recorren las subcategorias asociadas
					if ($subcategorias->num_rows > 0) {
						while($row_sub = $subcategorias->fetch_assoc()) { // WHILE subcategorias
							// Consulta de productos en cada subcategoria
							$query_producto_sub = "SELECT * FROM producto where id_subcategoria = " . $row_sub["id"] . " and estado_logico = 'A' and disponible = '1'";
							$productos_subcategoria = $conex->query($query_producto_sub);
						?>
						<h4><?php echo $row_sub["descripcion_web"]; ?></h4>
						<hr>
						<?php 
							if ($productos_subcategoria->num_rows > 0) {
							while($row_sub_productos = $productos_subcategoria->fetch_assoc()) { 
								?>
								<!-- INFORMACION PRODUCTO -->
					
							<div class="sc-product-item" id="sc_product_item_<?php echo $row_sub_productos["id"]; ?>">
								<div class="media-rigth">
									<?php
									if($row_sub_productos["disponible"] == 1) {
									?>
									
									<?php
									} else {
									?>
									<h4><span class="label label-danger"><font color="white"><i class="fa fa-hand-o-right" aria-hidden="true"></i> No Disponible</font></span></h4>
									<?php } ?>
									
									
									<div class="cart-action-btn-wrapper" style="float:right;">
										<div class="item-wrapper" style="margin-right: 0px;">
											<br>
											<button class="btn btn-danger btn-sm" <?php if($row_sub_productos["disponible"] == 0){echo 'disabled';}?> OnClick="ver_producto(this)" value="<?php echo $row_sub_productos["id"]; ?>" style="width:100%;">
												<b>VER <span class="fa fa-chevron-right"></span></b> 
											</button>
											
											<input name="product_price" value="<?php echo number_format($row_sub_productos["precio_venta"], 2, ".", "") ?>" type="hidden" />
											<input name="product_id" value="<?php echo $row_sub_productos["id"]; ?>" type="hidden" />
										</div>
									</div>
								</div>
								<div class="media-left">
									<img data-name="product_image" class="media-object" src="img/productos/<?php echo $row_sub_productos["id"]; ?>.jpg" alt="" style="width: 90px; height: 90px;">
								</div>
								<div class="media-body">
								<h4 class="media-heading" data-name="product_name"><b><?php echo $row_sub_productos["nombre_producto"]; ?></b></h4>
									
								<h5 class="media-heading" data-name="product_name"><font color="gray"><?php echo $row_sub_productos["desc_producto"]; ?></font></h5>
								<img src="/img/p1.png" width="24px" height="auto"/>
								<img src="/img/p2.png" width="24px" height="auto"/>
								<img src="/img/p8.png" width="24px" height="auto"/>
									
								</div>
							</div>
						<!-- FIN INFORMACION PRODUCTO -->
						<hr>
								<?php
							}
							}
						} // FIN - WHILE subcategorias
					} // FIN - Si tiene subcategorias se recorren las subcategorias asociadas
				?>
				
				<?php } // Fin de while categorias ?>
				<?php } // Fin de if categorias ?>
				
				
				<?php
					// Consulta de categorias
					$query_categorias_footer = "SELECT * FROM categoria where id_padre = 0 and estado_logico = 'A'";
					$categorias_footer = $conex->query($query_categorias_footer);
				?>
				<?php if ($categorias_footer->num_rows > 0) { ?>
				<div class="list-group">
				<center>
					<a href="#" class="list-group-item active">Todos</a>
					<?php while($row = $categorias_footer->fetch_assoc()) { ?>
					<a href="#<?php echo $row["href"]; ?>" class="list-group-item "><?php echo $row["descripcion"]; ?></a>
					<?php } ?>
				</center>
				</div>
				<?php } ?>
			</div>
			<!-- FIN PRODUCTOS -->
			
			
<?php include 'includes/sidebar.php';?>
			
			
<?php include 'includes/formulario_contacto.php';?>
			</div>
			</center>
		</div> <!-- FIN DIV SABORES -->
</div>
</div> <!-- FIN DIV TAB CONTENT -->
<?php include 'includes/modal_carrito.php';?>
<?php include 'includes/modal_carrito.php';?>
<?php include 'includes/modal_ver_producto.php';?>
<?php include 'includes/footer.php';?>