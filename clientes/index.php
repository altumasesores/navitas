<?php

//initialize the session

if (!isset($_SESSION)) {

	session_start();

}

error_reporting(0);

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

	}}

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


	/*
	BLOQUE DE CODIGO DEDICADO A ADMIN, PARA REDIRECCIONAR DE FORMA ADECUADA AL FRONCONTROLLER DE ADMINISTRADOR
	*/

	$_SESSION['Frontcontroller']="FrontControllerNomina";

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="PRAGMA" content="NO-CACHE" /> 
<meta http-equiv="CACHE-CONTROL" content="NO-STORE, NO-CACHE, MUST-REVALIDATE, POST-CHECK=0, PRE-CHECK=0" /> 
<meta http-equiv="EXPIRES" content="01 Jan 1970 00:00:00 GMT" /> 
<meta http-equiv="Last-Modified" content="01 Jan 1970 00:00:00 GMT" /> 
<meta http-equiv="If-Modified-Since" content="01 Jan 1970 00:00:00 GMT" /> 

<title>Portal de Atenci&oacute;n a Clientes Navitas SA de CV</title>

<!--*****REESTRUCTURACION DE ARCHIVOS***-->

<script type="text/javascript" src="../libs/js/jquery/jquery-1.7.js"></script>

<!-- librerias del filemanager-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="../FileManager/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="../FileManager/css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="../FileManager/js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="../FileManager/js/i18n/elfinder.es.js"></script>

<!-- librerias del filemanager-->


		<script type="text/javascript" src="../libs/js/jquery.json/jquery.json-1.3.min.js"></script>
        
        <script type="text/javascript" src="../libs/js/jquery.serializeObject/jquery.serializeObject.js"></script>

<!-- tooltip -->

        <link rel="stylesheet" media="screen" href="../libs/css/tooltip/main.css" type="text/css" />
        <script type="text/javascript" src="../libs/js/tooltip/tooltip.js"></script>
<!-- -->

<!--   ocultando campos -->

		<script type="text/javascript" src="../libs/js/ocultando_campos/jquery.cookie.js"></script>
        <script type="text/javascript" src="../libs/js/ocultando_campos/jquery.clickmenu.js"></script>
        <script type="text/javascript" src="../libs/js/ocultando_campos/jquery.columnmanager.js"></script>

<!-- ocultando campos -->

<!--TABLA HEADER	-->
		<link rel="stylesheet" type="text/css" href="../libs/jquery-ui-1.8.4.custom.css"/>
        <link rel="stylesheet" type="text/css" href="../libs/base.css"/>
        <script type="text/javascript" src="../libs/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../libs/codehighlighter.js"></script>	
		<script type="text/javascript" src="../libs/javascript.js"></script>			
		<script type="text/javascript" src="../libs/jquery.fixheadertable.min.js"></script>	
<!---->

<!--Validaciones-->
        <link rel="stylesheet" href="../libs/css/validationEngine/validationEngine.jquery.css" type="text/css"/>
        <script src="../libs/js/validationEngine/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
        <script src="../libs/js/validationEngine/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!--->

<!--loader-->
        <link href="../libs/css/loader/jquery.loader.css" rel="stylesheet" />
        <script src="../libs/js/loader/jquery.loader.js"></script>
<!-- -->

<!-- ventana MODAL -->

        <link href="../libs/css/jquery.simplemodal/jquery.simplemodal.css" rel="stylesheet" />
        <script src="../libs/js/jquery.simplemodal/jquery.simplemodal.js"></script>
<!-- -->

<!-- funciones de sistema-->
		<script type="text/javascript" src="../libs/js/sistema/transaccionesPostGet.class.js?1.0.0.0"></script>
        <script type="text/javascript" src="../libs/js/sistema/calculosNomina.class.js"></script>
<!-- -->

<!-- jAlert-->
		<script type="text/javascript" src="../libs/js/jquery.alerts/jquery.alerts.js"></script>
        <link href="../libs/css/jquery.alerts/jquery.alerts.css" rel="stylesheet" type="text/css" />
<!-- -->
<!-- tablas paginadas -->
		<script type="text/javascript" src="../libs/js/tablas/script.js"></script>
        <link href="../libs/js/tablas/style.css" rel="stylesheet" type="text/css" />
<!-- -->
<!-- funciones de grupo Clientes-->
		<script type="text/javascript" src="libs/js/sistemaGrupoClientes/FuncionesDeGrupoClientes.js"></script>
        
<!--menu horizontal-->
        <link href="../libs/css/menu_horizontal/dropdown.css" media="screen"	rel="stylesheet" type="text/css" />
        <link href="../libs/css/menu_horizontal/themes/flickr.com/default.ultimate.css"	media="screen" rel="stylesheet" type="text/css" />
<!--Cierra menu horizontal-->
<!-- estilo complementario al menu horizontal-->
		<link href="../libs/css/estilosGenerales/estilos.css" rel="stylesheet" type="text/css" />
<!-- estilo complementario al menu horizontal-->

<script>

	//se crea una nueva instancia de la clase calculos

	var calculosClientes=new calculosNomina("Nomina");

	/*
	Aqui se setea el grupo al que pertenece, por un error de diseño de clase, ya que esto dedbió hacerse al momento de que la clase calculos
	hereda de la clase de transacciones
	*/

	calculosClientes.grupo_usuario="clientes";
	
	//se seta el modulo al que corresponde
	
	calculosClientes.setModulo("nominas");
</script>


		<script type="text/javascript"	src="../js/calendarioNaranja/jquery.ui.core.js"></script>
        <script type="text/javascript"	src="../js/calendarioNaranja/jquery.ui.widget.js"></script>
        <script type="text/javascript"	src="../js/calendarioNaranja/jquery.ui.datepicker-es.js"></script>
        <script type="text/javascript"	src="../js/calendarioNaranja/jquery.ui.datepicker.js"></script>
        <link type="text/css"	href="../js/calendarioNaranja/jquery-ui-1.8.4.custom.css"	rel="stylesheet" />
        <link type="text/css" href="../js/calendarioNaranja/demos.css"	rel="stylesheet" />

<script type="text/javascript">

	function calendarioNaranja(fecha) {
				var f = '#' + fecha;

			 $(function() {
				$(f).datepicker({

					showOn: 'both', //Parametro para que se vea el icono del calendario
					buttonImageOnly: true, //Indicamos si queremos que solo se vea el icono y no el botón
					buttonImage: '../clients/calendar.gif', //Indicamos el icono del botón
					firstDay: 1, //El primer día será el 1
					changeMonth: true, //Si se pueden cambiar los meses
					changeYear: true //Si se pueden cambiar los años

				});
			}); 
	}		

</script>


<!--TERMINA CALENDARIO NARANJA--->

		<script type="text/javascript" src="../clients/libs/js/funciones_clients.js"></script>
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

<!--*******REESTRUCTURACION DE ARCHIVOS*****-->

</head>

<body class="twoColElsLtHdr">

	<div id="container">

		<div id="header">

			<div id="logo">
				<img src="../imagenes/sistema/logo_web.jpg" alt="Navitas" width="300" height="80" />
			</div>

			<!--<div id="usuario">

   <strong>Usuario:&nbsp;&nbsp;<?php echo $_SESSION['MM_Username']; ?>&nbsp;&nbsp;&nbsp;

   |&nbsp;&nbsp;<a href="<?php echo $logoutAction ?>"><img src="../imagenes/salir.png" width="26" height="26" title="Salir del Sistema"/><p align="right" style="font-size:12px">Salir del sistema</p></a></strong></div> -->

			<table align="right">
				<tr>

					<td>Usuario:&nbsp;&nbsp;<?php echo $_SESSION['MM_Username']; ?>&nbsp;&nbsp; |&nbsp;&nbsp;<a href="<?php echo $logoutAction ?>">
                    <img src="../imagenes/salir.png" width="26" height="26"	title="Salir del Sistema" /><sub><p align="right" style="font-size: 10px">                         Salir del sistema</p> </sub> </a>
					<td>
                 <tr>
			</table>


			<div id="altum" style="float: right;"><br />Desarrollado por: <a href="http://www.altumasesores.com" target="_blank">
            <img src="../imagenes/sistema/FIRMAALTUMASESORES.gif" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>

			<!-- end #header -->

		</div>

		<div id="menu">

			<ul class="dropdown dropdown-horizontal" id="nav" name="nav">
				<li><a href="index.php"><img src="../imagenes/Home.png" width="26" height="26" />Inicio</a></li>

				<li><?php $parametros=str_replace('"',"'",json_encode(array("id_usuario"=>$_SESSION['id_usuario']))); ?>
							<a href="javascript:$('#mainContent').html('');$('#cuerpoNomina').html('');$('#periodo').html('');transaccionesNomina.consultarNominaVistaInicial(
							<?php echo $parametros;?>,'cuerpoNomina','consultarNominasXEmpresa','POST');"><img	src="../imagenes/consultar.png" width="24" height="24" />Consultar Nóminas</a></li>


				<li><a	href="javascript:$('#mainContent').html('');$('#cuerpoNomina').html('');transaccionesNomina.seleccionarPeriodo(<?php echo $parametros;?>,'periodo','seleccionarPeriodo','POST');"><img src="../imagenes/nomina.png" width="24" height="24" />Enviar Nómina</a></li>


				<li><a href="javascript:$('#cuerpoNomina').html('');$('#periodo').html('');cargarPagina('../clients/empleados.php','mainContent');"><img	                      src="../imagenes/empleados.png" width="24" height="24" />Empleados</a></li>

				<li><a	href="javascript:$('#cuerpoNomina').html('');$('#periodo').html('');transaccionesNomina.cargarUPLOAD();"><img	
                			src="../imagenes/publicar.png" width="24" height="24" />Ver	Documentos</a></li>

			</ul>
		</div>

		<!-- fin menu-->

<div id="mainContent">

		<br /></div>

        <div id="cuerpo">
			<?php
					require_once("../AnteFrontController.php");
			?> 

</div>

		<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos -->

		<br class="clearfloat" />

		<div id="footer">
			<p></p>
			<!-- end #footer -->
		</div>
		<!-- end #container -->
 
	</div>

</body>
</html>