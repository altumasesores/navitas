<?php header('Access-Control-Allow-Origin: *');
//error_reporting(0); // Set E_ALL for debuging

$directorio="../FileManager/";
//$directorio="FileManager/";
if($tipoUSR!="Administrador")
{
	$commands="['open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook','download',   'extract', 'archive', 'search',  'view', 'help','resize', 'sort']";
	
	}elseif($tipoUSR=="Administrador")
	{
		$commands="['open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook', 'download',   'extract', 'archive', 'search',  'view', 'help','resize', 'sort','mkdir','mkfile','upload', 'copy', 'cut', 'paste', 'edit','rm', 'duplicate', 'rename','info']";
		
		}else{
			$commands="[]";}
 ?>


		<!-- jQuery and jQuery UI (REQUIRED) -->
<link rel="stylesheet" type="text/css" 
media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">        
		
		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">		
		$(document).ready(function(e) {			
				var elf = $('#elfinder').elfinder({
					//url : 'http://www.mivacante.com/navitas/<?php echo $directorio;?>php/connector.php',  // connector URL (REQUIRED)
					url : '<?php echo $directorio;?>php/connector.php',  // connector URL (REQUIRED)
					customData:{"razon":"<?php echo $razon_social;?>"},
				    lang: 'es',             // language (OPTIONAL)
					commands :<?php echo $commands;?>
				}).elfinder('instance');
				
				
            
        });
			
		</script>
	

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder">finder</div>

	
<!--
,-->