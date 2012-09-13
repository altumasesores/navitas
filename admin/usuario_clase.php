<?php 

include_once("../Connections/dbConexion.php");  //Llamamos la conexion a la base de datos
		
//implementamos la clase cEmpleado
class cUsuario{		
		
	function consultar(){        //Metodo para consultar todas las empresa
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query = "SELECT * FROM usuarios ORDER BY id_usuario ASC";
			$usuarios = mysql_query($query); 	 
		
			if (!$usuarios)
				return false; 								
			else								
				return $usuarios;					
				
			}
		}		
		
	function crear($usuario, $password, $nombre, $tipo, $correo){
		$con= new dbConexion();

		if($con->conectar()==true){		
			$insertSQL = sprintf("INSERT INTO usuarios (usuario, password, nombre, tipo, correo) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($usuario, "text"),
                       GetSQLValueString($password, "text"),
                       GetSQLValueString($nombre, "text"),					   
                       GetSQLValueString($tipo, "text"),
					   GetSQLValueString($correo, "text"));

		  $result = mysql_query($insertSQL);
        
		
			if (!$result)
				return false; 								
			else								
				return $result;		
		
			}
		
		}	//fin de la funcion crear
		

	function actualizar($id_usuario, $usuario, $password, $nombre, $tipo, $correo){
		$con= new dbConexion();

		if($con->conectar()==true){	
			$updateSQL = sprintf("UPDATE usuarios SET usuario=%s, password=%s, nombre=%s, tipo=%s, correo=%s WHERE id_usuario=%s",
                       GetSQLValueString($usuario, "text"),
                       GetSQLValueString($password, "text"),
                       GetSQLValueString($nombre, "text"),
					   GetSQLValueString($tipo, "text"),
					   GetSQLValueString($correo, "text"),
					   GetSQLValueString($id_usuario, "text"));
			
			  $result = mysql_query($updateSQL);        
		
			if (!$result)
				return false; 								
			else								
				return $result;		
		
			}
		
		}


	function consultaIdUsuario($id){
		$con= new dbConexion();

		if($con->conectar()==true){	
			$query_usuarios = "SELECT * FROM usuarios where id_usuario= $id";
			$usuarios = mysql_query($query_usuarios); 
			$registros= mysql_num_rows($usuarios);
		
			if ($registros==0)
				return false; 								
			else								
				return $usuarios;		
			
			}		
	}


	function eliminar($id){
		$con= new dbConexion();

		if($con->conectar()==true){	
			$query = "DELETE FROM usuarios WHERE id_usuario= $id";
			$usuarios = mysql_query($query); 	 
		
			if (!$usuarios)
				return false; 								
			else								
				return $usuarios;		
			
			}		
		}




function asignar_empresa($id_usuario, $id_empresa){
		$con= new dbConexion();

		if($con->conectar()==true){		
			$insertSQL = sprintf("INSERT INTO usuarios_empresas (id_usuario, id_empresa) VALUES (%s, %s)",
                       GetSQLValueString($id_usuario, "int"),
                       GetSQLValueString($id_empresa, "int"));

		  $result = mysql_query($insertSQL);
        
		
			if (!$result)
				return false; 								
			else								
				return $result;		
		
			}
		
		}		//fin de la funcion asignar_empresa
		

function consultar_correos_usuarios_empresa($id_empresa){
	$con= new dbConexion();

		if($con->conectar()==true){	
			$query_usuarios = "SELECT usuarios.correo as correo, usuarios.id_usuario as id_usuario FROM usuarios_empresas INNER JOIN usuarios ON usuarios.id_usuario = usuarios_empresas.id_usuario  WHERE usuarios_empresas.id_empresa= $id_empresa";
			$usuarios = mysql_query($query_usuarios); 
			$registros= mysql_num_rows($usuarios);
		
			if ($registros==0)
				return false; 								
			else								
				return $usuarios;		
			
			}		
	
	}		
		

	function eliminar_usuario_empresa($id_usuario, $id_empresa){
		$con= new dbConexion();

		if($con->conectar()==true){	
			$query = "DELETE FROM usuarios_empresas WHERE id_usuario= $id_usuario AND id_empresa= $id_empresa";
			$usuarios = mysql_query($query); 	 
		
			if (!$usuarios)
				return false; 								
			else								
				return $usuarios;		
			
			}		
		}//fin funcion eliminar_usuario_empresa

	function consulta_usuario_empresas($id_usuario){
		$con= new dbConexion();

		if($con->conectar()==true){	
			$query_usuarios = "SELECT * FROM usuarios_empresas INNER JOIN empresas ON  empresas.id_empresa = usuarios_empresas.id_empresa where usuarios_empresas.id_usuario= $id_usuario ";
			$usuarios = mysql_query($query_usuarios); 
			$registros= mysql_num_rows($usuarios);
		
			if ($registros==0)
				return $registros; 								
			else								
				return $usuarios;		
			
			}		
	}	//fin de consulta_usuario_empresas
	


function consulta_no_asignadas($id_usuario){
		$con= new dbConexion();

		if($con->conectar()==true){	
			$query_usuarios = "SELECT * FROM empresas WHERE  empresas.id_empresa NOT IN( SELECT usuarios_empresas.id_empresa FROM  usuarios_empresas WHERE usuarios_empresas.id_usuario= $id_usuario )";
			$usuarios = mysql_query($query_usuarios); 
			$registros= mysql_num_rows($usuarios);
		
			if ($registros==0)
				return false; 								
			else								
				return $usuarios;		
			
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