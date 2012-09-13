<?php
//echo "frontcontrollernomina cargado <br/>";
class FrontControllerNominaAdmin
{
	static function controlador()
	{
	}
	static function main()
	{
		
		if(file_exists('mod_nominas/libs/php/mvc/configNomina.php'))
		{
			require_once 'mod_nominas/libs/php/mvc/configNomina.php'; //Archivo con configuraciones
		
			}elseif(file_exists('administrador/mod_nominas/libs/php/mvc/configNominaAdmin.php'))
			{	
				require_once 'administrador/mod_nominas/libs/php/mvc/configNominaAdmin.php';
				}
				
				
				
                //Formamos el nombre del Controlador o en su defecto, tomamos que es el IndexController
               if(isset($_GET['controlador'])){
                  $controllerName = $_GET['controlador'] . 'Controller';
				}
				elseif(isset($_POST['controlador'])){
                   $controllerName = $_POST['controlador'] . 'Controller';
				}
				else{
                    $controllerName = "NominaAdminController";
				} 
				
                if(isset($_GET['accion'])){
					$actionName = $_GET['accion'];
					$ModifEmp= true;
				}
				elseif(isset($_POST['accion'])){
                    $actionName = $_POST['accion'];
				}
				else{
                    $actionName = "vistaPrincipal";
				}  	
				
				/***************************************/
				/*
				Este fragmento de codigo solo se utliza una vez, cuando es lanzado un controlador y accion desde el inicio del sisteta.
				Para los siguiente modulos que son llamados a traves de una accion, como un href o un onclick, este fragmento ya no es necesario,
				el autoload se encarga de realizar la carga del archivo de forma automatica.
				
				*/
				 $controllerPath =$config->get('controllersFolder') . $controllerName . '.php';
				 $modelPath =$config->get('modelsFolder') . "ModelNominaAdmin" . '.php';
				 
				
				
				//$controllerPath = 'mod_empresas/controller/'. $controllerName . '.php';

                //Incluimos el fichero que contiene nuestra clase controladora solicitada
                if(is_file($controllerPath))
                      require $controllerPath;
                elseif(is_file("administrador/".$controllerPath))
                       require "administrador/".$controllerPath;
			    else
                      die('El controlador no existe - 404 not found');
					  
				if(is_file($modelPath))
                      require $modelPath;
                elseif(is_file("administrador/".$modelPath))
                       require "administrador/".$modelPath;
                else
                      die('El modelo no existe - 404 not found');  

                /*
				//Si no existe la clase que buscamos y su accion, tiramos un error 404
                if (is_callable(array($controllerName, $actionName)) == false)
                {
                        trigger_error ($controllerName . '->' . $actionName . '` no existe', E_USER_NOTICE);
                        return false;
                }*/
				/***************************************/			  
				
				$controller = new $controllerName();				
				$controller->model();
				
				if(isset($_GET) && !empty($_GET))
					{
						//echo "tiene GET";
						}else{
							//echo "no tiene GET";
							}
				
				if(isset($_POST) && !empty($_POST))
					{
						//echo "tiene POST";
						}else{
							//echo "no tiene POST";
							}
							
							
               	if(method_exists($controller, $actionName)) {
					
					if(isset($_GET) && !empty($_GET))
					{
						$controller->$actionName($_GET);
						
					}elseif(isset($_POST) && !empty($_POST))
					{
						$controller->$actionName($_POST);
						
						}else{
							$controller->$actionName();
							}					
					
					}
					else
					{
						echo "Error: no se encontro la accion solicitada: -".$actionName."-";
						}
        }
}
?>
