<?php

class ModelNominaAdmin extends ModelBase{

	public function calcularISR($totalSueldoImss,$tipoNomina){  //sueldo{salario} periodo
		switch ($tipoNomina){

			case 'semanal':
				$limites2=$this->getLimitesTarifa7Dias($totalSueldoImss);
			break;

			case 'quincenal':
				$limites2=$this->getLimitesTarifa15Dias($totalSueldoImss);
			break;

			case 'catorcenal':
				$limites2=$this->getLimitesTarifa15Dias($totalSueldoImss);		 
			break;
		}//fin switch


		foreach($limites2 as $limites){

			$limite_inferior=  $limites['limite_inferior'];

			$limite_superior=  $limites['limite_superior'];

			$cuota_fija=  $limites['cuota_fija'];

			$factor_excedente=  $limites['porcentaje_excedente'];
		}

		$excedente_limite_inferior=$totalSueldoImss-$limite_inferior;

		$resultado_excedente=$excedente_limite_inferior * ($factor_excedente/100);

		$resultado_cuota= $resultado_excedente + $cuota_fija;

		$ISR=$resultado_cuota;

		return $ISR;  //se devuelve el resultado del isr

	}//fin function


	/*Devuelve el subsidio al empleado de acuerdo a un salario indicado y tipo de nomina*/
	public function calcularSubsidioEmpleo($totalSueldoImss,$tipoNomina) {   //sueldo{salario} periodo

		switch ($tipoNomina){

			case 'semanal':		/**obtengo el subsidio semanal**/
				$subsidio_result= $this->getLimitesTablaSubsidio2B($totalSueldoImss);

				foreach($subsidio_result as $subsidios ){
					$subsidio= $subsidios['subsidio_semanal'];				
				}
			break;

			case 'quincenal':
				$subsidio_result= $this->getLimitesTablaSubsidio4B($totalSueldoImss);

				foreach($subsidio_result as $subsidios ){
					$subsidio=  $subsidios['subsidio_quincenal'];				
				}
			break;

			case 'catorcenal':
				$subsidio_result= $this->getLimitesTablaSubsidio4B($totalSueldoImss);
				foreach($subsidio_result as $subsidios ){
					$subsidio=  $subsidios['subsidio_quincenal'];				
				}
			break;

			} //fin switch


			return $subsidio;
	} //fin funcion


	public function calcularIMSS($totalSueldoImssIntegrado,$factorIntegracion,$cuotaTrabajador){
		//aqui debe enviarse como parametro el salario diario integrado multiplicado por los dias.  73*7

		$resultado_factor_integracion = $totalSueldoImssIntegrado * $factorIntegracion;
		$IMSS = $resultado_factor_integracion * ($cuotaTrabajador/100);
		return $IMSS;

	}


	public function consultarEmpresasXUsuario($id_usuario){
		try{
			$query = "SELECT * FROM empresas
			          INNER JOIN usuarios on empresas.id_usuario= usuarios.id_usuario 
					  WHERE  empresas.estatus= 'ACTIVA' AND empresas.id_empresa IN (SELECT id_empresa FROM usuarios_empresas where id_usuario= '$id_usuario')
					  ORDER BY id_empresa ASC";

			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
		}catch (PDOException $e) {				
			$Mensaje="Seleccion Erronea:  </br></br>";
			$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
			$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
			$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
			$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
			echo "<script>jAlert('$Mensaje')</script>";
		}

	}



	public function consultarEmpresasDeUsuario($id_usuario){
		try{
			$query = "select * from empresas where id_usuario='$id_usuario'";

			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
		}catch (PDOException $e) {				
			$Mensaje="Seleccion Erronea:  </br></br>";
			$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
			$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
			$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
			$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		

			echo "<script>jAlert('$Mensaje')</script>";
		}


	}


	public function consultarUsuario($id_usuario){
		try{

			$query = "select * from usuarios where id_usuario='$id_usuario'";

			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
		}catch (PDOException $e) {				
			$Mensaje="Seleccion Erronea:  </br></br>";
			$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
			$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
			$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
			$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
			echo "<script>jAlert('$Mensaje')</script>";
		}
	}



    public function getLimitesTarifa7Dias($sueldo){

		//realizamos la consulta 
		$consulta = $this->db->prepare("SELECT * FROM tarifa_7_dias	WHERE $sueldo BETWEEN limite_inferior AND limite_superior");
		$consulta->execute();

	//devolvemos la coleccion para que la vista la presente.
		return $consulta;
	}


	public function getLimitesTarifa15Dias($sueldo){

		//realizamos la consulta 
		$consulta = $this->db->prepare("SELECT * FROM tarifa_15_dias WHERE $sueldo BETWEEN limite_inferior AND limite_superior");
		$consulta->execute();

	//devolvemos la coleccion para que la vista la presente.
		return $consulta;
	}


	public function getLimitesTablaSubsidio2B($sueldo){
		//realizamos la consulta 
		$consulta = $this->db->prepare("SELECT * FROM tabla_subsidio_2b WHERE $sueldo BETWEEN ingresos_de AND ingresos_hasta");
		$consulta->execute();

		//devolvemos la coleccion para que la vista la presente.
		return $consulta;
	}


	public function getLimitesTablaSubsidio4B($sueldo){
		//realizamos la consulta 
		$consulta = $this->db->prepare("SELECT * FROM tabla_subsidio_4b  WHERE $sueldo BETWEEN ingresos_de AND ingresos_hasta");
		$consulta->execute();
	
		//devolvemos la coleccion para que la vista la presente.
		return $consulta;
	}


	public function consultarTodasNominasXProceso(){
		try{

			$query = "SELECT empresas.razon_social, nominas.id_nomina, nominas.id_empresa, 
							nominas.inicio_periodo, nominas.fin_periodo, nominas.fecha_captura,
							nominas.estado, nominas.percepciones, nominas.honorarios, 
							nominas.relativos, nominas.subtotal, nominas.iva, 
							nominas.total_factura,nominas.observaciones, nominas.tipo_nomina 
						FROM nominas 
						INNER JOIN empresas on empresas.id_empresa= nominas.id_empresa
						where estado= 'Proceso' 
						ORDER BY nominas.id_nomina DESC";

			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();

			return $consulta;

		}catch (PDOException $e) {				
			$Mensaje="Seleccion Erronea:  </br></br>";
			$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
			$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
			$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
			$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
			echo "<script>jAlert('$Mensaje')</script>";

		}
	}


	public function consultarNominasXEmpresa($id_empresa){

		try{

			$query = "SELECT 
			                empresas.razon_social, nominas.id_nomina, nominas.id_empresa,
							nominas.inicio_periodo, nominas.fin_periodo, nominas.fecha_captura, 
							nominas.estado, nominas.percepciones, nominas.honorarios, 
							nominas.relativos, nominas.subtotal, nominas.iva, 
							nominas.total_factura, nominas.observaciones, nominas.tipo_nomina
							FROM nominas
							INNER JOIN empresas on empresas.id_empresa= nominas.id_empresa
							WHERE nominas.id_empresa= '$id_empresa' 
							ORDER BY nominas.id_nomina DESC";
						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}

		}


	/***MOSTRAR LA NOMINA DE LA EMPRESA CON EMPLEADOS-VISTA ADMIN*********************************************************************************************************/
	public function consultarDetallesNominaXId($id_nomina){

		try{

			$query = "SELECT * FROM nominas  WHERE nominas.id_nomina= $id_nomina";						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}

	}




	public function consultarDetallesEmpresaXId($id_empresa){

		try{

			$query = "SELECT * FROM empresas where id_empresa= '$id_empresa'";						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}
		}



	public function consultarNumeroEmpleadosAfiliadosImss($id_nomina,$id_empresa){

		try{

			/*siempre retornara un valor 0,1,2,3....n*/
			$query = "SELECT count(pe.id_empleado) as numero
					  FROM percepciones_empleado pe			
					  INNER JOIN empleados e on pe.id_empleado= e.id_empleado																						
					  WHERE  pe.id_nomina= '$id_nomina' 
					  AND pe.id_empresa= '$id_empresa'     
					  AND e.cuenta_imss='si'";						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}

	}


	public function consultarEmpleadosFueraDeNomina($id_nomina,$id_empresa){

		try{

			$query = "SELECT 			
			          concat(empleados.nombre,' ',empleados.ap_paterno,' ',empleados.ap_materno) as nombre, 					  
					  empleados.id_empleado, empleados.sueldo_diario, empleados_empresa.id_empresa
					  FROM empleados 
					  INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado
					  WHERE empleados_empresa.id_empresa = '$id_empresa' 
					  AND empleados.estado = 'ACTIVO' 
					  AND empleados.id_empleado NOT IN(
					                                   SELECT percepciones_empleado.id_empleado 
													   FROM percepciones_empleado  
													   WHERE percepciones_empleado.id_nomina = $id_nomina
													   )";						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}

	}



	public function consultarDetallesNominaEmpleados($id_nomina,$id_empresa){

		try{

			
			$query="
			        SELECT
					      pe.*,
						  de.*,
						  concat(e.nombre,' ',e.ap_paterno,' ',e.ap_materno) as nombre,
						  e.no_tarjeta, 
						  e.sueldo_diario_imss
					
					from percepciones_empleado pe
					inner join deducciones_empleado de on pe.id_empresa=de.id_empresa 
					and pe.id_nomina=de.id_nomina 
					and pe.id_empleado=de.id_empleado
					inner join empleados e on pe.id_empleado=e.id_empleado
					where pe.id_nomina= '$id_nomina' 
					AND   pe.id_empresa= '$id_empresa'
					order by pe.id_empleado";
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}
	}		




	public function consultarDetallesNominaFiscalEmpleados($id_nomina,$id_empleado){





		try{

			$query = "SELECT *								
								FROM 
								nomina_fiscal								
								WHERE  id_nomina='$id_nomina'
								and id_empleado='$id_empleado'";						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}

	}



	public function consultarTotalNominaEmpleadoXIdNomina($id_nomina,$id_empleado){

		try{

			$query = "
			          select
					        (
							 total_sueldo+
							 total_domingos_trabajados+	
							 total_vacaciones+ 	
							 total_turnos_trabajados+ 	
							 total_descanso_trabajado+
							 total_horas_extras+
							 otras_percepciones+ 
							 complemento_sueldo+ 	
							 total_dias_festivos+									  
							 aguinaldo
							 )as percepciones,
							 
							 (
							 p_total_sueldo+
							 p_total_horas_extras+							 
							 p_subtotal_domingos+
							 p_total_turnos_trabajados+
							 p_total_descansos_trabajados+
							 p_total_dias_festivos+							 
							 p_subtotal_vacaciones+
							 p_aguinaldo+
							 p_premio_por_puntualidad+
							 p_premio_por_asistencia+
							 p_becas_educacionales+
							 p_despensa+
							 p_subsidio_empleo							
							 ) as percepciones_fiscales,
							 infonavit+									  
							 prestamos+
							 caja_ahorro+
							 otras_deducciones+
							 fonacot+
							 prestamo_ascon
							 ) as deducciones,
							 d_prestamos+
							 d_caja_ahorro+
							 d_fonacot+
							 d_infonavit+
							 d_total_otras_deducciones+
							 d_ISR+
							 d_IMSS					 
							 )as deducciones_fiscales
							 from 
							 percepciones_empleado pe 
							 inner join deducciones_empleado de on pe.id_empleado=de.id_empleado and pe.id_nomina=de.id_nomina
							 inner join nomina_fiscal nf on pe.id_empleado=nf.id_empleado and pe.id_nomina=nf.id_nomina
							 where pe.id_empleado='$id_empleado'
							 and
							 pe.id_nomina='$id_nomina'
							 ";						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}


	}






	/************VISTA ADMIN*****************************************************************************************************/



	public function eliminarNominaXIdNomina($id_nomina){

		try{

			$query = "DELETE FROM nominas WHERE id_nomina= '$id_nomina'";
						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			echo "<script>jAlert('Nomina eliminada correctamente')</script>";
			return $consulta;
			
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}
	}


	public function consultarEmpleadoXId($id_empleado){

		try{

			$query = "SELECT * FROM empleados where id_empleado= '$id_empleado'";
						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			
			}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}

	}



	public function guardarDatosNominaNormalNuevaPercepciones($id_nomina,$id_empresa,$id_empleado,$sueldo_diario){

		$query="INSERT INTO `percepciones_empleado` (

												   `id_nomina`,`id_empleado`,`id_empresa`,
													
												   `sueldo_diario_emp`,`dias_trabajados`,`total_sueldo`,
												   
												   `domingos_trabajados`,`prima_dominical`,`total_domingos_trabajados`, 
												   `vacaciones`,`prima_vacacional`,`total_vacaciones`, 
												   `turnos_trabajados`,`total_turnos_trabajados`, 
												   `descanso_trabajado`,`total_descanso_trabajado`,
												   `horas_extras`,`total_horas_extras`, 
												   `dias_festivos`,`total_dias_festivos`,
												   `otras_percepciones`,`complemento_sueldo`,`aguinaldo`,												  
												  
												   `total_ReciboNomina`
												   )
										   VALUES (
										           '$id_nomina','$id_empleado','$id_empresa',												  
												 
												   '$sueldo_diario','0','0',
												   '0','0','0',
												   '0','0',
												   '0'
												   )";	
		//realizamos la consulta 
		$consulta = $this->db->prepare($query);
		
		$consulta->execute();

	}



	public function guardarDatosNominaNormalNuevaDeducciones($id_nomina,$id_empresa,$id_empleado){

		$query="INSERT INTO `deducciones_empleado` (

		                                            `id_nomina`, `id_empresa`, `id_empleado`, 
													
													`prestamos`, `caja_ahorro`, `otras_deducciones`, 
													`fonacot`, `prestamo_ascon`, `infonavit`
													) 
											VALUES (
											        '$id_nomina','$id_empresa','$id_empleado',
													'0','0','0',
													'0','0','0'											
											        )";	
		//realizamos la consulta 
		$consulta = $this->db->prepare($query);
		$consulta->execute();
	}











	public function guardarDatosNominaFiscalNueva($id_nomina,$id_empleado,$sueldo_diario_imss){

		$query="INSERT INTO `nomina_fiscal` (

		                                     `id_nomina`, `id_empleado`, 
											 `p_sueldo_diario`, `p_dias_trabajados`, `p_total_sueldo`, 
											 `p_num_domingos_trabajados`, `p_prima_dominical`, `p_subtotal_domingos`, 
											 `p_num_vacaciones`, `p_prima_vacacional`, `p_subtotal_vacaciones`,
											 `p_num_turnos_trabajados`, `p_total_turnos_trabajados`, 
											 `p_num_descansos_trabajados`, `p_total_descansos_trabajados`, 
											 `p_num_horas_extras`, `p_total_horas_extras`, 
											 `p_num_dias_festivos`, `p_total_dias_festivos`,
											 `p_premio_por_puntualidad`, `p_premio_por_asistencia`, `p_despensa`, `p_becas_educacionales`,
											 `p_aguinaldo`,  
											 `p_subsidio_empleo`,
											 
											 `d_prestamos`, `d_caja_ahorro`, `d_total_otras_deducciones`, `d_descripcion_otras_deducciones`,
											 `d_fonacot`,`d_infonavit`, 
											 `d_ISR`, `d_IMSS`, 
											 `total_nomina_fiscal`
											 ) 
									 VALUES (
									         '$id_nomina','$id_empleado',
											 '$sueldo_diario_imss','0','0',
											 '0','0','0',
											 '0','0',
											 '0','0','0','0',
											 '0',
											 '0'
											 )";	
		
		//realizamos la consulta 
		$consulta = $this->db->prepare($query);
		$consulta->execute();

	}



	public function modificarNomina($_POST){


		try

		{
			$this->db->beginTransaction();
			
			/*****************************************GUARDAMOS DATOS GENERALES***************************************************/
			$id_empresa = $_POST['id_empresa'];
			$id_nomina = $_POST['id_nomina'];		
			$inicio_periodo =  fentrada($_POST['dia_inicio']);
			$fin_periodo =  fentrada($_POST['dia_final']);
			$estado = $_POST['estado'];
			$percepciones = $_POST['inputpercepciones'];
			$honorarios = $_POST['inputhonorarios'];
			$relativos = $_POST['inputrelativos'];
			$subtotal = $_POST['inputsubtotal'];
			$iva = $_POST['inputiva'];
			$total_factura = $_POST['inputfactura'];
			$observaciones = $_POST['observaciones'];
			//guardamos los datos generales
			$query="UPDATE nominas 
			                      set     inicio_periodo='$inicio_periodo', fin_periodo='$fin_periodo', estado='$estado', 
								          percepciones='$percepciones', honorarios='$honorarios', relativos='$relativos', subtotal='$subtotal',
										  iva='$iva', total_factura='$total_factura', observaciones='$observaciones'
								  where id_empresa='$id_empresa'
								  and id_nomina='$id_nomina'";
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();	
			$this->modificarDatosNominaNormalPercepciones($_POST);
			$this->modificarDatosNominaNormalDeducciones($_POST);		
			$this->modificarDatosNominaFiscal($_POST);
			//Realizar todas las acciones
			$this->db->commit();
			}
			catch (PDOException $e) {
				$this->db->rollBack();
				$Mensaje="Insercion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";		
				
							
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript						
				echo "<script>alert('$Mensaje')</script>";
	            
				}

		}


	public function modificarDatosNominaNormalPercepciones($_POST){

		$id_empresa = $_POST['id_empresa'];

		$id_nomina = $_POST['id_nomina'];	
		
		$arrayJSON=(stripslashes($_POST['empleados']));	
		$coded=json_decode($arrayJSON,true);
		
		foreach($coded as $key=>$value)
		{
			
			$id_empleado=$value['idEmpleado'];		
			$sueldo_diario_emp=$value['inputsueldoDiario'];	    
			$dias_trabajados=$value['diasTrabajados']; 
			$total_sueldo=$value['inputSueldoTotal'];
			$horas_extras=$value['inputNumeroHorasExtras']; 
			$total_horas_extras=$value['inputTotalHorasExtras']; 
			$domingos_trabajados=$value['inputNumeroDomingosTrabajados']; 
			$prima_dominical=$value['inputPrimaDominical']; 
			$total_domingos_trabajados=$value['inputTotalDomingosTrabajados'];
			$turnos_trabajados=$value['inputNumeroTurnosTrabajados']; 
			$total_turnos_trabajados=$value['inputTotalTurnosTrabajados'];
			$descanso_trabajado=$value['inputNumeroDescansosTrabajados']; 
			$total_descanso_trabajado=$value['inputTotalDescansosTrabajados']; 
			$dias_festivos=$value['inputNumeroDiasFestivos']; 
			$total_dias_festivos=$value['inputTotalDiasFestivos'];
			$vacaciones=$value['inputNumeroDiasVacaciones']; 
			$prima_vacacional=$value['inputPrimaVacacional'];
			$total_vacaciones=$value['inputTotalVacaciones']; 
			$otras_percepciones=$value['otrasPercepciones']; 
			$complemento_sueldo=$value['complementoSueldo'];  
			$aguinaldo=$value['aguinaldo']; 
			$total_ReciboNomina=$value['inputtotalNominaEmpleado'];
	   
	   $query="UPDATE percepciones_empleado
	                                          set										   
													
												   sueldo_diario_emp='$sueldo_diario_emp',dias_trabajados='$dias_trabajados',total_sueldo='$total_sueldo',
												   
												   domingos_trabajados='$domingos_trabajados',prima_dominical='$prima_dominical',total_domingos_trabajados='$total_domingos_trabajados', 
												   vacaciones='$vacaciones',prima_vacacional='$prima_vacacional',total_vacaciones='$total_vacaciones', 
												   turnos_trabajados='$turnos_trabajados',total_turnos_trabajados='$total_turnos_trabajados', 
												   descanso_trabajado='$descanso_trabajado',total_descanso_trabajado='$total_descanso_trabajado',
												   horas_extras='$horas_extras',total_horas_extras='$total_horas_extras', 
												   dias_festivos='$dias_festivos',total_dias_festivos='$total_dias_festivos',
												   otras_percepciones='$otras_percepciones',complemento_sueldo='$complemento_sueldo',aguinaldo='$aguinaldo',												  
												  
												   total_ReciboNomina='$total_ReciboNomina'
												  where id_nomina='$id_nomina'
												  and id_empleado='$id_empleado'
												  and id_empresa='$id_empresa'											   
												  ";	
		//realizamos la consulta 
		$consulta = $this->db->prepare($query);
		
		$consulta->execute();
		}//for


	}



	public function modificarDatosNominaNormalDeducciones($_POST){

		$id_empresa = $_POST['id_empresa'];

		$id_nomina = $_POST['id_nomina'];	
		
		$arrayJSON=(stripslashes($_POST['empleados']));	
		$coded=json_decode($arrayJSON,true);
		
		foreach($coded as $key=>$value)
		{
			
					
			$id_empleado=$value['idEmpleado'];
			$prestamo=$value['prestamo'];
			$cajaAhorro=$value['cajaAhorro'];
			$otrasDeducciones=$value['inputotrasDeducciones'];
			$fonacot=$value['fonacot'];
			$prestamoNavitas=$value['prestamoNavitas'];
			$infonavit=$value['infonavit'];
			$query="UPDATE deducciones_empleado
			                                   set      													
														prestamos='$prestamo', caja_ahorro='$cajaAhorro', otras_deducciones='$otrasDeducciones', 
														
														fonacot='$fonacot', prestamo_ascon='$prestamoNavitas', infonavit='$infonavit'
											   where
											            id_nomina='$id_nomina' 
											   and		id_empresa='$id_empresa' 
											   and		id_empleado='$id_empleado' ";	
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
		}//for
	}


	public function modificarDatosNominaFiscal($_POST){

		$id_nomina = $_POST['id_nomina'];

		$arrayJSON=(stripslashes($_POST['empleados']));	

		$coded=json_decode($arrayJSON,true);
		
		foreach($coded as $key=>$value){
			
				
			$id_empleado=$value['idEmpleado'];
											
			$sueldo_diario_emp=$value['inputsueldoDiarioFiscal'];	    
			$dias_trabajados=$value['diasTrabajados']; 
			$total_sueldo=$value['inputSueldoTotalImss'];
							
			$domingos_trabajados=$value['inputNumeroDomingosTrabajados']; 
			$prima_dominical=$value['inputPrimaDominicalImss']; 
			$total_domingos_trabajados=$value['inputTotalDomingosTrabajadosImss'];
								
			$vacaciones=$value['inputNumeroDiasVacaciones']; 
			$prima_vacacional=$value['inputPrimaVacacionalImss'];
			$total_vacaciones=$value['inputTotalVacacionesImss']; 	
			$turnos_trabajados=$value['inputNumeroTurnosTrabajados']; 
			$total_turnos_trabajados=$value['inputTotalTurnosTrabajadosImss'];											
			$descanso_trabajado=$value['inputNumeroDescansosTrabajados']; 
			$total_descanso_trabajado=$value['inputTotalDescansosTrabajadosImss']; 
						
			$horas_extras=$value['inputNumeroHorasExtras']; 
			$total_horas_extras=$value['inputTotalHorasExtrasImss']; 	
			$dias_festivos=$value['inputNumeroDiasFestivos']; 
			$total_dias_festivos=$value['inputTotalDiasFestivosImss'];
			$p_premio_por_puntualidad=$value['inputpremioPuntualidad'];
			$p_premio_por_asistencia =$value['inputpremioAsistencia'];
			$p_despensa=$value['inputdespensa'];
			$p_becas_educacionales=$value['inputbecasEducacionales'];
			$aguinaldo=$value['aguinaldo']; 
			$p_subsidio_empleo=$value['inputSUBSIDIO'];				
			$prestamo=$value['prestamo'];
			$cajaAhorro=$value['cajaAhorro'];
			$otrasDeducciones=$value['inputotrasDeducciones'];
			$descripcionOtrasDeducciones=$value['inputdescripcionOtrasDeducciones'];
			$fonacot=$value['fonacot'];
			$infonavit=$value['infonavit'];
			$ISR=$value['inputISR'];
			$IMSS=$value['inputIMSS'];
			$total_ReciboNomina=$value['inputtotalNominaEmpleadoFiscal'];			  
			$query="UPDATE nomina_fiscal
			                             set     p_sueldo_diario='$sueldo_diario_emp', p_dias_trabajados='$dias_trabajados', p_total_sueldo='$total_sueldo', 
												 p_num_domingos_trabajados='$domingos_trabajados', p_prima_dominical='$prima_dominical', p_subtotal_domingos='$total_domingos_trabajados', 
												 p_num_vacaciones='$vacaciones', p_prima_vacacional='$prima_vacacional', p_subtotal_vacaciones='$total_vacaciones',
												 p_num_turnos_trabajados='$turnos_trabajados', p_total_turnos_trabajados='$total_turnos_trabajados', 
												 p_num_descansos_trabajados='$descanso_trabajado', p_total_descansos_trabajados='$total_descanso_trabajado', 
												 p_num_horas_extras='$horas_extras', p_total_horas_extras='$total_horas_extras', 
												 p_num_dias_festivos='$dias_festivos', p_total_dias_festivos='$total_dias_festivos',
												 p_premio_por_puntualidad='$p_premio_por_puntualidad', p_premio_por_asistencia='$p_premio_por_asistencia', p_despensa='$p_despensa', p_becas_educacionales='$p_becas_educacionales',
												 p_aguinaldo='$aguinaldo',  
												 p_subsidio_empleo='$p_subsidio_empleo',
												 
												 d_prestamos='$prestamo', d_caja_ahorro='$cajaAhorro', d_total_otras_deducciones='$otrasDeducciones', d_descripcion_otras_deducciones='$descripcionOtrasDeducciones',
												 d_fonacot='$fonacot',d_infonavit='$infonavit', 
												 d_ISR='$ISR', d_IMSS='$IMSS', 
												 total_nomina_fiscal= '$total_ReciboNomina'
										where    id_nomina='$id_nomina'
										and      id_empleado='$id_empleado' ";	
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
		}//for





	}



	public function eliminarEmpleadoDeNomina($id_empresa,$id_nomina,$id_empleado){

		try{

			$this->db->beginTransaction();
		
			$query = "DELETE FROM percepciones_empleado 
			          WHERE id_empresa= '$id_empresa'
					  AND   id_nomina='$id_nomina'
					  AND   id_empleado= '$id_empleado'";
						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			
			$this->eliminarEmpleadoDeducciones($id_empresa,$id_nomina,$id_empleado);
			$this->eliminarEmpleadoFiscal($id_nomina,$id_empleado);
			//Realizar todas las acciones
			$this->db->commit();
			echo "<script>jAlert('Empleado Eliminado Correctamente')</script>";
				
		}catch (PDOException $e) {	
			    $this->db->rollBack();				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
				}

	}



	public function eliminarEmpleadoDeducciones($id_empresa,$id_nomina,$id_empleado){

			$query = "DELETE FROM deducciones_empleado 

			          WHERE id_empresa= '$id_empresa'
					  AND   id_nomina='$id_nomina'
					  AND   id_empleado= '$id_empleado'";
						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();

	}


	public function eliminarEmpleadoFiscal($id_nomina,$id_empleado){

			$query = "DELETE FROM nomina_fiscal 

			          WHERE id_nomina='$id_nomina'
					  AND   id_empleado= '$id_empleado'";
						
			//realizamos la consulta 
			$consulta = $this->db->prepare($query);
			$consulta->execute();

	}



	public function RECALCULARTotalesXEmpleadoEliminado($id_empresa,$id_nomina){

		try{

			$query="select
			              concat('totales')as total,
						  sum(
							 total_sueldo+
							 total_domingos_trabajados+	
							 total_vacaciones+ 	
							 total_turnos_trabajados+ 	
							 total_descanso_trabajado+
							 total_horas_extras+
							 otras_percepciones+ 
							 complemento_sueldo+ 	
							 total_dias_festivos+									  
							 aguinaldo
							 )as percepciones
							 
							 from 
							 percepciones_empleado pe 
							 inner join deducciones_empleado de on pe.id_empleado=de.id_empleado and pe.id_nomina=de.id_nomina
							 inner join nomina_fiscal nf on pe.id_empleado=nf.id_empleado and pe.id_nomina=nf.id_nomina
							 where pe.id_nomina='$id_nomina'
               group by total
		";
			$consulta = $this->db->prepare($query);
			$consulta->execute();
			return $consulta;
			
		}catch (PDOException $e) {				
				$Mensaje="Seleccion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
		}
	}



	public function modificarTotalesNominaXEmpleadoEliminado($id_empresa,$id_nomina,$percepciones,$honorarios,$relativos,$subtotal,$iva,$total_factura){

		try{

			
			$query="UPDATE nominas 
		                      set     
							          percepciones='$percepciones', honorarios='$honorarios', relativos='$relativos', subtotal='$subtotal',
									  iva='$iva', total_factura='$total_factura'
							  where id_empresa='$id_empresa'
							  and id_nomina='$id_nomina'";
			$consulta = $this->db->prepare($query);
			$consulta->execute();			
		}catch (PDOException $e) {				
				$Mensaje="Actualizacion Erronea:  </br></br>";
				$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			
				$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
				$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
				$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
				echo "<script>jAlert('$Mensaje')</script>";
		}
		
	}

	public function consultarNominasFiscalesEmpleados(){
			//consulta los conceptos de todas las nóminas fiscales de los empleados y suma los importes para generar un reporte dado un rango de fechas
		try {
			
			$query="SELECT   empresas.razon_social AS empresa, empleados.estado AS estado, nomina_fiscal.id_empleado, empleados.nombre, empleados.ap_paterno, empleados.ap_materno, 
			p_sueldo_diario as sueldo_diario, SUM(p_dias_trabajados) as total_dias_trabajados, SUM(p_total_sueldo) as total_sueldo,
SUM(p_num_domingos_trabajados) as num_domingos_trabajados, SUM(p_subtotal_domingos) as sub_domingos, SUM(p_prima_dominical) AS prima_dominical, SUM(p_num_vacaciones) as num_vacaciones, 
SUM(p_subtotal_vacaciones) as sub_vacaciones, SUM(p_prima_vacacional) as prima_vacacional, SUM(p_num_turnos_trabajados) as num_turnos_trabajados,
SUM(p_total_turnos_trabajados) as total_turnos_trabajados, SUM(p_num_descansos_trabajados) as num_descansos_trabajados, 
SUM(p_total_descansos_trabajados) as total_descansos_trabajados, SUM(p_num_horas_extras) AS num_horas_extras,
SUM(p_total_horas_extras) as total_horas_extras, SUM(p_num_dias_festivos) AS num_dias_festivos, SUM(p_total_dias_festivos) AS total_dias_festivos, SUM(p_aguinaldo) AS aguinaldo, 
SUM(p_premio_por_puntualidad) AS premio_por_puntualidad, SUM(p_premio_por_asistencia) AS premio_por_asistencia, SUM(p_despensa) AS despensa, SUM(p_becas_educacionales) AS becas_educacionales, 
SUM(p_subsidio_empleo) AS subsidio_empleo, SUM(d_prestamos) AS prestamos, SUM(d_caja_ahorro) AS caja_ahorro, SUM(d_fonacot) AS fonacot, SUM(d_infonavit) AS infonavit, 
 SUM(d_ISR) as isr, SUM(d_IMSS) as imss,    SUM(d_total_otras_deducciones) AS total_otras_deducciones,    SUM(total_nomina_fiscal) as sum_total_nomina_fiscal 

 				FROM nomina_fiscal
				INNER JOIN empleados ON nomina_fiscal.id_empleado = empleados.id_empleado
                INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado
				INNER JOIN  empresas ON empleados_empresa.id_empresa = empresas.id_empresa

				GROUP BY nomina_fiscal.id_empleado
				ORDER BY empresas.razon_social asc, empleados.estado asc";

			$consulta = $this->db->prepare($query);
			$consulta->execute();

			return $consulta;



			
		} catch (PDOException $e) {
			$mensaje="Error al obtener los datos. Proporcione este mensaje al administrador del sistema: </br></br>";
			$mensaje.="Error (mensaje) capturado:____".$e->getMessage()."</br></br>";
			$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  
			$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";
			$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript		
			echo "<script>jAlert('$Mensaje')</script>";
			
		}
	}




} //fin de la clase
?>