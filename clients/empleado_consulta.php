<?php 

	$id_empres= $_SESSION['id_empresa'];
	include_once("../admin/empleado_clase.php");	
	$estado= $_POST['estado'];
	if($estado!=""){
	$id_empres= $_POST['empresa'];
	}

	$objEmpleado = new cEmpleado();	              //Creamos el objeto $objEmpleados de la clase cEmpleado
	$listaEmpleados= $objEmpleado->consultar($id_empres,$estado);  //Consulto todas los empleados y las guardo en $lista empleados

//A continuacion imprimo la tabla de empresas

?>
<input type="hidden" id="empresa" value="<?php echo $id_empres;  ?>"  />
<table id="box-table-a">
<thead>
    <tr>      
      <th scope="col">Nombre</th>
      
      <th scope="col">Ap. Paterno</th>
      <th scope="col">Ap. Materno</th>
      <th scope="col">Fecha Alta</th>
      <th scope="col">Antiguedad</th>
      <th scope="col">CURP</th>
      <th scope="col">Fecha Nacimiento</th>
      <th scope="col">Fecha Alta imss</th>
      <th scope="col">No. Seguro Social</th>
      <th scope="col">Sueldo imss</th>
      <th scope="col">Periodo N&oacute;mina</th>
      <th scope="col">Sueldo Diario</th>
      <th scope="col">Num. Tarjeta</th>
      <th scope="col">Estado:<select name="id_estado" id="id_estado" onchange="javascript:buscarEmpleados()">
		<option value="selecionar" disabled="disabled">Seleccionar:</option>
		<option value="Todos" >Todos</option>	
		<option value="Activo" >Activo</option>
		<option value="Baja" >Baja</option>
		<option value="Pendiente" >Pendiente</option>
		</select></th>
    </tr>
   
   </thead>
        <tbody> 
    <?php while ($row_empleados = mysql_fetch_assoc($listaEmpleados)){ ?>
      <tr>
        <td><?php echo $row_empleados['nombre']; ?></td>
       
        <td><?php echo $row_empleados['ap_paterno']; ?></td>
        <td><?php echo $row_empleados['ap_materno']; ?></td>
         <td><?php echo $row_empleados['fecha_alta']; ?></td>
        <td><?php echo $row_empleados['antiguedad']; ?></td>
        <td><?php echo $row_empleados['curp_empleado']; ?></td>
        <td align="center"><?php echo $row_empleados['fecha_nacimiento']; ?></td>
        <td align="center"><?php echo $row_empleados['fecha_alta_imss']; ?></td>
        <td align="center"><?php echo $row_empleados['no_seg_social']; ?></td>
        <td align="center"><?php echo $row_empleados['sueldo_diario_imss']; ?></td>
        <td align="center"><?php echo $row_empleados['periodo_nomina']; ?></td>
        <td align="center"><?php echo $row_empleados['sueldo_diario']; ?></td>
        <td><?php echo $row_empleados['no_tarjeta']; ?></td>
        <td><?php if($row_empleados['estado']=="ACTIVO"){echo "<div style='color:#0033CC'>".$row_empleados['estado']."</div>";}
												else{echo "<div style='color:#600'>".$row_empleados['estado']."</div>"; } ?></td> 
    <!-- <td><a href="#">Solicitar Baja</a></td> -->
             

      </tr>
      <?php } ?>
      
      </tbody>
</table>