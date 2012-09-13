<?php include_once("../admin/publicaciones_clase.php");

	$objPublicaciones = new cPublicaciones();	
	$listaPublicaciones= $objPublicaciones->consultar();  //Consulto todas las empresas y las guardo en $lista usuarios



?>



<table id="box-table-a">
<thead>
    <tr>
      <th scope="col">Descripción</th>
      <th scope="col">Fecha Publicación</th>
      <th scope="col">Documento</th>

      <th scope="col">&nbsp;</th>
    </tr>
 </thead>   
    
         <tbody>
    <?php while ($row_pub = mysql_fetch_assoc($listaPublicaciones)){ ?>
      <tr>
        <td ><?php echo $row_pub['descripcion']; ?></td>
        <td align="center"><?php echo $row_pub['fecha_publicacion']; ?></td>
        <td align="center"><a href="../admin/descargar.php?file=<?php echo $row_pub['ruta_archivo']; ?>"><img src="../imagenes/descargar.png" width="24" height= "24" title="Descargar"/></a></td>
         
        <td align="center"><a href="javascript:if(confirm('Realmente desea eliminar la publicación'))eliminar_publicacion('<?php echo $row_pub['id_documento']; ?>') "><img src="../imagenes/eliminar.png" width="24" height= "24" title="Eliminar"/></a></td>
      </tr>
      <?php } ?>
      
  </td>    
      
</table>