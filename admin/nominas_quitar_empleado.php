<?php 
	include_once("nominas_clase.php"); 

	//Recibo las variables de la nomina	
	$id_nomina= $_POST['id_nomina'];
	$id_empresa= $_POST['id_empresa'];
	$id_empleado= $_POST['id_empleado'];
	
	$objNomina = 		new cNomina();	              //Creamos el objeto $objEmpleados de la clase cEmpleado
		
	if($objNomina->quitar_empleado_nomina($id_empleado, $id_nomina, $id_empresa) ){
		echo "El empleado se ha eliminado de la nomina correctamente.";
	}else{
		echo "No fue posible eliminar al empleado de la nomina.";

		}
	


?>