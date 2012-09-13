<?php 
	//SCRIPT QUE MODIFICAR EL ESTADO DE LA NOMINA A AUTORIZADA	
	include_once("../Connections/dbConexion.php");  //Llamamos la conexion a la base de datos
	include_once("../getSQLValueString.php"); 

	include("../phpmailer/class.phpmailer.php");
	include_once("../admin/nominas_clase.php");
	include_once("../convertir_fechas.php");
	include_once("../admin/empresa_clase.php");			


$con= new dbConexion();

//Recibo las variables de la nomina
	$id_nomina = $_POST['id_nomina'];
	$estado=     "AUTORIZADA";
	
	 
		if($con->conectar()==true){		
			$updateSQL = sprintf("UPDATE nominas SET  estado=%s WHERE id_nomina=%s",
                       GetSQLValueString($estado, "text"),
                       GetSQLValueString($id_nomina, "int"));
			
			  $result = mysql_query($updateSQL);   			  
			include_once("correo_autorizacion_nomina.php");			
		}else{
			echo "Disculpe las molestias, hubo un error de conexion. Por favor, intente de nuevo. ";
			}
		




?>