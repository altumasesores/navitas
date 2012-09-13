<?php 
	include_once("empresa_clase.php");
	
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
	
	
	if($objEmpresa->crear($razon_social, $titular, $zona, $rfc, $direccion, $correo, $telefonos, $usuario, $password, $iva, $honorarios)==true){
		echo "Registro guardado correctamente.";		
		
//		include("empresa_consulta.php");
	}else{
		echo "Error al guardar el registro, intente de nuevo.".mysql_error();		
	//	include("empresa_consulta.php");
		}
		

?>