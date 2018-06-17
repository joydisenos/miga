<?php require_once("librerias/cargar_librerias.php"); ?>
<?php
	// Consulta de productos
	$query_productos = "SELECT * FROM producto where estado_logico = 'A'";
	$productos = $conex->query($query_productos);

	// Consulta de costo de envio
	$query_configuraciones = "SELECT * FROM configuraciones where estado_logico = 'A'";
	$configuraciones = $conex->query($query_configuraciones);
?>
<?php
	include("horas/horas.php");
	$class= new h();
?>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 0);

if ($productos->num_rows > 0) { 
	$listaProductos = array();
	while($row = $productos->fetch_assoc()) {
		$listaProductos_while = array($row["id"] => $row["nombre_producto"]);
		$listaProductos = $listaProductos + $listaProductos_while;
	}
}

$costo_envio = 0;
$descuento_promo = 0;
$monto_para_promo = 0;

if ($configuraciones->num_rows > 0) {
	while($row = $configuraciones->fetch_assoc()) {
		if($row["id"] == 1) {
			$costo_envio = $row["valor"];
		}

		if($row["id"] == 5) {
			$descuento_promo = $row["valor"];
		}

		if($row["id"] == 6) {
			$monto_para_promo = $row["valor"];
		}
	}
}

// Get the results as JSON string
$product_list = filter_input(INPUT_POST, 'cart_list');
// Convert JSON to array
$product_list_array = json_decode($product_list);

$result_html = '';
$totales=array();
$precioEnvio = $costo_envio;
$costo=0;

foreach($product_list_array as $p){
	$product_quantity = $p->product_quantity;
	$product_price = $p->product_price;
	$product_id = $p->product_id;
	$mult=$product_quantity * $product_price;
	array_push($totales, $mult);
}

function amoneda($numero, $moneda){
	$longitud = strlen($numero);
	$punto = substr($numero, -1,1);
	$punto2 = substr($numero, 0,1);
	$separador = ".";

	if($punto == ".") {
		$numero = substr($numero, 0,$longitud-1);
		$longitud = strlen($numero);
	}

	if($punto2 == ".") {
		$numero = "0".$numero;
		$longitud = strlen($numero);
	}

	$num_entero = strpos ($numero, $separador);
	$centavos = substr ($numero, ($num_entero));
	$l_cent = strlen($centavos);
	if($l_cent == 2){$centavos = $centavos."0";}
	elseif($l_cent == 3){$centavos = $centavos;}
	elseif($l_cent > 3){$centavos = substr($centavos, 0,3);}
	$entero = substr($numero, -$longitud,$longitud-$l_cent);

	if(!$num_entero) {
	    $num_entero = $longitud;
	    $centavos = "";
	    $entero = substr($numero, -$longitud,$longitud);
	}

	$start = floor($num_entero/3);
	$res = $num_entero-($start*3);
	if($res == 0){
		$coma = $start-1; 
		$init = 0;
	} else {
		$coma = $start; 
		$init = 3-$res;
	}

	$d= $init; 
	$i = 0; 
	$c = $coma;
	$final = null;
	$sep="";

	while($i <= $num_entero) {
		if($d == 3 && $c > 0) {
			$d = 0; 
			$sep = ""; 
			$c = $c-1;
		} else {
			$sep = "";
		}

		$final .=  $sep.$entero[$i];
		$i = $i+1; // todos los digitos
		$d = $d+1; // poner las comas
	}

	if($moneda == "pesos") {
		$moneda = "";
		return $moneda." ".$final.$centavos;
	}

	elseif($moneda == "dolares") {
		$moneda = "";//"USD";
		return $moneda." ".$final.$centavos;
	}

	elseif($moneda == "euros") {
		$moneda = "EUR";
		return $final.$centavos." ".$moneda;
	}
}

// Calculamos los montos para mostrar
$total_sin_envio = array_sum($totales);
$hay_promo = false;
$total_con_descuento_promo = $total_sin_envio;

if($total_sin_envio >= $monto_para_promo) {
	$hay_promo = true;
	$monto_para_descontar = $total_sin_envio * $descuento_promo / 100;
	$total_con_descuento_promo = $total_sin_envio - $monto_para_descontar;
}


$costo = $total_sin_envio + $precioEnvio;
$costo_promo = $total_con_descuento_promo + $precioEnvio;
$total_con_envio = $costo;
$costo = amoneda($costo , "pesos");
$costo_promo = amoneda($costo_promo , "pesos");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sondemiga.com | Fábrica de Sandwiches de miga en Azul</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="favicon.png" type="image/png">

	<script type="text/javascript" src="jquery.js"></script>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Encode Sans Condensed' rel='stylesheet'>
	<style>
		body {
			font-family: 'Encode Sans Condensed';font-size: 14px;
		}
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<form method="POST" action="envioMail.php" autocomplete="on" class="form-horizontal" role="form">
		<input type="hidden" value="form_data" name="formulario_datos">
		<br>
		<center>	
		
		<img src="logo.svg" width="250px" height="auto"/><br>
		<img src="img/p8.png" width="30px" height="auto"/>
		<img src="img/p1.png" width="30px" height="auto"/>
		<img src="img/p2.png" width="30px" height="auto"/>
		<img src="img/p3.png" width="30px" height="auto"/>
		<img src="img/p4.png" width="30px" height="auto"/>
		<img src="img/p5.png" width="30px" height="auto"/>
		<img src="img/p7.png" width="30px" height="auto"/>
		</center>
		<div class="col-md-12">
		<hr>
		<h4><font color="green"><b>¡Genial!</b></font> Último Paso: ¡Finalizá tu pedido!</h4>
			<b>Sondemiga.com</b>
			<p><b>Subtotal:</b> 
			<span class="sc-cart-summary-subtotal" style="float:right;"> 
						<span class="sc-cart-subtotal">$<span id="Display2"><?php print $total_sin_envio; ?> </span></span>
			</span><br>
			<?php if($hay_promo) { ?>
			<b>Descuento:</b> 
			<span class="sc-cart-summary-subtotal" style="float:right;"> 
						<span class="sc-cart-subtotal">$<span id="Display2"><?php print $monto_para_descontar; ?> </span></span>
			</span><br>
			<?php } ?>
			<b>Delivery:</b> 
			<span class="sc-cart-summary-subtotal" style="float:right;"> 
						<span class="sc-cart-subtotal">$<span id="Display2"><?php print $costo_envio; ?> </span></span>
			</span><br>
			<b>Total a abonar:</b> 
			<span class="sc-cart-summary-subtotal" style="float:right;"> 
						<span class="sc-cart-subtotal">$<span id="Display2"><?php print $costo_promo; ?> </span></span>
			</span>
			</p>
			
			<hr>
			</div>
			
		
		<div class="col-md-8">
			
			<div class="panel panel-default">
			<div class="panel-heading">	<h4><b><i class="fa fa-motorcycle" aria-hidden="true"></i> Datos de envio</b></h4>
			</div>
			<div class="panel-body">
			<!--<form class="form-horizontal" role="form" action="promociones/promomail.php" method="POST" id="contacto">-->
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user"></i></span>
				<input type="text" class="form-control" name="name" id="name" placeholder="Ingrese su nombre" required="required">
			</div>
			<br>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
				<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Domicilio" required="required">
			</div>
			<br>
			<div class="input-group">
				<span class="input-group-addon">(0)</span>
				<input type="tel" class="form-control" id="codigo_area" name="codigo_area" placeholder="Codigo de Area sin 0 - Ejemplo 2281" required="required"><!---->
			</div>
			<small>Ingresar el codigo de área sin el "0"</small>
			<br>
			<div class="input-group">
			<span class="input-group-addon"><b>15</b></span>
				<input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Sin 15 ej: 318667" required="required"><!---->
			</div>
			<small>Ingresar teléfono celular sin el 15 - Este será tu usuario para conocer los puntos acumulados y canjearlos por premios!</small>
			<br>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email (Opcional)">
			</div>
			<small>Si tienes email recibirás una copia de tu pedido</small>
			</div>
			</div>
			
	<div class="panel panel-default">
			<div class="panel-heading">	<h4><b> Medios de Pago</b></h4>
			</div>
			<div class="panel-body">
			
	<table class="table table-hover">
    <div class="form-group">
    <tbody>
      <tr>
        <td>
		<div class="radio">
			<label>
				<input type="radio" name="pago" id="pago" checked="checked" value="Efectivo"> <b>Pago Contado</b> <img src="../cash.png" alt="" height="20"> <br><small>(Abonar en efectivo)</small>
			</label>
		</div>
		
		</td>
       
      </tr>
      <tr>
        <td>
		<div class="radio">
			<label>
				<input type="radio" name="pago" id="pago" value="tarjeta"> <b>Tarjeta de Crédito / Débito Online - <font color="green">¡Pagá en cuotas!</font></b> 
				<br>
				<img src="img/p1.png" alt="" height="20">
					<img src="img/p2.png" alt="" height="20">
					<img src="img/p3.png" alt="" height="20">
					<img src="img/p4.png" alt="" height="20">
					<img src="img/p5.png" alt="" height="20">
					<img src="img/p7.png" alt="" height="20">
					<img src="img/p8.png" alt="" height="20"><br> <small>(A través de Mercado Pago)</small>
			</label>
		</div>
		</td>
        
      </tr>
      <tr>
        <td>
		<div class="radio">
			<label>
				<input type="radio" name="pago" id="pago" value="tarjeta al delivery"> <b>Tarjeta de Crédito / Débito al delivery</b> <br><small>(A través de Point Mercado Pago)</small>
			</label>
		</div>
		</td>
        
      </tr>
    </tbody></div>
  </table>
  			</div>
			</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">	<h4><b><i class="fa fa-clock-o" aria-hidden="true"></i> Hora de entrega</b></h4>
			</div>
			<div class="panel-body">
	
	
				<div class="form-group">
					<div class="col-lg-10">
						<select class="form-control" name="fecha" id="fecha" name="fecha">
							<option value="Hoy" selected>- SELECCIONE DIA -</option>
							<option value="Lunes">Lunes</option>
							<option value="Martes">Martes</option>
							<option value="Miercoles">Miercoles</option>
							<option value="Jueves">Jueves</option>
							<option value="Viernes">Viernes</option>
							<option value="Sabado">Sábado</option>
							<option value="Domingo">Domingo</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-10">
						<select class="form-control" name="horario" id="horario" name="horario">
							<option value="Sin Seleccionar" selected>- SELECCIONE HORA -</option>
							<option value="Hora-Man" disabled="disabled">Horario de Mañana</option>
							<option value="09:30 y 10:00">Entre 09:30 y 10:00 hs</option>
							<option value="10:00 y 10:30">Entre 10:00 y 10:30 hs</option>
							<option value="10:30 y 11:00">Entre 10:30 y 11:00 hs</option>
							<option value="11:00 y 11:30">Entre 11:00 y 11:30 hs</option>
							<option value="11:30 y 12:00">Entre 11:30 y 12:00 hs</option>
							<option value="12:00 y 12:30">Entre 12:00 y 12:30 hs</option>
							<option value="12:30 y 13:00">Entre 12:30 y 13:00 hs</option>
							<option value="13:00 y 13:30">Entre 13:00 y 13:30 hs</option>
							
							<option value="Hora-Tarde" disabled="disabled">Horario de Tarde</option>
							<option value="18:30 y 19:00" disabled="disabled">Entre 18:30 y 19:00 hs</option>
							<option value="19:00 y 19:30" disabled="disabled">Entre 19:00 y 19:30 hs</option>
							<option value="19:30 y 20:00" disabled="disabled">Entre 19:30 y 20:00 hs</option>
							<option value="20:00 y 20:30" disabled="disabled">Entre 20:00 y 20:30 hs</option>
							<option value="20:30 y 21:00" disabled="disabled">Entre 20:30 y 21:00 hs</option>
							<option value="21:00 y 21:30" disabled="disabled">Entre 21:00 y 21:30 hs</option>
							<option value="21:30 y 22:00" disabled="disabled">Entre 21:30 y 22:00 hs</option>
							<option value="22:00 y 22:30" disabled="disabled">Entre 22:00 y 22:30 hs</option>
							<option value="otro dia y horario">Otro dia y horario</option>
						</select>
						<small>Si desea recibir su pedido en otro horario, especifiquelo en el recuadro de abajo</small>
					</div>
				</div>
				<div class="form-group hidden">
					<div class="col-lg-10">
						<div class="well">
							<label class="radio-inline">
							<input type="radio" name="cantenvio" class="cantenvio" id="cantenvio" value="1" checked><b>Envio a domicilio:</b> $<?php echo $costo_envio; ?></label>
							<input type="hidden" name="precio_envio" value="<?=$costo_envio?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-10">
						<textarea class="form-control" name="comentario" rows="5" id="comentario" placeholder="Detalles adicionales Ejemplo: Garage verde, Esquina, etc."></textarea>
					</div>
				</div>
				
				<div class="input-group hidden">
					<span class="input-group-addon"><i class="fa fa-tags"></i></span>
					<input type="text" class="form-control" name="cupon" id="cupon" placeholder="Tenés un cupón descuento? usalo acá">
				</div>
				<small class="hidden">Descuento aplicable únicamente a pagos en efectivo, no válido para pago con tarjeta</small>
				<br><br>
				</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
					<button type="submit" name="enviar" class="btn btn-success btn-lg" style="width:100%;"><b>Hacer Pedido!</b></button>
				</div>
				
				<?php if($hay_promo) { ?>
				<input type="hidden" name="total_sin_descuento" value="<?=$total_sin_envio?>">
				<input type="hidden" name="total_sin_envio" value="<?=$total_con_descuento_promo?>">
				<input type="hidden" name="total_con_envio" value="<?=$costo_promo?>">
				<input type="hidden" name="total_descuento" value="<?=$monto_para_descontar?>">
				<?php } else { ?>
				<input type="hidden" name="total_sin_descuento" value="<?=$total_sin_envio?>">
				<input type="hidden" name="total_sin_envio" value="<?=$total_sin_envio?>">
				<input type="hidden" name="total_con_envio" value="<?=$total_con_envio?>">
				<input type="hidden" name="total_descuento" value="0">
				<?php } ?>
			</div>
		</div>
		
		<div class="col-md-4 hidden-xs">
		<center>
		<h3>SU PEDIDO</h3>
		<?php
$inputsInfPro = "";
foreach($product_list_array as $p){
  $product_id = $p->product_id;
  $product_cantidad = $p->product_quantity;
  $product_precio = $p->product_price;

  foreach ($listaProductos as $key => $value) {
    $nomprod=$value;
    if($key == $product_id){
      $inputsInfPro .= '<input type="hidden" value="'.$product_id.'$'.$nomprod.'@'.$product_cantidad.'|'.$product_precio.'" name="productos[]">';      
	echo '<center>';
	echo '<b>', $product_cantidad, '</b>', ' x ', $nomprod, '<br>';
	echo '</center>';
	
	}
  }
}
echo '<center>';
echo '-------<br>';
echo '<b>Delivery:</b> $', $precioEnvio;
echo '</center>';
echo $inputsInfPro;
?>

<center>
<font color="red"><h4>
<?php if($hay_promo) { ?>
<span class="label label-primary">Total a Pagar (Descuento aplicado) $<span id="Display2"><?php print $costo_promo; ?></span></span><br><br>
<input type="hidden" value="<?php print $costo_promo; ?>" name="totalApagar">
<?php } else { ?>
<span class="label label-primary">Total a Pagar $<span id="Display2"><?php print $costo; ?></span></span><br><br>
<input type="hidden" value="<?php print $costo; ?>" name="totalApagar">
<?php } ?>

</h4></font>

</center>
		</center>
		</div>
	</form>
</body>
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript  -->
<script src="js/bootstrap.min.js"></script>
    <script src="js/sweetAlert.js"></script>
    <link rel="stylesheet" href="js/sweetalert.css">
<script>
      <?php
              if($class->openYN() === 1){} else { 
                ?>
swal({
  title: "Atencion",
  text: "Sondemiga esta cerrado en este momento, ¿desea pedir para despues?",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "No, gracias",
  cancelButtonClass: "btn-success",
  cancelButtonText: "Si, continuar",
  closeOnConfirm: false
},
function(){
  //lo mando a index
  location.href='index.php';
});
<?php
              }
              ?>
</script>
</html>
<?php 
mysqli_free_result($productos);
?>