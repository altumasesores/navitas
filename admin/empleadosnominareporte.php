<?php 

$NominasEmpresa= $_POST['NominasEmpresa'];
$idNomina= $_POST['idNomina'];
$dia_inicio= $_POST['dia_inicio'];
$dia_final= $_POST['dia_final'];
$cadena= stripslashes($_POST['cadena']);
$cadena2= stripslashes($_POST['cadena2']);
$cadena3= stripslashes($_POST['cadena3']);

$num= $_POST['num'];
$tipo= $_POST['tipo'];
$titulos= $_POST['titulos'];
$arregloTitulos = explode(',', $titulos);

	include_once("reportes_clase.php");
        include_once("../funcion_redondear.php");
	
	$objReporte = new cReportes();	              //Creamos el objeto $objUsuario de la clase cUsuario
        
        if($NominasEmpresa!=''){ 
            
              if($tipo=='percepciones'){
                        $listaEmpleadoNominas= $objReporte->consultar_nominas_empleados($NominasEmpresa,$idNomina,$cadena,$cadena2,$cadena3);  
                }
                else {
                        $listaEmpleadoNominas= $objReporte->consultar_nominas_empleados_deduc($NominasEmpresa,$idNomina,$cadena,$cadena2,$cadena3);  
                    
                  }
          
                    echo 'Nómina No. = '.$idNomina.'<br/><br/>'; 
                    echo '<tr>';  
                    echo '<td>Nombre Empleado</td>'; 
                    for($j=0;$j<count($arregloTitulos);$j++){
                        echo '<td>'.$arregloTitulos[$j].'</td>'; 
                    }
                       echo '</tr>'; 
        
                   $num2=1;
                    while ($row_nom=mysql_fetch_array($listaEmpleadoNominas)){ 
                   echo '<tr>'; 
                        while ($num2<=($num+3)){ 
                             if($num2==1){ 
                                 if($row_nom[1]!='0'){
                                    echo '<td width="50%" >'.$row_nom[1].' '.$row_nom[2].' '.$row_nom[3].'</td>';
                                    
                                     }
                                     else{
                                          echo '<td width="50%" >Totales</td>';
                                     }
                                     $num2=3;
                             }
                             else{  echo '<td width="10%"  >$ '.redondear($row_nom[$num2]).'</td>';
                             }
                            $num2++;
                        }
                   echo '</tr>';
                        $num2=1;
                    }
                    echo '<br/><br/><br/>';
                    ?>
                      <img src="../imagenes/pdf.png" width="24" height= "24" onclick="buscarEmpleadosNom('<?php echo $NominasEmpresa; ?>','<?php echo $idNomina; ?>','percepciones','<?php echo $titulos; ?>','PDF','<?php echo $dia_inicio; ?>');" alt="PDF" title="PDF" align="center" /><a onclick= "buscarEmpleadosNom('<?php echo $NominasEmpresa; ?>','<?php echo $idNomina; ?>','percepciones','<?php echo $titulos; ?>','PDF','<?php echo $dia_inicio; ?>');" >PDF Empleados</a>
                        <br/><br/><br/>
                    <?php
        }

?> 
                
                 