<?php 
if (!isset($_SESSION)) {
	session_start();

}

$id_empresa=$_SESSION['id_empresa'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Empleados</title>
</head>
<body>

<h1>Empleados</h1>
<br />


<table border="1" cellspacing="0" cellpadding="0" bordercolor="#97B9FF" >
  <tr>
    <td bgcolor="#97B9FF" align="center"><strong>ALTA DE EMPLEADO:</strong></td>
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

        <input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $id_empresa;?>"/>
        <input type="hidden" name="estado" id="estado" value="PENDIENTE" />
        
        <td align="left"><input type="text" name="nombre" id="nombre" /></td>   
          
        <td align="left"> 
			<input type="text" name="ap_paterno" id="ap_paterno" />       </td>
         
          <td><input type="text" name="ap_materno" id="ap_materno" /> </td>


        <td align="left">
        <span id="fecha_nacimiento" >
		<input type="text" id="fecha_nac" size="10" onFocus="javascript:calendarioNaranja('fecha_nac');" >
		</span><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa
        </td>
        <td align="left">
       <input type="text" name="curp_empleado" id="curp_empleado" size="18" /><img src="../clients/images/curp.jpg" onclick="generaRfcEmp();" id="togglePicker" class="pickerImg" width="25px" height="25px" alt="" /></td>  
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
        <td>Sueldo Imss<br/>
          <input name="sueldo_diario_imss" type="text" id="sueldo_diario_imss" size="10"  /></td>
        <td>Fecha Alta Imss<br/>
        <span id="fecha_alta" >
		<input type="text" id="fecha_imss" size="10" onFocus="javascript:calendarioNaranja('fecha_imss');" >
		</span><br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa

      
      </td>
        <td colspan="2" align="left" valign="top">No.Seguridad Social
          <input type="text" name="no_seg_social" id="no_seg_social" /></td>
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
        <td valign="top"><label>Sueldo Diario <br />
          <input name="sueldo_diario" type="text" id="sueldo_diario" size="5" />
        </label></td>
        <td>Observaciones:
          <textarea name="observaciones" id="observaciones" cols="20" rows="4"></textarea></td>



<td>Fecha Alta Empleado<br/>
        <span id="fecha_alta" >
		<input type="text" id="fecha_altaEmpleado" size="10" onFocus="javascript:calendarioNaranja('fecha_altaEmpleado');" >
		</span><br />
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa
</td>
        <td colspan="2" align="right">
        <input type="button" name="guardar" id="guardar" value="Guardar" onclick="alta_empleado(); return false" />
        <input type="reset" name="cancelar" id="cancelar" value="Cancelar" onclick="limpiarEmpleado_cliente(); return false"/></td>
          
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

	<div id="empleados"><?php include("../clients/empleado_consulta.php"); ?> </div>
	

</td>
  </tr>
</table>

</body>
</html>