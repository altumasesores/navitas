<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

//remoto

	$hostname_navitas = "localhost";
	$database_navitas = "mivacant_navitas";
	$username_navitas = "mivacant_user";
	$password_navitas = "eD2nKodKvu";

/* ftp://mivacant:eD2nKodKvu@www.mivacante.com
//local
	$hostname_navitas = "localhost";
	$database_navitas = "navitas";
	$username_navitas = "root";
	$password_navitas = "mysql";
	*/

	
$navitas = mysql_pconnect($hostname_navitas, $username_navitas, $password_navitas) or trigger_error(mysql_error(),E_USER_ERROR); 
?>