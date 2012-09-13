<?php

include_once ("../Connections/dbConexion.php");
/*
require_once '../libs/php/autoload/autoload.php';
require_once('../libs/php/mvc/ConfigBD.php');
include_once("../funcion_redondear.php");
require_once '../admin/mod_calculos/model/guardar_nominaAntigua_a_FiscalNueva_class.php';
//Llamamos la conexion a la base de datos
*/
class cNomina {

	function consultar() {//Metodo para consultar todas las nominas
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			$query_nominas = "SELECT * FROM nominas INNER JOIN empresas on empresas.id_empresa= nominas.id_empresa ORDER BY nominas.id_nomina DESC";
			$nominas = mysql_query($query_nominas);

			if (!$nominas)
				return false;
			else
				return $nominas;

		}
	}

	function consultar_nominas_estado($estado) {//Metodo para consultar todas las nominas
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			$query_nominas = "SELECT 
			empresas.razon_social, nominas.id_nomina, nominas.id_empresa, nominas.inicio_periodo, nominas.fin_periodo, nominas.fecha_captura, 
			nominas.estado, nominas.percepciones, nominas.honorarios, nominas.relativos, nominas.subtotal, nominas.iva, nominas.total_factura, 
			nominas.observaciones, nominas.tipo_nomina FROM nominas INNER JOIN empresas on empresas.id_empresa= nominas.id_empresa 
			where estado= '$estado' ORDER BY nominas.id_nomina DESC";
			$nominas = mysql_query($query_nominas);

			if (!$nominas)
				return false;
			else
				return $nominas;

		}
	}

	function consultar_nomina($id_nomina) {//Metodo para consultar todas las nominas por empresa
	//movido a mvc [cargar_nomina.php]
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			//$query_nominas = "SELECT * FROM nominas INNER JOIN empresas on empresas.id_empresa= nominas.id_empresa WHERE nominas.id_empresa= $id_empresa ORDER BY fecha_captura ASC";
			$query_nominas = "SELECT * FROM nominas  WHERE nominas.id_nomina= $id_nomina";
			$nominas = mysql_query($query_nominas);

			if (!$nominas)
				return false;
			else
				return $nominas;

		}
	}

	function consultar_nominas_empresa($id_empresa) {//Metodo para consultar todas las nominas por empresa
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			//$query_nominas = "SELECT * FROM nominas INNER JOIN empresas on empresas.id_empresa= nominas.id_empresa WHERE nominas.id_empresa= $id_empresa ORDER BY fecha_captura ASC";
			$query_nominas = "SELECT 
			empresas.razon_social, nominas.id_nomina, nominas.id_empresa, nominas.inicio_periodo, nominas.fin_periodo,
			 nominas.fecha_captura, nominas.estado, nominas.percepciones, nominas.honorarios, nominas.relativos, 
			 nominas.subtotal, nominas.iva, nominas.total_factura, nominas.observaciones, nominas.tipo_nomina 
			 FROM nominas  INNER JOIN empresas on empresas.id_empresa= nominas.id_empresa  
			 WHERE nominas.id_empresa= $id_empresa ORDER BY nominas.id_nomina DESC";
			$nominas = mysql_query($query_nominas);

			if (!$nominas)
				return false;
			else
				return $nominas;

		}
	}

	function consultar_nomina_empleados($id_nomina, $id_empresa) {//Metodo para consultar todas las nominas por empresa
	//movido a mvc [cargar_nomina.php]
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			$query_nominas = "
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
								
								WHERE  percepciones_empleado.id_nomina= $id_nomina 
								AND percepciones_empleado.id_empresa= $id_empresa 
								AND  deducciones_empleado.id_nomina= $id_nomina
								";

			$nominas = mysql_query($query_nominas);

			if (!$nominas)
				return false;
			else
				return $nominas;

		}
	}
	
	
	function consultar_nomina_empleados_fiscal($id_nomina,$id_emp) {//Metodo para consultar todas las nominas por empresa
	

$sueldo_diario=0;
$dias_trabajados=0;
$total_sueldo=0;
$cantidad_domingo=0;
$total_domingos=0;
$prima_dominical=0;
$cantidad_vacaciones=0;
$total_vacaciones=0;
$prima_vacacional=0;
$cantidad_turno=0;
$total_turnos=0;
$cantidad_descanso=0;
$total_descansos=0;
$cantidad_hora=0;			   
$total_horas_extras=0;
$cantidad_festivo=0;
$total_festivos=0;
$aguinaldo=0;

$p_premio_por_puntualidad=0;
$p_premio_por_asistencia=0;
$p_becas_educacionales=0;

$subsidio_empleo=0;
$prestamos=0;
$caja_ahorro=0;
$fonacot=0;
$infonavit=0;

$d_ISR=0;
$d_IMSS=0;					   
$desc_otras_deducciones="";

$otras_deducciones=0;

$total_nomina_fiscal=0;
					   
					   
					   
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			$query_nominas = "
								SELECT *								
								FROM 
								nomina_fiscal 
								
								
								WHERE  id_nomina= $id_nomina
								and id_empleado=$id_emp 
								
								";

			$nominas = mysql_query($query_nominas);
			
			$num_rows = mysql_num_rows($nominas);	
			
			/*if($num_rows==0){
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
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",

					  
					   GetSQLValueString($id_nomina, "int"),					  
					   GetSQLValueString($id_emp, "int"),
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
		  
		  $query_nominas = "
								SELECT *								
								FROM 
								nomina_fiscal 
								
								
								WHERE  id_nomina= $id_nomina
								and id_empleado=$id_emp 
								
								";

			$nominas = mysql_query($query_nominas);
			
				}*/
				
				
				

			if (!$nominas)
				return false;
			else
				return $nominas;

		}
	}


	function consultar_nomina_empleados_imss($id_nomina, $id_empresa) {//consulta los empleados que tiene imss
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			$query_nominas2 = "
			SELECT 
			empleados.cuenta_imss 
			FROM percepciones_empleado
			
			INNER JOIN deducciones_empleado 
			on  percepciones_empleado.id_empleado= deducciones_empleado.id_empleado
			
			INNER JOIN empleados on  
			percepciones_empleado.id_empleado= empleados.id_empleado
																						
			WHERE  percepciones_empleado.id_nomina= $id_nomina 
			AND percepciones_empleado.id_empresa= $id_empresa 
			AND  deducciones_empleado.id_nomina= $id_nomina 
			AND empleados.cuenta_imss='Si' ";

			$nominas2 = mysql_query($query_nominas2);

			if (!$nominas2)
				return false;
			else
				return $nominas2;

		}
	}

	function eliminar_nomina($id_nomina) {
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			$query_nomina = "DELETE FROM nominas WHERE id_nomina= $id_nomina";
			$nomina = mysql_query($query_nomina);

			if (!$nomina)
				return false;
			else
				return $nomina;

		}
	}

	function agregar_empleado_nomina($id_empleado, $id_nomina, $id_empresa, $sueldo_diario) {
		//TOMAR EN CUENTA EL CAMPO INFONAVITO DEL CATALOGO DE EMPLEADOS
		
		

		$con = new dbConexion();
		

		if ($con -> conectar() == true) {

			$con -> iniciar_transaccion_bd();
			//inicializa una transaccion a la base de datos

			//Guardo las percepciones
			$insertPercepciones = sprintf("
			INSERT 
			INTO 
			percepciones_empleado 
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
			otras_percepciones 
			) 
			VALUES 
			(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
			GetSQLValueString($id_nomina, "int"), 
			GetSQLValueString($id_empresa, "int"), 
			GetSQLValueString($id_empleado, "int"), 
			GetSQLValueString($sueldo_diario, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"));

			$resultPercepciones = mysql_query($insertPercepciones);

			//Guarda las deducciones
			$insertDeducciones = sprintf("
			INSERT 
			INTO 
			deducciones_empleado 
			(
			id_nomina, 
			id_empresa, 
			id_empleado, 
			prestamos, 
			caja_ahorro, 
			fonacot, 
			otras_deducciones, 
			prestamo_ascon, 
			infonavit
			) 
			VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", 
			GetSQLValueString($id_nomina, "int"), 
			GetSQLValueString($id_empresa, "int"), 
			GetSQLValueString($id_empleado, "int"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"), 
			GetSQLValueString(0, "double"));

			$resultDeducciones = mysql_query($insertDeducciones);

			if (!$resultPercepciones || !$resultDeducciones) {
				$con -> cancelar_transaccion_bd();
				//cancela una transaccion y regresa la base de datos a su estado original
				return false;
			} else {
				$con -> ejecutar_transaccion_bd();				
		        $Fiscal=new NominaFiscal();
				$Fiscal->fixed_agregar_empleado_nuevo($id_nomina,$id_empleado,$id_empresa);
				$Fiscal->imprimir_valores();
				//ejecuta las consultas de una transaccion a la base de datos
				return true;
			}

		}
		
		
		       

	}//fin funcion agregar_empleado_nomina

	function consultar_empleados_sin_nomina($id_nomina, $id_empresa) {//Metodo para consultar todas las nominas por empresa
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			/*$query_empleados = "SELECT empleados.nombre, empleados.ap_paterno, empleados.ap_materno, empleados.id_empleado
			 FROM empleados
			 LEFT JOIN percepciones_empleado on  empleados.id_empleado = percepciones_empleado.id_empleado

			 WHERE  percepciones_empleado.id_nomina= $id_nomina AND percepciones_empleado.id_empleado IS NULL  "; */

			$query_empleados = "SELECT empleados.nombre, empleados.ap_paterno, empleados.ap_materno, empleados.id_empleado, empleados.sueldo_diario, empleados_empresa.id_empresa
FROM empleados 
INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado
WHERE empleados_empresa.id_empresa = $id_empresa AND empleados.estado = 'ACTIVO' AND empleados.id_empleado NOT IN 
(SELECT percepciones_empleado.id_empleado FROM percepciones_empleado  WHERE percepciones_empleado.id_nomina = $id_nomina) ";

			$empleados = mysql_query($query_empleados);
			$registros = mysql_num_rows($empleados);

			if ($registros == 0)
				return false;
			else
				return $empleados;

		}
	}

	function quitar_empleado_nomina($id_empleado, $id_nomina, $id_empresa) {
		//TOMAR EN CUENTA EL CAMPO INFONAVITO DEL CATALOGO DE EMPLEADOS

		$con = new dbConexion();

		if ($con -> conectar() == true) {

			$con -> iniciar_transaccion_bd();
			//inicializa una transaccion a la base de datos

			//Elimino en las percepciones
			$deletePercepciones = "DELETE FROM percepciones_empleado WHERE id_nomina=$id_nomina AND id_empresa= $id_empresa AND id_empleado= $id_empleado";
			$resultPercepciones = mysql_query($deletePercepciones);

			//Elimino en las deducciones
			$deleteDeducciones = "DELETE FROM deducciones_empleado WHERE id_nomina=$id_nomina AND id_empresa= $id_empresa AND id_empleado= $id_empleado";
			$resultDeducciones = mysql_query($deleteDeducciones);

			if (!$resultPercepciones || !$resultDeducciones) {
				$con -> cancelar_transaccion_bd();
				//cancela una transaccion y regresa la base de datos a su estado original
				return false;
			} else {
				$con -> ejecutar_transaccion_bd();
				//ejecuta las consultas de una transaccion a la base de datos
				return true;
			}

		}

	} //fin funcion quitar_empleado_nomina
	
	function totales_percepciones_deducciones($id_nomina,$id_empleado){
		
		$con = new dbConexion();

		if ($con -> conectar() == true) {
			//$query_nominas = "SELECT * FROM nominas INNER JOIN empresas on empresas.id_empresa= nominas.id_empresa WHERE nominas.id_empresa= $id_empresa ORDER BY fecha_captura ASC";
			$query_nominas = "
			select
(total_sueldo+									  
total_domingos_trabajados+	
total_vacaciones+ 	
total_turnos_trabajados+ 	
total_descanso_trabajado+
total_horas_extras+
otras_percepciones+ 
complemento_sueldo+ 	
total_dias_festivos+									  
aguinaldo)as percepciones,
(p_total_sueldo+
p_subtotal_domingos+
p_subtotal_vacaciones+
p_total_turnos_trabajados+ 
p_total_descansos_trabajados+  
p_total_horas_extras+
p_premio_por_puntualidad+
p_premio_por_asistencia+
p_becas_educacionales+ 
complemento_sueldo+ 
p_total_dias_festivos+
p_aguinaldo
) as percepciones_fiscales,
(infonavit+									  
prestamos+
caja_ahorro+
otras_deducciones+
fonacot+
prestamo_ascon) as deducciones


from 
percepciones_empleado pe 
inner join deducciones_empleado de on pe.id_empleado=de.id_empleado and pe.id_nomina=de.id_nomina
inner join nomina_fiscal nf on pe.id_empleado=nf.id_empleado and pe.id_nomina=nf.id_nomina

where
pe.id_empleado='$id_empleado'
and
pe.id_nomina='$id_nomina'
			";
			$nominas = mysql_query($query_nominas);

			if (!$nominas)
				return false;
			else
				return $nominas;

		}
		 
									  
									
		}


} //Fin de la clase cNomina
?>