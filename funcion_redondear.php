<?php 
function redondear($valor){
	$float_redondeado=round($valor * 100) / 100;
	return $float_redondeado;
} 
?>