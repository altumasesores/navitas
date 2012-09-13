<?php 

	include_once("../admin/empresa_clase.php");
	include_once("../admin/usuario_clase.php");
	
	$id_usuario= $_POST['id_usuario'];
	$usuario= $_POST['usuario'];

	
	$objUsuario = new cUsuario();	              //Creamos el objeto $objUsuario de la clase cUsuario
	$listaUsuarios= $objUsuario->consulta_usuario_empresas($id_usuario);  //Consulto todas las empresas y las guardo en $lista usuarios

	$listaEmpresas= $objUsuario->consulta_no_asignadas($id_usuario);  //Consulto todas las empresas y las guardo en $lista empresas





//A continuacion imprimo la tabla de empresas

?>
<br/>

<h3>Seleccione las empresas de las cuales el usuario  <strong><?php echo $usuario; ?></strong> recibira notificaciones via mail.</h3>
<br/>

<table id="box-table-a">
<thead>
    <tr>
      <th scope="col">Asignar</th>
      <th scope="col">Raz&oacute;n Social</th>
      <th scope="col">Titular</th>
      <th scope="col">Zona</th>
    </tr>
    
    </thead>
    <tbody>
    
    <?php while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){ ?>
      <tr>
		<td>
<input type="checkbox" name="asignar[]" id="asignar_<?php echo $row_empresas['id_empresa']; ?>" value="<?php echo $row_empresas['id_empresa']; ?>">
		
	    </td>
        <td><?php echo $row_empresas['razon_social']; ?></td>
        <td><?php echo $row_empresas['titular']; ?></td>
        <td><?php echo $row_empresas['zona']; ?></td>        
      </tr>
      <?php } ?>
      </tbody>
</table>
<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<input name="guardar" type="button" value="Guardar" onClick="usuario_clientes('<?php echo $id_usuario; ?>', '<?php echo $usuario; ?>')"> &nbsp;&nbsp;&nbsp;&nbsp;
						 <input name="cancelar" type="button" value="Cancelar" onClick="cargarPagina('../admin/usuarios.php','mainContent')">


<div id="mensaje"></div>
<br/><br/>


<?php 
	if($listaUsuarios==0){
		echo "Aun no se le han asignado clientes a este usuario.";
		}else{

			
		?>
            
            
<h3>Clientes asignados al usuario <strong><?php echo $usuario; ?></strong></h3>
<br/>
<table id="box-table-a">
<thead>

    <tr>
      <th scope="col">Raz&oacute;n Social</th>
      <th scope="col">Titular</th>
      <th scope="col">Zona</th>
      <th scope="col">&nbsp;</th>
    </tr>
    </thead>
     <tbody>
    
    <?php while ($row_usuarios = mysql_fetch_assoc($listaUsuarios)){ ?>
      <tr>
        <td><?php echo $row_usuarios['razon_social']; ?></td>       
        <td><?php echo $row_usuarios['titular']; ?></td>
        <td><?php echo $row_usuarios['zona']; ?></td>
        <td><a onClick="eliminar_usuarios_clientes('<?php echo $id_usuario; ?>', '<?php echo $row_usuarios['id_empresa']; ?>', '<?php echo $usuario; ?>' )" style="cursor:pointer"><img src="../imagenes/eliminar.png" width="24" height= "24" title="Eliminar"		/></a></td>        
      </tr>
      <?php } ?>
      </tbody>
</table>

<?php } ?>

<br/>