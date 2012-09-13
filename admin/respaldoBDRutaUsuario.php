<?php 
	$file= $_GET['nombreArchivo'];
	//$file='../RespaldosBD/navitas0605201116-39-24.sql';
					     if (file_exists($file)) 
						{ 	
							/*header("Content-type: application/force-download"); 
							header("Content-Disposition: attachment; filename=".basename($nombreArchivo)); 
							header("Content-Transfer-Encoding: binary"); 
							header("Content-Length: ".filesize($nombreArchivo)); 
							readfile($nombreArchivo);  */
							header('Content-Description: File Transfer');
							header('Content-Type: application/octet-stream');
							header('Content-Disposition: attachment; filename='.basename($file));
							header('Content-Transfer-Encoding: binary');
							header('Expires: 0');
							header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
							header('Pragma: public');
							header('Content-Length: ' . filesize($file));
							ob_clean();
							flush();
							readfile($file); 
							//echo $file;
							//exit;
							
						}
?>