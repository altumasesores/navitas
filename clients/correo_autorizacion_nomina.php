<?php 

	$objNomina = new cNomina();	              //Creamos el objeto $objEmpleados de la clase cEmpleado
	$listaNominas= $objNomina->consultar_nomina($id_nomina);  //Consulto todas los empleados y las guardo en $lista empleados

	
	while ($row_nominas = mysql_fetch_assoc($listaNominas)){       
      
      $inicio_periodo= mysql_texto($row_nominas['inicio_periodo']); 
      $fin_periodo=    mysql_texto($row_nominas['fin_periodo']);
	  $id_nomina=       $row_nominas['id_nomina'];
	  $id_empresa=       $row_nominas['id_empresa'];
     }

		
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);   //Consulto todas las empresas y las guardo en $lista empresas	
		
	while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){            
	  $razon_social= $row_empresas['razon_social']; 
     } 	
	

	
	

	$mail = new phpmailer();
	
	
	// Introducimos la información del remitente del mensaje
	$mail->From     = "admin@altumasesores.com";
	$mail->FromName = "Navitas S.A. de C.V.";
	$mail->AddReplyTo("admin@altumasesores.com","Informacion");
	// y los destinatarios del mensaje. Podemos especificar más de un destinatario
	$mail->AddAddress("jesus_coral@hotmail.com");
	$mail->AddAddress("roque@altumasesores.com");
	
	// Establecemos los parámetros del mensaje: ancho y formato.
	$mail->WordWrap = 50; // ancho del mensaje
	$mail->IsHTML(true); // enviar como HTML
	$mail->AddEmbeddedImage('../logo.jpg','logo','logo.jpg');
//	Luego, en el cuerpo del mensaje deberás incluir clásica etiqueta <img src="cid:imagen_1" />

	// Añadimos el mensaje: asunto, cuerpo del mensaje en HTML y en formato
	// solo texto
	$mail->Subject  =  "Mensaje desde el Portal de Atención a Clientes Navitas";
	$mail->Body     =  "ATENCIÓN: <br/><br/><br/> 
	
	     La empresa <strong>".$razon_social."</strong>  ha autorizado la nómina correspondiente al periodo del ".$inicio_periodo." al ".$fin_periodo.".<br/><br/><br/> 


	<a href='http://www.mivacante.com/navitas/'>www.mivacante.com/navitas/</a>		
		<br/><br/><br/> <br/><br/> 
		<img src='cid:logo' />

						";
						
						
						
						
	$mail->AltBody  =  "Se ha autorizado una nomina en el portal de atencion a clientes.\n\n"; // Para los queno pueden recibir en formato HTML

	$mail->AddAttachment("../reportes/nomina_".$id_nomina.".xls", "nomina_".$id_nomina.".xls"); 

	if(!$mail->Send())
	{
	   echo "Error: " . $mail->ErrorInfo;
	   exit;
	}

	echo "Se ha notificado su autorizacion. Gracias.";
	




?>