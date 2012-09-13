<?php
  if (!isset($_SESSION))
  {
	  session_start();
	  }
	  
	  $parametros=str_replace('"',"'",json_encode(array(
"id_usuario"=>$_SESSION['id_usuario'],
"id_empresa"=>$id_empresa
)));
	  
	  /*
	  desde el controlador,se reciben las siguiente variables:
	  $datosEmpresa
      $datosEmpleados
      $datosEmpleadosImss
	  $cantidadEmpleados
	  $cantidadEmpleadosImss
	  */   
  
  
  
  	    
  
  
  

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- ocultando campos       -->
<link rel="stylesheet" type="text/css" href="../libs/css/ocultando_campos/style_ocultar.css" />
<link rel="stylesheet" type="text/css" href="../libs/css/ocultando_campos/clickmenu.css" />
<!-- ocultando campos                   -->

<script>
$(document).ready(function(e) {

$("#numeroEmpleadosNomina").html("<?php echo "      Empleados:  ".$cantidadEmpleados;?>");

	 /******************************************************************
	$("#menuColumnas").click(function(){
			
			$("#targetcol").modal({containerCss:{
	height:165,
	width: 521
			}
});
			
			});
	
	   
	 listaNoOcultar=[1,2,4,5,8,11,14,16,19,22,25,28,30,35,36,37,38,39,40,41,42,44,45,53,54,56];
		
	
	$('#tableall').columnManager({listTargetID:'targetcol', onClass: 'simpleon', offClass: 'simpleoff', hideInList: listaNoOcultar,//no aparecen en el menu 
									saveState: true, colsHidden: [21,20,19,18,17,16,15,14,13]});//145-13----

	 var opt = {listTargetID: 'targetcol', onClass: 'simpleon', offClass: 'simpleoff',  
            hide: function(c){ 
                $(c).fadeOut(); 
            },  
            show: function(c){ 
                $(c).fadeIn(); 
            }}; 
			
	$("#tableall thead th").click(function(){		
		var columnaAdmin=$(this).index()+1;
		var Procesar=true;
		var posicion;
		
		for(i=0;i<listaNoOcultar.length;i++){
		posicion=listaNoOcultar[i];		
		if(columnaAdmin==posicion){
			Procesar=false;
			break;			
			}			
		}
		if(Procesar){
		$('#tableall').toggleColumns(columnaAdmin, opt);
		$('table.head').toggleColumns(columnaAdmin, opt);
		}				
		});
		
	
   
   
   
   /*******************************************************************/
	
	
	//globales pop up
	var popup=function(){};
	popup.prototype={
		    "columnaAdmin":0,
			"filaAdmin":0,
			"campo":"",
			"empleado":"",
			"mostrar":function(){				
				id=$("output[name='nombreEmpleado[]']");
				this.empleado=id[this.filaAdmin].value;		
				
				}
			}
	p=new popup();
	
	/*
	$("#menuColumnas").mouseover(function(){
		tooltip("Mostrar/Ocultar Columnas")
	});
	
	$("#menuColumnas").mouseout(function(){
		hidetooltip();
		});
		
		$("#tableall thead th").mouseover(function(){
		var columnaAdmin=$(this).index()+1;
		var Procesar=true;
		var posicion;
		
		for(i=0;i<listaNoOcultar.length;i++){
		posicion=listaNoOcultar[i];		
		if(columnaAdmin==posicion){
			Procesar=false;
			break;			
			}			
		}
		if(Procesar){		
		tooltip("De click aquí para ocultar la columna")
		}
		});	
	
	*/
	$("#tableall tbody td").mouseover(function(){
		var columnaAdmin=$(this).index();		
		var campo=$("th:eq("+columnaAdmin+")").html();
		p.columnaAdmin=columnaAdmin;				
		p.campo=campo;
		});
		
	$("#tableall tbody tr").mouseover(function(){
		filaAdmin=$(this).index("#tableall tbody tr");
		p.filaAdmin=filaAdmin;		
		p.mostrar();
		tooltip(p.campo+"<br/>"+p.empleado)
		});
	
	$("#tableall tbody td").mouseout(function(){
		hidetooltip();
		});
	$("#tableall tbody tr").mouseout(function(){
		hidetooltip();
		});
		
	$("#tableall thead th").mouseout(function(){
		hidetooltip();
		});

	

	
	
	$("#tableall input:text").change(function(){	
		idCampo=this.id;	
		calculosClientes.init_calculosNomina(idCampo);
		calculosClientes.extraerID();
		calculosClientes.lanzarOperacion();	
	})
	
	$("#tableall img").click(function(){
		idCampo=this.id		
		calculosClientes.init_calculosNomina(idCampo);
		calculosClientes.extraerID();
		calculosClientes.lanzarOperacion();
		});

	
						
		$("#cancelar").click(function(){
			transaccionesNomina.consultarNominaVistaInicial(<?php echo $parametros;?>,"cuerpoNomina","consultarNominasXEmpresa","POST");
			});
			
			
		$("#guardar").click(function(){
			transaccionesNomina.guardarNominaNueva(<?php echo $parametros;?>,"cuerpoNomina","guardarNominaNueva","POST");
			});
			
		$('#tableall').fixheadertable({
		caption:"",
/* 58 campos
Quitar,Recibo de Nomina,id_empleado,Empleado,Sueldo Diario,Sueldo Diario Imss,Sueldo Diario Fiscal,Dias Trabajados,Sueldo,SueldoImss,
Horas Extras,Total Horas Extras,Total Horas Extras Imss,Domingos Trabajados,Prima Dominical,Prima Dominical Imss,Total Domingos,Total Domingos Imss,Turnos Trabajados,Total Turnos Trabajados,
Total Turnos Trabajados Imss,Descansos Trabajados,Total Descansos Trabajados,Total Descansos Trabajados Imss,Dias Festivos,Total Dias Festivos,Total Dias Festivos Imss,Vacaciones,Prima Vacacional,Prima Vacacional Imss ,
Total Vacaciones,Total Vacaciones Imss,Dias Proporcionales,Aguinaldo,Complemento Sueldo,Otras Percepciones,Otras Percepciones Fiscal,Premio Puntualidad,Premio Asistencia,Despensa,
Becas Educacionales,Isr,Subsidio Empleo,IMSS,Total Percepciones,Total Percepciones Fiscal,-----,Prestamos,Caja de Ahorro,Fonacot,
Infonavit,Otras Deducciones,Prestamo Navitas,Total Deducciones,Total Deducciones Fiscal,-----,TOTAL,TOTAL FISCAL]
*/



/*
50,80,0,200,80,0,0,80,80,0,
80,80,0,80,80,0,80,0,80,80,
0,80,80,0,80,80,0,80,80,0,
80,0,80,80,80,80,0,0,0,0,
0,0,0,0,80,0,80,80,80,80,
80,80,80,80,0,80,80,0
*/
colratio       : [250,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
		                    whiteSpace     : 'normal',		                    							                					
							height : 200, 
							width : 1300, 							
							minWidth :100						
								
							
							
						});
			
		
		
	
		
		
	});
</script>

<!-- ocultando campos       



<link rel="stylesheet" type="text/css" href="../admin/ocultando_campos/style.css" />

<link rel="stylesheet" type="text/css" href="../admin/ocultando_campos/clickmenu.css" />


-->
        

 


     




<!-- ocultando campos                  



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
	
	
	<!-- _____________________________________________ 

	
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
     -->
     
     <style>
	 /**
 * 100% height layout with header and footer
 * ----------------------------------------------
 * Feel free to copy/use/change/improve
 */




div#container2 {
	position:relative; /* needed for footer positioning*/
	margin:0 auto; /* center, not in IE5 */
	/*width:750px;*/
	width:100%;	
	background:#FFF;
	
	height:auto !important; /* real browsers */
	height:100%; /* IE6: treaded as min-height*/

	min-height:100%; /* real browsers */
}

div#header2 {
	/*padding:5px;*/
	background:#FFF;
	/*border-bottom:6px double gray;*/
}
	

div#content2 {
	/*padding:5px; /* bottom padding for footer */
}
	

div#footer2 {
	/*position:absolute;*/
	width:100%;
	bottom:0; /* stick to bottom */
	background:#FFF;
	/*border-top:6px double gray;*/
	
	
}
	
</style>
   
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prenómina</title>
</head>
<body >



<form id="nuevaNomina">

    <input type="hidden" id="estado" name="estado" value="PROCESO"/>
    <input type="hidden" id="id_empresa" name="id_empresa" value="<?php echo $id_empresa;?>" />
    <input type="hidden" id="fecha_captura" name="fecha_captura" value="<?php echo date('Y/m/d'); ?>" />
    <input type="hidden" id="tipoNomina" name="tipoNomina" value="<?php echo $periodo; ?>" />
    <input type="hidden" id="iva_empresa" value="<?php echo $iva; ?>" />  
	<input type="hidden" id="honorarios_empresa" value="<?php echo $honorarios; ?>" />
    
    
    	<div id="container2">

		<div id="header2">
        <table width="682" border="0" cellpadding="0" cellspacing="0" style="display:none">
  <tr>
  
    <td width="124">
    <strong>
    Nómina del periodo:
    </strong>
    </td>
    
    <td width="130">
    <span id="fecha_inicio">
	<input type="text" name="inicio_periodo" id="inicio_periodo" value="<?php echo $inicio_periodo;?>" size="10" onFocus="javascript:calendarioNaranja('inicio_periodo');" />
	 </span>
     <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd&nbsp;/&nbsp;mm&nbsp;/aaa     
     </td>
     
    <td width="22">
    &nbsp;Al&nbsp;
    </td> 
    
    <td width="269">
    <span id="fecha_fin">
	<input type="text" id="fin_periodo" name="fin_periodo" value="<?php echo $fin_periodo;?>" size="10" onFocus="javascript:calendarioNaranja('fin_periodo');" />
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
<!--<img src="../imagenes/ver.png" alt="select columns" title="select columns" align="left" id="menuColumnas"/>-->
		</div>

		<div id="content2">
        <div id="exa">
<table id="tableall" class="bordered">
<thead>
<th style="display:none">id_empleado</th>
<th>Empleado</th>
<th>Sueldo Diario</th>
<th style="display:none">Sueldo Diario Imss</th>
<th style="display:none">Sueldo Diario Fiscal</th>
<th>Dias Trabajados</th>
<th>Sueldo</th>
<th style="display:none">SueldoImss</th>
<th>Horas Extras</th>
<th>Total Horas Extras</th>
<th style="display:none">Total Horas Extras Imss</th>
<th>Domingos Trabajados</th>
<th>Prima Dominical</th>
<th style="display:none">Prima Dominical Imss</th>
<th>Total Domingos</th>
<th style="display:none">Total Domingos Imss</th>
<th>Turnos Trabajados</th>
<th>Total Turnos Trabajados</th>
<th style="display:none">Total Turnos Trabajados Imss</th>
<th>Descansos Trabajados</th>
<th>Total Descansos Trabajados</th>
<th style="display:none">Total Descansos Trabajados Imss</th>
<th>Dias Festivos</th>
<th>Total Dias Festivos</th>
<th style="display:none">Total Dias Festivos Imss</th>
<th>Vacaciones</th>
<th>Prima Vacacional</th>
<th style="display:none">Prima Vacacional Imss </th>
<th>Total Vacaciones</th>
<th style="display:none">Total Vacaciones Imss</th>
<th>Dias Proporcionales</th>
<th>Aguinaldo</th>
<th>Complemento Sueldo</th>
<th>Otras Percepciones</th>
<th style="display:none">Otras Percepciones Fiscal</th>
<th style="display:none">Premio Puntualidad</th>
<th style="display:none">Premio Asistencia</th>
<th style="display:none">Despensa</th>
<th style="display:none">Becas Educacionales</th>
<th style="display:none">Isr</th>
<th style="display:none">Subsidio Empleo</th>
<th style="display:none">IMSS</th>



<th>Total Percepciones</th>
<th style="display:none">Total Percepciones Fiscal</th>
<th></th>
<th>Prestamos</th>
<th>Caja de Ahorro</th>
<th>Fonacot</th>
<th>Infonavit</th>
<th>Otras Deducciones</th>
<th>Prestamo Navitas</th>
<th>Total Deducciones</th>
<th style="display:none">Total Deducciones Fiscal</th>
<th></th>
<th>TOTAL</th>
<th style="display:none">TOTAL FISCAL</th>

</thead>

<?php
while ($row_empleados = $datosEmpleados->fetch())
  {
	  /*
	  creo el id[html] del campo y el valor de dicho campo.
	  excepto aquellos campos que no son necesarios para los calculos: nombre del empleado...etc.
	  
	  */
	  
	 
	 
	  
	  
	  /*VALORES DENTRO DE LOS CAMPOS*/
	  $idEmpleado=$row_empleados['id_empleado'];
	  $nombreEmpleado=$row_empleados['nombre']." ".$row_empleados['ap_paterno']." ".$row_empleados['ap_materno'];
	  $sueldoDiario=$row_empleados['sueldo_diario'];
	  $sueldoDiarioImss=$row_empleados['sueldo_diario_imss'];
	  $sueldoDiarioFiscal=redondear($row_empleados['sueldo_diario_imss']/1.0452);

	   
	  
	  /*ID Y NAME DE LOS CAMPOS, GENERADOS DINAMICAMENTE*/	 
	  $campoIdEmpleado="idEmpleado_".$idEmpleado;
	  $inputcampoIdEmpleado="inputidEmpleado_".$idEmpleado;
	
	  	  
	  $campoIdSueldoDiario="sueldoDiario_".$idEmpleado;
	  $inputcampoIdSueldoDiario="inputsueldoDiario_".$idEmpleado;
	  
	  $campoIdSueldoDiarioFiscal="sueldoDiarioFiscal_".$idEmpleado;
	  $inputcampoIdSueldoDiarioFiscal="inputsueldoDiarioFiscal_".$idEmpleado;
	    
	  $campoIdSueldoDiarioImss="sueldoDiarioImss_".$idEmpleado;
	  $inputcampoIdSueldoDiarioImss="inputsueldoDiarioImss_".$idEmpleado;
	  	  	  
	  $campoIdDiasTrabajados="diasTrabajados_".$idEmpleado;	  
	  
	  $campoSueldoTotal="SueldoTotal_".$idEmpleado;
	  $inputcampoSueldoTotal="inputSueldoTotal_".$idEmpleado;

	  $campoSueldoTotalImss="SueldoTotalImss_".$idEmpleado;	  
	  $inputcampoSueldoTotalImss="inputSueldoTotalImss_".$idEmpleado;

	  $iconoCalculoHorasExtras="ventanaHoraExtra_".$idEmpleado;
	  $campoNumeroHorasExtras="NumeroHorasExtras_".$idEmpleado;
	  $inputcampoNumeroHorasExtras="inputNumeroHorasExtras_".$idEmpleado;

	  $campoTotalHorasExtras="TotalHorasExtras_".$idEmpleado;
	  $inputcampoTotalHorasExtras="inputTotalHorasExtras_".$idEmpleado;
	  
	  $campoTotalHorasExtrasImss="TotalHorasExtrasImss_".$idEmpleado;
	  $inputcampoTotalHorasExtrasImss="inputTotalHorasExtrasImss_".$idEmpleado;
	  
	  $iconoDomingosTrabajados="ventanaDomingoTrabajado_".$idEmpleado;
	  $campoNumeroDomingosTrabajados="NumeroDomingosTrabajados_".$idEmpleado;
	  $inputcampoNumeroDomingosTrabajados="inputNumeroDomingosTrabajados_".$idEmpleado;	  
	  
	  $campoPrimaDominical="PrimaDominical_".$idEmpleado;
	  $inputcampoPrimaDominical="inputPrimaDominical_".$idEmpleado;
	  
	  $campoPrimaDominicalImss="PrimaDominicalImss_".$idEmpleado;
	  $inputcampoPrimaDominicalImss="inputPrimaDominicalImss_".$idEmpleado;

	  $campoTotalDomingos="TotalDomingosTrabajados_".$idEmpleado;
	  $inputcampoTotalDomingos="inputTotalDomingosTrabajados_".$idEmpleado;

	  $campoTotalDomingosImss="TotalDomingosTrabajadosImss_".$idEmpleado;
	  $inputcampoTotalDomingosImss="inputTotalDomingosTrabajadosImss_".$idEmpleado;

	  $campoNumeroTurnosTrabajados="NumeroTurnosTrabajados_".$idEmpleado;
	  $inputcampoNumeroTurnosTrabajados="inputNumeroTurnosTrabajados_".$idEmpleado;
	  
	  $campoTotalTurnos="TotalTurnosTrabajados_".$idEmpleado;
	  $inputcampoTotalTurnos="inputTotalTurnosTrabajados_".$idEmpleado;
	  
	  $campoTotalTurnosImss="TotalTurnosTrabajadosImss_".$idEmpleado;
	  $inputcampoTotalTurnosImss="inputTotalTurnosTrabajadosImss_".$idEmpleado;
	  
	  $campoNumeroDescansosTrabajados="NumeroDescansosTrabajados_".$idEmpleado;
	  $inputcampoNumeroDescansosTrabajados="inputNumeroDescansosTrabajados_".$idEmpleado;
	  
	  $campoTotalDescansosTrabajados="TotalDescansosTrabajados_".$idEmpleado;
	  $inputcampoTotalDescansosTrabajados="inputTotalDescansosTrabajados_".$idEmpleado;
	  
	  $campoTotalDescansosTrabajadosImss="TotalDescansosTrabajadosImss_".$idEmpleado;
	  $inputcampoTotalDescansosTrabajadosImss="inputTotalDescansosTrabajadosImss_".$idEmpleado;
	  
	  $campoNumeroDiasFestivos="NumeroDiasFestivos_".$idEmpleado;
	  $inputcampoNumeroDiasFestivos="inputNumeroDiasFestivos_".$idEmpleado;
	  
	  $campoTotalDiasFestivos="TotalDiasFestivos_".$idEmpleado;
	  $inputcampoTotalDiasFestivos="inputTotalDiasFestivos_".$idEmpleado;

	  $campoTotalDiasFestivosImss="TotalDiasFestivosImss_".$idEmpleado;
	  $inputcampoTotalDiasFestivosImss="inputTotalDiasFestivosImss_".$idEmpleado;
	  
	  $campoNumeroDiasVacaciones="NumeroDiasVacaciones_".$idEmpleado;
	  $inputcampoNumeroDiasVacaciones="inputNumeroDiasVacaciones_".$idEmpleado;

	  $campoPrimaVacacional="PrimaVacacional_".$idEmpleado;
	  $inputcampoPrimaVacacional="inputPrimaVacacional_".$idEmpleado;

	  $campoPrimaVacacionalImss="PrimaVacacionalImss_".$idEmpleado;
	  $inputcampoPrimaVacacionalImss="inputPrimaVacacionalImss_".$idEmpleado;
	  
	  $campoTotalVacaciones="TotalVacaciones_".$idEmpleado;
	  $inputcampoTotalVacaciones="inputTotalVacaciones_".$idEmpleado;
	  
	  $campoTotalVacacionesImss="TotalVacacionesImss_".$idEmpleado;
	  $inputcampoTotalVacacionesImss="inputTotalVacacionesImss_".$idEmpleado;
	  
	  $campoAguinaldo="aguinaldo_".$idEmpleado;
	  $campoComplementoSueldo="complementoSueldo_".$idEmpleado;
	  $campoOtrasPercepciones="otrasPercepciones_".$idEmpleado;
	  $campoOtrasPercepcionesFiscal="otrasPercepcionesFiscal_".$idEmpleado;
	  
	  $campoPremioPuntualidad="premioPuntualidad_".$idEmpleado;
	  $inputcampoPremioPuntualidad="inputpremioPuntualidad_".$idEmpleado;
	  
	  $campoPremioAsistencia="premioAsistencia_".$idEmpleado;
	  $inputcampoPremioAsistencia="inputpremioAsistencia_".$idEmpleado;
	  
	  $campoDespensa="despensa_".$idEmpleado;
	  $inputcampoDespensa="inputdespensa_".$idEmpleado;
	  
	  $campoBecasEducacionales="becasEducacionales_".$idEmpleado;
	  $inputcampoBecasEducacionales="inputbecasEducacionales_".$idEmpleado;
	  
	  $campoISR="ISR_".$idEmpleado;
	  $inputcampoISR="inputISR_".$idEmpleado;
	  
	  $campoSubsidio="SUBSIDIO_".$idEmpleado;
	  $inputcampoSubsidio="inputSUBSIDIO_".$idEmpleado;
	  
	  $campoIMSS="IMSS_".$idEmpleado;
	  $inputcampoIMSS="inputIMSS_".$idEmpleado;
	  
	  $campoTotalPercepciones="TotalPercepciones_".$idEmpleado;
	  $campoTotalPercepcionesFiscal="TotalPercepcionesFiscal_".$idEmpleado;
	  
	  $iconoCalculoTurnoTrabajado="ventanaTurnoTrabajado_".$idEmpleado;
	  $iconoCalculoDescansoTrabajados="ventanaDescansoTrabajado_".$idEmpleado;
	  $iconoCalculoDiasFestivos="ventanaDiasFestivos_".$idEmpleado;
	  $iconoCalculoVacaciones="ventanaVacaciones_".$idEmpleado;
	  
	  $campoPrestamo="prestamo_".$idEmpleado;
	  $campoCajaAhorro="cajaAhorro_".$idEmpleado;
	  $campoFonacot="fonacot_".$idEmpleado;
	  $campoInfonavit="infonavit_".$idEmpleado;
	  $iconoCalculoOtrasDeducciones="ventanaOtrasDeducciones_".$idEmpleado;
	  
	  $campoOtrasDeducciones="otrasDeducciones_".$idEmpleado;	  	  
	  $inputcampoOtrasDeducciones="inputotrasDeducciones_".$idEmpleado;

	  $campoDescripcionOtrasDeducciones="descripcionOtrasDeducciones_".$idEmpleado;
	  $inputcampoDescripcionOtrasDeducciones="inputdescripcionOtrasDeducciones_".$idEmpleado;
	  
	  $campoPrestamoNavitas="prestamoNavitas_".$idEmpleado;
	  
	  $campoTotalDeducciones="totalDeducciones_".$idEmpleado;
	  $campoTotalDeduccionesFiscal="totalDeduccionesFiscal_".$idEmpleado;
	  
	  $campoTOTAL="totalNominaEmpleado_".$idEmpleado;	  	  
	  $inputcampoTOTAL="inputtotalNominaEmpleado_".$idEmpleado;
	  
	  $campoTOTALFISCAL="totalNominaEmpleadoFiscal_".$idEmpleado;
	  $inputcampoTOTALFISCAL="inputtotalNominaEmpleadoFiscal_".$idEmpleado;

	  $campoTOTALPERCEPCIONES="TOTALPERCEPCIONES";
	  $campoTOTALPERCEPCIONESFISCAL="TOTALPERCEPCIONESFISCAL";
	  $campoTOTALDEDUCCIONES="TOTALDEDUCCIONES";
	  $campoTOTALDEDUCCIONESFISCAL="TOTALDEDUCCIONESFISCAL";
	  $campoTOTALNOMINA="TOTALNOMINA";
	  $campoTOTALNOMINAFISCAL="TOTALNOMINAFISCAL";
	  
	  $NominaPercepciones="percepciones";	  	  
	  $inputNominaPercepciones="inputpercepciones";
	 
	  $NominaHonorarios="honorarios";
	  $inputNominaHonorarios="inputhonorarios";
	  
	  $NominaRelativos="relativos";
	  $inputNominaRelativos="inputrelativos";

	  $NominaSubtotal="subtotal";
	  $inputNominaSubtotal="inputsubtotal";

	  $NominaIva="iva";
	  $inputNominaIva="inputiva";
	  
	  $NominaFactura="factura";
	  $inputNominaFactura="inputfactura";
	  
	  
	  
	  
	  ?>
      <tbody>
<tr>

<td style="display:none">
<output id="<?php echo $campoIdEmpleado;?>" name="idEmpleado[]"><?php echo $idEmpleado;?></output>
<input type="checkbox" checked="checked" id="<?php echo $inputcampoIdEmpleado;?>" name="idEmpleado[]" value="<?php echo $idEmpleado;?>"/>
</td>

<td>
<output name="nombreEmpleado[]" ><?php echo $nombreEmpleado;?></output>
</td>

<td>
<output id="<?php echo $campoIdSueldoDiario;?>" name="<?php echo $campoIdSueldoDiario;?>"><?php echo $sueldoDiario;?></output>
<input type="hidden" id="<?php echo $inputcampoIdSueldoDiario;?>" name="<?php echo $inputcampoIdSueldoDiario;?>" value="<?php echo $sueldoDiario;?>"/>
</td>

<td style="display:none">
<output id="<?php echo $campoIdSueldoDiarioImss;?>" name="<?php echo $campoIdSueldoDiarioImss;?>"><?php echo $sueldoDiarioImss;?></output>
<input type="hidden" id="<?php echo $inputcampoIdSueldoDiarioImss;?>" name="<?php echo $inputcampoIdSueldoDiarioImss;?>" value="<?php echo $sueldoDiarioImss;?>" />
</td>

<td style="display:none">
<output id="<?php echo $campoIdSueldoDiarioFiscal;?>" name="<?php echo $campoIdSueldoDiarioFiscal;?>"><?php echo $sueldoDiarioFiscal;?></output>
<input type="hidden" id="<?php echo $inputcampoIdSueldoDiarioFiscal;?>" name="<?php echo $inputcampoIdSueldoDiarioFiscal;?>" value="<?php echo $sueldoDiarioFiscal;?>" />
</td>

<td>
<input type="text" id="<?php echo $campoIdDiasTrabajados;?>" name="<?php echo $campoIdDiasTrabajados;?>" value="0" size="5"/>
</td>

<td>
<output id="<?php echo $campoSueldoTotal;?>" name="<?php echo $campoSueldoTotal;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoSueldoTotal;?>" name="<?php echo $inputcampoSueldoTotal;?>" value="0" />
</td>

<td style="display:none">
    <output id="<?php echo $campoSueldoTotalImss;?>" name="<?php echo $campoSueldoTotalImss;?>">0</output>
    <input type="hidden" id="<?php echo $inputcampoSueldoTotalImss;?>" name="<?php echo $inputcampoSueldoTotalImss;?>" value="0" />
    </td>

<td>
    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoHorasExtras;?>" />   
    <output id="<?php echo $campoNumeroHorasExtras;?>" name="<?php echo $campoNumeroHorasExtras;?>">0</output>
    <input type="hidden" id="<?php echo $inputcampoNumeroHorasExtras;?>" name="<?php echo $inputcampoNumeroHorasExtras;?>" value="0" />
    </td>
    
<td>
<output id="<?php echo $campoTotalHorasExtras;?>" name="<?php echo $campoTotalHorasExtras;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalHorasExtras;?>" name="<?php echo $inputcampoTotalHorasExtras;?>" value="0"/>
</td>

<td style="display:none">
<output id="<?php echo $campoTotalHorasExtrasImss;?>" name="<?php echo $campoTotalHorasExtrasImss;?>">0</output> 
<input type="hidden" id="<?php echo $inputcampoTotalHorasExtrasImss;?>" name="<?php echo $inputcampoTotalHorasExtrasImss;?>" value="0" />
</td>

<td>
    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoDomingosTrabajados;?>" />
    <output id="<?php echo $campoNumeroDomingosTrabajados;?>" name="<?php echo $campoNumeroDomingosTrabajados;?>">0</output>
    <input type="hidden" id="<?php echo $inputcampoNumeroDomingosTrabajados;?>" name="<?php echo $inputcampoNumeroDomingosTrabajados;?>" value="0" />
    </td>
    
<td>
<output id="<?php echo $campoPrimaDominical;?>" name="<?php echo $campoPrimaDominical;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoPrimaDominical;?>" name="<?php echo $inputcampoPrimaDominical;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoPrimaDominicalImss;?>" name="<?php echo $campoPrimaDominicalImss;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoPrimaDominicalImss;?>" name="<?php echo $inputcampoPrimaDominicalImss;?>" value="0" />
</td>

<td>
<output id="<?php echo $campoTotalDomingos;?>" name="<?php echo $campoTotalDomingos;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalDomingos;?>" name="<?php echo $inputcampoTotalDomingos;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoTotalDomingosImss;?>" name="<?php echo $campoTotalDomingosImss;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalDomingosImss;?>" name="<?php echo $inputcampoTotalDomingosImss;?>" value="0" />
</td>

<td>
    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoTurnoTrabajado;?>" />   
    <output id="<?php echo $campoNumeroTurnosTrabajados;?>" name="<?php echo $campoNumeroTurnosTrabajados;?>">0</output>
    <input type="hidden" id="<?php echo $inputcampoNumeroTurnosTrabajados;?>" name="<?php echo $inputcampoNumeroTurnosTrabajados;?>" value="0" />
    </td>
    
<td>
<output id="<?php echo $campoTotalTurnos;?>" name="<?php echo $campoTotalTurnos;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalTurnos;?>" name="<?php echo $inputcampoTotalTurnos;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoTotalTurnosImss;?>" name="<?php echo $campoTotalTurnosImss;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalTurnosImss;?>" name="<?php echo $inputcampoTotalTurnosImss;?>" value="0" />
</td>

<td>
    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoDescansoTrabajados;?>" />   
    <output id="<?php echo $campoNumeroDescansosTrabajados;?>" name="<?php echo $campoNumeroDescansosTrabajados;?>">0</output>
    <input type="hidden" id="<?php echo $inputcampoNumeroDescansosTrabajados;?>" name="<?php echo $inputcampoNumeroDescansosTrabajados;?>" value="0" />
    </td>
    
<td>
<output id="<?php echo $campoTotalDescansosTrabajados;?>" name="<?php echo $campoTotalDescansosTrabajados;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalDescansosTrabajados;?>" name="<?php echo $inputcampoTotalDescansosTrabajados;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoTotalDescansosTrabajadosImss;?>" name="<?php echo $campoTotalDescansosTrabajadosImss;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalDescansosTrabajadosImss;?>" name="<?php echo $inputcampoTotalDescansosTrabajadosImss;?>" value="0" />
</td>

<td>
    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoDiasFestivos;?>" />   
    <output id="<?php echo $campoNumeroDiasFestivos;?>" name="<?php echo $campoNumeroDiasFestivos;?>">0</output>
    <input type="hidden" id="<?php echo $inputcampoNumeroDiasFestivos;?>" name="<?php echo $inputcampoNumeroDiasFestivos;?>" value="0" />
    </td>
    
<td>
<output id="<?php echo $campoTotalDiasFestivos;?>" name="<?php echo $campoTotalDiasFestivos;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalDiasFestivos;?>" name="<?php echo $inputcampoTotalDiasFestivos;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoTotalDiasFestivosImss;?>" name="<?php echo $campoTotalDiasFestivosImss;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalDiasFestivosImss;?>" name="<?php echo $inputcampoTotalDiasFestivosImss;?>" value="0" />
</td>

<td>
    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoVacaciones;?>" />   
    <output id="<?php echo $campoNumeroDiasVacaciones;?>" name="<?php echo $campoNumeroDiasVacaciones;?>">0</output>
    <input type="hidden" id="<?php echo $inputcampoNumeroDiasVacaciones;?>" name="<?php echo $inputcampoNumeroDiasVacaciones;?>" value="0" />
    </td>
    
<td>
<output id="<?php echo $campoPrimaVacacional;?>" name="<?php echo $campoPrimaVacacional;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoPrimaVacacional;?>" name="<?php echo $inputcampoPrimaVacacional;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoPrimaVacacionalImss;?>" name="<?php echo $campoPrimaVacacionalImss;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoPrimaVacacionalImss;?>" name="<?php echo $inputcampoPrimaVacacionalImss;?>" value="0" />
</td>

<td>
<output id="<?php echo $campoTotalVacaciones;?>" name="<?php echo $campoTotalVacaciones;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalVacaciones;?>" name="<?php echo $inputcampoTotalVacaciones;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoTotalVacacionesImss;?>" name="<?php echo $campoTotalVacacionesImss;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTotalVacacionesImss;?>" name="<?php echo $inputcampoTotalVacacionesImss;?>" value="0" />
</td>

<td>
<output>0</output>
</td>

<td>
<input type="text" id="<?php echo $campoAguinaldo;?>" name="<?php echo $campoAguinaldo;?>" value="0" size="5" />
</td>

<td>
<input type="text" id="<?php echo $campoComplementoSueldo;?>" name="<?php echo $campoComplementoSueldo;?>" value="0" size="5" />
</td>

<td>
<input type="text" id="<?php echo $campoOtrasPercepciones;?>" name="<?php echo $campoOtrasPercepciones;?>" value="0" size="5" />
</td>

<td style="display:none">
<output id="<?php echo $campoOtrasPercepcionesFiscal;?>" name="<?php echo $campoOtrasPercepcionesFiscal;?>">0</output>
</td>

<td style="display:none">
<output id="<?php echo $campoPremioPuntualidad;?>" name="<?php echo $campoPremioPuntualidad;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoPremioPuntualidad;?>" name="<?php echo $inputcampoPremioPuntualidad;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoPremioAsistencia;?>" name="<?php echo $campoPremioAsistencia;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoPremioAsistencia;?>" name="<?php echo $inputcampoPremioAsistencia;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoDespensa;?>" name="<?php echo $campoDespensa;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoDespensa;?>" name="<?php echo $inputcampoDespensa;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoBecasEducacionales;?>" name="<?php echo $campoBecasEducacionales;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoBecasEducacionales;?>" name="<?php echo $inputcampoBecasEducacionales;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoISR;?>" name="<?php echo $campoISR;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoISR;?>" name="<?php echo $inputcampoISR;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoSubsidio;?>" name="<?php echo $campoSubsidio;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoSubsidio;?>" name="<?php echo $inputcampoSubsidio;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoIMSS;?>" name="<?php echo $campoIMSS;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoIMSS;?>" name="<?php echo $inputcampoIMSS;?>" value="0"/>
</td>

<td>
<output id="<?php echo $campoTotalPercepciones;?>" name="<?php echo $campoTotalPercepciones;?>">0</output></td>

<td style="display:none">
<output id="<?php echo $campoTotalPercepcionesFiscal;?>" name="<?php echo $campoTotalPercepcionesFiscal;?>">0</output></td>

<td></td>

<td>
<input type="text" id="<?php echo $campoPrestamo;?>" name="<?php echo $campoPrestamo;?>" value="0" size="5"/>
</td>

<td>
<input type="text" id="<?php echo $campoCajaAhorro;?>" name="<?php echo $campoCajaAhorro;?>" value="0" size="5"/>
</td>

<td>
<input type="text" id="<?php echo $campoFonacot;?>" name="<?php echo $campoFonacot;?>" value="0"size="5" />
</td>

<td>
<input type="text" id="<?php echo $campoInfonavit;?>" name="<?php echo $campoInfonavit;?>" value="<?php if ($row_empleados['infonavit']==""){echo "0";}else{echo $row_empleados['infonavit']; }; ?>" size="5"/>
</td>

<td>
    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoOtrasDeducciones;?>" />   
    <output id="<?php echo $campoOtrasDeducciones;?>" name="<?php echo $campoOtrasDeducciones;?>">0</output>
    <input type="hidden" id="<?php echo $inputcampoOtrasDeducciones;?>" name="<?php echo $inputcampoOtrasDeducciones;?>" value="0" />
    <label>Descripción
    <output id="<?php echo $campoDescripcionOtrasDeducciones;?>" name="<?php echo $campoDescripcionOtrasDeducciones;?>">0</output>
    <input type="hidden" id="<?php echo $inputcampoDescripcionOtrasDeducciones;?>" name="<?php echo $inputcampoDescripcionOtrasDeducciones;?>" value="0" />
    </label>
</td>

<td>
<input type="text" id="<?php echo $campoPrestamoNavitas;?>" name="<?php echo $campoPrestamoNavitas;?>" value="0" size="5" />
</td>

<td>
<output id="<?php echo $campoTotalDeducciones;?>" name="<?php echo $campoTotalDeducciones;?>">0</output></td>

<td style="display:none">
<output id="<?php echo $campoTotalDeduccionesFiscal;?>" name="<?php echo $campoTotalDeduccionesFiscal;?>">0</output></td>

<td></td>

<td>
<output id="<?php echo $campoTOTAL;?>" name="<?php echo $campoTOTAL;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTOTAL;?>" name="<?php echo $inputcampoTOTAL;?>" value="0" />
</td>

<td style="display:none">
<output id="<?php echo $campoTOTALFISCAL;?>" name="<?php echo $campoTOTALFISCAL;?>">0</output>
<input type="hidden" id="<?php echo $inputcampoTOTALFISCAL;?>" name="<?php echo $inputcampoTOTALFISCAL;?>" value="0" />
</td>
    
</tr>
<?php }?>
</tbody>
<tfoot>
<tr>
<td colspan="22">&nbsp;</td>
<td>
  <output id="<?php echo $campoTOTALPERCEPCIONES;?>">0</output>
</td>

<td style="display:none">
<output id="<?php echo $campoTOTALPERCEPCIONESFISCAL;?>">0</output>
</td>

<td></td>
<td colspan="6"></td>

<td><output id="<?php echo $campoTOTALDEDUCCIONES;?>">0</output></td>

<td style="display:none"><output id="<?php echo $campoTOTALDEDUCCIONESFISCAL;?>">0</output></td>

<td></td>


<td><output id="<?php echo $campoTOTALNOMINA;?>">0</output></td>

<td style="display:none"><output id="<?php echo $campoTOTALNOMINAFISCAL;?>">0</output></td>

</tr>
</tfoot>

</table>




 

      



</div>
			
		</div>

		<div id="footer2">
        <table>
        
        <tr>
        <td rowspan="2"> <label>Observaciones</label><br /><textarea name="observaciones" id="observaciones" cols="60" rows="12"></textarea></td>
        <td></td>
        <td>
        <table>
        <tr>

<td>PERCEPCIONES:</td>
<td>
<output id="<?php echo $NominaPercepciones;?>" name="<?php echo $NominaPercepciones;?>">0</output>
<input type="hidden" id="<?php echo $inputNominaPercepciones;?>" name="<?php echo $inputNominaPercepciones;?>" value="0" />
</td>
<td colspan="2">&nbsp;</td>
<td>HONORARIOS:</td>
<td>
<output id="<?php echo $NominaHonorarios;?>" name="<?php echo $NominaHonorarios;?>">0</output>
<input type="hidden" id="<?php echo $inputNominaHonorarios;?>" name="<?php echo $inputNominaHonorarios;?>" value="0" />
</td>
<td colspan="2">&nbsp;</td>
<td>RELATIVOS:</td>
<td>
<output id="<?php echo $NominaRelativos;?>" name="<?php echo $NominaRelativos;?>">0</output>
<input type="hidden" id="<?php echo $inputNominaRelativos;?>" name="<?php echo $inputNominaRelativos;?>" value="0" />
</td>
<td colspan="2">&nbsp;</td>
<td>SUBTOTAL:</td>
<td>
<output id="<?php echo $NominaSubtotal;?>" name="<?php echo $NominaSubtotal;?>">0</output>
<input type="hidden" id="<?php echo $inputNominaSubtotal;?>" name="<?php echo $inputNominaSubtotal;?>" value="0" />
</td>
<td colspan="2">&nbsp;</td>
<td>IVA:</td>
<td>
<output id="<?php echo $NominaIva;?>"  name="<?php echo $NominaIva;?>">0</output>
<input type="hidden" id="<?php echo $inputNominaIva;?>"  name="<?php echo $inputNominaIva;?>" value="0" />
</td>
<td colspan="2">&nbsp;</td>
<td>TOTAL FACTURA:</td>
<td>
<output id="<?php echo $NominaFactura;?>" name="<?php echo $NominaFactura;?>" >0</output>
<input type="hidden" id="<?php echo $inputNominaFactura;?>" name="<?php echo $inputNominaFactura;?>" value="0" />
</td>

</tr>
        </table>
        
        <br />
        
        <table>
        <tr>
        <td>
        <input type="button" name="guardar" id="guardar" value="Enviar Nomina" />
        <input type="button" name="cancelar" id="cancelar" value="Cancelar"/>
        </td>
        </tr>
        </table>
        </td>
        </tr>
        
        <tr>
        <td></td>
        <td></td>
        </tr>
        
        </table>
       
        
        
        
        	
        <div>
        

</div>		
		</div>
	</div>

   











</form>

<div id="menuColumnasOcultas" style="visibility:hidden"> 
        <div id="targetcol" class="target" ></div>       
        <div class="clear"></div>
        </div>    


</body>
</html>