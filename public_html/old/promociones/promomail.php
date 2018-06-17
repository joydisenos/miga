<?php
/*Formulario de contacto HTML5, PHP Y Bootstraps
Creado por: www.render2web.com
Version: 1.1*/

require_once('mercadopago.php');

$mp = new MP('1787728543868124', '6nXoG9IfPRwUL4BXWW2IDkweUSH40Hn6');

$baseUrl = "https://www.sondemiga.com/";
$precioUnitario = 1;
$preciopromo1 = 150.00;
$preciopromo2 = 400.00;
$preciopromo3 = 340.00;
$preciopromo4 = 12.50;
$preciopromo5 = 15.00;
$preciopromo6 = 15.00;
$preciopromo7 = 15.75;
$preciopromo8 = 15.00;
$preciopromo9 = 15.00;
$preciopromo10 = 15.00;
$preciopromo11 = 15.00;
$preciopromo12 = 15.75;
$preciopromo13 = 15.75;
$preciopromo14 = 15.75;
$preciopromo15 = 15.00;
$preciopromo16 = 15.00;
$preciopromo17 = 15.75;
$preciopromo18 = 15.00;
$precioenvio = 15.00;
 


//Comprobamos que se haya presionado el boton enviar
if(!isset($_POST['enviar'])){
	exit("Envío inválido");
}

//Guardamos en variables los datos enviados
$cant1 = $_POST['cant1'];
$cant2 = $_POST['cant2'];
$cant3 = $_POST['cant3'];
$cant4 = $_POST['cant4'];
$cant5 = $_POST['cant5'];
$cant6 = $_POST['cant6'];
$cant7 = $_POST['cant7'];
$cant8 = $_POST['cant8'];
$cant9 = $_POST['cant9'];
$cant10 = $_POST['cant10'];
$cant11 = $_POST['cant11'];
$cant12 = $_POST['cant12'];
$cant13 = $_POST['cant13'];
$cant14 = $_POST['cant14'];
$cant15 = $_POST['cant15'];
$cant16 = $_POST['cant16'];
$cant17 = $_POST['cant17'];
$cant18 = $_POST['cant18'];
$cantenvio = $_POST['cantenvio'];
$name = $_POST['name'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$pago = $_POST['pago'];
$horario = $_POST['horario'];
$comentario = $_POST['comentario'];


///Validamos del lado del servidor que el nombre y el telefono no estén vacios
if($name == ''){
	exit("Debe ingresar su nombre");
}
if($telefono == ''){
	exit("Debe ingresar su telefono");
}

// Sumamos cantidad total
$cantidadTotal = intval($cant1) + intval($cant2) + intval($cant3) + intval ($cant4) + intval($cant5) + intval($cant6) + intval($cant7) + intval($cant8) + intval($cant9) + intval($cant10) + intval($cant11) + intval($cant12) + intval($cant13) + intval($cant14) + intval($cant15) + intval($cant16) + intval($cant17) + intval($cant18) + intval($cantenvio);

// Chequeamos cantidad
if($cantidadTotal == 0){
	exit("Debe seleccionar al menos 1 producto");
}

$precioTotal = $cant1 * $preciopromo1 + $cant2 * $preciopromo2 + $cant3 * $preciopromo3 + $cant4 * $preciopromo4 + $cant5 * $preciopromo5 + $cant6 * $preciopromo6 + $cant7 * $preciopromo7 + $cant8 * $preciopromo8 + $cant9 * $preciopromo9 + $cant10 * $preciopromo10 + $cant11 * $preciopromo11 + $cant12 * $preciopromo12 + $cant13 * $preciopromo13 + $cant14 * $preciopromo14 + $cant15 * $preciopromo15 + $cant16 * $preciopromo16 + $cant17 * $preciopromo17 + $cant18 * $preciopromo18 + $cantenvio * $precioenvio;



$para = "pedidos@sondemiga.com";//Email al que se enviará
$asunto = "Pedido Sondemiga.com";//Puedes cambiar el asunto del mensaje desde aqui
//Este sería el cuerpo del mensaje
$mensaje = "
	<table border='0' cellspacing='3' cellpadding='2'>
	<h3>NUEVO PEDIDO desde www.sondemiga.com</h3>
	<p>----------------------------</p>
	<tr>
	<td align='left' bgcolor='#f0efef'><strong>::PROMOCIONES::</strong></td>
		<td align='left' bgcolor='#f0efef'></td>
	  </tr>
	<tr>
		<td align='left' bgcolor='#ffffff'><strong>16 JAMON Y QUESO ($150.00):</strong></td>
		<td align='left'>$cant1</td>
	</tr>
	<tr>
		<td align='left' bgcolor='#f0efef'><strong>100 Triples Cumpleaños ($400.00):</strong></td>
		<td align='left' bgcolor='#f0efef'>$cant2</td>
	</tr>
	<tr>
		<td align='left' bgcolor='#f0efef'><strong>24 Triples Surtidos ($340.00):</strong></td>
		<td align='left' bgcolor='#f0efef'>$cant3</td>
	</tr>
	
	<tr>
		<td align='left' bgcolor='#ffffff'><strong>::SAND MIGA UNIDAD::</strong></td>
		<td align='left'></td>
	</tr>
	  
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Jamón y Queso ($12.50):</strong></td>
		<td align='left'>$cant4</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Salame y Queso ($15.00):</strong></td>
		<td align='left' bgcolor='#f0efef'>$cant5</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Tomate y Queso ($15.00):</strong></td>
		<td align='left'>$cant6</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Jamón Queso Tomate y Lechuga ($15.75):</strong></td>
		<td align='left' bgcolor='#f0efef'>$cant7</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Jamón y Tomate ($15.00):</strong></td>
		<td align='left'>$cant8</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Queso y Huevo ($15.00):</strong></td>
		<td align='left' bgcolor='#f0efef'>$cant9</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Aceituna y Queso ($15.00):</strong></td>
		<td align='left'>$cant10</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Aceituna y Jamón ($15.00):</strong></td>
		<td align='left' bgcolor='#f0efef'>$cant11</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Atún y Queso ($15.75):</strong></td>
		<td align='left'>$cant12</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Atún y Jamón ($15.75):</strong></td>
		<td align='left' bgcolor='#f0efef'>$cant13</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Atun y Tomate ($15.75):</strong></td>
		<td align='left'>$cant14</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Jamón y Huevo ($15.00):</strong></td>
		<td align='left' bgcolor='#f0efef'>$cant15</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Queso y Tomate ($15.00):</strong></td>
		<td align='left'>$cant16</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Jamón Queso Tomate y Huevo($15.75):</strong></td>
		<td align='left' bgcolor='#f0efef'>$cant17</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Tomate y Huevo ($15.00):</strong></td>
		<td align='left'>$cant18</td>
	  </tr>
	  
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>::DATOS DELIVERY::</strong></td>
		<td align='left'></td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Nombre:</strong></td>
		<td align='left' bgcolor='#f0efef'>$name</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Direccion:</strong></td>
		<td align='left'>$direccion</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Telefono:</strong></td>
		<td align='left' bgcolor='#f0efef'>$telefono</td>
	  </tr>
	   <tr>
		<td align='left' bgcolor='#ffffff'><strong>Email:</strong></td>
		<td align='left'>$email</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Pago:</strong></td>
		<td align='left' bgcolor='#f0efef'>$pago</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Envio:</strong></td>
		<td align='left' bgcolor='#f0efef'>$envio</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>Horario:</strong></td>
		<td align='left'>$horario</td>
	  </tr>
	
	<tr>
		<td align='left' bgcolor='#f0efef'><strong>Comentario:</strong></td>
		<td align='left' bgcolor='#f0efef'>$comentario</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#ffffff'><strong>::TOTAL A PAGAR::</strong></td>
		<td align='left'></td>
	  </tr>
	  <tr>
	  	<td align='left' bgcolor='#f0efef'><strong>Sandwiches pedidos:</strong></td>
		<td align='left'>$cantidadTotal</td>
	  </tr>
	  <tr>
	  	<td align='left' bgcolor='#f0efef'><strong>Total a pagar:</strong></td>
		<td align='left'>$precioTotal</td>
	  </tr>
</table>	
";	

//Cabeceras del correo
$headers = "From: $name <$telefono>\r\n"; //Quien envia?
$headers .= "X-Mailer: PHP5\n";
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; //

//Comprobamos que los datos enviados a la función MAIL de PHP estén bien y si es correcto enviamos
if(mail($para, $asunto, $mensaje, $headers)){

	if($pago == "tarjeta") {
		// Pago con tarjeta
		$preference_data = array (
		    "items" => array (
		        array (
		            "title" => "$cantidadTotal Sandwiches",
		            "quantity" => 1,
		            "currency_id" => "ARS",
		            "unit_price" => $precioTotal
		        )
		    ),
		    "back_urls" => array(
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
		header("Location: https://www.sondemiga.com/enviado.html");
	}

}else{
	echo "Hubo un error en el envío inténtelo más tarde";
}