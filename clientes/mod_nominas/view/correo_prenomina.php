<?php 



require_once("../../../libs/php/autoload/autoload.php");
require_once ('../../../libs/php/mvc/ConfigBD.php'); 
require_once ('../../../libs/php/phpmailer/class.phpmailer.php'); 

$ModeloNomina = new ModelNomina();
$mail = new phpmailer();


$id_empresa=$_POST['id_empresa'];
$inicio_periodo= $_POST['inicio_periodo'];	
$fin_periodo= $_POST['fin_periodo'];
$periodo_nomina= strtoupper($_POST['periodo_nomina']);


$DetallesEmpresas=$ModeloNomina->consultarEmpresaXId($id_empresa);
$Correos=$ModeloNomina->consultarCorreosUsuarios($id_empresa);		
$Empresa=$DetallesEmpresas->fetch();
$razon_social=$Empresa['razon_social'];



//$data['razon_social']= $Empresa['razon_social'];	
		

// Introducimos la información del remitente del mensaje
	$mail->From     = "admin@altumasesores.com";
	$mail->FromName = "Navitas S.A. de C.V.";
	$mail->AddReplyTo("admin@altumasesores.com","Informacion");	
	$mail->AddEmbeddedImage('../logo.jpg','logo','logo.jpg');
// Agrego los destinatarios del correo que son los usuarios ligados a esta empresa


	

while ($usuarios=$Correos->fetch()){ 
  		$correo= $usuarios['correo'];
		//$correo="lobo_levis@hotmail.com";
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
   $MENSAJE="El mensaje no se ha podido enviar";
   $MENSAJE="Error: " . $mail->ErrorInfo;
   echo"<script>jAlert('$MENSAJE')</script>";
   exit;
}

echo"<script>jAlert('Se le ha notificado su operacion vía correo. Gracias.')</script>";







	
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
