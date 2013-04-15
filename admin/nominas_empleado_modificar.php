<?php 

	//EN ESTE SCRIPT MODIFICO LOS DATOS DE LA NOMINA, PERCEPCIONES Y DEDUCCIONES DEL EMPLEADO





	include_once("../Connections/dbConexion.php");  //Llamamos la conexion a la base de datos

	include_once("../getSQLValueString.php"); 



	$con= new dbConexion();

	

	

	//Recibo las variables de la nomina

	

	$tipo_nomina=$_POST['tipo_nomina'];

	

	

	

	

	        $id_nomina= $_POST['id_nomina'];

			$id_empresa= $_POST['id_empresa'];

			$id_empleado= $_POST['id_empleado'];

			$sueldo_diario= $_POST['sueldo_diario'];

			$sueldo_integgrado= $_POST['sueldo_integrado'];

			$dias_trabajados= $_POST['dias_trabajados'];

			$total_sueldo= $_POST['total_sueldo'];

			$total_horas_extras= $_POST['total_horas_extras'];

			$total_domingos= $_POST['total_domingos'];

			$total_turnos= $_POST['total_turnos'];

			$total_descansos= $_POST['total_descansos'];

			$total_festivos= $_POST['total_festivos'];

			$total_vacaciones= $_POST['total_vacaciones'];

			$complemento_sueldo= $_POST['complemento_sueldo'];

			$otras_percepciones= $_POST['otras_percepciones'];

			

			

		

			

			

		

			

			$cantidad_hora= $_POST['cantidad_hora'];

			$cantidad_domingo= $_POST['cantidad_domingo'];

			$cantidad_turno= $_POST['cantidad_turno'];

			$cantidad_descanso= $_POST['cantidad_descanso'];

			$cantidad_festivo= $_POST['cantidad_festivo'];

			$cantidad_vacaciones= $_POST['cantidad_vacaciones'];

			

			

			$aguinaldo= $_POST['aguinaldo'];

            $prima_vacacional= $_POST['prima_vacacional'];

            $prima_dominical= $_POST['prima_dominical'];

			

			$prestamos= $_POST['prestamos'];

			$caja_ahorro= $_POST['caja_ahorro'];

			$fonacot= $_POST['fonacot'];

			$infonavit= $_POST['infonavit'];

			$otras_deducciones= $_POST['otras_deducciones'];

			$desc_otras_deducciones= $_POST['desc_ot_deducciones'];

			$prestamo_ascon= $_POST['prestamo_ascon'];

	

	

		if($con->conectar()==true){	

		

		$con -> iniciar_transaccion_bd();

	

	if($tipo_nomina=="normal"){

			

			

			

			





		

			//Guardo las percepciones

			 $updatePercepciones = sprintf("UPDATE percepciones_empleado SET sueldo_diario_emp=%s, dias_trabajados=%s, total_sueldo=%s, total_horas_extras=%s, total_domingos_trabajados=%s, total_turnos_trabajados=%s, total_descanso_trabajado=%s,total_dias_festivos=%s, total_vacaciones=%s, complemento_sueldo=%s, otras_percepciones=%s,aguinaldo=%s,prima_dominical=%s,prima_vacacional=%s,domingos_trabajados=%s,vacaciones=%s,turnos_trabajados=%s,descanso_trabajado=%s,horas_extras=%s,dias_festivos=%s      WHERE id_nomina=%s AND id_empresa= %s AND id_empleado= %s",

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

					   GetSQLValueString($prima_dominical, "double"),

					   GetSQLValueString($prima_vacacional, "double"),

					   GetSQLValueString($cantidad_domingo, "double"),

					   GetSQLValueString($cantidad_vacaciones, "double"),

					   GetSQLValueString($cantidad_turno, "double"),

					   GetSQLValueString($cantidad_descanso, "double"),

					   GetSQLValueString($cantidad_hora, "double"),

					   GetSQLValueString($cantidad_festivo, "double"),

					   GetSQLValueString($id_nomina, "int"),

					   GetSQLValueString($id_empresa, "int"),

					   GetSQLValueString($id_empleado, "int")

					   );

			

			  $resultPercepciones = mysql_query($updatePercepciones);   		

			

			

			

 

	

			  



			$updateDeducciones = sprintf("UPDATE deducciones_empleado SET  deducciones_empleado.prestamos=%s, deducciones_empleado.caja_ahorro=%s, deducciones_empleado.fonacot=%s, deducciones_empleado.otras_deducciones=%s, deducciones_empleado.prestamo_ascon=%s, deducciones_empleado.infonavit= %s   WHERE deducciones_empleado.id_nomina=%s AND deducciones_empleado.id_empresa= %s AND deducciones_empleado.id_empleado= %s",                       

					   GetSQLValueString($prestamos, "double"),

                       GetSQLValueString($caja_ahorro, "double"),

                       GetSQLValueString($fonacot, "double"),

					   GetSQLValueString($otras_deducciones, "double"),

					   GetSQLValueString($prestamo_ascon, "double"),			

					   GetSQLValueString($infonavit, "double"),

					   GetSQLValueString($id_nomina, "int"),

					   GetSQLValueString($id_empresa, "int"), 

					   GetSQLValueString($id_empleado, "int"));

			

			  $resultDeducciones = mysql_query($updateDeducciones); 

			  

			   if (!$resultPercepciones || !$resultDeducciones) {

				$con -> cancelar_transaccion_bd();

				//cancela una transaccion y regresa la base de datos a su estado original

				echo "nomina normal";

			} else {

				$con -> ejecutar_transaccion_bd();

				//ejecuta las consultas de una transaccion a la base de datos

				echo $id_empleado;

			}

			  

		  

		  

		}else{

			

				/**********************************BLOQUE DISTRIBUCION OTRAS PERCEPCIONES***********************************/

			/* 	if($otras_percepciones>0)

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

				

				

				

				} */

					if($otras_percepciones>0)

			{

				



				$sueldo_integrado=$sueldo_integgrado*$dias_trabajados;

				$limite_aplicar=$sueldo_integrado*.10;

				$salario_df= 64.76;

				$salario_df_total=($salario_df*.4)*$dias_trabajados;

				/*yo if($otras_percepciones<=$limite_aplicar){

					    $p_premio_por_puntualidad=$otras_percepciones;

						$p_premio_por_asistencia=0; 

						$p_despensa=0;

                        $p_becas_educacionales=0;

					

					}else{

						$p_premio_por_puntualidad=$limite_aplicar;

						$otras_percepciones=$otras_percepciones-$limite_aplicar;

						 */

						

						

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

		  

			  

			  $updateNominaFiscal = sprintf("

UPDATE nomina_fiscal SET 



p_sueldo_diario=%s, 

p_dias_trabajados=%s, 

p_total_sueldo=%s, 

p_num_domingos_trabajados=%s, 

p_subtotal_domingos=%s, 

p_prima_dominical=%s, 

p_num_vacaciones=%s,

p_subtotal_vacaciones=%s, 

p_prima_vacacional=%s, 

p_num_turnos_trabajados=%s,

p_total_turnos_trabajados=%s,

p_num_descansos_trabajados=%s, 

p_total_descansos_trabajados=%s, 

p_num_horas_extras=%s, 

p_total_horas_extras=%s, 

p_num_dias_festivos=%s,

p_total_dias_festivos=%s,

p_aguinaldo=%s, 

p_premio_por_puntualidad=%s,

p_premio_por_asistencia=%s, 

p_despensa=%s,

p_becas_educacionales=%s, 

p_subsidio_empleo=%s, 

d_prestamos=%s, 

d_caja_ahorro=%s, 

d_fonacot=%s, 

d_infonavit=%s, 

d_ISR=%s,

d_IMSS=%s, 

d_descripcion_otras_deducciones=%s, 

d_total_otras_deducciones=%s,

total_nomina_fiscal=%s

WHERE id_nomina=%s AND  id_empleado=%s",

                       

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

					   

					   GetSQLValueString($total_nomina_fiscal, "double"),

					    GetSQLValueString($id_nomina, "int"),					  

					   GetSQLValueString($id_empleado, "int"));

	

			

			  $resultPercepciones = mysql_query($updateNominaFiscal);   	  

		



	 if (!$resultPercepciones) {

				$con -> cancelar_transaccion_bd();

				//cancela una transaccion y regresa la base de datos a su estado original

				echo "nomina fiscal";

			} else {

				$con -> ejecutar_transaccion_bd();

				//ejecuta las consultas de una transaccion a la base de datos

				echo $id_empleado;

			}

			

	

}

		





		}



?>