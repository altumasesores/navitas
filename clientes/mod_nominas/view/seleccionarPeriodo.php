<script>
$("#numeroEmpleadosNomina").html("");
	
$("#cargar").click(function(){
	periodo=$("#periodo_nomina").val();
	id_usuario="<?php echo $id_usuario;?>";	
	inicio_periodo=$("#inicio_periodo_i").val();
	fin_periodo=$("#fin_periodo_i").val();
	mensaje="";
	
	if(periodo=='ninguna')
	{
		mensaje+="- Hace falta el periodo \n";
		}
	if(inicio_periodo=="")
	{
		mensaje+="- Hace falta la fecha de inicio \n";
		}
	
	if(fin_periodo=="")
	{
		mensaje+="- Hace falta fecha final \n";
		}
		
	if(mensaje!="")
	{
		jAlert(mensaje);
		return false;
		}
	
	parametros={
		'periodo':periodo,
		'id_usuario':id_usuario,
		"inicio_periodo":inicio_periodo,
		"fin_periodo":fin_periodo
		};
	transaccionesNomina.cargarNuevaNominaClienteXPeriodo(parametros,'cuerpoNomina','cargarNuevaNominaClienteXPeriodo','POST');
	});
</script>
<h2>Enviar Nómina:</h2>

<table border="0">
<tr>
<td>

<table border="0">
  <tr>
  
    <td bgcolor="#00CCFF">
    <strong>
    Nómina del periodo:
    </strong>
    </td>
    
    <td >
    <span id="fecha_inicio">
	<input type="text" name="inicio_periodo_i" id="inicio_periodo_i" size="10" onFocus="javascript:calendarioNaranja('inicio_periodo_i');" />
	 </span>
     <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa     
     </td>
     
    <td width="22">
    &nbsp;Al&nbsp;
    </td> 
    
    <td>
    <span id="fecha_fin">
	<input type="text" id="fin_periodo_i" name="fin_periodo_i" size="10" onFocus="javascript:calendarioNaranja('fin_periodo_i');" />
	</span>
    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa 
    </td>
    
  </tr>
  
  <tr>
    <td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>

</table>

</td>
<td>&nbsp;</td>
<td bgcolor="#00CCFF"><label>
  Tipo de Nómina:  </label> </td>
  
  <td>
 
  <select name="periodo_nomina" id="periodo_nomina">
  <!--<select name="periodo_nomina" id="periodo_nomina" onchange="javascript:nueva_nomina()">-->
  
    <option value="ninguna" selected="selected" disabled="disabled">Seleccionar...</option>
    <option value="semanal">Semanal</option>
    <option value="catorcenal">Catorcenal</option>
    <option value="quincenal">Quincenal</option>
    <option value="mensual">Mensual</option>
  </select>
 </td>
 
 <td><input type="button" value="Cargar" id="cargar" /></td>

<td>&nbsp;&nbsp;&nbsp;&nbsp;</td> 
<td><div style="font-size:14px;" id="numeroEmpleadosNomina"></div></td>
</tr>
</table>


  
  
 <!--
  <select name="periodo_nomina" id="periodo_nomina" onchange="javascript:nueva_nomina()">
  
    <option value="ninguna" selected="selected" disabled="disabled">Seleccionar...</option>
    <option value="semanal">Semanal</option>
    <option value="catorcenal">Catorcenal</option>
    <option value="quincenal">Quincenal</option>
    <option value="mensual">Mensual</option>
  </select>
  -->

<br /><br />

<div id="nueva_nomina"></div>

