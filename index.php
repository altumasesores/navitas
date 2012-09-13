<?php require_once('Connections/ascon.php');

if (!function_exists("GetSQLValueString")) {

	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")	{

		if (PHP_VERSION < 6) {

			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

		}

		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

		switch ($theType) {

			case "text":

				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

				break;

			case "long":

			case "int":

				$theValue = ($theValue != "") ? intval($theValue) : "NULL";

				break;

			case "double":

				$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";

				break;

			case "date":

				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

				break;

			case "defined":

				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;

				break;

		}

		return $theValue;

	}

}
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
	session_start();
	}

$loginFormAction = $_SERVER['PHP_SELF'];//---> /navitas/index.php

//$_GET['accescheck'] es  /navitas/clients/index.php al inicio del sistema

if (isset($_GET['accesscheck'])) {

	//al inicio del index de navitas no existe esta varible

	$_SESSION['PrevUrl'] = $_GET['accesscheck'];

}

if (isset($_POST['usuario'])) {

	$loginUsername=$_POST['usuario'];

	$password=$_POST['password'];

	$MM_fldUserAuthorization = "tipo";

	$MM_redirectLoginSuccess = "administrador/index.php";

	$MM_redirectLoginFailed = "index.php";

	$MM_redirecttoReferrer = false;

	mysql_select_db($database_navitas, $navitas);

	$LoginRS__query=sprintf("SELECT id_usuario, usuario, password, tipo FROM usuarios WHERE usuario=%s AND password=%s",

	GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text"));

	$LoginRS = mysql_query($LoginRS__query, $navitas) or die(mysql_error());

	$loginFoundUser = mysql_num_rows($LoginRS);

	if ($loginFoundUser) {

		$loginStrGroup  = mysql_result($LoginRS,0,'tipo');

		$id_usuario  = mysql_result($LoginRS,0,'id_usuario');

		//declare two session variables and assign them

		$_SESSION['MM_Username'] = $loginUsername;

		$_SESSION['MM_UserGroup'] = $loginStrGroup;

		$_SESSION['id_usuario']=    $id_usuario;

		//$_SESSION['PrevUrl'= /navitas/clients/index.php

		//$MM_redirectLoginSuccess---> admin/index.php  o  clients/index.php ;

		//$MM_redirectLoginFailed ---> index.php

		if (isset($_SESSION['PrevUrl']) && false) {//esto al incion del login nunca entra

			//al inicio del index de navitas no existe esta varible

			//parece q esto nunca entra al inicio del login

			$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];

		}

		/*por lo que el codigo realiza, al momento del login,

		no importa si se loguea un admin o un cliente,automaticamente desde que exista el

		login en la bd se redirecciona al index del admin

		*/

		header("Location: " . $MM_redirectLoginSuccess);//redireccionamiento directo al index de admin

	}else {//so no encuentra ningun usuario con el login proporcionado

		header("Location: ". $MM_redirectLoginFailed);	//redirecciona al index del root

	}

}//if (isset($_POST['usuario']))

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<meta http-equiv="PRAGMA" content="NO-CACHE" />



<meta http-equiv="CACHE-CONTROL"

	content="NO-STORE, NO-CACHE, MUST-REVALIDATE, POST-CHECK=0, PRE-CHECK=0" />



<meta http-equiv="EXPIRES" content="01 Jan 1970 00:00:00 GMT" />



<meta http-equiv="Last-Modified" content="01 Jan 1970 00:00:00 GMT" />



<meta http-equiv="If-Modified-Since" content="01 Jan 1970 00:00:00 GMT" />



<title>Portal de Atención a Clientes Navitas SA de CV</title>



<link href="estilos.css" rel="stylesheet" type="text/css" />



<script type="text/javascript" src="libs/js/jquery/jquery-1.7.js"></script>







<!--loader-->



<link href="libs/css/loader/jquery.loader.css" rel="stylesheet" />



<script src="libs/js/loader/jquery.loader.js"></script>



<!-- -->























<script>



$(document).ready(function(e) {



	



				/*



				$('#enviar').click(function(){



						



				 	$.loader({



						className:"blue-with-image",



						content:""



						});



				



				});



		*/



		



	



    



});



</script>



<!--<script type="text/javascript" src="js/CalendarInput.js" ></script>-->



<!--<link href="css/tablas.css" rel="stylesheet" type="text/css" />-->



</head>







<body class="twoColElsLtHdr">



	<div id="test3response"></div>



	<div id="container">



		<div id="header">



			<div id="logo">

				<!--<img src="imagenes/logo.png" alt="Navitas" />-->

			</div>







			<div id="altum" align="right">

				<br />Desarrollado por: <a href="http://www.altumasesores.com"

					target="_blank"><img src="imagenes/sistema/FIRMAALTUMASESORES.gif" />

				</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			</div>











			<!-- end #header -->

		</div>



		<div id="mainContent">



			<!--[$loginFormAction--/navitas/index.php]-->



			<form id="form1" name="form1" method="POST"

				action="<?php echo $loginFormAction; ?>">



				<table width="300" border="0" align="center" cellpadding="0"

					cellspacing="0">



					<tr>



						<td colspan="2" align="center">

							<h2>Entrar</h2></td>



					</tr>







					<tr>



						<td>Usuario:</td>



						<td><input type="text" name="usuario" id="usuario2" /></td>



					</tr>



					<tr>



						<td>Contraseña:</td>



						<td><input type="password" name="password" id="password" /></td>



					</tr>



					<tr>



						<td>&nbsp;</td>



						<td align="right"><input type="submit" name="enviar" id="enviar"

							value="Enviar" /></td>











					</tr>



				</table>



				<p>&nbsp;</p>



				<div style="padding: 0 0 0 300px">



					<img src="imagenes/sistema/logo_web.jpg" />



				</div>



				<p>&nbsp;</p>



				<p>&nbsp;</p>



			</form>



			<p>&nbsp;</p>







			<!-- end #mainContent -->

		</div>



		<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos -->

		<br class="clearfloat" />



		<div class="clearfloat"></div>



		<!-- end #container -->

	</div>







</body>



</html>

