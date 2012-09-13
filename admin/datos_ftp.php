<?php 

# CONSTANTES
# Cambie estos datos por los de su Servidor FTP
define("SERVER","localhost"); //IP o Nombre del Servidor
define("PORT",21); //Puerto
define("USER","mivacant"); //Nombre de Usuario
define("PASSWORD","Vacante2012Navitas2012"); //Contraseña de acceso
define("MODO",true); //Activa modo pasivo


function ConectarFTP(){
	//Permite conectarse al Servidor FTP
	$id_ftp=ftp_connect(SERVER,PORT); //Obtiene un manejador del Servidor FTP
	ftp_login($id_ftp,USER,PASSWORD); //Se loguea al Servidor FTP
	ftp_pasv($id_ftp,MODO); //Establece el modo de conexión
	ftp_chdir($id_ftp, "/public_html/navitas/documentos");
		ini_set('post_max_size','100M');
		ini_set('upload_max_filesize','100M');
		ini_set('max_execution_time','1000');
		ini_set('max_input_time','1000'); 

	return $id_ftp; //Devuelve el manejador a la función
}



function ObtenerRuta(){
	//Obriene ruta del directorio del Servidor FTP (Comando PWD)
	$id_ftp=ConectarFTP(); //Obtiene un manejador y se conecta al Servidor FTP
	$Directorio=ftp_pwd($id_ftp); //Devuelve ruta actual p.e. "/home/willy"
	ftp_quit($id_ftp); //Cierra la conexion FTP
	return $Directorio; //Devuelve la ruta a la función
}


?>