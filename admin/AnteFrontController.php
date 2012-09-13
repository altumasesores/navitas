<?php
require_once("../libs/php/mvc/Config.php");
require_once("../libs/php/mvc/ControllerBase.php");
require_once("../libs/php/mvc/ModelBase.php");
require_once("../libs/php/mvc/View.php");
require_once("../libs/php/mvc/SPDO.php");

require_once("../admin/mod_calculos/model/ModelCalculos.php");
require_once("../admin/mod_calculos/model/ModelCalculosDatos.php");

require_once("../admin/mod_calculos/libs/php/mvc/FrontControllerCalculos.php");

require_once("../libs/php/autoload/autoload.php");
       
//Incluimos algunas clases:
require_once '../libs/php/mvc/ConfigBD.php'; //de configuracion

if(isset($_GET['controlador'])){
   $controllerName = $_GET['controlador'] ;
}
elseif(isset($_POST['controlador'])){
    $controllerName = $_POST['controlador'] ;
}

if(!empty($controllerName))
{
	$controllerName="FrontController".$controllerName."::main();";
	
}/* else
{
	$controllerName="FrontControllerMenu::main();";
	
} */


eval($controllerName);

?> 
