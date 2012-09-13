<?php 
	if (!isset($_SESSION)) {
		  session_start();
	}
    
    
	$id_empresa= $_POST['id_empresa'];
	$id_usuario= $_SESSION['id_usuario'];
	
	echo "<br/>"."id_empresa".$id_empresa."<br/>";
	echo "id_usuario".$id_usuario."<br/>";

	include_once("empresa_clase.php");
	
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultar_empresas_x_usuario($id_usuario);  //Consulto todas las empresas y las guardo en $lista empresas

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Procesar Nóminas</title>

</head>
<body>
<br/><br/><br/>
<!-- en esta seccion eligo la empresa a la que se le procesara la nomina -->
<label>
  Empresa:   <select name="id_empresa" id="id_empresa" onchange="javascript:obtener_nominas_empresa()">
  <option value="selecionar" disabled="disabled">Seleccionar:</option>
  <?php while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){ ?>
	<?php if($id_empresa!='' AND $id_empresa==$row_empresas['id_empresa'] ){ ?>
	<option value="<?php echo $row_empresas['id_empresa']; ?>" selected ><?php echo $row_empresas['razon_social']; ?></option>  
	<?php } else{  ?>
	<option value="<?php echo $row_empresas['id_empresa']; ?>"><?php echo $row_empresas['razon_social']; ?></option>  
	<?php } ?> 
	
  <?php }?>
    </select>
</label>
<br/>
<!--style="visibility:collapse"En esta seccion se despliegan las nominas de la empresa con su estado y se eligen las que estan por procesarse -->

<div id="nominas_empresa"   >
<?php if($id_empresa!=''){  ?>
<?php include_once("nominas_empresa.php");  ?>
<?php } else{ ?> 
<?php include_once("nominas_consultar_periodo.php");  ?>
<?php } ?> 

</div>
<br />
<br />
<br />



<div id="nominas_empresa_empleados">

</div>  
</body>
</html>