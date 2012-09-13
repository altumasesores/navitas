<?php 

	include_once("../admin/usuario_clase.php");
	
	$objUsuario = new cUsuario();	              //Creamos el objeto $objUsuario de la clase cUsuario
	$listaUsuarios= $objUsuario->consultar();  //Consulto todas las empresas y las guardo en $lista usuarios

//A continuacion imprimo la tabla de usuarios

?>



<table id="box-table-a">
<thead>
    <tr>
      <th scope="col">Clave</th>
      <th scope="col">Usuario</th>
      <th scope="col">Password</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Tipo</th>
      <th scope="col">Clientes Asignados</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
    </tr>
  </thead>  
  
     <tbody>
    <?php while ($row_usuarios = mysql_fetch_assoc($listaUsuarios)){ ?>
      <tr>
        <td><?php echo $row_usuarios['id_usuario']; ?></td>
        <td><?php echo $row_usuarios['usuario']; ?></td>
        <td><?php echo $row_usuarios['password']; ?></td>
        <td><?php echo $row_usuarios['nombre']; ?></td>
        <td><?php echo $row_usuarios['correo']; ?></td>
        <td><?php echo $row_usuarios['tipo']; ?></td>       
        <td align="center">
        
        <?php if($row_usuarios['tipo']!="Cliente"){ ?>
        <a onclick="asignar_clientes('<?php echo $row_usuarios['id_usuario']; ?>', '<?php echo $row_usuarios['usuario']; ?>')" style="cursor:pointer">
        <img src="../imagenes/clientes.png" width="24" height= "24" title="Clientes"		/>
        </a>    
		<?php } ?> 
        </td>       
         
        <td>
        <a onclick= "modificar_usuario('<?php echo $row_usuarios['id_usuario']; ?>','<?php echo $row_usuarios['usuario']; ?>','<?php echo $row_usuarios['password']; ?>','<?php echo $row_usuarios['nombre']; ?>','<?php echo $row_usuarios['tipo']; ?>','<?php echo $row_usuarios['correo']; ?>')" style="cursor:pointer">
        <img src="../imagenes/modificar.png" width="24" height= "24" title="Modificar"		/>
        </a>
        </td>
        
        <td>
        <a onclick="eliminar_usuario('<?php echo $row_usuarios['id_usuario']; ?>')" style="cursor:pointer">
        <img src="../imagenes/eliminar.png" width="24" height= "24" title="Eliminar"		/>
        </a>   
       
        </td>
      </tr>
      <?php } ?>
      
      </tbody>
</table>