<?php

//echo "AnteFrontController cargado <br/>";
require_once("libs/php/autoload/autoload.php");
require_once("libs/php/redondear_decimales/funcion_redondear.php");
require_once("libs/php/convertir_fechas/convertir_fechas.php");
require_once("libs/php/convertir_fechas/convierte_fechas.php");
require_once("libs/php/paginador/paginador.php");
/*se incluye manualmente el FrontControllerNomina.php fuera del autoload,
  debido a que carga una accion de forma automatica y por el modo en que diseñado el autoload,
  el mismo no puede cargar el controlador sin tener especificados el modulo al que pertenece.
 */
require 'clientes/mod_nominas/libs/php/mvc/FrontControllerNomina.php';
require 'administrador/mod_nominas/libs/php/mvc/FrontControllerNominaAdmin.php';
//de configuracion,se carga manualmente ya que es una funcion libre,el autoload solo carga clases
require_once 'libs/php/mvc/ConfigBD.php'; 



if(isset($_GET['controlador'])){
$controllerName = $_GET['controlador'] ;
}
elseif(isset($_POST['controlador'])){
$controllerName = $_POST['controlador'] ;
}

if(!empty($controllerName))
{
	$controllerName="FrontController".$controllerName."::main();";
	
}else
{
	
	$controllerName=$_SESSION['Frontcontroller']."::main();";
	
}


eval($controllerName);

?> 
