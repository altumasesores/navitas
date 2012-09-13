
<a href="javascript:cargarPagina('consultar_nominas.php','mainContent')" ><img src="../imagenes/anterior.png" width="24" height= "24" title="Anterior"/>Regresar al listado de Nóminas</a>
<br/><br/>


<?php 

	include_once("../admin/nominas_clase.php");
	include_once("../admin/empresa_clase.php");
	include_once("../funcion_redondear.php");
	include_once("../convertir_fechas.php");
	
	 
	 $id_empresa=   $_POST['id_empresa'];
	 $id_nomina=    $_POST['id_nomina'];

	
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);  //Consulto todas las empresas y las guardo en $lista empresas	

	

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
	$percepciones= redondear($row_nomina['percepciones']);
	$honorarios= redondear($row_nomina['honorarios']);
	$relativos= redondear($row_nomina['relativos']);
	$subtotal= redondear($row_nomina['subtotal']);
	$iva= redondear($row_nomina['iva']);
	$estado= $row_nomina['estado'];
	$tipo_nomina= $row_nomina['tipo_nomina'];
	$total_factura= redondear($row_nomina['total_factura']);
	$fecha_inicio= mysql_texto($row_nomina['inicio_periodo']);
	$fecha_fin= mysql_texto($row_nomina['fin_periodo']);
}


?>
<strong>
<table border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td>CLIENTE:</td>
    <td><?php echo $razon_social; ?></td>
  </tr>
  <tr>
    <td>ZONA:</td>
    <td><?php echo $zona; ?></td>
  </tr>
  <tr>
    <td>NOMINA: </td>
    <td><?php echo strtoupper($tipo_nomina); ?></td>
  </tr>
  <tr>
    <td>PERIODO:</td>
    <td><?php echo $fecha_inicio." AL ".$fecha_fin; ?></td>
  </tr>
  <tr>
    <td>ESTADO: </td>
    <td><?php echo $estado; ?></td>
  </tr>
</table>
</strong>
<br /><br />



<!-- 	//imprimo los encabezados de la nomina-->

<table  border='0' cellspacing='2' cellpadding='0'  >
  <tr>
    <td colspan='14' align='center' bgcolor='#0099CC'>PERCEPCIONES</td>
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
    <td bgcolor='#00CCFF' align='center'>Turnos trabajados</td>
    <td bgcolor='#00CCFF' align='center'>Descansos Trabajados</td>
    <td bgcolor='#00CCFF' align='center'>Dias Festivos</td>
    <td bgcolor='#00CCFF' align='center'>Vacaciones</td>
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
  </tr>



<?php 


	$total_percepciones = 0;
	$total_deducciones = 0;
	
	while ($row_empleados = mysql_fetch_assoc($listaNominas)){ 
	
	
	echo "<tr >";
	echo "<td nowrap='nowrap'>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno']."</td>";
	
	$total_percepciones_empleado= (float)$row_empleados['total_sueldo'] + (float)$row_empleados['total_horas_extras'] + (float)$row_empleados['total_domingos_trabajados'] + (float)$row_empleados['total_turnos_trabajados'] + (float)$row_empleados['total_descanso_trabajado'] + (float)$row_empleados['total_dias_festivos'] + (float)$row_empleados['total_vacaciones'] +(float)$row_empleados['aguinaldo'] + (float)$row_empleados['complemento_sueldo'] + (float)$row_empleados['otras_percepciones'];
	
	$total_deducciones_empleado=  (float)$row_empleados['prestamos'] + (float)$row_empleados['caja_ahorro'] + (float)$row_empleados['fonacot'] + (float)$row_empleados['infonavit'] +  (float)$row_empleados['otras_deducciones'] + (float)$row_empleados['prestamo_ascon'] ;
	
	$gran_total_empleado= $total_percepciones_empleado - $total_deducciones_empleado;
	
	$total_percepciones+= $total_percepciones_empleado;
	$total_deducciones+= $total_deducciones_empleado;
	
	echo 
	"<td >".$row_empleados['sueldo_diario_emp']."</td>
    <td >".$row_empleados['dias_trabajados']."</td>
    <td >".$row_empleados['total_sueldo']."</td>
    <td >".$row_empleados['total_horas_extras']."</td>
    <td >".$row_empleados['total_domingos_trabajados']."</td>
    <td >".$row_empleados['total_turnos_trabajados']."</td>
    <td >".$row_empleados['total_descanso_trabajado']."</td>
    <td >".$row_empleados['total_dias_festivos']."</td>
    <td >".$row_empleados['total_vacaciones']."</td>
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
	
echo 
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
    <td >Total Percepciones: &nbsp;</td>
	
    <td align='right'><strong>".$total_percepciones."</strong></td>    
    
	
	
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >Total Deducciones: &nbsp;</td>
    <td align='right'><strong>".$total_deducciones."</strong></td>
	<td >&nbsp;TOTAL:</td>
    <td align='right'><strong>".$gran_total."</strong></td></tr>";
	
	
	
	
echo "</table>";	

?>

<br />
	
	
<table id="box-table-a">
  <tr>
    <td>&nbsp;<strong>PERCEPCIONES:</strong> </td>
    <td>&nbsp;$<?php echo $percepciones ; ?></td>
  </tr>
  <tr>
    <td>&nbsp;<strong>HONORARIOS:</strong> </td>
    <td>&nbsp;$<?php echo $honorarios; ?></td>
  </tr>
  <tr>
    <td>&nbsp;<strong>RELATIVOS:</strong></td>
    <td>&nbsp;$<?php echo $relativos ; ?></td>
  </tr>
  <tr>
    <td>&nbsp;<strong>SUBTOTAL: </strong> </td>
    <td>&nbsp;$ <?php echo $subtotal ;?></td>
  </tr>
  <tr>
    <td>&nbsp;<strong>IVA: </strong></td>
    <td>&nbsp;$ <?php echo $iva ;?></td>
  </tr>
  <tr>
    <td>&nbsp;<strong>TOTAL FACTURA:</strong></td>
    <td>&nbsp; $ <?php echo $total_factura ;?></td>
  </tr>  
</table>

<?php 
if ($estado<> "PROCESO"){


?>



<table  border="0" cellspacing="6" cellpadding="0">
  <tr>
    <td><a href="../reportes/nomina_<?php echo $id_nomina; ?>.xls"><img src="../imagenes/descargar.png" width="24" height= "24" title="Descargar"/>Descargar Reporte de Nómina</a>
      
      <br>
    <br><br></td>
    <?php if($estado=="REVISION"){?>
    <td>
    
    &nbsp;&nbsp;<input type="radio" name="radio" id="radio_aceptar" value="radio_aceptar">
      <strong> Estoy de acuerdo con los datos presentados y     
      Autorizo<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      la presente nómina 
    para su dispersión.</strong></td> 
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input type="button" name="aceptar_nomina" id="aceptar_nomina" value="Aceptar" onclick="javascript:autorizar_nomina(<?php echo $id_nomina; ?>)">
    <input type="button" name="cancelar" id="cancelar" value="Cancelar"  
    onclick="javascript:cargarPagina('consultar_nominas.php','mainContent')"></td>
  </tr>
 <?php }?>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>



<?php } ?>


