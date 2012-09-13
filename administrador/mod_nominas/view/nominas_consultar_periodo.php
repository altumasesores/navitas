<br />
<?php     
//encabezado de la tabla a paginar
$encabezado=array(
      "Clave"=>"",	  
      "Empresa"=>"",
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
	  "Ver Nomina"=>"nosort",
	  "Eliminar"=>"nosort"	 
	  );

//instanciamos el paginador
$paginador=new paginador($encabezado);
//creamos la cabecera
$paginador->cabeceraPaginador();


$paginamos=false;	

while ($row_nominas =$listaNominas->fetch())
{
	$paginamos=true;
	
	
	$parametros=str_replace('"',"'",json_encode(
	                                            array(
												       "id_nomina"=>$row_nominas['id_nomina'],
													   "id_empresa"=>$row_nominas['id_empresa']
													   )
													 ));
	 ?>
     <tr>
     <td><?php echo $row_nominas['id_nomina'];?></td>
     <td><?php echo $row_nominas['razon_social']; ?></td>
     <td><?php echo strtoupper($row_nominas['tipo_nomina']); ?></td>
     <td><?php	 
		   if($row_nominas['estado']=="PROCESO")
		   {
			   echo "<div style='color:#600'>".$row_nominas['estado']."</div>";
			   }elseif($row_nominas['estado']=="AUTORIZADA")
			   {
				   echo "<div style='color:#99CC33'>".$row_nominas['estado']."</div>"; 
				   }elseif($row_nominas['estado']=="PAGADA")
				   {
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
      <?php }

	   ?>      
   

<?php
if($paginamos){
//creacion del cierre o pie del paginador
$paginador->piePaginador();
}
?>