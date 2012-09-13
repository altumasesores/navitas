<?php 

include_once("../Connections/dbConexion.php");  //Llamamos la conexion a la base de datos
		
//implementamos la clase cEmpleado
class cEmpleado{		
		
	function consultar($id_empresa, $estado){        //Metodo para consultar todas las empresa
		$con= new dbConexion();

		if($con->conectar()==true){
			if($estado=='' OR $estado=='Activo' OR $estado=='ACTIVO' ){  
			$query = "SELECT * FROM empleados INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado WHERE empleados_empresa.id_empresa = '$id_empresa' AND empleados.estado = 'ACTIVO' ORDER BY empleados.id_empleado ASC";
			$empleados = mysql_query($query); 	 
		    }
			elseif($estado=='Todos'){  
			$query = "SELECT * FROM empleados INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado WHERE empleados_empresa.id_empresa = '$id_empresa' ORDER BY empleados.id_empleado ASC";
			$empleados = mysql_query($query); 	 
		    }
			elseif($estado=='Baja' OR $estado=='BAJA' ){  
			$query = "SELECT * FROM empleados INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado WHERE empleados_empresa.id_empresa = '$id_empresa' AND empleados.estado = 'BAJA' ORDER BY empleados.id_empleado ASC";
			$empleados = mysql_query($query); 	 
		    }
			elseif($estado=='Pendiente' OR $estado=='PENDIENTE' ){  
			$query = "SELECT * FROM empleados INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado WHERE empleados_empresa.id_empresa = '$id_empresa' AND empleados.estado = 'PENDIENTE' ORDER BY empleados.id_empleado ASC";
			$empleados = mysql_query($query); 	 
		    }
	
			if (!$empleados)
				return false; 								
			else								
				return $empleados;					
				
			}
		}	

function consultar_empleado_empresa($id_empresa){        //Metodo para consultar todas las empresa
		$con= new dbConexion();

		if($con->conectar()==true){	 
			if($id_empresa=='todas'){  
			$query = "SELECT * FROM empleados 
			INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado 
			inner join empresas on  empleados_empresa.id_empresa=empresas.id_empresa
			WHERE empleados.estado = 'ACTIVO' ORDER BY empleados.nombre ASC";
			$empleados = mysql_query($query); 	 
		    }
			else{  
			$query = "SELECT * FROM empleados 
			INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado 
			inner join empresas on  empleados_empresa.id_empresa=empresas.id_empresa
			WHERE empleados_empresa.id_empresa = '$id_empresa' AND empleados.estado = 'ACTIVO' ORDER BY empleados.nombre ASC";
			$empleados = mysql_query($query); 
		    }
			if (!$empleados)
				return false; 								
			else								
				return $empleados;					
				
			}
		}	
function consultar_empleado_empresas_todas(){        //Metodo para consultar todas las empresa
		$con= new dbConexion();

		if($con->conectar()==true){
			$query = "SELECT * FROM empleados 
			INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado
			inner join empresas on  empleados_empresa.id_empresa=empresas.id_empresa
			WHERE empleados.estado = 'ACTIVO' ORDER BY empleados.nombre ASC";
			$empleados = mysql_query($query); 	 

			if (!$empleados)
				return false; 								
			else								
				return $empleados;					
				
			}
		}			

function consultar_empleados_periodo($id_empresa, $periodo){        //Metodo para consultar todas las empresa
//movido a mvc controller->cargarNuevaNominaClienteXPeriodo[nuevaNominaClienteXperiodo.php]
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query = "SELECT * FROM empleados INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado WHERE   empleados_empresa.id_empresa = '$id_empresa' AND periodo_nomina= '$periodo' AND estado= 'ACTIVO'  ORDER BY empleados.id_empleado ASC";
			$empleados = mysql_query($query); 	 
		
	
		
		
			if (!$empleados)
				return false; 								
			else								
				return $empleados;					
				
			}
		}		
		function consultar_empleados_periodo_imss($id_empresa, $periodo){        //Metodo para consultar todas las empresa
		//movido a mvc controller->cargarNuevaNominaClienteXPeriodo[nuevaNominaClienteXperiodo.php]
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query = "SELECT * FROM empleados INNER JOIN empleados_empresa ON empleados.id_empleado = empleados_empresa.id_empleado WHERE   empleados_empresa.id_empresa = '$id_empresa' AND periodo_nomina= '$periodo' AND estado= 'ACTIVO' AND empleados.cuenta_imss='Si' ORDER BY empleados.id_empleado ASC";
			$empleados = mysql_query($query); 	 
		
	
		
		
			if (!$empleados)
				return false; 								
			else								
				return $empleados;					
				
			}
		}
		
	function crear($id_empresa, $curp_empleado, $no_seg_social, $ap_paterno, $ap_materno, $nombre, $cuenta_imss, $fecha_alta_imss, $domicilio, $fecha_nacimiento, $sueldo_diario_imss, $estado, $observaciones, $periodo_nomina, $sueldo_diario, $no_tarjeta,$infonavit=0,$fecha_altaEmpleado){
		$antiguedad=0;
		
		$con= new dbConexion();

		if($con->conectar()==true){		
			$insertSQL = sprintf("INSERT INTO empleados(curp_empleado, no_seg_social, ap_paterno, ap_materno, nombre, cuenta_imss, fecha_alta_imss, domicilio, fecha_nacimiento, sueldo_diario_imss, estado, observaciones, periodo_nomina, sueldo_diario, no_tarjeta, infonavit,fecha_alta,antiguedad) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($curp_empleado, "text"),
                       GetSQLValueString($no_seg_social, "text"),
                       GetSQLValueString($ap_paterno, "text"),
					   GetSQLValueString($ap_materno, "text"),
					   GetSQLValueString($nombre, "text"),
                       GetSQLValueString($cuenta_imss, "text"),
                       GetSQLValueString($fecha_alta_imss, "date"),
                       GetSQLValueString($domicilio, "text"),
					   GetSQLValueString($fecha_nacimiento, "date"),
					   GetSQLValueString($sueldo_diario_imss, "double"),
					   GetSQLValueString($estado, "text"),
					   GetSQLValueString($observaciones, "text"),
					   GetSQLValueString($periodo_nomina, "text"),
					   GetSQLValueString($sueldo_diario, "double"),
					   GetSQLValueString($no_tarjeta, "text"),
					   GetSQLValueString($infonavit, "double"),
					   GetSQLValueString($fecha_altaEmpleado, "date"),
					   GetSQLValueString($antiguedad, "int"));

		  $result = mysql_query($insertSQL);
		  
		  $ult_id_empleado= mysql_insert_id();  //Selecciono el ID que se acaba de insertar

        $insertEmpresa = sprintf("INSERT INTO empleados_empresa(id_empresa, id_empleado) VALUES (%s, %s)",
                       GetSQLValueString($id_empresa, "int"),
                       GetSQLValueString($ult_id_empleado, "int"));

		  $result2 = mysql_query($insertEmpresa);
		
			if (!$result)
				return false; 								
			else								
				return $result;		
		
			}
		
		}		
		

	function actualizar($id_empleado, $curp_empleado, $no_seg_social, $ap_paterno, $ap_materno, $nombre, $cuenta_imss, $fecha_alta_imss, $domicilio, $fecha_nacimiento, $sueldo_diario_imss, $estado, $observaciones, $periodo_nomina, $sueldo_diario, $no_tarjeta, $infonavit,$fecha_altaEmpleado){

		$con= new dbConexion();

		if($con->conectar()==true){	
			$updateSQL = sprintf("UPDATE empleados SET curp_empleado=%s, no_seg_social=%s, ap_paterno=%s, ap_materno=%s, nombre=%s, cuenta_imss=%s, fecha_alta_imss=%s, domicilio=%s,fecha_nacimiento=%s,sueldo_diario_imss=%s,estado=%s,observaciones=%s, periodo_nomina=%s, sueldo_diario= %s, no_tarjeta= %s, infonavit=%s,fecha_alta=%s       WHERE id_empleado=%s",
                       GetSQLValueString($curp_empleado, "text"),
                       GetSQLValueString($no_seg_social, "text"),
                       GetSQLValueString($ap_paterno, "text"),
					   GetSQLValueString($ap_materno, "text"),
					   GetSQLValueString($nombre, "text"),
                       GetSQLValueString($cuenta_imss, "text"),
                       GetSQLValueString($fecha_alta_imss, "date"),
                       GetSQLValueString($domicilio, "text"),
					   GetSQLValueString($fecha_nacimiento, "date"),
					   GetSQLValueString($sueldo_diario_imss, "double"),
					   GetSQLValueString($estado, "text"),
					   GetSQLValueString($observaciones, "text"),
					   GetSQLValueString($periodo_nomina, "text"),
					   GetSQLValueString($sueldo_diario, "double"),
					   GetSQLValueString($no_tarjeta, "text"),
					   GetSQLValueString($infonavit, "double"),
					   GetSQLValueString($fecha_altaEmpleado, "date"),					   
					   GetSQLValueString($id_empleado, "int"));
			
			  $result = mysql_query($updateSQL);        
		
			if (!$result)
				return false; 								
			else								
				return $result;		
		
			}
		
		}


	function consultaIdEmpleado($id){
		$con= new dbConexion();

		if($con->conectar()==true){	
			$query = "SELECT * FROM empleados where id_empleado= $id";
			$empleados = mysql_query($query); 
			$registros = mysql_num_rows($empleados);
		
			if ($registros==0)
				return false; 								
			else								
				return $empleados;		
			
			}		
	}


	function eliminar($id){
		$con= new dbConexion();

		if($con->conectar()==true){	
			$query = "DELETE FROM empleados WHERE id_empleado= $id";
			$empleados = mysql_query($query); 	 
		
			if (!$empleados)
				return false; 								
			else								
				return $empleados;		
			
			}		
		}
		
		
}//termina la clase cEmpresa




if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";

      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


?>