<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

define ("URL_BASE" , "https://www.sondemiga.com");
define ("EMAIL" , "pedidos@sondemiga.com");
define ("URL_PAGO_EFECTIVO", "https://www.sondemiga.com/enviado.html");


/*Formulario de contacto HTML5, PHP Y Bootstraps
Creado por: www.render2web.com
Version: 1.1*/

require_once('php/mercadopago.php');
require_once("librerias/cargar_librerias.php");


$mp = new MP('1787728543868124', '6nXoG9IfPRwUL4BXWW2IDkweUSH40Hn6');

$baseUrl = URL_BASE;

if($_POST){
  if($_POST["formulario_datos"] == "form_data"){
		//Comprobamos que se haya presionado el boton enviar
		if(!isset($_POST['enviar'])){
			exit("Envío inválido");
		}
		// Consulta de cliente
		$query_cliente = "SELECT * FROM cliente where telefono = '" . $_POST['telefono'] . "' and codigo_area = '" . $_POST['codigo_area'] . "' LIMIT 1";
		$clientes = $conex->query($query_cliente);
		$existe_cliente = 0;
		$id_cliente = 0;
		$id_pedido = 0;
		if ($clientes->num_rows > 0) { 
			$existe_cliente = 1;
			while($row = $clientes->fetch_assoc()) {
				$id_cliente = $row["id"];
			}
		}

		$precEnvio = $_POST['precio_envio'];
		$name = $_POST['name'];
		$direccion = $_POST['direccion'];
		$codigo_area = $_POST['codigo_area'];
		$telefono = $_POST['telefono'];
		$email = $_POST['email'];
		$pago = $_POST['pago'];
		$cantenvio = $_POST['cantenvio'];
		$fecha = $_POST['fecha'];
		$horario = $_POST['horario'];
		$comentario = $_POST['comentario'];
		$cupon = $_POST['cupon'];
		$totalApagar = $_POST["totalApagar"];

		//Validamos del lado del servidor que el nombre y el telefono no estén vacios
		if($name == ''){
			exit("Debe ingresar su nombre");
		}

		if($telefono == ''){
			exit("Debe ingresar su telefono");
		}

		if($codigo_area == ''){
			exit("Debe ingresar el codigo de area");
		}

		// Chequeamos cantidad
		if($totalApagar == 0){
			exit("Debe seleccionar al menos 1 producto");
		}

		if($existe_cliente == 1) {
			$query_update_cliente = "UPDATE cliente SET nombre = '" . $_POST['name'] . "', email = '" . 
				$_POST['email'] . "', direccion = '" . $_POST['direccion'] . "' where telefono = '" . $_POST['telefono'] . "'";
			$clientes = $conex->query($query_update_cliente);
		} else {
			$query_insert_cliente = "INSERT INTO cliente (nombre, codigo_area, telefono, email, direccion, estado_logico, " . 
				"usuario_ingreso, fecha_ingreso) VALUES('". $_POST['name'] . "', '". $_POST['codigo_area'] . "', '". $_POST['telefono'] . "', '" .  $_POST['email'] . "', '" . $_POST['direccion'] . "', 'A', 1, '" . date('Y-m-d H:i:s') . "')";
			$clientes = $conex->query($query_insert_cliente);
			$id_cliente = mysqli_insert_id($conex);
		}

		if($id_cliente > 0) {
			$query_insert_pedido = "INSERT INTO pedidos (id_cliente, id_estado_pedido, numero_pedido, " . 
				"sub_total_pedido, total_envio, descuento_pedido, total_pedido, fecha_pedido, dia_pedido, " . 
				"hora_pedido, observaciones, ok_puntos_acumulados, tipo_pago, estado_logico, usuario_ingreso, fecha_ingreso) " . 
				"VALUES(". $id_cliente . ", 2, '0', '" . $_POST['total_sin_envio'] . "', '" . $_POST['precio_envio'] . 
				"', '0', '" . $_POST['total_con_envio'] . "', '" . date('Y-m-d H:i:s') . "', '" . $_POST['fecha'] . 
				"', '" . $_POST['horario'] . "', '" . $_POST['comentario'] . "', 0, '" . $_POST['pago'] . "', 'A', 1, '" . date('Y-m-d H:i:s') . "')";
			$pedido = $conex->query($query_insert_pedido);
			$id_pedido = mysqli_insert_id($conex);
		}

		$exploIdpro = null;
		$htmlProd = "";
		$SandwichesTotal=array();
		// Ejemplo de $value --> 12$Huevo y Queso@3|185.00
		foreach ($_POST["productos"] as $value) {
			$exploIdpro = explode("$", $value);
			$id_producto = $exploIdpro[0];

			$exploCantPrec = explode("@", $value);
			$exploNombreProd = explode("@", $exploIdpro[1]);
			$exploCantPro = explode("|", $exploCantPrec[1]);

			$nombre_producto = $exploNombreProd[0];
			$cant_producto = $exploCantPro[0];
			$precio_producto = $exploCantPro[1];
			$total_item = $precio_producto * $cant_producto;

			$htmlProd .= "
			<tr>
				<td align='left' bgcolor='#ffffff'><strong>".$nombre_producto." ($".$precio_producto.")</strong></td>
				<td align='left'>".$cant_producto."</td>
			</tr>
			";
			array_push($SandwichesTotal, $cant_producto);
			if($id_pedido > 0) {
				$query_insert_det_pedido = "INSERT INTO det_pedido (id_pedido, id_producto, descripcion, " . 
					"cantidad, precio_unitario, sub_total, descuento, total, estado_logico, usuario_ingreso, fecha_ingreso) " . 
					"VALUES(" . $id_pedido . ", " . $id_producto . ", '" . $nombre_producto . "', '" . $cant_producto .  "', " . 
					$precio_producto . ", '" . $total_item . "', 0, " . $total_item . ", 'A', 1, '" . date('Y-m-d H:i:s') . "')";
				$pedido = $conex->query($query_insert_det_pedido);
			}
		}
		$totalSandwiches = array_sum($SandwichesTotal);

		$para = "pedidos@sondemiga.com, $email";//Email al que se enviará
		$asunto = "Pedido Sondemiga.com";//Puedes cambiar el asunto del mensaje desde aqui
		//Este sería el cuerpo del mensaje

		$mensaje = "
			<html lang='es'>
			<head>
    		<meta charset='utf-8'>
    		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			</head>
    		<body>
			<table border='0' cellspacing='3' cellpadding='2'>
			<img src='https://sondemiga.com/logo.svg' width='200px' height='auto'/>
			<br>
			<small>Pedido realizado en Sondemiga.com <br>La mejor forma de pedir sandwich de miga a domicilio<br>Delivery 02281 15 318667</small>
			
			  <tr>
				<td align='left' bgcolor='#fe0000'><strong><font color='white'>::SABORES::</font></strong></td>
				<td align='left' bgcolor='#fe0000'></td>
			  </tr>

			  ".$htmlProd."

			  <tr>
				<td align='left' bgcolor='#fe000'><strong><font color='white'>::DATOS DELIVERY::</font></strong></td>
				<td align='left' bgcolor='#fe000'></td>
			  </tr>
			  <tr>
				<td align='left' bgcolor='#f0efef'><strong>Nombre:</strong></td>
				<td align='left' bgcolor='#f0efef'>".$name."</td>
			  </tr>
			  <tr>
				<td align='left' bgcolor='#4CAB4F'><strong>Direccion:</strong></td>
				<td align='left' bgcolor='#4CAB4F'><font color='white'>".$direccion."</font></td>
			  </tr>
			  <tr>
				<td align='left' bgcolor='#f0efef'><strong>Telefono:</strong></td>
				<td align='left' bgcolor='#f0efef'>".$telefono."</td>
			  </tr>
			   <tr>
				<td align='left' bgcolor='#ffffff'><strong>Email:</strong></td>
				<td align='left'>".$email."</td>
			  </tr>
			  <tr>
				<td align='left' bgcolor='#fe000'><strong><font color='white'>Pago:</font></strong></td>
				<td align='left' bgcolor='#fe000'><font color='white'>".$pago."</font></td>
			  </tr>
			  <tr>
				<td align='left' bgcolor='#f0efef'><strong>Envio:</strong></td>
				<td align='left' bgcolor='#f0efef'>".$precEnvio."</td>
			  </tr>
			  <tr>
				<td align='left' bgcolor='#ffffff'><strong>Fecha:</strong></td>
				<td align='left'>".$fecha."</td>
			  </tr>
			  <tr>
				<td align='left' bgcolor='#ffffff'><strong>Horario:</strong></td>
				<td align='left'>".$horario."</td>
			  </tr>
			
			  <tr>
				<td align='left' bgcolor='#f0efef'><strong>Comentario:</strong></td>
				<td align='left' bgcolor='#f0efef'>".$comentario."</td>
			  </tr>			  			  <tr>				<td align='left' bgcolor='#ffffff'><strong>Cupon:</strong></td>				<td align='left' bgcolor='#ffffff'>".$cupon."</td>			  </tr>
			  <tr>
				<td align='left' bgcolor='#fe000'><strong><font color='white'>::TOTAL A PAGAR::</font></strong></td>
				<td align='left' bgcolor='#fe000'></td>
			  </tr>
			  <tr>
			  	<td align='left' bgcolor='#f0efef'><strong>Sandwiches pedidos:</strong></td>
				<td align='left'>".$totalSandwiches."</td>
			  </tr>
			  <tr>
			  	<td align='left' bgcolor='#4CAB4F'><strong>Total a pagar:</strong></td>
				<td align='left' bgcolor='#4CAB4F'><font color='white'>$".$totalApagar."</font></td>
			  </tr>
		</table>
		
		</body>
		</html>	
		";

		//Cabeceras del correo
		$headers = "From: $name - Sondemiga <pedidos@sondemiga.com> \r\n"; //Quien envia?
		$headers .= "X-Mailer: PHP5\n";
		$headers .= 'MIME-Version: 1.0' . "\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; //

		//Comprobamos que los datos enviados a la función MAIL de PHP estén bien y si es correcto enviamos
		if(mail($para, $asunto, $mensaje, $headers)){
			if($pago == "tarjeta") {
				// Pago con tarjeta
				$total = floatval($totalApagar);
				$preference_data = array (
				    "items" => array (
				        array (
				            "title" => "Sandwich Miga - Total abonar: $ $total - Cantidad de sandwiches $totalSandwiches",
				            "quantity" => 1,
				            "currency_id" => "ARS",
				            "unit_price" => $total
				        )
				       
				     ),"back_urls" => array(
				    	"success" => $baseUrl . "/",
				    	"pending" => $baseUrl . "/",
				    	"failure" => $baseUrl . "/"
				    )
				);
				

				// Crear preferencia en MP
				$preference = $mp->create_preference($preference_data);

				// Leer url de checkout
				$url = $preference['response']['init_point'];

				// Redirigir al checkout
				header("Location: " . $url);
				
			} else {
				// Pago en efectivo
				header("Location: ".URL_PAGO_EFECTIVO);
			}
		}else{
			echo "Hubo un error en el envío inténtelo más tarde";
		}
  }
}
?>