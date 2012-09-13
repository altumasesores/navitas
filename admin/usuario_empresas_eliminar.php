<?php 

	include_once("../admin/usuario_clase.php");
	$id_usuario= $_POST['id_usuario'];
	$id_empresa= $_POST['id_empresa'];
	$objUsuario = new cUsuario();	              //Creamos el objeto $objUsuario de la clase cUsuario
	
			
		
		if($objUsuario->eliminar_usuario_empresa($id_usuario, $id_empresa)==true){
			echo "Los cambios se han guardado correctamente.";		
		}else{
			echo "Error al eliminar el registro, intente de nuevo.";		
			}
	
	
?>