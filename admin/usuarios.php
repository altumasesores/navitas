<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Usuarios</title>
</head>

<body>

<h1>Usuarios</h1>


<table border="1" cellspacing="0" cellpadding="0" bordercolor="#97B9FF" >
  <tr>
        <td bgcolor="#97B9FF" align="center"><strong>NUEVO USUARIO:</strong></td>
  </tr>
  <tr>
    <td>



  <form id="frmUsuarios" name="frmUsuarios"  action="" >

    <table  border="0" align="left" cellpadding="0" cellspacing="5">
      <tr>

        <td align="left">Usuario</td>
        <td align="left">Password</td>
        <td align="left">Nombre</td>
        <td align="left">E-mail</td>
        <td align="left">Tipo</td>

        </tr>
      <tr>
        <td align="left">
          <input type="hidden" name="id_usuario" id="id_usuario" />
          <input type="text" name="usuario2" id="usuario2" />
        </td>
        <td align="left">        
          <input type="text" name="password" id="password" />
         </td>
        <td align="left"><input type="text" name="nombre" id="nombre" /></td>
        
        <td align="left"><input type="text" name="correo" id="correo" /></td>
          
          
        <td align="left"> 

            <select name="tipo" id="tipo"  >
			<option value="Seleccionar...">Seleccionar...</option>
              <option value="Administrador">Administrador</option>
              <option value="Nominista">Nominista</option>
              <option value="Cliente">Cliente</option>
            </select>
         </td>
          <td>&nbsp; </td>
      <tr>
        <td>&nbsp; </td>
        <td>&nbsp; </td>


        <td align="right"><input type="button" name="guardar" id="guardar" value="Guardar" onclick="guardar_usuario('guardar'); return false" /></td>
        <td>
            <input  type="button" disabled="disabled" name="MM_update" id="modificar" value="Modificar" onclick="guardar_usuario('modificar'); return false"/>

          <input type="reset" name="cancelar" id="cancelar" value="Cancelar" onclick="limpiarUsuario(); return false"/></td>
        </tr>
    </table>
</form>


</td>
  </tr>
</table>

<p>&nbsp;</p>


<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FDCC37" >
  <tr>
    <td align="center" bgcolor="#FDCC37"><strong>LISTA DE USUARIOS:</strong></td>
  </tr>
  <tr>
    <td>
 
	<div id="usuarios">  <?php include("../admin/usuario_consulta.php"); ?> </div>
	

</td>
  </tr>
</table>


</body>
</html>