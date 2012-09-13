<?php 

	if (!isset($_SESSION)) {
		  session_start();
	}

	$id_usuario= $_SESSION['id_usuario'];
	include_once("empresa_clase.php");
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultar_empresas_x_usuario($id_usuario); //Consulto todas las empresas y las guardo en $lista empresas
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documentos</title>

</head>

<body>

<h1>Publicaciones</h1>










<table border="1" cellspacing="0" cellpadding="0"  >
  <tr>
    <td bgcolor="#97B9FF" align="center"><strong>PUBLICAR DOCUMENTO:</strong></td>
  </tr>
  <tr>
    <td>



  <form  action="../admin/publicaciones_enviar.php" target="frame_enviar" method="post" enctype="multipart/form-data" name="formFTP" id="formFTP" >

    <table  border="0" align="left" cellpadding="0" cellspacing="5">
      <tr>

        <td align="left">Disponible para la empresa(s):</td>
        <td align="left">Descripci&oacute;n</td>
        <td align="left">Buscar:</td>

        </tr>
      <tr>
        <td align="left" valign="top">
          <select name="empresas[]" size="5" multiple="multiple" >
            <option value="todas">Todas............................................</option>
            
        <?php while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){  ?>
            <option value="<?php echo $row_empresas['id_empresa']; ?>"><?php echo $row_empresas['razon_social']; ?></option>
		<?php } ?>
          </select>
        </label>
          
        </td>
        <td align="left" valign="top">
        <input type="text" name="descripcion" id="descripcion" />  
        </td>
        <td align="left" valign="top">
         <input type="file" name="archivo" id="archivo" onchange="return cargar(this)" />
         
         <input type="hidden" name="id_documento" id="id_documento" />
         </br>
         <span id="mensaje"></span>
		</td>
          
          
      <tr>
        <td>&nbsp; </td>
                <td>&nbsp; </td>



        <td align="right">
        
      
       <input type="button" name="guardar" id="guardar" value="Guardar" onclick="enviar_documento(); return false" /> 
        
  
          <input type="reset" name="cancelar" id="cancelar" value="Cancelar" onclick="limpiar_archivo(); return false"/></td>

        </tr>
    </table>
</form>


</td>
  </tr>
</table>

<p>&nbsp;</p>

<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FDCC37" >
  <tr>
    <td bgcolor="#FDCC37" align="center"><strong>LISTA DE PUBLICACIONES</strong></td>
  </tr>
  <tr>
    <td>
	<div id="publicaciones">  <?php include("../admin/publicaciones_consulta.php"); //style="visibility:hidden" ?>   
	

 </div>
	</td>
  </tr>
</table>
<iframe name="frame_enviar" ></iframe>
</body>
</html>