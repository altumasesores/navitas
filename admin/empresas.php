<?php 
if (!isset($_SESSION)) {
		  session_start();
	}

	
	
?>
<h1>Empresas</h1>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#97B9FF" >
  <tr>
    <td bgcolor="#97B9FF" align="center"><strong> NUEVA EMPRESA</strong></td>
  </tr>
  <tr>
    <td>

<form id="frmEmpresas" name="frmEmpresas"  action="" >

    <table  border="0" align="left" cellspacing="5">
      <tr>
        
        <td align="left">
          <input type="hidden" name="id_empresa" id="id_empresa" />
          <input type="hidden" name="id_usuario" id="id_usuario" />
          
          Razón Social
          <br />
          <input type="text" name="razon_social" id="razon_social" />
          
  </td>
        <td align="left">
          <label>
            Titular
            <br />
            <input type="text" name="titular" id="titular" />
            </label>
          </td>
        <td align="left">R.F.C.<br />
          <input type="text" name="R.F.C." id="rfc" /></td>
        <td align="left">
          <label>
            Dirección<br />
            <input type="text" name="direccion" id="direccion" />
            </label></td>
        <td align="left">
          
          Teléfonos
          <br />
          <input type="text" name="telefonos" id="telefonos" />
          
          </td>
        
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left"><label>Correo <br />
          <input type="text" name="correo" id="correo" />
        </label></td>
        <td>Zona <br />
          <select name="zona" id="zona">
            <option disabled="disabled">zona</option>
            <option value="chetumal">Chetumal</option>
            <option value="cancun">Cancún</option>
            <option value="playa del carmen">Playa del Carmen</option>
            <option value="cozumel">Cozumel</option>
            <option value="chetumal">México</option>
          </select></td>
        <td><label>I.V.A.:
            <input name="iva" type="text" id="iva" value="11" size="5" />
        %</label></td>
        <td> &nbsp;&nbsp;Honorarios:
          <label>
            <input name="honorarios" type="text" id="honorarios" value="6" size="5" />
          %</label></td>

        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="left">Usuario<br />
          <input type="text" name="user" id="user" /></td>
        <td>Password<br />
          <input type="text" name="password" id="password" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">
        <input type="button" name="guardar" id="guardar" value="Guardar" onClick="if(confirm('Realmente desea agregar a esta empresa?'))guardar_empresa(); return false" />  
        <input  type="button" disabled="disabled" name="MM_update" id="modificar" value="Modificar" onClick="if(confirm('Seguro de modificar los datos de la empresa?'))empresa_modificar(); return false"/>
        
        </td>
        <td><input type="reset" name="cancelar" id="cancelar" value="Cancelar" onClick="limpiarEmpresa(); return false"/></td>
      </tr>
    </table>
</form>

</td>
  </tr>
</table>

<p>&nbsp;</p>




<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FDCC37" >
  <tr>
    <td align="center" bgcolor="#FDCC37"><strong>LISTA DE EMPRESAS</strong></td>
  </tr>
  <tr>
    <td>

	<div id="empresas"> <?php include("empresa_consulta.php"); ?> </div>
	

</td>
  </tr>
</table>


<p>&nbsp; </p>