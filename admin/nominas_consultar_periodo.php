<?php 

//	include_once("../convierte_fechas.php");
	include_once("nominas_clase.php");
	include_once("../funcion_redondear.php");
	include_once("../convertir_fechas.php");
			

	$objNomina = new cNomina();	              //Creamos el objeto $objEmpleados de la clase cEmpleado
	$listaNominas= $objNomina->consultar_nominas_estado("PROCESO");  //Consulto todas los empleados y las guardo en $lista empleados

?>

<table id="box-table-a">
<thead>
    <tr>
     <th scope="col">Clv</th>
     <th scope="col">Empresa</th>
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
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>

    </tr>
  </thead>  
     <tbody>
    <?php while ($row_nominas = mysql_fetch_assoc($listaNominas)){ ?>
      <tr>
      <td><?php echo $row_nominas['id_nomina']; ?></td>
        <td><?php echo $row_nominas['razon_social']; ?></td>
        <td><?php echo strtoupper($row_nominas['tipo_nomina']); ?></td>
        <td><?php
		   if($row_nominas['estado']=="PROCESO"){
			   echo "<div style='color:#600'>".$row_nominas['estado']."</div>";
			 }elseif($row_nominas['estado']=="AUTORIZADA"){
				 echo "<div style='color:#99CC33'>".$row_nominas['estado']."</div>"; 
			}elseif($row_nominas['estado']=="PAGADA"){
				 echo "<div style='color:#0066CC'>".$row_nominas['estado']."</div>"; 				 
			}else{
				echo "<div style='color:#FF6600'>".$row_nominas['estado']."</div>"; 
				}		 
				 ?></td>
        <td><?php echo mysql_texto($row_nominas['fecha_captura']); ?></td>
        <td><?php echo mysql_texto($row_nominas['inicio_periodo']); ?></td>
        <td><?php echo mysql_texto($row_nominas['fin_periodo']); ?></td>        
        <td align="right"><?php echo redondear($row_nominas['percepciones']) ; ?></td>
        <td align="right"><?php echo redondear($row_nominas['honorarios']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['relativos']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['subtotal']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['iva']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['total_factura']); ?></td>
  
       
       
        <td >
        
        
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
                <img src="../imagenes/abrir.png" width="24" height= "24" title="Ver Nomina" name="ver_nomina"/>
                </a>
               
   <!--         
   <a href="
   javascript:cargar_nomina(
   '90',
   '14'
   )"><img src='../imagenes/abrir.png' width='24' height= '24' title='Ver Nomina'		/></a>
   -->
        
        </td>
        
        <td><a href="javascript:eliminar_nomina('<?php echo $row_nominas['id_nomina']; ?>') "><img src="../imagenes/eliminar.png" title="Eliminar"		/></a></td>
     
        
      </tr>
      <?php } ?>
      
   </tbody>   
      
</table>