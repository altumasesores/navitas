<?php

set_include_path(get_include_path() . ';' . $_SERVER['DOCUMENT_ROOT'] . '\navitas\classes');
   
function __autoload($classname)
{
	require $classname . '.php';
}
	
//Omar Kar�m Mart�n Cornejo [omarkhd]
?>