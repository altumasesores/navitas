<?php 

	include_once("../admin/publicaciones_clase.php");
	
	$id_empresa= $_SESSION['id_empresa'];
	$objPublicaciones = new cPublicaciones();	
	$listaPublicaciones= $objPublicaciones->consultar_empresa($id_empresa); //Se consultan los documentos por empresa

?>




<table id="box-table-a">
<thead>
    <tr>
      <th scope="col">Descripci&oacute;n</th>
      <th scope="col">Fecha Publicaci&oacute;n</th>
      <th scope="col">Descargar</th>
    </tr>
  </thead>  
    <tbody>
    <?php while ($row_pub = mysql_fetch_assoc($listaPublicaciones)){ ?>
      <tr>
        <td><?php echo $row_pub['descripcion']; ?></td>
        <td align="center"><?php echo $row_pub['fecha_publicacion']; ?></td>
        <td align="center">
        <a href="../clients/descargar.php?file=<?php echo $row_pub['ruta_archivo']; ?>"><img src="../imagenes/descargar.png" width="24" height= "24" title="Descargar"/></a></td>
         
       
      </tr>
      <?php } ?>
      </tbody>
</table>