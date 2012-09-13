<?php 

if (!isset($_SESSION)) {
		  session_start();
	}

$id_usuario= $_SESSION['id_usuario'];

	include_once("../admin/empresa_clase.php");
	include_once("../funcion_redondear.php");	
	
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultar_empresas_x_usuario($id_usuario);  //Consulto todas las empresas y las guardo en $lista empresas
			
	
	include_once("../admin/reportes_clase.php");
	
	$objReporte = new cReportes();	              //Creamos el objeto $objUsuario de la clase cUsuario
	$listaNominas= $objReporte->consultar_nominas();  //Consulto todas las empresas y las guardo en $lista usuarios

	$t_percepciones= 0;
	$t_honorarios= 0;
	$t_relativos= 0;
	$t_subtotal= 0;
	$t_iva= 0;
	$t_total_factura= 0;
	

//A continuacion imprimo la tabla de usuarios

?>

<label>Empresa=
  <select name="id_empresa" id="id_empresa">
  <option value="todas" >Consultar todas:</option>
  <?php while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){ ?>
  <option value="<?php echo $row_empresas['id_empresa']; ?>"><?php echo $row_empresas['razon_social']; ?></option>  
  <?php }?>
  </select>
  
  <BR/><BR/>
  
  Estado=
  <select name="estado" id="estado">
  <option value="TODOS" >CONSULTAR TODOS</option>
  <option value="REVISION" >REVISION</option>
  <option value="PROCESO" >PROCESO</option>
  <option value="AUTORIZADA" >AUTORIZADA</option>
  <option value="PAGADA" >PAGADA</option>
  
  </select>
</label>
<label>Tipo nomina=
  <select name="tipo_nomina" id="tipo_nomina">
  <option value="TODOS" >CONSULTAR TODOS</option>
  <option value="SEMANAL" >SEMANAL</option>
  <option value="QUINCENAL" >QUINCENAL</option>
  <option value="CATORCENAL" >CATORCENAL</option>
  <option value="MENSUAL" >MENSUAL</option>
  </select>
</label>
Periodo del: 
<label>
  <input type="text" name="fecha_inicio" id="fecha_inicio" />
</label>
al 
<label>
  <input type="text" name="fecha_fin" id="fecha_fin" />
</label>

<br />
<br />
<table id="box-table-a">
<thead>
    <tr>
     <th scope="col">Empresa</th>      
      <th scope="col">Percepciones</th>
      <th scope="col">Honorarios</th>
      <th scope="col">Relativos&nbsp; &nbsp; &nbsp;</th>
      <th scope="col">Subtotal&nbsp; &nbsp; &nbsp;</th>
      <th scope="col">I.V.A.&nbsp; &nbsp; &nbsp;</th>
      <th scope="col">Total &nbsp; &nbsp; &nbsp;</th>
    </tr>
  </thead>  
  
     <tbody>
    <?php while ($row_nomina = mysql_fetch_assoc($listaNominas)){ ?>
      <tr>
        <td><?php echo $row_nomina['razon_social']; ?></td>
        <td align="right"><?php echo redondear($row_nomina['percepciones']);  $t_percepciones= $t_percepciones + $row_nomina['percepciones'];   ?></td>       
        <td align="right"><?php echo redondear($row_nomina['honorarios']); $t_honorarios= $t_honorarios+ $row_nomina['honorarios']; ?></td>       
        <td align="right"><?php echo redondear($row_nomina['relativos']); $t_relativos= $t_relativos + $row_nomina['relativos'];  ?></td>       
        <td align="right"><?php echo redondear($row_nomina['subtotal']); $t_subtotal = $t_subtotal+ $row_nomina['subtotal'];?></td>       
        <td align="right"><?php echo redondear($row_nomina['iva']); $t_iva= $t_iva + $row_nomina['iva']; ?></td>       
        <td align="right"><?php echo redondear($row_nomina['total_factura']); $t_total_factura= $t_total_factura + $row_nomina['total_factura']; ?></td>       
        
      </tr>
      <?php } ?>
  
  
  <tr>  
  <td align="right">&nbsp;</td>
  <td align="right"><strong><?php echo redondear($t_percepciones);?></strong></td>
  <td align="right"><strong><?php echo redondear($t_honorarios);?></strong></td>
  <td align="right"><strong><?php echo redondear($t_relativos);?></strong></td>
  <td align="right"><strong><?php echo redondear($t_subtotal);?></strong></td>
  <td align="right"><strong><?php echo redondear($t_iva);?></strong></td>  
  <td align="right"><strong><?php echo redondear($t_total_factura);?></strong></td>  
  </tr>
  
      
      </tbody>
</table>


