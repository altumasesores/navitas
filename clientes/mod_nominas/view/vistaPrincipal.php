<script type="text/javascript" src="mod_nominas/libs/js/mod_nominas.js?1.0.0.0"></script>
<?php
 if (!isset($_SESSION))
  {
	  session_start();
  }
	  
if($_SESSION['id_usuario']!=''){
	$id_usuario=$_SESSION['id_usuario'];
	
}elseif($id_usuario!=''){
	
	$id_usuario=$id_usr;
}
	
	
	
		
$parametros=str_replace('"',"'",json_encode(array(
"id_usuario"=>$id_usuario
)));
?>
<script>
transaccionesNomina.consultarNominaVistaInicial(<?php echo $parametros;?>,"periodo","consultarNominasXEmpresa","POST");
</script>
<div id="periodo"></div>
<div id="cuerpoNomina">
</div>
