<?php 

	include_once("nominas_clase.php");	
	include_once("empresa_clase.php");			
	include_once("convertir_a_letras.php");
	
	$id_empresa= $_GET['id_empresa'];
	$id_nomina= $_GET['id_nomina'];
	$V=new EnLetras();
	




	$objNomina = new cNomina();	              //Creamos el objeto $objEmpleados de la clase cEmpleado

	$datosNomina= $objNomina->consultar_nomina($id_nomina);  //Consulto datos generales de la nomina	
	while ($row_nomina = mysql_fetch_assoc($datosNomina)){

		$subtotal= $row_nomina['subtotal'];
		$iva = $row_nomina['iva'];
		$total= $row_nomina['total_factura'];
		$total_letras= $V->ValorEnLetras($total,"pesos");
		$estatus = $row_nomina['estado'];
	  
     } 	
		
		
	$objEmpresa = new cEmpresa();	              //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);   //Consulto todas las empresas y las guardo en $lista empresas	
		
	while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){
            
      $razon_social= $row_empresas['razon_social'];    
	  $direccion= htmlentities($row_empresas['direccion']);    
	  $ciudad= "Chetumal, Quintana Roo";   //agregarlo manualmente
	  $rfc= $row_empresas['rfc'];    
	  $telefono= $row_empresas['telefonos'];    
	  $cp= $row_empresas['cp']; 

     } 	
	$fecha= "30 noviembre 2010"; //agregar manualmente



?>




<form id="form1" name="form1" method="post" action="facturacion.php">

<input type="text" id="id_nomina" value="<?php echo $id_nomina; ?>" />

  <p>
    <label>Fecha:
      <input type="text" name="fecha" id="fecha" value="30 noviembre 2010"/>
    </label>
  </p>
  <p>Cliente: 
    <label>
      <input name="razon_social" type="text" id="razon_social" size="60" value="<?php echo $razon_social; ?>" />
    </label>
  </p>
  <p>Direccion:  
    <label>
      <input name="direccion" type="text" id="direccion" size="60" value="<?php echo $direccion; ?>" />
    </label>
  </p>
  <p>Ciudad:  
    <label>
      <input type="text" name="ciudad" id="ciudad" value="Chetumal, Quintana Roo" />
    </label> 
    CP: 
    <label>
      <input type="text" name="cp" id="cp" value="<?php echo $cp; ?>" />
    </label>
  </p>
  <p>RFC: 
    <label>
      <input type="text" name="rfc" id="rfc" value="<?php echo $rfc; ?>" />
    </label> 
    Tel: 
    <label>
      <input type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>" />
    </label>
  </p>
  <p>Descripcion: 
    <label>
      <input name="descripcion" type="text" id="descripcion" value="Servicios Profesionales" />
    </label>
   Importe: 
   <label>
     <input type="text" name="importe" id="importe" value="<?php echo $subtotal; ?>" />
   </label>
  </p>
  <p>&nbsp;</p>
  <p>Cantidad Letras: 
    <label>
      <input name="total_letras" type="text" id="total_letras" size="60" value="<?php echo $total_letras; ?>" />
    </label>
  </p>
  <p>Subtotal:  
    <label>
      <input type="text" name="subtotal" id="subtotal" value="<?php echo $subtotal; ?>" />
    </label>
  </p>
  <p>IVA: 
    <label>
      <input type="text" name="iva" id="iva" value="<?php echo $iva; ?>" />
    </label>
  </p>
  <p>Total: 
    <label>
      <input type="text" name="total" id="total" value="<?php echo $total; ?>" />
    </label>
  </p>
  <label>
    <input type="submit" name="enviar" id="enviar" value="Enviar" />
  </label>
</form>



