<?php
require_once('../libs/php/tcpdf/config/lang/eng.php');
require_once('../libs/php/tcpdf/tcpdf.php');
require_once('reportes_clase.php');
require_once("../funcion_redondear.php");

$NominasEmpresa= $_GET['NominasEmpresa'];
$idNomina= $_GET['idNomina'];
$dia_inicio= $_GET['dia_inicio'];
//$dia_final= $_GET['dia_final']; no sirve este
$cadena= stripslashes($_GET['cadena']);
$cadena2= stripslashes($_GET['cadena2']);
$cadena3= stripslashes($_GET['cadena3']);
$num= $_GET['num'];
$tipo= $_GET['tipo'];
$titulos= $_GET['titulos'];
$arregloTitulos = explode(',', $titulos);
	
	$objReporte = new cReportes();	              //Creamos el objeto $objUsuario de la clase cUsuario
        
        if($NominasEmpresa!=''){ 
                    
                $Empresa= $objReporte->nombreempresa($NominasEmpresa); 
                 $NombreEmpresa=mysql_fetch_assoc($Empresa); 
                
              if($tipo=='percepciones'){
                        $listaEmpleadoNominas= $objReporte->consultar_nominas_empleados($NominasEmpresa,$idNomina,$cadena,$cadena2,$cadena3);  
                }
                else {
                        $listaEmpleadoNominas= $objReporte->consultar_nominas_empleados_deduc($NominasEmpresa,$idNomina,$cadena,$cadena2);  
                    
                  }
         }

	
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData('', '','Empleados Nómina '.$idNomina.' de '.$NombreEmpresa['razon_social'].' ','');

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

	$html='<TABLE border="0" cellpadding="2" align="left" heigh="80%" width="40%" >';
	$html.="
	<tr>
	<td  align='right' >Periodo:</td><td align='left' >".$dia_inicio."</td>
	</tr>";
	$html.='</TABLE><br/><br/>';  
        if($num!='' AND $num!=0) {  
            
	$html.='<TABLE border="1" cellpadding="2" align="left" heigh="100%" width="100%" >';

         $html.="<tr><td>Nombre</td>";
           for($j=0;$j<(count($arregloTitulos)-1);$j++){
            $html.="<td align='center' >$arregloTitulos[$j]</td>"; 
            }
		$html.="</tr>";	
                 $num2=1;
                    while ($row_nom=mysql_fetch_array($listaEmpleadoNominas)){ 
                    $html.="<tr>"; 
                        while ($num2<=($num+3)){ 
                                if($num2==1){ 
                                      if($row_nom[1]!='0'){
                                            $html.="<td>$row_nom[1] $row_nom[2] $row_nom[3]</td>";
                                        }
                                     else{ 
                                         $html.="<td>Totales</td>";
                                          }
                                    $num2=3;
                                 }
                                 else{ 
                                     $html.="<td>$ ".redondear($row_nom[$num2])."</td>";
                                      }
                            $num2++;
                        }
                    $html.="</tr>";
                        $num2=1;
                    }
                 /*$html.="<tr><td></td>";
                  $num2v=2;
		 while ($num2v<=$num+2){ 
			$html.="
			<td>".redondear($Percepciones[$num2v])."</td>";
                        $num2v++;	
		}
                 $html.="</tr>";
                
                  $numv=0;
                    while ($NominasPercepciones=mysql_fetch_array($listaNominasEmpresa)){ 
                   $html.="<tr>";	
                   
                        while ($numv<=($num+2)){ 
                             if($numv==0){ 
                                   $html.="<td align='center' >$NominasPercepciones[0] $NominasPercepciones[1] $NominasPercepciones[2]</td>";
                                   $numv=2;
                             }
                             else{ 
                                  $html.="<td align='center' >".redondear($NominasPercepciones[$numv])."</td>";
                              }
                            $numv++;
                        }
                        $html.="</tr>";
                        $numv=0;
                    }*/
                
               // 
                
                $html.="</TABLE><br/><br/><br/><br/>";
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