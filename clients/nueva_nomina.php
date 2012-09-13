  <?php
		
  $parametros_basicos=str_replace('"',"'",json_encode(array(
  "controlador"=>"Calculos",			    
  "mensaje"=>"este usuario",
  "capa"=>"nueva_nomina",
  "modulo"=>"calculos"					   
  )));
  

  
  $operaciones=array(
      "Cargar"=>str_replace('"',"'",json_encode(array(
						"operacion"=>"CargarNominaCliente",
						"accion"=>"CargarNominaCliente"
						)))
	  );
  

$parametros_especificos=str_replace('"',"'",json_encode(array(
				  "nada"=>"nada"			  
				  )));

  
?>

<h2>Enviar Nómina:</h2>

<label>
  Tipo de Nómina: 
 
  <select name="periodo_nomina" id="periodo_nomina" onchange="javascript:operaciones2.inicializador(<?php echo $parametros_basicos?>,<?php echo $parametros_especificos?>,<?php echo $operaciones['Cargar']?>,'POST');">
  <!--<select name="periodo_nomina" id="periodo_nomina" onchange="javascript:nueva_nomina()">-->
  
    <option value="ninguna" selected="selected" disabled="disabled">Seleccionar...</option>
    <option value="semanal">Semanal</option>
    <option value="catorcenal">Catorcenal</option>
    <option value="quincenal">Quincenal</option>
    <option value="mensual">Mensual</option>
  </select>
  
  
 <!--
  <select name="periodo_nomina" id="periodo_nomina" onchange="javascript:nueva_nomina()">
  
    <option value="ninguna" selected="selected" disabled="disabled">Seleccionar...</option>
    <option value="semanal">Semanal</option>
    <option value="catorcenal">Catorcenal</option>
    <option value="quincenal">Quincenal</option>
    <option value="mensual">Mensual</option>
  </select>
  -->
</label>
<br /><br />

<div id="nueva_nomina"></div>

