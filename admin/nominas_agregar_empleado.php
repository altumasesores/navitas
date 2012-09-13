<?php 
	include_once("nominas_clase.php"); 
	include_once("empleado_clase.php"); 
	//Recibo las variables de la nomina	
	$id_nomina= $_POST['id_nomina'];
	$id_empresa= $_POST['id_empresa'];
	$id_empleado= $_POST['id_empleado'];
	
	$objNomina = 		new cNomina();	              //Creamos el objeto $objEmpleados de la clase cEmpleado
	$objEmpleado = 		new cEmpleado();	    
    $datos_empleado=	$objEmpleado->consultaIdEmpleado($id_empleado);
	
	while ($row_emp = mysql_fetch_assoc($datos_empleado)){
		$sueldo_diario= $row_emp['sueldo_diario'];	
     } 	
		
	if($objNomina->agregar_empleado_nomina($id_empleado, $id_nomina, $id_empresa, $sueldo_diario) ){
		echo "El empleado se ha agregado correctamente.";
	}else{
		echo "No fue posible agregar al empleado.";

		}
	


?>