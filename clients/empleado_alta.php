<?php 
	include_once("../admin/empleado_clase.php");
	
	
	//$id_empleado= $_POST['id_empleado'];
	$id_empresa= $_POST['id_empresa'];
	$curp_empleado= $_POST['curp_empleado'];
	$no_seg_social= $_POST['no_seg_social'];
	$ap_paterno= $_POST['ap_paterno'];
	$ap_materno= $_POST['ap_materno'];
	$nombre= $_POST['nombre'];
	$periodo_nomina= $_POST['periodo_nomina'];
	$cuenta_imss= $_POST['cuenta_imss'];
	$fecha_alta_imss= $_POST['fecha_alta_imss'];
	$domicilio= $_POST['domicilio'];
	$fecha_nacimiento= $_POST['fecha_nacimiento'];
	$fecha_altaEmpleado=$_POST['fecha_altaEmpleado'];
	$sueldo_diario_imss= $_POST['sueldo_diario_imss'];
	$estado= $_POST['estado'];
	$no_tarjeta="";
	$sueldo_diario= $_POST['sueldo_diario'];
	$observaciones= $_POST['observaciones'];
	
	
	$objEmpleado = new cEmpleado();	    //Creamos el objeto $objEmpleado de la clase cEmpresa	
	

	
	if($objEmpleado->crear($id_empresa, $curp_empleado, $no_seg_social, $ap_paterno, $ap_materno, $nombre, $cuenta_imss, $fecha_alta_imss, $domicilio, $fecha_nacimiento, $sueldo_diario_imss, $estado, $observaciones, $periodo_nomina, $sueldo_diario, $no_tarjeta,$fecha_altaEmpleado)==true){
		echo "Empleado guardado correctamente.".mysql_error();		
	}else{
		echo "Error al guardar al empleado, intente de nuevo.".mysql_error();				
		}
	
	


?>