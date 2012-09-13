<?php 
include_once("../getSQLValueString.php");
include_once("../Connections/dbConexion.php");  //Llamamos la conexion a la base de datos
		
//implementamos la clase cEmpleado
class cReportes{		
		
	function consultar_nominas(){        //Metodo para consultar las nominas de todas las empresas
	
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query = "SELECT nominas.id_nomina, nominas.id_empresa, sum(nominas.percepciones) as percepciones, sum(nominas.honorarios) as honorarios, sum(nominas.relativos)as relativos, sum(nominas.subtotal) as subtotal,sum(nominas.iva) as iva, sum(nominas.total_factura) as total_factura, empresas.razon_social FROM nominas inner join empresas on nominas.id_empresa = empresas.id_empresa where nominas.estado= 'PAGADA' group by nominas.id_empresa ";
			$resultado = mysql_query($query); 	 
		
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
		} 
                function nombreempresa($empresa){        //Metodo para consultar las nominas de todas las empresas
	
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query = "SELECT razon_social FROM empresas WHERE id_empresa=$empresa ";
			$resultado = mysql_query($query); 	 
		
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
		} 		
		
		/* function consultar_nominas_($id_empresa, $dia_inicio, $dia_final){        //Metodo para consultar las nominas de todas las empresas
	
		$con= new dbConexion();
			//AND nominas.estado =  'PAGADA'
			
			if($con->conectar()==true){	
			if($id_empresa!='todas'){
			$query = "SELECT empresas.razon_social, SUM( total_sueldo ), SUM( total_horas_extras ), SUM( total_domingos_trabajados ), SUM(total_turnos_trabajados), SUM(total_descanso_trabajado), SUM( total_dias_festivos ), SUM( total_vacaciones ), SUM( complemento_sueldo ), SUM( otras_percepciones ), SUM( prestamos ), SUM( caja_ahorro ), SUM( fonacot ), SUM( infonavit ), SUM( otras_deducciones ), SUM( prestamo_ascon )  
						FROM nominas
						INNER JOIN empresas ON nominas.id_empresa = empresas.id_empresa
						INNER JOIN percepciones_empleado ON nominas.id_nomina = percepciones_empleado.id_nomina
						INNER JOIN deducciones_empleado ON nominas.id_nomina = deducciones_empleado.id_nomina
						WHERE nominas.id_empresa = '$id_empresa' AND nominas.inicio_periodo
						BETWEEN  '$dia_inicio'
						AND  '$dia_final'
						AND nominas.fin_periodo <=  '$dia_final'
						";
			$resultado = mysql_query($query); 
			}
			else{
			$query = "SELECT empresas.razon_social, SUM( total_sueldo ), SUM( total_horas_extras ), SUM( total_domingos_trabajados ), SUM(total_turnos_trabajados), SUM(total_descanso_trabajado), SUM( total_dias_festivos ), SUM( total_vacaciones ), SUM( complemento_sueldo ), SUM( otras_percepciones ), SUM( prestamos ), SUM( caja_ahorro ), SUM( fonacot ), SUM( infonavit ), SUM( otras_deducciones ), SUM( prestamo_ascon )   
						FROM nominas
						INNER JOIN empresas ON nominas.id_empresa = empresas.id_empresa
						INNER JOIN percepciones_empleado ON nominas.id_nomina = percepciones_empleado.id_nomina
						INNER JOIN deducciones_empleado ON nominas.id_nomina = deducciones_empleado.id_nomina
						WHERE nominas.inicio_periodo
						BETWEEN  '$dia_inicio'
						AND  '$dia_final'
						AND nominas.fin_periodo <=  '$dia_final'
						group by nominas.id_empresa";
			$resultado = mysql_query($query); 
			}
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
		}
 */
 
        function consultar_nominas_($id_empresa, $dia_inicio, $dia_final,$cadena,$cadena2){        //Metodo para consultar las nominas de todas las empresas
	
		$con= new dbConexion();
			//AND nominas.estado =  'PAGADA'
			
			if($con->conectar()==true){	
			if($id_empresa!='todas'){
			$query = "SELECT empresas.id_empresa, empresas.razon_social$cadena2
						FROM nominas
						INNER JOIN empresas ON nominas.id_empresa = empresas.id_empresa
						INNER JOIN percepciones_empleado ON nominas.id_nomina = percepciones_empleado.id_nomina
						WHERE nominas.id_empresa = '$id_empresa' AND (nominas.estado='PAGADA' OR nominas.estado='AUTORIZADA')$cadena AND nominas.fecha_captura BETWEEN  '$dia_inicio' AND  '$dia_final'						
						";
			$resultado = mysql_query($query); 
			}
			else{
                            $query = "SELECT empresas.id_empresa, empresas.razon_social$cadena2
						FROM nominas
						INNER JOIN empresas ON nominas.id_empresa = empresas.id_empresa
						INNER JOIN percepciones_empleado ON nominas.id_nomina = percepciones_empleado.id_nomina
						WHERE nominas.fecha_captura BETWEEN  '$dia_inicio' AND  '$dia_final' AND (nominas.estado='PAGADA' OR nominas.estado='AUTORIZADA')$cadena
						group by nominas.id_empresa";
			$resultado = mysql_query($query); 
			}
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
            }
            function consultar_nominas_empresa($NominasEmpresa,$dia_inicio,$dia_final,$cadena,$cadena2){        //Metodo para consultar las nominas de todas las empresas
	
		$con= new dbConexion();
                
			if($con->conectar()==true){	
			if($NominasEmpresa!='todas'){
			$query = "SELECT nominas.id_nomina,nominas.inicio_periodo,nominas.fin_periodo$cadena2
                                                FROM nominas
                                                INNER JOIN empresas ON nominas.id_empresa = empresas.id_empresa
						INNER JOIN percepciones_empleado ON nominas.id_nomina = percepciones_empleado.id_nomina
						WHERE nominas.id_empresa = '$NominasEmpresa' AND (nominas.estado='PAGADA' OR nominas.estado='AUTORIZADA') $cadena AND nominas.fecha_captura BETWEEN  '$dia_inicio' AND  '$dia_final' group by nominas.id_nomina";
                                                 $resultado = mysql_query($query); 
                         
			}
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
            }
            function consultar_nominas_empleados($NominasEmpresa,$idNomina,$cadena,$cadena2,$cadena3){
            	$con= new dbConexion();
                
			if($con->conectar()==true){	
			if($NominasEmpresa!='todas'){
			$query = "SELECT percepciones_empleado.id_empleado,empleados.ap_paterno,empleados.ap_materno,empleados.nombre$cadena2
                                                FROM percepciones_empleado 
                                                INNER JOIN empleados ON percepciones_empleado.id_empleado = empleados.id_empleado
						WHERE percepciones_empleado.id_empresa = '$NominasEmpresa' AND percepciones_empleado.id_nomina = '$idNomina' $cadena 
                                                UNION
                                                SELECT 0,0,0,0$cadena3
                                                FROM percepciones_empleado 
                                                INNER JOIN empleados ON percepciones_empleado.id_empleado = empleados.id_empleado
						WHERE percepciones_empleado.id_empresa = '$NominasEmpresa' AND percepciones_empleado.id_nomina = '$idNomina' $cadena 
                                                ";
                                                 $resultado = mysql_query($query); 
                         
			}
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
            }
            
            function consultar_nominas_empleados_deduc($NominasEmpresa,$idNomina,$cadena,$cadena2,$cadena3){
            	$con= new dbConexion();
                
			if($con->conectar()==true){	
			if($NominasEmpresa!='todas'){
			$query = "SELECT deducciones_empleado.id_empleado,empleados.ap_paterno,empleados.ap_materno,empleados.nombre$cadena2
                                                FROM deducciones_empleado
                                                INNER JOIN empleados ON deducciones_empleado.id_empleado = empleados.id_empleado
						WHERE deducciones_empleado.id_empresa = '$NominasEmpresa' AND deducciones_empleado.id_nomina = '$idNomina' $cadena
                                                UNION 
                                                SELECT 0,0,0,0$cadena3
                                                FROM deducciones_empleado
                                                INNER JOIN empleados ON deducciones_empleado.id_empleado = empleados.id_empleado
						WHERE deducciones_empleado.id_empresa = '$NominasEmpresa' AND deducciones_empleado.id_nomina = '$idNomina' $cadena";
                                                 $resultado = mysql_query($query); 
                         
			}
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
            }
		
		 function consultar_nominas_Deducciones($id_empresa, $dia_inicio, $dia_final,$cadena3,$cadena4){        //Metodo para consultar las nominas de todas las empresas
	
		$con= new dbConexion();
			//AND nominas.estado =  'PAGADA'	
			if($con->conectar()==true){	
			if($id_empresa!='todas'){
			$query = "SELECT empresas.id_empresa, empresas.razon_social$cadena4, 0, 0, 0
						FROM nominas
						INNER JOIN empresas ON nominas.id_empresa = empresas.id_empresa
						INNER JOIN deducciones_empleado ON nominas.id_nomina = deducciones_empleado.id_nomina
						WHERE nominas.id_empresa = '$id_empresa' AND (nominas.estado='PAGADA' OR nominas.estado='AUTORIZADA')$cadena3 AND nominas.fecha_captura BETWEEN  '$dia_inicio' AND  '$dia_final'
						";
			$resultado = mysql_query($query); 
			}
			else{
			$query = "SELECT empresas.id_empresa, empresas.razon_social$cadena4, 0, 0, 0
						FROM nominas
						INNER JOIN empresas ON nominas.id_empresa = empresas.id_empresa
						INNER JOIN deducciones_empleado ON nominas.id_nomina = deducciones_empleado.id_nomina
						WHERE nominas.fecha_captura BETWEEN  '$dia_inicio' AND  '$dia_final' AND (nominas.estado='PAGADA' OR nominas.estado='AUTORIZADA')$cadena3
						group by nominas.id_empresa";
			$resultado = mysql_query($query); 
			}
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
		}
                function nominas_empresa_deducciones($NominasEmpresa,$dia_inicio,$dia_final,$cadena,$cadena2){        //Metodo para consultar las nominas de todas las empresas
	
		$con= new dbConexion();
                
			if($con->conectar()==true){	
			if($NominasEmpresa!='todas'){
                                    $query = "SELECT nominas.id_nomina,nominas.inicio_periodo,nominas.fin_periodo$cadena2
						FROM nominas
                                                INNER JOIN empresas ON nominas.id_empresa = empresas.id_empresa
						INNER JOIN deducciones_empleado ON nominas.id_nomina = deducciones_empleado.id_nomina
						WHERE nominas.id_empresa = '$NominasEmpresa' AND (nominas.estado='PAGADA' OR nominas.estado='AUTORIZADA') $cadena AND nominas.fecha_captura BETWEEN  '$dia_inicio' AND  '$dia_final' group by nominas.id_nomina";
                                                $resultado = mysql_query($query); 
                                                 
                         
			}
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
                }

	function consultar_empleados_activos(){        //Metodo para consultar los empleados activos
	
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query = "SELECT empleados.*, empresas.razon_social FROM empleados, empleados_empresa, empresas  where empleados.id_empleado= empleados_empresa.id_empleado and empleados_empresa.id_empresa= empresas.id_empresa  and empleados.estado= 'ACTIVO' order by empleados.nombre";
			$resultado = mysql_query($query); 	 
		
			if (!$resultado)
				return false; 								
			else								
				return $resultado;					
				
			}
		}		

		
}//termina la clase cReportes


?>