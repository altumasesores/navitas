<?php 
	
	if (!isset($_SESSION)) {
		  session_start();
		 
	}

	$id_usuario= $_SESSION['id_usuario'];
	
	include_once("../Connections/dbConexion.php");
	include_once("../admin/datos_ftp.php"); 
	include_once("../admin/publicaciones_clase.php");
	include("../libs/php/phpmailer/class.phpmailer.php");
	include_once("../admin/empresa_clase.php");

	//include_once("correo2.php"); 
	$objPublicaciones = new cPublicaciones();
/* 	include_once("empresa_clase.php");
	$objEmpresa = new cEmpresa();	 */
	
	$descripcion= $_POST["descripcion"];
	$empresas= $_POST["empresas"];
	
	foreach($empresas as $val){
		echo $val;
		}
						 
 	if(!empty($_FILES["archivo"])){
		$file = $_FILES["archivo"]["tmp_name"];
		$base_archivo = basename($_FILES["archivo"]["name"]);
		$id_ftp=ConectarFTP();
/* 		
		ini_set('post_max_size','100M');
		ini_set('upload_max_filesize','100M');
		ini_set('max_execution_time','1000');
		ini_set('max_input_time','1000'); */
		
		$upload = ftp_put($id_ftp, $base_archivo, $file, FTP_BINARY);
		
		if (!$upload) {
			$status = "Error al guardar: " . $base_archivo;
		} else {
			
			$ruta_archivo= "documentos/".$base_archivo;
			$fecha_publicacion= date('Y/m/d');			
			$id_documento= $objPublicaciones->crear($descripcion, $fecha_publicacion, $ruta_archivo);
			
			$status = "Exito al guardar: " . $base_archivo;
	}
	
		unset($_FILES["archivo"]);
		ftp_quit($id_ftp);
		
		
		//Inicio a guardar en la base de datos la ruta del archivo			
		
		for ($i=0;$i<count($empresas);$i++) 
      	 { 
		 	if ($empresas[$i]=="todas"){
				$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
				$listaEmpresas= $objEmpresa->consultar_empresas_x_usuario($id_usuario); //Consulto todas las empresas y las guardo en $lista empresas	
				while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){
						$ClaveEmpresa=$row_empresas['id_empresa'];
						$objPublicaciones->documentos_empresa($id_documento, $ClaveEmpresa);
						$corr=$objPublicaciones->correoEmpresa($ClaveEmpresa);
						$correo1=mysql_fetch_array($corr);  
						$correo=$correo1['correo'];
						//echo $correo;
					//}
				  
							$mail = new phpmailer();


							// Introducimos la información del remitente del mensaje
							$mail->From     = "jesus@altumasesores.com";
							$mail->FromName = "NAVITAS SA DE CV";
							// y los destinatarios del mensaje. Podemos especificar más de un destinatario
							$mail->AddAddress($correo);
							// Establecemos los parámetros del mensaje: ancho y formato.
							$mail->WordWrap = 50; // ancho del mensaje
							$mail->IsHTML(true); // enviar como HTML

							// Añadimos el mensaje: asunto, cuerpo del mensaje en HTML y en formato
							// solo texto
							$mail->Subject  =  "Mensaje desde el SISTEMA DE ADMINISTRACION DE NOMINAS";
							$mail->Body     =  "Se ha realizado una nueva publicaci&oacute;n el Archivo ".$base_archivo." y la Descripción ".$descripcion." <BR> para revisarlo entre a la siguiente direcci&oacute;n <a href='http://www.mivacante.com/navitas/'>www.mivacante.com/navitas/</a> 			
												";
												
												
												
												
							$mail->AltBody  =  "Su correo es ".$correo." "; // Para los queno pueden recibir en formato HTML


							if(!$mail->Send())
							{
							   echo "El mensaje no se ha podido enviar

							";
							   echo "Error: " . $mail->ErrorInfo;
							   exit;
							}
							echo "El mensaje se ha enviado correctamente";

				}
				break;
			}else{
			 	$objPublicaciones->documentos_empresa($id_documento, $empresas[$i]);
				$ClaveEmpresa=$empresas[$i];
				$corr=$objPublicaciones->correoEmpresa($ClaveEmpresa);
				$correo1=mysql_fetch_array($corr);  
				$correo=$correo1['correo'];
			//}
      	  
					$mail = new phpmailer();


					// Introducimos la información del remitente del mensaje
					$mail->From     = "jesus@altumasesores.com";
					$mail->FromName = "NAVITAS SA DE CV";
					// y los destinatarios del mensaje. Podemos especificar más de un destinatario
					$mail->AddAddress($correo);
					// Establecemos los parámetros del mensaje: ancho y formato.
					$mail->WordWrap = 50; // ancho del mensaje
					$mail->IsHTML(true); // enviar como HTML

					// Añadimos el mensaje: asunto, cuerpo del mensaje en HTML y en formato
					// solo texto
					$mail->Subject  =  "Mensaje desde el SISTEMA DE ADMINISTRACION DE NOMINAS";
					$mail->Body     =  "Se ha realizado una nueva publicaci&oacute;n el Archivo ".$base_archivo." y la Descripción ".$descripcion." <BR> para revisarlo entre a la siguiente direcci&oacute;n <a href='http://www.mivacante.com/navitas/'>www.mivacante.com/navitas/</a> 			
										";
										
										
										
										
					$mail->AltBody  =  "Su correo es ".$correo." "; // Para los queno pueden recibir en formato HTML


					if(!$mail->Send())
					{
					   echo "El mensaje no se ha podido enviar

					";
					   echo "Error: " . $mail->ErrorInfo;
					   exit;
					}
					echo "El mensaje se ha enviado correctamente";
			}
      	 } 
		
		
		
		echo( '<script>parent.mostrar( "'.$_FILES['archivo'].'" , "Cargado" );</script>' );
		//include("publicaciones_consulta.php");
	}

?>