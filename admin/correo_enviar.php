<?php 

include_once("correo_clases.php");


$mail_origen= $_POST['mail_origen'];
$mail_destino= $_POST['mail_destino'];
$asunto= $_POST['asunto'];
$mensaje= $_POST['mensaje'];


	
	$objCorreo = new correo();	              
	$nuevoCorreo= $objCorreo->envia_mail($mail_origen, $mail_destino, $asunto, $mensaje);  
	
	echo "El correo ha sido enviado";
	
	/*
	if($nuevoCorreo){
		echo "Se ha enviado un correo a los usuarios.";
		
	}else{
		echo "No se pudo establecer comunicacion con los usuarios.";	
			
			}
*/

?>