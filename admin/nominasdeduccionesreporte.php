<?php 

$dia_inicio= $_POST['dia_inicio'];
$dia_final= $_POST['dia_final'];
$NominasEmpresa= $_POST['NominasEmpresa'];
$cadena= stripslashes($_POST['cadena']);
$cadena2= stripslashes($_POST['cadena2']);
$num= $_POST['num'];
$cadenatitulos= $_POST['cadenatitulos'];
$arregloTitulos = explode(',', $cadenatitulos);

	
	include_once("reportes_clase.php");
        include_once("../funcion_redondear.php");
	
	$objReporte = new cReportes();	              //Creamos el objeto $objUsuario de la clase cUsuario
        
        if($NominasEmpresa!=''){ 
            $listaNominasEmpresa= $objReporte->nominas_empresa_deducciones($NominasEmpresa,$dia_inicio,$dia_final,$cadena,$cadena2);  //Consulto todas las empresas y las guardo en $lista usuarios
            $h=mysql_num_rows($listaNominasEmpresa);
        }
                  
                echo '<tr><td width="50%" ></td>';
                 for($j=0;$j<(count($arregloTitulos)-1);$j++){
                        echo '<td>'.$arregloTitulos[$j].'</td>'; 
                    }
                 echo '</tr>'; 
                 
                $num2=0;
                while ($row_nom=mysql_fetch_array($listaNominasEmpresa)){ 
                   echo '<tr>'; 
                       while ($num2<=($num+2)){ 
                            if($num2==0){ 
                            ?>
                                <td><img src="../imagenes/siguiente.png" name="esp" width="10px" height="10px" hspace="15" border="0" align="left" onclick= "buscarEmpleadosNom('<?php echo $NominasEmpresa; ?>','<?php echo $row_nom[$num2]; ?>','deducciones','<?php echo $cadenatitulos; ?>','normal','<?php echo 'Del '.$row_nom[1].'  Al  '.$row_nom[2]; ?>');" ><?php echo 'No. '.$row_nom[0].' Del '.$row_nom[1].'  Al  '.$row_nom[2]; ?></td>
                            <?php 
                             $num2=2;
                            }
                            else{
                                    echo '<td align="center" >$ '.redondear($row_nom[$num2]).'</td>';
                            }
                            
                            $num2++;
                        }
                   echo '</tr>';
                        $num2=0;
                }
?> 
                
                 