<?php 

	if (!isset($_SESSION)) {
		  session_start();
	}

	$id_usuario= $_SESSION['id_usuario'];

	include_once("../admin/empresa_clase.php");
	include_once("../admin/empleado_clase.php");
	
	$objEmpresa = new cEmpresa();
	
	$objEmpleado = new cEmpleado();	              //Creamos el objeto $objEmpleados de la clase cEmpleado
	//Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultar_empresas_x_usuario($id_usuario);  //Consulto todas las empresas y las guardo en $lista empresas

	$id_empresa= $_POST['empresa'];
	$nombre= $_POST['nombre'];
	
	if ($id_empresa!="") {
		$listaEmpleados= $objEmpleado->consultar_empleado_empresa($id_empresa);  //Consulto todas los empleados y las guardo en $lista empleados
		$total_empleados=  mysql_num_rows($listaEmpleados);
	}
	else{
		$listaEmpleados= $objEmpleado->consultar_empleado_empresas_todas();  //Consulto todas los empleados y las guardo en $lista empleados
		$total_empleados=  mysql_num_rows($listaEmpleados);
		
	} 
//A continuacion imprimo la tabla de empresas

?>
<br/><br/>
<label>
  Empresa:<select name="id_empresa" id="id_empresa" onchange="javascript:buscarEmpleados_porEmpresas()">
  <option value="selecionar" disabled="disabled">Seleccionar:</option>
  <option value="todas" >Todas</option>
  <?php while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){ ?>
  <option value="<?php echo $row_empresas['id_empresa']; ?>"><?php echo $row_empresas['razon_social']; ?></option>  
  <?php }?>
    </select>
</label>
	<br />
	<h1><?php if($nombre!=""){ echo $nombre; }  else{  echo 'Todas la empresas'; }?></h1>
	<br />
    
    
    <h2>Total Empleados: <?php echo $total_empleados;?>
    </h2> 
    
<table id="box-table-a">
<thead>
    <tr>      
      <th scope="col">Nombre</th>
      <th scope="col">Ap. Paterno</th>
      <th scope="col">Ap. Materno</th>
      <th scope="col">CURP</th>
      <th scope="col">Fecha Nacimiento</th>      
      <th scope="col">No. Seguro Social</th>      
      <th scope="col">Sueldo imss</th>
      <th scope="col">Infonavit</th>
      <th scope="col">Sueldo Diario</th>
      <th scope="col">Periodo N&oacute;mina</th>      
      <th scope="col">Num. Cuenta</th>
      <th scope="col">Empresa</th>
      <th scope="col">Estado</th>      
      <th scope="col">&nbsp;</th>

    </tr>
    
 </thead>   
    
     <tbody>
    <?php while ($row_empleados = mysql_fetch_assoc($listaEmpleados)){ ?>
      <tr>
        <td><?php echo $row_empleados['nombre']; ?></td>
        <td><?php echo $row_empleados['ap_paterno']; ?></td>
        <td><?php echo $row_empleados['ap_materno']; ?></td>
        <td><?php echo $row_empleados['curp_empleado']; ?></td>
        <td><?php echo $row_empleados['fecha_nacimiento']; ?></td>        
        <td><?php echo $row_empleados['no_seg_social']; ?></td>
        <td><?php echo $row_empleados['sueldo_diario_imss']; ?></td>
        <td><?php echo $row_empleados['infonavit']; ?></td>        
        <td><?php echo $row_empleados['sueldo_diario']; ?></td>
        <td><?php echo $row_empleados['periodo_nomina']; ?></td>
        <td><?php echo $row_empleados['no_tarjeta']; ?></td>
<td><?php echo $row_empleados['razon_social']; ?></td>
        <td  ><?php if($row_empleados['estado']=="ACTIVO"){echo "<div style='color:#0033CC'>".$row_empleados['estado']."</div>";}
												else{echo "<div style='color:#600'>".$row_empleados['estado']."</div>"; } ?></td>





        <td><a onclick= "modificar_empleado_empresa('<?php echo $row_empleados['id_empleado']; ?>','<?php echo $row_empleados['curp_empleado']; ?>','<?php echo $row_empleados['no_seg_social']; ?>','<?php echo $row_empleados['ap_paterno']; ?>','<?php echo $row_empleados['ap_materno']; ?>','<?php echo $row_empleados['nombre']; ?>', '<?php echo $row_empleados['cuenta_imss']; ?>','<?php echo $row_empleados['fecha_alta_imss']; ?>','<?php echo $row_empleados['domicilio']; ?>','<?php echo $row_empleados['fecha_nacimiento']; ?>','<?php echo $row_empleados['sueldo_diario_imss']; ?>','<?php echo $row_empleados['estado']; ?>','<?php echo $row_empleados['observaciones']; ?>', '<?php echo $row_empleados['periodo_nomina']; ?>', '<?php echo $row_empleados['sueldo_diario']; ?>', '<?php echo $row_empleados['no_tarjeta']; ?>', '<?php echo $row_empleados['infonavit']; ?>')" style="cursor:pointer"><img src="../imagenes/modificar.png" width="24" height= "24" title="Modificar"		/></a></td>
        
      </tr>
      <?php } ?>
    </tbody>  
      
</table>