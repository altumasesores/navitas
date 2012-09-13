<?php 
	include_once("../admin/empleado_clase.php");
	
	
	$id_empleado= $_POST['id_empleado'];
	$id_empresa= $_POST['id_empresa'];
	$curp_empleado= $_POST['curp_empleado'];
	$no_seg_social= $_POST['no_seg_social'];
	$ap_paterno= $_POST['ap_paterno'];
	$ap_materno= $_POST['ap_materno'];
	$nombre= $_POST['nombre'];
	$no_tarjeta= $_POST['no_tarjeta'];
	$cuenta_imss= $_POST['cuenta_imss'];
	$fecha_alta_imss= $_POST['fecha_alta_imss'];
	$domicilio= $_POST['domicilio'];
	$fecha_nacimiento= $_POST['fecha_nacimiento'];	
	$sueldo_diario_imss= $_POST['sueldo_diario_imss'];
	$estado= $_POST['estado'];
	$observaciones= $_POST['observaciones'];
	$proceso= $_POST['proceso'];
	$periodo_nomina= $_POST['periodo_nomina'];
	$sueldo_diario= $_POST['sueldo_diario'];
	$infonavit= $_POST['infonavit'];
	$fecha_alta= $_POST['fecha_alta'];
	
	
	$objEmpleado = new cEmpleado();	    //Creamos el objeto $objEmpleado de la clase cEmpresa
	
if($proceso=="guardar"){

	
	if($objEmpleado->crear($id_empresa, $curp_empleado, $no_seg_social, $ap_paterno, $ap_materno, $nombre, $cuenta_imss, $fecha_alta_imss, $domicilio, $fecha_nacimiento, $sueldo_diario_imss, $estado, $observaciones, $periodo_nomina, $sueldo_diario, $no_tarjeta, $infonavit,$fecha_alta)==true){
		echo "Registro guardado correctamente.";		
	}else{
		echo "Error al guardar el registro, intente de nuevo.<br>";				
		}
	
	include("../admin/empleado_consulta.php");
	}	

elseif ($proceso=="actualizar"){	
	if($objEmpleado->actualizar($id_empleado, $curp_empleado, $no_seg_social, $ap_paterno, $ap_materno, $nombre, $cuenta_imss, $fecha_alta_imss, $domicilio, $fecha_nacimiento, $sueldo_diario_imss, $estado, $observaciones, $periodo_nomina, $sueldo_diario, $no_tarjeta, $infonavit,$fecha_alta)==true){
		echo "Registro Actualizado correctamente.";		
	}else{
		echo "Error al actualizar, intente de nuevo.";					
		
		}
	
	include("../admin/empleado_consulta.php");
	
	}

elseif($proceso=="eliminar"){
	if($objEmpleado->eliminar($id_empleado)==true){
		echo "Registro eliminado correctamente.";		
	}else{
		echo "Error al eliminar, intente de nuevo.";		
		}
	
	include("../admin/empleado_consulta.php");

	}
	elseif ($proceso=="act"){	
	if($objEmpleado->actualizar($id_empleado, $curp_empleado, $no_seg_social, $ap_paterno, $ap_materno, $nombre, $cuenta_imss, $fecha_alta_imss, $domicilio, $fecha_nacimiento, $sueldo_diario_imss, $estado, $observaciones, $periodo_nomina, $sueldo_diario, $no_tarjeta, $infonavit,$fecha_alta)==true){
		echo "Registro Actualizado correctamente.";		
	}else{
		echo "Error al actualizar, intente de nuevo.";					
		
		}
	
	}

	

?>