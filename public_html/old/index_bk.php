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

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="og:title" content="Sondemiga.com - Fábrica de Sandwiches de Azul | La mejor forma de pedir sandwiches de miga en Azul" />
	<meta name="og:type" content="website" />
	<meta name="og:url" content=" https://www.sondemiga.com/" />
	<meta name="og:image" content= "https://sondemiga.com/promociones/promociones.jpg" />
	<meta name="og:description" content="La mejor forma de pedir sandwiches de miga Online en Azul - Hacé tu pedido online, recibilos donde quieras! Sandwiches de miga | Promociones todos los dias!" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="Sandwiches de miga en azul, sondemiga, sandwich en azul, sandwicheria en azul, sandwicheria, sandwich de miga, migas en azul, miga en azul, sandwiches de miga, sandwichs de miga en azul, sandwich azul, sondemiga, son de miga, son de miga azul, sondemiga.com, sondemiga azul, sonde miga, fabrica de sandwiches, fabrica de sandwich">
	<meta name="description" content="La mejor forma de pedir sandwiches de miga Online en Azul - Hacé tu pedido online, recibilos donde quieras! Sandwiches de miga | Promociones todos los dias!">
	<meta name="author" content="Sondemiga.com">
	<!-- Chrome, Firefox OS y Opera -->
	<meta name="theme-color" content="#ffffff"/>
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#ffffff"/>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="favicon.png" type="image/png">
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
	<style>
	body {
		font-family: 'Acme';font-size: 15px;
	}
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Custom CSS -->
	<link href="css/shop-homepage2.css" rel="stylesheet">

	<title>Sondemiga.com - Fábrica de Sandwiches de Azul | La mejor forma de pedir sandwiches de miga en Azul</title>


	<script type="text/javascript" src="jquery.js"></script>
	<!--<script type="text/javascript" src="https://sondemiga.com/jquery.js"></script>--> 

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


	<!-- GOOGLE ANALITYCS -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-89507940-1', 'auto');
		ga('send', 'pageview');
	</script>
	
	<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4sVatI9wnMeDxeZbXs665I4wckvm7FKi";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
 $zopim(function() {
	$zopim.livechat.window.setOffsetVertical(50);
  });
</script>
<!--End of Zendesk Chat Script-->
<script type="text/javascript"> 
var ua = navigator.userAgent.toLowerCase(), 
platform = navigator.platform.toLowerCase(); 
var url=window.location.href;
platformName = ua.match(/ip(?:ad|od|hone)/) ? 'ios' : (ua.match(/(?:webos|android)/) || platform.match(/mac|win|linux/) || ['other'])[0], 
isMobile = /ios|android|webos/.test(platformName); 
if (isMobile && url!="www.sondemiga.com") { 
$zopim(function(){ 
$zopim.livechat.hideAll(); 
$zopim.livechat.setOnChatStart(function(){
$zopim.livechat.setOnUnreadMsgs(unread);
function unread(number) {
if (number>0){
$zopim.livechat.window.show();
} 
}
}); 
});
} 
</script>



<!-- codigo plugin de jquery Smart Cart -->
<!-- Include SmartCart CSS -->
<link href="css/smart_cart.min.css" rel="stylesheet" type="text/css" />
<style>
.modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 100%;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}
	
	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}

/*Left*/
	.modal.left.fade .modal-dialog{
		left: -320px;
		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, left 0.3s ease-out;
		        transition: opacity 0.3s linear, left 0.3s ease-out;
	}
	
	.modal.left.fade.in .modal-dialog{
		left: 0;
	}
        
/*Right*/
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

/* ----- MODAL STYLE ----- */
	.modal-content {
		border-radius: 0;
		border: none;
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
		background-color: #FAFAFA;
	}

.demo {
	padding-top: 60px;
	padding-bottom: 110px;
}

.btn-demo {
	margin: 15px;
	padding: 10px 15px;
	border-radius: 0;
	font-size: 16px;
	background-color: #FFFFFF;
}

.btn-demo:focus {
	outline: 0;
}

.demo-footer {
	position: fixed;
	bottom: 0;
	width: 100%;
	padding: 15px;
	background-color: #212121;
	text-align: center;
}

.demo-footer > a {
	text-decoration: none;
	font-weight: bold;
	font-size: 16px;
	color: #fff;
}
</style>
<style type="text/css">
	.caption{
		height: inherit;
	}
	.caption:hover{
		height: inherit;
		background-color: aliceblue;
	}
</style>

<style>
.card {
	box-shadow: 1px 4px 8px 1px rgba(0,0,0,0.2);
    width: 100%;
    padding: 10px 0px 0px 0px;
    margin-bottom: 14px;
}
</style>

<style>
.tab-content {
border-radius: 0 !important;

border-bottom:0px;
}
.nav-tabs {
	width: 100% !important; 
	height: 65px;
	font-size: 16px;
	text-transform: uppercase;
	background: #da251c; 
	color: white;
	border-bottom: 0px;
	border-top: 1px solid #ddd;
	position: fixed;
	bottom: 0;
	z-index: 9999;
	text-align: center;
}

.nav-tabs p {
	font-size: 12px;
}


.nav-tabs > li {
	width: 50% !important;
	margin-bottom:0;
	margin-top:-1px;
}

.nav-tabs > li > a {
	color: white;
	padding-top: 10px;
	padding-bottom: 8px;
	border: 1px solid transparent;
}


.nav-tabs > li > a:hover {
	color: #444;
	background: transparent;
	border: none !important; 
}
.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus {
	color: red;
	cursor: default;
	border: 1px solid #ddd;
	height: 65px;
	border-radius: 0 !important;
}
</style>
<style>
	.img-texto {
		position: relative;
	}
	.img-texto span {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		z-index: 999;
		background: rgba(238, 115, 154, 0.68);
		padding: 0px;
		color: #fff;
		font-family: sans-serif;
	}
	.texto-i {
		right: inherit !important;
		left: 0;
	}
	.texto-d {
		right: 0;
		left: inherit !important;
	}
</style>

<script>

(function($) {
this.randomtip = function(){
	var length = $("#tips li").length;
	var ran = Math.floor(Math.random()*length) + 1;
	$("#tips li:nth-child(" + ran + ")").show();
};

$(document).ready(function(){
	randomtip();
});
})( jQuery );


</script>

</head>

<body>
<!-- SCRIPT MODAL OPEN SOLO -->
<script type="text/javascript">
        
        $(document).ready(function() {
        
            $(window).load(function(){
   setTimeout(function(){
       $('#myModal').modal('show');
   }, 5000);
});
        
        });
        
        </script>




		<div class="modal fade success-popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Gracias por tu <font color="red"><b>visita!</b></font></h4>
      </div>
      <div class="modal-body text-center">
         <img src="https://www.sondemiga.com/logo.svg" width="200px" height="auto">
		 <p class="lead">Comparti buenos momentos, disfruta el día con unos ricos sandwiches de miga!<br><br><b>
		 <font color="red">¡ENVIO SIN CARGO EN TU PEDIDO!</font> <br>
		 <font color="green">10% DESCUENTO con tu compra de $600 o más!</font></b></p>
		 <small>Promociones todos los días! explorá en ésta página todos los sabores y promociones disponibles! <b>¿Es tu cumpleaños?</b> tenemos lo que necesitás aquí!<br>*El descuento se aplica automaticamente al llegar o superar el monto de $600, válido únicamente para pedidos desde la web. </small><br><br>
      </div>
      <div class="modal-footer">
	  <a data-dismiss="modal" aria-label="Close" class="rd_more btn btn-default">Volver a la pagina</a>
	  </div>
    </div>
  </div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div style="text-align: left; margin-left: 7px; margin-top: 13px;" class="">
			<img src="logo.svg" style="width: 150px" alt="">
			
	</div>
	
	<div>
		<ul class="nav navbar-nav hidden-xs">
			<li><a href="#promo">Promociones</a></li>
			<li><a href="#cumple">Cumpleaños</a></li>
			<li><a href="#Sabores">Sabores Triples Grandes</a></li>
			<li><a href="/kioscos.php" target="_blank">Kioscos</a></li>
			<li><a href="/inflables.php" target="_blank"><font color="yellow">ALQUILER DE INFLABLES</font></a></li>
			<li><a data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-shopping-cart"></span> Mi Pedido <span class="sc-cart-summary-subtotal"> 
					<font color="yellow"><span id="subtotal_carrito" class="sc-cart-subtotal">$0.00</span></font>
					</span></a></li>
		</ul>
	</div>
	
	<div>
		<ul class="list-inline visible-xs" style="padding-left:5px;padding-top:5px;text-align:center;">
			<li><a href="#promo"><font color="white">Promociones</font></a></li>
			<li><a href="#cumple"><font color="yellow">Cumpleaños</font></a></li>
			<li><a href="/inflables.php" target="_blank"><font color="white">Inflables</font></a></li>
			<li style="float:right;margin-right:10px;"><a data-toggle="modal" data-target="#exampleModal"><font color="white"><span class="glyphicon glyphicon-shopping-cart"></span></font></a></li>
			
		</ul>
	</div>
	
	<div style=" position: fixed; right: 5px;top:2px; " class="hidden-xs">
	<button class="btn btn-danger btn-lg" type="button" data-toggle="modal" data-target="#exampleModal">	
	<font color="white">
				<span class="glyphicon glyphicon-shopping-cart"></span>
					<b><span class="sc-cart-summary-subtotal"> 
					<font color="yellow"><span id="subtotal_carrito" class="sc-cart-subtotal">$0.00</span></font>
					</span>
				<small><font color="white">ver pedido</font></small></b>
			</font>
	</button>
	</div>
</nav>

<!-- Navigation -->
<nav class="navbar navbar-inverse2 navbar-fixed-bottom visible-xs" role="navigation">
	<div style="text-align: center; margin-left: 0px; margin-top: 0px;" class="">
			<button class="btn btn-danger btn-lg" type="button" style="width:100%" data-toggle="modal" data-target="#exampleModal">	
	<font color="white">
				VER MI PEDIDO ( <span class="glyphicon glyphicon-shopping-cart"></span>
					<span class="sc-cart-summary-subtotal"> 
					<font color="white"><span id="subtotal_carrito" class="sc-cart-subtotal">$0.00</span></font>
					</span>)
			</font>
	</button>
	</div>
	
</nav>


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
			<br>		
			<center>
			<span id='bodyC'>
						<?php echo $class->returnDisplay(); ?>
					</span>
			</center>
			
			<center>
				<p>Tamaños | Promo: Triangular o 12cm x 6cm | Clásico: 12cm x 8cm | Lunch: 8cm x 8cm | Copetín: 6cm x 6cm |</p>
			</center>
			<marquee> <img src="/img/p1.png" height="32px"/> <img src="/img/p2.png" height="32px"/> <img src="/img/p3.png" height="32px"/> <img src="/img/p4.png" height="32px"/> <img src="/img/p5.png" height="32px"/> <img src="/img/p6.png" height="32px"/> <img src="/img/p7.png" height="32px"/> <img src="/img/p8.png" height="32px"/> ¡Aceptamos tarjetas de crédito/débito! - <font color="green">Tarjetas de crédito aceptadas:</font> Visa - Mastercard - American Express - Naranja - Nativa - Tarjeta Shopping - Tarjeta cencosud - Cabal - Diners Club International- Argencard - Cordial - Cordobesa - Patagonia (Mercadopago) - <font color="green">Tarjetas de débito aceptadas:</font>  Visa - Mastercard - Maestro - Cabal debito | Sonde<font color="red">miga</font>.com - La mejor forma de pedir sandwiches de miga a domicilio</marquee>
			<br>
			<center class="visible-xs">
			<a href="https://www.facebook.com/sondemiga" target="_blank" class="btn btn-primary active"><i class="fa fa-facebook"></i> Seguinos en Facebook</a>
			<a href="https://www.instagram.com/sondemiga" target="_blank" class="btn btn-warning active"><i class="fa fa-instagram"></i> Seguinos en Instagram</a>
			<br>
			</center>
			
			<div class="col-md-12">
				<hr>
				<div class="col-md-4 col-sm-4 text-center col-xs-4">
					<div class="text-center">
						<h1><font color="green"><i class="fa fa-truck"></i></font></h1>
					</div>
					<div class="text-center">
						<h4><b>Envíos a domicilio</b></h4>
						<p>Recibí tu pedido a domicilio</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 text-center col-xs-4">
					<div class="text-center">
						<h1><font color="green"><i class="fa fa-credit-card"></i></font></h1>
					</div>
					<div class="text-center">
						<h4><b>Tarjetas de Crédito</b></h4>
						<p>Formas de pago online</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 text-center col-xs-4">
					<div class="text-center">
						<h1><font color="red"><i class="fa fa-phone"></i></font></h1>
					</div>
					<div class="text-center">
						<h4><b>Evitá líneas ocupadas</b></h4>
						<p>Pedí online, fácil y seguro</p>
					</div>
				</div>
				<div class="clearfix"></div>
				<center>
					<img src="img/p1.png" alt="" height="20">
					<img src="img/p2.png" alt="" height="20">
					<img src="img/p3.png" alt="" height="20">
					<img src="img/p4.png" alt="" height="20">
					<img src="img/p5.png" alt="" height="20">
					<img src="img/p6.png" alt="" height="20">
					<img src="img/p7.png" alt="" height="20">
					<img src="img/p8.png" alt="" height="20">
				</center>
			</div>
			<br>

			<!-- Contenido -->
			<div class="col-md-3">
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
			<div class="col-md-9">
				<?php 
				// Consulta de categorias
				$query_categorias_productos = "SELECT * FROM categoria where id_padre = 0 and estado_logico = 'A'";
				$categorias_productos = $conex->query($query_categorias_productos);
				?>
				<?php if ($categorias_productos->num_rows > 0) { // if de categorias principales ?>
				<?php while($row_categorias = $categorias_productos->fetch_assoc()) { ?>
				<!-- Categorias -->
				<a name="<?php echo $row_categorias["href"];?>"></a>
				<div class="clearfix"></div>
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
						<div class="col-md-4 col-xs-12">
						<div class="card">
							<div class="sc-product-item" id="sc_product_item_<?php echo $row_productos["id"]; ?>">
								<div class="media-body">
								<center>
								<img data-name="product_image" class="media-object" src="img/productos/<?php echo $row_productos["id"]; ?>.jpg" alt="" style="width:75%; height:auto;">
								<br>
									<h3 class="media-heading" data-name="product_name"><?php echo $row_productos["nombre_producto"]; ?></h3><h4><span class="label label-success"><font color="white"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Disponible + ENVIO GRATIS</font></span></h4>
									<p class="list-group-item-text" data-name="product_desc"><?php echo $row_productos["desc_producto"]; ?></p>

									<?php
									if($row_productos["disponible"] == 1) {
									?>
									<h4><?php echo '$' . number_format($row_productos["precio_venta"], 2, ".", "") ?></h4>
									</center>
									<div class="cart-action-btn-wrapper" style="width:100%;">
										<div class="item-wrapper" style="margin-right: 0px;">
											<button class="btn btn-danger btn-lg" <?php if($row_productos["disponible"] == 0){echo 'disabled';}?> OnClick="ver_producto(this)" value="<?php echo $row_productos["id"]; ?>" style="width:100%;">
												<b>VER PRODUCTO <span class="glyphicon glyphicon-circle-arrow-right"></span></b> 
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
								
									
								
							</div>
							
							</div>
							</div>
							
						<!-- FIN INFORMACION PRODUCTO -->
						
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
						<div class="col-md-4 col-xs-12">
						<div class="card">
							<div class="sc-product-item" id="sc_product_item_<?php echo $row_sub_productos["id"]; ?>">
									
								<div class="media-body">
								<center>
								<img data-name="product_image" class="media-object" src="img/productos/<?php echo $row_sub_productos["id"]; ?>.jpg" alt="" style="width:75%; height:auto;">
								<br>
								<h3 class="media-heading" data-name="product_name"><?php echo $row_sub_productos["nombre_producto"]; ?></h3><h4> <span class="label label-success"><font color="white"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Disponible + ENVIO GRATIS</font></span></h4>
									<p class="list-group-item-text" data-name="product_desc"><?php echo $row_sub_productos["desc_producto"]; ?></p>
									<?php
									if($row_sub_productos["disponible"] == 1) {
									?>
									
									<?php
									} else {
									?>
									<h4><span class="label label-danger"><font color="white"><i class="fa fa-hand-o-right" aria-hidden="true"></i> No Disponible</font></span></h4>
									<?php } ?>
									
									</center>
									<div class="cart-action-btn-wrapper" style="width:100%;">
										<div class="item-wrapper" style="margin-right: 0px;">
											
											<button class="btn btn-danger btn-lg" <?php if($row_sub_productos["disponible"] == 0){echo 'disabled';}?> OnClick="ver_producto(this)" value="<?php echo $row_sub_productos["id"]; ?>" style="width:100%;">
												<b>VER PRODUCTO <span class="glyphicon glyphicon-circle-arrow-right"></span></b> 
											</button>
											<input name="product_price" value="<?php echo number_format($row_sub_productos["precio_venta"], 2, ".", "") ?>" type="hidden" />
											<input name="product_id" value="<?php echo $row_sub_productos["id"]; ?>" type="hidden" />
										</div>
									</div>
									
								</div>
							</div>
							
							</div>
						</div>
						
						<!-- FIN INFORMACION PRODUCTO -->
								<?php
							}
							}
						} // FIN - WHILE subcategorias
					} // FIN - Si tiene subcategorias se recorren las subcategorias asociadas
				?>
				
				<?php } // Fin de while categorias ?>
				<?php } // Fin de if categorias ?>
				
				</div><!-- FIN DIV COL-MD-9 -->
				
				<hr>
				<center>
				<p class="visible-xs"><a href="https://api.whatsapp.com/send?phone=5492281318667&text=Hola! Quiero hacer un pedido de sandwiches!" class="rd_more btn btn-success"  target="_blank"><b><img src="../whatsapp.png" width="32px" height="32px"/> Enviar Whatsapp!</b></a></p>
			
			
			
			<h3>Formulario de Contacto</h3>
			 <form method="POST" action="contactoprincipal.php" autocomplete="on" class="form-horizontal" role="form">

	<input type="hidden" value="form_data" name="contacto">

	<hr>

	

	<div class="col-md-12">

  

  <div class="input-group">

    <span class="input-group-addon">Nombre</span>

    <input id="nombre" type="text" class="form-control" name="nombre" placeholder="" required="required">

  </div>

  <br>

  

  <div class="input-group">

    <span class="input-group-addon">Email</span>

    <input id="email" type="email" class="form-control" name="email" placeholder="">

  </div>

  <br>

  

  <div class="input-group">

    <span class="input-group-addon">Telefono</span>

    <input id="telefono" type="tel" class="form-control" name="telefono" placeholder="" required="required">

  </div>

  <br>

  

  <div class="form-group">

    <div class="col-lg-10">

      <textarea class="form-control" name="consulta" rows="7" id="consulta" placeholder="Deje aqui su consulta."></textarea>

    </div>

  </div>

   

  <div class="form-group">

    <div class="col-xs-12">

      <button type="submit" name="enviar" class="btn btn-success" style="width:100%"><li class="fa fa-envelope"></li> <b>Enviar!</b></button>

    </div>
  </div>

    

	

</form>
</div>
			
			</center>
		</div> <!-- FIN DIV SABORES -->
</div>
</div> <!-- FIN DIV TAB CONTENT -->

	

<div class="col-md-12">
     <div class="container">
  
  <!-- Footer -->
  <footer>
  
  <!-- Modal CARRITO -->
<div class="modal right fade in" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		<h4 class="modal-title" id="exampleModalLabel"><b>Su carrito de compras</b></h4>
      </div>
      <div class="modal-body">
		<center><img src="https://www.sondemiga.com/logo.svg" class="visible-xs" width="200px" height="auto"></center>
		<br>
	    <!-- Cart submit form -->
				<form action="repcionProd.php" method="POST"> 
					<!-- SmartCart element -->
					<div id="smartcart"></div>
				</form>
			
		<p><b>Haga click en el botón <font color="green"><i class="fa fa-paper-plane" aria-hidden="true"></i> "Continuar"</font> para completar su pedido</b></p>
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Agregar más productos...</button>
	  </div>
    </div>
  </div>
</div>
  
  
  <div class="row">

  <hr>
	  <p><b>Sondemiga.com &copy; </b>Fábrica de Sandwiches en Azul | Tel.: 02281 15 31 8667</p>
	  <div class="hidden-xs">
	  <button type="button" class="btn btn-default" onclick="window.location.href='https://www.facebook.com/sondemiga/reviews';"><b><i class="fa fa-star" aria-hidden="true"></i> Calificanos</b></button>
	  <button type="button" class="btn btn-default" onclick="window.location.href='/presupuesto.php';"><b><i class="fa fa-money" aria-hidden="true"></i> Presupuestos</b></button>
	  <a href="tel:02281318667"><button type="button" class="btn btn-default"><b><i class="fa fa-phone" aria-hidden="true"></i> 02281 15 31 8667</b></button></a>
	  </div>
	  
	  <br>
      
    </div>
  </footer>
  </div>
</div>
<div id="modalVerProducto" class="modal right fade" role="dialog" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
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
						<h4 id="disponible_modal"><span class="label label-success"><font color="white"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Disponible</font></span> <span id="precio_modal" class="label label-danger"></span> <span class="label label-primary">ENVIO GRATIS</span></h4>
						<h4 id="no_disponible_modal"><span class="label label-danger"><font color="white"><i class="fa fa-hand-o-right" aria-hidden="true"></i> No Disponible</font></span></h4>
						<p id="descripcion_producto_modal" class="list-group-item-text" data-name="product_desc"></p><br>
						<div class="cart-action-btn-wrapper">
							<div class="item-wrapper">
								<h4><b>Seleccionar cantidad</b></h4>
								<div class="form-group2" style="margin-bottom: 33px;">
									<select class="sc-cart-item-qty" name="product_quantity" id="cantidad_modal"></select>
								</div>
								<button class="sc-add-to-cart btn btn-warning btn-lg" style="width:100%;margin-bottom: 10px;">
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
<!-- /.container -->
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Include SmartCart -->
<script src="js/jquery.smartCart.js" type="text/javascript"></script>

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

    $("#cantidad_modal").change(function(){
    	var precio_producto = $("#precio_hidden_modal").val();
    	var cantidad = $("#cantidad_modal").val();
    	var subtotal_pedido = parseFloat(precio_producto * cantidad).toFixed(2);
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
				$('select option').remove();

				var iter_cantidad = 1;
				var primera_cantidad = 1;
				$.each(cantidad_array,function(index,contenido){
					$('#cantidad_modal').append($('<option>', {
						value: contenido,
						text: contenido + ' ' + respuesta[0].cantidad_descripcion
					}));
					if(iter_cantidad == 1) {
						primera_cantidad = contenido;
					}
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

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>