<?php 



	$id_user = $_SESSION['id_usuario'];
	include_once("../admin/empresa_clase.php");	
	
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultar_empresas_x_usuario($id_user);  //Consulto todas las empresas y las guardo en $lista empresas

//A continuacion imprimo la tabla de empresas

?>


<table id="box-table-a">
<!-- Table header -->  
<thead>
    <tr>
      <th scope="col">Clave</th>
      <th scope="col">Raz&oacute;n Social</th>
      <th scope="col">Titular</th>
      <th scope="col">Zona</th>
      <th scope="col">R.F.C.</th>
      <th scope="col">Correo</th>
      <th scope="col">Honorarios</th>
      <th scope="col">I.V.A.</th>
      <th scope="col">Usuario</th>
      <th scope="col">Password</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
    </tr>
 </thead>
    <!-- Table footer -->  
    
    
    <tbody>
    
    <?php while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){ ?>
      <tr>
        <td><?php echo $row_empresas['id_empresa']; ?></td>
        <td><?php echo $row_empresas['razon_social']; ?></td>
        <td><?php echo $row_empresas['titular']; ?></td>
        <td><?php echo $row_empresas['zona']; ?></td>
        <td><?php echo $row_empresas['rfc']; ?></td>
        <td><?php echo $row_empresas['correo']; ?></td>
        <td align="center"><?php echo $row_empresas['honorarios']; ?> %</td>
        <td align="center"><?php echo $row_empresas['iva']; ?> %</td>
        <td><?php echo $row_empresas['usuario']; ?></td>
        <td><?php echo $row_empresas['password']; ?></td>
        <td><a href="javascript:cargarEmpleados('../admin/empleados.php','mainContent', '<?php echo $row_empresas['id_empresa']; ?>')">
		<img src="../imagenes/empleados.png" width="24" height= "24" title="Empleados"/></a></td>
        
        <td><a onclick= "modificar_empresa('<?php echo $row_empresas['id_empresa']; ?>','<?php echo $row_empresas['razon_social']; ?>','<?php echo $row_empresas['titular']; ?>','<?php echo $row_empresas['zona']; ?>','<?php echo $row_empresas['rfc']; ?>','<?php echo $row_empresas['direccion']; ?>', '<?php echo $row_empresas['correo']; ?>','<?php echo $row_empresas['telefonos']; ?>','<?php echo $row_empresas['id_usuario']; ?>','<?php echo $row_empresas['usuario']; ?>','<?php echo $row_empresas['password']; ?>', '<?php echo $row_empresas['iva']; ?>', '<?php echo $row_empresas['honorarios']; ?>')" style="cursor:pointer"><img src="../imagenes/modificar.png" width="24" height= "24" title="Modificar"		/></a></td>
        <td>
        <a onclick="eliminar_empresa('<?php echo $row_empresas['id_empresa']; ?>')"  style="cursor:pointer">
        <img alt="Eliminar" src="../imagenes/eliminar.png" width="24" height= "24" title="Eliminar" /></a>
        </td>
      </tr>
      <?php } ?>
      
     </tbody> 
</table>