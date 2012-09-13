<?php 
	
	$id_empleado= $_POST['id_empleado'];
	$curp_empleado= $_POST['curp_empleado'];
	$no_seg_social= $_POST['no_seg_social'];
	$ap_paterno= $_POST['ap_paterno'];
	$ap_materno= $_POST['ap_materno'];
	$nombre= $_POST['nombre'];
	$cuenta_imss= $_POST['cuenta_imss'];
	$fecha_alta_imss= $_POST['fecha_alta_imss'];
	$domicilio= $_POST['domicilio'];
	$fecha_nacimiento= $_POST['fecha_nacimiento'];
	$sueldo_diario_imss= $_POST['sueldo_diario_imss'];
	$estado= $_POST['estado'];
	$observaciones= $_POST['observaciones'];
	$periodo= $_POST['periodo'];
	$sueldo_diario= $_POST['sueldo_diario'];
	$no_tarjeta= $_POST['no_tarjeta'];
	$infonavit= $_POST['infonavit'];		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Empleado</title>
</head>
<body>
<h2>Modificar datos Empleado</h2>
<br/>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#97B9FF" >
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

        <input type="hidden" name="id_empresa" id="id_empresa" />
         <input type="hidden" name="id_empleado" id="id_empleado" value="<?php echo $id_empleado; ?>"  />
        
        <td align="left"><input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" /></td>   
          
        <td align="left"> 
			<input type="text" name="ap_paterno" id="ap_paterno" value="<?php echo $ap_paterno; ?>" />       </td>
         
          <td><input type="text" name="ap_materno" id="ap_materno" value="<?php echo $ap_materno; ?>" /> </td>


        <td align="left" nowrap="nowrap">
			<input type="text" id="fecha_nac" onFocus="javascript:calendarioNaranja('fecha_nac');" value="<?php echo $fecha_nacimiento; ?>" >
       <br />
      
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa
      
      
        <br />
		</td>
        <td align="left">
 
       <input type="text" name="curp_empleado" id="curp_empleado" value="<?php echo $curp_empleado; ?>"  /><img src="images/curp.jpg" onclick="generaRfc();" id="togglePicker" class="pickerImg" width="25px" height="25px" alt="" />
        
</td>

         
      </tr>
      <tr>
        <td>Domicilio<br /><input type="text" name="domicilio" id="domicilio" value="<?php echo $domicilio; ?>" /></td>
        <td>Imss<br />
			<?php if($cuenta_imss=="Si"){ ?>
          <label>
            <input type="radio" name="cuenta_imss" value="Si" id="cuenta_imss_0" checked />
            Si</label>
          <label> &nbsp;&nbsp;&nbsp;
            <input type="radio" name="cuenta_imss" value="No" id="cuenta_imss_1" />
            No</label>
			<?php }
			else{?>
			<label>
            <input type="radio" name="cuenta_imss" value="Si" id="cuenta_imss_0"  />
            Si</label>
          <label> &nbsp;&nbsp;&nbsp;
            <input type="radio" name="cuenta_imss" value="No" id="cuenta_imss_1" checked />
            No</label>
			<?php } ?>
			</td>
        <td>No.Seguridad Social
          <input type="text" name="no_seg_social" id="no_seg_social" value="<?php echo $no_seg_social; ?>" /></td>
        <td nowrap="nowrap">Fecha Alta Imss<br/>
		<input type="text" id="fecha_imss" onFocus="javascript:calendarioNaranja('fecha_imss');" value="<?php echo $fecha_alta_imss; ?>" >
      
      <br />
      
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa
      
          
      </td>
        <td colspan="2" align="left" valign="top">Sueldo Imss<br/>
          <input name="sueldo_diario_imss" type="text" id="sueldo_diario_imss" size="10" value="<?php echo $sueldo_diario_imss; ?>"  />
          <br />
          <label>Sueldo Diario <br />
            <input name="sueldo_diario" type="text" id="sueldo_diario" size="10" value="<?php echo $sueldo_diario; ?>" />
          </label></td>
        </tr>
      <tr>

        <td valign="top"><label>Periodo de nómina:<br />
			<?php if($periodo=="semanal"){ ?>
				<input type="radio" name="periodo" id="semanal" value="semanal" checked />
				Semanal<br />
				<input type="radio" name="periodo" id="catorcenal" value="catorcenal" />
				Catorcenal<br />
				<input type="radio" name="periodo" id="quincenal" value="quincenal" />
				Quincenal<br />
				<input type="radio" name="periodo" id="mensual" value="mensual" />
				Mensual </label>
			<?php }elseif($periodo=="catorcenal"){?>
			   <input type="radio" name="periodo" id="semanal" value="semanal"  />
				Semanal<br />
				<input type="radio" name="periodo" id="catorcenal" value="catorcenal" checked />
				Catorcenal<br />
				<input type="radio" name="periodo" id="quincenal" value="quincenal" />
				Quincenal<br />
				<input type="radio" name="periodo" id="mensual" value="mensual" />
				Mensual </label>
			<?php }elseif($periodo=="quincenal"){?>
				<input type="radio" name="periodo" id="semanal" value="semanal"  />
				Semanal<br />
				<input type="radio" name="periodo" id="catorcenal" value="catorcenal"  />
				Catorcenal<br />
				<input type="radio" name="periodo" id="quincenal" value="quincenal" checked />
				Quincenal<br />
				<input type="radio" name="periodo" id="mensual" value="mensual" />
				Mensual </label>
			<?php }else{?>
				<input type="radio" name="periodo" id="semanal" value="semanal"  />
				Semanal<br />
				<input type="radio" name="periodo" id="catorcenal" value="catorcenal"  />
				Catorcenal<br />
				<input type="radio" name="periodo" id="quincenal" value="quincenal" />
				Quincenal<br />
				<input type="radio" name="periodo" id="mensual" value="mensual" checked />
				Mensual </label>
				<?php }?>
          <br /></td>
        <td valign="top">Num. Cuenta<br />
          <label>
            <input type="text" name="no_tarjeta" id="no_tarjeta" value="<?php echo $no_tarjeta; ?>"  />
          </label><br /></td>
        <td valign="top">Infonavit<br />
          <label>
            <input name="infonavit" type="text" id="infonavit" size="10"  value="<?php echo $infonavit; ?>"/>
          </label></td>


   <td valign="top">Observaciones:
     <textarea name="observaciones" id="observaciones" cols="20" rows="4" ><?php echo $observaciones; ?></textarea></td>

        <td colspan="2" valign="top"  nowrap="nowrap">          Estado:<br />
          <label>
            <select name="estado" id="estado" value="<?php echo $estado; ?>" >
              <option value="ACTIVO" selected="selected">ACTIVO</option>
              <option value="PENDIENTE">PENDIENTE</option>
              <option value="BAJA">BAJA</option>
            </select>
          </label></td>
          
		</tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td colspan="2" align="right" nowrap="nowrap">
          <input type="button" name="modificar" id="modificar" value="Modificar" onclick="if(confirm('Seguro de modificar los datos del empleado?'))guardar_empleado_modif('modificar'); return false" />
      </tr>
    </table>
</form>

</td>
  </tr>
</table>
</body>
</html>