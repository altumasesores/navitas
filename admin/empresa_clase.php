<?php 

include_once("../Connections/dbConexion.php");  //Llamamos la conexion a la base de datos
		
//implementamos la clase cEmpleado
class cEmpresa{		
		
	function consultar(){        //Metodo para consultar todas las empresa
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query_empresas = "SELECT * FROM empresas INNER JOIN usuarios on empresas.id_usuario= usuarios.id_usuario WHERE empresas.estatus='ACTIVA' ORDER BY id_empresa ASC";
			$empresas = mysql_query($query_empresas); 	 
		
			if (!$empresas)
				return false; 								
			else								
				return $empresas;					
				
			}
		}		
		
function consultar_empresas_x_usuario($id_usuario){        //Metodo para consultar todas las empresa
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query_empresas = "SELECT * FROM empresas INNER JOIN usuarios on empresas.id_usuario= usuarios.id_usuario 
			WHERE empresas.id_empresa IN (SELECT id_empresa FROM usuarios_empresas where id_usuario= $id_usuario)
			 AND empresas.estatus='ACTIVA' ORDER BY id_empresa ASC" ;
			
			
			$empresas = mysql_query($query_empresas); 	 
		
			if (!$empresas)
				return false; 								
			else								
				return $empresas;					
				
			}
		}
		
	function crear($razon_social, $titular, $zona, $rfc,$direccion, $correo, $telefonos, $usuario, $password, $iva, $honorarios){
		$con= new dbConexion();

		if($con->conectar()==true){		
			//Se Guarda el  usuario asignado a la empresa
			
				$insertSQL1 = sprintf("INSERT INTO usuarios (usuario, password, nombre, tipo, correo) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($usuario, "text"),
                       GetSQLValueString($password, "text"),
                       GetSQLValueString($titular, "text"),
					   GetSQLValueString("Cliente", "text"),
					   GetSQLValueString($correo, "text"));

			  $result1 = mysql_query($insertSQL1);			   
			  $id_usuario= mysql_insert_id();  //Obtengo el id del usuario insertado		
		
			//Se guarda la nueva empresa
			$insertSQL = sprintf("INSERT INTO empresas (razon_social, titular, zona, rfc, direccion, correo, telefonos, id_usuario, iva, honorarios) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($razon_social, "text"),
                       GetSQLValueString($titular, "text"),
                       GetSQLValueString($zona, "text"),
					   GetSQLValueString($rfc, "text"),
					   GetSQLValueString($direccion, "text"),
                       GetSQLValueString($correo, "text"),
                       GetSQLValueString($telefonos, "text"),
                       GetSQLValueString($id_usuario, "int"),
					   GetSQLValueString($iva, "double"),
					   GetSQLValueString($honorarios, "double"));

		  $result = mysql_query($insertSQL);
        
		
			if (!$result)
				return false; 								
			else								
				return $result;		
		
			}
		
		}	//fin funcion guardar	
		

	function actualizar($id_empresa, $razon_social, $titular, $zona, $rfc, $direccion, $correo, $telefonos, $id_usuario, $usuario, $password, $iva, $honorarios){
		$con= new dbConexion();

		if($con->conectar()==true){			
			
			//Actualizo los datos de la empresa
			$updateSQL = sprintf("UPDATE empresas SET razon_social=%s, titular=%s, zona=%s, rfc=%s, direccion=%s, correo=%s, telefonos=%s, id_usuario=%s, iva=%s, honorarios=%s WHERE id_empresa=%s",
                       GetSQLValueString($razon_social, "text"),
                       GetSQLValueString($titular, "text"),
                       GetSQLValueString($zona, "text"),
					   GetSQLValueString($rfc, "text"),
					   GetSQLValueString($direccion, "text"),
                       GetSQLValueString($correo, "text"),
                       GetSQLValueString($telefonos, "text"),
                       GetSQLValueString($id_usuario, "int"),
					   GetSQLValueString($iva, "double"),
					   GetSQLValueString($honorarios, "double"),
                       GetSQLValueString($id_empresa, "text"));
			
			  $result = mysql_query($updateSQL);        
		
		//Actualizo los datos del usuario de la empresa
		$updateSQL2 = sprintf("UPDATE usuarios SET usuario=%s, password=%s, nombre=%s, correo=%s WHERE id_usuario=%s",
                       GetSQLValueString($usuario, "text"),
                       GetSQLValueString($password, "text"),
                       GetSQLValueString($titular, "text"),
					   GetSQLValueString($correo, "text"),
                       GetSQLValueString($id_usuario, "int"));
			
			  $result2 = mysql_query($updateSQL2);  


			if (!$result)
				return false; 								
			else								
				return $result;		
		
			}
		
		}


	function consultaIdEmpresa($id){//migrado a mvc para consultar los detalles de una nomina especifica[cargar_nomina.php]
		$con= new dbConexion();

		if($con->conectar()==true){	
			$query_empresas = "SELECT * FROM empresas where id_empresa= $id";
			$empresas = mysql_query($query_empresas); 
			//$registros= mysql_num_rows($empresas);
		
			if (!$empresas)
				return false; 								
			else								
				return $empresas;		
			
			}		
	}


	function eliminar($id){
		$con= new dbConexion();

		if($con->conectar()==true){	
			$query_empresas = "DELETE FROM empresas WHERE id_empresa= $id";
			$empresas = mysql_query($query_empresas); 	 
		
			if (!$empresas)
				return false; 								
			else								
				return $empresas;		
			
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