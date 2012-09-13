<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";// [/navitas/admin/index.php][?doLogout=true]



if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
	/*no existe al entrar un cliente*/
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
	/*no existen al entrar un cliente,obvio levi,esto es para un logout...chales!!!*/
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }

}
?>
<?php
//CODIGO DE ACCESO

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Administrador,Nominista";//solo se permiten estos 2 tipos
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
/*
usuario altuma pass=****
$strUsers=""
$strGroups=Administrador,Nominista
$UserName=altuma
$UserGroup=Cliente
*/


  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); //siempre se recibe vacio,por el momento
    $arrGroups = Explode(",", $strGroups); //[Administrador][Nominista]
    if (in_array($UserName, $arrUsers)) { 	
	/*si existe en el arreglo $arrUsers(vacio) el $UserName(altuma)
	se valida como aceeso permitido
	pero como siempre se recibe vacio el arreglo,se mantiene invalido el acceso
	*/	
      $isValid = true; 
    } 
	
	
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
	/*si existe en el arreglo $arrGroups(Administrador,Nominista) el $UserGroup(Cliente)..para el caso de un cliente logueado
	se valida como aceeso denegado, el usuario cliente no pertenece al grupo que accede al admin
	se mantiene el ACCESO INVALIDO
	*/	
      $isValid = true; 
    } 
	
    if (($strUsers == "") && false) {
		//si es vacio y falso es valido, pero al ser true and and, se invalida
		echo "es valido"; 
      $isValid = true; 
    }
	
	 
  } 
  return $isValid; //para un login cliente es false, para un login admin es true
}//fin function

//$MM_restrictGoTo = "../clients/index.php";
$MM_restrictGoTo = "../clients2/index.php";
/*
echo $_SESSION['MM_Username'];
echo $_SESSION['MM_UserGroup'] ;
echo $_SESSION['id_usuario'];
altuma
Cliente
27
*/
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
/*
si es false(true and false=false)=true
*/
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];//[/navitas/admin/index.php]
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";//no existe el simbolo ?
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) //no existe la variable
  $MM_referrer .= "?" . $QUERY_STRING;//no se hace
  //$MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  $MM_restrictGoTo = $MM_restrictGoTo;
  //al final de todo, cuando se loguea un cliente, pasa por admin/index y es evaluado para ser redireccionado al clients/admin
  header("Location: ". $MM_restrictGoTo); //../clients/index.php
  exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Portal de Atención a Clientes Navitas SA de CV</title>
<!--- encabezado-->
<link href="../estilos.css" rel="stylesheet" type="text/css" />
<!-- tablas-->
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<!--menu horizontal-->
<link href="../css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
<!--Cierra menu horizontal-->

<script type="text/javascript" src="../libs/js/jquery/jquery-1.7.js" ></script>

<script type="text/javascript" src="../js/calendarioNaranja/jquery.ui.core.js"></script>
<script type="text/javascript" src="../js/calendarioNaranja/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../js/calendarioNaranja/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="../js/calendarioNaranja/jquery.ui.datepicker.js"></script>

<link type="text/css" href="../js/calendarioNaranja/demos.css" rel="stylesheet" />
<link type="text/css" href="../js/calendarioNaranja/jquery-ui-1.8.4.custom.css" rel="stylesheet" />

<script type="text/javascript">
	function calendarioNaranja(fecha) {
				var f = '#' + fecha;
				
			 $(function() {
				$(f).datepicker();
				/*$(f).datepicker({
					showOn: 'both', //Parametro para que se vea el icono del calendario
					buttonImageOnly: true, //Indicamos si queremos que solo se vea el icono y no el botón
					buttonImage: 'calendar.gif', //Indicamos el icono del botón
					firstDay: 1, //El primer día será el 1
					changeMonth: true, //Si se pueden cambiar los meses
					changeYear: true //Si se pueden cambiar los años
				});*/
			}); 
	}		
</script>
    

<!--loader-->
<link href="../libs/css/loader/jquery.loader.css" rel="stylesheet" />
<script src="../libs/js/loader/jquery.loader.js"></script>
<!-- -->
<script type="text/javascript" src="../admin/mod_calculos/libs/js/funciones_mvc.js"></script>
<script type="text/javascript" src="libs/js/funciones_admin.js" ></script>
<script type="text/javascript" src="../ajax/facturacion.js" ></script>
<script type="text/javascript" src="../ajax/curp.js" ></script>
<script type="text/javascript" src="../ajax/objeto.js" ></script>
<script type="text/javascript" src="../ajax/vinculos.js" ></script>
<script type="text/javascript" src="../ajax/modificar.js" ></script>
<script type="text/javascript" src="../ajax/eliminar.js" ></script>
<script type="text/javascript" src="../ajax/guardar.js" ></script>
<script type="text/javascript" src="../ajax/correos.js" ></script>
<script type="text/javascript" src="../ajax/ftp.js" ></script>
<script type="text/javascript" src="../ajax/guardar_nomina.js" ></script>
<script type="text/javascript" src="../ajax/formulas_nomina.js" ></script>
<script type="text/javascript" src="../ajax/drag.js" ></script>
<script type="text/javascript" src="../ajax/ocultardiv.js" ></script>


<!--   ocultando campos -->
<script type="text/javascript" src="ocultando_campos/chili.js"></script>
<script type="text/javascript" src="ocultando_campos/jquery.cookie.js"></script>
<script type="text/javascript" src="ocultando_campos/jquery.clickmenu.pack.js"></script>
<script type="text/javascript" src="ocultando_campos/jquery.clickmenu.js"></script>
<script type="text/javascript" src="ocultando_campos/jquery.columnmanager.js"></script>
<!-- ocultando campos -->


<!-- tooltip -->
<link rel="stylesheet" media="screen" href="../css/main.css" type="text/css" />
<script type="text/javascript" src="../js/tooltip.js"></script>
<!-- -->




</head>

<body class="twoColElsLtHdr">
<div id="container">
  <div id="header">
  <div id="logo"><img src="../imagenes/logo.png"  alt="Navitas" /></div>
  <!--<div id="usuario" align="right" >
   <strong>Usuario:&nbsp;&nbsp;<?php echo $_SESSION['MM_Username']; ?>&nbsp;&nbsp;
   |&nbsp;&nbsp;<a href="<?php echo $logoutAction ?>" ><img src="../imagenes/salir.png" width="26" height="26" title="Salir del Sistema"/><sub><p align="right" style="font-size:10px">Salir del sistema</p></sub></a></strong>
   </div> -->
	<table align="right">
	<tr><td><FONT SIZE="2">Usuario:&nbsp;&nbsp;<?php echo $_SESSION['MM_Username']; ?>&nbsp;&nbsp;
   |&nbsp;&nbsp;</font><td><tr>
	
	</table>
<div id="altum" style="float:left;"  ><br/>Desarrollado por: <a href="http://www.altumasesores.com" target="_blank">Altum Asesores</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

  
  <!-- end #header --></div>
  <div id="menu" align="right" >
    <div align="right">
      <ul class="dropdown dropdown-horizontal" id="nav" name="nav">
        <li><a href="index.php"><img src="../imagenes/Home.png" width="26" height="26"/>Inicio</a></li>
        <li><a href="javascript:cargarPagina('empresas.php','mainContent')"><img src="../imagenes/empresas.png" width="26" height="26"/>Empresas</a></li>
<!--------------------------------------------------------------------------------------------------------->
        <li>
        <a href="javascript:cargarPagina('nominas.php','mainContent')">
        <img src="../imagenes/nomina.png" width="24" height="24"/>Procesar Nóminas
        </a>
        </li>
<!--------------------------------------------------------------------------------------------------------->        
        
        <li><a href="javascript:cargarPagina('publicaciones.php','mainContent')"><img src="../imagenes/publicar.png" width="24" height="24"/>Publicar Documentos</a></li>
        <!--<li><a href="javascript:cargarPagina('reportesMenu.php','mainContent')"><img src="../imagenes/reportes.png" width="24" height="24"/>Reportes</a></li>-->
		<li><span class="dir"><IMG SRC="../imagenes/reportes.png" WIDTH="25px" HEIGHT="25" ALT="Respaldo de la Base de Datos"  />Reportes</span>
		<ul>
        	<li align="left" ><a href="javascript:cargarPagina('reportes.php','mainContent');"><img src="../imagenes/reporte1.png" width="26" height="26"/>Reporte 1</a></li>
			<li align="left" ><a href="javascript:cargarPagina('reportes2.php','mainContent');"><img src="../imagenes/reporte2.png" width="24" height="24"/>Reporte 2</a></li>
			<li align="left" ><a href="javascript:cargarPagina('empleados_empresas_consulta.php','mainContent');"><img src="../imagenes/reporteEmpleados.png" width="24" height="24"/>Reporte Empleados</a></li>
		</ul>
		</li>
        <?php if( $_SESSION['MM_UserGroup']=="Administrador"){  ?>
        <li><a href="javascript:cargarPagina('usuarios.php','mainContent')"><img src="../imagenes/usuario.png" width="24" height="24"/>Usuarios</a> </li>
		
        <?php }?>
		<li><span class="dir"><IMG SRC="../imagenes/RespaldoBD.png" WIDTH="25px" HEIGHT="25" ALT="Respaldo de la Base de Datos"  />Base de datos</span>
		<ul>
        	<li><a href="javascript:respaldarBD();cargarPagina('nominas.php','mainContent');"><img src="../imagenes/RespaldoBD.png" width="26" height="26"/>Respaldo</a></li>
			<!--<li><a href="javascript:alert('pendiente de hacer')"><img src="../imagenes/RestauracionBD.png" width="24" height="24"/>Restauración</a></li>-->
		</ul>
		</li>
        
        <li><a href="<?php echo $logoutAction ?>" ><img src="../imagenes/salir.png" width="26" height="26" title="Salir del Sistema"/>Salir del sistema</a></li>
        
      </ul>
      
      
    </div>
  </div> <!-- fin menu-->




  <div id="mainContent">  
	<?php include('nominas.php'); ?>  
 
	<!-- end #mainContent --></div>    
    
	<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos --><br class="clearfloat" />
   <div id="footer">
    <p> </p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>

</html>