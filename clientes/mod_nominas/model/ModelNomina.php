<?php

//echo "ModelNomina cargado<br/>"; 

class ModelNomina extends ModelBase

{

	

	

	public function consultarEmpresaXUsuario($id_usuario)

	{

		

		try {

			

			$query = "SELECT * FROM empresas WHERE id_usuario='$id_usuario' ";			

			$consulta = $this->db->prepare($query);

            $consulta->execute();

			return $consulta;					

					}

					catch (PDOException $e) {

					   $Mensaje="Insercion Erronea del Articulo:  </br></br>";				  

					   $Mensaje.='Error En la linea:_____'.$e->getLine()."</br></br> ";

					   $Mensaje.='Error capturado:_____'.$e->getMessage()." </br></br> ";

					   echo "<script>jAlert('Error al crear el registro.')</script>";

					}

				





	

		

		}
		
	
	
	public function consultarEmpresasDeUsuario($id_usuario)
	{
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
	
	
	public function consultarUsuario($id_usuario)
	{
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

		

	public function consultarEmpresaXId($id_empresa)

	{

		try {

			

			$query= "SELECT * FROM empresas where id_empresa='$id_empresa'";

			$consulta = $this->db->prepare($query);

            $consulta->execute();

			return $consulta;					

					}

					catch (PDOException $e) {

					   $Mensaje="Consulta Erronea del Articulo:  </br></br>";				  

					   $Mensaje.='Error En la linea:_____'.$e->getLine()."</br></br> ";

					   $Mensaje.='Error capturado:_____'.$e->getMessage()." </br></br> ";

					   echo "<script>jAlert('$Mensaje')</script>";

					}

		

		

			

	

		}

	

	public function consultarNominasXEmpresa($id_empresa)

	{

		try {

			

			$query = "SELECT 

			empresas.razon_social, 

			nominas.id_nomina, 

			nominas.id_empresa, 

			nominas.inicio_periodo, 

			nominas.fin_periodo, 

			nominas.fecha_captura, 

			nominas.estado, 

			nominas.percepciones, 

			nominas.honorarios, 

			nominas.relativos, 

			nominas.subtotal, 

			nominas.iva, 

			nominas.total_factura, 

			nominas.observaciones,

			nominas.tipo_nomina 

			FROM nominas  

			INNER JOIN empresas on empresas.id_empresa= nominas.id_empresa  

			WHERE nominas.id_empresa='$id_empresa' 

			ORDER BY nominas.id_nomina DESC";

			$consulta = $this->db->prepare($query);

            $consulta->execute();

			return $consulta;					

					}

					catch (PDOException $e) {

					   $Mensaje="Insercion Erronea del Articulo:  </br></br>";				  

					   $Mensaje.='Error En la linea:_____'.$e->getLine()."</br></br> ";

					   $Mensaje.='Error capturado:_____'.$e->getMessage()." </br></br> ";

					   echo $Mensaje;

					}

		

	}

	

	public function consultarNominaXId($id_nomina)

	{

		try {

		$query = "SELECT * FROM nominas  WHERE nominas.id_nomina= '$id_nomina'";

		$consulta = $this->db->prepare($query);

		$consulta->execute();

		return $consulta;	

		}

					catch (PDOException $e) {

					   $Mensaje="Insercion Erronea del Articulo:  </br></br>";				  

					   $Mensaje.='Error En la linea:_____'.$e->getLine()."</br></br> ";

					   $Mensaje.='Error capturado:_____'.$e->getMessage()." </br></br> ";

					   echo $Mensaje;

					}

		}

	public function consultarNominaEmpleadosEmpresa($id_nomina,$id_empresa)

	{

		try {

		$query = "

								SELECT 

								percepciones_empleado.*, 

								deducciones_empleado.*, 								

								empleados.nombre, 

								empleados.ap_paterno, 

								empleados.ap_materno, 

								empleados.no_tarjeta, 

								empleados.sueldo_diario_imss

								

								FROM 

								percepciones_empleado

								 

								INNER JOIN deducciones_empleado 

								on  percepciones_empleado.id_empleado= deducciones_empleado.id_empleado	

													

								INNER JOIN empleados 

								on  percepciones_empleado.id_empleado= empleados.id_empleado								

								

								WHERE  percepciones_empleado.id_nomina= '$id_nomina' 

								AND percepciones_empleado.id_empresa= '$id_empresa' 

								AND  deducciones_empleado.id_nomina= '$id_nomina'

								";

								$consulta = $this->db->prepare($query);

								$consulta->execute();

								return $consulta;	

								}

					catch (PDOException $e) {

					   $Mensaje="Insercion Erronea del Articulo:  </br></br>";				  

					   $Mensaje.='Error En la linea:_____'.$e->getLine()."</br></br> ";

					   $Mensaje.='Error capturado:_____'.$e->getMessage()." </br></br> ";

					   echo $Mensaje;

					}

		}

	public function consultarEmpleadosEmpresaXPeriodo($id_empresa,$periodo)

	{

		try {

			$query = "

			SELECT * FROM empleados 

			INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado 

			WHERE empleados_empresa.id_empresa = '$id_empresa' 

			AND periodo_nomina= '$periodo' 

			AND estado= 'ACTIVO'  

			ORDER BY empleados.id_empleado ASC";

			$consulta = $this->db->prepare($query);

			$consulta->execute();

			return $consulta;

			

			}catch (PDOException $e) {

				$Mensaje="Insercion Erronea del Articulo:  </br></br>";				  

				$Mensaje.='Error En la linea:_____'.$e->getLine()."</br></br> ";

				$Mensaje.='Error capturado:_____'.$e->getMessage()." </br></br> ";

				echo $Mensaje;

				}

		}

		

	public function consultarEmpleadosEmpresaPeriodoXImss($id_empresa,$periodo)	

	{

		try {

			$query = "

			SELECT * FROM empleados 

			INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado 

			WHERE   empleados_empresa.id_empresa = '$id_empresa' 

			AND periodo_nomina= '$periodo' 

			AND estado= 'ACTIVO' 

			AND empleados.cuenta_imss='Si' 

			ORDER BY empleados.id_empleado ASC";

			

			$consulta = $this->db->prepare($query);

			$consulta->execute();

			return $consulta;

			

			}catch (PDOException $e) {

				$Mensaje="Insercion Erronea del Articulo:  </br></br>";				  

				$Mensaje.='Error En la linea:_____'.$e->getLine()."</br></br> ";

				$Mensaje.='Error capturado:_____'.$e->getMessage()." </br></br> ";

				echo $Mensaje;

				}

			

		}

		

	public function calcularISR($totalSueldoImss,$tipoNomina)//sueldo{salario} periodo

	{

				

		switch ($tipoNomina)

		{

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

		

		foreach($limites2 as $limites)

		{

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



public function calcularSubsidioEmpleo($totalSueldoImss,$tipoNomina)//sueldo{salario} periodo

{

	switch ($tipoNomina)

	{

		case 'semanal':		/**obtengo el subsidio semanal**/

		$subsidio_result= $this->getLimitesTablaSubsidio2B($totalSueldoImss);

		

		foreach($subsidio_result as $subsidios )

		{

			$subsidio= $subsidios['subsidio_semanal'];				

			}

		break;

		

		case 'quincenal':

		$subsidio_result= $this->getLimitesTablaSubsidio4B($totalSueldoImss);

		foreach($subsidio_result as $subsidios )

		{

			$subsidio=  $subsidios['subsidio_quincenal'];				

			}

		break;

		

		case 'catorcenal':

		$subsidio_result= $this->getLimitesTablaSubsidio4B($totalSueldoImss);

		

		foreach($subsidio_result as $subsidios )

		{

			$subsidio=  $subsidios['subsidio_quincenal'];				

			}

		break;

		

		} //fin switch

		

		return $subsidio;

		

		} //fin funcion











public function calcularIMSS($totalSueldoImssIntegrado,$factorIntegracion,$cuotaTrabajador)

{

	//aqui debe enviarse como parametro el salario diario integrado multiplicado por los dias.  73*7

	$resultado_factor_integracion = $totalSueldoImssIntegrado * $factorIntegracion;

	$IMSS = $resultado_factor_integracion * ($cuotaTrabajador/100);

	

	return $IMSS;

	}

	

public function getLimitesTarifa7Dias($sueldo)

{

	//realizamos la consulta 

	$consulta = $this->db->prepare("

	                               SELECT * FROM tarifa_7_dias

								   WHERE $sueldo BETWEEN limite_inferior AND limite_superior");

	$consulta->execute();

	//devolvemos la coleccion para que la vista la presente.

	return $consulta;

	

	}

		

public function getLimitesTarifa15Dias($sueldo)

{

	//realizamos la consulta 

	$consulta = $this->db->prepare("

	                               SELECT * FROM tarifa_15_dias

								   WHERE $sueldo BETWEEN limite_inferior AND limite_superior");

	$consulta->execute();

	//devolvemos la coleccion para que la vista la presente.

	return $consulta;

	

	}

	

	

public function getLimitesTablaSubsidio2B($sueldo)

{

	//realizamos la consulta 

	$consulta = $this->db->prepare("

	                               SELECT * FROM tabla_subsidio_2b

								   	WHERE $sueldo BETWEEN ingresos_de AND ingresos_hasta");

	$consulta->execute();

	//devolvemos la coleccion para que la vista la presente.

	

	return $consulta;

	

	}

		

public function getLimitesTablaSubsidio4B($sueldo)

{

	//realizamos la consulta 

	$consulta = $this->db->prepare("

	                               SELECT * FROM tabla_subsidio_4b

								   WHERE $sueldo BETWEEN ingresos_de AND ingresos_hasta");

	$consulta->execute();

	//devolvemos la coleccion para que la vista la presente.

	

	return $consulta;

	

	}

	

public function guardarNominaNueva($_POST)

{

	

	try

	{

		$this->db->beginTransaction();

		

		/*****************************************GUARDAMOS DATOS GENERALES***************************************************/

		

		$id_empresa = $_POST['id_empresa'];		

		$periodo = $_POST['tipoNomina'];		

		$inicio_periodo =  fentrada($_POST['inicio_periodo']);

		$fin_periodo =  fentrada($_POST['fin_periodo']);

		

		

		

	

		$fecha_captura = $_POST['fecha_captura'];

		$estado = $_POST['estado'];

		

		$percepciones = $_POST['inputpercepciones'];

		$honorarios = $_POST['inputhonorarios'];

		$relativos = $_POST['inputrelativos'];

		$subtotal = $_POST['inputsubtotal'];

		$iva = $_POST['inputiva'];

		$total_factura = $_POST['inputfactura'];

		$observaciones = $_POST['observaciones'];

		

		//guardamos los datos generales

		$query="INSERT INTO nominas (

		                             id_empresa, inicio_periodo, fin_periodo, fecha_captura, estado, percepciones, honorarios, relativos, subtotal,

									  iva, total_factura, observaciones, tipo_nomina)

							VALUES (

							         '$id_empresa','$inicio_periodo','$fin_periodo','$fecha_captura','$estado','$percepciones','$honorarios','$relativos','$subtotal',

									 '$iva','$total_factura','$observaciones','$periodo')";

		

		//realizamos la consulta 

		$consulta = $this->db->prepare($query);

		$consulta->execute();

		

		$id=$this->db->lastInsertId();

		

		$this->guardarDatosNominaNormalNuevaPercepciones($id,$_POST);

		$this->guardarDatosNominaNormalNuevaDeducciones($id,$_POST);		

		$this->guardarDatosNominaFiscalNueva($id,$_POST);

		

		//Realizar todas las acciones

		$this->db->commit();

		

		echo "<script>jAlert('$inicio_periodo-----$fin_periodo-----Nomina guardada correctamente.')</script>";

		

		}

		catch (PDOException $e) {

			$this->db->rollBack();

			$Mensaje="Insercion Erronea:  </br></br>";

			$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			

			$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  

			$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";		

			

			/*

			$Mensaje.="Error (trace) capturado:_____".$e->getTrace()." </br></br> ";

			$Mensaje.="Error (previous) capturado:_____".$e->getPrevious()." </br></br> ";*no necesario/			

			$Mensaje.="Error (code) capturado:_____".$e->getCode()." </br></br> ";

			$Mensaje.="Error (traceASstring) capturado:_____".$e->getTraceAsString();este marca un error en script por un salto de linea al final de la cadena

			echo "<script>

			jAlert('

			Error (traceASstring) capturado:_____

			#0 C:\xampp\htdocs\navitas\clientes\mod_nominas\model\ModelNomina.php(500): PDOStatement->execute() 

			#1 C:\xampp\htdocs\navitas\clientes\mod_nominas\model\ModelNomina.php(369): ModelNomina->guardarDatosNominaNormalNueva(614, Array) 

			#2 C:\xampp\htdocs\navitas\clientes\mod_nominas\controller\NominaController.php(131): ModelNomina->guardarNominaNueva(Array) 

			#3 C:\xampp\htdocs\navitas\clientes\mod_nominas\libs\php\mvc\FrontControllerNomina.php(104): NominaController->guardarNominaNueva(Array) 

			#4 C:\xampp\htdocs\navitas\AnteFrontController.php(36) : eval()d code(1): FrontControllerNomina::main() 

			#5 C:\xampp\htdocs\navitas\AnteFrontController.php(36): eval() #6 {main} 

			')";

			*/

						

			$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript						

			echo "<script>jAlert('$Mensaje')</script>";

            

			

			}

			

		}

		

public function guardarDatosNominaNormalNuevaPercepciones($id_nomina,$_POST)

{



		$id_nomina=$id_nomina;
		$id_empresa=$_POST['id_empresa'];
		
		
		


		
			
			
		
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

			

			if($total_ReciboNomina!=0){

	   

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

												 

												   '$sueldo_diario_emp','$dias_trabajados','$total_sueldo',

												   

												   '$domingos_trabajados','$prima_dominical','$total_domingos_trabajados',

												   

												   '$vacaciones','$prima_vacacional','$total_vacaciones',

												   

												   '$turnos_trabajados','$total_turnos_trabajados',

												   

												   '$descanso_trabajado','$total_descanso_trabajado',

												   

												   '$horas_extras','$total_horas_extras',

												   

												   '$dias_festivos','$total_dias_festivos',

												   

												   '$otras_percepciones','$complemento_sueldo','$aguinaldo',

												   

												   '$total_ReciboNomina'

												   )";	

	//realizamos la consulta 

	$consulta = $this->db->prepare($query);

	

	

	$consulta->execute();

	

			}

	

	

	

	}//for

	

	

		

	}

	

public function guardarDatosNominaNormalNuevaDeducciones($id_nomina,$_POST)

{

	$id_nomina=$id_nomina;

	$id_empresa=$_POST['id_empresa'];

	

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

		

			$total_ReciboNomina=$value['inputtotalNominaEmpleado'];

			

			if($total_ReciboNomina!=0){

		

		$query="INSERT INTO `deducciones_empleado` (

		                                            `id_nomina`, `id_empresa`, `id_empleado`, 

													

													`prestamos`, `caja_ahorro`, `otras_deducciones`, 

													

													`fonacot`, `prestamo_ascon`, `infonavit`

													) 

											VALUES (

											        '$id_nomina','$id_empresa','$id_empleado',

													

													'$prestamo','$cajaAhorro','$otrasDeducciones',

													

													'$fonacot','$prestamoNavitas','$infonavit'											

											        )";	

		//realizamos la consulta 

		$consulta = $this->db->prepare($query);

		$consulta->execute();

			}

		}//for

}



public function guardarDatosNominaFiscalNueva($id_nomina,$_POST)

{

	$id_nomina=$id_nomina;

	

	$arrayJSON=(stripslashes($_POST['empleados']));	
		$coded=json_decode($arrayJSON,true);
		


		foreach($coded as $key=>$value)
		{
			
		

				

		

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

		

		if($total_ReciboNomina!=0){						  

		

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

											 '$sueldo_diario_emp','$dias_trabajados','$total_sueldo',

											 '$domingos_trabajados','$prima_dominical','$total_domingos_trabajados',

											 '$vacaciones','$prima_vacacional','$total_vacaciones',

											 '$turnos_trabajados','$total_turnos_trabajados',

											 '$descanso_trabajado','$total_descanso_trabajado',

											 '$horas_extras','$total_horas_extras',

											 '$dias_festivos','$total_dias_festivos',

											 '$p_premio_por_puntualidad','$p_premio_por_asistencia ','$p_despensa','$p_becas_educacionales',

											 '$aguinaldo',

											 '$p_subsidio_empleo',

											 

											 '$prestamo','$cajaAhorro','$otrasDeducciones','$descripcionOtrasDeducciones',

											 '$fonacot','$infonavit',

											 '$ISR','$IMSS',

											 '$total_ReciboNomina'

											 )";	

		

		//realizamos la consulta 

		$consulta = $this->db->prepare($query);

		$consulta->execute();

		}

		}//for

	}



public function consultarCorreosUsuarios($id_empresa)

{

	try{

	$query= "SELECT usuarios.correo as correo, usuarios.id_usuario as id_usuario 

	         FROM usuarios_empresas 

			 INNER JOIN usuarios ON usuarios.id_usuario = usuarios_empresas.id_usuario  

			 WHERE usuarios_empresas.id_empresa= $id_empresa";

			 

	//realizamos la consulta 

	$consulta = $this->db->prepare($query);

	$consulta->execute();

	return $consulta;

	}

		catch (PDOException $e) {

			$this->db->rollBack();

			$Mensaje="Insercion Erronea:  </br></br>";

			$Mensaje.="Error (Mensaje) capturado:_____".$e->getMessage()." </br></br> ";			

			$Mensaje.="Error (Archivo) capturado:_____".$e->getFile()." </br></br> ";					   			  

			$Mensaje.="Error ( Linea ) capturado:_____".$e->getLine()."</br></br>";		

			

			/*

			$Mensaje.="Error (trace) capturado:_____".$e->getTrace()." </br></br> ";

			$Mensaje.="Error (previous) capturado:_____".$e->getPrevious()." </br></br> ";*no necesario/			

			$Mensaje.="Error (code) capturado:_____".$e->getCode()." </br></br> ";

			$Mensaje.="Error (traceASstring) capturado:_____".$e->getTraceAsString();este marca un error en script por un salto de linea al final de la cadena

			echo "<script>

			jAlert('

			Error (traceASstring) capturado:_____

			#0 C:\xampp\htdocs\navitas\clientes\mod_nominas\model\ModelNomina.php(500): PDOStatement->execute() 

			#1 C:\xampp\htdocs\navitas\clientes\mod_nominas\model\ModelNomina.php(369): ModelNomina->guardarDatosNominaNormalNueva(614, Array) 

			#2 C:\xampp\htdocs\navitas\clientes\mod_nominas\controller\NominaController.php(131): ModelNomina->guardarNominaNueva(Array) 

			#3 C:\xampp\htdocs\navitas\clientes\mod_nominas\libs\php\mvc\FrontControllerNomina.php(104): NominaController->guardarNominaNueva(Array) 

			#4 C:\xampp\htdocs\navitas\AnteFrontController.php(36) : eval()d code(1): FrontControllerNomina::main() 

			#5 C:\xampp\htdocs\navitas\AnteFrontController.php(36): eval() #6 {main} 

			')";

			*/

						

			$Mensaje=str_replace("'","",$Mensaje);//eliminamos comillas simples,que causan problemas en javascript						

			echo "<script>jAlert('$Mensaje')</script>";

            

			

			}

	}

	

	



		

}

?>

