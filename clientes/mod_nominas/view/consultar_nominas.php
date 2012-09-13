<?php 
if (!isset($_SESSION)) {
  session_start();
}	

//"nombre"=>"nosort" en caso de no usar como filtro "nombre"=>"" en caso de usarlo como filtro
$encabezado=array(
      "clave"=>"",	  
      "Fecha Captura"=>"",
      "N&oacute;mina"=>"",
      "Inicio Periodo"=>"",
      "Fin Periodo"=>"",
      "Estado"=>"",
      "Percepciones"=>"",
      "Honorarios"=>"",
      "Relativos"=>"",
      "Subtotal"=>"",
      "I.V.A."=>"",
      "Total Factura"=>"",
      "Consultar"=>"nosort"	 
	  );
	  ?>
      
      
	  
<h2>Nóminas:</h2>
<br/>

<div id="nominas_empresa">
<?php
	  
//instancia del objeto paginador y creacion de cabecera de tabla	  
$paginador=new paginador($encabezado);

//creacion de la cabecera con formato css y js
$paginador->cabeceraPaginador();
if($listaNominas->rowCount()>0){

//cuerpo de datos a mostrar,debe coincidir con el numero de atributos del encabezado
while ($row_nominas = $listaNominas->fetch()){ 

$_SESSION['id_empresa']=$row_nominas['id_empresa'];

?>


      <tr>
        <td><?php echo $row_nominas['id_nomina']; ?></td>
        <td><?php echo mysql_texto($row_nominas['fecha_captura']); ?></td>
        <td><?php echo strtoupper($row_nominas['tipo_nomina']); ?></td>
        <td><?php echo mysql_texto($row_nominas['inicio_periodo']); ?></td>
        <td><?php echo mysql_texto($row_nominas['fin_periodo']); ?></td>
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
        <td align="right"><?php echo redondear($row_nominas['percepciones']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['honorarios']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['relativos']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['subtotal']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['iva']); ?></td>
        <td align="right"><?php echo redondear($row_nominas['total_factura']); ?></td>
        
        <td align="center">     
        <?php
		/*opcionalmente se puede crear un array en php y pasarlo como objeto literal a javascript,
		de la siguiente forma,esto con el objetivo de un mejor manejo del codigo.
		Se pueden agregar n parametros*/
		$parametros=str_replace('"',"'",json_encode(array(
		"id_nomina"=>$row_nominas['id_nomina'],
		"id_empresa"=>$row_nominas['id_empresa'],		
		"id_usuario"=>$id_usuario
		)));
		
		//transaccionesNomina.consultarNominaVistaInicial(parametros,accion,tipo_ajax(POST/GET))
        ?>
        <a href="javascript:$('#mainContent').html('');$('#cuerpoNomina').html('');$('#periodo').html('');transaccionesNomina.consultarNominaXCliente(<?php echo $parametros;?>,'cuerpoNomina','consultarNominaEmpresa','POST')">
        <img src="../imagenes/consultar.png" width="24" height= "24" title="Consultar"/>
        </a>
        </td>
        
        
        
           
        
        
        
      </tr>
      
   
      <?php }

//creacion del cierre o pie del paginador
$paginador->piePaginador();
}
?>
<input type="hidden" id="iva_empresa" value="<?php echo $iva; ?>" />
<input type="hidden" id="honorarios_empresa" value="<?php echo $honorarios; ?>" />

</div>


<div id="nomina"></div>

