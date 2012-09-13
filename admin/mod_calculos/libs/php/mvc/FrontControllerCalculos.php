<?php

class FrontControllerCalculos
{
        static function main()
        {
				require_once '../admin/mod_calculos/libs/php/mvc/configCalculos.php'; //Archivo con configuraciones				
				
                //Formamos el nombre del Controlador o en su defecto, tomamos que es el IndexController
               if(isset($_GET['controlador'])){
                  $controllerName = $_GET['controlador'] . 'Controller';
				}
				elseif(isset($_POST['controlador'])){
                   $controllerName = $_POST['controlador'] . 'Controller';
				}
				
                if(isset($_GET['accion'])){
					$actionName = $_GET['accion'];
					
				}
				elseif(isset($_POST['accion'])){
                    $actionName = $_POST['accion'];
				}
				
                $controllerPath = $config->get('controllersFolder') . $controllerName . '.php';

                //Incluimos el fichero que contiene nuestra clase controladora solicitada
                if(is_file($controllerPath))
                      require $controllerPath;
                else
                      die('El controlador no existe - 404 not found'.$controllerPath); 

                //Si no existe la clase que buscamos y su accion, tiramos un error 404
                if (is_callable(array($controllerName, $actionName)) == false)
                {
                        trigger_error ("cname ".$controllerName . '-> caction ' . $actionName . '` no existe dfsdfs ', E_USER_NOTICE);
                        return false;
                }
                //Si todo esta bien, creamos una instancia del controlador y llamamos a la accion
				
				$controller = new $controllerName();				
				$controller->model();
				
				if($actionName=='CalcularCalculos'){
				$salario=$_GET['salario'];
				$periodo=$_GET['periodo'];
                $controller->$actionName($salario,$periodo);
				} 
				elseif($actionName=='calcular'){
				$idNomina=$_GET['idNomina'];
				$tipo_nomina=$_GET['tipo_nomina'];
				$sueldo_integrado=$_GET['sueldo_integrado'];
				$dias_trabajados=$_GET['dias_trabajados'];
				//$tipoNomina=$_GET['tipoNomina'];
                $controller->$actionName($idNomina,$tipo_nomina,$sueldo_integrado,$dias_trabajados);
				}
				elseif($actionName=='NominaFiscal'){
				$idNomina=$_GET['idNomina'];
				$idEmpresa=$_GET['idEmpresa'];
				$TipoNomina=$_GET['TipoNomina'];
				//$tipoNomina=$_GET['tipoNomina'];
                $controller->$actionName($idNomina,$idEmpresa,$TipoNomina);
				}
				elseif($actionName=='calcular_neto_pagar'){
				$id_nomina=$_GET['id_nomina'];
				$id_empleado=$_GET['id_empleado'];
				//$tipoNomina=$_GET['tipoNomina'];
                $controller->$actionName($id_empleado,$id_nomina);
				}
				elseif($actionName=='ElimEmpleado'){
				$id_empleado=$_GET['id_empleado'];
				$id_empresa=$_GET['id_empresa'];
				$idNomina=$_GET['idNomina'];
                $controller->$actionName($id_empleado,$id_empresa,$idNomina);
				}
				elseif($actionName=='CargarNomina'){
					$controller->$actionName($_POST);
					}
				elseif($actionName=='EliminarNominaFiscal'){
					$controller->$actionName($_POST);
					}
				elseif($actionName=='CargarNominaCliente'){
					$controller->$actionName($_POST);
					}
				else
				{
					echo "Error: no se encontro la accion solicitada: -".$actionName."-";
				}
        }
}
?>
