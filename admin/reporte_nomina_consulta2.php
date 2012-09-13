<?php 

if (!isset($_SESSION)) {
		  session_start();
	}

$id_usuario= $_SESSION['id_usuario'];
$id_empresa= $_POST['id_empresa'];
$dia_inicio= $_POST['dia_inicio'];
$dia_final= $_POST['dia_final'];

 $cadena= stripslashes($_POST['cadena']);
$cadena2= stripslashes($_POST['cadena2']);
$cadena3= stripslashes($_POST['cadena3']);
$cadena4= stripslashes($_POST['cadena4']);

$caden= $_POST['caden'];
$caden2= $_POST['caden2'];
$num= $_POST['num'];
$num2= $_POST['num2'];

	//include_once("empresa_clase.php");
	include_once("../funcion_redondear.php");	
	
	//$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	//$listaEmpresas= $objEmpresa->consultar_empresas_x_usuario($id_usuario);  //Consulto todas las empresas y las guardo en $lista empresas
	
	include_once("reportes_clase.php");
	
	$objReporte = new cReportes();	              //Creamos el objeto $objUsuario de la clase cUsuario
	
	if($id_empresa!=''){
             if($num!='' AND $num!=0){
            $listaNominasPercepciones= $objReporte->consultar_nominas_($id_empresa,$dia_inicio,$dia_final,$cadena,$cadena2);  //Consulto todas las empresas y las guardo en $lista usuarios
            $h=mysql_num_rows($listaNominasPercepciones);
            }
             if($num2!='' AND $num2!=0){
                $listaNominasDeduciones= $objReporte->consultar_nominas_Deducciones($id_empresa,$dia_inicio,$dia_final,$cadena3,$cadena4);  //Consulto todas las empresas y las guardo en $lista usuarios
            }
	}
        
	$t_percepciones= 0;
	$t_honorarios= 0;
	$t_relativos= 0;
	$t_subtotal= 0;
	$t_iva= 0;
	$t_total_factura= 0;
        
        $arregloPercepciones = explode(',', $caden);
        $arregloDeducciones = explode(',', $caden2);

	

//A continuacion imprimo la tabla de usuarios

?>
<table>
<tr>
<td>
<?php
            if($id_empresa!='todas' AND $id_empresa!=''){
        ?>
            <img src="../imagenes/pdf.png" width="24" height= "24" onclick="buscarNominas('PDF')" alt="PDF" title="PDF" align="center" /><a onclick= "buscarNominas('PDF')" >PDF Nóminas</a>
                <br/><br/><br/>
        <?php
            }
        ?>
 <?php
        if($id_empresa!='' AND $num!='' AND $num!=0){
 ?>
 
<table id="box-table-a" style="display:none;" border="0">
	
	<tr>
       
	<th scope="col" width="50%" align="center" >Empresa Percepciones</th>
	
 <?php
        for($j=0;$j<(count($arregloPercepciones)-1);$j++){
            echo '<th scope="col" align="center" >'.$arregloPercepciones[$j].'</th>'; 
	}
           
	
	?>
	 </tr> 

    <?php 
	if($id_empresa!=''){
              $numm2=2;
	while ($row_nomina=mysql_fetch_array($listaNominasPercepciones)){ ?>
      <tr>
		<?php
		if($id_empresa!=''){
                ?>
		<td width="50%" ><img src="../imagenes/agregar.png" name="esp" width="10px" height="10px" hspace="15" border="0" align="left" onclick= "buscarNominasreporte('<?php echo $row_nomina['id_empresa']; ?>','<?php echo $caden; ?>','NominasEmpresa<?php echo $row_nomina['id_empresa']; ?>','<?php echo $row_nomina['razon_social']; ?>');" ><?php echo $row_nomina['razon_social']; ?></td>
		<?php
                }
                while ($numm2<=($num+1)){ 
                                    echo '<td id="hr" align="center" >$ '.redondear($row_nomina[$numm2]).'</td>';
                            
                            
                            $numm2++;
                        }
                   echo '</tr>';
                        $numm2=2;
        ?>
      </tr>
        <tr>
             <td width="100%" colspan="<?php echo $num+2; ?>" align="right"  >
                <table id="NominasEmpresa<?php echo $row_nomina['id_empresa']; ?>" width="100%" style="display:none;" border="0" align="right" >  

                </table> 
             </td>      
        </tr>
        <tr>
             <td width="100%" colspan="<?php echo $num+2; ?>" bgcolor="#FF0000"  >
                <table id="NominaEmpleado<?php echo $row_nomina['id_empresa']; ?>" width="100%" align="right"  >  
                   <tr>
                    <td width="100%" ><?php include 'empleadosnominareporte.php'; ?>
                    </td>      
                    </tr>
                </table>
             </td>      
        </tr>
	  
      <?php } ?>
	  <?php } ?>
</table>
 <?php
        }
 ?>
</td>
</tr>
<tr>
<td>
 <?php
        if($id_empresa!='' AND $num2!='' AND $num2!=0){
 ?>
<table id="box-table-c" style="display:none;" width="100%" border="0" >
	<tr>
	<?php
	echo '<th scope="col" align="center" >Empresa Deducciones</th>'; 
        for($i=0;$i<(count($arregloDeducciones)-1);$i++){
            echo '<th scope="col">'.$arregloDeducciones[$i].'</th>'; 
	}
	
	?>
	 </tr> 

    <?php 
	if($id_empresa!=''){
            $numm3=2;
	while ($row_nomina2=mysql_fetch_array($listaNominasDeduciones)){ ?>
      <tr>
		<?php
		if($id_empresa!=''){
                ?>
		<td width="50%" ><img src="../imagenes/agregar.png" name="esp" width="10px" height="10px" hspace="15" border="0" align="left" onclick= "buscarNominasreportededuc('<?php echo $row_nomina2['id_empresa']; ?>','<?php echo $caden2; ?>','NominasDeducciones<?php echo $row_nomina2['id_empresa']; ?>');" ><?php echo $row_nomina2['razon_social']; ?></td>
		<?php
                }
                while ($numm3<=($num2+1)){ 
                                    echo '<td id="hr" align="center" >$ '.redondear($row_nomina2[$numm3]).'</td>';
                            
                            
                            $numm3++;
                        }
                   echo '</tr>';
                        $numm3=2;
        ?>
        <tr>
             <td colspan="<?php echo $num2+1; ?>" width="100%" align="right"  >
                <table id="NominasDeducciones<?php echo $row_nomina2['id_empresa']; ?>" width="100%" style="display:none;"  border="0" align="right"  >  
               
                </table> 
             </td>      
        </tr>
         <tr>
             <td colspan="<?php echo $num2+1; ?>" >
                <table id="NominaEmpleadoDeduc<?php echo $row_nomina2['id_empresa']; ?>" align="right"   >  
                   <tr>
                    <td width="100%" ><?php include 'empleadosnominareporte.php'; ?>
                    </td>      
                    </tr>
                </table>
                <?php
        } 
 ?>
             </td>      
        </tr>
	  
      <?php } ?>
	  <?php } ?>
        
</td>
</tr>
</table>