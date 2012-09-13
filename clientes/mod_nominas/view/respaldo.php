<table class=""  border="0" cellspacing="2" cellpadding="1" id="tableall">
<thead>
<tr style="display:">
<td  bgcolor="#00CCFF">&nbsp;</td>

    <td  bgcolor="#00CCFF">&nbsp;Empleado</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Sueldo Diario </td>
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
    <td bgcolor="#00CCFF" align="center">Aguinaldo.</td>
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
  <tr>
  
   <td id="thSelectColumn"  style="background:#00CCFF">
   <label>M&aacute;s columnas</label>
   <ul id="ulSelectColumn" class="clickMenu">
     <li>
       <img src="../imagenes/ver.png" alt="select columns" title="select columns" align="left"/>
       
         <ul id="targetall">
           <li>
           </li>
         </ul>
   
     </li>
   </ul>
   </td>
   
    <td colspan="1" align="left" bgcolor="#BDBDBD"><b>Total Empleados:</b></td>
    <td  align="left" bgcolor="#D8D8D8" ><?php echo $cantidadEmpleados; ?></td>
    
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td  colspan="1" align="left" bgcolor="#BDBDBD"><b>Total Empleados Asegurados:</b></td>
    <td  align="left" bgcolor="#D8D8D8"><?php echo $cantidadEmpleadosImss; ?></td>
    
  </tr>
  
  <tr>
  <td></td>
    <td colspan="22" align="center" bgcolor="#0099CC">PERCEPCIONES</td>
    <td  align="center">&nbsp;</td>
    <td colspan="7" align="center" bgcolor="#99FF66">DEDUCCIONES</td>
    <td  align="center">&nbsp;</td>
    <td  align="center" bgcolor="#FF3300">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td align="center" bgcolor="#0099CC">&nbsp;</td>
    
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_sueldo_diario" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Sueldo Diario&#39;);" onmouseout="hidetooltip()" />
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_dias_trabajados" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Dias Trabajados&#39;);" onmouseout="hidetooltip()" />
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_sueldo" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Sueldo&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_horas_extras" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Horas Extras&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_he" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Horas Extras&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_domingos_t" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Domingos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_prima_dom" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Prima Dominical&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_dt2" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Domingos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_turnos_t" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Turnos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_tb" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Turnos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_descansos_t" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Descansos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_dt" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Descansos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_dias_f" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Dias Festivos&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_dias_f" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Dias Festivos&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_vacaciones" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Vacaciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_prima_d" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Prima Vacacional&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_v" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Vacaciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_aguinaldo" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Aguinaldo&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_complemento_s" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Complemento Sueldo&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_otras_p" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Otras Percepciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_per" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Percepciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td  align="center">&nbsp;</td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_prestamos" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Prestamos&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_caja_ahorro" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Caja de Ahorro&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_fonacot" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Fonacot&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_infonavit" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Infonavit&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_otras_d" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Otras Deducciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_prestamo_n" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Prestamo Navitas&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_total_de" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Deducciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td  align="center">&nbsp;</td>
    <td  align="center" bgcolor="#FF3300">
    <img id="ocultar_total" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar TOTAL&#39;);" onmouseout="hidetooltip()"/>
    </td>
  </tr>
  
  <tr nowrap="nowrap">
    <td >&nbsp;</td>
    <td  bgcolor="#00CCFF">&nbsp;Empleado</td>
    <td bgcolor="#00CCFF" align="center">Sueldo Diario</td>
    <td bgcolor="#00CCFF" align="center">Dias Trabajados</td>
    <td bgcolor="#00CCFF" align="center">Sueldo</td>
    <td bgcolor="#00CCFF" align="center">Horas extras</td>
    <td bgcolor="#00CCFF" align="center">Total H.E.</td>
    <td bgcolor="#00CCFF" align="center">Domingos trabajados</td>
    <td bgcolor="#00CCFF" align="center">Prima Dominical</td>
    <td bgcolor="#00CCFF" align="center">Total D.T.</td>
    

   

    <td bgcolor="#00CCFF" align="center">Turnos trabajados</td>
    <td bgcolor="#00CCFF" align="center"> Total Turnos Trab.</td>
    <td bgcolor="#00CCFF" align="center">Descansos Trabajados</td>
    <td bgcolor="#00CCFF" align="center">Total Descansos Trab.</td>
    <td bgcolor="#00CCFF" align="center"> Dias Festivos</td>
    <td bgcolor="#00CCFF" align="center">Total Dias Festivos</td>
    <td bgcolor="#00CCFF" align="center">    Vacaciones</td>
    <td bgcolor="#00CCFF" align="center">    Prima Vacacional</td>
    <td bgcolor="#00CCFF" align="center">    Total vac.</td>
    <td bgcolor="#00CCFF" align="center">    Aguinaldo.</td>
    <td bgcolor="#00CCFF" align="center">    Complemento Sueldo</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Otras Percepciones</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
   
    
    <td bgcolor="#99FF99" align="center">    Prestamos</td>
    <td bgcolor="#99FF99" align="center">Caja Ahorro</td>
    <td bgcolor="#99FF99" align="center">Fonacot</td>
    <td bgcolor="#99FF99" align="center">Infonavit</td>
    <td bgcolor="#99FF99" align="center">Otras deducciones</td>
    <td bgcolor="#99FF99" align="center">Prestamo navitas</td>
    <td bgcolor="#99FF99" align="center">Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#FF3300" align="center">TOTAL</td>
  </tr>
  
  </thead>
  
  
  <!--
     $('#ocultar_sueldo_diario
   $('#ocultar_dias_trabajados
   $('#ocultar_sueldo
   $('#ocultar_horas_extras
   $('#ocultar_total_he
   $('#ocultar_domingos_t
   $('#ocultar_prima_dom
   $('#ocultar_total_dt
  
   $('#ocultar_turnos_t
   $('#ocultar_total_tb
   $('#ocultar_descansos_t
   $('#ocultar_total_dt
   $('#ocultar_dias_f
   $('#ocultar_total_dias_f
   $('#ocultar_vacaciones
   $('#ocultar_prima_d
   $('#ocultar_total_v
   $('#ocultar_aguinaldo
   $('#ocultar_complemento_s
   $('#ocultar_otras_p
   $('#ocultar_total_per
  
   $('#ocultar_prestamos
   $('#ocultar_caja_ahorro
   $('#ocultar_fonacot
   $('#ocultar_infonavit
   $('#ocultar_otras_d
   $('#ocultar_prestamo_n
   $('#ocultar_total_de
   $('#ocultar_total
  -->
  
  
  
  <?php 
  
  while ($row_empleados = $datosEmpleados->fetch())
  {
	  $id_empleado=$row_empleados['id_empleado'];
	  
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
	
	
	
  
  ?>  

  <tr>
    <td nowrap="nowrap">&nbsp;</td>
      <td nowrap="nowrap">
  
	<input type="text" name="id_empleado[]" id="id_empleado_<?php echo $row_empleados['id_empleado']; ?>" value="<?php echo $row_empleados['id_empleado']; ?>" />
    
    <input  
    name="sueldo_integrado_<?php echo $row_empleados['id_empleado']; ?>" 
    type="" 
    id="sueldo_integrado_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['sueldo_diario_imss']; ?>" 
    size="5" 
    maxlength="10"    
    />
    
  
   <?php echo $row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno']; ?>	
    </td>
    
    <td  align="center">
    <input  
    name="sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['sueldo_diario']; ?>" 
    size="5" 
    maxlength="10"
    onmouseover="tooltip(&#39;<?php echo $tooltip_sueldo_diario;?>&#39;);" 
    onmouseout="hidetooltip()"    
    />
   
    <input  
    name="sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="" 
    id="sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo ($row_empleados['sueldo_diario_imss']/1.0452); ?>" 
    size="5" 
    maxlength="10" 
    />
    </td>
    
    <td nowrap="nowrap" align="center"><input 
    name="dias_trabajados_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="dias_trabajados_<?php echo $row_empleados['id_empleado']; ?>" 
    size="5" 
    maxlength="10" 
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
                                                       ); "
                                                       
 
 onmouseover="tooltip(&#39;<?php echo  $tooltip_dias_trabajados;?>&#39;);" 
 onmouseout="hidetooltip()" 
    /></td>
    
    <td align="right" nowrap="nowrap"> 
    <input type="text" 
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
                                                       readonly="readonly"
                          
                         value="0"  
                         size="5"
                         onmouseover="tooltip(&#39;<?php echo $tooltip_sueldo;?>&#39;);" 
                         onmouseout="hidetooltip()" 
                         
                         />
                         
                         
                         
                         <input  type=""
                          id="total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>" 
                          name="total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>"    
                          disabled="disabled" 
                          value="0"  
                          size="5"
                         />
                         
                         </td>
                         
    <td align="center" nowrap="nowrap">
    <input 
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
    value="0" size="5"
     onmouseover="tooltip(&#39;<?php echo $tooltip_horas_extras;?>&#39;);" 
                         onmouseout="hidetooltip()"    
    />
    <input 
    name="cantidad_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type=""
    id="cantidad_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0"    
    />
    </td>
    
    
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
    value="0"
    size="5"
     onmouseover="tooltip(&#39;<?php echo $tooltip_total_he;?>&#39;);" 
                         onmouseout="hidetooltip()"   />
    </label>
    
    <input 
    name="total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="" 
    id="total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>"  
    value="0" size="5"  />
    </td>
    
    
    <td align="center" nowrap="nowrap">
    <input 
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
    id="cantidad_domingos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"
    onmouseover="tooltip(&#39;<?php echo $tooltip_domingos_t;?>&#39;);" 
                         onmouseout="hidetooltip()"   />    
    
    <input 
    name="cantidad_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="" 
    id="cantidad_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>
    
    
    
    
    <td>
    <input 
          name="prima_dominical_<?php echo $row_empleados['id_empleado']; ?>" 
          type="text" 
          id="prima_dominical_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
          size="5" 
          maxlength="10"
           onmouseover="tooltip(&#39;<?php echo $tooltip_prima_dom;?>&#39;);" 
                         onmouseout="hidetooltip()"
          />
          
          <input 
          name="prima_dominical_imss_<?php echo $row_empleados['id_empleado']; ?>" 
           type="" 
          id="prima_dominical_imss_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
          size="5" 
          maxlength="10"
          />
    </td>
    <td align="center" nowrap="nowrap">
    <input 
    name="total_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="total_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0"  
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
                                          
                                          onmouseover="tooltip(&#39;<?php echo $tooltip_total_dt;?>&#39;);" 
                         onmouseout="hidetooltip()"   
                                          />
                                          
                                          <input 
                                          name="total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
                                           type="" 
                                          id="total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
                                          value="0"  
                                          size="5" 
                                          maxlength="10" />
                                          </td>


    <td align="center" nowrap="nowrap">
    <input 
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
    id="cantidad_turnos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"    
    onmouseover="tooltip(&#39;<?php echo $tooltip_turnos_t;?>&#39;);" 
    onmouseout="hidetooltip()" 
    />
     <input 
    name="cantidad_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    t type="" 
    id="cantidad_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>
    
    
    <td align="center" nowrap="nowrap">
    <input 
    name="total_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" id="total_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
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
                                          );
                                          "
                                           onmouseover="tooltip(&#39;<?php echo $tooltip_total_tb;?>&#39;);" 
    onmouseout="hidetooltip()"  />
                                          
                                          
                                          <input 
    name="total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="" id="total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    maxlength="10" 
    />
    </td>
                                          
    <td align="center" nowrap="nowrap">
    <input 
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
    id="cantidad_descansos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"
    onmouseover="tooltip(&#39;<?php echo $tooltip_descansos_t;?>&#39;);" 
    onmouseout="hidetooltip()"    
    />
    
     <input 
    name="cantidad_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type=""
    id="cantidad_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>
    
    <td align="center" nowrap="nowrap">
    <input 
    name="total_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="total_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
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
                                          ); "
                                          
                                           onmouseover="tooltip(&#39;<?php echo $tooltip_total_dt;?>&#39;);" 
    onmouseout="hidetooltip()"
                                           />
                                          
                                          
                                          <input 
    name="total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="" 
    id="total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    maxlength="10" 
   />
                                          </td>
                                          
    <td align="center" nowrap="nowrap">
    <input 
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
    id="cantidad_festivos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"
    onmouseover="tooltip(&#39;<?php echo $tooltip_dias_f;?>&#39;);" 
                         onmouseout="hidetooltip()"      
    />
    
    <input 
    name="cantidad_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type=""
    id="cantidad_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>
    
    <td align="center" nowrap="nowrap"><input name="total_festivos_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="total_festivos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" onfocus="javascript:    calcular_total_percepciones(
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
                                          );    "
                                          onmouseover="tooltip(&#39;<?php echo $tooltip_total_dias_f;?>&#39;);" 
                         onmouseout="hidetooltip()" />
                                          
                                          
                                          
      <input name="total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>"  type="" id="total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" />
                                          
                                          
                                          </td>
    
    
    
    
    <td align="center" nowrap="nowrap">
    <input 
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
    id="cantidad_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"    
    onmouseover="tooltip(&#39;<?php echo $tooltip_vacaciones;?>&#39;);" 
                         onmouseout="hidetooltip()"  
    />
    
     <input 
    name="cantidad_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="" 
    id="cantidad_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>   
  
    
    
                                          
                                         
                                         
                                          
                                          
  
 
    
    
    
    <td>
     <input 
          name="prima_vacacional_<?php echo $row_empleados['id_empleado']; ?>" 
          type="text" 
          id="prima_vacacional_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
          size="5" 
          maxlength="10"
           onmouseover="tooltip(&#39;<?php echo $tooltip_prima_d;?>&#39;);" 
                         onmouseout="hidetooltip()" 
     />
     
       <input 
          name="prima_vacacional_imss_<?php echo $row_empleados['id_empleado']; ?>" 
           type="" 
          id="prima_vacacional_imss_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
          size="5" 
          maxlength="10" 
     />
    </td>
    
    
    
    <td align="center" nowrap="nowrap">
    <input name="total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" onfocus="javascript:    calcular_total_percepciones(
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
                                          );    "
                                          onmouseover="tooltip(&#39;<?php echo $tooltip_total_v;?>&#39;);" 
                         onmouseout="hidetooltip()"  />
                                          
                                          <input name="total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>"  type="" id="total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" />
                                          
                                          </td>
    
    
    <td>
      <input 
          name="aguinaldo_<?php echo $row_empleados['id_empleado']; ?>" 
          type="text" 
          id="aguinaldo_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
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
                                                     "
                                                     onmouseover="tooltip(&#39;<?php echo $tooltip_aguinaldo;?>&#39;);" 
                         onmouseout="hidetooltip()"
                                                     /></td>
    
    
    <td align="center" nowrap="nowrap">
    <input 
    name="complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
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
                                                     "
                                                     onmouseover="tooltip(&#39;<?php echo $tooltip_complemento_s;?>&#39;);" 
                         onmouseout="hidetooltip()"/></td>
    <td align="center" nowrap="nowrap"><label>
      <input name="otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" onfocus="javascript:    calcular_total_percepciones(
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
                                          );    "
                                          onmouseover="tooltip(&#39;<?php echo $tooltip_otras_p;?>&#39;);" 
                         onmouseout="hidetooltip()"
                                           />
    </label></td>
    <td align="right" nowrap="nowrap">
    <input id="total_percepciones_<?php echo $row_empleados['id_empleado']; ?>" name="total_percepciones[]" value="0" readonly="readonly" size="5" 
    onmouseover="tooltip(&#39;<?php echo $tooltip_total_per;?>&#39;);" 
                         onmouseout="hidetooltip()"/>
    <input  type="" id="total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>" name="total_percepciones_imss[]" value="0" disabled="disabled" size="5" />
    </td>
    <td nowrap="nowrap">&nbsp;&nbsp;&nbsp;</td>
    
    <!--SECCION DE LAS DEDUCCIONES -->
    
    
    <td align="center" nowrap="nowrap"><label>
      <input 
      name="prestamos_<?php echo $row_empleados['id_empleado']; ?>" 
      type="text" 
      id="prestamos_<?php echo $row_empleados['id_empleado']; ?>" 
      value="0" 
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
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_prestamos;?>&#39;);" 
                         onmouseout="hidetooltip()"    />
    </label></td>
    <td align="center" nowrap="nowrap"><label>
    <input 
    name="caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
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
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_caja_ahorro;?>&#39;);" 
                         onmouseout="hidetooltip()"
                                                    />
    </label></td>
    <td align="center" nowrap="nowrap"><label>
    <input 
    name="fonacot_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="fonacot_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
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
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_fonacot;?>&#39;);" 
                         onmouseout="hidetooltip()" 
                                                    />
    </label></td>
    
    <td align="center" nowrap="nowrap">
    <input 
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
                                                   onmouseover="tooltip(&#39;<?php echo $tooltip_infonavit;?>&#39;);" 
                         onmouseout="hidetooltip()"   
                                                   /></td>
    <td align="center" nowrap="nowrap"><label>
    <input 
    type="checkbox" 
    name="chk_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_otras_deducciones(
                                       'chk_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>',                     
                                        '<?php echo $row_empleados['id_empleado']; ?>' ); 
                                         "/>
    <input 
    name="otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    readonly="readonly"
    onchange="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>',                                                        
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
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
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_otras_d;?>&#39;);" 
                         onmouseout="hidetooltip()"   
                                                    />
                                                    &nbsp;&nbsp;&nbsp;Descripci&oacute;n
                                                     <input 
    name="descripcion_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="descripcion_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    value="" 
    size="5"
    maxlength="30"
    readonly="readonly"
     onmouseover="tooltip(&#39;<?php echo $tooltip_desc_otras_d;?>&#39;);" 
                         onmouseout="hidetooltip()"  />
    </label></td>
    <td align="center" nowrap="nowrap"><label>
    <input 
    name="prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
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
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_prestamo_n;?>&#39;);" 
                         onmouseout="hidetooltip()"  
                                                    />      
    </label></td>
    <td align="right" nowrap="nowrap">
    <input name="total_deducciones[]" type="text" id="total_deducciones_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="0" readonly="readonly" onmouseover="tooltip(&#39;<?php echo $tooltip_total_de;?>&#39;);" 
                         onmouseout="hidetooltip()"   /></td>
    
    <td nowrap="nowrap">&nbsp;&nbsp;&nbsp;</td>
    <td align="right" nowrap="nowrap">
    <input name="total_empleado[]" type="text" id="total_empleado_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="0" readonly="readonly" onmouseover="tooltip(&#39;<?php echo $tooltip_total;?>&#39;);" 
                         onmouseout="hidetooltip()"   />
    
    <input name="total_empleado_imss[]"  type="" id="total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="0" disabled="disabled" />
    </td>

  
  
  
  
    </tr>
  <?php } ?>
  
  
  
  
  
  
  
  
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
    <td>
    <input id="total_percepciones_nomina" name="total_percepciones_nomina" value="0" disabled="disabled" size="5" />
    <input  type="" id="total_percepciones_nomina_imss" name="total_percepciones_nomina_imss" value="0" disabled="disabled" size="5" />
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Ded:</td>
    <td>
    <input name="total_deducciones_nomina" type="text" id="total_deducciones_nomina" size="5" value="0" disabled="disabled"/>
    <input name="total_deducciones_nomina_imss"  type="" id="total_deducciones_nomina_imss" size="5" value="0" disabled="disabled"/>    </td>
    <td>&nbsp;&nbsp;Total:&nbsp;</td>
    <td align="right">
    <input name="total_empleados_nomina" type="text" id="total_empleados_nomina" size="5" value="0" disabled="disabled" />
    <input name="total_empleados_nomina_imss"  type="" id="total_empleados_nomina_imss" size="5" value="0" disabled="disabled" />
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="10" valign="top"><label>Observaciones:
        <br />
        <textarea name="observaciones" id="observaciones" cols="60" rows="12"></textarea>
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6"><br />
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="54%">PERCEPCIONES:</td>
          <td align="right" width="46%"><input type="text" id="percepciones" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>HONORARIOS:</td>
          <td align="right"><input type="text" id="honorarios" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>RELATIVOS:</td>
          <td align="right"><input type="text" id="relativos" 
                                                            onchange="javascript:calcular_total_percepciones_nomina();" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>SUBTOTAL:</td>
          <td align="right"><input type="text" id="subtotal" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>IVA:</td>
          <td align="right"><input type="text" id="iva" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>TOTAL FACTURA:</td>
          <td align="right"><input type="text" id="total_factura" value="0" size="5" readonly="readonly" /></td>
        </tr>
      </table>
    <p>
      <label><br />
        <input type="button" name="guardar" id="guardar" value="Enviar Nomina"   onclick="javascript:guardar_nomina('<?php echo $id_empresa; ?>')"/>
      </label>
      <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="javascript:cargarPagina('consultar_nominas.php','mainContent')" />
    </p>
    
    <br/>
        <div id="alerta_nomina"></div>
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
    <td align="right">&nbsp;</td>
  </tr>
</table>