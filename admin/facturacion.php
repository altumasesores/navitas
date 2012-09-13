<?php 
	require_once('../dompdf/dompdf_config.inc.php');

	//include_once("nominas_clase.php");	
	//include_once("empresa_clase.php");			
	include_once("convertir_a_letras.php");
	
		$V=new EnLetras();
		$subtotal= $_POST['subtotal'];
		$iva = $_POST['iva'];
		$total= $_POST['total'];
		//$total_letras= $V->ValorEnLetras($total,"pesos");
		
		$total_letras= $V->ValorEnLetras($total,"pesos");

	  	$razon_social= $_POST['razon_social'];    
		$direccion= htmlentities($_POST['direccion']);    
		$ciudad= $_POST['ciudad'];  //agregarlo manualmente
	  	$rfc= $_POST['rfc'];    
	  	$telefono= $_POST['telefono'];    
	  	$cp= $_POST['cp']; 
	  
	  	$fecha= $_POST['fecha']; 


	
	/*
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

para el servidor:

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>




*/


$html= "

<html>
<body>
<p>&nbsp;</p>
<table border='0'>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
</table>


<table  border='0' width='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td>
    
      <table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td>  
		  
		  <table align='right' style='margin-right:30;' width='100%'   border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td align='right'>&nbsp;</td>
	<td align='right'>&nbsp;".$fecha."</td>
  </tr>
</table>


<br/>


<table width='100%' style='margin-left:80;' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td>".$razon_social."</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>".$direccion."</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>".$ciudad."</td>
                <td>".$cp."</td>
              </tr>
              <tr>
                <td>".$rfc."</td>
                <td>".$telefono."</td>
              </tr>
            </table>
          <p>&nbsp;</p>
      
		  </td>
        </tr>
        <tr>
          <td>
		  
		  <table width='100%' style='margin-left:60;margin-right:30;' border='0' cellspacing='0' cellpadding='0'>
            <tr>
              <td>Servicios Profesionales</td>
              <td align='right' >$ &nbsp; ".$subtotal."</td>
            </tr>
          </table></td>
        </tr>
        <tr>
           <td><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		  <p>&nbsp;</p>
		  <p>&nbsp;</p>
		  
		  <p>&nbsp;</p>
		  <p>&nbsp;</p>
		  <p></p>
			

			
			
		
		<br/>
		
		  
		  
		  </td>
        </tr>
        <tr>
          <td>
		  
		  <table width='100%' style='margin-left:15;' border='0' cellspacing='0' cellpadding='0'>
            <tr>
              <td>".$total_letras."</td>
			  
              <td align='right' ><table width='100%' style='margin-right:30;' align='right' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td align='right'>$ &nbsp;".$subtotal."</td>
                </tr>
                <tr>
                  <td align='right'>$ &nbsp;".$iva."</td>
                </tr>
                <tr>
                  <td align='right'>$ &nbsp;".$total."</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
";


$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('nomina.pdf');


?>