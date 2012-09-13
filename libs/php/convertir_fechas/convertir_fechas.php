<?php


function texto_mysql($fecha){
	
    $dia=substr($fecha,0,2); 	
	$mes=substr($fecha,3,-5);
	$anio=substr($fecha,-4,4); 
	
if     ($mes=="Enero") $mes="01";
elseif ($mes=="Febrero") $mes="02";
elseif ($mes=="Marzo") $mes="03";
elseif ($mes=="Abril") $mes="04";
elseif ($mes=="Mayo") $mes="05";
elseif ($mes=="Junio") $mes="06";
elseif ($mes=="Julio") $mes="07";
elseif ($mes=="Agosto") $mes="08";
elseif ($mes=="Septiembre") $mes="09";
elseif ($mes=="Octubre") $mes="10";
elseif ($mes=="Noviembre") $mes="11";
elseif ($mes=="Diciembre") $mes="12";
else $mes="--";	
	

//21/diciembre/2010

$fecha_texto = ($anio."/".$mes."/".$dia);
return $fecha_texto;

}

function mysql_texto($fecha){

// Está funcion toma una fecha con formato 2004/12/01 y la devuelve en formato 01/Dic/2004 

$ano=substr($fecha, 0, 4);
$mes=substr($fecha, 5, 2);
$dia=substr($fecha, 8, 2);

if ($mes=="01") $mes="Enero";
elseif ($mes=="02") $mes="Febrero";
elseif ($mes=="03") $mes="Marzo";
elseif ($mes=="04") $mes="Abril";
elseif ($mes=="05") $mes="Mayo";
elseif ($mes=="06") $mes="Junio";
elseif ($mes=="07") $mes="Julio";
elseif ($mes=="08") $mes="Agosto";
elseif ($mes=="09") $mes="Septiembre";
elseif ($mes=="10") $mes="Octubre";
elseif ($mes=="11") $mes="Noviembre";
elseif ($mes=="12") $mes="Diciembre";
else $mes="--";
$fecha_texto = ($dia."/".$mes."/".$ano);
return $fecha_texto;
}//fin convierte_fecha


function fecha_mysql_php($fecha){
	
	$ano=substr($fecha, 0, 4);
	$mes=substr($fecha, 5, 2);
	$dia=substr($fecha, 8, 2);
	
	$fecha_php = ($dia."/".$mes."/".$ano);
	return $fecha_php;
	}

function fecha_php_mysql($fecha){

	$dia=substr($fecha,0,2); 	
	$mes=substr($fecha,3,-5);
	$anio=substr($fecha,-4,4); 

$fecha_mysql = ($anio."/".$mes."/".$dia);
return $fecha_mysql;


	}



?>