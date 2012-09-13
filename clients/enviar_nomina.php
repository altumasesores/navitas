<?php
  if (!isset($_SESSION))
  {
	  session_start();
	  
	  } 
 
  include_once("../admin/empleado_clase.php");
  include_once("../admin/empresa_clase.php");
  
  $objEmpresa = new cEmpresa();
  $objEmpleado = new cEmpleado();
  
   $periodo= $_POST['periodo'];
   $id_empresa= $_SESSION['id_empresa'];
  
   //Creamos el objeto 
  $listaEmpresas= $objEmpresa->consultaIdEmpresa($id_empresa);//Consulto todas las empresas 
  $listaEmpleados= $objEmpleado->consultar_empleados_periodo($id_empresa, $periodo);//Consulto todas los empleados
  $listaEmpleados_imss= $objEmpleado->consultar_empleados_periodo_imss($id_empresa, $periodo);//Consulto todas los empleados
  
  $num_rows = mysql_num_rows($listaEmpleados); 
  $num_rows_Afiliados = mysql_num_rows($listaEmpleados_imss);
    
    
  
  
  
  	    
   while ($row_empresa = mysql_fetch_assoc($listaEmpresas))
   {
	   $iva=$row_empresa['iva'];
	   $honorarios=	$row_empresa['honorarios'];
	   
	   }        
  
  

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- ocultando campos       -->



<link rel="stylesheet" type="text/css" href="../admin/ocultando_campos/style.css" />

<link rel="stylesheet" type="text/css" href="../admin/ocultando_campos/clickmenu.css" />



        

 


     




<!-- ocultando campos                   -->



<script>
$(document).ready(function()
{
	
	
	/*$('.myTable01').fixedHeaderTable({ width: '600', height: '400', footer: true, cloneHeadToFoot: true, altClass: 'odd', themeClass: 'fancyTable', autoShow: false });
    
    $('.myTable01').fixedHeaderTable('show', 1000);*/
    
   // $('.myTable02').fixedHeaderTable({ width: '600', height: '250', footer: true, altClass: 'odd', themeClass: 'fancyDarkTable' });
    
   // $('.myTable03').fixedHeaderTable({ width: '400', height: '400', altClass: 'odd', footer: true, themeClass: 'fancyDarkTable' });
    
	/*$('a.makeTable').bind('click', function() {
		

		$('.myTable01').fixedHeaderTable('destroy');
		
		$('.myTable01 th, .myTable01 td')
			.css('border', $('#border').val() + 'px solid ' + $('#color').val());
			
		$('.myTable01').fixedHeaderTable({ width: $('#width').val(), height: $('#height').val(), footer: true, themeClass: 'fancyTable' });
	});*/
	
	
	<!-- _____________________________________________ -->

	
	 $('#ulSelectColumn').clickMenu({onClick: function(){}}); 
	
	$('#tableall').columnManager({listTargetID:'targetall', onClass: 'advon', offClass: 'advoff', hideInList: [1,2], 
									saveState: true, colsHidden: [13,14,15,16,17,18,19,20,21]});//145-13

	 var opt = {listTargetID: 'targetall', onClass: 'advon', offClass: 'advoff',  
            hide: function(c){ 
                $(c).fadeOut(); 
            },  
            show: function(c){ 
                $(c).fadeIn(); 
            }}; 
			
			
   $('#ocultar_sueldo_diario').click(function(){ $('#tableall').toggleColumns(3, opt); });
   $('#ocultar_dias_trabajados').click(function(){ $('#tableall').toggleColumns(4, opt); });
   $('#ocultar_sueldo').click(function(){ $('#tableall').toggleColumns(5, opt); });
   $('#ocultar_horas_extras').click(function(){ $('#tableall').toggleColumns(6, opt); });
   $('#ocultar_total_he').click(function(){ $('#tableall').toggleColumns(7, opt); });
   $('#ocultar_domingos_t').click(function(){ $('#tableall').toggleColumns(8, opt); });
   $('#ocultar_prima_dom').click(function(){ $('#tableall').toggleColumns(9, opt); });
   $('#ocultar_total_dt2').click(function(){ $('#tableall').toggleColumns(10, opt); });
  
   $('#ocultar_turnos_t').click(function(){ $('#tableall').toggleColumns(11, opt); });
   $('#ocultar_total_tb').click(function(){ $('#tableall').toggleColumns(12, opt); });
   $('#ocultar_descansos_t').click(function(){ $('#tableall').toggleColumns(13, opt); });
   $('#ocultar_total_dt').click(function(){ $('#tableall').toggleColumns(14, opt); });
   $('#ocultar_dias_f').click(function(){ $('#tableall').toggleColumns(15, opt); });
   $('#ocultar_total_dias_f').click(function(){ $('#tableall').toggleColumns(16, opt); });
   $('#ocultar_vacaciones').click(function(){ $('#tableall').toggleColumns(17, opt); });
   $('#ocultar_prima_d').click(function(){ $('#tableall').toggleColumns(18, opt); });
   $('#ocultar_total_v').click(function(){ $('#tableall').toggleColumns(19, opt); });
   $('#ocultar_aguinaldo').click(function(){ $('#tableall').toggleColumns(20, opt); });
   $('#ocultar_complemento_s').click(function(){ $('#tableall').toggleColumns(21, opt); });
   $('#ocultar_otras_p').click(function(){ $('#tableall').toggleColumns(22, opt); });
   $('#ocultar_total_per').click(function(){ $('#tableall').toggleColumns(23, opt); });
  
   $('#ocultar_prestamos').click(function(){ $('#tableall').toggleColumns(25, opt); });
   $('#ocultar_caja_ahorro').click(function(){ $('#tableall').toggleColumns(26, opt); });
   $('#ocultar_fonacot').click(function(){ $('#tableall').toggleColumns(27, opt); });
   $('#ocultar_infonavit').click(function(){ $('#tableall').toggleColumns(28, opt); });
   $('#ocultar_otras_d').click(function(){ $('#tableall').toggleColumns(29, opt); });
   $('#ocultar_prestamo_n').click(function(){ $('#tableall').toggleColumns(30, opt); });
   $('#ocultar_total_de').click(function(){ $('#tableall').toggleColumns(31, opt); });
   $('#ocultar_total').click(function(){ $('#tableall').toggleColumns(33, opt); });

	
});
	</script>
    
   
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prenómina</title>
<style type="text/css"> 
	#root_hora{ position:fixed!important; z-index:3; } 
	#root_domingos{ position:fixed!important; z-index:3; } 
	#root_turnos{ position:fixed!important; z-index:3; } 
	#root_descansos{ position:fixed!important; z-index:3; } 
	#root_festivos{ position:fixed!important; z-index:3; } 
	#root_vacaciones{ position:fixed!important; z-index:3; } 
</style>
</head>
<body >
	<input type="hidden" id="id_nomina" />
	<input type="hidden" id="estado" value="PROCESO" />
    <input type="hidden" id="fecha_captura" value="<?php echo date('Y/m/d'); ?>" />
    <input type="hidden" id="periodo" value="<?php echo $periodo; ?>" />    
	<input type="hidden" id="iva_empresa" value="<?php echo $iva; ?>" />
	<input type="hidden" id="honorarios_empresa" value="<?php echo $honorarios; ?>" />
   
<table width="682" border="0" cellpadding="0" cellspacing="0">
  <tr>
  
    <td width="124">
    <strong>
    Nómina del periodo:
    </strong>
    </td>
    
    <td width="130">
    <span id="fecha_inicio">
	<input type="text" name="day" id="dia_inicio" size="10" onFocus="javascript:calendarioNaranja('dia_inicio');" >
	 </span>
     <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa     
     </td>
     
    <td width="22">
    &nbsp;Al&nbsp;
    </td> 
    
    <td width="269">
    <span id="fecha_fin">
	<input type="text" id="dia_final" size="10" onFocus="javascript:calendarioNaranja('dia_final');" >
	</span>
    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa 
    </td>
    
  </tr>
  
  <tr>
    <td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>

</table>


<br/>

<div id="exa">
<table class=""  border="0" cellspacing="2" cellpadding="1" id="tableall">
<thead>
<tr style="display:none">
<td  bgcolor="#00CCFF">&nbsp;</td>
    <td  bgcolor="#00CCFF">&nbsp;Empleado</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Sueldo Diario </td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Dias Trabajados</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Sueldo</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Horas extras</td>
    <td bgcolor="#00CCFF" align="center">Total H.E.</td>
    <td bgcolor="#00CCFF" align="center">Domingos trabajados</td>
    <td bgcolor="#00CCFF" align="center">Prima Dominical</td>
    <td bgcolor="#00CCFF" align="center">Total D.T.</td>
   

    <td bgcolor="#00CCFF" align="center">Turnos trabajados</td>
    <td bgcolor="#00CCFF" align="center">Total Turnos Trab.</td>
    <td bgcolor="#00CCFF" align="center">Descansos Trabajados</td>
    <td bgcolor="#00CCFF" align="center">Total Descansos Trab.</td>
    <td bgcolor="#00CCFF" align="center">Dias Festivos</td>
    <td bgcolor="#00CCFF" align="center">Total Dias Festivos</td>
    <td bgcolor="#00CCFF" align="center">Vacaciones</td>
    <td bgcolor="#00CCFF" align="center">Prima Vacacional</td>
    <td bgcolor="#00CCFF" align="center">Total vac.</td>
    <td bgcolor="#00CCFF" align="center">Aguinaldo.</td>
    <td bgcolor="#00CCFF" align="center">Complemento Sueldo</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Otras Percepciones</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    
    
    <td bgcolor="#99FF99" align="center">&nbsp;Prestamos</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Caja Ahorro</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Fonacot</td>
    <td bgcolor="#99FF99" align="center">Infonavit</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Otras deducciones</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Prestamo navitas</td>
    <td bgcolor="#99FF99" align="center">&nbsp;Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#FF3300" align="center">&nbsp;TOTAL</td>
</tr>
  <tr>
  
   <td id="thSelectColumn"  style="background:#00CCFF">
   <label>M&aacute;s columnas</label>
   <ul id="ulSelectColumn" class="clickMenu">
     <li>
       <img src="../imagenes/ver.png" alt="select columns" title="select columns" align="left"/>
       
         <ul id="targetall">
           <li>
           </li>
         </ul>
   
     </li>
   </ul>
   </td>
   
    <td colspan="1" align="left" bgcolor="#BDBDBD"><b>Total Empleados:</b></td>
    <td  align="left" bgcolor="#D8D8D8" ><?php echo $num_rows; ?></td>
    
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td  colspan="1" align="left" bgcolor="#BDBDBD"><b>Total Empleados Asegurados:</b></td>
    <td  align="left" bgcolor="#D8D8D8"><?php echo $num_rows_Afiliados; ?></td>
    
  </tr>
  
  <tr>
  <td></td>
    <td colspan="22" align="center" bgcolor="#0099CC">PERCEPCIONES</td>
    <td  align="center">&nbsp;</td>
    <td colspan="7" align="center" bgcolor="#99FF66">DEDUCCIONES</td>
    <td  align="center">&nbsp;</td>
    <td  align="center" bgcolor="#FF3300">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td align="center" bgcolor="#0099CC">&nbsp;</td>
    
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_sueldo_diario" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Sueldo Diario&#39;);" onmouseout="hidetooltip()" />
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_dias_trabajados" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Dias Trabajados&#39;);" onmouseout="hidetooltip()" />
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_sueldo" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Sueldo&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_horas_extras" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Horas Extras&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_he" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Horas Extras&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_domingos_t" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Domingos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_prima_dom" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Prima Dominical&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_dt2" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Domingos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_turnos_t" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Turnos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_tb" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Turnos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_descansos_t" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Descansos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_dt" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Descansos Trabajados&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_dias_f" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Dias Festivos&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_dias_f" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Dias Festivos&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_vacaciones" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Vacaciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_prima_d" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Prima Vacacional&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_v" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Vacaciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_aguinaldo" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Aguinaldo&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_complemento_s" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Complemento Sueldo&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_otras_p" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Otras Percepciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#0099CC">
    <img id="ocultar_total_per" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Percepciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td  align="center">&nbsp;</td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_prestamos" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Prestamos&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_caja_ahorro" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Caja de Ahorro&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_fonacot" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Fonacot&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_infonavit" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Infonavit&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_otras_d" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Otras Deducciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_prestamo_n" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Prestamo Navitas&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td align="center" bgcolor="#99FF66">
    <img id="ocultar_total_de" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar Total Deducciones&#39;);" onmouseout="hidetooltip()"/>
    </td>
    <td  align="center">&nbsp;</td>
    <td  align="center" bgcolor="#FF3300">
    <img id="ocultar_total" src="images/menos.png" onmouseover="tooltip(&#39;Ocultar TOTAL&#39;);" onmouseout="hidetooltip()"/>
    </td>
  </tr>
  
  <tr nowrap="nowrap">
    <td >&nbsp;</td>
    <td  bgcolor="#00CCFF">&nbsp;Empleado</td>
    <td bgcolor="#00CCFF" align="center">Sueldo Diario</td>
    <td bgcolor="#00CCFF" align="center">Dias Trabajados</td>
    <td bgcolor="#00CCFF" align="center">Sueldo</td>
    <td bgcolor="#00CCFF" align="center">Horas extras</td>
    <td bgcolor="#00CCFF" align="center">Total H.E.</td>
    <td bgcolor="#00CCFF" align="center">Domingos trabajados</td>
    <td bgcolor="#00CCFF" align="center">Prima Dominical</td>
    <td bgcolor="#00CCFF" align="center">Total D.T.</td>
    

   

    <td bgcolor="#00CCFF" align="center">Turnos trabajados</td>
    <td bgcolor="#00CCFF" align="center"> Total Turnos Trab.</td>
    <td bgcolor="#00CCFF" align="center">Descansos Trabajados</td>
    <td bgcolor="#00CCFF" align="center">Total Descansos Trab.</td>
    <td bgcolor="#00CCFF" align="center"> Dias Festivos</td>
    <td bgcolor="#00CCFF" align="center">Total Dias Festivos</td>
    <td bgcolor="#00CCFF" align="center">    Vacaciones</td>
    <td bgcolor="#00CCFF" align="center">    Prima Vacacional</td>
    <td bgcolor="#00CCFF" align="center">    Total vac.</td>
    <td bgcolor="#00CCFF" align="center">    Aguinaldo.</td>
    <td bgcolor="#00CCFF" align="center">    Complemento Sueldo</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Otras Percepciones</td>
    <td bgcolor="#00CCFF" align="center">&nbsp;Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
   
    
    <td bgcolor="#99FF99" align="center">    Prestamos</td>
    <td bgcolor="#99FF99" align="center">Caja Ahorro</td>
    <td bgcolor="#99FF99" align="center">Fonacot</td>
    <td bgcolor="#99FF99" align="center">Infonavit</td>
    <td bgcolor="#99FF99" align="center">Otras deducciones</td>
    <td bgcolor="#99FF99" align="center">Prestamo navitas</td>
    <td bgcolor="#99FF99" align="center">Total</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#FF3300" align="center">TOTAL</td>
  </tr>
  
  </thead>
  
  <!--
     $('#ocultar_sueldo_diario
   $('#ocultar_dias_trabajados
   $('#ocultar_sueldo
   $('#ocultar_horas_extras
   $('#ocultar_total_he
   $('#ocultar_domingos_t
   $('#ocultar_prima_dom
   $('#ocultar_total_dt
  
   $('#ocultar_turnos_t
   $('#ocultar_total_tb
   $('#ocultar_descansos_t
   $('#ocultar_total_dt
   $('#ocultar_dias_f
   $('#ocultar_total_dias_f
   $('#ocultar_vacaciones
   $('#ocultar_prima_d
   $('#ocultar_total_v
   $('#ocultar_aguinaldo
   $('#ocultar_complemento_s
   $('#ocultar_otras_p
   $('#ocultar_total_per
  
   $('#ocultar_prestamos
   $('#ocultar_caja_ahorro
   $('#ocultar_fonacot
   $('#ocultar_infonavit
   $('#ocultar_otras_d
   $('#ocultar_prestamo_n
   $('#ocultar_total_de
   $('#ocultar_total
  -->
  
  

  <?php 
  

  
  
  
  
  
	while ($row_empleados = mysql_fetch_assoc($listaEmpleados))
	{ 
	
   $tooltip_sueldo_diario="Sueldo Diario:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_dias_trabajados="Dias Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_sueldo="Sueldo:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_horas_extras="Horas Extra:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_he="Total Horas Extra:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_domingos_t="Domingos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_prima_dom="Prima Dominical:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_dt="Total Domingos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
  
   $tooltip_turnos_t="Turnos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_tb="Total Turnos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_descansos_t="Descansos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_dt="Total Descansos Trabajados:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_dias_f="Dias Festivos:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_dias_f="Total Dias Festivos:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_vacaciones="Vacaciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_prima_d="Prima Vacacional:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_v="Total Vacaciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_aguinaldo="Aguinaldo:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_complemento_s="Complemento Sueldo:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_otras_p="Otras Percepciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_per="Total Percepciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
  
   $tooltip_prestamos="Prestamos:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_caja_ahorro="Caja Ahorro:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_fonacot="Fonacot:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_infonavit="Infonavit:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_otras_d="Otras Deducciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_desc_otras_d="Descripci&oacute;n Otras Deducciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_prestamo_n="Prestamo Navitas:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total_de="Total Deducciones:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
   $tooltip_total="TOTAL:<br/>".$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
	
	
	
  
  ?>  

  <tr>
    <td nowrap="nowrap">&nbsp;</td>
  
	<input type="hidden" name="id_empleado[]" value="<?php echo $row_empleados['id_empleado']; ?>" />
    <input  
    name="sueldo_integrado_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden" 
    id="sueldo_integrado_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['sueldo_diario_imss']; ?>" 
    size="5" 
    maxlength="10" 
    />
    
    <td nowrap="nowrap">
   <?php echo $row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno']; ?>	
    </td>
    
    <td  align="center">
    <input  
    name="sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo $row_empleados['sueldo_diario']; ?>" 
    size="5" 
    maxlength="10"
    onmouseover="tooltip(&#39;<?php echo $tooltip_sueldo_diario;?>&#39;);" 
    onmouseout="hidetooltip()" 
    />
   
    <input  
    name="sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden" 
    id="sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="<?php echo ($row_empleados['sueldo_diario_imss']/1.0452); ?>" 
    size="5" 
    maxlength="10" 
    />
    </td>
    
    <td nowrap="nowrap" align="center">   
    <input 
    name="dias_trabajados_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="dias_trabajados_<?php echo $row_empleados['id_empleado']; ?>" 
    size="5" 
    maxlength="10" 
    onchange="
              javascript:calcular_sueldo( 
                                         'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                         'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'dias_trabajados_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>',
                                         'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>' 
                                         );    
                         calcular_total_percepciones(
                                                      'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                                      ); 
                                          
                         calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );     
                         calcular_total_deducciones(
                                                    'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'fonacot_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'total_empleado_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                    ); 
                         calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ); "
                                                       
 
 onmouseover="tooltip(&#39;<?php echo  $tooltip_dias_trabajados;?>&#39;);" 
 onmouseout="hidetooltip()" 
    /></td>
    
    <td align="right" nowrap="nowrap"> 
    <input type="text" 
    id="total_sueldo_<?php echo $row_empleados['id_empleado']; ?>" 
    name="total_sueldo_<?php echo $row_empleados['id_empleado']; ?>"
    onchange="
              javascript:calcular_total_percepciones(
                                                      'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                      'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                                      'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                                      ); 
                                          
                         calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );     
                         calcular_total_deducciones(
                                                    'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'fonacot_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                    'total_empleado_<?php echo $row_empleados['id_empleado']; ?>', 
                                                    'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                    ); 
                         calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );" 
                                                       readonly="readonly"
                          
                         value="0"  
                         size="5"
                         onmouseover="tooltip(&#39;<?php echo $tooltip_sueldo;?>&#39;);" 
                         onmouseout="hidetooltip()" 
                         
                         />
                         
                         
                         
                         <input  type="hidden"
                          id="total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>" 
                          name="total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>"    
                          disabled="disabled" 
                          value="0"  
                          size="5"
                         />
                         
                         </td>
                         
    <td align="center" nowrap="nowrap">
    <input 
    type="checkbox" 
    name="chk_hora_extra_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_hora_extra_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_hora_extra(
                                           'chk_hora_extra_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                           'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                           '<?php echo $row_empleados['id_empleado']; ?>' 
                                           ); 
                                         "/>
    <input 
    name="cantidad_horas_extras_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_horas_extras_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" size="5"
     onmouseover="tooltip(&#39;<?php echo $tooltip_horas_extras;?>&#39;);" 
                         onmouseout="hidetooltip()"    
    />
    <input 
    name="cantidad_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="hidden"
    id="cantidad_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0"    
    />
    </td>
    
    
    <td align="center" nowrap="nowrap"><label>
      <input 
      name="total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>" 
      type="text" 
      id="total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>" 
      onfocus="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );
                                          " 
    value="0"
    size="5"
     onmouseover="tooltip(&#39;<?php echo $tooltip_total_he;?>&#39;);" 
                         onmouseout="hidetooltip()"   />
    </label>
    
    <input 
    name="total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="hidden" 
    id="total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>"  
    value="0" size="5"  />
    </td>
    
    
    <td align="center" nowrap="nowrap">
    <input 
    type="checkbox" 
    name="chk_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    onclick="
             javascript:mostrar_domingos(
                                         'chk_domingos_<?php echo $row_empleados['id_empleado']; ?>',
                                         'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                         'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                         '<?php echo $row_empleados['id_empleado']; ?>'
                                         );"
                                         />
    <input 
    name="cantidad_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_domingos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"
    onmouseover="tooltip(&#39;<?php echo $tooltip_domingos_t;?>&#39;);" 
                         onmouseout="hidetooltip()"   />    
    
    <input 
    name="cantidad_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="hidden" 
    id="cantidad_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>
    
    
    
    
    <td>
    <input 
          name="prima_dominical_<?php echo $row_empleados['id_empleado']; ?>" 
          type="text" 
          id="prima_dominical_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
          size="5" 
          maxlength="10"
           onmouseover="tooltip(&#39;<?php echo $tooltip_prima_dom;?>&#39;);" 
                         onmouseout="hidetooltip()"
          />
          
          <input 
          name="prima_dominical_imss_<?php echo $row_empleados['id_empleado']; ?>" 
           type="hidden" 
          id="prima_dominical_imss_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
          size="5" 
          maxlength="10"
          />
    </td>
    <td align="center" nowrap="nowrap">
    <input 
    name="total_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="total_domingos_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0"  
    size="5" 
    maxlength="10" 
    onfocus="javascript:      calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          ); "
                                          
                                          onmouseover="tooltip(&#39;<?php echo $tooltip_total_dt;?>&#39;);" 
                         onmouseout="hidetooltip()"   
                                          />
                                          
                                          <input 
                                          name="total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
                                           type="hidden" 
                                          id="total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
                                          value="0"  
                                          size="5" 
                                          maxlength="10" />
                                          </td>


    <td align="center" nowrap="nowrap">
    <input 
    type="checkbox" 
    name="chk_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_turnos_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_turnos(
                                       'chk_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                       'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                       'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                       'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                       'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                        '<?php echo $row_empleados['id_empleado']; ?>' ); 
                                         "/>
    <input 
    name="cantidad_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_turnos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"    
    onmouseover="tooltip(&#39;<?php echo $tooltip_turnos_t;?>&#39;);" 
    onmouseout="hidetooltip()" 
    />
     <input 
    name="cantidad_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    t type="hidden" 
    id="cantidad_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>
    
    
    <td align="center" nowrap="nowrap">
    <input 
    name="total_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" id="total_turnos_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    maxlength="10" 
    onfocus="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );
                                          "
                                           onmouseover="tooltip(&#39;<?php echo $tooltip_total_tb;?>&#39;);" 
    onmouseout="hidetooltip()"  />
                                          
                                          
                                          <input 
    name="total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    type="hidden" id="total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    maxlength="10" 
    />
    </td>
                                          
    <td align="center" nowrap="nowrap">
    <input 
    type="checkbox" 
    name="chk_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_descansos_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_descansos(
                                          'chk_descansos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                          'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          '<?php echo $row_empleados['id_empleado']; ?>' 
                                          );"/>
                                          
    <input 
    name="cantidad_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_descansos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"
    onmouseover="tooltip(&#39;<?php echo $tooltip_descansos_t;?>&#39;);" 
    onmouseout="hidetooltip()"    
    />
    
     <input 
    name="cantidad_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="hidden"
    id="cantidad_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>
    
    <td align="center" nowrap="nowrap">
    <input 
    name="total_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="total_descansos_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    maxlength="10" 
    onfocus="
             javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          ); "
                                          
                                           onmouseover="tooltip(&#39;<?php echo $tooltip_total_dt;?>&#39;);" 
    onmouseout="hidetooltip()"
                                           />
                                          
                                          
                                          <input 
    name="total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="hidden" 
    id="total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    maxlength="10" 
   />
                                          </td>
                                          
    <td align="center" nowrap="nowrap">
    <input 
    type="checkbox" 
    name="chk_festivos_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_festivos_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_festivos(
                                         'chk_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'total_festivos_<?php echo $row_empleados['id_empleado']; ?>',
                                         'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                         'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                         'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                         '<?php echo $row_empleados['id_empleado']; ?>' 
                                         ); 
                                         "/>
    <input 
    name="cantidad_festivos_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_festivos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"
    onmouseover="tooltip(&#39;<?php echo $tooltip_dias_f;?>&#39;);" 
                         onmouseout="hidetooltip()"      
    />
    
    <input 
    name="cantidad_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="hidden"
    id="cantidad_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>
    
    <td align="center" nowrap="nowrap"><input name="total_festivos_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="total_festivos_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" onfocus="javascript:    calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );    "
                                          onmouseover="tooltip(&#39;<?php echo $tooltip_total_dias_f;?>&#39;);" 
                         onmouseout="hidetooltip()" />
                                          
                                          
                                          
      <input name="total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>"  type="hidden" id="total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" />
                                          
                                          
                                          </td>
    
    
    
    
    <td align="center" nowrap="nowrap">
    <input 
    type="checkbox" 
    name="chk_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_vacaciones_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="javascript:mostrar_vacaciones(
                                           'chk_vacaciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                           'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                           'sueldo_diario_<?php echo $row_empleados['id_empleado']; ?>',
                                           'sueldo_diario_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                           '<?php echo $row_empleados['id_empleado']; ?>');" 
    />
    <input 
    name="cantidad_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="cantidad_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5"    
    onmouseover="tooltip(&#39;<?php echo $tooltip_vacaciones;?>&#39;);" 
                         onmouseout="hidetooltip()"  
    />
    
     <input 
    name="cantidad_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" 
     type="hidden" 
    id="cantidad_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0"    
    />
    </td>   
  
    
    
                                          
                                         
                                         
                                          
                                          
  
 
    
    
    
    <td>
     <input 
          name="prima_vacacional_<?php echo $row_empleados['id_empleado']; ?>" 
          type="text" 
          id="prima_vacacional_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
          size="5" 
          maxlength="10"
           onmouseover="tooltip(&#39;<?php echo $tooltip_prima_d;?>&#39;);" 
                         onmouseout="hidetooltip()" 
     />
     
       <input 
          name="prima_vacacional_imss_<?php echo $row_empleados['id_empleado']; ?>" 
           type="hidden" 
          id="prima_vacacional_imss_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
          size="5" 
          maxlength="10" 
     />
    </td>
    
    
    
    <td align="center" nowrap="nowrap">
    <input name="total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" onfocus="javascript:    calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );    "
                                          onmouseover="tooltip(&#39;<?php echo $tooltip_total_v;?>&#39;);" 
                         onmouseout="hidetooltip()"  />
                                          
                                          <input name="total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>"  type="hidden" id="total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" />
                                          
                                          </td>
    
    
    <td>
      <input 
          name="aguinaldo_<?php echo $row_empleados['id_empleado']; ?>" 
          type="text" 
          id="aguinaldo_<?php echo $row_empleados['id_empleado']; ?>" 
          value="0" 
          size="5" 
          maxlength="10"
          onfocus="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;
                                                    "
                                                    
          onchange="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;
                                                     "
                                                     onmouseover="tooltip(&#39;<?php echo $tooltip_aguinaldo;?>&#39;);" 
                         onmouseout="hidetooltip()"
                                                     /></td>
    
    
    <td align="center" nowrap="nowrap">
    <input 
    name="complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    maxlength="10" 
    onfocus="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;
                                                    "
                                                    
    onchange="javascript:calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;
                                                     "
                                                     onmouseover="tooltip(&#39;<?php echo $tooltip_complemento_s;?>&#39;);" 
                         onmouseout="hidetooltip()"/></td>
    <td align="center" nowrap="nowrap"><label>
      <input name="otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>" type="text" id="otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>" value="0" size="5" maxlength="10" onfocus="javascript:    calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          )
                                          ;    " 
      onchange="javascript:    calcular_total_percepciones(
                                          'total_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_<?php echo $row_empleados['id_empleado']; ?>'
                                          ),
                                          calcular_total_percepciones(
                                          'total_sueldo_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_horas_extras_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_domingos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_turnos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_descansos_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'total_festivos_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_vacaciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                          'aguinaldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'complemento_sueldo_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'otras_percepciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>', 
                                          'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>'
                                          );    "
                                          onmouseover="tooltip(&#39;<?php echo $tooltip_otras_p;?>&#39;);" 
                         onmouseout="hidetooltip()"
                                           />
    </label></td>
    <td align="right" nowrap="nowrap">
    <input id="total_percepciones_<?php echo $row_empleados['id_empleado']; ?>" name="total_percepciones[]" value="0" readonly="readonly" size="5" 
    onmouseover="tooltip(&#39;<?php echo $tooltip_total_per;?>&#39;);" 
                         onmouseout="hidetooltip()"/>
    <input  type="hidden" id="total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>" name="total_percepciones_imss[]" value="0" disabled="disabled" size="5" />
    </td>
    <td nowrap="nowrap">&nbsp;&nbsp;&nbsp;</td>
    
    <!--SECCION DE LAS DEDUCCIONES -->
    
    
    <td align="center" nowrap="nowrap"><label>
      <input 
      name="prestamos_<?php echo $row_empleados['id_empleado']; ?>" 
      type="text" 
      id="prestamos_<?php echo $row_empleados['id_empleado']; ?>" 
      value="0" 
      size="5" 
      onchange="
                 javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );"
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_prestamos;?>&#39;);" 
                         onmouseout="hidetooltip()"    />
    </label></td>
    <td align="center" nowrap="nowrap"><label>
    <input 
    name="caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    onchange="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );"
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_caja_ahorro;?>&#39;);" 
                         onmouseout="hidetooltip()"
                                                    />
    </label></td>
    <td align="center" nowrap="nowrap"><label>
    <input 
    name="fonacot_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="fonacot_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    onchange="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );"
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_fonacot;?>&#39;);" 
                         onmouseout="hidetooltip()" 
                                                    />
    </label></td>
    
    <td align="center" nowrap="nowrap">
    <input 
    name="infonavit_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="infonavit_<?php echo $row_empleados['id_empleado']; ?>"  
    size="5" 
    onchange="
             javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );" 
                                                   value="<?php echo $row_empleados['infonavit']; ?>"
                                                   onmouseover="tooltip(&#39;<?php echo $tooltip_infonavit;?>&#39;);" 
                         onmouseout="hidetooltip()"   
                                                   /></td>
    <td align="center" nowrap="nowrap"><label>
    <input 
    type="checkbox" 
    name="chk_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    id="chk_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>"  
    onclick="
             javascript:mostrar_otras_deducciones(
                                       'chk_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>',                     
                                        '<?php echo $row_empleados['id_empleado']; ?>' ); 
                                         "/>
    <input 
    name="otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5" 
    readonly="readonly"
    onchange="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );" 
      onfocus="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );"
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_otras_d;?>&#39;);" 
                         onmouseout="hidetooltip()"   
                                                    />
                                                    &nbsp;&nbsp;&nbsp;Descripci&oacute;n
                                                     <input 
    name="descripcion_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="descripcion_ot_deducciones_<?php echo $row_empleados['id_empleado']; ?>" 
    value="" 
    size="5"
    maxlength="30"
    readonly="readonly"
     onmouseover="tooltip(&#39;<?php echo $tooltip_desc_otras_d;?>&#39;);" 
                         onmouseout="hidetooltip()"  />
    </label></td>
    <td align="center" nowrap="nowrap"><label>
    <input 
    name="prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>" 
    type="text" 
    id="prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>" 
    value="0" 
    size="5"
    onchange="
              javascript:calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                        'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       ),
                                                       calcular_total_deducciones(
                                                       'prestamos_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'caja_ahorro_<?php echo $row_empleados['id_empleado']; ?>', 
                                                       'fonacot_<?php echo $row_empleados['id_empleado']; ?>',                                                       'otras_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'prestamo_ascon_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_percepciones_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_deducciones_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>',
                                                       'infonavit_<?php echo $row_empleados['id_empleado']; ?>'
                                                       );"
                                                       onmouseover="tooltip(&#39;<?php echo $tooltip_prestamo_n;?>&#39;);" 
                         onmouseout="hidetooltip()"  
                                                    />      
    </label></td>
    <td align="right" nowrap="nowrap">
    <input name="total_deducciones[]" type="text" id="total_deducciones_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="0" readonly="readonly" onmouseover="tooltip(&#39;<?php echo $tooltip_total_de;?>&#39;);" 
                         onmouseout="hidetooltip()"   /></td>
    
    <td nowrap="nowrap">&nbsp;&nbsp;&nbsp;</td>
    <td align="right" nowrap="nowrap">
    <input name="total_empleado[]" type="text" id="total_empleado_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="0" readonly="readonly" onmouseover="tooltip(&#39;<?php echo $tooltip_total;?>&#39;);" 
                         onmouseout="hidetooltip()"   />
    
    <input name="total_empleado_imss[]"  type="hidden" id="total_empleado_imss_<?php echo $row_empleados['id_empleado']; ?>" size="5" value="0" disabled="disabled" />
    </td>

  
  
  
  
    </tr>
  <?php } ?>
  
  
  
  
  
  
  
  
  <tr>
    <td>&nbsp;</td>

    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

    <td>&nbsp;</td>
  
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>

    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Perc.:</td>
    <td>
    <input id="total_percepciones_nomina" name="total_percepciones_nomina" value="0" disabled="disabled" size="5" />
    <input  type="hidden" id="total_percepciones_nomina_imss" name="total_percepciones_nomina_imss" value="0" disabled="disabled" size="5" />
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Ded:</td>
    <td>
    <input name="total_deducciones_nomina" type="text" id="total_deducciones_nomina" size="5" value="0" disabled="disabled"/>
    <input name="total_deducciones_nomina_imss"  type="hidden" id="total_deducciones_nomina_imss" size="5" value="0" disabled="disabled"/>    </td>
    <td>&nbsp;&nbsp;Total:&nbsp;</td>
    <td align="right">
    <input name="total_empleados_nomina" type="text" id="total_empleados_nomina" size="5" value="0" disabled="disabled" />
    <input name="total_empleados_nomina_imss"  type="hidden" id="total_empleados_nomina_imss" size="5" value="0" disabled="disabled" />
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="10" valign="top"><label>Observaciones:
        <br />
        <textarea name="observaciones" id="observaciones" cols="60" rows="12"></textarea>
    </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6"><br />
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="54%">PERCEPCIONES:</td>
          <td align="right" width="46%"><input type="text" id="percepciones" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>HONORARIOS:</td>
          <td align="right"><input type="text" id="honorarios" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>RELATIVOS:</td>
          <td align="right"><input type="text" id="relativos" 
                                                            onchange="javascript:calcular_total_percepciones_nomina();" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>SUBTOTAL:</td>
          <td align="right"><input type="text" id="subtotal" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>IVA:</td>
          <td align="right"><input type="text" id="iva" value="0" size="5" readonly="readonly" /></td>
        </tr>
        <tr>
          <td>TOTAL FACTURA:</td>
          <td align="right"><input type="text" id="total_factura" value="0" size="5" readonly="readonly" /></td>
        </tr>
      </table>
    <p>
      <label><br />
        <input type="button" name="guardar" id="guardar" value="Enviar Nomina"   onclick="javascript:guardar_nomina('<?php echo $id_empresa; ?>')"/>
      </label>
      <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="javascript:cargarPagina('consultar_nominas.php','mainContent')" />
    </p>
    
    <br/>
        <div id="alerta_nomina"></div>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>

</div>

<p>&nbsp;</p>
<p>&nbsp;</p>




<!-- -->

<!-----------------------------Ventana flotante de horas extras ----------------------------------------->
<div 
class="root"  
id="root_hora" 
style="left:37%;top:42%;display:none;"   
onclick="
        javascript:Drag.init(document.getElementById('handle_hora'), 
                   document.getElementById('root_hora'))" > 

<div  
class="handle" 
id="handle_hora" 
style="display:none;"   
onclick="
         javascript:Drag.init(document.getElementById('handle_hora'), 
                    document.getElementById('root_hora'))">Horas extras</div> 
   &nbsp; &nbsp;  No. horas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  sueldo<br/>
   
	&nbsp; (<input name="no_horas" id="no_horas" type="text" size="5" maxlength="10" />
    &nbsp;*&nbsp;<input name="sueldo_hora" id="sueldo_hora" type="text" size="5" maxlength="10" />)
    &nbsp;*&nbsp;<input name="sueldo_hora_imss" id="sueldo_hora_imss" type="hidden"  size="5" maxlength="10" />
    <input name="factor" id="factor" type="text" size="5" maxlength="10" value="2"/><br/>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
               <input type="hidden"  id="id_total_he" />
  <input type="hidden"  id="id_total_he_imss" />
               <input type="hidden"  id="id_checkbox" />
               
<input type="button" id="calcular_horas_extras" value="Calcular" onclick="javascript:calcular_horas_extras();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_horas_extras" value="Cancelar" onclick="javascript:cerrarDiv('root_hora','handle_hora'); cancelar_hora_extra();" />
</div> 
   


<!----------------------------------------Ventana flotante de domingos trabajados ------------------------------>



<div class="root"  id="root_domingos" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_domingos'), document.getElementById('root_domingos'))" > 

<div  class="handle" id="handle_domingos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_domingos'), document.getElementById('root_domingos'))">Domingos Trabajados</div> 
   &nbsp; &nbsp; Domingos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sueldo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Prima dom.(25%)<br/>
   
	&nbsp;&nbsp;(<input name="no_domingos" id="no_domingos" type="text" size="5" maxlength="10" /> 
    &nbsp;*&nbsp;<input name="sueldo_domingos" id="sueldo_domingos" type="text" size="5" maxlength="10" />)
    <input name="sueldo_domingos_imss" id="sueldo_domingos_imss" type="hidden"  size="5" maxlength="10" />
    &nbsp;  +  &nbsp;   Prima Dominical (25%) <br/>
    
			     <input type="hidden" id="id_total_domingos" />
                 <input type="hidden" id="id_total_domingos_imss" />
  <input type="hidden" id="id_checkbox" />
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
              <input type="button" id="calcular_domingos" value="Calcular" onclick="javascript:calcular_domingos();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_domingos_trabajados" value="Cancelar" onclick="javascript:cerrarDiv('root_domingos','handle_domingos'); cancelar_domingos();" />
</div> 



<!--------------------------------------Ventana flotante de turnos trabajados ----------------------------------------->


<div class="root"  id="root_turnos" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_turnos'), document.getElementById('root_turnos'))" > 

<div  class="handle" id="handle_turnos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_turnos'), document.getElementById('root_turnos'))">Turnos Trabajados</div> 
   &nbsp; &nbsp;  No. turnos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  sueldo<br/>
   
	&nbsp; <input name="no_turnos" id="no_turnos" type="text" size="5" maxlength="10" value="1" />
    &nbsp;*&nbsp;<input name="sueldo_turnos" id="sueldo_turnos" type="text" size="5" maxlength="10" />
   <input name="sueldo_turnos_imss" id="sueldo_turnos_imss" type="hidden"  size="5" maxlength="10" />
    <br/>
     		<input type="hidden"  id="id_total_turnos" />
            <input type="hidden"  id="id_total_turnos_imss" />
               <input type="hidden" id="id_checkbox" />
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
<input type="button" id="calcular_turnos" value="Calcular" onclick="javascript:calcular_turnos();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_turnos" value="Cancelar" onclick="javascript:cerrarDiv('root_turnos','handle_turnos'); cancelar_turnos();" />
</div>




<!------------------------------------------Ventana flotante de descansos trabajados  -------------------------------->


<div class="root"  id="root_descansos" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_descansos'), document.getElementById('root_descansos'))" > 

<div  class="handle" id="handle_descansos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_descansos'), document.getElementById('root_descansos'))">Descansos Trabajados</div> 
   &nbsp; &nbsp; No.Descansos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sueldo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  factor<br/>
   
	&nbsp; 
		(<input name="no_descansos" id="no_descansos" type="text" size="5" maxlength="10" />
         &nbsp;*&nbsp;
        <input name="sueldo_descansos" id="sueldo_descansos" type="text" size="5" maxlength="10" />)
        <input name="sueldo_descansos_imss" id="sueldo_descansos_imss" type="hidden"  size="5" maxlength="10" />
    &nbsp;*&nbsp;<input name="factor_descansos" id="factor_descansos" type="text" size="5" maxlength="10" value="2"/><br/>
    			<input type="hidden"  id="id_total_descansos" />
                <input type="hidden"  id="id_total_descansos_imss" />
                <input type="hidden" id="id_checkbox" />
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
  <input type="button" id="calcular_descansos" value="Calcular" onclick="javascript:calcular_descansos();"/>
                          &nbsp;&nbsp; 
  <input type="button" id="cancelar_descansos_trabajados" value="Cancelar" onclick="javascript:cerrarDiv('root_descansos','handle_descansos'); cancelar_descansos();" />
</div>


<!-----------------------------------------------Ventana flotante de Dias festivos---------------------------------------->
<div class="root"  id="root_festivos" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_festivos'), document.getElementById('root_festivos'))" > 

<div  class="handle" id="handle_festivos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_festivos'), document.getElementById('root_festivos'))">Dias Festivos</div> 
   &nbsp; &nbsp;  No. Dias &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sueldo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; factor<br/>
   
	&nbsp; 
    
    (<input name="no_festivos" id="no_festivos" type="text" size="5" maxlength="10" />
      &nbsp;*&nbsp;
		<input name="sueldo_festivos" id="sueldo_festivos" type="text" size="5" maxlength="10" /> )
        <input name="sueldo_festivos_imss" id="sueldo_festivos_imss" type="hidden"  size="5" maxlength="10" />
    &nbsp;*&nbsp;<input name="factor_festivos" id="factor_festivos" type="text" size="5" maxlength="10" value="2"/><br/>
    
	    <input type="hidden" id="id_total_festivos" />
         <input type="hidden" id="id_total_festivos_imss" />
               	<input type="hidden" id="id_checkbox" />
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
              <input type="button" id="calcular_festivos" value="Calcular" onclick="javascript:calcular_festivos();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_festivos" value="Cancelar" onclick="javascript:cerrarDiv('root_festivos','handle_festivos'); cancelar_festivos();" />
</div>



<!------------------------------------------------Ventana flotante de Vacaciones ------------------------------------->


<div class="root"  id="root_vacaciones" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_vacaciones'), document.getElementById('root_vacaciones'))" > 

<div  class="handle" id="handle_vacaciones" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_vacaciones'), document.getElementById('root_vacaciones'))">Vacaciones</div> 
   &nbsp; &nbsp;  No. Dias &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  sueldo<br/>
   
	&nbsp; (<input name="no_dias_vac" id="no_dias_vac" type="text" size="5" maxlength="10" />
    &nbsp;*&nbsp;<input name="sueldo_vacaciones" id="sueldo_vacaciones" type="text" size="5" maxlength="10" />)
    <input name="sueldo_vacaciones_imss" id="sueldo_vacaciones_imss" type="hidden"  size="5" maxlength="10" />
    &nbsp;+&nbsp;Prima Vacacional (25%)<br/>
    <input type="hidden" id="id_total_vacaciones" />
    <input type="hidden" id="id_total_vacaciones_imss" />
                   	<input type="hidden" id="id_checkbox" />
    
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
              <input type="button" id="calcular_vacaciones" value="Calcular" onclick="javascript:calcular_vacaciones();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_vacaciones" value="Cancelar" onclick="javascript:cerrarDiv('root_vacaciones','handle_vacaciones'); cancelar_vacaciones();" />
</div>







<div class="root"  id="root_ot_deducciones" style="left:37%;top:42%;display:none;"   
onclick="javascript:Drag.init(document.getElementById('handle_ot_deducciones'), document.getElementById('root_festivos'))" > 

<div  class="handle" id="handle_festivos" style="display:none;"   onclick="javascript:Drag.init(document.getElementById('handle_festivos'), document.getElementById('root_festivos'))">Dias Festivos</div> 
   &nbsp; &nbsp;  Descripción: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<br/>
   
	&nbsp; 
    
    <input name="descripcion_ot_deducciones" id="descripcion_ot_deducciones" type="text" size="20" maxlength="30" style="height:30px"/>
      &nbsp;*&nbsp;
		<input name="cantidad_ot_deducciones" id="cantidad_ot_deducciones" type="text" size="5"  maxlength="10" /> 
       <br/>
    
	   
    
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               
              <input type="button" id="calcular_festivos" value="Aceptar" onclick="javascript:aceptar_ot_deducciones();"/>
                          &nbsp;&nbsp; 
              <input type="button" id="cancelar_festivos" value="Cancelar" onclick="javascript:cancelar_otras_deducciones();" />
</div>
</body>
</html>