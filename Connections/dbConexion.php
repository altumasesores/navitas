<?php 
//Clase para conectarnos a la base de datos

 class dbConexion{
	//public $conect;
		
	function conectar(){
		
		//remoto
		
		$server= "localhost";
		$bd=  "mivacant_navitas";
		$user= "mivacant_user";
		$pass=  "eD2nKodKvu";
		
	
	
	
		/*
		//Local 
		$server= "localhost";
		$bd=  "navitas";
		$user= "root";
		$pass=  "mysql";
*/

		if(!($con = mysql_connect($server, $user, $pass))){
			echo "Error al conectar la Base de Datos";
			exit();			
			}
			
		if(!mysql_select_db($bd,$con)){
			echo "Error al seleccionar la Base de Datos";
			exit();
			}
	
		//$this->conect=$con;
		return true;		
		
		}	
	
	//FUNCIONES UTILIZADAS PARA CONTROLAR TRANSACCIONES SOBRE LA BASE DE DATOS
function iniciar_transaccion_bd(){
	mysql_query("BEGIN");
	}	
	
function cancelar_transaccion_bd(){
	mysql_query("ROLLBACK");
	}
	
function ejecutar_transaccion_bd(){
	mysql_query("COMMIT");
	}	
	
	}//fin de la clase
   
   
?>