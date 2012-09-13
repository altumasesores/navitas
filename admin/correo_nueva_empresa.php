<?php 
	include("../libs/php/phpmailer/class.phpmailer.php");
		
	
	//Recibo las variables

	
	$usuario= $_POST['usuario'];
	$password= $_POST['password'];
	$razon_social= $_POST['razon_social'];
	$correo= $_POST['correo'];
	

	$mail = new phpmailer();
	
	
	// Introducimos la información del remitente del mensaje
	$mail->From     = "admin@altumasesores.com";
	$mail->FromName = "Navitas S.A. de C.V.";
	$mail->AddReplyTo("admin@altumasesores.com","Informacion");
	// y los destinatarios del mensaje. Podemos especificar más de un destinatario
	$mail->AddAddress($correo);
	
	// Establecemos los parámetros del mensaje: ancho y formato.
	$mail->WordWrap = 50; // ancho del mensaje
	$mail->IsHTML(true); // enviar como HTML
	
	// Añadimos el mensaje: asunto, cuerpo del mensaje en HTML y en formato
	// solo texto
	$mail->Subject  =  "Mensaje desde el Portal de Atención a Clientes Navitas";
	$mail->Body     =  "Estimado cliente: <br/>
	
	     Su empresa ".$razon_social."  ha sido dada de alta en nuestro Portal de Atención a Clientes Navitas, el cual forma parte de los servicios que Navitas S.A de C.V pone a su disposición.  Sus datos de usuario son los siguientes:<br/><br/><br/>
						usuario: ".$usuario."<br/>
						password: ".$password."<br/><br/><br/>
						
						Para acceder a su cuenta entre a la siguiente direcci&oacute;n <a href='http://www.mivacante.com/navitas/'>www.mivacante.com/navitas/</a> 			
						";
						
						
						
						
	$mail->AltBody  =  "Se ha creado un nuevo usuario con los siguientes datos:\n\n\n
						usuario: ".$usuario."\n
						password: ".$password."\n"; // Para los queno pueden recibir en formato HTML
	
	
	if(!$mail->Send())
	{
	   echo "No se pudo notificar al cliente via mail. Favor de notificar sus datos de usuario.";
	   echo "Error: " . $mail->ErrorInfo;
	   exit;
	}
	echo "Se ha enviado un correo al cliente notificando su alta.";
	
?>
