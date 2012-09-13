<?php 
	//include_once("../Connections/dbConexion.php");
	//echo $respaldo= $_POST['respaldo'];

	$tiempo=date("H-i-s");  
	$date= date("dmY");
	$dbfile = '../RespaldosBD/navitas'.$date.$tiempo.'.sql';
	$output=system("mysqldump -hlocalhost -umivacant_user -peD2nKodKvu mivacant_navitas >$dbfile"); // ejemplo windows
	//$output=system("c:\mysql\bin\mysqldump.exe -hlocalhost -umivacant_user -peD2nKodKvu mivacant_bd >$dbfile"); // ejemplo windows
	//$output=shell_exec("c:\mysql\bin\mysqldump.exe -hlocalhost -uroot -pmysql navitas > c:\RespaldosBD\navitas.sql"); // si funciona esta linea en el cmd
	//$output = ereg_replace( "Content-type: text/html", "", $output );
		/* if(trim($output)==NULL)
		 {
			 echo "Error creando el backup de la DB: ".'navitas';
			 exit();
		 }*/
		//header('Content-type: text/plain');
		//header('Content-Disposition: attachment; filename="'.$output.'"');
		///echo $output;
//exit(); 
						header("Pragma: public");
                        header("Expires: 0");
                        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                        header("Cache-Control: public");
                        header("Content-Description: File Transfer");
                        //header("Content-Type: application/gzip");
						/* header("Content-type: application/force-download");
						header('Content-Disposition: attachment; filename="navitas'.$date.$tiempo.'.sql"'); */
                       // header("Content-Disposition: attachment; filename=navitass.sql;");

                        //header("Content-Length: ".filesize('navitass.sql'));
                        //@readfile($backup);
			
                      //  return LIEN_BACKUP_BD . "backup_.sql.gz";
					   /*   if (file_exists($dbfile)) 
						{ */
							echo $dbfile; 
						/*} */ 
?>