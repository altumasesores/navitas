<?php 
	include_once("../Connections/dbConexion.php");  //Llamamos la conexion a la base de datos
	include_once("../getSQLValueString.php"); 


$con= new dbConexion();

//Recibo las variables de la nomina

	$id_empresa = $_POST['id_empresa'];
	$periodo = $_POST['periodo'];
	$inicio_periodo = fsalida($_POST['inicio_periodo']);
	$fin_periodo = fsalida($_POST['fin_periodo']);
	$fecha_captura = $_POST['fecha_captura'];
	$estado = $_POST['estado'];
	$percepciones = $_POST['percepciones'];
	$honorarios = $_POST['honorarios'];
	$relativos = $_POST['relativos'];
	$subtotal = $_POST['subtotal'];
	$iva = $_POST['iva'];
	$total_factura = $_POST['total_factura'];
	$observaciones = $_POST['observaciones'];
	
	 
		if($con->conectar()==true){		

			$insert = sprintf("INSERT INTO nominas (id_empresa, inicio_periodo, fin_periodo, fecha_captura, estado, percepciones, honorarios, relativos, subtotal, iva, total_factura, observaciones, tipo_nomina) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($id_empresa, "int"),
                       GetSQLValueString($inicio_periodo, "date"),
                       GetSQLValueString($fin_periodo, "date"),
                       GetSQLValueString($fecha_captura, "date"),
					   GetSQLValueString($estado, "text"),
					   GetSQLValueString($percepciones, "double"),
					   GetSQLValueString($honorarios, "double"),
					   GetSQLValueString($relativos, "double"),
					   GetSQLValueString($subtotal, "double"),
					   GetSQLValueString($iva, "double"),
					   GetSQLValueString($total_factura, "double"),
					   GetSQLValueString($observaciones, "text"),
					   GetSQLValueString($periodo, "text")); 
			
	
		  $result = mysql_query($insert);		  
		  $ult_id_nomina= mysql_insert_id();  //Selecciono el ID que se acaba de insertar		  
		  echo $ult_id_nomina;
		  

		}



?>