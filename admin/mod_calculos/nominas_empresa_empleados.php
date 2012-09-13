<?php 
   
    //obtiene la nomina de una empresa para su revisión
	echo "1";
	require_once '../libs/php/autoload/autoload.php';
	echo "2";
	include_once("nominas_clase.php");	
	echo "3";
	include_once("empresa_clase.php");
	echo "4";
	include_once("../admin/mod_calculos/model/guardar_nominaAntigua_a_FiscalNueva_class.php");
	echo "5";
	require_once '../libs/php/mvc/ConfigBD.php'; //de configuracion
	echo "6";
	include_once("../funcion_redondear.php");
	echo "7";
				
	
	$id_empresa= $_POST['id_empresa'];
	$id_nomina= $_POST['id_nomina'];
	
	
	$global_percepciones=0;
	$global_percepciones_fiscal=0;
	$global_deducciones=0;
	$global_deducciones_fiscal=0;
	$global_total=0;
	$global_total_fiscal=0;
	
	
	$objNomina = new cNomina();	 //Creamos el objeto nomina   nominas_clase.php
	$objEmpresa = new cEmpresa();
	$objNominaFiscal = new NominaFiscal();
	$objNominaFiscal->no_construct($id_nomina,$id_empresa);
	                 
	
	
/*-------------------------------NOMINAS------------------------------------------*/	
	$datosNomina= $objNomina->consultar_nomina($id_nomina);  
	//Consulto datos generales de la tabla nomina	
	$listaNominas= $objNomina->consultar_nomina_empleados($id_nomina, $id_empresa);  
	//Consulto todas los empleados y las guardo en $lista empleados	  percepciones,deducciones,fiscales	
	$num_rows = mysql_num_rows($listaNominas);	
	//cuento las filas
	$lista_Empleados_Imss= $objNomina->consultar_nomina_empleados_imss($id_nomina, $id_empresa);  
	//Cuantos empleados tienen imss	cuenta_imss
	$num_rows_Afiliados = mysql_num_rows($lista_Empleados_Imss);	
	//cuento las filas
	$datosEmpleadosFaltantes= $objNomina->consultar_empleados_sin_nomina($id_nomina, $id_empresa);
	//datos empleados faltantes
/*--------------------------------EMPRESA-----------------------------------------*/		
	$listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);  
	 //Consulto todas las empresas y las guardo en $lista empresas	
/*--------------------------------------------------------------------------------*/	



	 
	
	
/*-------------------------------------------------------------------------*/		
	while ($row_nomina = mysql_fetch_assoc($datosNomina)){
            	  
		$inicio_periodo= $row_nomina['inicio_periodo'];
		$fin_periodo= $row_nomina['fin_periodo'];	
		$relativos = $row_nomina['relativos'];
		$observaciones = $row_nomina['observaciones'];
		$honorarios = $row_nomina['honorarios'];
		$percepciones=$row_nomina['percepciones'];
		$iva = $row_nomina['iva'];
		$estatus = $row_nomina['estado'];
		$tipoNomina = $row_nomina['tipo_nomina'];
		$subtotal_nomi=$row_nomina['subtotal'];
		$total_factura_nomi=$row_nomina['total_factura'];
	  
     } 	
	 
/*-------------------------------------------------------------------------*/			 

	
	$anio_inicio = substr($inicio_periodo, 0, -6);
	$mes_inicio = substr($inicio_periodo, -5, -3);
	$dia_inicio = substr($inicio_periodo, -2, 2);
	$inicio=$dia_inicio."/".$mes_inicio."/".$anio_inicio;
	
	$anio_fin = substr($fin_periodo, 0, -6);
	$mes_fin = substr($fin_periodo, -5, -3);
	$dia_fin = substr($fin_periodo, -2, 2);
	$fin=$dia_fin."/".$mes_fin."/".$anio_fin;
	
		
	
/*-------------------------------------------------------------------------*/			
	while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){
            
      $razon_social= $row_empresas['razon_social'];
      $titular= $row_empresas['titular']; 
      $zona= $row_empresas['zona'];         
	  $porc_honorarios= $row_empresas['honorarios']; 
	  $porc_iva= $row_empresas['iva']; 
     } 	
/*-------------------------------------------------------------------------*/	


	
//A continuacion imprimo la tabla de nominas

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css"> 
#root_hora{ position:fixed!important; z-index:3; } 
#root_domingos{ position:fixed!important; z-index:3; } 
#root_turnos{ position:fixed!important; z-index:3; } 
#root_descansos{ position:fixed!important; z-index:3; } 
#root_festivos{ position:fixed!important; z-index:3; } 
#root_vacaciones{ position:fixed!important; z-index:3; } 
</style>
</head>


<body class="twoColElsLtHdr">
<!------------------------------------------------------------------------------------------------->
    <input type="hidden" id="periodo"            value="<?php echo $tipoNomina; ?>" />    
    <input type="hidden" id="id_empresaa"        value="<?php echo $id_empresa;      ?>" />
    <input type="hidden" id="id_nomina"          value="<?php echo $id_nomina;       ?>" />
    <input type="hidden" id="estado_actual"      value="<?php echo $estatus;         ?>" />
    <input type="hidden" id="iva_empresa"        value="<?php echo $porc_iva;        ?>" />
    <input type="hidden" id="honorarios_empresa" value="<?php echo $porc_honorarios; ?>" />
<!------------------------------------------------------------------------------------------------->

    
  <strong>N&Oacute;MINA: &nbsp;&nbsp;</strong><?php echo $id_nomina; ?> <br /> 
  <strong>CLIENTE: &nbsp;&nbsp;</strong><?php echo $razon_social; ?>
<br />
<table width="682" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="124"><strong>Nómina del periodo:</strong></td>
    <td width="130">
    <span id="fecha_inicio" >
	<input 
    type="text" 
    id="dia_inicio" 
    size="10" 
    value="<?php echo $inicio; ?>" 
    onFocus="javascript:calendarioNaranja('dia_inicio');" >
	</span><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa</td>
    <td width="22">&nbsp;Al&nbsp;</td> 
    <td width="269"><span id="fecha_fin" >
	<input 
    type="text" 
    id="dia_final" 
    size="10" 
    value="<?php echo $fin; ?>" 
    onFocus="javascript:calendarioNaranja('dia_final');" >
	</span><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa </td>
  </tr>
  <tr>
    <!------------------------------------------------------>
    <td>
    <a href="mod_calculos/view/PDFRecibosNomina.php?id_Emp=<?php echo $id_empresa; ?>&id_nomin=<?php echo $id_nomina; ?>&tipoNomina=<?php echo $tipoNomina; ?>" target="_blank" >Recibos de Nomina</a>
    </td>
    <!------------------------------------------------------>
    
    
	<td><a href="javascript:consultarNominaFiscal('<?php echo $id_empresa; ?>','<?php echo $id_nomina; ?>','<?php echo $tipoNomina; ?>');">Nomina Fiscal</a>
		&nbsp;&nbsp;<a href="facturacion_formulario.php?id_nomina= <?php echo $id_nomina; ?>&id_empresa=<?php echo $id_empresa; ?>" target="_blank">Facturar</a></td>
	<td>&nbsp;&nbsp;<a href="imprimir_dispersion_excel.php?id_nomina=<?php echo $id_nomina; ?>&id_empresa=<?php echo $id_empresa; ?>" target="_blank">Dispersar</a></td>
	<td>&nbsp;&nbsp; <a href="javascript:regresar();">Regresar</a></td>
</tr>
</table> 
  <br />  


<br/>

  
  
 <div id="agregar_empleado" >
 
<?php  
if($datosEmpleadosFaltantes){	
?>
   <label>Agregar Empleado:
 	  <select name="id_empleado_nuevo" id="id_empleado_nuevo" >
      <?php    
      	while ($row_emp = mysql_fetch_assoc($datosEmpleadosFaltantes)){?>      
		<option value="<?php echo $row_emp['id_empleado']; ?>"><?php echo $row_emp['nombre']." ".$row_emp['ap_paterno']." ".$row_emp['ap_materno']; ?></option>
      <?php } ?>
     </select>
   </label>
   
   <input type="button" id="agregar_emp" value="Agregar" onclick="agregar_empleado_nomina();" />
   <?php } ?>
 </div>
  

<table  border="1" cellspacing="2" cellpadding="0" >
 <tr>
 <td colspan="2" align="left" bgcolor="#BDBDBD"><b>Total Empleados:</b></td>
 <td  align="left" bgcolor="#D8D8D8" ><?php echo $num_rows; ?></td>
 <td  align="center">&nbsp;</td><td  align="center">&nbsp;</td>
 <td  align="center">&nbsp;</td>
  </tr>
  <tr>
 <td  colspan="2" align="left" bgcolor="#BDBDBD"><b>Total Empleados Asegurados:</b></td>
 <td  align="left" bgcolor="#D8D8D8"><?php echo $num_rows_Afiliados; ?></td>
 <td  align="center">&nbsp;</td><td  align="center">&nbsp;</td>
 <td  align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="23" align="center" bgcolor="#0099CC">PERCEPCIONES</td>
        <td  align="center">&nbsp;</td>
    <td colspan="7" align="center" bgcolor="#99FF66">DEDUCCIONES</td>
     <td  align="center">&nbsp;</td>
      <td  align="center" bgcolor="#FF3300">&nbsp;</td>
  </tr>
  <tr >
    <td  bgcolor="#00CCFF">&nbsp;Quitar</td>
    <td  bgcolor="#00CCFF">&nbsp;Empleado</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Sueldo Diario</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Dias Trabajados</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Sueldo</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Horas extras</td>
    <td bgcolor="#00CCFF" align="center">Total H.E.</td>
    <td bgcolor="#00CCFF" align="center">Domingos trabajados</td>
    <td bgcolor="#00CCFF" align="center">Prima Dominical</td>
    <td bgcolor="#00CCFF" align="center">Total D.T.</td>
   

    <td bgcolor="#00CCFF" align="center">Turnos trabajados</td>
    <td bgcolor="#00CCFF" align="center">Total Turnos Trab.</td>
    <td bgcolor="#00CCFF" align="center">Descansos Trabajados</td>
    <td bgcolor="#00CCFF" align="center">Total Descansos Trab.</td>
    <td bgcolor="#00CCFF" align="center">Dias Festivos</td>
    <td bgcolor="#00CCFF" align="center">Total Dias Festivos</td>
    <td bgcolor="#00CCFF" align="center">Vacaciones</td>
    <td bgcolor="#00CCFF" align="center">Prima Vacacional</td>
    <td bgcolor="#00CCFF" align="center">Total vac.</td>
     <td bgcolor="#00CCFF" align="center">Aguinaldo</td>
    <td bgcolor="#00CCFF" align="center">Complemento Sueldo</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Otras Percepciones</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    
    
    <td bgcolor="#99FF99" align="center">&nbsp;Prestamos</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Caja Ahorro</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Fonacot</td>
    <td bgcolor="#99FF99" align="center">Infonavit</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Otras deducciones</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Prestamo navitas</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#FF3300" align="center">&nbsp;TOTAL</td>
  </tr>

<?php while ($row_empleados = mysql_fetch_assoc($listaNominas))
{ 

$id_emp=$row_empleados['id_empleado'];



$listaNominasFiscales= $objNomina->consultar_nomina_empleados_fiscal($id_nomina,$id_emp); 

while ($row_empleados_fiscales = mysql_fetch_assoc($listaNominasFiscales))
{ 



 
	//Consulto todas los empleados de la nomina con datos fiscales





	$totales=$objNomina->totales_percepciones_deducciones($id_nomina,$id_emp);//Consulto todas los empleados
	
	
	
	while ($totales_nomina = mysql_fetch_assoc($totales))
{ 

$t_percepciones=redondear($totales_nomina['percepciones']);
$t_deducciones=redondear($totales_nomina['deducciones']);
$t_percepciones_fiscales=$totales_nomina['percepciones_fiscales'];
$tt_nomina=redondear($t_percepciones-$t_deducciones);
$tt_nomina_fiscal=$t_percepciones_fiscales-$t_deducciones;

    $global_percepciones+=$t_percepciones;
	$global_percepciones_fiscal+=$t_percepciones_fiscales;
	$global_deducciones+=$t_deducciones;
	$global_deducciones_fiscal+=$t_deducciones;
	$global_total+=$tt_nomina;
	$global_total_fiscal+=$tt_nomina_fiscal;

}
?>  



  <tr>
  
  
  
  
	<input type="hidden" name="id_empleado[]" value="<?php echo $row_empleados['id_empleado']; ?>" />
      <input  
    name="sueldo_integrado_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden" 
    id="sueldo_integrado_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['sueldo_diario_imss']; ?>" 
    size="5" 
    maxlength="10" 
    />
    
    
    <td nowrap="nowrap" align="center">
    <a href="javascript:quitar_empleado_nomina('<?php echo $row_empleados['id_empleado']; ?>','<?php echo $id_empresa; ?>','<?php echo $id_nomina; ?>') ">
    <img src="../imagenes/eliminar.png"  title="Quitar de esta nomina"/>
    </a>
    </td>
    
    <td nowrap="nowrap">
      <?php echo $row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno']; ?>
    </td>
    <td nowrap="nowrap" align="center">   
    <input  
    name="sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['sueldo_diario_emp']; ?>" 
    size="5" 
    maxlength="10" 
    />
    <input  
    name="sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden"
    id="sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo ($row_empleados['sueldo_diario_imss']/1.0452); ?>" 
    size="5" 
    maxlength="10" 
    /></td>
    <td nowrap="nowrap" align="center"><input 
    name="dias_trabajados_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="dias_trabajados_<?php echo $row_empleados['id_empleado']; ?>" 
    onchange="
              javascript:calcular_sueldo( 
                                         'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                         'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'dias_trabajados_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>',
                                         'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>' 
                                         );    
                         calcular_total_percepciones(
                                                      'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                                      ); 
                                          
                         calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );     
                         calcular_total_deducciones(
                                                    'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'fonacot_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'total_empleado_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                    ); 
                         calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ); " value="<?php echo $row_empleados['dias_trabajados']; ?>" 
    size="5" 
    maxlength="10"
    /></td>
    <td align="right" nowrap="nowrap"><input type="text" 
    id="total_sueldo_<?php echo $row_empleados['id_empleado']; ?>" 
    name="total_sueldo_<?php echo $row_empleados['id_empleado']; ?>"
    onchange="
              javascript:calcular_total_percepciones(
                                                      'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                                      ); 
                                          
                         calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );     
                         calcular_total_deducciones(
                                                    'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'fonacot_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'total_empleado_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                    ); 
                         calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );" 
                         disabled="disabled" 
                         value="<?php echo $row_empleados['total_sueldo']; ?>"  
                         size="5"
                         />
    <input type=""  
                          id="total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>" 
                          name="total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>"    
                          disabled="disabled" 
                          value="<?php echo $row_empleados_fiscales['p_total_sueldo']; ?>"  
                          size="5"
                         /></td>
    <td align="center" nowrap="nowrap"><input 
    type="checkbox" 
    name="chk_hora_extra_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_hora_extra_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_hora_extra(
                                           'chk_hora_extra_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                           'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                           '<?php echo $row_empleados['id_empleado']; ?>' 
                                           ); 
                                         "/>
      <input 
    name="cantidad_horas_extras_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_horas_extras_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['horas_extras']; ?>" size="5"    
    />
    <input 
    name="cantidad_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden" 
    id="cantidad_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados_fiscales['p_num_horas_extras']; ?>"    
    /></td>
    <td align="center" nowrap="nowrap"><label>
      <input 
      name="total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>" 
      type="text" 
      id="total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>" 
      onfocus="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );
                                          " 
    value="<?php echo $row_empleados['total_horas_extras']; ?>"
    size="5"  />
    </label>
      <input 
    name="total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden" 
    id="total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>"  
    value="<?php echo $row_empleados_fiscales['p_total_horas_extras']; ?>" size="5"  /></td>
    <td align="center" nowrap="nowrap"><input 
    type="checkbox" 
    name="chk_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    onclick="
             javascript:mostrar_domingos(
                                         'chk_domingos_<?php echo $row_empleados['id_empleado']; ?>',
                                         'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                         'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                         '<?php echo $row_empleados['id_empleado']; ?>'
                                         );"
                                         />
      <input 
    name="cantidad_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_domingos_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['domingos_trabajados']; ?>" size="5"    
    />
    <input 
    name="cantidad_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden"  
    id="cantidad_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados_fiscales['p_num_domingos_trabajados']; ?>"    
    /></td>
    <td><input 
          name="prima_dominical_<?php echo $row_empleados['id_empleado']; ?>" 
          type="text" 
          id="prima_dominical_<?php echo $row_empleados['id_empleado']; ?>" 
          value="<?php echo $row_empleados['prima_dominical']; ?>" 
          size="5" 
          maxlength="10"
          />
    <input 
          name="prima_dominical_imss_<?php echo $row_empleados['id_empleado']; ?>" 
          type="hidden"  
          id="prima_dominical_imss_<?php echo $row_empleados['id_empleado']; ?>" 
          value="<?php echo $row_empleados_fiscales['p_prima_dominical']; ?>" 
          size="5" 
          maxlength="10"
          /></td>
    <td align="center" nowrap="nowrap"><input 
    name="total_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="total_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['total_domingos_trabajados']; ?>"  
    size="5" 
    maxlength="10" 
    onfocus="javascript:      calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          ); " 
                                          />
    <input 
                                          name="total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
                                          type="hidden"  
                                          id="total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
                                          value="<?php echo $row_empleados_fiscales['p_subtotal_domingos']; ?>"  
                                          size="5" 
                                          maxlength="10" /></td>
    <td align="center" nowrap="nowrap"><input 
    type="checkbox" 
    name="chk_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_turnos_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_turnos(
                                       'chk_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                       'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                       'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                       'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                       'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                        '<?php echo $row_empleados['id_empleado']; ?>' ); 
                                         "/>
      <input 
    name="cantidad_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_turnos_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['turnos_trabajados']; ?>" size="5"    
    />
    <input 
    name="cantidad_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden"  
    id="cantidad_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados_fiscales['p_num_turnos_trabajados']; ?>"    
    /></td>
    <td align="center" nowrap="nowrap"><input 
    name="total_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" id="total_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['total_turnos_trabajados']; ?>" 
    size="5" 
    maxlength="10" 
    onfocus="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );    " />
    <input 
    name="total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden" 
    id="total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados_fiscales['p_total_turnos_trabajados']; ?>" 
    size="5" 
    maxlength="10" 
    /></td>
    <td align="center" nowrap="nowrap"><input 
    type="checkbox" 
    name="chk_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_descansos_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_descansos(
                                          'chk_descansos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                          'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          '<?php echo $row_empleados['id_empleado']; ?>' 
                                          );"/>
      <input 
    name="cantidad_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_descansos_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['descanso_trabajado']; ?>" size="5"    
    />
      <input 
    name="cantidad_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden"  
    id="cantidad_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados_fiscales['p_num_descansos_trabajados']; ?>"    
    /></td>
    <td align="center" nowrap="nowrap"><input 
    name="total_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="total_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['total_descanso_trabajado']; ?>" 
    size="5" 
    maxlength="10" 
    onfocus="
             javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          ); " />
    <input 
    name="total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden"  
    id="total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados_fiscales['p_total_descansos_trabajados']; ?>" 
    size="5" 
    maxlength="10" 
   /></td>
    <td align="center" nowrap="nowrap"><input 
    type="checkbox" 
    name="chk_festivos_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_festivos_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_festivos(
                                         'chk_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'total_festivos_<?php echo $row_empleados['id_empleado']; ?>',
                                         'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                         'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                         '<?php echo $row_empleados['id_empleado']; ?>' 
                                         ); 
                                         "/>
      <input 
    name="cantidad_festivos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_festivos_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['dias_festivos']; ?>" size="5"    
    />
      <input 
    name="cantidad_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden"  
    id="cantidad_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados_fiscales['p_num_dias_festivos']; ?>"    
    /></td>
    <td align="center" nowrap="nowrap"><input name="total_festivos_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="total_festivos_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['total_dias_festivos']; ?>" size="5" maxlength="10" onfocus="javascript:    calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );    " />
    <input name="total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" type="hidden"  id="total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados_fiscales['p_total_dias_festivos']; ?>" size="5" maxlength="10" /></td>
    <td align="center" nowrap="nowrap"><input 
    type="checkbox" 
    name="chk_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_vacaciones_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="javascript:mostrar_vacaciones(
                                           'chk_vacaciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                           'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                           'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                           '<?php echo $row_empleados['id_empleado']; ?>');" 
    />
      <input 
    name="cantidad_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['vacaciones']; ?>" size="5"    
    />
    <input 
    name="cantidad_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden"  
    id="cantidad_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados_fiscales['p_num_vacaciones']; ?>"    
    /></td>
    <td><input 
          name="prima_vacacional_<?php echo $row_empleados['id_empleado']; ?>" 
          type="text" 
          id="prima_vacacional_<?php echo $row_empleados['id_empleado']; ?>" 
          value="<?php echo $row_empleados['prima_vacacional']; ?>" 
          size="5" 
          maxlength="10" 
     />
    <input 
          name="prima_vacacional_imss_<?php echo $row_empleados['id_empleado']; ?>" 
          type="hidden" 
          id="prima_vacacional_imss_<?php echo $row_empleados['id_empleado']; ?>" 
          value="<?php echo $row_empleados_fiscales['p_prima_vacacional']; ?>" 
          size="5" 
          maxlength="10" 
     /></td>
    <td align="center" nowrap="nowrap"><input name="total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['total_vacaciones']; ?>" size="5" maxlength="10" onfocus="javascript:    calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );    " />
    <input name="total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" type="hidden"  id="total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados_fiscales['p_subtotal_vacaciones']; ?>" size="5" maxlength="10" /></td>
    <td><input 
          name="aguinaldo_<?php echo $row_empleados['id_empleado']; ?>" 
          type="text" 
          id="aguinaldo_<?php echo $row_empleados['id_empleado']; ?>" 
          value="<?php echo $row_empleados['aguinaldo']; ?>" 
          size="5" 
          maxlength="10"
          onfocus="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;
                                                    "
                                                    
          onchange="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;
                                                     "/></td>
    <td align="center" nowrap="nowrap"><input 
    name="complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['complemento_sueldo']; ?>" 
    size="5" 
    maxlength="10" 
    onfocus="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;
                                                    "
                                                    
    onchange="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;
                                                     "/></td>
    <td align="center" nowrap="nowrap"><label>
      <input name="otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['otras_percepciones']; ?>" size="5" maxlength="10" onfocus="javascript:    calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;    " 
      onchange="javascript:    calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );    " />
    </label></td>
    <td align="right" nowrap="nowrap"><input id="total_percepciones_<?php echo $row_empleados['id_empleado']; ?>" name="total_percepciones[]" value="<?php echo $t_percepciones; ?>" disabled="disabled" size="5" />
    <input type="hidden"  id="total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>" name="total_percepciones_imss[]" value="<?php echo $t_percepciones_fiscales; ?>" disabled="disabled" size="5" /></td>
    <td nowrap="nowrap">&nbsp;&nbsp;&nbsp;</td>
    <td align="center" nowrap="nowrap"><label>
      <input 
      name="prestamos_<?php echo $row_empleados['id_empleado']; ?>" 
      type="text" 
      id="prestamos_<?php echo $row_empleados['id_empleado']; ?>" 
      value="<?php echo $row_empleados['prestamos']; ?>" 
      size="5" 
      onchange="
                 javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );"  />
    </label></td>
    <td align="center" nowrap="nowrap"><label>
      <input 
    name="caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['caja_ahorro']; ?>" 
    size="5" 
    onchange="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );"
                                                    />
    </label></td>
    <td align="center" nowrap="nowrap"><label>
      <input 
    name="fonacot_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="fonacot_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['fonacot']; ?>" 
    size="5" 
    onchange="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );" 
                                                    />
    </label></td>
    <td align="center" nowrap="nowrap"><input 
    name="infonavit_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="infonavit_<?php echo $row_empleados['id_empleado']; ?>"  
    size="5" 
    onchange="
             javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );" 
                                                   value="<?php echo $row_empleados['infonavit']; ?>" 
                                                   /></td>
    <td align="center" nowrap="nowrap">
      <input 
    type="checkbox" 
    name="chk_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_otras_deducciones(
                                       'chk_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>',                     
                                        '<?php echo $row_empleados['id_empleado']; ?>' ); 
                                         "/>
   
    <label>
      <input 
    name="otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['otras_deducciones']; ?>" 
    size="5" 
    readonly="readonly"
    onchange="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );" 
 onfocus="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );"                                                        
                                                    />
                                                    &nbsp;&nbsp;&nbsp;Descripci&oacute;n
                                                     <input 
    name="descripcion_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="descripcion_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
   value="<?php echo $row_empleados_fiscales['d_descripcion_otras_deducciones']; ?>"    
    size="5"
    maxlength="30"   
    readonly="readonly"/>
    </label></td>
    <td align="center" nowrap="nowrap"><label>
      <input 
    name="prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['prestamo_ascon']; ?>" 
    size="5"
    onchange="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );"
                                                    />
    </label></td>
    <td align="right" nowrap="nowrap"><input name="total_deducciones[]" type="text" id="total_deducciones_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="<?php echo $t_deducciones; ?>" disabled="disabled" /></td>
    <td nowrap="nowrap">&nbsp;&nbsp;&nbsp;</td>
    <td align="right" nowrap="nowrap"><input name="total_empleado[]" type="text" id="total_empleado_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="<?php echo $tt_nomina; ?>" disabled="disabled" />
    <input name="total_empleado_imss[]" type="hidden"  id="total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="<?php echo $tt_nomina_fiscal; ?>" disabled="disabled" /></td>
    
    <!--SECCION DE LAS DEDUCCIONES -->
    
    
  </tr>
 
    
    
  <?php  }//while fiscales
  } //while normales
  ?>
  
  
  
  
  
  
  
  
  <tr>

    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Perc.:</td>
   
	
    <td><input id="total_percepciones_nomina" name="total_percepciones_nomina" value="<?php echo $global_percepciones;?>" disabled="disabled" size="5" />
      <input type="hidden"  id="total_percepciones_nomina_imss" name="total_percepciones_nomina_imss" value="<?php echo $global_percepciones_fiscal;?>" disabled="disabled" size="5" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Ded:</td>	
    <td><input name="total_deducciones_nomina" type="text" id="total_deducciones_nomina" size="5" value="<?php echo  $global_deducciones; ?>" disabled="disabled"/>
      <input name="total_deducciones_nomina_imss" type="hidden"  id="total_deducciones_nomina_imss" size="5" value="<?php echo  $global_deducciones_fiscal; ?>" disabled="disabled"/></td>
    <td>&nbsp;&nbsp;Total:&nbsp;</td>   
    <td align="right"><input name="total_empleados_nomina" type="text" id="total_empleados_nomina" size="5" value="<?php echo  $global_total; ?>" disabled="disabled" />
      <input name="total_empleados_nomina_imss" type="hidden"  id="total_empleados_nomina_imss" size="5" value="<?php echo $global_total_fiscal; ?>" disabled="disabled" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="9" valign="top">Observaciones: <br />
    <textarea name="observaciones" id="observaciones" cols="60" rows="12"><?php echo $observaciones; ?></textarea></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="7"><br />
    
    

    
    
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="54%">PERCEPCIONES:</td>
          <td align="right" width="46%"><input type="text" id="percepciones" value="<?php echo $percepciones; ?>" size="5" /></td>
        </tr>
        <tr>
          <td>HONORARIOS:</td>
          <td align="right"><input type="text" id="honorarios" value="<?php echo $honorarios; ?>" size="5" /></td>
        </tr>
        <tr>
          <td>RELATIVOS:</td>
          <td align="right"><input type="text" name="relativos" id="relativos" value="<?php echo $relativos; ?>" size="5" 
                                                            onchange="javascript:calcular_total_percepciones_nomina();" /></td>
        </tr>
        <tr>
          <td>SUBTOTAL:</td>
          
          <td align="right"><input type="text" id="subtotal" value="<?php echo $subtotal_nomi; ?>" size="5" /></td>
        </tr>
        <tr>
          <td>IVA:</td>
          <td align="right"><input type="text" id="iva" value="<?php echo $iva; ?>" size="5" /></td>
        </tr>
        <tr>
          <td>TOTAL FACTURA:</td>
          <td align="right"><input type="text" id="total_factura" value="<?php echo $total_factura_nomi; ?>" size="5" /></td>
        </tr>
      </table>
    <p>
   
   <?php // AQUI VALIDO EL $estatus    PROCESO  REVISION  PAGADA  AUTORIZADA
   	if ($estatus=="PROCESO"){
   ?>
     <label><input name="estado" type="radio" id="revision" value="REVISION" checked="checked" />Revisión  </label>
        
     <label><input type="radio" name="estado" id="aprobada" value="AUTORIZADA" /> Autorizada   </label>
        
	<label><input type="radio" name="estado" id="pagada" value="PAGADA" />   Pagada     </label>
    <label><input type="radio" name="estado" id="facturada" value="FACTURADA" />   Facturada     </label>
        
   <?php }elseif($estatus=="REVISION"){  ?>      
   
     <label><input name="estado" type="radio" id="revision" value="REVISION" checked="checked" />Modificaci&oacute;n  </label>
        
     <label><input type="radio" name="estado" id="aprobada" value="AUTORIZADA" /> Autorizada   </label>
        
	<label><input type="radio" name="estado" id="pagada" value="PAGADA" />   Pagada     </label>

   <label><input type="radio" name="estado" id="facturada" value="FACTURADA" />   Facturada     </label>
   
   <?php }elseif($estatus=="AUTORIZADA"){  ?>      
   
     <label><input name="estado" type="radio" id="revision" value="REVISION"  />Modificaci&oacute;n </label>
        
     <label><input type="radio" name="estado" id="aprobada" value="AUTORIZADA" checked="checked"  /> Autorizada   </label>
        
	<label><input type="radio" name="estado" id="pagada" value="PAGADA" />   Pagada     </label>
   
   <label><input type="radio" name="estado" id="facturada" value="FACTURADA" />   Facturada     </label>
   
   <?php }elseif($estatus=="PAGADA"){  ?>  
   
    <label><input type="radio" name="estado" id="pagada" value="PAGADA" checked="checked" />   Pagada     </label>    
    
   <label><input type="radio" name="estado" id="facturada" value="FACTURADA" />   Facturada     </label>     

   <?php }elseif($estatus=="FACTURADA"){  ?>  
   
    
   <label><input type="radio" name="estado" id="facturada" value="FACTURADA" checked="checked"  />   Facturada     </label>     


   <?php } ?>     
        
        
        <br />        
     <?php if($estatus=="FACTURADA"){  ?>      
       

      <input type="button" name="cancelar" id="cancelar" value="ACEPTAR" onclick="javascript:cargarPagina('nominas.php','mainContent')" />
   
   <?php }else { ?>

        <input type="button" name="guardar" id="guardar" value="Procesar Nómina"   onclick="javascript:modificar_nomina('<?php echo $id_empresa; ?>')"/>

      <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="javascript:cargarPagina('nominas.php','mainContent')" />

<?php }?>

   
    </p>
    
    <div id="alerta_nomina"></div>
    <!--<a href="imprimir_prenomina.php" target="_blank">Imprimir Reporte </a> -->

    <br/>
        
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>














<!-- -->

<!-----------------------------Ventana flotante de horas extras ----------------------------------------->
<div 
class="root"  
id="root_hora" 
style="left:37%;top:42%;display:none;"   
onclick="
        javascript:Drag.init(document.getElementById('handle_hora'), 
                   document.getElementById('root_hora'))" > 

<div  
class="handle" 
id="handle_hora" 
style="display:none;"   
onclick="
         javascript:Drag.init(document.getElementById('handle_hora'), 
                    document.getElementById('root_hora'))">Horas extras</div> 
   &nbsp; &nbsp;  No. horas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  sueldo<br/>
   
	&nbsp; (<input name="no_horas" id="no_horas" type="text" size="5" maxlength="10" />
    &nbsp;*&nbsp;<input name="sueldo_hora" id="sueldo_hora" type="text" size="5" maxlength="10" />)
    &nbsp;*&nbsp;<input name="sueldo_hora_imss" id="sueldo_hora_imss" type="hidden"  size="5" maxlength="10" />
    <input name="factor" id="factor" type="text" size="5" maxlength="10" value="2"/><br/>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
               <input type="hidden"  id="id_total_he" />
  <input type="hidden"  id="id_total_he_imss" />
               <input type="hidden"  id="id_checkbox" />
               
<input type="button" id="calcular_horas_extras" value="Calcular" onclick="javascript:calcular_horas_extras();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_horas_extras" value="Cancelar" onclick="javascript:cerrarDiv('root_hora','handle_hora'); cancelar_hora_extra();" />
</div> 
   


<!----------------------------------------Ventana flotante de domingos trabajados ------------------------------>



<div class="root"  id="root_domingos" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_domingos'), document.getElementById('root_domingos'))" > 

<div  class="handle" id="handle_domingos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_domingos'), document.getElementById('root_domingos'))">Domingos Trabajados</div> 
   &nbsp; &nbsp; Domingos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sueldo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Prima dom.(25%)<br/>
   
	&nbsp;&nbsp;(<input name="no_domingos" id="no_domingos" type="text" size="5" maxlength="10" /> 
    &nbsp;*&nbsp;<input name="sueldo_domingos" id="sueldo_domingos" type="text" size="5" maxlength="10" />)
    <input name="sueldo_domingos_imss" id="sueldo_domingos_imss" type="hidden"  size="5" maxlength="10" />
    &nbsp;  +  &nbsp;   Prima Dominical (25%) <br/>
    
			     <input type="hidden" id="id_total_domingos" />
                 <input type="hidden" id="id_total_domingos_imss" />
  <input type="hidden" id="id_checkbox" />
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
              <input type="button" id="calcular_domingos" value="Calcular" onclick="javascript:calcular_domingos();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_domingos_trabajados" value="Cancelar" onclick="javascript:cerrarDiv('root_domingos','handle_domingos'); cancelar_domingos();" />
</div> 



<!--------------------------------------Ventana flotante de turnos trabajados ----------------------------------------->


<div class="root"  id="root_turnos" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_turnos'), document.getElementById('root_turnos'))" > 

<div  class="handle" id="handle_turnos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_turnos'), document.getElementById('root_turnos'))">Turnos Trabajados</div> 
   &nbsp; &nbsp;  No. turnos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  sueldo<br/>
   
	&nbsp; <input name="no_turnos" id="no_turnos" type="text" size="5" maxlength="10" value="1" />
    &nbsp;*&nbsp;<input name="sueldo_turnos" id="sueldo_turnos" type="text" size="5" maxlength="10" />
   <input name="sueldo_turnos_imss" id="sueldo_turnos_imss" type="hidden"  size="5" maxlength="10" />
    <br/>
     		<input type="hidden"  id="id_total_turnos" />
            <input type="hidden"  id="id_total_turnos_imss" />
               <input type="hidden" id="id_checkbox" />
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
<input type="button" id="calcular_turnos" value="Calcular" onclick="javascript:calcular_turnos();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_turnos" value="Cancelar" onclick="javascript:cerrarDiv('root_turnos','handle_turnos'); cancelar_turnos();" />
</div>




<!------------------------------------------Ventana flotante de descansos trabajados  -------------------------------->


<div class="root"  id="root_descansos" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_descansos'), document.getElementById('root_descansos'))" > 

<div  class="handle" id="handle_descansos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_descansos'), document.getElementById('root_descansos'))">Descansos Trabajados</div> 
   &nbsp; &nbsp; No.Descansos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sueldo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  factor<br/>
   
	&nbsp; 
		(<input name="no_descansos" id="no_descansos" type="text" size="5" maxlength="10" />
         &nbsp;*&nbsp;
        <input name="sueldo_descansos" id="sueldo_descansos" type="text" size="5" maxlength="10" />)
        <input name="sueldo_descansos_imss" id="sueldo_descansos_imss" type="hidden"  size="5" maxlength="10" />
    &nbsp;*&nbsp;<input name="factor_descansos" id="factor_descansos" type="text" size="5" maxlength="10" value="2"/><br/>
    			<input type="hidden"  id="id_total_descansos" />
                <input type="hidden"  id="id_total_descansos_imss" />
                <input type="hidden" id="id_checkbox" />
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
  <input type="button" id="calcular_descansos" value="Calcular" onclick="javascript:calcular_descansos();"/>
                          &nbsp;&nbsp; 
  <input type="button" id="cancelar_descansos_trabajados" value="Cancelar" onclick="javascript:cerrarDiv('root_descansos','handle_descansos'); cancelar_descansos();" />
</div>


<!-----------------------------------------------Ventana flotante de Dias festivos---------------------------------------->
<div class="root"  id="root_festivos" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_festivos'), document.getElementById('root_festivos'))" > 

<div  class="handle" id="handle_festivos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_festivos'), document.getElementById('root_festivos'))">Dias Festivos</div> 
   &nbsp; &nbsp;  No. Dias &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sueldo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; factor<br/>
   
	&nbsp; 
    
    (<input name="no_festivos" id="no_festivos" type="text" size="5" maxlength="10" />
      &nbsp;*&nbsp;
		<input name="sueldo_festivos" id="sueldo_festivos" type="text" size="5" maxlength="10" /> )
        <input name="sueldo_festivos_imss" id="sueldo_festivos_imss" type="hidden"  size="5" maxlength="10" />
    &nbsp;*&nbsp;<input name="factor_festivos" id="factor_festivos" type="text" size="5" maxlength="10" value="2"/><br/>
    
	    <input type="hidden" id="id_total_festivos" />
         <input type="hidden" id="id_total_festivos_imss" />
               	<input type="hidden" id="id_checkbox" />
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
              <input type="button" id="calcular_festivos" value="Calcular" onclick="javascript:calcular_festivos();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_festivos" value="Cancelar" onclick="javascript:cerrarDiv('root_festivos','handle_festivos'); cancelar_festivos();" />
</div>



<!------------------------------------------------Ventana flotante de Vacaciones ------------------------------------->


<div class="root"  id="root_vacaciones" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_vacaciones'), document.getElementById('root_vacaciones'))" > 

<div  class="handle" id="handle_vacaciones" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_vacaciones'), document.getElementById('root_vacaciones'))">Vacaciones</div> 
   &nbsp; &nbsp;  No. Dias &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  sueldo<br/>
   
	&nbsp; (<input name="no_dias_vac" id="no_dias_vac" type="text" size="5" maxlength="10" />
    &nbsp;*&nbsp;<input name="sueldo_vacaciones" id="sueldo_vacaciones" type="text" size="5" maxlength="10" />)
    <input name="sueldo_vacaciones_imss" id="sueldo_vacaciones_imss" type="hidden"  size="5" maxlength="10" />
    &nbsp;+&nbsp;Prima Vacacional (25%)<br/>
    <input type="hidden" id="id_total_vacaciones" />
    <input type="hidden" id="id_total_vacaciones_imss" />
                   	<input type="hidden" id="id_checkbox" />
    
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
              <input type="button" id="calcular_vacaciones" value="Calcular" onclick="javascript:calcular_vacaciones();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_vacaciones" value="Cancelar" onclick="javascript:cerrarDiv('root_vacaciones','handle_vacaciones'); cancelar_vacaciones();" />
</div>



<div class="root"  id="root_ot_deducciones" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_ot_deducciones'), document.getElementById('root_festivos'))" > 

<div  class="handle" id="handle_festivos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_festivos'), document.getElementById('root_festivos'))">Dias Festivos</div> 
   &nbsp; &nbsp;  Descripción: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<br/>
   
	&nbsp; 
    
    <input name="descripcion_ot_deducciones" id="descripcion_ot_deducciones" type="text" size="20" maxlength="30" style="height:30px" value=""/>
      &nbsp;*&nbsp;
		<input name="cantidad_ot_deducciones" id="cantidad_ot_deducciones" type="text" size="5"  maxlength="10" /> 
       <br/>
    
	   
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
              <input type="button" id="calcular_festivos" value="Aceptar" onclick="javascript:aceptar_ot_deducciones();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_festivos" value="Cancelar" 
              onclick="javascript:cancelar_otras_deducciones();" />
</div>
</body>
</html>