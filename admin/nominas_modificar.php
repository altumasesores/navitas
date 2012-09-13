<?php 
	//SCRIPT QUE MODIFICA LOS DATOS DE LA NOMINA
	
	include_once("../Connections/dbConexion.php");  //Llamamos la conexion a la base de datos
	include_once("../getSQLValueString.php"); 


$con= new dbConexion();

//Recibo las variables de la nomina
	$id_nomina = $_POST['id_nomina'];
	$id_empresa = $_POST['id_empresa'];
	
	$inicio_periodo = $_POST['inicio_periodo'];
	$fin_periodo = $_POST['fin_periodo'];
	$estado = $_POST['estado'];
	$percepciones = $_POST['percepciones'];
	$honorarios = $_POST['honorarios'];
	$relativos = $_POST['relativos'];
	$subtotal = $_POST['subtotal'];
	$iva = $_POST['iva'];
	$total_factura = $_POST['total_factura'];
	$observaciones = $_POST['observaciones'];
	 
		if($con->conectar()==true){	
		$con -> iniciar_transaccion_bd();
			
			$updateSQL = sprintf("UPDATE nominas SET id_empresa=%s, inicio_periodo=%s, fin_periodo=%s,  estado=%s, percepciones=%s, honorarios=%s,relativos=%s,subtotal=%s,iva=%s,total_factura=%s, observaciones=%s      WHERE id_nomina=%s",
                       GetSQLValueString($id_empresa, "int"),
                       GetSQLValueString($inicio_periodo, "date"),
                       GetSQLValueString($fin_periodo, "date"),
					   GetSQLValueString($estado, "text"),
                       GetSQLValueString($percepciones, "double"),
                       GetSQLValueString($honorarios, "double"),
                       GetSQLValueString($relativos, "double"),
					   GetSQLValueString($subtotal, "double"),
					   GetSQLValueString($iva, "double"),
					   GetSQLValueString($total_factura, "double"),
					   GetSQLValueString($observaciones, "text"),
					   GetSQLValueString($id_nomina, "int"));
			
			  $result = mysql_query($updateSQL);  
			  
			  
			  
			  
			  
			  
			  if (!$result) {
				$con -> cancelar_transaccion_bd();
				//cancela una transaccion y regresa la base de datos a su estado original
				return false;
			} else {
				$con -> ejecutar_transaccion_bd();
				//ejecuta las consultas de una transaccion a la base de datos
				return true;
			}
			  
			  
			  
			   			  
			

		}

?>