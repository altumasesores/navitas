<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head>





<!-- ocultando campos       -->

<link rel="stylesheet" type="text/css" href="../libs/css/ocultando_campos/style_ocultar.css" />

<link rel="stylesheet" type="text/css" href="../libs/css/ocultando_campos/clickmenu.css" />

<!-- ocultando campos                   -->



 <style>

	 /**

 * 100% height layout with header and footer

 * ----------------------------------------------

 * Feel free to copy/use/change/improve

 */















div#container2 {

	text-align:left;

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

	padding:1em;

	background:#FFF;

	text-align:left;

	/*border-bottom:6px double gray;*/

}

	



div#content2 {

	padding:1em 1em; /* bottom padding for footer */

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

<title>Portal de Atención a Clientes Navitas SA de CV</title>



<script>

$(document).ready(function(e) {

	

	naturalezaBusqueda={

	"eliminarHoras":"img",

	"eliminarDomingos":"img",

	"eliminarTurnos":"img",

	"eliminarDescansos":"img",

	"eliminarFestivos":"img",

	"eliminarVacaciones":"img",

	"eliminarAguinaldo":"input:visible",

	"eliminarComplemento":"input:visible",

	"eliminarOtpercepciones":"input:visible",

	"eliminarPrestamos":"input:visible",	

	"eliminarCAhorro":"input:visible",	

	"eliminarFonacot":"input:visible",	

	"eliminarInfonavit":"input:visible",

	"eliminarOtDeducciones":"img",

	"eliminarPrestamo":"input:visible"

	

	

	}

	

	

Campos={

		"eliminarHoras":[

		             "NumeroHorasExtras_",

					 "TotalHorasExtras_",

					 "TotalHorasExtrasImss_",

					 "inputNumeroHorasExtras_",

					 "inputTotalHorasExtras_",

					 "inputTotalHorasExtrasImss_"

					 ],

		"eliminarDomingos":[

		                    "NumeroDomingosTrabajados_",

							"PrimaDominical_",

							"PrimaDominicalImss_",

							"TotalDomingosTrabajados_",

							"TotalDomingosTrabajadosImss_",

							"inputNumeroDomingosTrabajados_",

							"inputPrimaDominical_",

							"inputPrimaDominicalImss_",

							"inputTotalDomingosTrabajados_",

							"inputTotalDomingosTrabajadosImss_"

							],

		"eliminarTurnos":[

		                  "NumeroTurnosTrabajados_",

						  "TotalTurnosTrabajados_",

						  "TotalTurnosTrabajadosImss_",

						  "inputNumeroTurnosTrabajados_",

						  "inputTotalTurnosTrabajados_",

						  "inputTotalTurnosTrabajadosImss_"

						  ],

		"eliminarDescansos":[

		                     "NumeroDescansosTrabajados_",

							 "TotalDescansosTrabajados_",

							 "TotalDescansosTrabajadosImss_",

							 "inputNumeroDescansosTrabajados_",

							 "inputTotalDescansosTrabajados_",

							 "inputTotalDescansosTrabajadosImss_"

							 ],

		"eliminarFestivos":[

		              "NumeroDiasFestivos_",

					  "TotalDiasFestivos_",

					  "TotalDiasFestivosImss_",

					  "inputNumeroDiasFestivos_",

					  "inputTotalDiasFestivos_",

					  "inputTotalDiasFestivosImss_"

					  ],

		"eliminarVacaciones":[

		            "NumeroDiasVacaciones_",

					"PrimaVacacional_",

					"PrimaVacacionalImss_",

					"TotalVacaciones_",

					"TotalVacacionesImss_",

					"inputNumeroDiasVacaciones_",

					"inputPrimaVacacional_",

					"inputPrimaVacacionalImss_",

					"inputTotalVacaciones_",

					"inputTotalVacacionesImss_"

					],

		"eliminarAguinaldo":["aguinaldo_"],

		"eliminarComplemento":["complementoSueldo_"],

		"eliminarOtpercepciones":["otrasPercepciones_"],

		"eliminarPrestamos":["prestamo_"],	

	    "eliminarCAhorro":["cajaAhorro_"],	

	    "eliminarFonacot":["fonacot_"],	

	    "eliminarInfonavit":["infonavit_"],

	    "eliminarOtDeducciones":[

		                         "otrasDeducciones_",

								 "inputotrasDeducciones_",

								 "descripcionOtrasDeducciones_",

								 "inputdescripcionOtrasDeducciones_"

								 ],

	    "eliminarPrestamo":["prestamoNavitas_"]

					

		

					  		

			

		}





	

	

	  

	   

	 

	   listaNoOcultar=[1,2,3,4,6,7,10,13,16,18,21,24,27,30,32,37,38,39,40,41,42,43,44,46,47,55,56,58];

	 listaOcultos=[11,12,14,15,17,19,20,22,23,25,26,28,29,31,33,34,35,36,48,49,50,51,52,53,54];

	 listaOcultosEspejo=[11,12,14,15,17,19,20,22,23,25,26,28,29,31,33,34,35,36,48,49,50,51,52,53,54];

	 //5894557

	 

	 $("#MenuCampos").click(function(){

		

		





		

		

		

		$("#targetall").html("");

		$('#tableall').columnManager({listTargetID:'targetall', onClass: 'advon', offClass: 'advoff', hideInList: listaNoOcultar, 

									saveState: true, colsHidden: listaOcultos,onToggle: function(index, state){

										if(state){

											var pos = listaOcultos.indexOf( index );

pos > -1 && listaOcultos.splice( pos, 1 );





											

											}else{

												listaOcultos.push(index);

										

												}

										}});

	});

	

	

	

	

	

	

	$("#MenuCampos").click(function(){

			$.modal($("#targetall"),{containerCss:{

	height:470,

	width: 270

			},onClose: function (dialog) {

				$.modal.close();

				

				

				

				}

});

			

					});

					

					

					

										

	 var opt = {listTargetID: 'targetcol', onClass: 'simpleon', offClass: 'simpleoff',  

            hide: function(c){ 

                $(c).fadeOut(); 

            },  

            show: function(c){ 

                $(c).fadeIn(); 

            }}; 

	

	$("#tableall thead th img").click(function(){

		var objeto=this.id;		

		var camposAsociados=Campos[objeto];		

		var nature=naturalezaBusqueda[objeto];

		var columna=$(this).parent("th").index();		

		var columnaAdmin=columna+1;

		operacionColumna=$(this).attr("name");

	

	if(operacionColumna=="ocultar")

	{

			

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

		listaOcultos.push(columnaAdmin);

		

		}				

	}else if(operacionColumna=="eliminar")

	{

		

		jConfirm('Si elimina esta columna perderá todos los datos y se hará un recalculo general', 'Alerta!', function(r) 

		{

			if(r)

			{

				$("#tableall tbody tr").each(function() {

				

					ide=$(this).find("td:eq("+columna+")").find(nature).attr("id");					

					id=ide.split("_");

					id=id[1];				

					

					$.each(camposAsociados,function(index,value){

						$("#"+value+id).val("0")						;

						});

					

					

					calculosClientes.init_calculosNomina(ide);

					calculosClientes.extraerID();

					

					calculosClientes.recalculoEliminandoColumna();

					

									

					});

					

					

					$('#tableall').toggleColumns(columnaAdmin, opt);

					listaOcultos.push(columnaAdmin);

					

				

				

				

				}

				else

				{

					jAlert("rechazo");

					}

		});

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

	

	

	$("#menuColumnas").mouseover(function(){

		tooltip("Mostrar/Ocultar Columnas")

	});

	

	$("#menuColumnas").mouseout(function(){

		hidetooltip();

		});

	

	/*

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

		});	*/

	

	$("#tableall tbody td").mouseover(function(){

		var columnaAdmin=$(this).index();		

		var campo=$("th:eq("+columnaAdmin+")").find("label").html();

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

		

		

	

	

	

	

	$("#inputrelativos").change(function(){

		var relativos=this.value;

		$("#relativos").val(relativos);

		calculosClientes.calcularTOTALPERCEPCIONES();

		});

		

	$("#agregar_emp").click(function(){

		var idEmpleadoNuevo=$("#id_empleado_nuevo").val();		

		var parametros={

			"id_empleado":idEmpleadoNuevo,

			"id_empresa":<?php echo $id_empresa;?>,

			"id_nomina":<?php echo $id_nomina;?>

			};

		transaccionesNomina.agregarEmpleadoFueraNomina(parametros,"nominas_empresa_empleados","agregarEmpleadoNuevo","POST");

		});

		

	

	$("#cancelar").click(function(){

		var parametros={

			"id_usuario":transaccionesNomina.IdUsuario,

			};

		transaccionesNomina.consultarNominaVistaInicial(parametros,"cuerpoNomina","consultarEmpresasXUsuario","POST");		

		});

		

	$("#guardar").click(function(){

		var parametros={

			"id_empresa":<?php echo $id_empresa;?>,

			"id_nomina":<?php echo $id_nomina;?>,

			"estado_anterior":$("#estado_actual").val()

			};

		transaccionesNomina.modificarNomina(parametros,"cuerpoNomina","modificarNomina","POST");		

		});

		

	$("#aceptar").click(function(){

		var parametros={

			"id_usuario":transaccionesNomina.IdUsuario,

			};

		transaccionesNomina.consultarNominaVistaInicial(parametros,"cuerpoNomina","consultarEmpresasXUsuario","POST");			

		});

		

		

	$("img[id*='quitar']").click(function(){

		var empleado=this.id.split("_")

		var id_empleado=empleado[1];

		var honorariosEmpresa=$("#honorarios_empresa").val();

		var iva_empresa=$("#iva_empresa").val();

		

		var parametros={

			"id_empresa":<?php echo $id_empresa;?>,

			"id_nomina":<?php echo $id_nomina;?>,

			"id_empleado":id_empleado			

			};

		transaccionesNomina.EliminarEmpleadoDeNomina(parametros,"nominas_empresa","eliminarEmpleadoDeNomina","POST");			

		});

		

		

	

	

	



	

	

	$("#tableall input:text").change(function(){	

		idCampo=this.id;	

		calculosClientes.init_calculosNomina(idCampo);

		calculosClientes.extraerID();

		calculosClientes.lanzarOperacion();	

	})

	

	$("#tableall img[id*='ventana']").click(function(){

		idCampo=this.id		

		calculosClientes.init_calculosNomina(idCampo);

		calculosClientes.extraerID();

		calculosClientes.lanzarOperacion();

		});

		

		

		

		

		

		

  

  

  $.each(listaOcultos,function(index,value)

  {

	  

	  columnaRevision=value-1;

	  var suprimir=false;



	  

	  $("#tableall tbody tr").find("td:eq("+columnaRevision+")").each(function(index2, element) {		 

		  campoRevision=$(this).find("input").val();		 

		 

		  if(campoRevision>0){

			 if(value>=48 && value<=53)

			 {

				 var pos = listaOcultosEspejo.indexOf( 54 );

			  pos > -1 && listaOcultosEspejo.splice( pos, 1 );

				 }

			  suprimir=true;

			  }

			  

		  });

		  

		  if(suprimir)

		  {

			  var pos = listaOcultosEspejo.indexOf( value );

			  pos > -1 && listaOcultosEspejo.splice( pos, 1 );

			  }

			  

			

			  

			  });

			  

			 

		listaOcultos=listaOcultosEspejo;

		

		

			  

		$('#tableall').columnManager({listTargetID:'targetall', onClass: 'advon', offClass: 'advoff', hideInList: listaNoOcultar, 

									saveState: true, colsHidden: listaOcultos,onToggle: function(index, state){

										

										}});	   

  

		

	/*	

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



colratio       : [

                  50,80,200,80,100,100,100,100,100,100,

				  100,100,100,100,100,100,100,100,100,100,

				  100,100,100,100,100,100,100,100,100,100,

				  100,100,100,100,100,0,0,0,0,0,

				  0,0,0,0,0,0,0,0,0,0,

				  0,0,0,0,0,0,0,0],

		                    whiteSpace     : 'normal',		                    							                					

							height : 200, 

							width : 1300, 							

							minWidth :100						

								

							

							

						});*/

});

</script>











<?php









?>

<?php /*

<script>

$(document).ready(function()

{

	

	 $('#ulSelectColumn').clickMenu({onClick: function(){}}); 

	

	$('#tableall').columnManager({listTargetID:'targetall', onClass: 'advon', offClass: 'advoff', hideInList: [1,2,3,4], 

									saveState: true, colsHidden: [23,22,21,20,19,18,17,16,15]});//145-13



	 var opt = {listTargetID: 'targetall', onClass: 'advon', offClass: 'advoff',  

            hide: function(c){ 

                $(c).fadeOut(); 

            },  

            show: function(c){ 

                $(c).fadeIn(); 

            }}; 

	

	 $('#ocultar_sueldo_diario').click(function(){ $('#tableall').toggleColumns(5, opt); });

   $('#ocultar_dias_trabajados').click(function(){ $('#tableall').toggleColumns(6, opt); });

   $('#ocultar_sueldo').click(function(){ $('#tableall').toggleColumns(7, opt); });

   $('#ocultar_horas_extras').click(function(){ $('#tableall').toggleColumns(8, opt); });

   $('#ocultar_total_he').click(function(){ $('#tableall').toggleColumns(9, opt); });

   $('#ocultar_domingos_t').click(function(){ $('#tableall').toggleColumns(10, opt); });

   $('#ocultar_prima_dom').click(function(){ $('#tableall').toggleColumns(11, opt); });

   $('#ocultar_total_dt2').click(function(){ $('#tableall').toggleColumns(12, opt); });

  

   $('#ocultar_turnos_t').click(function(){ $('#tableall').toggleColumns(13, opt); });

   $('#ocultar_total_tb').click(function(){ $('#tableall').toggleColumns(14, opt); });

   $('#ocultar_descansos_t').click(function(){ $('#tableall').toggleColumns(15, opt); });

   $('#ocultar_total_dt').click(function(){ $('#tableall').toggleColumns(16, opt); });

   $('#ocultar_dias_f').click(function(){ $('#tableall').toggleColumns(17, opt); });

   $('#ocultar_total_dias_f').click(function(){ $('#tableall').toggleColumns(18, opt); });

   $('#ocultar_vacaciones').click(function(){ $('#tableall').toggleColumns(19, opt); });

   $('#ocultar_prima_d').click(function(){ $('#tableall').toggleColumns(20, opt); });

   $('#ocultar_total_v').click(function(){ $('#tableall').toggleColumns(21, opt); });

   $('#ocultar_aguinaldo').click(function(){ $('#tableall').toggleColumns(22, opt); });

   $('#ocultar_complemento_s').click(function(){ $('#tableall').toggleColumns(23, opt); });

   $('#ocultar_otras_p').click(function(){ $('#tableall').toggleColumns(24, opt); });

   $('#ocultar_total_per').click(function(){ $('#tableall').toggleColumns(25, opt); });

  

   $('#ocultar_prestamos').click(function(){ $('#tableall').toggleColumns(27, opt); });

   $('#ocultar_caja_ahorro').click(function(){ $('#tableall').toggleColumns(28, opt); });

   $('#ocultar_fonacot').click(function(){ $('#tableall').toggleColumns(29, opt); });

   $('#ocultar_infonavit').click(function(){ $('#tableall').toggleColumns(30, opt); });

   $('#ocultar_otras_d').click(function(){ $('#tableall').toggleColumns(31, opt); });

   $('#ocultar_prestamo_n').click(function(){ $('#tableall').toggleColumns(32, opt); });

   $('#ocultar_total_de').click(function(){ $('#tableall').toggleColumns(33, opt); });

   $('#ocultar_total').click(function(){ $('#tableall').toggleColumns(35, opt); });

	

});

	</script>

    

    

*/?>

    

    

    

    

</head>









<body>

<?php 



/*

   

 

	

				

	

	 $id_empresa= $_POST['id_empresa'];

	 $id_nomina= $_POST['id_nomina'];

	

	

	$global_percepciones=0;

	$global_percepciones_fiscal=0;

	$global_deducciones=0;

	$global_deducciones_fiscal=0;

	$global_total=0;

	$global_total_fiscal=0;

	

	

	

	$objNominaFiscal = new NominaFiscal();	

	//$objNominaFiscal->no_construct($id_nomina,$id_empresa);//para nominas que no cuentan con fiscal

	                 

	

	



	

	

	

	

	

	

	  

	



	$lista_Empleados_Imss= $objNomina->consultar_nomina_empleados_imss($id_nomina, $id_empresa);  //solo la utilizo para contar el numero de afiliados al imss

	//Cuantos empleados tienen imss	cuenta_imss

	$num_rows_Afiliados = mysql_num_rows($lista_Empleados_Imss);	//numero de empleados asegurados

	//cuento las filas



	

	



  

	

	

	 

	 */



	while ($row_nomina =$detallesNomina->fetch()){

            	  

		$inicio_periodo=fsalida( $row_nomina['inicio_periodo']);//2012/06/02 a 02/06/2012

		$fin_periodo= fsalida($row_nomina['fin_periodo']);	//2012/06/02 a 02/06/2012

		$relativos = $row_nomina['relativos'];

		$observaciones = $row_nomina['observaciones'];

		$honorarios = $row_nomina['honorarios'];

		$percepciones=$row_nomina['percepciones'];

		$iva = $row_nomina['iva'];

		$estatus = $row_nomina['estado'];

		$tipoNomina = $row_nomina['tipo_nomina'];

		$subtotal_nomi=$row_nomina['subtotal'];

		$total_factura_nomi=$row_nomina['total_factura'];

		

		//id_empresa,id_nomina,fecha_captura

	  

     }

	 

	 

	     $checkedProceso="";

		 $chekedRevision="";

		 $chekedAutorizada="";

		 $chekedPagada="";

		 $chekedFacturada="";

		 

		 $tipoProceso="type='radio'";

		 $tipoRevision="type='radio'"; 

		 $tipoAutorizada="type='radio'";

		 $tipoPagada="type='radio'";

		 $tipoFacturada="type='radio'"; 

		 

		 $tipobotonAceptar="type='hidden'";

		 $botonProcesar="type='button'";

		 $botonCancelar="type='button'";

	 

	 

	 switch($estatus){

		 case "PROCESO":		

		 $tipoProceso="type='hidden'";		 

		 $chekedRevision="checked='checked'";		 

		 break;

		 case "REVISION":		 

		 $tipoProceso="type='hidden'";

		 $chekedRevision="checked='checked'";

		 break;

		 case "AUTORIZADA":		 

		 $tipoProceso="type='hidden'";	

		 $chekedAutorizada="checked='checked'";

		 break;

		 case "PAGADA":		 

		 $tipoProceso="type='hidden'";

		 $tipoRevision="type='hidden'"; 

		 $tipoAutorizada="type='hidden'";

		 $chekedPagada="checked='checked'";

		 break;

		 case "FACTURADA":		 

		 $tipoProceso="type='hidden'";

		 $tipoRevision="type='hidden'"; 

		 $tipoAutorizada="type='hidden'";

		 $tipoPagada="type='hidden'";

		 $chekedFacturada="checked='checked'";

		 

		 $tipobotonAceptar="type='button'";

		 $tipobotonProcesar="type='hidden'";

		 $tipobotonCancelar="type='hidden'";

		 break;

		 default:

		 $checkedProceso="";

		 $chekedRevision="";

		 $chekedAutorizada="";

		 $chekedPagada="";

		 $chekedFacturada="";

		 

		 $tipoProceso="type='hidden'";

		 $tipoRevision="type='hidden'"; 

		 $tipoAutorizada="type='hidden'";

		 $tipoPagada="type='hidden'";

		 $tipoFacturada="type='hidden'";

		 

		 $tipobotonAceptar="type='hidden'";		 

		 $tipobotonProcesar="type='hidden'";

		 $tipobotonCancelar="type='hidden'"; 

		 };	

		 



     

   



        

	 

	

	while ($row_empresas = $detallesEmpresa->fetch()){

            

      $razon_social= $row_empresas['razon_social'];

      $titular= $row_empresas['titular']; 

      $zona= $row_empresas['zona'];         

	  $porc_honorarios= $row_empresas['honorarios']; 

	  $porc_iva= $row_empresas['iva']; 

	  

	  //id_empresa,rfc,direccion,correo,telefonos,id_usuario,cp

	  

     } 	

	 

	 $optionEmpleadoFuera="";

	 $mostrarEmpleadosNuevos="style='display:'";	 

	

	 while($empleadosFaltantes=$empleadosFueraNomina->fetch())

	 {

		 $mostrarEmpleadosNuevos="style='display:block'";//si hay valores se muestra,de lo contrario se mantiene oculto.

		 $optionEmpleadoFuera.="<option value='$empleadosFaltantes[id_empleado]'>$empleadosFaltantes[nombre]</option>";

		 }

	

			

	$TOTALPERCEPCIONES=$totalesNomina['TOTALPERCEPCIONES'];

    $TOTALPERCEPCIONESFISCAL=$totalesNomina['TOTALPERCEPCIONESFISCAL'];

	$TOTALDEDUCCIONES=$totalesNomina['TOTALDEDUCCIONES'];

	$TOTALDEDUCCIONESFISCAL=$totalesNomina['TOTALDEDUCCIONESFISCAL'];

	$TOTALNOMINANORMAL=$totalesNomina['TOTALNOMINANORMAL'];

	$TOTALNOMINAFISCAL=$totalesNomina['TOTALNOMINAFISCAL'];

	

	

	

	 $parametros_basicos=str_replace('"',"'",json_encode(array(

  "controlador"=>"Calculos",			    

  "mensaje"=>"este usuario",

  "capa"=>"nominas_empresa_empleados",

  "modulo"=>"calculos",

  "grupo"=>"admin"					   

  )));

  



  

  $operaciones=array(

      "Cargar"=>str_replace('"',"'",json_encode(array(

						"operacion"=>"consultarNominaFiscal",

						"accion"=>"NominaFiscal"

						)))

	  );

  



$parametros_especificos=str_replace('"',"'",json_encode(array(

				  "idNomina"=>$id_nomina,				  

				  "idEmpresa"=>$id_empresa,			  

				  "TipoNomina"=>$tipoNomina		   

				  

				  )));

		 

	





?>



<form id="actualizarNomina">

 



















<!------------------------------------------------------------------------------------------------->

    <input type="hidden" id="tipoNomina"            value="<?php echo $tipoNomina; ?>" />    

    <input type="hidden" id="id_empresa" name="id_empresa"        value="<?php echo $id_empresa;      ?>" />

    <input type="hidden" id="id_nomina" name="id_nomina"          value="<?php echo $id_nomina;       ?>" />

    <input type="hidden" id="estado_actual"      value="<?php echo $estatus;         ?>" />

    <input type="hidden" id="iva_empresa"        value="<?php echo $porc_iva;        ?>" />

    <input type="hidden" id="honorarios_empresa" value="<?php echo $porc_honorarios; ?>" />

<!------------------------------------------------------------------------------------------------->



	<div id="container2">



		<div id="header2">

        

        <table style="font-size:10px; font-family:Arial, Helvetica, sans-serif">

        <tr>

        <td rowspan="2"><?php echo "<strong>NOMINA:</strong>   ".$id_nomina; ?><div style="margin-top:10px; width:100px;"></div></td>

        <td></td>

        <td rowspan="2"><?php echo "<strong>CLIENTE:</strong>   ".$razon_social; ?><div style="margin-top:10px; width:200px;"></div></td>

        <td></td>

        <td rowspan="2"><strong>Nomina del Periodo:</strong>

        <input type="text" id="dia_inicio" name="dia_inicio" size="10" value="<?php echo $inicio_periodo; ?>" onFocus="javascript:calendarioNaranja('dia_inicio');" />

        Al

        <input type="text" id="dia_final" name="dia_final" size="10" value="<?php echo $fin_periodo; ?>" onFocus="javascript:calendarioNaranja('dia_final');" />

        <br />	    

	    <div style="margin-left:115px; float:left">dd/mm/aaaa</div><div style="margin-left:50px; float:left">dd/mm/aaaa</div>

        <div style="margin-top:10px; width:370px;"></div>

        </td>

        <td></td>

        <td rowspan="2"><?php echo "<strong>Empleados:</strong>   ".$numeroEmpleados;?><div style="margin-top:10px; width:200px;"></div>

        <?php echo "<strong>Empleados Asegurados:</strong>   ".$numeroEmpleadosAfiliados;?>

        </td>

        <td></td>

        <td rowspan="2"><div style="margin-top:10px; width:200px;"></div></td>

        </tr>

        </table>

        <br /> 

 <table style="font-size:10px; font-family:Arial, Helvetica, sans-serif">

  <tr >  

  <td>

  <a href="../admin/mod_calculos/view/PDFRecibosNomina.php?id_Emp=<?php echo $id_empresa; ?>&id_nomin=<?php echo $id_nomina; ?>&tipoNomina=<?php echo $tipoNomina; ?>" target="_blank" >

  <strong>Recibos de Nomina</strong>

  </a>

  </td>

  

    <td> 

    <a  href="javascript:operaciones2.inicializador(<?php echo $parametros_basicos?>,<?php echo $parametros_especificos?>,<?php echo $operaciones['Cargar']?>,'GET');" >

     <strong>Nomina Fiscal </strong>

    </a>

    </td>

    <td>

    <a href="../admin/facturacion_formulario.php?id_nomina= <?php echo $id_nomina; ?>&id_empresa=<?php echo $id_empresa; ?>" target="_blank">

    <strong> Facturar </strong>

    </a>

    </td>

	<td>

    <a href="../admin/imprimir_dispersion_excel.php?id_nomina=<?php echo $id_nomina; ?>&id_empresa=<?php echo $id_empresa; ?>" target="_blank">

    <strong>Dispersar </strong>

    </a>

    </td>

	<td>

    <a href="javascript:transaccionesNomina.consultarNominaVistaInicial({'id_usuario':transaccionesNomina.IdUsuario,'id_empresa':$('#id_empresa').val()},'cuerpoNomina','consultarEmpresasXUsuario','POST');">

    <strong> Regresar </strong>

    </a>

    </td>

</tr>

</table>

<br />

 <div id="agregar_empleado" <?php echo $mostrarEmpleadosNuevos;?>>

 





   <label >Agregar Empleado:

 	  <select name="id_empleado_nuevo" id="id_empleado_nuevo" >

      <?php echo $optionEmpleadoFuera;?>    

     </select>

   </label>

   

   <input type="button" id="agregar_emp" value="Agregar"/>

   

    

    

 </div>

 

 <br />

 



 

 

 <img src="../imagenes/ver.png" alt="select columns" title="Ocultar/Mostrar Columnas" id="MenuCampos" />

</div>

<div id="content2">

<div id="exa">

<table id="tableall" class="bordered">

<thead>

<th bgcolor="#F8F48B"><label>Quitar</label></th>

<th bgcolor="#F8F48B"><label>Recibo de Nomina</label></th>

<th bgcolor="#9CDB99" style="display:none">id_empleado</th>

<th bgcolor="#9CDB99"><label>Empleado</label></th>

<th bgcolor="#9CDB99"><label>Sueldo Diario</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Sueldo Diario Imss</th>

<th bgcolor="#9CDB99" style="display:none">Sueldo Diario Fiscal</th>

<th bgcolor="#9CDB99"><label>Dias Trabajados</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Sueldo</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">SueldoImss</th>

<th bgcolor="#9CDB99"><label>Horas Extras</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarHoras"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Total Horas Extras</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Total Horas Extras Imss</th>

<th bgcolor="#9CDB99"><label>Domingos Trabajados</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarDomingos"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Prima Dominical</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Prima Dominical Imss</th>

<th bgcolor="#9CDB99"><label>Total Domingos</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Total Domingos Imss</th>

<th bgcolor="#9CDB99"><label>Turnos Trabajados</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarTurnos"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Total Turnos Trabajados</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Total Turnos Trabajados Imss</th>

<th bgcolor="#9CDB99"><label>Descansos Trabajados</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarDescansos"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Total Descansos Trabajados</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Total Descansos Trabajados Imss</th>

<th bgcolor="#9CDB99"><label>Dias Festivos</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarFestivos"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Total Dias Festivos</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Total Dias Festivos Imss</th>

<th bgcolor="#9CDB99"><label>Vacaciones</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarVacaciones"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Prima Vacacional</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Prima Vacacional Imss </th>

<th bgcolor="#9CDB99"><label>Total Vacaciones</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Total Vacaciones Imss</th>

<th bgcolor="#9CDB99"><label>Dias Proporcionales</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Aguinaldo</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarAguinaldo"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Complemento Sueldo</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarComplemento"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99"><label>Otras Percepciones</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarOtpercepciones"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Otras Percepciones Fiscal</th>

<th bgcolor="#9CDB99" style="display:none">Premio Puntualidad</th>

<th bgcolor="#9CDB99" style="display:none">Premio Asistencia</th>

<th bgcolor="#9CDB99" style="display:none">Despensa</th>

<th bgcolor="#9CDB99" style="display:none">Becas Educacionales</th>

<th bgcolor="#9CDB99" style="display:none">Isr</th>

<th bgcolor="#9CDB99" style="display:none">Subsidio Empleo</th>

<th bgcolor="#9CDB99" style="display:none">IMSS</th>







<th bgcolor="#9CDB99"><label>Total Percepciones</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#9CDB99" style="display:none">Total Percepciones Fiscal</th>

<th style="background-color:#FFFFFF"></th>

<th bgcolor="#FF9D9D"><label>Prestamos</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarPrestamos"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#FF9D9D"><label>Caja de Ahorro</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarCAhorro"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#FF9D9D"><label>Fonacot</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarFonacot"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#FF9D9D"><label>Infonavit</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarInfonavit"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#FF9D9D"><label>Otras Deducciones</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarOtDeducciones"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#FF9D9D"><label>Prestamo Navitas</label> &nbsp;&nbsp;<img src="../imagenes/sistema/eliminarColumna.png" name="eliminar" id="eliminarPrestamo"/><img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#FF9D9D"><label>Total Deducciones</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#FF9D9D" style="display:none">Total Deducciones Fiscal</th>

<th style="background-color:#FFFFFF"></th>

<th bgcolor="#F8F48B"><label>TOTAL</label> &nbsp;&nbsp;<img src="../imagenes/sistema/ocultarColumna.png" name="ocultar" /></th>

<th bgcolor="#F8F48B" style="display:none">TOTAL FISCAL</th>



</thead>



<?php

$color=false;

foreach($datosEmpleados as $row_empleados)

  {

	  if($color){

		  $odd="class='odd'";		  

		  $color=false;

		  }else{

			  $odd="";

			  $color=true;

			  }



	  

	  /*

	  creo el id[html] del campo y el valor de dicho campo.

	  excepto aquellos campos que no son necesarios para los calculos: nombre del empleado...etc.

	  

	  */

	  

	 

	 

	  

	  

	  /*VALORES DENTRO DE LOS CAMPOS*/

	 

	 

	 /*NOMINA NORMAL*/

	 

	

	 

	  $idEmpleado=$row_empleados['id_empleado'];

	  $nombreEmpleado=$row_empleados['nombre'];

	  $sueldoDiario=$row_empleados['sueldo_diario_emp'];	  

	  $sueldoDiarioImss=$row_empleados['sueldo_diario_imss'];

	  $diasTrabajados=$row_empleados['dias_trabajados']; 

	 















$totalSueldo=$row_empleados['total_sueldo'];

$horasExtras=$row_empleados['horas_extras']; 

$totalHorasExtras=$row_empleados['total_horas_extras'];

$domingosTrabjados=$row_empleados['domingos_trabajados']; 

$primaDominical=$row_empleados['prima_dominical']; 

$totalDomingosTrabajados=$row_empleados['total_domingos_trabajados'];

$turnosTrabajados=$row_empleados['turnos_trabajados'];

$totalTurnosTrabajados=$row_empleados['total_turnos_trabajados'];

$descansoTrabajado=$row_empleados['descanso_trabajado']; 

$totalDescansoTrabajado=$row_empleados['total_descanso_trabajado'];

$diasFestivos=$row_empleados['dias_festivos']; 

$totalDiasFestivos=$row_empleados['total_dias_festivos'];

$vacaciones=$row_empleados['vacaciones']; 

$primaVacacional=$row_empleados['prima_vacacional']; 

$totalVacaciones=$row_empleados['total_vacaciones'];  



$aguinaldo=$row_empleados['aguinaldo'];

$complementoSueldo=$row_empleados['complemento_sueldo'];

$otrasPercepciones=$row_empleados['otras_percepciones'];



$prestamos=$row_empleados['prestamos'];

$caja=$row_empleados['caja_ahorro'];

$fonacot=$row_empleados['fonacot'];

$infonavit=$row_empleados['infonavit'];

$otrasDeducciones=$row_empleados['otras_deducciones'];

$prestamoAscon=$row_empleados['prestamo_ascon'];







$totalPercepcionesEmpleado=$row_empleados['totalPercepcionesEmpleado'];

$totalPercepcionesEmpleadoFiscal=$row_empleados['totalPercepcionesFiscalEmpleado'];

$totalDeduccionesEmpleado=$row_empleados['totalDeduccionesEmpleado'];

$totalDeduccionesEmpleadoFiscal=$row_empleados['totalDeduccionesFiscalEmpleado'];

/*

+NO LOS USO, SIN EMBARGO DEBEN SER CANTIDADES IGUALES A $totalNominaNormal Y $totalNominaFiscal.

+se conservan para uso en el futuro.

$totalNominaEmpleado=$row_empleados['totalNominaEmpleado'];

$totalNominaFiscalEmpleado=$row_empleados['totalNominaFiscalEmpleado'];

*/

$totalNominaNormal=$row_empleados['total_ReciboNomina'];

	 

 









   









/*************************************************************/



/*

``, 

`id_nomina`, 

`id_empleado`, 

*/































 $sueldoDiarioFiscal=$row_empleados['p_sueldo_diario'];

 $totalSueldoImss=$row_empleados['p_total_sueldo'];

 $totalDomingosImss=$row_empleados['p_subtotal_domingos'];

 $primaDominicalImss=$row_empleados['p_prima_dominical'];

 $totalVacacionesImss=$row_empleados['p_subtotal_vacaciones'];

 $primaVacacionalImss=$row_empleados['p_prima_vacacional'];

 $totalTurnosTrabajadosImss=$row_empleados['p_total_turnos_trabajados'];

 $totalDescansosTrabajadosImss=$row_empleados['p_total_descansos_trabajados'];

 $totalHorasExtrasImss=$row_empleados['p_total_horas_extras'];

 $totalDiasFestivosImss=$row_empleados['p_total_dias_festivos']; 



$premioPuntualidad=$row_empleados['p_premio_por_puntualidad'];

$premioAsistencia=$row_empleados['p_premio_por_asistencia'];

$despensa=$row_empleados['p_despensa'];

$becas=$row_empleados['p_becas_educacionales'];



$subsidio=$row_empleados['p_subsidio_empleo'];

$isr=$row_empleados['d_ISR'];

$imss=$row_empleados['d_IMSS'];

$descripcionOtrasDeducciones=$row_empleados['d_descripcion_otras_deducciones'];





$totalNominaFiscal=$row_empleados['total_nomina_fiscal'];































 







/*************************************************************/







	   

	  

	  /*ID Y NAME DE LOS CAMPOS, GENERADOS DINAMICAMENTE*/	 

	  $campoIdEmpleado="idEmpleado_".$idEmpleado;
	  $inputcampoIdEmpleado="inputidEmpleado_".$idEmpleado;
	  $NmIdEmpleado="idEmpleado";

	

	  	  

	  $campoIdSueldoDiario="sueldoDiario_".$idEmpleado;
	  $inputcampoIdSueldoDiario="inputsueldoDiario_".$idEmpleado;
	  $NmSueldoDiario="inputsueldoDiario";

	  

	  $campoIdSueldoDiarioFiscal="sueldoDiarioFiscal_".$idEmpleado;
	  $inputcampoIdSueldoDiarioFiscal="inputsueldoDiarioFiscal_".$idEmpleado;
	  $NmSueldoDiarioFiscal="inputsueldoDiarioFiscal";

	    

	  $campoIdSueldoDiarioImss="sueldoDiarioImss_".$idEmpleado;
	  $inputcampoIdSueldoDiarioImss="inputsueldoDiarioImss_".$idEmpleado;
	  $NmSueldoDiarioImss="inputsueldoDiarioImss";

	  	  	  

	  $campoIdDiasTrabajados="diasTrabajados_".$idEmpleado;
	  $NmDiasTrabajados="diasTrabajados";	  

	  

	  $campoSueldoTotal="SueldoTotal_".$idEmpleado;
	  $inputcampoSueldoTotal="inputSueldoTotal_".$idEmpleado;
	  $NmSueldoTotal="inputSueldoTotal";



	  $campoSueldoTotalImss="SueldoTotalImss_".$idEmpleado;
	  $inputcampoSueldoTotalImss="inputSueldoTotalImss_".$idEmpleado;
	  $NmSueldoTotalImss="inputSueldoTotalImss";



	  $iconoCalculoHorasExtras="ventanaHoraExtra_".$idEmpleado;
	  $campoNumeroHorasExtras="NumeroHorasExtras_".$idEmpleado;
	  $inputcampoNumeroHorasExtras="inputNumeroHorasExtras_".$idEmpleado;
	  $NmNumeroHorasExtras="inputNumeroHorasExtras";



	  $campoTotalHorasExtras="TotalHorasExtras_".$idEmpleado;
	  $inputcampoTotalHorasExtras="inputTotalHorasExtras_".$idEmpleado;
	  $NmTotalHorasExtras="inputTotalHorasExtras";

	  

	  $campoTotalHorasExtrasImss="TotalHorasExtrasImss_".$idEmpleado;
	  $inputcampoTotalHorasExtrasImss="inputTotalHorasExtrasImss_".$idEmpleado;
	  $NmTotalHorasExtrasImss="inputTotalHorasExtrasImss";

	  

	  $iconoDomingosTrabajados="ventanaDomingoTrabajado_".$idEmpleado;
	  $campoNumeroDomingosTrabajados="NumeroDomingosTrabajados_".$idEmpleado;
	  $inputcampoNumeroDomingosTrabajados="inputNumeroDomingosTrabajados_".$idEmpleado;
	  $NmNumeroDomingosTrabajados="inputNumeroDomingosTrabajados";	  

	  

	  $campoPrimaDominical="PrimaDominical_".$idEmpleado;
	  $inputcampoPrimaDominical="inputPrimaDominical_".$idEmpleado;
	  $NmPrimaDominical="inputPrimaDominical";

	  

	  $campoPrimaDominicalImss="PrimaDominicalImss_".$idEmpleado;
	  $inputcampoPrimaDominicalImss="inputPrimaDominicalImss_".$idEmpleado;
	  $NmPrimaDominicalImss="inputPrimaDominicalImss";



	  $campoTotalDomingos="TotalDomingosTrabajados_".$idEmpleado;
	  $inputcampoTotalDomingos="inputTotalDomingosTrabajados_".$idEmpleado;
	  $NmTotalDomingos="inputTotalDomingosTrabajados";



	  $campoTotalDomingosImss="TotalDomingosTrabajadosImss_".$idEmpleado;
	  $inputcampoTotalDomingosImss="inputTotalDomingosTrabajadosImss_".$idEmpleado;
	  $NmTotalDomingosImss="inputTotalDomingosTrabajadosImss";



	  $campoNumeroTurnosTrabajados="NumeroTurnosTrabajados_".$idEmpleado;
	  $inputcampoNumeroTurnosTrabajados="inputNumeroTurnosTrabajados_".$idEmpleado;
	  $NmNumeroTurnosTrabajados="inputNumeroTurnosTrabajados";

	  

	  $campoTotalTurnos="TotalTurnosTrabajados_".$idEmpleado;
	  $inputcampoTotalTurnos="inputTotalTurnosTrabajados_".$idEmpleado;
	  $NmTotalTurnos="inputTotalTurnosTrabajados";

	  

	  $campoTotalTurnosImss="TotalTurnosTrabajadosImss_".$idEmpleado;
	  $inputcampoTotalTurnosImss="inputTotalTurnosTrabajadosImss_".$idEmpleado;
	  $NmTotalTurnosImss="inputTotalTurnosTrabajadosImss";

	  

	  $campoNumeroDescansosTrabajados="NumeroDescansosTrabajados_".$idEmpleado;
	  $inputcampoNumeroDescansosTrabajados="inputNumeroDescansosTrabajados_".$idEmpleado;
	  $NmNumeroDescansosTrabajados="inputNumeroDescansosTrabajados";

	  

	  $campoTotalDescansosTrabajados="TotalDescansosTrabajados_".$idEmpleado;
	  $inputcampoTotalDescansosTrabajados="inputTotalDescansosTrabajados_".$idEmpleado;
	  $NmTotalDescansosTrabajados="inputTotalDescansosTrabajados";

	  

	  $campoTotalDescansosTrabajadosImss="TotalDescansosTrabajadosImss_".$idEmpleado;
	  $inputcampoTotalDescansosTrabajadosImss="inputTotalDescansosTrabajadosImss_".$idEmpleado;
	  $NmTotalDescansosTrabajadosImss="inputTotalDescansosTrabajadosImss";

	  

	  $campoNumeroDiasFestivos="NumeroDiasFestivos_".$idEmpleado;
	  $inputcampoNumeroDiasFestivos="inputNumeroDiasFestivos_".$idEmpleado;
	  $NmNumeroDiasFestivos="inputNumeroDiasFestivos";

	  

	  $campoTotalDiasFestivos="TotalDiasFestivos_".$idEmpleado;
	  $inputcampoTotalDiasFestivos="inputTotalDiasFestivos_".$idEmpleado;
	  $NmTotalDiasFestivos="inputTotalDiasFestivos";
	  



	  $campoTotalDiasFestivosImss="TotalDiasFestivosImss_".$idEmpleado;
	  $inputcampoTotalDiasFestivosImss="inputTotalDiasFestivosImss_".$idEmpleado;
	  $NmTotalDiasFestivosImss="inputTotalDiasFestivosImss";

	  

	  $campoNumeroDiasVacaciones="NumeroDiasVacaciones_".$idEmpleado;
	  $inputcampoNumeroDiasVacaciones="inputNumeroDiasVacaciones_".$idEmpleado;
	  $NmNumeroDiasVacaciones="inputNumeroDiasVacaciones";



	  $campoPrimaVacacional="PrimaVacacional_".$idEmpleado;
	  $inputcampoPrimaVacacional="inputPrimaVacacional_".$idEmpleado;
	  $NmPrimaVacacional="inputPrimaVacacional";



	  $campoPrimaVacacionalImss="PrimaVacacionalImss_".$idEmpleado;
	  $inputcampoPrimaVacacionalImss="inputPrimaVacacionalImss_".$idEmpleado;
	  $NmPrimaVacacionalImss="inputPrimaVacacionalImss";

	  

	  $campoTotalVacaciones="TotalVacaciones_".$idEmpleado;
	  $inputcampoTotalVacaciones="inputTotalVacaciones_".$idEmpleado;
	  $NmTotalVacaciones="inputTotalVacaciones";

	  

	  $campoTotalVacacionesImss="TotalVacacionesImss_".$idEmpleado;
	  $inputcampoTotalVacacionesImss="inputTotalVacacionesImss_".$idEmpleado;
	  $NmTotalVacacionesImss="inputTotalVacacionesImss";

	  

	  $campoAguinaldo="aguinaldo_".$idEmpleado;
	  $NmAguinaldo="aguinaldo";

	  $campoComplementoSueldo="complementoSueldo_".$idEmpleado;
	  $NmComplementoSueldo="complementoSueldo";

	  $campoOtrasPercepciones="otrasPercepciones_".$idEmpleado;
	  $NmOtrasPercepciones="otrasPercepciones";

	  $campoOtrasPercepcionesFiscal="otrasPercepcionesFiscal_".$idEmpleado;

	  

	  $campoPremioPuntualidad="premioPuntualidad_".$idEmpleado;
	  $inputcampoPremioPuntualidad="inputpremioPuntualidad_".$idEmpleado;
	  $NmPremioPuntualidad="inputpremioPuntualidad";

	  

	  $campoPremioAsistencia="premioAsistencia_".$idEmpleado;
	  $inputcampoPremioAsistencia="inputpremioAsistencia_".$idEmpleado;
	  $NmPremioAsistencia="inputpremioAsistencia";

	  

	  $campoDespensa="despensa_".$idEmpleado;
	  $inputcampoDespensa="inputdespensa_".$idEmpleado;
	  $NmDespensa="inputdespensa";


	  

	  $campoBecasEducacionales="becasEducacionales_".$idEmpleado;
	  $inputcampoBecasEducacionales="inputbecasEducacionales_".$idEmpleado;
	  $NmBecasEducacionales="inputbecasEducacionales";


	  

	  $campoISR="ISR_".$idEmpleado;
	  $inputcampoISR="inputISR_".$idEmpleado;
	  $NmISR="inputISR";

	  

	  $campoSubsidio="SUBSIDIO_".$idEmpleado;
	  $inputcampoSubsidio="inputSUBSIDIO_".$idEmpleado;
	  $NmSubsidio="inputSUBSIDIO";

	  

	  $campoIMSS="IMSS_".$idEmpleado;
	  $inputcampoIMSS="inputIMSS_".$idEmpleado;
	  $NmIMSS="inputIMSS";

	  

	  $campoTotalPercepciones="TotalPercepciones_".$idEmpleado;
	  $campoTotalPercepcionesFiscal="TotalPercepcionesFiscal_".$idEmpleado;

	  

	  $iconoCalculoTurnoTrabajado="ventanaTurnoTrabajado_".$idEmpleado;

	  $iconoCalculoDescansoTrabajados="ventanaDescansoTrabajado_".$idEmpleado;

	  $iconoCalculoDiasFestivos="ventanaDiasFestivos_".$idEmpleado;

	  $iconoCalculoVacaciones="ventanaVacaciones_".$idEmpleado;

	  

	  $campoPrestamo="prestamo_".$idEmpleado;
	  $NmPrestamo="prestamo";

	  $campoCajaAhorro="cajaAhorro_".$idEmpleado;
	  $NmCajaAhorro="cajaAhorro";

	  $campoFonacot="fonacot_".$idEmpleado;
	  $NmFonacot="fonacot";

	  $campoInfonavit="infonavit_".$idEmpleado;
	  $NmInfonavit="infonavit";


	  $iconoCalculoOtrasDeducciones="ventanaOtrasDeducciones_".$idEmpleado;
	  $campoOtrasDeducciones="otrasDeducciones_".$idEmpleado;	
	  $inputcampoOtrasDeducciones="inputotrasDeducciones_".$idEmpleado;
	  $NmOtrasDeducciones="inputotrasDeducciones";



	  $campoDescripcionOtrasDeducciones="descripcionOtrasDeducciones_".$idEmpleado;
	  $inputcampoDescripcionOtrasDeducciones="inputdescripcionOtrasDeducciones_".$idEmpleado;
	  $NmDescripcionOtrasDeducciones="inputdescripcionOtrasDeducciones";

	  

	  $campoPrestamoNavitas="prestamoNavitas_".$idEmpleado;
	  $NmPrestamoNavitas="prestamoNavitas";		  

	  $campoTotalDeducciones="totalDeducciones_".$idEmpleado;
	  $campoTotalDeduccionesFiscal="totalDeduccionesFiscal_".$idEmpleado;

	  

	  $campoTOTAL="totalNominaEmpleado_".$idEmpleado;
	  $inputcampoTOTAL="inputtotalNominaEmpleado_".$idEmpleado;
	  $NmcampoTOTAL="inputtotalNominaEmpleado";

	  

	  $campoTOTALFISCAL="totalNominaEmpleadoFiscal_".$idEmpleado;
	  $inputcampoTOTALFISCAL="inputtotalNominaEmpleadoFiscal_".$idEmpleado;
	  $NmcampoTOTALFISCAL="inputtotalNominaEmpleadoFiscal";



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

<tr <?php echo $odd;?>>



<td>

<a href="#">

<img src="../imagenes/eliminar.png"  title="Quitar de esta nomina" id="quitarEmpleado_<?php echo $idEmpleado;?>"/>

</a>

</td>



<td>

<a href="../admin/mod_calculos/view/PDFRecibosNominaEmpleado.php?id_Emp=<?php echo $id_empresa; ?>&id_nomin=<?php echo $id_nomina; ?>&tipoNomina=<?php echo $tipoNomina; ?>&idEmpleado=<?php echo $row_empleados['id_empleado']; ?>" target="_blank" >

<img src="../imagenes/pdf.png" WIDTH="25px" HEIGHT="25px" title="Recibo de Nomina" alt="Recibo de Nomina" align="center" />

</a>

</td>    



<td style="display:none">

<output id="<?php echo $campoIdEmpleado;?>" name="idEmpleado[]"><?php echo $idEmpleado;?></output>

<input type="checkbox" checked="checked" id="<?php echo $inputcampoIdEmpleado;?>" name="<?php echo $NmIdEmpleado;?>" value="<?php echo $idEmpleado;?>"/>

</td>



<td>

<output name="nombreEmpleado[]"><?php echo $nombreEmpleado;?></output>

</td>



<td>

<output id="<?php echo $campoIdSueldoDiario;?>" name="<?php echo $campoIdSueldoDiario;?>"><?php echo $sueldoDiario;?></output>

<input type="hidden" id="<?php echo $inputcampoIdSueldoDiario;?>" name="<?php echo $NmSueldoDiario;?>" value="<?php echo $sueldoDiario;?>"/>

</td>



<td style="display:none">

<output id="<?php echo $campoIdSueldoDiarioImss;?>" name="<?php echo $campoIdSueldoDiarioImss;?>"><?php echo $sueldoDiarioImss;?></output>

<input type="hidden" id="<?php echo $inputcampoIdSueldoDiarioImss;?>" name="<?php echo $NmSueldoDiarioImss;?>" value="<?php echo $sueldoDiarioImss;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoIdSueldoDiarioFiscal;?>" name="<?php echo $campoIdSueldoDiarioFiscal;?>"><?php echo $sueldoDiarioFiscal;?></output>

<input type="hidden" id="<?php echo $inputcampoIdSueldoDiarioFiscal;?>" name="<?php echo $NmSueldoDiarioFiscal;?>" value="<?php echo $sueldoDiarioFiscal;?>" />

</td>



<td>

<input type="text" id="<?php echo $campoIdDiasTrabajados;?>" name="<?php echo $NmDiasTrabajados;?>" value="<?php echo $diasTrabajados;?>" size="5"/>

</td>



<td>

<output id="<?php echo $campoSueldoTotal;?>" name="<?php echo $campoSueldoTotal;?>"><?php echo $totalSueldo;?></output>

<input type="hidden" id="<?php echo $inputcampoSueldoTotal;?>" name="<?php echo $NmSueldoTotal;?>" value="<?php echo $totalSueldo;?>" />

</td>



<td style="display:none">

    <output id="<?php echo $campoSueldoTotalImss;?>" name="<?php echo $campoSueldoTotalImss;?>"><?php echo $totalSueldoImss;?></output>

    <input type="hidden" id="<?php echo $inputcampoSueldoTotalImss;?>" name="<?php echo $NmSueldoTotalImss;?>" value="<?php echo $totalSueldoImss;?>" />

    </td>



<td>

    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoHorasExtras;?>" />   

    <output style="display:none" id="<?php echo $campoNumeroHorasExtras;?>" name="<?php echo $campoNumeroHorasExtras;?>"><?php echo $horasExtras;?></output>

    <input type="text" size="5" id="<?php echo $inputcampoNumeroHorasExtras;?>" name="<?php echo $NmNumeroHorasExtras;?>" value="<?php echo $horasExtras;?>" />

    </td>

    

<td >

<output style="display:none" id="<?php echo $campoTotalHorasExtras;?>" name="<?php echo $campoTotalHorasExtras;?>"><?php echo $totalHorasExtras;?></output>

<input type="text" size="5" id="<?php echo $inputcampoTotalHorasExtras;?>" name="<?php echo $NmTotalHorasExtras;?>" value="<?php echo $totalHorasExtras?>"/>

</td>



<td style="display:none">

<output id="<?php echo $campoTotalHorasExtrasImss;?>" name="<?php echo $campoTotalHorasExtrasImss;?>"><?php echo $totalHorasExtrasImss;?></output> 

<input type="hidden" id="<?php echo $inputcampoTotalHorasExtrasImss;?>" name="<?php echo $NmTotalHorasExtrasImss;?>" value="<?php echo $totalHorasExtrasImss;?>" />

</td>



<td>

    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoDomingosTrabajados;?>" />

    <output style="display:none" id="<?php echo $campoNumeroDomingosTrabajados;?>" name="<?php echo $campoNumeroDomingosTrabajados;?>"><?php echo $domingosTrabjados?></output>

    <input type="text" size="5" id="<?php echo $inputcampoNumeroDomingosTrabajados;?>" name="<?php echo $NmNumeroDomingosTrabajados;?>" value="<?php echo $domingosTrabjados?>" />

    </td>

    

<td>

<output style="display:none" id="<?php echo $campoPrimaDominical;?>" name="<?php echo $campoPrimaDominical;?>"><?php echo $primaDominical?></output>

<input type="text" size="5" id="<?php echo $inputcampoPrimaDominical;?>" name="<?php echo $NmPrimaDominical;?>" value="<?php echo $primaDominical?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoPrimaDominicalImss;?>" name="<?php echo $campoPrimaDominicalImss;?>"><?php echo $primaDominicalImss;?></output>

<input type="hidden" id="<?php echo $inputcampoPrimaDominicalImss;?>" name="<?php echo $NmPrimaDominicalImss;?>" value="<?php echo $primaDominicalImss;?>" />

</td>



<td>

<output style="display:none" id="<?php echo $campoTotalDomingos;?>" name="<?php echo $campoTotalDomingos;?>"><?php echo $totalDomingosTrabajados?></output>

<input type="text" size="5" id="<?php echo $inputcampoTotalDomingos;?>" name="<?php echo $NmTotalDomingos;?>" value="<?php echo $totalDomingosTrabajados?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoTotalDomingosImss;?>" name="<?php echo $campoTotalDomingosImss;?>"><?php echo $totalDomingosImss;?></output>

<input type="hidden" id="<?php echo $inputcampoTotalDomingosImss;?>" name="<?php echo $NmTotalDomingosImss;?>" value="<?php echo $totalDomingosImss;?>" />

</td>



<td>

    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoTurnoTrabajado;?>" />   

    <output style="display:none" id="<?php echo $campoNumeroTurnosTrabajados;?>" name="<?php echo $campoNumeroTurnosTrabajados;?>"><?php echo $turnosTrabajados;?></output>

    <input type="text" size="5" id="<?php echo $inputcampoNumeroTurnosTrabajados;?>" name="<?php echo $NmNumeroTurnosTrabajados;?>" value="<?php echo $turnosTrabajados;?>" />

    </td>

    

<td>

<output style="display:none" id="<?php echo $campoTotalTurnos;?>" name="<?php echo $campoTotalTurnos;?>"><?php echo $totalTurnosTrabajados;?></output>

<input type="text" size="5" id="<?php echo $inputcampoTotalTurnos;?>" name="<?php echo $NmTotalTurnos;?>" value="<?php echo $totalTurnosTrabajados;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoTotalTurnosImss;?>" name="<?php echo $campoTotalTurnosImss;?>"><?php echo $totalTurnosTrabajadosImss;?></output>

<input type="hidden" id="<?php echo $inputcampoTotalTurnosImss;?>" name="<?php echo $NmTotalTurnosImss;?>" value="<?php echo $totalTurnosTrabajadosImss;?>" />

</td>



<td>

    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoDescansoTrabajados;?>" />   

    <output style="display:none" id="<?php echo $campoNumeroDescansosTrabajados;?>" name="<?php echo $campoNumeroDescansosTrabajados;?>"><?php echo $descansoTrabajado;?></output>

    <input type="text" size="5" id="<?php echo $inputcampoNumeroDescansosTrabajados;?>" name="<?php echo $NmNumeroDescansosTrabajados;?>" value="<?php echo $descansoTrabajado;?>" />

    </td>

    

<td>

<output style="display:none" id="<?php echo $campoTotalDescansosTrabajados;?>" name="<?php echo $campoTotalDescansosTrabajados;?>"><?php echo $totalDescansoTrabajado;?></output>

<input type="text" size="5" id="<?php echo $inputcampoTotalDescansosTrabajados;?>" name="<?php echo $NmTotalDescansosTrabajados;?>" value="<?php echo $totalDescansoTrabajado;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoTotalDescansosTrabajadosImss;?>" name="<?php echo $campoTotalDescansosTrabajadosImss;?>"><?php echo $totalDescansosTrabajadosImss;?></output>

<input type="hidden" id="<?php echo $inputcampoTotalDescansosTrabajadosImss;?>" name="<?php echo $NmTotalDescansosTrabajadosImss;?>" value="<?php echo $totalDescansosTrabajadosImss;?>" />

</td>



<td>

    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoDiasFestivos;?>" />   

    <output style="display:none" id="<?php echo $campoNumeroDiasFestivos;?>" name="<?php echo $campoNumeroDiasFestivos;?>"><?php echo $diasFestivos;?></output>

    <input type="text" size="5" id="<?php echo $inputcampoNumeroDiasFestivos;?>" name="<?php echo $NmNumeroDiasFestivos;?>" value="<?php echo $diasFestivos;?>" />

    </td>

    

<td>

<output style="display:none" id="<?php echo $campoTotalDiasFestivos;?>" name="<?php echo $campoTotalDiasFestivos;?>"><?php echo $totalDiasFestivos;?></output>

<input type="text" size="5" id="<?php echo $inputcampoTotalDiasFestivos;?>" name="<?php echo $NmTotalDiasFestivos;?>" value="<?php echo $totalDiasFestivos;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoTotalDiasFestivosImss;?>" name="<?php echo $campoTotalDiasFestivosImss;?>"><?php echo $totalDiasFestivosImss;?></output>

<input type="hidden" id="<?php echo $inputcampoTotalDiasFestivosImss;?>" name="<?php echo $NmTotalDiasFestivosImss;?>" value="<?php echo $totalDiasFestivosImss;?>" />

</td>



<td>

    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoVacaciones;?>" />   

    <output style="display:none" id="<?php echo $campoNumeroDiasVacaciones;?>" name="<?php echo $campoNumeroDiasVacaciones;?>"><?php echo $vacaciones;?></output>

    <input type="text" size="5" id="<?php echo $inputcampoNumeroDiasVacaciones;?>" name="<?php echo $NmNumeroDiasVacaciones;?>" value="<?php echo $vacaciones;?>" />

    </td>

    

<td>

<output style="display:none" id="<?php echo $campoPrimaVacacional;?>" name="<?php echo $campoPrimaVacacional;?>"><?php echo $primaVacacional?></output>

<input type="text" size="5" id="<?php echo $inputcampoPrimaVacacional;?>" name="<?php echo $NmPrimaVacacional;?>" value="<?php echo $primaVacacional?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoPrimaVacacionalImss;?>" name="<?php echo $campoPrimaVacacionalImss;?>"><?php echo $primaVacacionalImss;?></output>

<input type="hidden" id="<?php echo $inputcampoPrimaVacacionalImss;?>" name="<?php echo $NmPrimaVacacionalImss;?>" value="<?php echo $primaVacacionalImss;?>" />

</td>



<td>

<output style="display:none" id="<?php echo $campoTotalVacaciones;?>" name="<?php echo $campoTotalVacaciones;?>"><?php echo $totalVacaciones;?></output>

<input type="text" size="5" id="<?php echo $inputcampoTotalVacaciones;?>" name="<?php echo $NmTotalVacaciones;?>" value="<?php echo $totalVacaciones;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoTotalVacacionesImss;?>" name="<?php echo $campoTotalVacacionesImss;?>"><?php echo $totalVacacionesImss;?></output>

<input type="hidden" id="<?php echo $inputcampoTotalVacacionesImss;?>" name="<?php echo $NmTotalVacacionesImss;?>" value="<?php echo $totalVacacionesImss;?>" />

</td>



<td>

<output>0</output>

</td>



<td>

<input type="text" id="<?php echo $campoAguinaldo;?>" name="<?php echo $NmAguinaldo;?>" value="<?php echo $aguinaldo?>" size="5" />

</td>



<td>

<input type="text" id="<?php echo $campoComplementoSueldo;?>" name="<?php echo $NmComplementoSueldo;?>" value="<?php echo $complementoSueldo;?>" size="5" />

</td>



<td>

<input type="text" id="<?php echo $campoOtrasPercepciones;?>" name="<?php echo $NmOtrasPercepciones;?>" value="<?php echo $otrasPercepciones;?>" size="5" />

</td>



<td style="display:none">

<output id="<?php echo $campoOtrasPercepcionesFiscal;?>" name="<?php echo $campoOtrasPercepcionesFiscal;?>">0</output>

</td>



<td style="display:none">

<output id="<?php echo $campoPremioPuntualidad;?>" name="<?php echo $campoPremioPuntualidad;?>"><?php echo $premioPuntualidad;?></output>

<input type="hidden" id="<?php echo $inputcampoPremioPuntualidad;?>" name="<?php echo $NmPremioPuntualidad;?>" value="<?php echo $premioPuntualidad;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoPremioAsistencia;?>" name="<?php echo $campoPremioAsistencia;?>"><?php echo $premioAsistencia;?></output>

<input type="hidden" id="<?php echo $inputcampoPremioAsistencia;?>" name="<?php echo $NmPremioAsistencia;?>" value="<?php echo $premioAsistencia;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoDespensa;?>" name="<?php echo $campoDespensa;?>"><?php echo $despensa;?></output>

<input type="hidden" id="<?php echo $inputcampoDespensa;?>" name="<?php echo $NmDespensa;?>" value="<?php echo $despensa;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoBecasEducacionales;?>" name="<?php echo $campoBecasEducacionales;?>"><?php echo $becas;?></output>

<input type="hidden" id="<?php echo $inputcampoBecasEducacionales;?>" name="<?php echo $NmBecasEducacionales;?>" value="<?php echo $becas;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoISR;?>" name="<?php echo $campoISR;?>"><?php echo $isr;?></output>

<input type="hidden" id="<?php echo $inputcampoISR;?>" name="<?php echo $NmISR;?>" value="<?php echo $isr;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoSubsidio;?>" name="<?php echo $campoSubsidio;?>"><?php echo $subsidio;?></output>

<input type="hidden" id="<?php echo $inputcampoSubsidio;?>" name="<?php echo $NmSubsidio;?>" value="<?php echo $subsidio;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoIMSS;?>" name="<?php echo $campoIMSS;?>"><?php echo $imss;?></output>

<input type="hidden" id="<?php echo $inputcampoIMSS;?>" name="<?php echo $NmIMSS;?>" value="<?php echo $imss;?>"/>

</td>



<td>

<output id="<?php echo $campoTotalPercepciones;?>" name="<?php echo $campoTotalPercepciones;?>"><?php echo $totalPercepcionesEmpleado?></output></td>



<td style="display:none">

<output id="<?php echo $campoTotalPercepcionesFiscal;?>" name="<?php echo $campoTotalPercepcionesFiscal;?>"><?php echo $totalPercepcionesEmpleadoFiscal;?></output></td>



<td style="background-color:#FFFFFF"></td>



<td>

<input type="text" id="<?php echo $campoPrestamo;?>" name="<?php echo $NmPrestamo;?>" value="<?php echo $prestamos?>" size="5"/>

</td>



<td>

<input type="text" id="<?php echo $campoCajaAhorro;?>" name="<?php echo $NmCajaAhorro;?>" value="<?php echo $caja;?>" size="5"/>

</td>



<td>

<input type="text" id="<?php echo $campoFonacot;?>" name="<?php echo $NmFonacot;?>" value="<?php echo $fonacot;?>"size="5" />

</td>



<td>

<input type="text" id="<?php echo $campoInfonavit;?>" name="<?php echo $NmInfonavit;?>" value="<?php echo $infonavit;?>" size="5"/>

</td>



<td>

    <img src="../imagenes/sistema/calculadora.png" id="<?php echo $iconoCalculoOtrasDeducciones;?>" />   

    <output id="<?php echo $campoOtrasDeducciones;?>" name="<?php echo $campoOtrasDeducciones;?>"><?php echo $otrasDeducciones;?></output>

    <input type="hidden" id="<?php echo $inputcampoOtrasDeducciones;?>" name="<?php echo $NmOtrasDeducciones;?>" value="<?php echo $otrasDeducciones;?>" />

    <label>Descripción

    <output id="<?php echo $campoDescripcionOtrasDeducciones;?>" name="<?php echo $campoDescripcionOtrasDeducciones;?>"><?php echo $descripcionOtrasDeducciones;?></output>

    <input type="hidden" id="<?php echo $inputcampoDescripcionOtrasDeducciones;?>" name="<?php echo $NmDescripcionOtrasDeducciones;?>" value="<?php echo $descripcionOtrasDeducciones;?>" />

    </label>

</td>



<td>

<input type="text" id="<?php echo $campoPrestamoNavitas;?>" name="<?php echo $NmPrestamoNavitas;?>" value="<?php echo $prestamoAscon;?>" size="5" />

</td>



<td>

<output id="<?php echo $campoTotalDeducciones;?>" name="<?php echo $campoTotalDeducciones;?>"><?php echo $totalDeduccionesEmpleado;?></output></td>



<td style="display:none">

<output id="<?php echo $campoTotalDeduccionesFiscal;?>" name="<?php echo $campoTotalDeduccionesFiscal;?>"><?php echo $totalDeduccionesEmpleadoFiscal;?></output></td>



<td style="background-color:#FFFFFF"></td>



<td>

<output id="<?php echo $campoTOTAL;?>" name="<?php echo $campoTOTAL;?>"><?php echo $totalNominaNormal;?></output>

<input type="hidden" id="<?php echo $inputcampoTOTAL;?>" name="<?php echo $NmcampoTOTAL;?>" value="<?php echo $totalNominaNormal;?>" />

</td>



<td style="display:none">

<output id="<?php echo $campoTOTALFISCAL;?>" name="<?php echo $campoTOTALFISCAL;?>"><?php echo $totalNominaFiscal;?></output>

<input type="hidden" id="<?php echo $inputcampoTOTALFISCAL;?>" name="<?php echo $NmcampoTOTALFISCAL;?>" value="<?php echo $totalNominaFiscal;?>" />

</td>

   

</tr>

<?php }?>

 </tbody>

 

 <tfoot>

<tr>



<td></td>

<td></td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td>&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td style="display:none">&nbsp;</td>

<td>

<output id="<?php echo $campoTOTALPERCEPCIONES;?>"><?php echo $TOTALPERCEPCIONES;?></output>

</td>



<td style="display:none">

<output id="<?php echo $campoTOTALPERCEPCIONESFISCAL;?>"><?php echo $TOTALPERCEPCIONESFISCAL;?></output>

</td>

<td style="background-color:#FFFFFF"></td>

<td></td>

<td></td>

<td></td>

<td></td>

<td></td>

<td></td>

<td><output id="<?php echo $campoTOTALDEDUCCIONES;?>"><?php echo $TOTALDEDUCCIONES;?></output></td>



<td style="display:none"><output id="<?php echo $campoTOTALDEDUCCIONESFISCAL;?>"><?php echo $TOTALDEDUCCIONESFISCAL;?></output></td>



<td style="background-color:#FFFFFF"></td>



<td><output id="<?php echo $campoTOTALNOMINA;?>"><?php echo $TOTALNOMINANORMAL;?></output></td>



<td style="display:none"><output id="<?php echo $campoTOTALNOMINAFISCAL;?>"><?php echo $TOTALNOMINAFISCAL;?></output></td>



</tr>

</tfoot>



</table>







</div>

			

		</div>



 



      



		<div id="footer2">	

        

        <table>

        <tr>

        <td rowspan="2"><label>Observaciones</label><br /><textarea name="observaciones" id="observaciones" cols="60" rows="12"><?php echo $observaciones;?></textarea></td>

        <td></td>

        <td><table border="0">

        <tr>       

        <td>PERCEPCIONES</td>

        <td>

        <output id="<?php echo $NominaPercepciones;?>" name="<?php echo $NominaPercepciones;?>"><?php echo $percepciones;?></output>

        <input type="hidden" id="<?php echo $inputNominaPercepciones;?>" name="<?php echo $inputNominaPercepciones;?>" value="<?php echo $percepciones;?>" />

        </td>

        <td colspan="2">&nbsp;</td>

        <td>HONORARIOS</td>

        <td>

        <output id="<?php echo $NominaHonorarios;?>" name="<?php echo $NominaHonorarios;?>"><?php echo $honorarios;?></output>

        <input type="hidden" id="<?php echo $inputNominaHonorarios;?>" name="<?php echo $inputNominaHonorarios;?>" value="<?php echo $honorarios;?>" />

        </td>

        <td colspan="2">&nbsp;</td>

        <td>RELATIVOS</td>

        <td>

        <output style="visibility:hidden" id="<?php echo $NominaRelativos;?>" name="<?php echo $NominaRelativos;?>"><?php echo $relativos;?></output>

        <input type="text" id="<?php echo $inputNominaRelativos;?>" name="<?php echo $inputNominaRelativos;?>" value="<?php echo $relativos;?>" />

        </td>

        <td colspan="2">&nbsp;</td>

        <td>SUBTOTAL</td>

        <td>

        <output id="<?php echo $NominaSubtotal;?>" name="<?php echo $NominaSubtotal;?>"><?php echo $subtotal_nomi;?></output>

        <input type="hidden" id="<?php echo $inputNominaSubtotal;?>" name="<?php echo $inputNominaSubtotal;?>" value="<?php echo $subtotal_nomi;?>" />

        </td>

        <td colspan="2">&nbsp;</td>

        <td>IVA</td>

        <td>

        <output id="<?php echo $NominaIva;?>"  name="<?php echo $NominaIva;?>"><?php echo $iva;?></output>

        <input type="hidden" id="<?php echo $inputNominaIva;?>"  name="<?php echo $inputNominaIva;?>" value="<?php echo $iva;?>" />

        </td>

        <td colspan="2">&nbsp;</td>

        <td>TOTAL FACTURA</td>

        <td>

        <output id="<?php echo $NominaFactura;?>" name="<?php echo $NominaFactura;?>" ><?php echo $total_factura_nomi;?></output>

        <input type="hidden" id="<?php echo $inputNominaFactura;?>" name="<?php echo $inputNominaFactura;?>" value="<?php echo $total_factura_nomi;?>" />

        </td>

        

        </tr>

        </table>

        <br />

        <label><input <?php echo $tipoRevision;?> name="estado" id="revision"  value="REVISION"   <?php echo $chekedRevision;?> />Revisión  </label>

        <label><input <?php echo $tipoAutorizada;?> name="estado" id="aprobada"  value="AUTORIZADA" <?php echo $chekedAutorizada;?> /> Autorizada   </label>

        <label><input <?php echo $tipoPagada;?> name="estado" id="pagada"    value="PAGADA"     <?php echo $chekedPagada;?> />    Pagada     </label>

        <label><input <?php echo $tipoFacturada;?> name="estado" id="facturada" value="FACTURADA"  <?php echo $chekedFacturada;?> />   Facturada     </label>

        

        <br />

        <br />

        

        <input <?php echo $tipobotonAceptar;?> name="cancelar" id="aceptar" value="ACEPTAR"   />        

        <input <?php echo $tipobotonProcesar;?> name="guardar"  id="guardar"  value="Procesar Nómina" />

        <input <?php echo $tipobotonCancelar;?> name="cancelar" id="cancelar" value="Cancelar" />

        </td>

        </tr>

        <tr>

        <td></td>

        <td> </td>

        </tr>

        </table>

        

        

         <br />

        

       

        

        <br />

       

        

       

		</div>

        

       



        

        

	</div>



   























</form>





<div style="display:none">

<div id="targetall" class="target"></div>

</div>  







          

</body>

</html>

