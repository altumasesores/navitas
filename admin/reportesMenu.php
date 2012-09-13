<?php 
if (!isset($_SESSION)) {
		  session_start();
	}


	
?>
<h1>Reportes</h1>
<table cellspacing="0" cellpadding="0" >
  <tr>
    <td><IMG SRC="../imagenes/reporte1.png" WIDTH="30px" HEIGHT="30px" ALT="Reporte1" onclick="reporte(1);" >Reporte 1</img></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><IMG SRC="../imagenes/reporte2.png" WIDTH="30px" HEIGHT="30px" ALT="Reporte2" onclick="reporte(2);" >Reporte 2</img></td>
  </tr>
</table>