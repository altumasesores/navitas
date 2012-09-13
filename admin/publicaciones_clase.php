<?php 
	include_once("../Connections/dbConexion.php"); 
	
	class cPublicaciones{
		
		function consultar(){        //Metodo para consultar todas las empresa
			$con= new dbConexion();

		if($con->conectar()==true){		
			$query_documentos = "SELECT * FROM documentos ORDER BY fecha_publicacion ASC";
			$documentos = mysql_query($query_documentos); 	 
		
			if (!$documentos)
				return false; 								
			else								
				return $documentos;					
				
			}
		
		}
		function correoEmpresa($Empresa){        //Metodo para consultar todas las empresa
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query_empresas = "SELECT correo FROM empresas
			WHERE empresas.id_empresa=$Empresa ";
			$empresas = mysql_query($query_empresas); 	 
		
			if (!$empresas)
				return false; 								
			else								
				return $empresas;					
				
			}
		}	

		function eliminar_publicacion($id_documento){  //Elimina publicacion
		$con= new dbConexion();

		if($con->conectar()==true){		
			$query_publicacion = "DELETE FROM documentos WHERE id_documento='$id_documento' ";
			$publicacion = mysql_query($query_publicacion); 	 
		
			if (!$publicacion)
				return false; 								
			else								
				return $publicacion;				
				
			}
		}
	
	function consultar_empresa($id_empresa){        //Metodo para consultar todas las empresa
			$con= new dbConexion();

		if($con->conectar()==true){		
			$query_documentos = "SELECT * FROM documentos INNER JOIN documentos_empresas ON documentos_empresas.id_documento = documentos.id_documento WHERE documentos_empresas.id_empresa= $id_empresa ORDER BY fecha_publicacion ASC";
			$documentos = mysql_query($query_documentos); 	 
		
			if (!$documentos)
				return false; 								
			else								
				return $documentos;					
				
			}
		}		
		
	function crear($descripcion, $fecha_publicacion, $ruta_archivo){
		$con= new dbConexion();

		if($con->conectar()==true){		
			//Se Guarda el  usuario asignado a la empresa
			
			$insertSQL1 = sprintf("INSERT INTO documentos (descripcion, fecha_publicacion, ruta_archivo) VALUES (%s, %s, %s)",
                       GetSQLValueString($descripcion, "text"),
                       GetSQLValueString($fecha_publicacion, "date"),
                       GetSQLValueString($ruta_archivo, "text"));

			  $result1 = mysql_query($insertSQL1);			   
			  $id_documento= mysql_insert_id();  //Obtengo el id del usuario insertado				
		
			if (!$result1)
				return false; 								
			else								
				return $id_documento;		
		
			}
		
		}	//fin funcion guardar	
		
			
	function documentos_empresa($id_documento, $id_empresa){
		$con= new dbConexion();


		if($con->conectar()==true){		
			//Se Guarda el  usuario asignado a la empresa
			
			$insertSQL1 = sprintf("INSERT INTO documentos_empresas (id_documento, id_empresa) VALUES (%s, %s)",
                       GetSQLValueString($id_documento, "int"),
                       GetSQLValueString($id_empresa, "int"));

			  $result1 = mysql_query($insertSQL1);			   
			  
		
			if (!$result1)
				return false; 								
			else								
				return $result1;		
		
			}
		
		}	//fin funcion guardar			
		
		
} //fin de la clase




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