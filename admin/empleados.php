<?php 
	include_once("../admin/empresa_clase.php");
	$id_empresa= $_POST['id_empresa'];
	//$estado= $_POST['estado'];
	
	$objEmpresa= new cEmpresa();
	$listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);	
	
 while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){ 
	$razon_social= $row_empresas['razon_social'];
 }
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Empleados</title>
</head>
<body>
<h1>Empleados de la empresa:&nbsp;&nbsp; <?php echo $razon_social; ?>   </h1>
<input type="hidden" id="estadoBusq" />
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#97B9FF" >
  <tr>
    <td bgcolor="#97B9FF">Dar de Alta Empleado:</td>
  </tr>
  <tr>
    <td>


  <form id="frmEmpleados" name="frmEmpleados"  action="" >

    <table width="890"  border="0" align="left" cellpadding="0" cellspacing="6">
      <tr>
		<td width="144"  align="left">Nombre(s)</td>
        <td width="197"  align="left">Apellido Paterno</td>
        <td width="148" align="left">Apellido Materno</td>

        <td width="171" align="left">Fecha Nacimiento</td>
        <td width="176"  align="left">Curp</td>
          

        </tr>
      <tr>

        <input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $id_empresa; ?>" />
         <input type="hidden" name="id_empleado" id="id_empleado"  />
        
        <td align="left"><input type="text" name="nombre" id="nombre" /></td>   
          
        <td align="left"> 
			<input type="text" name="ap_paterno" id="ap_paterno" />       </td>
         
          <td><input type="text" name="ap_materno" id="ap_materno" /> </td>


        <td align="left" nowrap="nowrap">
        <!--<span id="fecha_nacimiento" onclick="javascript:calendar_nacimiento()">
		<input name="day" type="text" id="dia_nac" style="width: 18px; border-width: 1px 0 1px 1px;" maxlength="2" />
        <input value="/" type="text" style="width: 5px; border-width: 1px 0 1px 0;" disabled="disabled" />
        <input name="month" id="mes_nac" class="textbox" type="text" style="width: 16px; border-width: 1px 0 1px 0;" maxlength="2" />
        <input value="/" type="text" style="width: 5px; border-width: 1px 0 1px 0;" disabled="disabled" />
        <input name="year" id="anio_nac" type="text" style="width: 28px; border-width: 1px 0 1px 0;" maxlength="4" />
        <input type="text" style="width: 15px; border-width: 1px 1px 1px 0;" disabled="disabled" />
        <img src="images/calendar.gif" id="togglePicker2" class="pickerImg" width="13px" height="12px" alt="" />
	  </span>-->
			<input type="text" id="fecha_nac" onFocus="javascript:calendarioNaranja('fecha_nac');" >
			<!--<img src="calendar.gif" onclick="javascript:calendarioNaranja();" width="13px" height="12px" alt="" />-->

       <br />
      
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa
      
      
        <br />
		</td>
        <td align="left">
 
       <input type="text" name="curp_empleado" id="curp_empleado" /><img src="images/curp.jpg" onclick="generaRfc();" id="togglePicker" class="pickerImg" width="25px" height="25px" alt="" />
        
</td>

         
      </tr>
      <tr>
        <td>Domicilio<br /><input type="text" name="domicilio" id="domicilio" /></td>
        <td>Imss<br />
          <label>
            <input type="radio" name="cuenta_imss" value="Si" id="cuenta_imss_0" />
            Si</label>
          <label> &nbsp;&nbsp;&nbsp;
            <input type="radio" name="cuenta_imss" value="No" id="cuenta_imss_1" />
            No</label></td>
        <td>No.Seguridad Social
          <input type="text" name="no_seg_social" id="no_seg_social" /></td>
        <td nowrap="nowrap">Fecha Alta Imss<br/>
          
        <!--<span id="fecha_alta_imss" onclick="javascript:calendar_imss()">
		<input name="day" type="text" id="dia_alta" style="width: 18px; border-width: 1px 0 1px 1px;" maxlength="2" />
        <input value="/" type="text" style="width: 5px; border-width: 1px 0 1px 0;" disabled="disabled" />
        <input name="month" id="mes_alta" class="textbox" type="text" style="width: 16px; border-width: 1px 0 1px 0;" maxlength="2" />
        <input value="/" type="text" style="width: 5px; border-width: 1px 0 1px 0;" disabled="disabled" />
        <input name="year" id="anio_alta" type="text" style="width: 28px; border-width: 1px 0 1px 0;" maxlength="4" />
        <input type="text" style="width: 15px; border-width: 1px 1px 1px 0;" disabled="disabled" />
        <img src="images/calendar.gif" id="togglePicker" class="pickerImg" width="13px" height="12px" alt="" />
	  </span>--><input type="text" id="fecha_imss" onFocus="javascript:calendarioNaranja('fecha_imss');" >
      
      <br />
      
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa
      
          
      </td>
        <td colspan="2" align="left" valign="top">Sueldo Imss<br/>
          <input name="sueldo_diario_imss" type="text" id="sueldo_diario_imss" size="10"  />
          <br />
          <label>Sueldo Diario <br />
            <input name="sueldo_diario" type="text" id="sueldo_diario" size="10" />
          </label></td>
        </tr>
      <tr>

        <td valign="top"><label>Periodo de nómina:<br />
            <input type="radio" name="periodo" id="semanal" value="semanal" />
            Semanal<br />
            <input type="radio" name="periodo" id="catorcenal" value="catorcenal" />
            Catorcenal<br />
            <input type="radio" name="periodo" id="quincenal" value="quincenal" />
            Quincenal<br />
            <input type="radio" name="periodo" id="mensual" value="mensual" />
            Mensual </label>
          <br /></td>
        <td valign="top">Num. Cuenta<br />
          <label>
            <input type="text" name="no_tarjeta" id="no_tarjeta" />
          </label><br /></td>
        <td valign="top">Infonavit<br />
          <label>
            <input name="infonavit" type="text" id="infonavit" size="10" />
          </label></td>


   <td valign="top">Fecha Alta Empleado<br/>
        <span id="fecha_alta" >
		<input type="text" id="fecha_altaEmpleado" size="10" onFocus="javascript:calendarioNaranja('fecha_altaEmpleado');" >
		</span><br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa</td>

        <td colspan="2" valign="top"  nowrap="nowrap">          Estado:<br />
          <label>
            <select name="estado" id="estado">
              <option value="ACTIVO" selected="selected">ACTIVO</option>
              <option value="PENDIENTE">PENDIENTE</option>
              <option value="BAJA">BAJA</option>
            </select>
          </label></td>
          
		</tr>
      <tr>
       <td>Observaciones:
     <textarea name="observaciones" id="observaciones" cols="20" rows="4"></textarea>
</td>
        <td valign="top"></td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td colspan="2" align="right" nowrap="nowrap"><input type="button" name="guardar" id="guardar" value="Guardar" onclick="if(confirm('Desea ingresar los datos del empleado?'))guardar_empleado('guardar'); return false" />
          <input type="button" name="modificar" id="modificar" value="Modificar" onclick="if(confirm('Seguro de modificar los datos del empleado?'))guardar_empleado('modificar'); return false" />
          <input type="reset" name="cancelar" id="cancelar" value="Cancelar" onclick="limpiarEmpleado(); return false"/></td>
      </tr>
    </table>
</form>

</td>
  </tr>
</table>


<br/>

<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FDCC37" >
  <tr>
    <td align="center" bgcolor="#FDCC37"><strong>LISTA DE EMPLEADOS:</strong></td>
  </tr>
  <tr>
    <td>

	<div id="empleados">  <?php include("../admin/empleado_consulta.php"); ?> </div>
	

</td>
  </tr>
</table>



</body>
</html>