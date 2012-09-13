<?php
require_once('../libs/php/tcpdf/config/lang/eng.php');
require_once('../libs/php/tcpdf/tcpdf.php');
require_once('reportes_clase.php');
require_once("../funcion_redondear.php");

$id_empresa= $_GET['id_empresa'];
$dia_inicio= $_GET['dia_inicio'];
$dia_final= $_GET['dia_final'];

$cadena= stripslashes($_GET['cadena']);
$cadena2= stripslashes($_GET['cadena2']);
$cadena3= stripslashes($_GET['cadena3']);
$cadena4= stripslashes($_GET['cadena4']);

$caden= $_GET['caden'];
$caden2= $_GET['caden2'];
$num= $_GET['num'];
$num2= $_GET['num2'];
	
        $arregloPercepciones = explode(',', $caden);
        $arregloDeducciones = explode(',', $caden2);
        
	$objReporte = new cReportes();	              //Creamos el objeto $objUsuario de la clase cUsuario
	
	if($id_empresa!=''){
            if($num!='' AND $num!=0) { 
                $listaNominasPercepciones= $objReporte->consultar_nominas_($id_empresa,$dia_inicio,$dia_final,$cadena,$cadena2);  //Consulto todas las empresas y las guardo en $lista usuarios
                $h=mysql_num_rows($listaNominasPercepciones);
                $Percepciones=mysql_fetch_array($listaNominasPercepciones);
                $listaNominasEmpresa= $objReporte->consultar_nominas_empresa($id_empresa,$dia_inicio,$dia_final,$cadena,$cadena2);  //Consulto todas las empresas y las guardo en $lista usuarios
             }
            if($num2!='' AND $num2!=0) {   
                $listaNominasDeduciones= $objReporte->consultar_nominas_Deducciones($id_empresa,$dia_inicio,$dia_final,$cadena3,$cadena4);  //Consulto todas las empresas y las guardo en $lista usuarios
                $Deducciones=mysql_fetch_array($listaNominasDeduciones);
            
            
                $NominasDeduciones= $objReporte->nominas_empresa_deducciones($id_empresa,$dia_inicio,$dia_final,$cadena3,$cadena4);  //Consulto todas las empresas y las guardo en $lista usuarios
            }
        
        }

	
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData('', '','Nóminas Empresa  '.$Percepciones[1].'','');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 05, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
//$pdf->Write(0, 'Venta Empresa x', 0, 'L', true, 0, false, false, 0);

	$html='<TABLE border="0" cellpadding="2" align="left" heigh="80%" width="30%" >';
	$html.="
	<tr>
	<td width='15%' colspan='2' align='right' >Fecha Inicio:</td><td width='15%' align='left' >".$dia_inicio."</td>
	<td width='15%' colspan='2' align='right' >Fecha Fin:</td><td width='15%' align='left' >".$dia_final."</td>
	</tr>";
	$html.='</TABLE><br/><br/>';  
        if($num!='' AND $num!=0) {  
         $html.="PERCEPCIONES<br/><br/><br/>";   
	$html.='<TABLE border="1" cellpadding="2" align="left" heigh="100%" width="100%" >';

         $html.="<tr><td>Datos Nómina</td>";
           for($j=0;$j<(count($arregloPercepciones)-1);$j++){
            $html.="<td align='center' >$arregloPercepciones[$j]</td>"; 
            }
                 $html.="</tr>";
                  $numv=0;
                    while ($NominasPercepciones=mysql_fetch_array($listaNominasEmpresa)){ 
                   $html.="<tr>";	
                   
                        while ($numv<=($num+2)){ 
                             if($numv==0){ 
                                   $html.="<td align='center'  >$NominasPercepciones[0] $NominasPercepciones[1] $NominasPercepciones[2]</td>";
                                   $numv=2;
                             }
                             else{ 
                                  $html.="<td align='center' >$ ".redondear($NominasPercepciones[$numv])."</td>";
                              }
                            $numv++;
                        }
                        $html.="</tr>";
                        $numv=0;
                    }
                    
               	
                 $html.="<tr><td></td>";
                  $num2v=2;
		 while ($num2v<=$num+2){ 
			$html.="
			<td>$ ".redondear($Percepciones[$num2v])."</td>";
                        $num2v++;	
		}
                 $html.="</tr>";
                
               // 
                
                $html.="</TABLE><br/><br/><br/><br/>";
            }

          if($num2!='' AND $num2!=0) { 
                 $html.="DEDUCCIONES<br/><br/><br/>";       
                $html.='<TABLE border="1" cellpadding="2" align="left" heigh="100%" width="100%" >';

         $html.="<tr><td>Datos Nómina</td>";
           for($a=0;$a<(count($arregloDeducciones)-1);$a++){
            $html.="<td align='center' >$arregloDeducciones[$a]</td>"; 
            }
		$html.="</tr>";
                  $numv2=0;
                    while ($NominasDeduccion=mysql_fetch_array($NominasDeduciones)){ 
                   $html.="<tr>";	
                   
                        while ($numv2<=($num2+2)){ 
                             if($numv2==0){ 
                                   $html.="<td align='center' >$NominasDeduccion[0] $NominasDeduccion[1] $NominasDeduccion[2]</td>";
                                   $numv2=2;
                             }
                             else{ 
                                  $html.="<td align='center' >$ ".redondear($NominasDeduccion[$numv2])."</td>";
                              }
                            $numv2++;
                        }
                        $html.="</tr>";
                        $numv2=0;
                    } 
                    
                     $html.="<tr><td></td>";
                  $nu2=2;
                    while ($nu2<=$num2+2){ 
			$html.="
			<td>$ ".redondear($Deducciones[$nu2])."</td>";
                        $nu2++;	
                    }
                    $html.="</tr>";
                
                $html.="</TABLE><br/><br/>";
                 }
		

$pdf->writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.

$pdf->Output('hh.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
?>