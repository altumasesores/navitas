<?php 
	include_once("../admin/usuario_clase.php");
	
	$id_usuario= $_POST['id_usuario'];	
	$usuario= $_POST['usuario'];
	$password= $_POST['password'];
	$nombre= $_POST['nombre'];
	$correo= $_POST['correo'];
	$tipo= $_POST['tipo'];
	$proceso= $_POST['proceso'];
	
	$objUsuario = new cUsuario();	    //Creamos el objeto $objUsuario de la clase cEmpresa
	
if($proceso=="guardar"){
	
	
	if($objUsuario->crear($usuario, $password, $nombre, $tipo, $correo)==true){
		echo "Registro guardado correctamente.";		
	}else{
		echo "Error al guardar el registro, intente de nuevo.";		
		}
	
	include("../admin/usuario_consulta.php");
	}	

elseif ($proceso=="actualizar"){	
	if($objUsuario->actualizar($id_usuario, $usuario, $password, $nombre, $tipo, $correo)==true){
		echo "Registro Actualizado correctamente.";		
	}else{
		echo "Error al actualizar, intente de nuevo.";					
		
		}
	
	include("../admin/usuario_consulta.php");
	
	}

elseif($proceso=="eliminar"){
	if($objUsuario->eliminar($id_usuario)==true){
		echo "Registro eliminado correctamente.";		
	}else{
		echo "Error al eliminar, intente de nuevo.";		
		}
	
	include("../admin/usuario_consulta.php");

	}
	

?>