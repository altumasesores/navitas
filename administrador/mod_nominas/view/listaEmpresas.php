<script>
$("#id_empresa").change(function(){
	var id_empresa=this.value;	
	var parametros={
		"id_empresa":id_empresa
		};
	transaccionesNomina.consultarNominasXEmpresa(parametros,"nominas_empresa","consultarNominasXEmpresa","POST");
	}
);
</script>
<?php 
	if (!isset($_SESSION)) {
		  session_start();
	}
		
	$id_usuario= $_SESSION['id_usuario'];	
	 
  
   while ($row_empresas =$empresas->fetch())
   {
	   if($id_empresa!='' && $id_empresa==$row_empresas['id_empresa'] )
	   {
		   $option="<option value='$row_empresas[id_empresa]' selected >$row_empresas[razon_social]</option>".$option;
		   }else{
			   $option.="<option value='$row_empresas[id_empresa]'>$row_empresas[razon_social]</option>";
			   }
		}
	
	

	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Procesar Nóminas</title>

</head>
<body>
<br />
<!-- en esta seccion eligo la empresa a la que se le procesara la nomina -->
<label>
  Empresa:   <select name="id_empresa" id="id_empresa">
  <option value="selecionar" disabled="disabled">Seleccionar:</option>
  <?php echo $option;?>
    </select>
</label>
<br />



<!--style="visibility:collapse"En esta seccion se despliegan las nominas de la empresa con su estado y se eligen las que estan por procesarse -->

<div id="nominas_empresa" ></div>

<div id="nominas_empresa_empleados"></div>  
</body>
</html>