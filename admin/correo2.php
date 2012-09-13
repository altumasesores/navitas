<?php 
	include("../phpmailer/class.phpmailer.php");
	
	//Recibo las variables
	
	/* $usuario= $_POST['usuario'];
	$password= $_POST['password'];
	$nombre= $_POST['nombre'];
	$correo= $_POST['correo']; */
	//$empresas= $_POST["empresas"];
	/* $archivo= $_POST["archivo"];
	$descripcion= $_POST["descripcion"];
	$usuario= 'aaa';
	$password= 'bbb';
	$nombre= 'cccc';
	$correo2= 'alumna_cohuop@hotmail.com';  */
	
	
//servidor google:
//ghs.google.com.
//aspmx.l.google.com.
//alt1.aspmx.l.google.com.

/*
SetLanguage('es','../phpmailer/language/')
{
	echo 'No se ha podido cargar el fichero de idioma adecuado.';
}
*/


		 	/* if ($empresas[$i]=="todas"){
				break;
			}else{ */
			 //	$objPublicaciones->documentos_empresa($id_documento, $empresas[$i]);
function EnviaCorreo($idEmpresa) 
{
echo $idEmpresa; 
include_once("empresa_clase.php");
$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
 
$correo=$objEmpresa->correoEmpresa($idEmpresa);
			//}
      	  
$mail = new phpmailer();


// Introducimos la información del remitente del mensaje
$mail->From     = "jesus@altumasesores.com";
$mail->FromName = "NAVITAS SA DE CV";
$mail->AddReplyTo("alumna_cohuop@hotmail.com","Informacion");
// y los destinatarios del mensaje. Podemos especificar más de un destinatario
$mail->AddAddress("alumna_cohuop@hotmail.com");
$mail->AddAddress($correo);

// Establecemos los parámetros del mensaje: ancho y formato.
$mail->WordWrap = 50; // ancho del mensaje
$mail->IsHTML(true); // enviar como HTML

// Añadimos el mensaje: asunto, cuerpo del mensaje en HTML y en formato
// solo texto
$mail->Subject  =  "Mensaje desde el SISTEMA DE ADMINISTRACION DE NOMINAS";
$mail->Body     =  "Se ha creado un nuevo usuario en el Sistema de Administraci&oacute;n de N&oacute;minas de NAVITAS SA DE CV, con los siguientes datos:<br/><br/><br/>
					usuario: ".$usuario."<br/>
					password: ".$password."<br/>
					Responsable de la cuenta: ".$nombre." <br/><br/><br/>
					Para acceder a su cuenta".$archivo." ".$descripcion." entre a la siguiente direcci&oacute;n <a href='http://www.mivacante.com/navitas/'>www.mivacante.com/navitas/</a> 			
					";
					
					
					
					
$mail->AltBody  =  "Se ha creado un nuevo usuario con los siguientes datos:\n\n\n
					usuario: ".$usuario."\n
					password: ".$password."\n
					Responsable de la cuenta: ".$nombre." "; // Para los queno pueden recibir en formato HTML


if(!$mail->Send())
{
   echo "El mensaje no se ha podido enviar

";
   echo "Error: " . $mail->ErrorInfo;
   exit;
}
echo "El mensaje se ha enviado correctamente";
}
?>