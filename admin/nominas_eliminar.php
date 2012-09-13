<?php 
	//SCRIPT QUE ELIMINA LOS DATOS DE LA NOMINA
	
	include_once("nominas_clase.php");
	$id_nomina= $_POST['id_nomina'];
	$objNomina = new cNomina();	              //Creamos el objeto $objEmpleados de la clase cEmpleado

	if($objNomina->eliminar_nomina($id_nomina)==true){
		echo "Registro eliminado correctamente.";		
	}else{
		echo "Error al eliminar, intente de nuevo.";		
		}


?>