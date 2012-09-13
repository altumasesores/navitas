<?php 
error_reporting(0);
	include_once("../admin/empresa_clase.php");
	
	$id_empresa= $_POST['id_empresa'];	
	$razon_social= $_POST['razon_social'];
	$titular= $_POST['titular'];
	$zona= $_POST['zona'];
	$rfc= $_POST['rfc'];
	$direccion= $_POST['direccion'];
	$correo= $_POST['correo'];
	$telefonos= $_POST['telefonos'];
	$id_usuario= $_POST['id_usuario'];
	$usuario= $_POST['usuario'];
	$password= $_POST['password'];
	$proceso= $_POST['proceso'];
	$iva= $_POST['iva'];
	$honorarios= $_POST['honorarios'];
	
	$objEmpresa = new cEmpresa();	    //Creamos el objeto $objEmpresa de la clase cEmpresa
	
if($proceso=="guardar"){
	
	
	if($objEmpresa->crear($razon_social, $titular, $zona, $rfc, $direccion, $correo, $telefonos, $usuario, $password, $iva, $honorarios)==true){
		echo "Registro guardado correctamente.";		
	}else{
		echo "Error al guardar el registro, intente de nuevo.";		
		}
	
	//include("empresa_consulta.php");
	}	

elseif ($proceso=="actualizar"){	
	if($objEmpresa->actualizar($id_empresa, $razon_social, $titular, $zona, $rfc, $direccion, $correo, $telefonos, $id_usuario, $usuario, $password, $iva, $honorarios)==true){
		echo "Registro Actualizado correctamente.";		
	}else{
		echo "Error al actualizar, intente de nuevo.";					
		
		}
	
	//include("empresa_consulta.php");
	
	}

elseif($proceso=="eliminar"){
	if($objEmpresa->eliminar($id_empresa)==true){
		echo "Registro eliminado correctamente.";		
	}else{
		echo "Error al eliminar, intente de nuevo.";		
		}
	
	

	}
	

?>