<?php 
	require_once('../../../libs/php/mvc/ModelBase.php');
	require_once('../../../libs/php/mvc/SPDO.php');
	require_once('../../../libs/php/mvc/Config.php');
	//require_once('../../../libs/php/mvc/configBD.php');
	require_once('../../../libs/php/mvc/ConfigBD.php');
	require_once('../model/ModelCalculosDatos.php');
	require_once('../../../funcion_redondear.php');
	include '../../../php_excel/Classes/PHPExcel.php';
	//require_once('../funcion_redondear.php');
	
	$objPHPExcel = new PHPExcel();
	// setear que las celdas autoajusten el ancho
	$objPHPExcel->getActiveSheet(0)->getColumnDimension('A:P')->setAutoSize(true);

	//Genero el Archivo excel
	$objPHPExcel->getActiveSheet(0)->setTitle('Nomina Fiscal');	
	
	 $id_empresa= $_GET['id_empresa'];
	 $id_nomina=  $_GET['id_nomina'];
		
	//Creamos una instancia de nuestro "modelo"
	$Modelo = new ModelCalculosDatos();

	//Le pedimos al modelo todos los datos
	$listado = $Modelo->ConsultarDatosNomina($id_nomina);
	$Nomina = $listado->fetch();  	
	$razon_social=$Nomina['razon_social'];
	$zona=$Nomina['zona'];
	$NominaFiscal= $Modelo->ConsultarNominaFiscal($id_empresa,$id_nomina);
		
	//variables de nomina:
	$percepciones= $Nomina['percepciones'];
	$honorarios= $Nomina['honorarios'];
	$relativos= $Nomina['relativos'];
	$subtotal= $Nomina['subtotal'];
	$iva= $Nomina['iva'];
	$tipo_nomina= $Nomina['tipo_nomina'];
	$total_factura= $Nomina['total_factura'];
	$fecha_inicio= $Nomina['inicio_periodo'];
	$fecha_fin= $Nomina['fin_periodo'];
	$observaciones= $Nomina['observaciones'];
	
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');

	$objPHPExcel->getDefaultStyle()->getFont()->setSize(8);
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B2', "NOMINA FISCAL");
	$objPHPExcel->getActiveSheet(0)->mergeCells('B2:U2');
	$objPHPExcel->getActiveSheet(0)->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B5', "CLIENTE: $razon_social ");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B6', "NOMINA: $id_nomina");
	
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B9', "PERCEPCIONES");
	$objPHPExcel->getActiveSheet(0)->mergeCells('B9:W9');
	$objPHPExcel->getActiveSheet()->getStyle('B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B10', "Empleado");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('C10', "Sueldo Diario");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('D10', "Dias Trabajados");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('E10', "Sueldo");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('F10', "Num. Domingos Trabajados");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('G10', "Total Domingos Trabajados");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('H10', "Prima Dominical");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('I10', "Num. Vacaciones");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('J10', "Total vac.");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('K10', "Prima Vacacional");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('L10', "Num Turnos Trab.");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('M10', "Total Turnos Trab.");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('N10', "Num Descansos Trab.");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('O10', "Total Descansos Trab.");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('P10', "Num H.E.");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('Q10', "Total H.E.");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('R10', "Num Dias Festivos");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('S10', "Total Dias Festivos");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('T10', "Aguinaldo");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('U10', "Subsidio al Empleo");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('V10', "Puntualidad");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('W10', "Despensa");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('X10', "Asistencia");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('Y10', "Becas Educacionales");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('Z10', "Total Percepcion");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AB9', "DEDUCCIONES");
	$objPHPExcel->getActiveSheet(0)->mergeCells('AB9:AK9');
	$objPHPExcel->getActiveSheet()->getStyle('AB9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AB10', "Prestamos");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AC10', " Caja Ahorro");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AD10', "Fonacot");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AE10', "Infonavit");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AF10', "ISR");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AG10', "IMSS");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AH10', "Descripción Otras deducciones");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AI10', "Otras deducciones");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AJ10', "Total Deduccion");
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AK10', "TOTAL");

	$cont= 11;
	foreach($NominaFiscal as $EmpleadoPerc) {
	
	$Salario=$EmpleadoPerc ['p_sueldo_diario'];
	$DiasTrabajados=$EmpleadoPerc ['p_dias_trabajados'];
	$TotalDomingos=$EmpleadoPerc ['p_subtotal_domingos'];
	$TotalSueldo=$EmpleadoPerc ['p_total_sueldo'];
	$TotalHorasExtras=$EmpleadoPerc ['p_total_horas_extras'];
	$TotalVacaciones=$EmpleadoPerc ['p_subtotal_vacaciones'];
	$PrimaVacacional=$EmpleadoPerc ['p_prima_vacacional'];
	$Puntualidad=$EmpleadoPerc ['p_premio_por_puntualidad'];
	$Asistencia=$EmpleadoPerc ['p_premio_por_asistencia'];
	$Despensa=$EmpleadoPerc ['p_despensa'];
	$BecasEducacionales=$EmpleadoPerc ['p_becas_educacionales'];
	$OtrasPercepciones=$Puntualidad+$Asistencia+$BecasEducacionales;
	$TotalTurnosTrabajados=$EmpleadoPerc ['p_total_turnos_trabajados'];
	$DescansosTrabajados=$EmpleadoPerc ['p_total_descansos_trabajados'];
	$Subsidio=$EmpleadoPerc ['p_subsidio_empleo'];
	$DomingosTrabajados=$EmpleadoPerc ['p_subtotal_domingos'];
	$PrimaDominical=$EmpleadoPerc ['p_prima_dominical'];
	$DiasFestivos=$EmpleadoPerc ['p_total_dias_festivos'];
	$Aguinaldo=$EmpleadoPerc ['p_aguinaldo'];
	$Prestamo=$EmpleadoPerc ['d_prestamos'];
	$CajaAhorro=$EmpleadoPerc ['d_caja_ahorro'];
	$OtrasDeducciones=$EmpleadoPerc ['d_total_otras_deducciones'];
	$Fonacot=$EmpleadoPerc ['d_fonacot'];
	$ISR=$EmpleadoPerc ['d_ISR'];
	$IMSS=$EmpleadoPerc ['d_IMSS'];
	$Infonavit=$EmpleadoPerc ['d_infonavit'];

	$TotalPercepcionEmpleado=$TotalSueldo + $TotalVacaciones + $PrimaVacacional + $OtrasPercepciones + $Subsidio + $DomingosTrabajados + $PrimaDominical + $DiasFestivos + $Aguinaldo + $TotalHorasExtras + $TotalTurnosTrabajados + $DescansosTrabajados + $Despensa;    
	$TotalDeduccionesEmpleado=$ISR + $IMSS + $Infonavit + $Prestamo + $CajaAhorro + $OtrasDeducciones + $Fonacot ;
	//$NetoPagar=$EmpleadoPerc ['total_ReciboNomina'];
	if($TotalDeducciones<0){
		$NetoPagar=($TotalPercepcionEmpleado) + ($TotalDeduccionesEmpleado);
	}
	else{
		$NetoPagar=$TotalPercepcionEmpleado - $TotalDeduccionesEmpleado;
	}
	
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B'.$cont, $EmpleadoPerc['nombre']);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('C'.$cont, $EmpleadoPerc['p_sueldo_diario'] );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('D'.$cont, $EmpleadoPerc['p_dias_trabajados'] );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('E'.$cont, $TotalSueldo );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('F'.$cont, $EmpleadoPerc['p_num_domingos_trabajados'] );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('G'.$cont, $TotalDomingos);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('H'.$cont, $PrimaDominical );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('I'.$cont, $EmpleadoPerc['p_num_vacaciones'] );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('J'.$cont, $TotalVacaciones);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('K'.$cont, $PrimaVacacional );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('L'.$cont, $EmpleadoPerc['p_num_turnos_trabajados'] );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('M'.$cont, $TotalTurnosTrabajados);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('N'.$cont, $EmpleadoPerc['p_num_descansos_trabajados'] );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('O'.$cont, $DescansosTrabajados );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('P'.$cont, $EmpleadoPerc['p_num_horas_extras'] );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('Q'.$cont, $TotalHorasExtras );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('R'.$cont, $EmpleadoPerc['p_num_dias_festivos'] );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('S'.$cont, $DiasFestivos );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('T'.$cont, $Aguinaldo );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('U'.$cont, $Subsidio );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('V'.$cont, $Puntualidad );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('W'.$cont, $Despensa);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('X'.$cont, $Asistencia);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('Y'.$cont, $BecasEducacionales );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('Z'.$cont, $TotalPercepcionEmpleado );

	$objPHPExcel->getActiveSheet(0)->SetCellValue('AB'.$cont, $Prestamo );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AC'.$cont, $CajaAhorro );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AD'.$cont, $Fonacot);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AE'.$cont, $Infonavit );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AF'.$cont, $ISR );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AG'.$cont, $IMSS );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AH'.$cont, $EmpleadoPerc['d_descripcion_otras_deducciones'] );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AI'.$cont, $OtrasDeducciones );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AJ'.$cont, $TotalDeduccionesEmpleado );
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AK'.$cont, $NetoPagar );
	
	
	
	////////////////////////////////////////////////////////////////////////Totales//////////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////Total de Percepciones///////////////////////////////////
	$SueldoDiario=$SueldoDiario + $EmpleadoPerc['p_sueldo_diario'];
	$Sueldo=$Sueldo + $TotalSueldo;
	$Total_Domingos_Trabajados=$Total_Domingos_Trabajados + $TotalDomingos;
	$Prima_Dominical=$Prima_Dominical + $PrimaDominical;
	$Total_vac=$Total_vac + $TotalVacaciones;
	$Prima_Vacacional=$Prima_Vacacional + $PrimaVacacional;
	$Total_Turnos_Trab=$Total_Turnos_Trab + $TotalTurnosTrabajados;
	$Total_Descansos_Trab=$Total_Descansos_Trab + $DescansosTrabajados;
	$Total_Horas_Exras=$Total_Horas_Exras + $TotalHorasExtras;
	$Total_Dias_Festivos=$Total_Dias_Festivos + $DiasFestivos;
	$Total_Aguinaldo=$Total_Aguinaldo + $Aguinaldo;
	$Subsidio_Empleo=$Subsidio_Empleo + $Subsidio;
	$Total_Puntualidad=$Total_Puntualidad + $Puntualidad;
	$Total_Asistencia=$Total_Asistencia + $Asistencia;
	$Total_Despensa=$Total_Despensa + $Despensa;
	$Total_Becas_Educacionales=$Total_Becas_Educacionales + $BecasEducacionales;
	
	//////////////////////////////Total Deducciones///////////////////////////////////
	
	$TotalPrestamos=$TotalPrestamos + $Prestamo;
	$Total_Caja_Ahorro=$Total_Caja_Ahorro + $CajaAhorro;
	$TotalFonacot=$TotalFonacot + $Fonacot;
	$TotalInfonavit=$TotalInfonavit + $Infonavit;
	$TotalISR=$TotalISR + $ISR;
	$TotalIMSS=$TotalIMSS + $IMSS;
	$Total_Otras_deducciones=$Total_Otras_deducciones + $OtrasDeducciones;
	
	////////////////////////////////////////////////////////////////////////FIN Totales//////////////////////////////////////////////////////////////////////////
	
	$TotalPercepcionesNomina=$TotalPercepcionesNomina+$TotalPercepcionEmpleado;
	$TotalDeduccionesNomina=$TotalDeduccionesNomina+$TotalDeduccionesEmpleado;
	$TotalNomina=$TotalNomina+$NetoPagar;
	
	$cont++;
	
	
	
	
	}
	$conti=$cont+1;
	$conti2=$cont+2;
	$conti3=$cont+3;

	
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B'.$cont, 'Totales:');
	$objPHPExcel->getActiveSheet(0)->SetCellValue('C'.$cont, $SueldoDiario);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('E'.$cont, $Sueldo);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('G'.$cont, $Total_Domingos_Trabajados);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('H'.$cont, $Prima_Dominical);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('J'.$cont, $Total_vac);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('K'.$cont, $Prima_Vacacional);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('M'.$cont, $Total_Turnos_Trab);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('O'.$cont, $Total_Descansos_Trab);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('Q'.$cont, $Total_Horas_Exras);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('S'.$cont, $Total_Dias_Festivos);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('T'.$cont, $Total_Aguinaldo);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('U'.$cont, $Subsidio_Empleo);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('V'.$cont, $Total_Puntualidad);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('W'.$cont, $Total_Despensa);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('X'.$cont, $Total_Asistencia);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('Y'.$cont, $Total_Becas_Educacionales);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('Z'.$cont, $TotalPercepcionesNomina);
	
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AB'.$cont, $TotalPrestamos);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AC'.$cont, $Total_Caja_Ahorro);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AD'.$cont, $TotalFonacot);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AE'.$cont, $TotalInfonavit);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AF'.$cont, $TotalISR);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AG'.$cont, $TotalIMSS);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AI'.$cont, $Total_Otras_deducciones);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AJ'.$cont, $TotalDeduccionesNomina);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('AK'.$cont, $TotalNomina);
	
	/* $objPHPExcel->getActiveSheet(0)->SetCellValue('B'.$conti, 'Total Percepciones:  '.$TotalPercepcionesNomina);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B'.$conti2, 'Total Deduciones: '.$TotalDeduccionesNomina);
	$objPHPExcel->getActiveSheet(0)->SetCellValue('B'.$conti3, 'Total Nomina: '.$TotalNomina);  */
	
	$objPHPExcel->setActiveSheetIndex(0); //Establece que hoja es la que va aparecer activa cuando inicie el doc
	
	header ("Content-type: application/x-msexcel"); 
	header('Content-Disposition: attachment;filename="NominaFiscal_'.$id_nomina.'.xls"');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');


	exit;

?>