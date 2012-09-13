<?php 
if (!isset($_SESSION)) {
  session_start();
}
	$id_empresa= $_SESSION['id_empresa'];
	include_once("../admin/empresa_clase.php");
	include_once("../admin/nominas_clase.php");
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

//A continuacion imprimo la tabla de nominas

?>

<h2>Nóminas:</h2>
<br/>

<div id="nominas_empresa">

<table id="box-table-a">
<thead>
    <tr>
      <th scope="col">clave</th>
      <th scope="col">Fecha Captura</th>
      <th scope="col">N&oacute;mina</th>
      <th scope="col">Inicio Periodo</th>
      <th scope="col">Fin Periodo</th>
      <th scope="col">Estado</th>
      <th scope="col">Percepciones</th>
      <th scope="col">Honorarios</th>
      <th scope="col">Relativos</th>
      <th scope="col">Subtotal</th>
      <th scope="col">I.V.A.</th>
      <th scope="col">Total Factura</th>
      <th scope="col">Consultar</th>
    </tr>
    </thead>
         <tbody>
    
    <?php while ($row_nominas = mysql_fetch_assoc($listaNominas)){ ?>
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
        
        <td align="center"><a href="javascript:cargar_nomina_cliente('<?php echo $row_nominas['id_nomina']; ?>', '<?php echo $row_nominas['id_empresa']; ?>') "><img src="../imagenes/consultar.png" width="24" height= "24" title="Consultar"/></a></td>
        
      </tr>
      <?php } ?>
      </tbody>
</table>

<input type="hidden" id="iva_empresa" value="<?php echo $iva; ?>" />
<input type="hidden" id="honorarios_empresa" value="<?php echo $honorarios; ?>" />

</div>


<div id="nomina"></div>




