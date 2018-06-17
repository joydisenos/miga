<?php
//Comprobamos que se haya presionado el boton enviar

if(isset($_POST['enviar'])){
//Guardamos en variables los datos enviados
$tipo = $_POST['tipo'];$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$mesdereserva = $_POST['mesdereserva'];$diadereserva = $_POST['diadereserva'];$hora = $_POST['hora'];
$cantidadhora = $_POST['cantidadhora'];$pago = $_POST['pago'];$agregasandwiches = $_POST['agregasandwiches'];
$consulta = $_POST['consulta'];

 
///Validamos del lado del servidor que el nombre y el email no estén vacios
if($nombre == ''){
echo "Debe ingresar su nombre";
}
else if($telefono == ''){

echo "Debe ingresar su telefono";

}

else {
$para = "pedidos@sondemiga.com";//Email al que se enviará
$asunto = "TURNO INFLABLE";//Puedes cambiar el asunto del mensaje desde aqui
//Este sería el cuerpo del mensaje
$mensaje = "
<table border='0' cellspacing='3' cellpadding='2'>
<p>SOLICITUD TURNO INFLABLE</p>
<small>Pedido realizado en Sondemiga.com <br>La mejor forma de pedir sandwich de miga a domicilio<br>Delivery 02281 15 318667</small>
<tr><td width='30%' align='left' bgcolor='#f0efef'><strong>Tipo Inflable:</strong></td><td width='80%' align='left'>$tipo</td></tr><tr>
<td width='30%' align='left' bgcolor='#f0efef'><strong>Nombre:</strong></td>
<td width='80%' align='left'>$nombre</td>
</tr>

<tr>
<td width='30%' align='left' bgcolor='#f0efef'><strong>Telefono:</strong></td>
<td width='70%' align='left'>$telefono</td>
</tr>
<tr>
<td width='30%' align='left' bgcolor='#f0efef'><strong>Direccion:</strong></td>
<td width='70%' align='left'>$direccion</td>
</tr><tr><td width='30%' align='left' bgcolor='#f0efef'><strong>Dia reserva:</strong></td><td width='70%' align='left'>$diadereserva</td></tr><tr><tr><td width='30%' align='left' bgcolor='#f0efef'><strong>Mes de reserva:</strong></td><td width='70%' align='left'>$mesdereserva</td></tr><tr><tr><td width='30%' align='left' bgcolor='#f0efef'><strong>Hora de reserva:</strong></td><td width='70%' align='left'>$hora</td></tr>
<tr>
<td width='30%' align='left' bgcolor='#f0efef'><strong>Horas reservados:</strong></td>
<td width='80%' align='left'>$cantidadhora</td>
</tr>
<tr>
<tr>
<td width='30%' align='left' bgcolor='#f0efef'><strong>pago:</strong></td>
<td width='70%' align='left'>$pago</td>
</tr><tr><td width='30%' align='left' bgcolor='#f0efef'><strong>Agrega sandwiches:</strong></td><td width='70%' align='left'>$agregasandwiches</td></tr>
<tr>
<td align='left' bgcolor='#f0efef'><strong>Consulta:</strong></td>
<td align='left'>$consulta</td>
</tr>
</table>
";
 
//Cabeceras del correo
$headers = "From: $nombre - Sondemiga <$email>\r\n"; //Quien envia?
$headers .= "X-Mailer: PHP5\n";
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; //
 
//Comprobamos que los datos enviados a la función MAIL de PHP estén bien y si es correcto enviamos
if(mail($para, $asunto, $mensaje, $headers)){
echo header("Location: https://www.sondemiga.com/enviadoinflables.html");
}else{
echo "Hubo un error en el envío inténtelo más tarde";
}
}
}
?>