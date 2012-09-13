<?php 

	include_once("nominas_clase.php");
	include_once("empresa_clase.php");
	include_once("../convertir_fechas.php");
	include '../php_excel/Classes/PHPExcel.php';
	require_once('../libs/php/mvc/ModelBase.php');
	require_once('../libs/php/mvc/SPDO.php');
	require_once('../libs/php/mvc/Config.php');
	require_once('../libs/php/mvc/ConfigBD.php');
	require_once('mod_calculos/model/ModelCalculosDatos.php');
	
	$objPHPExcel = new PHPExcel();

	 $id_empresa= $_GET['id_empresa'];
	 $id_nomina=  $_GET['id_nomina'];
		
	//Creamos una instancia de nuestro "modelo"
	$Modelo = new ModelCalculosDatos();
	
	//$NominaFiscal= $Modelo->ConsultarNominaFiscal($id_empresa,$id_nomina);
		// setear que las celdas autoajusten el ancho
	$objPHPExcel->getActiveSheet(0)->getColumnDimension('A:P')->setAutoSize(true);

	//Genero el Archivo excel


	$objPHPExcel->getActiveSheet(0)->setTitle('Activo_Inteligente');	
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);   //Consulto todas las empresas y las guardo en $lista empresas	
		
	while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){
            
      $razon_social= $row_empresas['razon_social'];
      $titular= $row_empresas['titular']; 
      $zona= $row_empresas['zona'];         
    }   	
		
	//se genera la consulta a mysql
	$objNomina = new cNomina();	              //Creamos el objeto $objEmpleados de la clase cEmpleado
	
	$datosNomina= $objNomina->consultar_nomina($id_nomina);  //consulto los datos generales de la nomina
	
	$listaNominas= $objNomina->consultar_nomina_empleados($id_nomina, $id_empresa);  //Consulto todas los empleados y las guardo en $lista empleados
	$listaNominas2= $objNomina->consultar_nomina_empleados($id_nomina, $id_empresa);  //Consulto todas los empleados y las guardo en $lista empleados

	while ($row_nomina = mysql_fetch_assoc($datosNomina)){ 
	//variables de nomina:
	
	$tipo_nomina= $row_nomina['tipo_nomina'];
	$total_factura= $row_nomina['total_factura'];
	$fecha_inicio= mysql_texto($row_nomina['inicio_periodo']);
	$fecha_fin= mysql_texto($row_nomina['fin_periodo']);	
	
	}

	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('C1', "ACTIVO INTELIGENTE");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('A2', "$razon_social");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('A3', "$tipo_nomina");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('A4', "$fecha_inicio a $fecha_fin ");
	
	$objPHPExcel->getActiveSheet(0)->SetCellValue('A6', "Clave");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B6', "Empleado");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('C6', "Sueldo");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('D6', "Banco");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('E6', "clv");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('F6', "Cuenta");
	
	$cont= 7;
	$clave=1;
	
	while ($row_empleados = mysql_fetch_assoc($listaNominas)){ 		

	$empleado= $row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
	$cuenta=  	$row_empleados['no_tarjeta'];
	
	$total_percepciones_empleado= (float)$row_empleados['total_sueldo'] + (float)$row_empleados['total_horas_extras'] + (float)$row_empleados['total_domingos_trabajados'] + (float)$row_empleados['total_turnos_trabajados'] + (float)$row_empleados['total_descanso_trabajado'] + (float)$row_empleados['total_dias_festivos'] + (float)$row_empleados['total_vacaciones'] + (float)$row_empleados['complemento_sueldo'] + (float)$row_empleados['otras_percepciones'] + (float)$row_empleados['aguinaldo'];
	
	$total_deducciones_empleado=  (float)$row_empleados['prestamos'] + (float)$row_empleados['caja_ahorro'] + (float)$row_empleados['fonacot'] + (float)$row_empleados['infonavit'] +  (float)$row_empleados['otras_deducciones'] + (float)$row_empleados['prestamo_ascon'] ;
	
	$percepcion_emp= $total_percepciones_empleado - $total_deducciones_empleado;


	$objPHPExcel->getActiveSheet(0)->getCell('A'.$cont)->setValueExplicit("$clave", PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B'.$cont, "$empleado");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('C'.$cont, "$percepcion_emp");
	$objPHPExcel->getActiveSheet(0)->getCell('D'.$cont)->setValueExplicit("072", PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet(0)->getCell('E'.$cont)->setValueExplicit("01", PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet(0)->getCell('F'.$cont)->setValueExplicit("$cuenta", PHPExcel_Cell_DataType::TYPE_STRING);
	$cont++;
	$clave++;		
	}

	//////////////////////////////////////////Nueva Hoja Grupo Humano//////////////////////////////////
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(1);
	$objPHPExcel->getActiveSheet(1)->setTitle('Grupo_Humano');

	$objPHPExcel->setActiveSheetIndex(1);
	$objPHPExcel->getActiveSheet(1)->SetCellValue('C1', "GRUPO HUMANO");
	$objPHPExcel->getActiveSheet(1)->SetCellValue('A2', "$razon_social");
	$objPHPExcel->getActiveSheet(1)->SetCellValue('A3', "$tipo_nomina");
	$objPHPExcel->getActiveSheet(1)->SetCellValue('A4', "$fecha_inicio a $fecha_fin ");
	
	$objPHPExcel->getActiveSheet(1)->SetCellValue('A6', "Clave");
	$objPHPExcel->getActiveSheet(1)->SetCellValue('B6', "Empleado");
	$objPHPExcel->getActiveSheet(1)->SetCellValue('C6', "Sueldo");
	$objPHPExcel->getActiveSheet(1)->SetCellValue('D6', "Banco");
	$objPHPExcel->getActiveSheet(1)->SetCellValue('E6', "clv");
	$objPHPExcel->getActiveSheet(1)->SetCellValue('F6', "Cuenta");
	
	$cont2= 7;
	$clave2=0;
	
	while ($row_empleados2 = mysql_fetch_assoc($listaNominas2)){ 		
	
	$clave2++;
	$empleado2 = $row_empleados2['nombre']." ".$row_empleados2['ap_paterno']." ".$row_empleados2['ap_materno'];
	$cuenta2=  	$row_empleados2['no_tarjeta'];  

	$objPHPExcel->getActiveSheet(1)->getCell('A'.$cont2)->setValueExplicit("$clave2", PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet(1)->SetCellValue('B'.$cont2, "$empleado2");
	$objPHPExcel->getActiveSheet(1)->SetCellValue('C'.$cont2, "0");
	$objPHPExcel->getActiveSheet(1)->getCell('D'.$cont2)->setValueExplicit("072", PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet(1)->getCell('E'.$cont2)->setValueExplicit("01", PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet(1)->getCell('F'.$cont2)->setValueExplicit("$cuenta2", PHPExcel_Cell_DataType::TYPE_STRING);

	$cont2++;	
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////

	$objPHPExcel->setActiveSheetIndex(0); //Establece que hoja es la que va aparecer activa cuando inicie el doc

	header ("Content-type: application/x-msexcel"); 
	header("Content-Disposition: attachment;filename=dispersion_nomina_".$id_nomina.".xls"); 

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');


	exit;
?>