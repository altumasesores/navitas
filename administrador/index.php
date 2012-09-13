<?php
//initialize the session
/*
es simple:

1.- se loguea el usuario.

2.- se redirige al index de admin.

3.- si resulta que es ciente, se redirige a clinetes, si resulta q es admin, se queda en admin

nota: no encentro una evaluacion para admin concreta y segura.

*/
if (!isset($_SESSION)) {
  session_start();
}
$id_usuario=$_SESSION['id_usuario'];
//error_reporting(0);
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";// [/navitas/admin/index.php][?doLogout=true]
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){	
	/*no existe al entrar un cliente o admin*/
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

//$MM_restrictGoTo = "../clients/index.php"

$MM_restrictGoTo = "../clientes/index.php";

/*

echo $_SESSION['MM_Username'];

echo $_SESSION['MM_UserGroup'] ;

echo $_SESSION['id_usuario'];

altuma

Cliente

27

*/

if (

     !(

	    (isset($_SESSION['MM_Username']))&& (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup']))



											    )

												  ) {   



/*

si es false(true and false=false)=true

*/

  $MM_qsChar = "?";

  $MM_referrer = $_SERVER['PHP_SELF'];//[/navitas/admin/index.php]----//[/navitas/administrador/index.php]

  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";//no existe el simbolo ? fancy url

  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) //no existe la variable

  $MM_referrer .= "?" . $QUERY_STRING;//no se hace

  //$MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);

  $MM_restrictGoTo = $MM_restrictGoTo;

  //al final de todo, cuando se loguea un cliente, pasa por admin/index y es evaluado para ser redireccionado al clients/admin

  header("Location: ". $MM_restrictGoTo); //../clients/index.php

  exit;

}

?>

<?php

/*

BLOQUE DE CODIGO DEDICADO A ADMIN, PARA REDIRECCIONAR DE FORMA ADECUADA AL FRONCONTROLLER DE ADMINISTRADOR

*/

$_SESSION['Frontcontroller']="FrontControllerNominaAdmin";

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml"><head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<meta http-equiv="PRAGMA" content="NO-CACHE" /> 



<meta http-equiv="CACHE-CONTROL" content="NO-STORE, NO-CACHE, MUST-REVALIDATE, POST-CHECK=0, PRE-CHECK=0" /> 



<meta http-equiv="EXPIRES" content="01 Jan 1970 00:00:00 GMT" /> 



<meta http-equiv="Last-Modified" content="01 Jan 1970 00:00:00 GMT" /> 



<meta http-equiv="If-Modified-Since" content="01 Jan 1970 00:00:00 GMT" /> 



<title>Portal de Atención a Clientes Navitas SA de CV</title>







<?php

/*

<!--- encabezado-->

<link href="../estilos.css" rel="stylesheet" type="text/css" />

<!-- tablas-->

<link href="../css/tablas.css" rel="stylesheet" type="text/css" />

<!--menu horizontal-->

<link href="../css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />

<link href="../css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

<!--Cierra menu horizontal-->



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

*/

?>







<!---------------------------------------------------------------------------------------------------------------------->



<script type="text/javascript" src="../libs/js/jquery/jquery-1.7.js" ></script>



<?php //librerias del filemanager ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>







        

		



		<!-- elFinder CSS (REQUIRED) -->

		<link rel="stylesheet" type="text/css" media="screen" href="../FileManager/css/elfinder.min.css">

		<link rel="stylesheet" type="text/css" media="screen" href="../FileManager/css/theme.css">



		<!-- elFinder JS (REQUIRED) -->

		<script type="text/javascript" src="../FileManager/js/elfinder.min.js"></script>



		<!-- elFinder translation (OPTIONAL) -->

		<script type="text/javascript" src="../FileManager/js/i18n/elfinder.es.js"></script>

<?php //librerias del filemanager ?>



<script type="text/javascript" src="../libs/js/jquery.json/jquery.json-1.3.min.js"></script>

<script type="text/javascript" src="../libs/js/jquery.serializeObject/jquery.serializeObject.js"></script>







<!-- tooltip -->



<link rel="stylesheet" media="screen" href="../libs/css/tooltip/main.css" type="text/css" />



<script type="text/javascript" src="../libs/js/tooltip/tooltip.js"></script>



<!-- -->











<!--   ocultando campos -->



<script type="text/javascript" src="../libs/js/ocultando_campos/chili.js"></script>



<script type="text/javascript" src="../libs/js/ocultando_campos/jquery.cookie.js"></script>



<script type="text/javascript" src="../libs/js/ocultando_campos/jquery.clickmenu.pack.js"></script>



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











<!-- jAlert-->



<script type="text/javascript" src="../libs/js/jquery.alerts/jquery.alerts.js"></script>



<link href="../libs/css/jquery.alerts/jquery.alerts.css" rel="stylesheet" type="text/css" />



<!-- -->







<!-- tablas paginadas -->



<script type="text/javascript" src="../libs/js/tablas/script.js"></script>



<link href="../libs/js/tablas/style.css" rel="stylesheet" type="text/css" />



<!-- -->







<!-- funciones de sistema-->



<script type="text/javascript" src="../libs/js/sistema/transaccionesPostGet.class.js?1.0.0.0"></script>



<script type="text/javascript" src="../libs/js/sistema/calculosNomina.class.js"></script>



<!-- -->







<!-- funciones de grupo Admin-->



<script type="text/javascript" src="libs/js/sistemaGrupoAdmin/FuncionesDeGrupoAdmin.js"></script>







<!--menu horizontal-->



<link href="../libs/css/menu_horizontal/dropdown.css" media="screen"	rel="stylesheet" type="text/css" />



<link href="../libs/css/menu_horizontal/themes/flickr.com/default.ultimate.css"	media="screen" rel="stylesheet" type="text/css" />



<!--Cierra menu horizontal-->







<!-- estilo complementario al menu horizontal-->



<link href="../libs/css/estilosGenerales/estilos.css" rel="stylesheet" type="text/css" />



<!-- estilo complementario al menu horizontal-->







<!-- tablas css, anteriores al remodelado de las tablas con header, es el css de las tablas de las nominas en amarillo y azul-->



<link href="../css/tablas.css" rel="stylesheet" type="text/css" />















<script>



   



	//se crea una nueva instancia de la clase calculos



var calculosClientes=new calculosNomina("NominaAdmin");



/*



Aqui se setea el grupo al que pertenece,



por un error de diseño de clase, ya que esto dedbió hacerse al momento de que la clase calculos



hereda de la clase de transacciones



*/



calculosClientes.grupo_usuario="administrador";



//se seta el modulo al que corresponde



calculosClientes.setModulo("nominas");



	



</script>











<!--CALENDARIO NARANJA OBSOLETO-->











<script type="text/javascript" src="../admin/mod_calculos/libs/js/funciones_mvc.js"></script>



<script type="text/javascript" src="../admin/libs/js/funciones_admin.js" ></script>



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



				$(f).datepicker({



					showOn: 'both', //Parametro para que se vea el icono del calendario



					buttonImageOnly: true, //Indicamos si queremos que solo se vea el icono y no el botón



					buttonImage: '../admin/calendar.gif', //Indicamos el icono del botón



					firstDay: 1, //El primer día será el 1



					changeMonth: true, //Si se pueden cambiar los meses



					changeYear: true //Si se pueden cambiar los años



				});



			}); 



	}		



</script>



<!---->











<!---------------------------------------------------------------------------------------------------------------------->











</head>







<body class="twoColElsLtHdr">



<div id="container">



  <div id="header">



  <div id="logo"><img src="../imagenes/sistema/logo_web.jpg" alt="Navitas" width="300" height="80" /></div>



  <!--<div id="usuario" align="right" >



   <strong>Usuario:&nbsp;&nbsp;<?php //echo $_SESSION['MM_Username']; ?>&nbsp;&nbsp;



   |&nbsp;&nbsp;<a href="<?php //echo $logoutAction ?>" ><img src="../imagenes/salir.png" width="26" height="26" title="Salir del Sistema"/><sub><p align="right" style="font-size:10px">Salir del sistema</p></sub></a></strong>



   </div> -->



	<table align="right">



	<tr><td><FONT SIZE="2">Usuario:&nbsp;&nbsp;<?php echo $_SESSION['MM_Username']; ?>&nbsp;&nbsp;



   |&nbsp;&nbsp;</font><td><tr>



	



	</table>



<div id="altum" style="float:right;"  ><br/>Desarrollado por: <a href="http://www.altumasesores.com" target="_blank"><img src="../imagenes/sistema/FIRMAALTUMASESORES.gif" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>







  



  <!-- end #header --></div>



  <div id="menu" align="right" >



    <div align="right">



      <ul class="dropdown dropdown-horizontal" id="nav" name="nav">



        <li><a href="index.php"><img src="../imagenes/Home.png" width="26" height="26"/>Inicio</a></li>



        <li>



        <a href="javascript:$('#cuerpoNomina').html('');cargarPagina('../admin/empresas.php','mainContent')">



        <img src="../imagenes/empresas.png" width="26" height="26"/>



        Empresas



        </a>



        </li>



<!--------------------------------------------------------------------------------------------------------->



        <li>



       



		



        <a href="javascript:$('#mainContent').html('');transaccionesNomina.consultarNominaVistaInicial({'id_usuario':<?php echo $id_usuario?>},'cuerpoNomina','consultarEmpresasXUsuario','POST');">



        <img src="../imagenes/nomina.png" width="24" height="24"/>Procesar Nóminas



        </a>



        </li>



<!--------------------------------------------------------------------------------------------------------->        



        



        <li>



        <a href="javascript:$('#cuerpoNomina').html('');transaccionesNomina.cargarUPLOAD();">



        <img src="../imagenes/publicar.png" width="24" height="24"/>



        Publicar Documentos



        </a>       

        



        </li>



        

       

        

        



        <!--<li><a href="javascript:cargarPagina('reportesMenu.php','mainContent')"><img src="../imagenes/reportes.png" width="24" height="24"/>Reportes</a></li>-->



		<li><span class="dir"><IMG SRC="../imagenes/reportes.png" WIDTH="25px" HEIGHT="25" ALT="Respaldo de la Base de Datos"  />Reportes</span>



		<ul>



        	<li align="left" ><a href="javascript:$('#cuerpoNomina').html('');cargarPagina('../admin/reportes.php','mainContent');"><img src="../imagenes/reporte1.png" width="26" height="26"/>Reporte 1</a></li>



			<li align="left" ><a href="javascript:$('#cuerpoNomina').html('');cargarPagina('../admin/reportes2.php','mainContent');"><img src="../imagenes/reporte2.png" width="24" height="24"/>Reporte 2</a></li>



			<li align="left" ><a href="javascript:$('#cuerpoNomina').html('');cargarPagina('../admin/empleados_empresas_consulta.php','mainContent');"><img src="../imagenes/reporteEmpleados.png" width="24" height="24"/>Reporte Empleados</a></li>



		</ul>



		</li>



        <?php if( $_SESSION['MM_UserGroup']=="Administrador"){  ?>



        <li><a href="javascript:$('#cuerpoNomina').html('');cargarPagina('../admin/usuarios.php','mainContent')"><img src="../imagenes/usuario.png" width="24" height="24"/>Usuarios</a> </li>



		



        <?php }?>



		<li><span class="dir"><IMG SRC="../imagenes/RespaldoBD.png" WIDTH="25px" HEIGHT="25" ALT="Respaldo de la Base de Datos"  />Base de datos</span>



		<ul>



        	<li><a href="javascript:respaldarBD();transaccionesNomina.consultarNominaVistaInicial({'id_usuario':<?php echo $id_usuario?>},'cuerpoNomina','consultarEmpresasXUsuario','POST');">



            <img src="../imagenes/RespaldoBD.png" width="26" height="26"/>



            Respaldo



            </a>



            </li>



			<!--<li><a href="javascript:alert('pendiente de hacer')"><img src="../imagenes/RestauracionBD.png" width="24" height="24"/>Restauración</a></li>-->



		</ul>



		</li>



        



        <li><a href="<?php echo $logoutAction ?>" ><img src="../imagenes/salir.png" width="26" height="26" title="Salir del Sistema"/>Salir del sistema</a></li>



        



      </ul>



      



      



    </div>



  </div> <!-- fin menu-->



















  <div id="mainContent">  



	<?php //include('nominas.php'); ?>  



 



	<!-- end #mainContent --></div> 



    



    <div id="cuerpo">



    <?php



require_once("../AnteFrontController.php");



?>



    </div>   



    



	<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos --><br class="clearfloat" />



   <div id="footer">



    <p> </p>



  <!-- end #footer --></div>



<!-- end #container --></div>



</body>







</html>