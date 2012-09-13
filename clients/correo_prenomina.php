<?php 
	include("../phpmailer/class.phpmailer.php");
	include_once("../admin/empresa_clase.php");	
	include_once("../admin/usuario_clase.php");	
	
	
	
	//Recibo las variables
	
	$id_empresa= $_POST['id_empresa'];	
	$inicio_periodo= $_POST['inicio_periodo'];	
	$fin_periodo= $_POST['fin_periodo'];
	$periodo_nomina= strtoupper($_POST['periodo_nomina']);
	
	$objEmpresa = new cEmpresa();	             
	$listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);	
	
	
 while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){ 
  	$razon_social= $row_empresas['razon_social'];
     } 


$mail = new phpmailer();


// Introducimos la información del remitente del mensaje
	$mail->From     = "admin@altumasesores.com";
	$mail->FromName = "Navitas S.A. de C.V.";
	$mail->AddReplyTo("admin@altumasesores.com","Informacion");	
	$mail->AddEmbeddedImage('../logo.jpg','logo','logo.jpg');
// Agrego los destinatarios del correo que son los usuarios ligados a esta empresa


	$objUsuario = new cUsuario();	             
	$listaUsuarios= $objUsuario->consultar_correos_usuarios_empresa($id_empresa);	

while ($row_usuarios = mysql_fetch_assoc($listaUsuarios)){ 
  		$correo= $row_usuarios['correo'];
		$mail->AddAddress($correo);	
     } 


// Establecemos los parámetros del mensaje: ancho y formato.
$mail->WordWrap = 50; // ancho del mensaje
$mail->IsHTML(true); // enviar como HTML

// Añadimos el mensaje: asunto, cuerpo del mensaje en HTML y en formato
// solo texto
$mail->Subject  =  "Mensaje desde el Portal de Atención a Clientes Navitas";

$mail->Body     =  "ATENCIÓN: <br/><br/><br/> 
                     Se ha creado la prenómina  <strong>".$periodo_nomina."</strong> de la empresa: <strong>".$razon_social."</strong>  del periodo <strong>".$inicio_periodo."</strong> al  <strong>".$fin_periodo."</strong>. Favor de revisar<br/><br/><br/><br/>


	<a href='http://www.mivacante.com/navitas/'>www.mivacante.com/navitas/</a>		
		<br/><br/><br/> <br/><br/> 
		<img src='cid:logo' />
 			
					";
					
					
					
					
$mail->AltBody  =  "Se ha creado la prenomina de la empresa: ".$razon_social."  del periodo ".$inicio_periodo." al ".$fin_periodo.". Favor de revisar "; // Para los queno pueden recibir en formato HTML


if(!$mail->Send())
{
   echo "El mensaje no se ha podido enviar";
   echo "Error: " . $mail->ErrorInfo;
   exit;
}
echo "Se ha notificado su operacion. Gracias.";


	
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

?>
