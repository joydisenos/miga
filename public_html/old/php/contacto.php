<?php
/*Formulario de contacto HTML5, PHP Y Bootstraps
Creado por: www.render2web.com
Version: 1.1*/

require_once('mercadopago.php');

$mp = new MP("4224173521558065", "xTQBOaGSxsp1EarLBNej1K6UjtHqddcU");

$baseUrl = "http://www.sondemiga.com/enviado.html";
$precioUnitario = 1;
$precioJamonyQueso = 8.75;
$precioJamonTomateyQueso = 11.70;
$precioJamonyTomate = 10.85;
$precioJamonTomateQuesoyHuevo = 12.50;
$precioSalameyQueso = 10;


//Comprobamos que se haya presionado el boton enviar
if(!isset($_POST['enviar'])){
	exit("Envío inválido");
}

//Guardamos en variables los datos enviados
$cantidad1 = $_POST['cantidad1'];
$cantidad2 = $_POST['cantidad2'];
$cantidad3 = $_POST['cantidad3'];
$cantidad4 = $_POST['cantidad4'];
$cantidad5 = $_POST['cantidad5'];
$gaseosa = $_POST['gaseosa'];
$name = $_POST['name'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$pago = $_POST['pago'];
$comentario = $_POST['comentario'];


///Validamos del lado del servidor que el nombre y el email no estén vacios
if($name == ''){
	exit("Debe ingresar su nombre");
}
if($email == ''){
	exit("Debe ingresar su email");
}

// Sumamos cantidad total
$cantidadTotal = intval($cantidad1) + intval($cantidad2) + intval($cantidad3) + intval ($cantidad4) + intval($cantidad5);

// Chequeamos cantidad
if($cantidadTotal == 0){
	exit("Debe seleccionar al menos 1 producto");
}

$precioTotal = $cantidad1 * $precioJamonyQueso + $cantidad2 * $precioJamonTomateyQueso + $cantidad3 * $precioJamonyTomate + $cantidad4 * $precioJamonTomateQuesoyHuevo + $cantidad5 * $precioSalameyQueso ; 


$para = "pedidos@sondemiga.com" .",";//Email al que se enviará
$para .= "$email"; //Envia email a quien realiza el pedido
$asunto = "Pedido Sondemiga.com";//Puedes cambiar el asunto del mensaje desde aqui
//Este sería el cuerpo del mensaje
$mensaje = "
	<table border='0' cellspacing='3' cellpadding='2'>
	<h1>Gracias $name por su compra!</h2>
	<h3>Pedido en www.sondemiga.com</h3>
	<p>----------------------------</p>
	  <tr>
	  <td><h2>Pedido realizado: </h2></td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Jamon y Queso:</strong></td>
		<td align='left'>$cantidad1</td>
	  </tr>
	  <tr>
		<td width='30%' align='left' bgcolor='#f0efef'><strong>Jamon Tomate y Queso:</strong></td>
		<td width='70%' align='left'>$cantidad2</td>
	  </tr>
	  <tr>
		<td width='30%' align='left' bgcolor='#f0efef'><strong>Jamon y Tomate:</strong></td>
		<td width='70%' align='left'>$cantidad3</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Jamon Tomate Queso y Huevo:</strong></td>
		<td align='left'>$cantidad4</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Salame y Queso:</strong></td>
		<td align='left'>$cantidad5</td>
	  </tr>
	  <tr>
	  <td><h2>Datos para la entrega</h2></td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Nombre:</strong></td>
		<td align='left'>$name</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Apellido:</strong></td>
		<td align='left'>$apellido</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Email:</strong></td>
		<td align='left'>$email</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Direccion:</strong></td>
		<td align='left'>$direccion</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Telefono:</strong></td>
		<td align='left'>$telefono</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Forma de pago:</strong></td>
		<td align='left'>$pago</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Comentario:</strong></td>
		<td align='left'>$comentario</td>
	  </tr>
	  <tr>
	  <td><h2>Facturacion</h2></td>
	  </tr>
	  <tr>
	  	<td align='left' bgcolor='#f0efef'><strong>Sandwiches pedidos:</strong></td>
		<td align='left'>$cantidadTotal</td>
	  </tr>
	  <tr>
	  	<td align='left' bgcolor='#f0efef'><strong>Total a pagar (Sin Gaseosa):</strong></td>
		<td align='left'>$precioTotal</td>
	  </tr>
	  <tr>
		<td align='left' bgcolor='#f0efef'><strong>Gaseosa:</strong></td>
		<td align='left'>$gaseosa</td>
	  </tr>
	  <tr>
	  <td><h4>Estamos preparando pedidos! - En breve te lo llevamos a $direccion</h4></td>
	  </tr>
	  
	  <tr>
		<td><h4>www.sondemiga.com | Hace tu pedido de sandwiches online</h4></td>
	  </tr>
</table>	
";	

//Cabeceras del correo
$headers = "From: $name <$email>\r\n"; //Quien envia?
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
		            "title" => "$cantidadTotal sandwiches",
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
		header("Location: http://www.sondemiga.com/enviado.html");
	}

}else{
	echo "Hubo un error en el envío inténtelo más tarde";
}