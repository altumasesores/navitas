<?php 
	include_once("../Connections/dbConexion.php");  //Llamamos la conexion a la base de datos
	include_once("../getSQLValueString.php"); 

	$con= new dbConexion();
	
	$tipo_nomina=$_POST['tipo_nomina'];
	
	
	
	
	        $id_nomina= $_POST['id_nomina'];
			$id_empresa= $_POST['id_empresa'];
			$id_empleado= $_POST['id_empleado'];
			$sueldo_diario= $_POST['sueldo_diario'];
			$sueldo_integgrado= $_POST['sueldo_integrado'];
			$dias_trabajados= $_POST['dias_trabajados'];
			$total_sueldo= $_POST['total_sueldo'];
			$total_horas_extras= $_POST['total_horas_extras'];
			/**/$total_domingos= $_POST['total_domingos'];
			$total_turnos= $_POST['total_turnos'];
			$total_descansos= $_POST['total_descansos'];
			$total_festivos= $_POST['total_festivos'];
			/**/$total_vacaciones= $_POST['total_vacaciones'];
			$complemento_sueldo= $_POST['complemento_sueldo'];
			$otras_percepciones= $_POST['otras_percepciones'];
			
			
		
			
			
		
			
			$cantidad_hora= $_POST['cantidad_hora'];
			$cantidad_domingo= $_POST['cantidad_domingo'];
			$cantidad_turno= $_POST['cantidad_turno'];
			$cantidad_descanso= $_POST['cantidad_descanso'];
			$cantidad_festivo= $_POST['cantidad_festivo'];
			$cantidad_vacaciones= $_POST['cantidad_vacaciones'];
			
			
			$aguinaldo= $_POST['aguinaldo'];
            /**/$prima_vacacional= $_POST['prima_vacacional'];
            /**/$prima_dominical= $_POST['prima_dominical'];
			
			$prestamos= $_POST['prestamos'];
			$caja_ahorro= $_POST['caja_ahorro'];
			$fonacot= $_POST['fonacot'];
			$infonavit= $_POST['infonavit'];
			$otras_deducciones= $_POST['otras_deducciones'];
			$desc_otras_deducciones= $_POST['desc_ot_deducciones'];
			$prestamo_ascon= $_POST['prestamo_ascon'];
			
	
	//Recibo las variables de la nomina
	
	if($con->conectar()==true){	
	
	if($tipo_nomina=="normal"){
	
	
	
			
		

			
			//Guardo las percepciones
			$insertPercepciones = sprintf("
			INSERT INTO percepciones_empleado 
			(
			id_nomina, 
			id_empresa, 
			id_empleado, 
			sueldo_diario_emp, 
			dias_trabajados, 
			total_sueldo, 
			total_horas_extras, 
			total_domingos_trabajados, 
			total_turnos_trabajados, 
			total_descanso_trabajado, 
			total_dias_festivos, 
			total_vacaciones, 
			complemento_sueldo, 
			otras_percepciones,
			aguinaldo,
			prima_vacacional,
			prima_dominical,
			domingos_trabajados,
			vacaciones,
			turnos_trabajados,
			descanso_trabajado,
			horas_extras,
			dias_festivos
			) VALUES 
			(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($id_nomina, "int"),
                       GetSQLValueString($id_empresa, "int"),
                       GetSQLValueString($id_empleado, "int"),
                       GetSQLValueString($sueldo_diario, "double"),
					   GetSQLValueString($dias_trabajados, "double"),
					   GetSQLValueString($total_sueldo, "double"),
					   GetSQLValueString($total_horas_extras, "double"),
					   GetSQLValueString($total_domingos, "double"),
					   GetSQLValueString($total_turnos, "double"),
					   GetSQLValueString($total_descansos, "double"),
					   GetSQLValueString($total_festivos, "double"),
					   GetSQLValueString($total_vacaciones, "double"),
					   GetSQLValueString($complemento_sueldo, "double"),
					   GetSQLValueString($otras_percepciones, "double"),
					   GetSQLValueString($aguinaldo, "double"),
					   GetSQLValueString($prima_vacacional, "double"),
					   GetSQLValueString($prima_dominical, "double"),
					   GetSQLValueString($cantidad_domingo, "double"),
					   GetSQLValueString($cantidad_vacaciones, "double"),
					   GetSQLValueString($cantidad_turno, "double"),
					   GetSQLValueString($cantidad_descanso, "double"),
					   GetSQLValueString($cantidad_hora, "double"),
					   GetSQLValueString($cantidad_festivo, "double") ); 
	
		  $resultPercepciones = mysql_query($insertPercepciones);	
		  
		 


			//Guarda las deducciones
			$insertDeducciones = sprintf("INSERT INTO deducciones_empleado (id_nomina, id_empresa, id_empleado, prestamos, caja_ahorro, fonacot, otras_deducciones, prestamo_ascon, infonavit) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($id_nomina, "int"),
                       GetSQLValueString($id_empresa, "int"),
                       GetSQLValueString($id_empleado, "int"),
                       GetSQLValueString($prestamos, "double"),
					   GetSQLValueString($caja_ahorro, "double"),
					   GetSQLValueString($fonacot, "double"),
					   GetSQLValueString($otras_deducciones, "double"),
					   GetSQLValueString($prestamo_ascon, "double"),
					   GetSQLValueString($infonavit, "double")); 
	
		  $resultDeducciones = mysql_query($insertDeducciones);
		  
		  
		  
		  echo $id_empleado;
		  
		  
		}else{
			/**********************************BLOQUE DISTRIBUCION OTRAS PERCEPCIONES***********************************/
				if($otras_percepciones>0)
			{
				$sueldo_integrado=$sueldo_integgrado*$dias_trabajados;
				$limite_aplicar=$sueldo_integrado*.10;
				$salario_df=59.82;
				$salario_df_total=($salario_df*.4)*$dias_trabajados;
				if($otras_percepciones<=$limite_aplicar){
					    $p_premio_por_puntualidad=$otras_percepciones;
						$p_premio_por_asistencia=0; 
						$p_despensa=0;
                        $p_becas_educacionales=0;
					
					}else{
						$p_premio_por_puntualidad=$limite_aplicar;
						$otras_percepciones=$otras_percepciones-$limite_aplicar;
						
						
						
						if($otras_percepciones<=$limite_aplicar){
							$p_premio_por_asistencia=$otras_percepciones; 
							$despensa=0;
                            $p_becas_educacionales=0;
							}else{
							$p_premio_por_asistencia=$limite_aplicar;
							$otras_percepciones=$otras_percepciones-$limite_aplicar; 							
							
							if($otras_percepciones>0)
							{
								
								
								
							if($otras_percepciones>$salario_df_total){
								
							$despensa=$salario_df_total;
							$otras_percepciones=$otras_percepciones-$salario_df_total;
							$p_becas_educacionales=$otras_percepciones;
							}else{
								$despensa=$otras_percepciones;
								$p_becas_educacionales=0;
								}
								
								
								
								}
								else
								{
								$despensa=0;
							    $p_becas_educacionales=0;
									}
							
                            
							}
						
						
						
						
						}
				
				
				
				}
				else
				{
					    $p_premio_por_puntualidad=0;
						$p_premio_por_asistencia=0; 
						$despensa=0;
                        $p_becas_educacionales=0;
				}
				
				/****************************DISTRIBUCION OTRAS PERCEPCIONES*******************************************/
				
				
				
		  /**********************BLOQUE EN PROCESO con valores que aun no tengo especificados**************************/
						
						$subsidio_empleo=0;
					    $d_ISR=0;
					    $d_IMSS=0;                        
					    $total_nomina_fiscal=0;
						
     	 /******************************************************************/
		  
		  
		 
		  
		  
		  //Guardo las percepciones
			$insertNominaFiscal = sprintf("
			INSERT INTO nomina_fiscal
			(
			  id_nomina, 
			  id_empleado, 
			  p_sueldo_diario, 
			  p_dias_trabajados, 
			  p_total_sueldo, 
			  p_num_domingos_trabajados, 
			  p_subtotal_domingos, 
			  p_prima_dominical, 
			  p_num_vacaciones, 
			  p_subtotal_vacaciones, 
			  p_prima_vacacional, 
			  p_num_turnos_trabajados, 
			  p_total_turnos_trabajados, 
			  p_num_descansos_trabajados, 
			  p_total_descansos_trabajados, 
			  p_num_horas_extras, 
			  p_total_horas_extras, 
			  p_num_dias_festivos, 
			  p_total_dias_festivos, 
			  p_aguinaldo, 
			  p_premio_por_puntualidad, 
			  p_premio_por_asistencia, 
			  p_despensa,
			  p_becas_educacionales, 
			  p_subsidio_empleo, 
			  d_prestamos, 
			  d_caja_ahorro, 
			  d_fonacot, 
			  d_infonavit, 
			  d_ISR, 
			  d_IMSS, 
			  d_descripcion_otras_deducciones, 
			  d_total_otras_deducciones, 
			  total_nomina_fiscal
			  ) 
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",

					  
					   GetSQLValueString($id_nomina, "int"),					  
					   GetSQLValueString($id_empleado, "int"),
                       GetSQLValueString($sueldo_diario, "double"),
                       GetSQLValueString($dias_trabajados, "double"),
                       GetSQLValueString($total_sueldo, "double"),
					    GetSQLValueString($cantidad_domingo, "double"),
						GetSQLValueString($total_domingos, "double"),
						 GetSQLValueString($prima_dominical, "double"),
						 GetSQLValueString($cantidad_vacaciones, "double"),
						 GetSQLValueString($total_vacaciones, "double"),
						 GetSQLValueString($prima_vacacional, "double"),
						  GetSQLValueString($cantidad_turno, "double"),
						   GetSQLValueString($total_turnos, "double"),
						   GetSQLValueString($cantidad_descanso, "double"),
						   GetSQLValueString($total_descansos, "double"),
						    GetSQLValueString($cantidad_hora, "double"),			   
					   GetSQLValueString($total_horas_extras, "double"),
					   GetSQLValueString($cantidad_festivo, "double"),
                       GetSQLValueString($total_festivos, "double"),
					   GetSQLValueString($aguinaldo, "double"),
					   
					   GetSQLValueString($p_premio_por_puntualidad, "double"),
                       GetSQLValueString($p_premio_por_asistencia, "double"),
					   GetSQLValueString($despensa, "double"),
                       GetSQLValueString($p_becas_educacionales, "double"),
					   
					   GetSQLValueString($subsidio_empleo, "double"),
					   GetSQLValueString($prestamos, "double"),
					   GetSQLValueString($caja_ahorro, "double"),
					   GetSQLValueString($fonacot, "double"),
					   GetSQLValueString($infonavit, "double"),
					   
					   GetSQLValueString($d_ISR, "double"),
					   GetSQLValueString($d_IMSS, "double"),					   
                       GetSQLValueString($desc_otras_deducciones, "text"), 
					   
					   GetSQLValueString($otras_deducciones, "double"),
					   
					   GetSQLValueString($total_nomina_fiscal, "double"));
	
		  $resultNominaFiscal = mysql_query($insertNominaFiscal);	
		  
		  
echo $id_empleado;
		
                      
	}
	
	}
	
	
	
	
?>