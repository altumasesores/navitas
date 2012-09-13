<?php   
//echo "autoload cargado<br/>";
function __autoload($classname)
{
	
	
	
	$subdirectorio_libs="../libs/php/";
	$usuario="";
	
	
	
	if(isset($_GET['grupo'])){
		$usuario.=$_GET['grupo']."/";
		
		
		
		
		if(isset($_GET['extension'])){
		$usuario=$_GET['extension'].$usuario;
		$subdirectorio_libs=$_GET['extension']."libs/php/";
	}
	elseif(isset($_POST['extension']))
	{
		$usuario=$_POST['extension'].$usuario;
		$subdirectorio_libs=$_POST['extension']."libs/php/";
	}else{
	
		$subdirectorio_libs="libs/php/";
	}
	
	
	
	
		
	}
	elseif(isset($_POST['grupo']))
	{
		$usuario.=$_POST['grupo']."/";
		
		
		
		if(isset($_GET['extension'])){
		$usuario=$_GET['extension'].$usuario;
		$subdirectorio_libs=$_GET['extension']."libs/php/";
	}
	elseif(isset($_POST['extension']))
	{
		$usuario=$_POST['extension'].$usuario;
		$subdirectorio_libs=$_POST['extension']."libs/php/";
	}else{
		$subdirectorio_libs="libs/php/";
	}
	}
	
	
	
	
	if(isset($_GET['modulo'])){
		$modulo=$usuario."mod_".$_GET['modulo']."/";
	}
	elseif(isset($_POST['modulo']))
	{
		$modulo=$usuario."mod_".$_POST['modulo']."/";
	}
	


	$archivo=$classname.".php";
	$subdirectorio_controller="controller/";
	$subdirectorio_model="model/";		
	$ramas_libs=array(
							   "mvc"=>"mvc/"
							   );
							   
							   
							 
	
	
	
	if (is_array($ramas_libs))
	{
		foreach($ramas_libs as $nivel_1 => $value)
		{
			if(is_array($nivel_1))
			{
				//implementar codigo en caso que el primer nivel de libs/php tenga otros subdirectorios
			}
			else
			{
				$subdirectorio_libs.=$ramas_libs[$nivel_1];
				
			}			
			
		} 
		
	}
	
	


	try{
	if (file_exists($modulo.$subdirectorio_controller.$archivo))
    {
		require_once($modulo.$subdirectorio_controller.$archivo);
		//echo "cargado correctamente"."</br>";
		//echo $modulo.$subdirectorio_controller.$archivo."</br></br>";		
	}
	else if(file_exists($modulo.$subdirectorio_model.$archivo))
	{
		require_once($modulo.$subdirectorio_model.$archivo);
		//echo "cargado correctamente"."</br>";
		//echo $modulo.$subdirectorio_model.$archivo."</br></br>";
	}
	else if(file_exists($modulo.$subdirectorio_libs.$archivo))
	{
		require_once($modulo.$subdirectorio_libs.$archivo);
		//echo "cargado correctamente"."</br>";
		//echo $modulo.$subdirectorio_libs.$archivo."</br></br>";
	}
	else if(file_exists($subdirectorio_libs.$archivo))
	{
		require_once($subdirectorio_libs.$archivo);
		//echo "cargado correctamente"."</br>";
		//echo $subdirectorio_libs.$archivo."</br></br>";
	}
	else
	{
		/*
		$modulo="mod_nominas/";
		$subdirectorio_model="model/";
		$archivo="ModelNomina.php";
		*/
		
				echo "Error: al intentar cargar el modulo ".$modulo.". No se encontro el archivo: ".$subdirectorio_libs.$archivo."</br>";
		
		//echo "Error: al intentar cargar el modulo ".$_POST['modulo'].". No se encontro el archivo: ".$archivo."</br>";
		//throw new Exception("Unable to load");
		

		/*
		echo $modulo.$subdirectorio_controller.$archivo."</br>";
		echo $modulo.$subdirectorio_model.$archivo."</br>";
		echo $modulo.$subdirectorio_libs.$archivo."</br>";
		*/
	}
	
	
	
	}catch (Exception $e) {
echo $e->getMessage(), "\n";

}
	
	
	
	
}
	

?>