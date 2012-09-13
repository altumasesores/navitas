<?php 
if (!isset($_SESSION)) {
		  session_start();
	}


	
?>
<h1>Reportes</h1>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#97B9FF" >
  <tr>
    <td bgcolor="#97B9FF" align="center"><strong> GENERAR REPORTE</strong></td>
  </tr>
  <tr>
    <td>

<form id="frmEmpresas" name="frmEmpresas"  action="" >

    <table  border="0" align="left" cellspacing="5">
      <tr>
        <td align="left">Tipo de Reporte:
          <label>
            <select name="tipo_reporte" id="tipo_reporte" onchange="consultar_reporte();">
              <option value="seleccionar" selected="selected" disabled="disabled">Seleccionar...</option>
              <option value="clientes">Clientes</option>
              <option value="empleados">Empleados</option>
              <option value="nominas">Nominas</option>
              </select>
            </label>
          <br /></td>
        </tr>
    </table>
</form>

</td>
  </tr>
</table>

<p>&nbsp;</p>

<div id="reporte"> <?php include_once("../admin/reporte_nomina_consulta.php")?>   </div>


