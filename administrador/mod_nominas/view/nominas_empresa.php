<br />
<?php
		

/*
$id_empresa= $_POST['id_empresa'];
include_once("empresa_clase.php");


	
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);  //Consulto todas las empresas y las guardo en $lista empresas
		while ($row_empresa = mysql_fetch_assoc($listaEmpresas)){
			$iva=	$row_empresa['iva'];
			$honorarios=	$row_empresa['honorarios'];
		}
		
*/



?>
<?php     
//encabezado de la tabla a paginar
 
$encabezado=array(
      "Clave"=>"",
      "N&oacute;mina"=>"",
      "Estado"=>"",
      "Fecha Captura"=>"",
      "Inicio Periodo"=>"",
      "Fin Periodo"=>"",
      "Percepciones"=>"",
      "Honorarios"=>"",
      "Relativos"=>"",
      "Subtotal"=>"",
      "I.V.A."=>"",
      "Total"=>"",
      "Reporte"=>"nosort",
      "Ver nomina"=>"nosort",
      "Eliminar"=>"nosort"
	  );

//instanciamos el paginador
$paginador=new paginador($encabezado);
//creamos la cabecera
$paginador->cabeceraPaginador();

$paginamos=false;
	
while ($row_nominas = $listaNominas->fetch()){
	$paginamos=true;
		
		
		$parametros=str_replace('"',"'",json_encode(
	                                            array(
												       "id_nomina"=>$row_nominas['id_nomina'],
													   "id_empresa"=>$row_nominas['id_empresa']
													   )
													 ));
		
		
		
		 ?>
      <tr>
        <td><?php echo $row_nominas['id_nomina']; ?></td>
        <td><?php echo strtoupper($row_nominas['tipo_nomina']); ?></td>
        <td><?php
		   if($row_nominas['estado']=="PROCESO"){
			   echo "<div style='color:#600'>".$row_nominas['estado']."</div>";
			 }elseif($row_nominas['estado']=="AUTORIZADA"){
				 echo "<div style='color:#99CC33'><strong>".$row_nominas['estado']."</strong></div>"; 
			}elseif($row_nominas['estado']=="PAGADA"){
				 echo "<div style='color:#0066CC'>".$row_nominas['estado']."</div>"; 				 
			}else{
				echo "<div style='color:#FF6600'>".$row_nominas['estado']."</div>"; 
				}	 
				 ?></td>        
                                                
        <td ><?php echo mysql_texto($row_nominas['fecha_captura']); ?></td>
        <td><?php echo mysql_texto($row_nominas['inicio_periodo']); ?></td>
        <td><?php echo mysql_texto($row_nominas['fin_periodo']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['percepciones']) ; ?></td>
        <td align="right"><?php echo redondear($row_nominas['honorarios']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['relativos']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['subtotal']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['iva']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['total_factura']); ?></td>
        <td align="center"> 
		<?php if($row_nominas['estado']=="PROCESO"){?> No disponible
        	<?php }else{  ?>
                  <a href="../reportes/nomina_<?php echo $row_nominas['id_nomina']; ?>.xls"><img src="../imagenes/descargar.png" width="24" height= "24" title="Descargar Reporte"		/></a>
         <?php }?>
         </td>
       
       
        <td>
        
     

<a href="#">
        <img src="../imagenes/abrir.png" title="Ver Nomina" 
        onclick="transaccionesNomina.consultarNominaEmpresaXIdNomina(<?php echo $parametros?>,'nominas_empresa_empleados','consultarNominaXIdNomina','POST')"/>
                </a>

     
        </td>
        
        
         <td>
          <a href="#">
        <img src="../imagenes/eliminar.png" title="Eliminar" 
        onclick="transaccionesNomina.EliminarNominaEmpresaXIdNomina(<?php echo $parametros?>,'cuerpoNomina','eliminarNominaXIdNomina','POST')"/>
        </a>
         </td>
   
		
        
      </tr>
      <?php } ?>
      
   
<?php
if($paginamos){
//creacion del cierre o pie del paginador
$paginador->piePaginador();
}
?>