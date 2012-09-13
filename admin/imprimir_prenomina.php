<?php 



	include_once("nominas_clase.php");
	include_once("empresa_clase.php");
	include_once("../convertir_fechas.php");
	
	
	
	 $id_empresa= $_POST['id_empresa'];
	 $id_nomina=  $_POST['id_nomina'];
			
		
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
	
	while ($row_nomina = mysql_fetch_assoc($datosNomina)){ 
	
	//variables de nomina:
	$percepciones= $row_nomina['percepciones'];
	$honorarios= $row_nomina['honorarios'];
	$relativos= $row_nomina['relativos'];
	$subtotal= $row_nomina['subtotal'];
	$iva= $row_nomina['iva'];
	$tipo_nomina= $row_nomina['tipo_nomina'];
	$total_factura= $row_nomina['total_factura'];
	$fecha_inicio= mysql_texto($row_nomina['inicio_periodo']);
	$fecha_fin= mysql_texto($row_nomina['fin_periodo']);
	$observaciones= $row_nomina['observaciones'];
	
}
	
	$shtml="";
	//imprimo Los titulos del reporte.
	$shtml= $shtml."<br/>"."<strong>EMPRESA: &nbsp;&nbsp;&nbsp;&nbsp;   NAVITAS S.A. DE C.V.</strong>"."<br/>";
	$shtml= $shtml."<strong>CLIENTE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   ".$razon_social."</strong>"."<br/>";
	$shtml= $shtml."<strong>ZONA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   ".$zona."</strong>"."<br/>";
	$shtml= $shtml."<strong>NOMINA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ". strtoupper($tipo_nomina) ."</strong>"."<br/>";
	$shtml= $shtml."<strong>PERIODO: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$fecha_inicio."&nbsp;&nbsp; AL &nbsp;&nbsp;".$fecha_fin."</strong>";	
	$shtml= $shtml."<br/>";
	$shtml= $shtml."<br/>";
	
	
	
	//imprimo los encabezados de la nomina
	$shtml = $shtml."<table  border='0' cellspacing='2' cellpadding='0' >
  <tr>
    <td colspan='16' align='center' bgcolor='#0099CC'>PERCEPCIONES</td>
        <td  align='center'>&nbsp;</td>
    <td colspan='7' align='center' bgcolor='#99FF66'>DEDUCCIONES</td>
     <td  align='center'>&nbsp;</td>
      <td  align='center' bgcolor='#FF3300'>&nbsp;</td>
  </tr>
  <tr >
    <td  bgcolor='#00CCFF'>&nbsp;Empleado</td>
    <td bgcolor='#00CCFF' align='center'>&nbsp;Sueldo Diario</td>
    <td bgcolor='#00CCFF' align='center'>&nbsp;Dias Trabajados</td>
    <td bgcolor='#00CCFF' align='center'>&nbsp;Sueldo</td>
    <td bgcolor='#00CCFF' align='center'>&nbsp;Horas extras</td>
    <td bgcolor='#00CCFF' align='center'>Domingos trabajados</td>
	<td bgcolor='#00CCFF' align='center'>Prima Dominical</td>
    <td bgcolor='#00CCFF' align='center'>Turnos trabajados</td>
    <td bgcolor='#00CCFF' align='center'>Descansos Trabajados</td>
    <td bgcolor='#00CCFF' align='center'>Dias Festivos</td>
    <td bgcolor='#00CCFF' align='center'>Vacaciones</td>
	<td bgcolor='#00CCFF' align='center'>Prima Vacacional</td>
	<td bgcolor='#00CCFF' align='center'>Aguinaldo</td>
    <td bgcolor='#00CCFF' align='center'>Complemento Sueldo</td>
    <td bgcolor='#00CCFF' align='center'>&nbsp;Otras Percepciones</td>
    <td bgcolor='#00CCFF' align='center'>&nbsp;Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    
    
    <td bgcolor='#99FF99' align='center'>&nbsp;Prestamos</td>
    <td bgcolor='#99FF99' align='center'>&nbsp;Caja Ahorro</td>
    <td bgcolor='#99FF99' align='center'>&nbsp;Fonacot</td>
    <td bgcolor='#99FF99' align='center'>Infonavit</td>
    <td bgcolor='#99FF99' align='center'>&nbsp;Otras deducciones</td>
    <td bgcolor='#99FF99' align='center'>&nbsp;Prestamo navitas</td>
    <td bgcolor='#99FF99' align='center'>&nbsp;Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor='#FF3300' align='center'>&nbsp;TOTAL</td>
  </tr>";

	$total_percepciones = 0;
	$total_deducciones = 0;
	while ($row_empleados = mysql_fetch_assoc($listaNominas)){ 
	
	
	$shtml = $shtml."<tr>";
	$shtml = $shtml."<td>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno']."</td>";
	
	$total_percepciones_empleado= (float)$row_empleados['total_sueldo'] + 
	                              (float)$row_empleados['total_horas_extras'] + 
								  (float)$row_empleados['total_domingos_trabajados'] + 
								  (float)$row_empleados['total_turnos_trabajados'] + 
								  (float)$row_empleados['total_descanso_trabajado'] + 
								  (float)$row_empleados['total_dias_festivos'] + 
								  (float)$row_empleados['total_vacaciones'] + 
								  (float)$row_empleados['aguinaldo'] + 
								  (float)$row_empleados['complemento_sueldo'] + 
								  (float)$row_empleados['otras_percepciones'];
	
	$total_deducciones_empleado=  (float)$row_empleados['prestamos'] + (float)$row_empleados['caja_ahorro'] + (float)$row_empleados['fonacot'] + (float)$row_empleados['infonavit'] +  (float)$row_empleados['otras_deducciones'] + (float)$row_empleados['prestamo_ascon'] ;
	
	$gran_total_empleado= $total_percepciones_empleado - $total_deducciones_empleado;
	
	$total_percepciones+= $total_percepciones_empleado;
	$total_deducciones+= $total_deducciones_empleado;
	
	$shtml = $shtml.
	"<td >".$row_empleados['sueldo_diario_emp']."</td>
    <td >".$row_empleados['dias_trabajados']."</td>
    <td >".$row_empleados['total_sueldo']."</td>
    <td >".$row_empleados['total_horas_extras']."</td>
    <td >".$row_empleados['total_domingos_trabajados']."</td>
	<td >".$row_empleados['prima_dominical']."</td>
    <td >".$row_empleados['total_turnos_trabajados']."</td>
    <td >".$row_empleados['total_descanso_trabajado']."</td>
    <td >".$row_empleados['total_dias_festivos']."</td>
    <td >".$row_empleados['total_vacaciones']."</td>
	<td >".$row_empleados['prima_vacacional']."</td>
	<td >".$row_empleados['aguinaldo']."</td>
    <td >".$row_empleados['complemento_sueldo']."</td>
    <td >".$row_empleados['otras_percepciones']."</td>
    <td >".$total_percepciones_empleado."</td>
	
    <td>&nbsp;&nbsp;&nbsp;</td>    
    
	
	
    <td >".$row_empleados['prestamos']."</td>
    <td >".$row_empleados['caja_ahorro']."</td>
    <td >".$row_empleados['fonacot']."</td>
    <td >".$row_empleados['infonavit']."</td>
    <td >".$row_empleados['otras_deducciones']."</td>
    <td >".$row_empleados['prestamo_ascon']."</td>
    <td >".$total_deducciones_empleado."</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td >".$gran_total_empleado."</td></tr>";
	
	
	}
	
	$gran_total=  $total_percepciones - $total_deducciones;
	
		 $shtml = $shtml.
	"<tr><td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >Total Percepciones: &nbsp;".$total_percepciones."</td>
	
    <td>&nbsp;&nbsp;&nbsp;</td>    
    
	
	
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >Total Deducciones &nbsp;".$total_deducciones."</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td >".$gran_total."</td></tr>";
	
	
	
	
$shtml = $shtml."</table>";	







//Imprimo los datos de facturacion

	$shtml= $shtml."<br/>";
	$shtml= $shtml."<br/>";
	
	$shtml= $shtml."
<table  border='0' cellspacing='5' cellpadding='33'>
  <tr>
    <td>&nbsp;<strong>PERCEPCIONES:</strong> </td>
    <td>&nbsp;$".$percepciones."</td>
  </tr>
  <tr>
    <td>&nbsp;<strong>HONORARIOS:</strong> </td>
    <td>&nbsp;$".$honorarios."</td>
  </tr>
  <tr>
    <td>&nbsp;<strong>RELATIVOS:</strong></td>
    <td>&nbsp;$".$relativos."</td>
  </tr>
  <tr>
    <td>&nbsp;<strong>SUBTOTAL: </strong> </td>
    <td>&nbsp;$".$subtotal."</td>
  </tr>
  <tr>
    <td>&nbsp;<strong>IVA: </strong></td>
    <td>&nbsp;$".$iva."</td>
  </tr>
  <tr>
    <td>&nbsp;<strong>TOTAL FACTURA:</strong></td>
    <td>&nbsp; $".$total_factura."</td>
  </tr>  
</table>";

$shtml= $shtml."<br/>";
$shtml= $shtml."<div style='width:1000'>&nbsp;<strong>OBSERVACIONES:</strong> 
    &nbsp;&nbsp;&nbsp;&nbsp;".$observaciones." </div>";



//Genero el Archivo excel
$scarpeta="../reportes"; //carpeta donde guardar el archivo.
//debe tener permisos 775 por lo menos
$sfile=$scarpeta."/nomina_".$id_nomina.".xls"; //ruta del archivo a generar
$fp=fopen($sfile,"w");
fwrite($fp,$shtml);
fclose($fp);


echo "REPORTE DE NOMINA GENERADO";

?>