<div class="exa">

<table border="0" cellspacing="2" cellpadding="1" id="tableall">
 <tr style="display:">
   <td class="percepciones_1" bgcolor="#00CCFF">&nbsp;</td>
   <td class="percepciones_1" bgcolor="#00CCFF">Quitar</td>
   <td class="percepciones_2" bgcolor="#00CCFF">Recibo De Nomina</td>
   <td class="percepciones_3" bgcolor="#00CCFF">Empleado</td>
   <td class="percepciones_4" bgcolor="#00CCFF" align="center" >Sueldo Diario</td>
   <td class="percepciones_5" bgcolor="#00CCFF" align="center">Dias Trabajados</td>
   <td class="percepciones_6" bgcolor="#00CCFF" align="center">Sueldo</td>
   <td class="percepciones_7" bgcolor="#00CCFF" align="center">Horas extras</td>
   <td class="percepciones_8" bgcolor="#00CCFF" align="center">Total H.E.</td>
   <td class="percepciones_9" bgcolor="#00CCFF" align="center">Domingos trabajados</td>
   <td class="percepciones_10" bgcolor="#00CCFF" align="center">Prima Dominical</td>
   <td class="percepciones_11" bgcolor="#00CCFF" align="center">Total D.T.</td>
   <td class="percepciones_12" bgcolor="#00CCFF" align="center">Turnos trabajados</td>
   <td class="percepciones_13" bgcolor="#00CCFF" align="center">Total Turnos Trab.</td>
   <td class="percepciones_14" bgcolor="#00CCFF" align="center">Descansos Trabajados</td>
   <td class="percepciones_15" bgcolor="#00CCFF" align="center">Total Descansos Trab.</td>
   <td class="percepciones_16" bgcolor="#00CCFF" align="center">Dias Festivos</td>
   <td class="percepciones_17" bgcolor="#00CCFF" align="center">Total Dias Festivos</td>
   <td class="percepciones_18" bgcolor="#00CCFF" align="center">Vacaciones</td>
   <td class="percepciones_19" bgcolor="#00CCFF" align="center">Prima Vacacional</td>
   <td class="percepciones_20" bgcolor="#00CCFF" align="center">Total vac.</td>
   <td class="percepciones_21" bgcolor="#00CCFF" align="center">Aguinaldo</td>
   <td class="percepciones_22" bgcolor="#00CCFF" align="center">Complemento Sueldo</td>
   <td class="percepciones_23" bgcolor="#00CCFF" align="center">Otras Percepciones</td>
   <td class="percepciones_24" bgcolor="#00CCFF" align="center">Total</td>
   <td class="percepciones_25">&nbsp;&nbsp;&nbsp;</td>
   <td class="deducciones_1" bgcolor="#99FF99" align="center">Prestamos</td>
   <td class="deducciones_2" bgcolor="#99FF99" align="center">Caja Ahorro</td>
   <td class="deducciones_3" bgcolor="#99FF99" align="center">Fonacot</td>
   <td class="deducciones_4" bgcolor="#99FF99" align="center">Infonavit</td>
   <td class="deducciones_5" bgcolor="#99FF99" align="center">Otras deducciones</td>
   <td class="deducciones_6" bgcolor="#99FF99" align="center">Prestamo navitas</td>
   <td class="deducciones_7" bgcolor="#99FF99" align="center">Total</td>
   <td class="deducciones_8">&nbsp;&nbsp;&nbsp;</td>
   <td bgcolor="#FF3300" align="center">TOTAL</td>
 </tr>
 <tr>
 <td bgcolor="#00CCFF" id="thSelectColumn">
 <label>M&aacute;s columnas</label>
  <ul id="ulSelectColumn" class="clickMenu">
            
            <li>
           <img src="../imagenes/ver.png" alt="select columns" title="select columns" align="left"/>
                <ul id="targetall">
                <li></li>
                </ul>
            </li>
            
            </ul>
 </td>
   <td  colspan="2" align="left" bgcolor="#BDBDBD"><b>Total Empleados:</b></td>
   <td  align="left" bgcolor="#D8D8D8" ><?php echo $num_rows; ?></td>
   
   <td class="vacios_percepciones_deducciones_1" colspan="31"></td>
   
 </tr>
  
  <tr>
  <td></td>
 <td  colspan="2" align="left" bgcolor="#BDBDBD"><b>Total Empleados Asegurados:</b></td>
 <td align="left" bgcolor="#D8D8D8" ><?php echo $num_rows_Afiliados; ?>
  
 </td>
 
 <td class="vacios_percepciones_deducciones_2" colspan="31" >
  
 </td>
 
  </tr>
  
  <tr>
 <td></td>
    <td class="percepciones_titulo" colspan="24" align="center" bgcolor="#0099CC"  >PERCEPCIONES&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;</td>
    
    <td >
   </td>
    
    <td class="deducciones_titulo" align="center" colspan="7" bgcolor="#99FF66">DEDUCCIONES</td>
    
    <td></td>
    
      <td class="total_titulo"  align="center" bgcolor="#FF3300">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td class="percepciones_titulo" align="center" bgcolor="#0099CC"  >&nbsp;</td>
    <td class="percepciones_titulo" align="center" bgcolor="#0099CC"  >&nbsp;</td>
    <td class="percepciones_titulo" align="center" bgcolor="#0099CC"  >&nbsp;</td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_sueldo_diario" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Sueldo Diario');" onmouseout="hidetooltip()" /></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_dias_trabajados" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Dias Trabajados');" onmouseout="hidetooltip()" /></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_sueldo" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Sueldo');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_horas_extras" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Horas Extras');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_total_he" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Total Horas Extras');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_domingos_t" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Domingos Trabajados');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_prima_dom" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Prima Dominical');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_total_dt2" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Total Domingos Trabajados');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_turnos_t" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Turnos Trabajados');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_total_tb" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Total Turnos Trabajados');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_descansos_t" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Descansos Trabajados');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_total_dt" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Total Descansos Trabajados');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_dias_f" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Dias Festivos');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_total_dias_f" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Total Dias Festivos');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_vacaciones" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Vacaciones');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_prima_d" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Prima Vacacional');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_total_v" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Total Vacaciones');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_aguinaldo" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Aguinaldo');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_complemento_s" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Complemento Sueldo');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_otras_p" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Otras Percepciones');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#0099CC" class=""><img id="ocultar_total_per" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Total Percepciones');" onmouseout="hidetooltip()"/></td>
    <td  align="center" class="">&nbsp;</td>
    <td align="center" bgcolor="#99FF66" class=""><img id="ocultar_prestamos" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Prestamos');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#99FF66" class=""><img id="ocultar_caja_ahorro" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Caja de Ahorro');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#99FF66" class=""><img id="ocultar_fonacot" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Fonacot');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#99FF66" class=""><img id="ocultar_infonavit" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Infonavit');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#99FF66" class=""><img id="ocultar_otras_d" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Otras Deducciones');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#99FF66" class=""><img id="ocultar_prestamo_n" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Prestamo Navitas');" onmouseout="hidetooltip()"/></td>
    <td align="center" bgcolor="#99FF66" class=""><img id="ocultar_total_de" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar Total Deducciones');" onmouseout="hidetooltip()"/></td>
    <td  align="center" class="">&nbsp;</td>
    <td  align="center" bgcolor="#FF3300" class=""><img id="ocultar_total" src="../clients/images/menos.png" onmouseover="tooltip('Ocultar TOTAL');" onmouseout="hidetooltip()"/></td>
    </tr>
  
  <tr>
    <td class="percepciones_1" >&nbsp;</td>
    <td class="percepciones_1" bgcolor="#00CCFF">Quitar</td>
	<td class="percepciones_2" bgcolor="#00CCFF">Recibo De Nomina</td>
    <td class="percepciones_3" bgcolor="#00CCFF">Empleado</td>
    <td class="percepciones_4" bgcolor="#00CCFF" align="center" >Sueldo Diario</td>
    <td class="percepciones_5" bgcolor="#00CCFF" align="center">Dias Trabajados</td>
    <td class="percepciones_6" bgcolor="#00CCFF" align="center">Sueldo</td>
    <td class="percepciones_7" bgcolor="#00CCFF" align="center">Horas extras</td>
    <td class="percepciones_8" bgcolor="#00CCFF" align="center">Total H.E.</td>
    <td class="percepciones_9" bgcolor="#00CCFF" align="center">Domingos trabajados</td>
    <td class="percepciones_10" bgcolor="#00CCFF" align="center">Prima Dominical</td>
    <td class="percepciones_11" bgcolor="#00CCFF" align="center">Total D.T.</td>
   

    <td class="percepciones_12" bgcolor="#00CCFF" align="center">Turnos trabajados</td>
    <td class="percepciones_13" bgcolor="#00CCFF" align="center">Total Turnos Trab.</td>
    <td class="percepciones_14" bgcolor="#00CCFF" align="center">Descansos Trabajados</td>
    <td class="percepciones_15" bgcolor="#00CCFF" align="center">Total Descansos Trab.</td>
    <td class="percepciones_16" bgcolor="#00CCFF" align="center">Dias Festivos</td>
    <td class="percepciones_17" bgcolor="#00CCFF" align="center">Total Dias Festivos</td>
    <td class="percepciones_18" bgcolor="#00CCFF" align="center">Vacaciones</td>
    <td class="percepciones_19" bgcolor="#00CCFF" align="center">Prima Vacacional</td>
    <td class="percepciones_20" bgcolor="#00CCFF" align="center">Total vac.</td>
    <td class="percepciones_21" bgcolor="#00CCFF" align="center">Aguinaldo</td>
    <td class="percepciones_22" bgcolor="#00CCFF" align="center">Complemento Sueldo</td>
    <td class="percepciones_23" bgcolor="#00CCFF" align="center">Otras Percepciones</td>
    <td class="percepciones_24" bgcolor="#00CCFF" align="center">Total</td>
    <td class="percepciones_25">&nbsp;&nbsp;&nbsp;</td>
    
    
    <td class="deducciones_1" bgcolor="#99FF99" align="center">Prestamos</td>
    <td class="deducciones_2" bgcolor="#99FF99" align="center">Caja Ahorro</td>
    <td class="deducciones_3" bgcolor="#99FF99" align="center">Fonacot</td>
    <td class="deducciones_4" bgcolor="#99FF99" align="center">Infonavit</td>
    <td class="deducciones_5" bgcolor="#99FF99" align="center">Otras deducciones</td>
    <td class="deducciones_6" bgcolor="#99FF99" align="center">Prestamo navitas</td>
    <td class="deducciones_7" bgcolor="#99FF99" align="center">Total</td>
    <td class="deducciones_8">&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#FF3300" align="center">TOTAL</td>
  </tr>

<?php 
/******************************************************************************************************************/
//consulto toda la nomina normal, incluyendo el sueldo_imss sin factor
	//Consulto datos generales de la tabla nomina	
	/*percepciones+deducciones+empleado{
		                        empleados.nombre, 
								empleados.ap_paterno, 
								empleados.ap_materno, 
								empleados.no_tarjeta, 
								empleados.sueldo_diario_imss
								}
								*/
								
	$listaNominas= $objNomina->consultar_nomina_empleados($id_nomina, $id_empresa);
	
	//Consulto todas los empleados y las guardo en $lista empleados	  percepciones,deducciones,fiscales	
	$num_rows = mysql_num_rows($listaNominas);	///numero de empleado en nomina
	//cuento las filas
	
	

while ($row_empleados = mysql_fetch_assoc($listaNominas))
{ 
/**********************************************************************************************************************/
$id_emp=$row_empleados['id_empleado'];

   $tooltip_sueldo_diario="Sueldo Diario:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_dias_trabajados="Dias Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_sueldo="Sueldo:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_horas_extras="Horas Extra:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_he="Total Horas Extra:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_domingos_t="Domingos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_prima_dom="Prima Dominical:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_dt="Total Domingos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
  
   $tooltip_turnos_t="Turnos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_tb="Total Turnos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_descansos_t="Descansos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_dt="Total Descansos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_dias_f="Dias Festivos:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_dias_f="Total Dias Festivos:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_vacaciones="Vacaciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_prima_d="Prima Vacacional:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_v="Total Vacaciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_aguinaldo="Aguinaldo:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_complemento_s="Complemento Sueldo:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_otras_p="Otras Percepciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_per="Total Percepciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
  
   $tooltip_prestamos="Prestamos:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_caja_ahorro="Caja Ahorro:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_fonacot="Fonacot:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_infonavit="Infonavit:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_otras_d="Otras Deducciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_desc_otras_d="Descripci&oacute;n Otras Deducciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_prestamo_n="Prestamo Navitas:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_de="Total Deducciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total="TOTAL:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];



/*****************************************************************************************************************/	
//consulto toda la nomina fiscal por empleado
$listaNominasFiscales= $objNomina->consultar_nomina_empleados_fiscal($id_nomina,$id_emp); 

while ($row_empleados_fiscales = mysql_fetch_assoc($listaNominasFiscales))
{ 

/*****************************************************************************************************************/	






 
	//Consulto todas los empleados de la nomina con datos fiscales



/*****************************************************************************************************************/	


	$totales=$objNomina->totales_percepciones_deducciones($id_nomina,$id_emp);//Consulto todas los empleados
	
/*
se consultan los totales por empleado de
total percepciones
total percepciones_fiscales
totoal deducciones


*/

	
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


/*****************************************************************************************************************/
?>  



  <tr>
    <td nowrap="nowrap"  class="percepciones_1"  align="center">&nbsp;</td>
  
  
  
  
	<input type="" name="id_empleado[]" value="<?php echo $row_empleados['id_empleado']; ?>" />
      <input  
    name="sueldo_integrado_<?php echo $row_empleados['id_empleado']; ?>" 
    type="" 
    id="sueldo_integrado_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['sueldo_diario_imss']; ?>" 
    size="5" 
    maxlength="10" 
    />
    
    
    <td nowrap="nowrap"  class="percepciones_1"  align="center">
    <a href="javascript:quitar_empleado_nomina('<?php echo $row_empleados['id_empleado']; ?>','<?php echo $id_empresa; ?>','<?php echo $id_nomina; ?>') ">
    <img src="../imagenes/eliminar.png"  title="Quitar de esta nomina"/>
    </a>
    </td>
	<td nowrap="nowrap"  class="percepciones_2">
    <a href="mod_calculos/view/PDFRecibosNominaEmpleado.php?id_Emp=<?php echo $id_empresa; ?>&id_nomin=<?php echo $id_nomina; ?>&tipoNomina=<?php echo $tipoNomina; ?>&idEmpleado=<?php echo $row_empleados['id_empleado']; ?>" target="_blank" ><img src="../imagenes/pdf.png" WIDTH="25px" HEIGHT="25px" title="Recibo de Nomina" alt="Recibo de Nomina" align="center" /></a>
    </td>    
    <td nowrap="nowrap"  class="percepciones_3" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_4"  align="center">&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_5"  align="center">&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_6" align="right" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_7" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_8" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_9" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_10">&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_11" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_12" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_13" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_14" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_15" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_16" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_17" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_18" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_19">&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_20" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_21">&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_22" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_23" align="center" >&nbsp;</td>
    <td nowrap="nowrap"  class="percepciones_24" align="right" ><input id="total_percepciones_<?php echo $row_empleados['id_empleado']; ?>" name="total_percepciones[]" value="<?php echo $t_percepciones; ?>" readonly size="5" onmouseover="tooltip(&#39;<?php echo $tooltip_total_per ;?>&#39;);" 
    onmouseout="hidetooltip()" />
    <input type=""  id="total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>" name="total_percepciones_imss[]" value="<?php echo $t_percepciones_fiscales; ?>" disabled="disabled" size="5" /></td>
    <td class="percepciones_25" nowrap="nowrap"   >&nbsp;&nbsp;&nbsp;</td>
    <td class="deducciones_1" nowrap="nowrap"  align="center" >&nbsp;</td>
    <td class="deducciones_2" nowrap="nowrap"  align="center" >&nbsp;</td>
    <td class="deducciones_3" nowrap="nowrap"  align="center" >&nbsp;</td>
    <td class="deducciones_4" nowrap="nowrap"  align="center" >&nbsp;</td>
    <td class="deducciones_5" nowrap="nowrap"  align="center" >&nbsp;</td>
    <td class="deducciones_6" nowrap="nowrap"  align="center" >&nbsp;</td>
    <td class="deducciones_7" nowrap="nowrap"  align="right" ><input name="total_deducciones[]" type="text" id="total_deducciones_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="<?php echo $t_deducciones; ?>"  readonly="readonly" onmouseover="tooltip(&#39;<?php echo $tooltip_total_de ;?>&#39;);" 
    onmouseout="hidetooltip()" /></td>
    <td class="deducciones_8" nowrap="nowrap"  >&nbsp;&nbsp;&nbsp;</td>
    <td nowrap="nowrap" align="right" ><input name="total_empleado[]" type="text" id="total_empleado_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="<?php echo $tt_nomina; ?>" d readonly onmouseover="tooltip(&#39;<?php echo $tooltip_total ;?>&#39;);" 
    onmouseout="hidetooltip()" />
    <input name="total_empleado_imss[]" type=""  id="total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="<?php echo $tt_nomina_fiscal; ?>" disabled="disabled" /></td>
    
    <!--SECCION DE LAS DEDUCCIONES -->
    
    
  </tr>
 
    
    
  <?php  }//while fiscales
  } //while normales
  ?>
  
  
  
  
  
  
  
  
  <tr>
    <td class="percepciones_1">&nbsp;</td>

    <td class="percepciones_1">&nbsp;</td>
    <td class="percepciones_2">&nbsp;</td>
    <td class="percepciones_3">&nbsp;</td>
    <td class="percepciones_4">&nbsp;</td>
    <td class="percepciones_5">&nbsp;</td>
    <td class="percepciones_6">&nbsp;</td>
    <td class="percepciones_7">&nbsp;</td>
    <td class="percepciones_8">&nbsp;</td>
    <td class="percepciones_9">&nbsp;</td>
    <td class="percepciones_10">&nbsp;</td>
    <td class="percepciones_11">&nbsp;</td>
    <td class="percepciones_12">&nbsp;</td>
    <td class="percepciones_13">&nbsp;</td>
    <td class="percepciones_14">&nbsp;</td>
    <td class="percepciones_15">&nbsp;</td>
    <td class="percepciones_16">&nbsp;</td>
    <td class="percepciones_17">&nbsp;</td>
    <td class="percepciones_18">&nbsp;</td>
    <td class="percepciones_19">&nbsp;</td>
    <td class="percepciones_20">&nbsp;</td>
    <td class="percepciones_21">&nbsp;</td>
    <td class="percepciones_22">&nbsp;</td>
    <td class="percepciones_23">&nbsp;</td>
    <td class="percepciones_24">&nbsp;</td>
    <td class="percepciones_25">&nbsp;</td>
    <td class="deducciones_1">&nbsp;</td>
    <td class="deducciones_2">&nbsp;</td>
    <td class="deducciones_3">&nbsp;</td>
    <td class="deducciones_4">&nbsp;</td>
    <td class="deducciones_5">&nbsp;</td>
    <td class="deducciones_6">&nbsp;</td>
    <td class="deducciones_7">&nbsp;</td>
    <td class="deducciones_8">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="percepciones_1">&nbsp;</td>

    
    <td class="percepciones_1">&nbsp;</td>
    <td class="percepciones_2">&nbsp;</td>
    <td class="percepciones_3">&nbsp;</td>
    <td class="percepciones_4">&nbsp;</td>
    <td class="percepciones_5">&nbsp;</td>
    <td class="percepciones_6">&nbsp;</td>
    <td class="percepciones_7">&nbsp;</td>
    <td class="percepciones_8">&nbsp;</td>
    <td class="percepciones_9">&nbsp;</td>
    <td class="percepciones_10">&nbsp;</td>
    <td class="percepciones_11">&nbsp;</td>
    <td class="percepciones_12">&nbsp;</td>
    <td class="percepciones_13">&nbsp;</td>
    <td class="percepciones_14">&nbsp;</td>
    <td class="percepciones_15">&nbsp;</td>
    <td class="percepciones_16">&nbsp;</td>
    <td class="percepciones_17">&nbsp;</td>
    <td class="percepciones_18">&nbsp;</td>
    <td class="percepciones_19">&nbsp;</td>
    <td class="percepciones_20">&nbsp;</td>
    <td class="percepciones_21">&nbsp;</td>
    <td class="percepciones_22">&nbsp;</td>
    <td class="percepciones_23">Total Perc.:</td>
   
	
    <td class="percepciones_24"><input id="total_percepciones_nomina" name="total_percepciones_nomina" value="<?php echo $global_percepciones;?>" disabled="disabled" size="5" />
      <input type=""  id="total_percepciones_nomina_imss" name="total_percepciones_nomina_imss" value="<?php echo $global_percepciones_fiscal;?>" disabled="disabled" size="5" /></td>
    <td class="percepciones_25">&nbsp;</td>
     <td class="deducciones_1">&nbsp;</td>
    <td class="deducciones_2">&nbsp;</td>
    <td class="deducciones_3">&nbsp;</td>
    <td class="deducciones_4">&nbsp;</td>
    <td class="deducciones_5">&nbsp;</td>
  
    <td class="deducciones_6">&nbsp;</td>	
    <td class="deducciones_7"><input name="total_deducciones_nomina" type="text" id="total_deducciones_nomina" size="5" value="<?php echo  $global_deducciones; ?>" disabled="disabled"/>
      <input name="total_deducciones_nomina_imss" type=""  id="total_deducciones_nomina_imss" size="5" value="<?php echo  $global_deducciones_fiscal; ?>" disabled="disabled"/></td>
    <td class="deducciones_8">&nbsp;&nbsp;Total:&nbsp;</td>   
    <td align="right"><input name="total_empleados_nomina" type="text" id="total_empleados_nomina" size="5" value="<?php echo  $global_total; ?>" disabled="disabled" />
      <input name="total_empleados_nomina_imss" type=""  id="total_empleados_nomina_imss" size="5" value="<?php echo $global_total_fiscal; ?>" disabled="disabled" /></td>
  </tr>
  <tr>
    <td class="percepciones_1">&nbsp;</td>
    <td class="percepciones_1">&nbsp;</td>
    <td class="percepciones_observaciones" valign="top" colspan="10">Observaciones: <br />
    <textarea name="observaciones" id="observaciones" cols="60" rows="12"><?php echo $observaciones; ?></textarea></td>
    <td class="percepciones_12">&nbsp;</td>
     <td class="percepciones_13"></td>
 <td class="percepciones_14"></td>
 <td class="percepciones_15"></td>
 <td class="percepciones_16"></td>
 
    
    <td class="percepciones_tipos" colspan="7"><br />
    
    

    
    
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
    
    <td class="percepciones_24">&nbsp;</td>
    <td class="percepciones_25"></td>
    <td class="deducciones_1"></td>
    <td class="deducciones_2">&nbsp;</td>
    <td class="deducciones_3">&nbsp;</td>
    <td class="deducciones_4">&nbsp;</td>
    <td class="deducciones_5">&nbsp;</td>
    <td class="deducciones_6">&nbsp;</td>
    <td class="deducciones_7">&nbsp;</td>
    <td class="deducciones_8">&nbsp;</td>
     <td>&nbsp;</td>
  </tr>
</table>

</div>

