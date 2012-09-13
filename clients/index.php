<?php
	include_once('../Connections/dbConexion.php'); 

//initialize the session
if (!isset($_SESSION)) {
  session_start();
}


// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  $_SESSION['id_usuario'] = NULL;
  $_SESSION['id_empresa'] = NULL;
  $_SESSION['razon_social'] = NULL;
  $_SESSION['titular'] = NULL;
  
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['id_usuario']);
  unset($_SESSION['razon_social']);
  unset($_SESSION['titular']);
  unset($_SESSION['id_empresa']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}

?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Cliente,Administrador";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php 

	//Obtengo la empresa ligada al usuario
	


$id_usuario= $_SESSION['id_usuario'];
	$con= new dbConexion();
	if($con->conectar()==true){		
			$query_empresas = "SELECT * FROM empresas WHERE id_usuario= $id_usuario ";
			$empresas = mysql_query($query_empresas); 
			
			while ($row_empresas = mysql_fetch_assoc($empresas)){      
              $_SESSION['id_empresa']= $row_empresas['id_empresa']; 
              $_SESSION['razon_social']= $row_empresas['razon_social']; 
			  $_SESSION['titular']= $row_empresas['titular']; 			  
			}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Portal de Atención a Clientes Navitas SA de CV</title>





 <!--CALENDARIO NARANJA-->
 <script type="text/javascript" src="../js/calendarioNaranja/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../js/calendarioNaranja/jquery.ui.core.js"></script>
<script type="text/javascript" src="../js/calendarioNaranja/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../js/calendarioNaranja/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="../js/calendarioNaranja/jquery.ui.datepicker.js"></script>








<link type="text/css" href="../js/calendarioNaranja/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
<link type="text/css" href="../js/calendarioNaranja/demos.css" rel="stylesheet" />



<script type="text/javascript">
	function calendarioNaranja(fecha) {
				var f = '#' + fecha;
				
			 $(function() {
				$(f).datepicker({
					showOn: 'both', //Parametro para que se vea el icono del calendario
					buttonImageOnly: true, //Indicamos si queremos que solo se vea el icono y no el botón
					buttonImage: 'calendar.gif', //Indicamos el icono del botón
					firstDay: 1, //El primer día será el 1
					changeMonth: true, //Si se pueden cambiar los meses
					changeYear: true //Si se pueden cambiar los años
				});
			}); 
	}		
</script>
<!--TERMINA CALENDARIO NARANJA--->	


<!--
 <link href="../css/defaultTheme.css" rel="stylesheet" media="screen" />
<script src="../js/jquery.fixedheadertable.min.js"></script> 
-->



<!--   ocultando campos -->
<!--<script type="text/javascript" src="../admin/ocultando_campos/jquery-1.2.2.pack.js"></script>-->
<script type="text/javascript" src="../admin/ocultando_campos/chili.js"></script>
<script type="text/javascript" src="../admin/ocultando_campos/jquery.cookie.js"></script>
<script type="text/javascript" src="../admin/ocultando_campos/jquery.clickmenu.pack.js"></script>
<script type="text/javascript" src="../admin/ocultando_campos/jquery.clickmenu.js"></script>
<script type="text/javascript" src="../admin/ocultando_campos/jquery.columnmanager.js"></script>
<!-- ocultando campos -->


<!--loader-->
<link href="../libs/css/loader/jquery.loader.css" rel="stylesheet" />
<script src="../libs/js/loader/jquery.loader.js"></script>
<!-- -->

<script type="text/javascript" src="libs/js/funciones_clients.js"></script>




<!--<script type="text/javascript" src="../libs/js/jquery-1.7.js"></script>-->


<script type="text/javascript" src="../ajax/objeto.js" ></script>
<script type="text/javascript" src="../ajax/curp.js" ></script>
<script type="text/javascript" src="../ajax/correos.js" ></script>
<script type="text/javascript" src="../ajax/vinculos.js" ></script>
<script type="text/javascript" src="../ajax/modificar.js" ></script>
<script type="text/javascript" src="../ajax/eliminar.js" ></script>
<script type="text/javascript" src="../ajax/guardar.js" ></script>
<script type="text/javascript" src="../ajax/drag.js" ></script>
<script type="text/javascript" src="../ajax/ocultardiv.js" ></script>
<script type="text/javascript" src="../ajax/formulas_nomina.js" ></script>
<script type="text/javascript" src="../ajax/guardar_nomina.js" ></script>







<link rel="stylesheet" media="screen" href="../css/main.css" type="text/css" />
<script type="text/javascript" src="../js/tooltip.js"></script>






<!--Archivos de Spry -->
<script src="../SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<link href="../SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<link href="../estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="screen" href="styles/vlaCal-v2.1.css" type="text/css" />
<link rel="stylesheet" media="screen" href="styles/vlaCal-v2.1-adobe_cs3.css" type="text/css" />
<link rel="stylesheet" media="screen" href="styles/vlaCal-v2.1-apple_widget.css" type="text/css" />

<link href="../css/tablas.css" rel="stylesheet" type="text/css" />

<!--menu horizontal-->
<link href="../css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
<!--Cierra menu horizontal-->





<!--

<script type="text/javascript" src="jslib/mootools-1.2-core-compressed.js"></script>
<script type="text/javascript" src="jslib/vlaCal-v2.1.js"></script>
<script type="text/javascript" src="jslib/calendar.js"></script>
-->





</head>

<body class="twoColElsLtHdr">

<div id="container">


  <div id="header">
  
  <div id="logo"><img src="../imagenes/logo.png"  alt="Navitas" /></div>
 <!--<div id="usuario">
   <strong>Usuario:&nbsp;&nbsp;<?php echo $_SESSION['MM_Username']; ?>&nbsp;&nbsp;&nbsp;
   |&nbsp;&nbsp;<a href="<?php echo $logoutAction ?>"><img src="../imagenes/salir.png" width="26" height="26" title="Salir del Sistema"/><p align="right" style="font-size:12px">Salir del sistema</p></a></strong></div> -->
	<table align="right">
	<tr><td>Usuario:&nbsp;&nbsp;<?php echo $_SESSION['MM_Username']; ?>&nbsp;&nbsp;
   |&nbsp;&nbsp;<a href="<?php echo $logoutAction ?>" ><img src="../imagenes/salir.png" width="26" height="26" title="Salir del Sistema"/><sub><p align="right" style="font-size:10px">Salir del sistema</p></sub></a><td><tr>
	</table>
<div id="altum" style="float:left;"  ><br/>Desarrollado por: <a href="http://www.altumasesores.com" target="_blank">Altum Asesores</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
  <!-- end #header --></div>
    <div id="menu" >
    <ul class="dropdown dropdown-horizontal" id="nav" name="nav">
	<li><a href="index.php"><img src="../imagenes/Home.png" width="26" height="26"/>Inicio</a></li>
	<li ><a href="javascript:cargarPagina('consultar_nominas.php','mainContent')" ><img src="../imagenes/consultar.png" width="24" height="24"/>Consultar Nóminas</a></li>
    <li><a href="javascript:cargarPagina('nueva_nomina.php','mainContent')" ><img src="../imagenes/nomina.png" width="24" height="24"/>Enviar Nómina</a></li>
    <li><a href="javascript:cargarPagina('empleados.php','mainContent')" ><img src="../imagenes/empleados.png" width="24" height="24"/>Empleados</a></li>
    <li><a href="javascript:cargarPagina('documentos.php','mainContent')"><img src="../imagenes/publicar.png" width="24" height="24"/>Ver Documentos</a></li>
	</ul>
  </div> <!-- fin menu-->

  
  <div id="mainContent">  
    <br/>
    
    <?php include("consultar_nominas.php");?>
    
    <!-- end #mainContent -->
    
    



  </div>    
    
	<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos --><br class="clearfloat" />
   <div id="footer">
    <p>  </p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>

</html>