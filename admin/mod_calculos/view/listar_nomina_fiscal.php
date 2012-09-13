<?php 
error_reporting(0);
 $Datos = $DatosNomina->fetch();
?>

 <?php
		
  $parametros_basicos=str_replace('"',"'",json_encode(array(
  "controlador"=>"Calculos",			    
  "mensaje"=>"este usuario",
  "capa"=>"nominas_empresa_empleados",
  "modulo"=>"calculos"					   
  )));
  

  
  $operaciones=array(
		"Cargar"=>str_replace('"',"'",json_encode(array(
						"operacion"=>"CargarNomina",
						"accion"=>"CargarNomina"
						))),
		
		"ElimNominaFiscal"=>str_replace('"',"'",json_encode(array(
						"operacion"=>"ElimNominaFiscal",
						"accion"=>"EliminarNominaFiscal"
						)))
	  );
  

$parametros_especificos=str_replace('"',"'",json_encode(array(
				  "id_nomina"=>$Datos['id_nomina'],
				  "id_empresa"=>$Datos['id_empresa']			   
				  
				  )));

  
?>


<a  href="#" onclick="transaccionesNomina.consultarNominaEmpresaXIdNomina(<?php echo $parametros_especificos?>,'nominas_empresa_empleados','consultarNominaXIdNomina','POST')">Regresar</a>     
 <br/><br/><br/>
<table  border="1" cellspacing="2" cellpadding="0" >
	<tr>
    <td align="center" bgcolor="#0099CC">Nomina</td>
    <td  align="center"><?php echo $Datos['id_nomina']; ?></td>
	</tr>
	<tr>
    <td align="center" bgcolor="#0099CC">Empresa</td>
    <td  align="center"><?php echo $Datos['razon_social']; ?></td>
	</tr>
	<tr>
    <td align="center" bgcolor="#0099CC">Periodo</td>
    <td  align="center"><?php echo $Datos['inicio_periodo'].' Al '.$Datos['fin_periodo']; ?></td>
	</tr>
</table>
<br/><br/><br/><br/>
<table  border="1" cellspacing="2" cellpadding="0" >
  <tr>
    <td colspan="25" align="center" bgcolor="#0099CC">PERCEPCIONES</td>
    <td  align="center">&nbsp;</td>
    <td colspan="9" align="center" bgcolor="#99FF66">DEDUCCIONES</td>
	 <td></td>
	 <td bgcolor="#FF3300" align="center"></td>
  </tr>
  <tr >
    <td  bgcolor="#00CCFF">&nbsp;Empleado</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Sueldo Diario</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Dias Trabajados</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Sueldo</td>
	<td bgcolor="#00CCFF" align="center">Num. Domingos Trabajados</td>
	<td bgcolor="#00CCFF" align="center">Total Domingos Trabajados</td>
	<td bgcolor="#00CCFF" align="center">Prima Dominical</td>
	<td bgcolor="#00CCFF" align="center">Num. Vacaciones</td>
	<td bgcolor="#00CCFF" align="center">Total vac.</td>
    <td bgcolor="#00CCFF" align="center">Prima Vacacional</td>
	<td bgcolor="#00CCFF" align="center">Num Turnos Trab.</td>
	<td bgcolor="#00CCFF" align="center">Total Turnos Trab.</td>
	<td bgcolor="#00CCFF" align="center">Num Descansos Trab.</td>
	<td bgcolor="#00CCFF" align="center">Total Descansos Trab.</td>
    <td bgcolor="#00CCFF" align="center">Num H.E.</td>
	<td bgcolor="#00CCFF" align="center">Total H.E.</td>
    <td bgcolor="#00CCFF" align="center">Num Dias Festivos</td>
	<td bgcolor="#00CCFF" align="center">Total Dias Festivos</td>
	<td bgcolor="#00CCFF" align="center">Aguinaldo</td>
	<td bgcolor="#00CCFF" align="center">Subsidio al Empleo</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Puntualidad</td>
	<td bgcolor="#00CCFF" align="center">&nbsp;Asistencia</td>
	<td bgcolor="#00CCFF" align="center">&nbsp;Despensa</td>
	<td bgcolor="#00CCFF" align="center">&nbsp;Becas Educacionales</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    
    
    <td bgcolor="#99FF99" align="center">&nbsp;Prestamos</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Caja Ahorro</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Fonacot</td>
    <td bgcolor="#99FF99" align="center">Infonavit</td>
	<td bgcolor="#99FF99" align="center">ISR</td>
	<td bgcolor="#99FF99" align="center">IMSS</td>
	<td bgcolor="#99FF99" align="center">&nbsp;Descripci&oacute;n Otras deducciones</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Otras deducciones</td>
	<td bgcolor="#99FF99" align="center">&nbsp;Total</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#FF3300" align="center">&nbsp;TOTAL</td>
  </tr>
<?php 
	
	while ($row_empleados = $EmpleadosNomina->fetch()){ 
	$SueldDiario=$row_empleados['p_sueldo_diario'];
	$SueldoTotal=$row_empleados['p_total_sueldo'];
	$TotalDomingos=$row_empleados['p_subtotal_domingos'];
	$PrimaDominical=$row_empleados['p_prima_dominical'];
	$TotalVacaciones=$row_empleados['p_subtotal_vacaciones'];
	$PrimaVacacional=$row_empleados['p_prima_vacacional'];
	$TotalTurnosTrabajados=$row_empleados['p_total_turnos_trabajados'];
	$TotalDescansosTrabajados=$row_empleados['p_total_descansos_trabajados'];
	$TotalHrExtras=$row_empleados['p_total_horas_extras'];
	$TotalDiasFestivos=$row_empleados['p_total_dias_festivos'];
	$Aguinaldo=$row_empleados['p_aguinaldo'];
	$SubsidioEmpleo=$row_empleados['p_subsidio_empleo'];
	$Puntualidad=$row_empleados ['p_premio_por_puntualidad'];
	$Asistencia=$row_empleados ['p_premio_por_asistencia'];
	$Despensa=$row_empleados ['p_despensa'];
	$BecasEducacionales=$row_empleados ['p_becas_educacionales'];
	$TotalOtrasPercepciones=$Puntualidad+$Asistencia+$BecasEducacionales;
	
	$Prestamo=$row_empleados['d_prestamos'];
	$CajaAhorro=$row_empleados['d_caja_ahorro'];
	$Fonacot=$row_empleados['d_fonacot'];
	$Infonavit=$row_empleados['d_infonavit'];
	$ISR=$row_empleados['d_ISR'];
	$IMSS=$row_empleados['d_IMSS'];
	$TotalOtrasDeducciones=$row_empleados['d_total_otras_deducciones'];
	
	$TotalPercepcionEmpleado=$SueldoTotal+$TotalDomingos+$PrimaDominical+$TotalVacaciones+$PrimaVacacional+$TotalTurnosTrabajados+$TotalDescansosTrabajados+$TotalHrExtras+$TotalDiasFestivos+$Aguinaldo+$SubsidioEmpleo+$TotalOtrasPercepciones+$Despensa;
	$TotalDeduccionesEmpleado=$Prestamo+$CajaAhorro+$Fonacot+$Infonavit+$ISR+$IMSS+$TotalOtrasDeducciones;
	
	////////////////////////////////////////////////////////////////////////Totales//////////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////Total de Percepciones///////////////////////////////////
	$SueldoDiario=$SueldoDiario + $SueldDiario;
	$Sueldo=$Sueldo + $SueldoTotal;
	$Total_Domingos_Trabajados=$Total_Domingos_Trabajados + $TotalDomingos;
	$Prima_Dominical=$Prima_Dominical + $PrimaDominical;
	$Total_vac=$Total_vac + $TotalVacaciones;
	$Prima_Vacacional=$Prima_Vacacional + $PrimaVacacional;
	$Total_Turnos_Trab=$Total_Turnos_Trab + $TotalTurnosTrabajados;
	$Total_Descansos_Trab=$Total_Descansos_Trab + $TotalDescansosTrabajados;
	$Total_Horas_Exras=$Total_Horas_Exras + $TotalHrExtras;
	$Total_Dias_Festivos=$Total_Dias_Festivos + $TotalDiasFestivos;
	$Total_Aguinaldo=$Total_Aguinaldo + $Aguinaldo;
	$Subsidio_Empleo=$Subsidio_Empleo + $SubsidioEmpleo;
	$Total_Puntualidad=$Total_Puntualidad + $Puntualidad;
	$Total_Asistencia=$Total_Asistencia + $Asistencia;
	$Total_Becas_Educacionales=$Total_Becas_Educacionales + $BecasEducacionales;
	$Total_Despensa=$Total_Despensa + $Despensa;
	//////////////////////////////Total Deducciones///////////////////////////////////
	
	$TotalPrestamos=$TotalPrestamos + $Prestamo;
	$Total_Caja_Ahorro=$Total_Caja_Ahorro + $CajaAhorro;
	$TotalFonacot=$TotalFonacot + $Fonacot;
	$TotalInfonavit=$TotalInfonavit + $Infonavit;
	$TotalISR=$TotalISR + $ISR;
	$TotalIMSS=$TotalIMSS + $IMSS;
	$Total_Otras_deducciones=$Total_Otras_deducciones + $TotalOtrasDeducciones;
	
	////////////////////////////////////////////////////////////////////////FIN Totales//////////////////////////////////////////////////////////////////////////
	
	if($TotalDeduccionesEmpleado<0){
	$NetoPagar=($TotalPercepcionEmpleado) + ($TotalDeduccionesEmpleado);
	}
	else{
	$NetoPagar=$TotalPercepcionEmpleado - $TotalDeduccionesEmpleado;
	}

	?>  
  <tr>
	<input type="hidden" name="id_empleado[]" value="<?php echo $row_empleados['id_empleado']; ?>" />
    <td nowrap="nowrap">
	<?php echo $row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno']; ?>
    </td>
    
    <td nowrap="nowrap" align="center">
    <input
    name="sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>" disabled="enabled"
    type="text" 
    id="sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $SueldDiario; ?>" 
    size="5" 
    maxlength="10"	/>
    </td>
    <td nowrap="nowrap" align="center">
    <label>
    <input 
    name="dias_trabajados" 
    type="text" 
    id="dias_trabajados_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['p_dias_trabajados']; ?>" disabled="enabled"
    size="5" 
    maxlength="10" 
    />
    </label>
    </td>
    
    <td align="right" nowrap="nowrap">
    <input type="text" id="total_sueldo_<?php echo $row_empleados['id_empleado']; ?>" name="total_sueldo" disabled="enabled" 
    value="<?php echo $SueldoTotal; ?>"  
    size="5" 
    />
    </td>
    <td align="center" nowrap="nowrap">
    <label>
    <input 
    name="p_num_domingos_trabajados<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_num_domingos_trabajados<?php echo $row_empleados['id_empleado']; ?>" disabled="enabled" 
    value="<?php echo $row_empleados['p_num_domingos_trabajados']; ?>"  
    size="5"  
    />
    </label>
    </td>    
    <td><input 
          name="p_subtotal_domingos<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_subtotal_domingos<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $TotalDomingos; ?>" size="5" disabled="enabled" 
          maxlength="10"
    />
    </td>
    <td align="center" nowrap="nowrap">
    <input name="p_prima_dominical<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_prima_dominical<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $PrimaDominical; ?>" size="5" maxlength="10" disabled="enabled"
    />
    </td>
    <td align="center" nowrap="nowrap"><input name="p_num_vacaciones<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_num_vacaciones<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['p_num_vacaciones']; ?>" size="5" maxlength="10" disabled="enabled"
    />
    </td>  
    <td align="center" nowrap="nowrap">
    <input name="p_subtotal_vacaciones<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_subtotal_vacaciones<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $TotalVacaciones; ?>" disabled="enabled" 
    size="5" 
    maxlength="10" />
    </td>
    <td align="center" nowrap="nowrap">
    <input 
    name="p_prima_vacacional<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_prima_vacacional<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $PrimaVacacional; ?>" disabled="enabled" 
    size="5" 
    maxlength="10" />
    </td>
    <td>   
    <input 
          name="p_num_turnos_trabajados<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_num_turnos_trabajados<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['p_num_turnos_trabajados']; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" 
     />
     </td>
 
    <td align="center" nowrap="nowrap">
    <input 
    name="p_total_turnos_trabajados<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_total_turnos_trabajados<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $TotalTurnosTrabajados; ?>" disabled="enabled" 
    size="5" 
    maxlength="10" />
    </td>
    
    <td>
     <input 
          name="p_num_descansos_trabajados<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_num_descansos_trabajados<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['p_num_descansos_trabajados']; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
    <td>
     <input 
          name="p_total_descansos_trabajados<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_total_descansos_trabajados<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $TotalDescansosTrabajados; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
	<td>
     <input 
          name="p_num_horas_extras<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_num_horas_extras<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['p_num_horas_extras']; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
	<td>
     <input 
          name="p_total_horas_extras<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_total_horas_extras<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $TotalHrExtras; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
	<td>
     <input 
          name="p_num_dias_festivos<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_num_dias_festivos<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['p_num_dias_festivos']; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
	<td>
     <input 
          name="p_total_dias_festivos<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_total_dias_festivos<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $TotalDiasFestivos; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
	<td>
     <input 
          name="p_aguinaldo<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_aguinaldo<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $Aguinaldo; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
    <td>
     <input 
          name="p_subsidio_empleo<?php echo $row_empleados['id_empleado']; ?>" type="text" id="p_subsidio_empleo<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $SubsidioEmpleo; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
	<td>
     <input 
          name="Puntualidad<?php echo $row_empleados['id_empleado']; ?>" type="text" id="Puntualidad<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $Puntualidad; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
	<td>
     <input 
          name="Asistencia<?php echo $row_empleados['id_empleado']; ?>" type="text" id="Asistencia<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $Asistencia; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
	<td>
     <input name="Despensa<?php echo $row_empleados['id_empleado']; ?>" type="text" id="Despensa<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $Despensa; ?>" disabled="enabled" size="5" 
          maxlength="10" />
    </td>
	<td>
     <input 
          name="BecasEducacionales<?php echo $row_empleados['id_empleado']; ?>" type="text" id="BecasEducacionales<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $BecasEducacionales; ?>" disabled="enabled" 
          size="5" 
          maxlength="10" />
    </td>
    <td align="right" nowrap="nowrap"><input id="total_percepciones_<?php echo $row_empleados['id_empleado']; ?>" name="total_percepciones_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $TotalPercepcionEmpleado; ?>" disabled="enabled" 
    size="5" 
    />
    </td>    
    <td nowrap="nowrap">&nbsp;&nbsp;&nbsp;</td>
    <!--SECCION DE LAS DEDUCCIONES -->
    <td align="center" nowrap="nowrap"><label>
      <input name="prestamos[]" type="text" id="prestamos_<?php echo $row_empleados['id_empleado']; ?>"  size="5" value="<?php echo $Prestamo; ?>" disabled="enabled"  /> 
    </label></td>
    
    <td align="center" nowrap="nowrap"><label>
      <input name="caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>"  size="5" value="<?php echo $CajaAhorro; ?>" disabled="enabled" />
    </label></td>
    
    <td align="center" nowrap="nowrap"><label>
      <input name="fonacot_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="fonacot_<?php echo $row_empleados['id_empleado']; ?>"  size="5" value="<?php echo $Fonacot; ?>" disabled="enabled" />
    </label></td>
    
    <td align="center" nowrap="nowrap"><input name="infonavit_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="infonavit_<?php echo $row_empleados['id_empleado']; ?>"  size="5" value="<?php echo $Infonavit; ?>" disabled="enabled" /></td>
	<td align="center" nowrap="nowrap"><input name="d_ISR<?php echo $row_empleados['id_empleado']; ?>" type="text" id="d_ISR<?php echo $row_empleados['id_empleado']; ?>"  size="5" value="<?php echo $ISR; ?>" disabled="enabled" /></td>
	<td align="center" nowrap="nowrap"><input name="d_IMSS<?php echo $row_empleados['id_empleado']; ?>" type="text" id="d_IMSS<?php echo $row_empleados['id_empleado']; ?>"  size="5" value="<?php echo $IMSS; ?>" disabled="enabled" /></td>
    <td align="center" nowrap="nowrap"><label>
      <input name="d_descripcion_otras_deducciones<?php echo $row_empleados['id_empleado']; ?>" type="text" id="d_descripcion_otras_deducciones<?php echo $row_empleados['id_empleado']; ?>"  size="5" value="<?php echo $row_empleados['d_descripcion_otras_deducciones']; ?>" disabled="enabled" />
    </label></td>
    <td align="center" nowrap="nowrap"><label>
      <input name="d_total_otras_deducciones<?php echo $row_empleados['id_empleado']; ?>" type="text" id="d_total_otras_deducciones<?php echo $row_empleados['id_empleado']; ?>"  size="5" value="<?php echo $TotalOtrasDeducciones; ?>" disabled="enabled" />
    </label></td>
	<td align="center" nowrap="nowrap"><label>
      <input name="TotalDeducciones" type="text" id="TotalDeducciones"  size="5" value="<?php echo $TotalDeduccionesEmpleado; ?>" disabled="enabled" />
    </label></td>
	<td></td>
	<td><?php echo $NetoPagar; ?></td>
    </tr>
  <?php 
	$TotalPercepcionesNomina=$TotalPercepcionesNomina+$TotalPercepcionEmpleado;
	$TotalDeduccionesNomina=$TotalDeduccionesNomina+$TotalDeduccionesEmpleado;
	$TotalNomina=$TotalNomina+$NetoPagar;
  } 
  	
	?>
  <tr>
  <td>Totales:</td>
  <td align="center" ><?php echo $SueldoDiario; ?></td>
  <td></td>
  <td align="center" ><?php echo $Sueldo; ?></td>
  <td></td>
  <td align="center" ><?php echo $Total_Domingos_Trabajados; ?></td>
  <td align="center" ><?php echo $Prima_Dominical; ?></td>
  <td></td>
  <td align="center" ><?php echo $Total_vac; ?></td>
  <td align="center" ><?php echo $Prima_Vacacional; ?></td>
  <td></td>
  <td align="center" ><?php echo $Total_Turnos_Trab; ?></td>
  <td></td>
  <td align="center" ><?php echo $Total_Descansos_Trab; ?></td>
  <td></td>
  <td align="center" ><?php echo $Total_Horas_Exras; ?></td>
  <td></td>
  <td align="center" ><?php echo $Total_Dias_Festivos; ?></td>
  <td align="center" ><?php echo $Total_Aguinaldo; ?></td>
  <td align="center" ><?php echo $Subsidio_Empleo; ?></td>
  <td align="center" ><?php echo $Total_Puntualidad; ?></td>
  <td align="center" ><?php echo $Total_Asistencia; ?></td>
  <td align="center" ><?php echo $Total_Despensa; ?></td>
  <td align="center" ><?php echo $Total_Becas_Educacionales; ?></td>
  <td align="center" ><?php echo $TotalPercepcionesNomina; ?></td>
  <td></td>
  <td align="center" ><?php echo $TotalPrestamos; ?></td>
  <td align="center" ><?php echo $Total_Caja_Ahorro; ?></td>
  <td align="center" ><?php echo $TotalFonacot; ?></td>
  <td align="center" ><?php echo $TotalInfonavit; ?></td>
  <td align="center" ><?php echo $TotalISR; ?></td>
  <td align="center" ><?php echo $TotalIMSS; ?></td>
  <td></td>
  <td align="center" ><?php echo $Total_Otras_deducciones; ?></td>
  <td align="center" ><?php echo $TotalDeduccionesNomina; ?></td>
  <td></td>
  <td><?php echo $TotalNomina; ?></td>
   </tr>
   <tr>
  <td colspan="32" ></td>
  <td colspan="5" align="right" ><!--<a href="javascript:operaciones2.inicializador(<?php //echo $parametros_basicos?>,<?php //echo $parametros_especificos?>,<?php //echo $operaciones['ElimNominaFiscal']?>,'POST');" >Eliminar Nomina Fiscal</a> --></td>
   </tr>
   </table>
   <br/>
   <table width="100%" >
   <tr>
   <td width="50%" align="left" ><a href="../admin/mod_calculos/view/imprimir_nominaFiscal.php?id_nomina=<?php echo $Datos['id_nomina']; ?>&id_empresa=<?php echo $Datos['id_empresa']; ?>" target="_blank">Nomina_Fiscal</a>
   </td>
   <td width="50%" align="right" >
   
   </td>
   </tr>
   </table>
   
    
	