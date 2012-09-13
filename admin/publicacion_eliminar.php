<?php 
	//Elimina publicación
	
	include_once("publicaciones_clase.php");
	$id_documento= $_POST['id_documento'];
	$objPublicaciones = new cPublicaciones();		              //Creamos el objeto $objEmpleados de la clase cEmpleado

	if($objPublicaciones->eliminar_publicacion($id_documento)==true){
		echo "Registro eliminado correctamente.";		
	}else{
		echo "Error al eliminar, intente de nuevo.";		
		}


?>