<?php 

class correo{
//	
function envia_mail($mail_origen, $mail_destino, $asunto, $mensaje){	
		
		
	$header= "MIME-Version: 1.0 \n Content-type: text/html; charset=UTF-8 \n From: http://www.mivacante.com <".$mail_origen." >\n Reply-To: jesus@altumasesores.com \n";
		
		
		
   mail($mail_destino, $asunto, $mensaje,  $header);
	


	}//FIN DE LA FUNCION ENVIA_MAIL
	
	
	
}//FIN DE LA CLASE CORREO

?>