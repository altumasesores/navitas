<?php 


	$id_empresa= $_POST['id_empresa'];
//	include_once("../convierte_fechas.php");
	include_once("empresa_clase.php");
	include_once("nominas_clase.php");
	include_once("../funcion_redondear.php");
	include_once("../convertir_fechas.php");
	
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);  //Consulto todas las empresas y las guardo en $lista empresas
		while ($row_empresa = mysql_fetch_assoc($listaEmpresas)){
			$iva=	$row_empresa['iva'];
			$honorarios=	$row_empresa['honorarios'];
		}
		

	$objNomina = new cNomina();	              //Creamos el objeto $objEmpleados de la clase cEmpleado
	$listaNominas= $objNomina->consultar_nominas_empresa($id_empresa);  //Consulto todas los empleados y las guardo en $lista empleados


?>

<table id="box-table-a">
<thead>

    <tr>
     <th scope="col">Clv</th>
      <th scope="col">N&oacute;mina</th>
      <th scope="col">Estado</th>
      <th scope="col">Fecha Captura</th>
      <th scope="col">Inicio Periodo</th>
      <th scope="col">Fin Periodo</th>
      <th scope="col">Percepciones</th>
      <th scope="col">Honorarios</th>
      <th scope="col">Relativos</th>
      <th scope="col">Subtotal</th>
      <th scope="col">I.V.A.</th>
      <th scope="col">Total</th>
      <th scope="col">Reporte</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
 

    </tr>
 </thead>
      <tbody>   
    <?php while ($row_nominas = mysql_fetch_assoc($listaNominas)){ ?>
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
        <td align="center"> <?php if($row_nominas['estado']=="PROCESO"){?> No disponible
        	<?php }else{  ?>
                  <a href="../reportes/nomina_<?php echo $row_nominas['id_nomina']; ?>.xls"><img src="../imagenes/descargar.png" width="24" height= "24" title="Descargar Reporte"		/></a>
         <?php }?>
         </td>
       
       
        <td>
        
        <?php
		
  $parametros_basicos=str_replace('"',"'",json_encode(array(
  "controlador"=>"Calculos",			    
  "mensaje"=>"este usuario",
  "capa"=>"nominas_empresa_empleados",
  "modulo"=>"calculos"					   
  )));
  

  
  $operaciones=array(
      "Cargar"=>str_replace('"',"'",json_encode(array(
						"operacion"=>"CargarNomina",
						"accion"=>"CargarNomina"
						)))
	  );
  

$parametros_especificos=str_replace('"',"'",json_encode(array(
				  "id_nomina"=>$row_nominas['id_nomina'],
				  "id_empresa"=>$row_nominas['id_empresa']			   
				  
				  )));

  
?>

        
         <a  href="javascript:operaciones2.inicializador(<?php echo $parametros_basicos?>,<?php echo $parametros_especificos?>,<?php echo $operaciones['Cargar']?>,'POST');" >                
                <img src="../imagenes/abrir.png" width="24" height= "24" title="Ver Nomina"/>
                </a>
        
        <?php 
		/*"<a href='javascript:cargar_nomina('<?php echo $row_nominas['id_nomina']; ?>', '<?php echo $row_nominas['id_empresa']; ?>') '><img src='../imagenes/abrir.png' width='24' height= '24' title='Ver Nomina'		/></a>"*/
        ?>
        </td>
        
        
         <td><a href="javascript:eliminar_nomina('<?php echo $row_nominas['id_nomina']; ?>') "><img src="../imagenes/eliminar.png"  title="Eliminar"		/></a></td>
   
		
        
      </tr>
      <?php } ?>
      
    </tbody>  
      
</table>