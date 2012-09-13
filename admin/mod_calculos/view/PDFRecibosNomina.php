<?php

require_once('../../../libs/php/tcpdf/config/lang/eng.php');
require_once('../../../libs/php/tcpdf/tcpdf.php');
require_once('../../../libs/php/mvc/ModelBase.php');
require_once('../../../libs/php/mvc/SPDO.php');
require_once('../../../libs/php/mvc/Config.php');
require_once('../../../libs/php/mvc/ConfigBD.php');
require_once('../model/ModelCalculosDatos.php');
require_once('../../../funcion_redondear.php');

 $idEmpresa=$_GET['id_Emp'];

 $idNomina=$_GET['id_nomin'];

 $tipoNomina=$_GET['tipoNomina'];


//Creamos una instancia de nuestro "modelo"
$Modelo = new ModelCalculosDatos();

//Le pedimos al modelo todos los datos
$listado = $Modelo->ConsultarDatosNomina($idNomina);//datos generales
$Nomina = $listado->fetch();
$Fecha_Pago="Del ".$Nomina ["inicio_periodo"]." Al ".$Nomina ["fin_periodo"]."";

$PercepDeduc = $Modelo->ConsultarNominaFiscal($idEmpresa,$idNomina);//esta funcion NO utiliza el $id_empresa datos de la nomina fiscal
$PercepDeduc2 =$PercepDeduc->rowCount();//no es necesaria esta consulta, s epuede sustituir con mysql_row_query
/*foreach($PercepDeduc2 as $Todo) {
$NumRow=$Todo ['todo'];//se obtiene un numero..no es necesario este valor,ni operacion
}*/

$NumRow=$PercepDeduc2;
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
//$pdf->SetHeaderData('', '','RECIBOS DE NOMINA','');

// set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, 13, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 6, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$jornada=8;

function par($numero){      	
			if ($numero%2==0) 
			{ return true; } //mitad
			else //Sino
			{ return false;  } //--
	
}
$a=1;

$html="";

foreach($PercepDeduc as $EmpleadoPerc) {
$cont=0;

$sueldo_diario_imss=$EmpleadoPerc['sueldo_diario_imss'];

$Salario=$EmpleadoPerc ['p_sueldo_diario'];
$DiasTrabajados=$EmpleadoPerc ['p_dias_trabajados'];
$TotalSueldo=$EmpleadoPerc ['p_total_sueldo'];
$PrimaDominical=$EmpleadoPerc ['p_prima_dominical'];
$DomingosTrabajados=$EmpleadoPerc ['p_subtotal_domingos'];
$PrimaVacacional=$EmpleadoPerc ['p_prima_vacacional'];
$TotalVacaciones=$EmpleadoPerc ['p_subtotal_vacaciones'];
$TotalTurnosTrabajados=$EmpleadoPerc ['p_total_turnos_trabajados'];
$DescansosTrabajados=$EmpleadoPerc ['p_total_descansos_trabajados'];
$TotalHorasExtras=$EmpleadoPerc ['p_total_horas_extras'];
$DiasFestivos=$EmpleadoPerc ['p_total_dias_festivos'];

$Puntualidad=$EmpleadoPerc ['p_premio_por_puntualidad'];
$Asistencia=$EmpleadoPerc ['p_premio_por_asistencia'];
$Despensa=$EmpleadoPerc ['p_despensa'];
$BecasEducacionales=$EmpleadoPerc ['p_becas_educacionales'];

$OtrasPercepciones=$Puntualidad+$Asistencia+$BecasEducacionales;

$Aguinaldo=$EmpleadoPerc ['p_aguinaldo'];
$Subsidio=$EmpleadoPerc ['p_subsidio_empleo'];


$Prestamo=$EmpleadoPerc ['d_prestamos'];
$CajaAhorro=$EmpleadoPerc ['d_caja_ahorro'];
$OtrasDeducciones=$EmpleadoPerc ['d_total_otras_deducciones'];
$DescripOtrasDeducciones=$EmpleadoPerc ['d_descripcion_otras_deducciones'];
if($DescripOtrasDeducciones=='' or $DescripOtrasDeducciones==0){
	$DescripOtrasDeducciones='OTRAS DEDUCCIONES';
}

$Fonacot=$EmpleadoPerc ['d_fonacot'];
$Infonavit=$EmpleadoPerc ['d_infonavit'];
$ISR=$EmpleadoPerc ['d_ISR'];
$IMSS=$EmpleadoPerc ['d_IMSS'];


$TotalPercepciones= $TotalSueldo + 
                    $TotalHorasExtras +
					$DomingosTrabajados +
					$PrimaDominical +
					$TotalTurnosTrabajados + 
					$DescansosTrabajados +
					$DiasFestivos +
					$TotalVacaciones + 
					$PrimaVacacional +
					$Aguinaldo +
					$OtrasPercepciones +
					$Despensa+
					$Subsidio;    
					
$TotalDeducciones=$ISR + $IMSS + $Infonavit + $Prestamo + $CajaAhorro + $OtrasDeducciones + $Fonacot ;

	$NetoPagar=($TotalPercepciones) - ($TotalDeducciones);


/*-----------------------------------TABLA----------------------------------*/

$html.='<TABLE border="1" cellpadding="2" align="center" heigh="80%" width="100%" >';

$html.="
		<tr>
		    <td><b>RECIBO DE NOMINA</b></td>
		</tr>
		<tr>
		    <td><b>ACTIVO INTELIGENTE DEL SUR S.A. DE C.V.</b></td>
		</tr>
		<tr>
		    <td><b>ERICK PAOLO MARTINEZ MZA 98 LOTE 18,  COLONIA RESIDENCIAL CHETUMAL  R.F.C. AIS101105A99</b></td>
		</tr>
";

$html.='</table>';
/*-----------------------------------TABLA----------------------------------*/

/*----------------------------------------------------------------------------------------------------------------------*/

/*-----------------------------------TABLA----------------------------------*/
$html.='<TABLE border="1" cellpadding="2" align="left" heigh="80%" width="100%" >';

$html.='
		<tr>
		   <td>NOMBRE:</td>
		   <td colspan="7" >'.$EmpleadoPerc ['ap_paterno'].' '.$EmpleadoPerc ['ap_materno'].' '.$EmpleadoPerc ['nombre'].'</td>
		</tr>
';

$html.='
		<tr>
			<td>PERIODO:</td>
			<td width="23%" >'.$Fecha_Pago.'</td>
			<td width="8%" >CURP</td>
			<td width="17%" >'.$EmpleadoPerc ['curp_empleado'].'</td>
			<td width="10%" >RFC</td>
			<td width="9%" ></td>
			<td>NUMERO SS</td>
			<td width="8%" >'.$EmpleadoPerc ['no_seg_social'].'</td>
		</tr>
';


$html.='
		<tr>
			<td>DIAS LABORADOS:</td>
			<td width="23%" >'.$DiasTrabajados.'</td>
			<td width="8%" >HORAS X JORNADA</td>
			<td width="17%" >'.$jornada.'</td>
			<td width="10%" >HORAS TRABAJADAS</td>
			<td width="9%" >'.$DiasTrabajados*$jornada.'</td>
			<td>SALARIO DIARIO</td>
			<td width="8%" >'.$Salario.'</td>
		</tr>
';

$html.='</table>';
/*-----------------------------------TABLA----------------------------------*/

/*----------------------------------------------------------------------------------------------------------------------*/

/*-----------------------------------TABLA----------------------------------*/
$html.='<TABLE border="1" cellpadding="2" align="left" heigh="100%" width="100%" CELLPADDING="4" >';

$html.='
		<tr>
			<td colspan="3" align="center" >PERCEPCIONES</td>
			<td colspan="3" align="center" >DEDUCCIONES</td>
		</tr>
';

$html.='
		<tr>
			<td width="28%" >CONCEPTO:</td>
			<td width="22%" >IMPORTE</td>
			<td width="28%" >CONCEPTO:</td>
			<td width="22%">IMPORTE</td>
		</tr>
';
$html.='
<tr>
<td width="28%" >SUELDO:</td>
<td width="22%" >'.$TotalSueldo.'</td>
<td width="28%">ISR:</td>
<td width="22%" >'.$ISR.'</td>
</tr>
';
$html.='
<tr>
<td width="28%">SUBSIDIO AL EMPLEO:</td>
<td width="22%" >'.$Subsidio.'</td>
<td width="28%">IMSS:</td>
<td width="22%">'.$IMSS.'</td>
</tr>
';
$html.='
<tr>
<td width="28%">ASISTENCIA:</td>
<td width="22%" >'.$Asistencia.'</td>
<td width="28%" >INFONAVIT:</td>
<td width="22%" >'.$Infonavit.'</td>
</tr>
';
$html.='
<tr>
<td width="28%">PUNTUALIDAD:</td>
<td width="22%" >'.$Puntualidad.'</td>
<td width="28%" >PRESTAMO:</td>
<td width="22%" >'.$Prestamo.'</td>
</tr>
';
$html.='
<tr>
<td width="28%">BECAS EDUCACIONALES:</td>
<td width="22%" >'.$BecasEducacionales.'</td>
<td width="28%" >CAJA DE AHORRO:</td>
<td width="22%" >'.$CajaAhorro.'</td>
</tr>
';
$html.='
<tr>
<td width="28%">HORAS EXTRAS:</td>
<td width="22%" >'.$TotalHorasExtras.'</td>
<td width="28%" >FONACOT:</td>
<td width="22%" >'.$Fonacot.'</td>
</tr>
';
$html.='
<tr>
<td width="28%">DOMINGOS TRABAJADOS:</td>
<td width="22%" >'.$DomingosTrabajados.'</td>
<td width="28%">'.strtoupper($DescripOtrasDeducciones).':</td>
<td width="22%" >'.$OtrasDeducciones.'</td>
</tr>
';
$html.='
<tr>
<td width="28%">PRIMA DOMINICAL:</td>
<td width="22%" >'.$PrimaDominical.'</td>
<td width="28%" ></td><td width="22%" >
</td>
</tr>
';
if($Despensa>0){
$html.='
<tr>
<td width="28%">DESPENSA:</td>
<td width="22%" >'.$Despensa.'</td>
<td width="28%" ></td>
<td width="22%" ></td>
</tr>
';
$cont++;
}
if($TotalVacaciones>0){
$html.='
<tr>
<td width="28%">VACACIONES:</td>
<td width="22%" >'.$TotalVacaciones.'</td>
<td width="28%" ></td>
<td width="22%" ></td>
</tr>
';
$cont++;
}
if($PrimaVacacional>0){  
$html.='
<tr>
<td width="28%">PRIMA VACACIONAL:</td>
<td width="22%" >'.$PrimaVacacional.'</td>
<td width="28%" ></td>
<td width="22%" ></td>
</tr>
';
$cont++;
}
if($DiasFestivos>0){  
$html.='
<tr>
<td width="28%">DIAS FESTIVOS:</td>
<td width="22%" >'.$DiasFestivos.'</td>
<td width="28%" ></td>
<td width="22%" ></td>
</tr>
';
$cont++;
}
if($Aguinaldo>0){  
$html.='
<tr>
<td width="28%">AGUINALDO:</td>
<td width="22%" >'.$Aguinaldo.'</td>
<td width="28%" ></td>
<td width="22%" ></td>
</tr>
';
$cont++;
}
if($TotalTurnosTrabajados>0){  
$html.='
<tr>
<td width="28%">TURNOS TRABAJADOS:</td>
<td width="22%" >'.$TotalTurnosTrabajados.'</td>
<td width="28%" ></td>
<td width="22%" ></td>
</tr>
';
$cont++;
}
if($DescansosTrabajados>0){  
$html.='
<tr>
<td width="28%">DESCANSOS TRABAJADOS:</td>
<td width="22%" >'.$DescansosTrabajados.'</td>
<td width="28%" ></td>
<td width="22%" ></td>
</tr>
';
$cont++;
} 
$html.='
<tr>
<td align="right" >TOTAL PERCEPCIONES:</td>
<td>'.$TotalPercepciones.'</td>
<td align="right" >TOTAL DEDUCCIONES:</td>
<td >'.$TotalDeducciones.'</td>
</tr>
';
$html.='
<tr>
<td></td>
<td></td>
<td align="right" >NETO A PAGAR:</td>
<td>'.$NetoPagar.'</td>
</tr>
';
$html.='</table>';

/*-----------------------------------TABLA----------------------------------*/
$html.='<br/><br/><br/>';
/*----------------------------------------------------------------------------------------------------------------------*/

/*-----------------------------------TABLA----------------------------------*/


$html.='<TABLE border="0" cellpadding="2" align="left" heigh="100%" width="100%" >';

$html.='
		<tr>
		     <td align="justify" >RECIBI: LA CANTIDAD NETA A QUE ESTE DOCUMENTO SE REFIERE, ESTANDO CONFORME CON LAS PERCEPCIONES Y DEDUCCIONES QUE EN EL APARECEN ESPECIFICADOS</td>
		     <td align="center" >________________________________________________<br/>    FIRMA DEL TRABAJADOR</td>
		</tr>';

$html.='</table>';

/*-----------------------------------TABLA----------------------------------*/
		$conti=7-$cont;
		if($conti>0){
		$html.='<TABLE border="0" cellpadding="2" align="left" heigh="100%" width="100%" >';
		for ( $i = 0; $i < $conti ; $i ++) {
			$html.='
				<tr>
					 <td align="right" ></td>
					 <td></td>
					<td align="right" ></td>
					<td ></td>
				</tr>';
		}
		$html.='</table>';
		}
		
			if(par($a)==true){	
				$html.='<br/><br/>';
			} 
			else{	
				$html.='<br/><br/>';
			} 
//$html.='<br/><br/><br/><br/><br/>';
//$html.='-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------';
//$html.='<br/><br/>';
	$a++;
}
$pdf->writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');

// ---------------------------------------------------------
/* foreach($listado2 as $Articulo) {
	$Total=$Articulo ["aal_costo"]*$Articulo ["inv_existencias"];
	$Existencia=$Articulo ["inv_existencias"];
	$html.="<tr><td>".$Articulo ["ar_codbarras"]."</td><td>".$Articulo ["ar_nomarticulo"]."</td><td>".$Articulo ["aal_costo"]."</td><td>".$Existencia."</td><td>".$Total."</td></tr>";
	$TotalExistencias=$TotalExistencias+$Existencia;
	$TotaldeTotales=$TotaldeTotales+$Total;
	}
$html.="<tr><td><b>Totales</b></td><td></td><td></td><td>".$TotalExistencias."</td><td>".$TotaldeTotales."</td></tr>"; */
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('InventarioConteo.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>