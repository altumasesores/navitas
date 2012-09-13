<?php 
	
	include_once("../admin/reportes_clase.php");
	include_once("../convertir_fechas.php");
	
	$objReporte = new cReportes();	              //Creamos el objeto $objUsuario de la clase cUsuario
	$listaEmpleados= $objReporte->consultar_empleados_activos();  //Consulto todas las empresas y las guardo en $lista usuarios

?>

<br />
<br />
<h3>Empleados Activos </h3>
<table id="box-table-a">
<thead>
    <tr>
     <th scope="col">Empleado</th>      
      <th scope="col">Estado</th>      
      <th scope="col">no. seguro social</th>
      <th scope="col">Fecha alta imss</th>
      <th scope="col">Empresa</th>
    </tr>
  </thead>  
  
     <tbody>
    <?php while ($row_empleados = mysql_fetch_assoc($listaEmpleados)){ ?>
      <tr>
        <td><?php echo $row_empleados['nombre']."  ". $row_empleados['ap_paterno']."  ". $row_empleados['ap_materno']   ; ?></td>
        <td><?php echo $row_empleados['estado']; ?></td>
        <td><?php echo $row_empleados['no_seg_social']; ?></td>
        <td><?php echo mysql_texto($row_empleados['fecha_alta_imss']); ?></td>
        <td><?php echo $row_empleados['razon_social']; ?></td>                
      </tr>
      <?php } ?> 
      
      </tbody>
</table>


