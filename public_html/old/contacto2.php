<?php
//Comprobamos que se haya presionado el boton enviar

if(isset($_POST['enviar'])){
//Guardamos en variables los datos enviados
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
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
$asunto = "CONTACTO";//Puedes cambiar el asunto del mensaje desde aqui
//Este sería el cuerpo del mensaje
$mensaje = "
<table border='0' cellspacing='3' cellpadding='2'>
<tr>
<td width='30%' align='left' bgcolor='#f0efef'><strong>Nombre:</strong></td>
<td width='80%' align='left'>$nombre</td>
</tr>
<tr>
<td align='left' bgcolor='#f0efef'><strong>E-mail:</strong></td>
<td align='left'>$email</td>
</tr>
<tr>
<td width='30%' align='left' bgcolor='#f0efef'><strong>Telefono:</strong></td>
<td width='70%' align='left'>$telefono</td>
</tr>
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
echo header("Location: https://www.sondemiga.com/enviado.html");
}else{
echo "Hubo un error en el envío inténtelo más tarde";
}
}
}
?>