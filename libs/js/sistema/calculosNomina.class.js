/*
??????????????????????????????????????????????????????????????????????????????????
SI NO EXISTE UN CALCULO DE SUELDO Y SE CALCULAN EL RESTO DE CONCEPTOS, QUE PASARÁ CON ESOS CALCULOS?
HASTA AHORA SE GENERAN SIN PROBLEMAS, SIN EMBARGO DURANTE LA SUMA DE PERCEPCIONES, EL SUELDO SE TOMA EN CERO 0
??????????????????????????????????????????????????????????????????????????????????
_____________________________________________
tabla empleados
_antiguedad:antiguedada usuario
_fecha_alta:fecha cunado creamos al usuario

tabla percepciones empleados
diasproporcionales
________________________________________________
*Esta clase esta diseñada para realizar los calculos "al vuelo de las nominas", 
*para que el usuario pueda verlas en las vistas respectivas.
*
*
*
*
* $("input[name='"+arreglo+"']").each(function() {
			  });
*/
var calculosNomina=function(controlador){
	this.controlador=controlador
	this.pila=Array();
	this.parametros;
	this.formularioValidar;
	this.cuotaTrabajador=2.375;
	/*
	este valor es usado en: 
	1.-navitas/administrador/mod_nominas/controller/NominaAdminController.php--> accion:agregarEmpleadoNuevo.
	2.-navitas/clientes/mod_nominas/view/nuevaNominaClienteXPeriodo.php al mostrar el valor del campo sueldoDiarioFiscal.
	
	si este valor cambia en un futuro, debera ser sustituido en los 2 archivos antes listados.
	
	[this.factorImss=1.0452;]
	
	
	*/
	this.factorImss=1.0452;
	this.factorHorasExtras=2;
	this.factorPrimaDominical=.25;//25%
	this.factorDescansos=2;
	this.factorDiasFestivos=2;
	this.factorPrimaVacacional=.25;
	
	this.factorLimitePuntualidadAsistencia=.10;
	this.salarioDF=59.82;
	this.factorLimiteSalarioDF=.4;
	
	this.factorHonorarios=100;
	
	this.tipoNomina;
	
	
	
	
	this.id_campo;
	this.id_empleado;
	this.nombre;
			
	this.sueldoDiario=0;
	this.sueldoDiarioImss=0;//con factor
	this.sueldoDiarioImssSinFactor=0;//sueldo imss sin el factor
	this.sueldoIntegrado=0;//es el total del sueldoDiarioImss[sin factor]*diasTrabajados
	this.sueldoDiarioXHora=0;
	this.sueldoDiarioImssXHora=0;
	this.diasTrabajados=0;
	this.diasTrabajadosISRSUBIMSS=0;
	this.horasExtras=0;	
	
	this.Sueldo=0;
	this.SueldoImss=0;
	this.totalHorasExtras=0;
	
	this.totalSueldoImss=0;
	this.totalSueldoImssIntegrado=0;
	
	this.ISR=0;
	this.subsidioEmpleo=0;
	this.IMSS=0;
	
	this.tipoOtrasPercepciones;
	
	this.totalPercepciones=0;
	this.totalPercepcionesFiscal=0;
	this.totalDeducciones=0;
	this.totalDeduccionesFiscal=0;
	this.totalEmpleado=0;
	this.totalEmpleadoFiscal=0;
	
	this.ventana={
		"nombre":"",
		"alto":200,
		"ancho":500
		};
	        this.ApilarFunciones("calcularTotalPercepciones");
            this.ApilarFunciones("calcularTotalDeducciones");
            this.ApilarFunciones("calcularTotalEmpleado");  
			
			
                                    
            this.ApilarFunciones("ajustarNominaNaturalFiscal");
            
			
            this.ApilarFunciones("calcularTotalPercepciones");
            this.ApilarFunciones("calcularTotalDeducciones");
            this.ApilarFunciones("calcularTotalEmpleado");
			
           
            
            this.ApilarFunciones("ajustarFiscalNatural"); 
            
            
            this.ApilarFunciones("calcularTotalPercepciones");
            this.ApilarFunciones("calcularTotalDeducciones");
            this.ApilarFunciones("calcularTotalEmpleado");
			
			
           
		   
            this.ApilarFunciones("calcularTOTALPERCEPCIONES");
            this.ApilarFunciones("calcularTOTALDEDUCCIONES");
            this.ApilarFunciones("calcularTOTALNOMINA");
            
            
            
            
            
           
	
	};
	
calculosNomina.prototype=new transaccionesPostGet("");
/*
se queda vacio debido a que no podemos setear aqui el grupo, ya que lo usarán los clientes y los administradores.
por lo tanto se seteará posterior a ser instanciado.

*/

calculosNomina.prototype.constructor=calculosNomina;

calculosNomina.prototype.init_calculos=function(parametros,capa,accion,tipo)
{
	    var controlador=this.controlador;
		var capa=capa;
		var parametros=parametros;
		var accion=accion;
		var tipo=tipo;
		
		this.init(controlador,accion,parametros,capa,tipo)		
		this.construir_parametros();
		this.construir_url();		
	
	
	};
	
calculosNomina.prototype.init_calculosNomina=function(id_campo)
{
	this.id_campo=id_campo;
};
calculosNomina.prototype.extraerID=function()
{
		
		var nombre=this.id_campo.split("_");
		this.nombre=nombre[0];
		this.id_empleado=nombre[1];		
		};
calculosNomina.prototype.lanzarOperacion=function(){		

		switch(this.nombre){
			case "diasTrabajados":
			this.calcularSueldo();
			this.calcularISRSUBIMSS();								
			break;
			case "ventanaHoraExtra":
			this.ventana.nombre="horasExtras.php";						
			this.mostrarHorasExtras();
			break;
			case "ventanaDomingoTrabajado":
			this.ventana.nombre="domingosTrabajados.php";						
			this.mostrarDomingosTrabajados();
			break;			
			case "ventanaTurnoTrabajado":
			this.ventana.nombre="turnosTrabajados.php";						
			this.mostrarTurnosTrabajados();
			break;
			case "ventanaDescansoTrabajado":
			this.ventana.nombre="descansosTrabajados.php";						
			this.mostrarDescansosTrabajados();
			break;
			case "ventanaDiasFestivos":
			this.ventana.nombre="diasFestivos.php";						
			this.mostrarDiasFestivos();
			break;
			case "ventanaVacaciones":
			this.ventana.nombre="vacaciones.php";						
			this.mostrarVacaciones();
			break;
			
			case "aguinaldo":
			var that=this;   
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
			break;
			case "complementoSueldo":
			 var that=this;  
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
			break;
			
			case "otrasPercepciones":
			var OtpercepcionNormal=$("#otrasPercepciones_"+this.id_empleado).val();
			$("#otrasPercepcionesFiscal_"+this.id_empleado).val(OtpercepcionNormal);			
			this.calcularDistribucionOtrasPercepcionesNormal();
			this.calcularDistribucionOtrasPercepcionesFiscal();
			var that=this;	
			$.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });			 
			break;
			
			case "prestamo":
			 var that=this;  
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
			break;
			
			case "cajaAhorro":
			 var that=this;  
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
			break;
			
			case "fonacot":
			 var that=this;  
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
			break;
			
			case "infonavit":
			 var that=this;  
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
			break;
			
			case "ventanaOtrasDeducciones":
			this.ventana.nombre="otrasDeducciones.php";						
			this.mostrarOtrasDeducciones();
			break;
			
			case "prestamoNavitas":
			var that=this;   
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
			break;
			
			/********************PARCHE DE CODIGO*******************/
			case "inputTotalHorasExtras":
			$("#TotalHorasExtras_"+this.id_empleado).val($("#inputTotalHorasExtras_"+this.id_empleado).val());
			var that=this;
			 $.each(that.pila,function(indice,valor){                    
            eval("that."+that.pila[indice]+"()");
            });          
			
			break;
			
			
			case "inputTotalDomingosTrabajados":
			jAlert("Recuerde, que este total debe tener agregado en suma la prima dominical","Advertencia!!!");
			$("#TotalDomingosTrabajados_"+this.id_empleado).val($("#inputTotalDomingosTrabajados_"+this.id_empleado).val());
			var that=this;
			 $.each(that.pila,function(indice,valor){                    
            eval("that."+that.pila[indice]+"()");
            });  
			break;
			
			case "inputTotalTurnosTrabajados":			
			$("#TotalTurnosTrabajados_"+this.id_empleado).val($("#inputTotalTurnosTrabajados_"+this.id_empleado).val());
			var that=this;
			 $.each(that.pila,function(indice,valor){                    
            eval("that."+that.pila[indice]+"()");
            });  
			break;
			
			case "inputTotalDescansosTrabajados":			
			$("#TotalDescansosTrabajados_"+this.id_empleado).val($("#inputTotalDescansosTrabajados_"+this.id_empleado).val());
			var that=this;
			 $.each(that.pila,function(indice,valor){                    
            eval("that."+that.pila[indice]+"()");
            });  
			break;
			
			case "inputTotalDiasFestivos":			
			$("#TotalDiasFestivos_"+this.id_empleado).val($("#inputTotalDiasFestivos_"+this.id_empleado).val());
			var that=this;
			 $.each(that.pila,function(indice,valor){                    
            eval("that."+that.pila[indice]+"()");
            });  
			break;
			
			case "inputTotalVacaciones":
			jAlert("Recuerde, que este total debe tener agregado en suma la prima vacacional","Advertencia!!!");
			$("#TotalVacaciones_"+this.id_empleado).val($("#inputTotalVacaciones_"+this.id_empleado).val());
			var that=this;
			 $.each(that.pila,function(indice,valor){                    
            eval("that."+that.pila[indice]+"()");
            });  
			break;
			/***************************************/
			
			default:								
			break;
			};
			
			
		};
		
		
	
calculosNomina.prototype.calcularSueldo=function()
	 {
		 var diasT=0;
		 this.tipoNomina=$("#tipoNomina").val();
		 this.sueldoDiario=$("#sueldoDiario_"+this.id_empleado).val();
		 this.diasTrabajados=$("#diasTrabajados_"+this.id_empleado).val();		 
		 this.sueldoDiarioImss=($("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss);
		 sueldoFiscal=$("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss;
		 
		 
		 if(this.tipoNomina=="semanal" &&  this.diasTrabajados >7){
			 diasT=this.diasTrabajados/8;			 
			 }else{
				 diasT=this.diasTrabajados;
				 }		 	
		 
		 
		 
		 this.Sueldo=this.sueldoDiario*this.diasTrabajados;
		 this.SueldoImss=this.sueldoDiarioImss*diasT;	
		 
		 
		 $("#SueldoTotal_"+this.id_empleado).val(this.Sueldo.toFixed(2));
		 $("#SueldoTotalImss_"+this.id_empleado).val(this.SueldoImss.toFixed(2));			
		 $("#inputSueldoTotal_"+this.id_empleado).val(this.Sueldo.toFixed(2));
		 $("#inputSueldoTotalImss_"+this.id_empleado).val(this.SueldoImss.toFixed(2));
		 $("#sueldoDiarioFiscal_"+this.id_empleado).val(sueldoFiscal.toFixed(2));
		 $("#inputsueldoDiarioFiscal_"+this.id_empleado).val(sueldoFiscal.toFixed(2));
		 
		 
		 
		 };
	
		
calculosNomina.prototype.mostrarHorasExtras=function()
{
	this.sueldoDiario=$("#sueldoDiario_"+this.id_empleado).val()
	this.sueldoDiarioImss=($("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss);
	this.sueldoDiarioXHora=this.sueldoDiario/8;
	this.sueldoDiarioImssXHora=this.sueldoDiarioImss/8;
	var horas=$("#NumeroHorasExtras_"+this.id_empleado).val()
	var parametros={
		"ventanaEmergente":this.ventana.nombre,
		"numeroHoras":horas,		
		"sueldoDiario":this.sueldoDiarioXHora,
		"sueldoDiarioImss":this.sueldoDiarioImssXHora,
		"factor":this.factorHorasExtras
		}
	
	var that=this;
	this.init_calculos(parametros,capa="",accion="ventanaEmergente",tipo="POST");
	this.ejecutar(function(RespuestaAjax){
		$.modal(RespuestaAjax,{containerCss:{		
		height:that.ventana.alto,
		width:that.ventana.ancho
		}
	});	
	
	});
	}

calculosNomina.prototype.calcularHorasExtras=function()
{
	this.formularioValidar="formHorasExtras";
	var sueldoDiarioXHora=$("#sueldo_hora").val()//variable local	
	var factorHorasExtras=$("#factor").val()//variable local
	
	
	if(this.validarCampos())
	{
		var numeroHoras=$("#no_horas").val();
		var total=numeroHoras*sueldoDiarioXHora*factorHorasExtras;
		var totalImss=numeroHoras*this.sueldoDiarioImssXHora*this.factorHorasExtras;
		
		$("#NumeroHorasExtras_"+this.id_empleado).val(numeroHoras);
		$("#TotalHorasExtras_"+this.id_empleado).val(total.toFixed(2));
		$("#TotalHorasExtrasImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		$("#inputNumeroHorasExtras_"+this.id_empleado).val(numeroHoras);
		$("#inputTotalHorasExtras_"+this.id_empleado).val(total.toFixed(2));
		$("#inputTotalHorasExtrasImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		var that=this;    
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          		 
		
		this.cerrarModal();
	}
	
	
	
			

	};
	
calculosNomina.prototype.mostrarDomingosTrabajados=function()
{
	this.sueldoDiario=$("#sueldoDiario_"+this.id_empleado).val()
	this.sueldoDiarioImss=($("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss);	
	var domingos=$("#NumeroDomingosTrabajados_"+this.id_empleado).val()
	var parametros={
		"ventanaEmergente":this.ventana.nombre,
		"numeroDomingos":domingos,		
		"sueldoDomingo":this.sueldoDiario,
		"sueldoDomingoImss":this.sueldoDiarioImss,
		"factor":this.factorPrimaDominical
		}
	
	var that=this;
	this.init_calculos(parametros,capa="",accion="ventanaEmergente",tipo="POST");
	this.ejecutar(function(RespuestaAjax){
		$.modal(RespuestaAjax,{containerCss:{		
		height:that.ventana.alto,
		width:that.ventana.ancho
		}
	});	
	
	});
	}

calculosNomina.prototype.calcularDomingosTrabajados=function()
{
	this.formularioValidar="formDomingosTrabajados";
	
	if(this.validarCampos())
	{
		var numeroDomingos=$("#no_domingos").val();
		var sueldo=$("#sueldo_domingos").val();
		var factorPrimaDominical=$("#factorDomingo").val();
		
		
		
		
		var totalDomingos=numeroDomingos*sueldo;
			
		var totalDomingosImss=numeroDomingos*this.sueldoDiarioImss;
		
		var primaDominical=totalDomingos*factorPrimaDominical;
		
		var primaDominicalImss=totalDomingosImss*this.factorPrimaDominical;
		
		var total=totalDomingos+primaDominical;
		var totalImss=totalDomingosImss+primaDominicalImss;
		
		$("#NumeroDomingosTrabajados_"+this.id_empleado).val(numeroDomingos);
		$("#PrimaDominical_"+this.id_empleado).val(primaDominical.toFixed(2));
		$("#PrimaDominicalImss_"+this.id_empleado).val(primaDominicalImss.toFixed(2));
		$("#TotalDomingosTrabajados_"+this.id_empleado).val(total.toFixed(2));
		$("#TotalDomingosTrabajadosImss_"+this.id_empleado).val(totalImss.toFixed(2));

		$("#inputNumeroDomingosTrabajados_"+this.id_empleado).val(numeroDomingos);
		$("#inputPrimaDominical_"+this.id_empleado).val(primaDominical.toFixed(2));
		$("#inputPrimaDominicalImss_"+this.id_empleado).val(primaDominicalImss.toFixed(2));
		$("#inputTotalDomingosTrabajados_"+this.id_empleado).val(total.toFixed(2));
		$("#inputTotalDomingosTrabajadosImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		var that=this;    
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
		this.cerrarModal();
	}
			

	};
	
	
calculosNomina.prototype.mostrarTurnosTrabajados=function()
{
	this.sueldoDiario=$("#sueldoDiario_"+this.id_empleado).val()
	this.sueldoDiarioImss=($("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss);	
	var turnos=$("#NumeroTurnosTrabajados_"+this.id_empleado).val()
	var parametros={
		"ventanaEmergente":this.ventana.nombre,
		"numeroTurnos":turnos,		
		"sueldo":this.sueldoDiario,
		"sueldoImss":this.sueldoDiarioImss		
		}
	
	var that=this;
	this.init_calculos(parametros,capa="",accion="ventanaEmergente",tipo="POST");
	this.ejecutar(function(RespuestaAjax){
		$.modal(RespuestaAjax,{containerCss:{		
		height:that.ventana.alto,
		width:that.ventana.ancho
		}
	});	
	
	});
			

	};

calculosNomina.prototype.calcularTurnosTrabajados=function()
{
	this.formularioValidar="formTurnosTrabajados";
	
	if(this.validarCampos())
	{
		var numeroTurnos=$("#no_turnos").val();
		var sueldoDiario=$("#sueldo_turnos").val();
		var total=numeroTurnos*sueldoDiario;
		var totalImss=numeroTurnos*this.sueldoDiarioImss;		
		
		$("#NumeroTurnosTrabajados_"+this.id_empleado).val(numeroTurnos);	
		$("#TotalTurnosTrabajados_"+this.id_empleado).val(total.toFixed(2));
		$("#TotalTurnosTrabajadosImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		$("#inputNumeroTurnosTrabajados_"+this.id_empleado).val(numeroTurnos);	
		$("#inputTotalTurnosTrabajados_"+this.id_empleado).val(total.toFixed(2));
		$("#inputTotalTurnosTrabajadosImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		var that=this;    
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
		this.cerrarModal();
	}
			

	};
	
	
calculosNomina.prototype.mostrarDescansosTrabajados=function()
{
	this.sueldoDiario=$("#sueldoDiario_"+this.id_empleado).val()
	this.sueldoDiarioImss=($("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss);	
	var descansos=$("#NumeroDescansosTrabajados_"+this.id_empleado).val()
	var parametros={
		"ventanaEmergente":this.ventana.nombre,
		"numeroDescansos":descansos,		
		"sueldo":this.sueldoDiario,
		"sueldoImss":this.sueldoDiarioImss,
		"factor":this.factorDescansos
		}
	
	var that=this;
	this.init_calculos(parametros,capa="",accion="ventanaEmergente",tipo="POST");
	this.ejecutar(function(RespuestaAjax){
		$.modal(RespuestaAjax,{containerCss:{		
		height:that.ventana.alto,
		width:that.ventana.ancho
		}
	});	
	
	});

	};

calculosNomina.prototype.calcularDescansosTrabajados=function()
{
	this.formularioValidar="formDescansosTrabajados";
	
	if(this.validarCampos())
	{
		var numeroDescansos=$("#no_descansos").val();
		var sueldoDiario=$("#sueldo_descansos").val();
		var factorDescansos=$("#factor_descansos").val();
		
		var total=numeroDescansos*sueldoDiario*factorDescansos;
		var totalImss=numeroDescansos*this.sueldoDiarioImss*this.factorDescansos;
		
		$("#NumeroDescansosTrabajados_"+this.id_empleado).val(numeroDescansos);
		$("#TotalDescansosTrabajados_"+this.id_empleado).val(total.toFixed(2));
		$("#TotalDescansosTrabajadosImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		$("#inputNumeroDescansosTrabajados_"+this.id_empleado).val(numeroDescansos);
		$("#inputTotalDescansosTrabajados_"+this.id_empleado).val(total.toFixed(2));
		$("#inputTotalDescansosTrabajadosImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		 var that=this;   
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
		this.cerrarModal();
	}
			

	};
	
calculosNomina.prototype.mostrarDiasFestivos=function()
{
	this.sueldoDiario=$("#sueldoDiario_"+this.id_empleado).val()
	this.sueldoDiarioImss=($("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss);	
	var dias=$("#NumeroDiasFestivos_"+this.id_empleado).val()	
	var parametros={
		"ventanaEmergente":this.ventana.nombre,
		"numeroFestivos":dias,		
		"sueldo":this.sueldoDiario,
		"sueldoImss":this.sueldoDiarioImss,
		"factor":this.factorDiasFestivos		
		}
	
	var that=this;
	this.init_calculos(parametros,capa="",accion="ventanaEmergente",tipo="POST");
	this.ejecutar(function(RespuestaAjax){
		$.modal(RespuestaAjax,{containerCss:{		
		height:that.ventana.alto,
		width:that.ventana.ancho
		}
	});	
	
	});

	};

calculosNomina.prototype.calcularDiasFestivos=function()
{
	this.formularioValidar="formDiasFestivos";
	
	if(this.validarCampos())
	{
		var numeroDias=$("#no_festivos").val();
		var sueldoDiario=$("#sueldo_festivos").val();
		var factorDiasFestivos=$("#factor_festivos").val();
		var total=numeroDias*sueldoDiario*factorDiasFestivos;
		var totalImss=numeroDias*this.sueldoDiarioImss*this.factorDiasFestivos;
		
		$("#NumeroDiasFestivos_"+this.id_empleado).val(numeroDias);
		$("#TotalDiasFestivos_"+this.id_empleado).val(total.toFixed(2));
		$("#TotalDiasFestivosImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		$("#inputNumeroDiasFestivos_"+this.id_empleado).val(numeroDias);
		$("#inputTotalDiasFestivos_"+this.id_empleado).val(total.toFixed(2));
		$("#inputTotalDiasFestivosImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		var that=this;    
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
		this.cerrarModal();
	}
			

	};
calculosNomina.prototype.mostrarVacaciones=function()
{
	this.sueldoDiario=$("#sueldoDiario_"+this.id_empleado).val()
	this.sueldoDiarioImss=($("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss);	
	var vacaciones=$("#NumeroDiasVacaciones_"+this.id_empleado).val()
	var parametros={
		"ventanaEmergente":this.ventana.nombre,
		"numeroVacaciones":vacaciones,		
		"sueldo":this.sueldoDiario,
		"sueldoImss":this.sueldoDiarioImss,
		"factor":this.factorPrimaVacacional
		}
	
	var that=this;
	this.init_calculos(parametros,capa="",accion="ventanaEmergente",tipo="POST");
	this.ejecutar(function(RespuestaAjax){
		$.modal(RespuestaAjax,{containerCss:{		
		height:that.ventana.alto,
		width:that.ventana.ancho
		}
	});	
	
	});
			

	};
	

calculosNomina.prototype.calcularVacaciones=function()
{
	this.formularioValidar="formVacaciones";
	
	if(this.validarCampos())
	{
		var numeroVacaciones=$("#no_vacaciones").val();
		var sueldoDiario=$("#sueldo_vacaciones").val();
		var factorPrimaVacacional=$("#factorVacaciones").val();
		
		var totalVacaciones=numeroVacaciones*sueldoDiario;
		var totalVacacionesImss=numeroVacaciones*this.sueldoDiarioImss;
		
		var primaVacacional=totalVacaciones*factorPrimaVacacional;
		var primaVacacionalImss=totalVacacionesImss*this.factorPrimaVacacional;
		
		var total=totalVacaciones+primaVacacional;
		var totalImss=totalVacacionesImss+primaVacacionalImss;
		
		$("#NumeroDiasVacaciones_"+this.id_empleado).val(numeroVacaciones);
		$("#PrimaVacacional_"+this.id_empleado).val(primaVacacional.toFixed(2));
		$("#PrimaVacacionalImss_"+this.id_empleado).val(primaVacacionalImss.toFixed(2));
		$("#TotalVacaciones_"+this.id_empleado).val(total.toFixed(2));
		$("#TotalVacacionesImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		$("#inputNumeroDiasVacaciones_"+this.id_empleado).val(numeroVacaciones);
		$("#inputPrimaVacacional_"+this.id_empleado).val(primaVacacional.toFixed(2));
		$("#inputPrimaVacacionalImss_"+this.id_empleado).val(primaVacacionalImss.toFixed(2));
		$("#inputTotalVacaciones_"+this.id_empleado).val(total.toFixed(2));
		$("#inputTotalVacacionesImss_"+this.id_empleado).val(totalImss.toFixed(2));
		
		 var that=this;   
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
		this.cerrarModal();
	}
			

	};


calculosNomina.prototype.calcularDistribucionOtrasPercepcionesNormal=function(){
	//para la nomina normal, no existe sufijo, por lo que queda vacio el valor.
	this.tipoOtrasPercepciones="";
	this.calcularDistribucionOtrasPercepciones();
	}	
calculosNomina.prototype.calcularDistribucionOtrasPercepcionesFiscal=function(){
	this.tipoOtrasPercepciones="Fiscal";
	this.calcularDistribucionOtrasPercepciones();
	}	

calculosNomina.prototype.calcularDistribucionOtrasPercepciones=function(){
	var that=this;
	this.diasTrabajados=$("#diasTrabajados_"+this.id_empleado).val();
	/*
	if(this.diasTrabajados==0 || this.diasTrabajados.length==0)
	{
		jAlert("Se requiere el numero de dias trabajados, \n de lo contrario obtendrá valores en 0 que pueden ser perjudiciales para los calculos finales.","Alerta!",function(){
			$("#otrasPercepcionesFiscal_"+that.id_empleado).val(0);
			$("#otrasPercepciones_"+that.id_empleado).val(0);			
			$("#diasTrabajados_"+that.id_empleado).val(0);
			$("#diasTrabajados_"+that.id_empleado).focus().select();
			$.each(that.pila,function(indice,valor){
				eval("that."+that.pila[indice]+"()");
				});
					
			});
			
		return false;
			
		}
		*/
	this.sueldoDiarioImss=($("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss);
	this.sueldoDiarioImssSinFactor=$("#sueldoDiarioImss_"+this.id_empleado).val();
	
	
	this.sueldoIntegrado=this.sueldoDiarioImssSinFactor*this.diasTrabajados;
		
	var limiteAplicar=this.sueldoIntegrado*this.factorLimitePuntualidadAsistencia;
	var TotalSalarioDF=this.salarioDF=(59.82*this.factorLimiteSalarioDF)*this.diasTrabajados
	
	var otrasPercepciones=parseFloat($("#otrasPercepciones"+this.tipoOtrasPercepciones+"_"+this.id_empleado).val());	
	var premioPuntualidad=0;
	var premioAsistencia=0; 
	var despensa=0;
    var becasEducacionales=0;
	

				
	
	if(otrasPercepciones!=0)
	{
		if(otrasPercepciones<=limiteAplicar)
		{
			
			premioPuntualidad=otrasPercepciones;
			premioAsistencia=0; 
			despensa=0;
			becasEducacionales=0;
			}else{
				
				premioPuntualidad=limiteAplicar;
				otrasPercepciones=otrasPercepciones-limiteAplicar;
				
				if(otrasPercepciones<=limiteAplicar)
				{
					premioAsistencia=otrasPercepciones;
					despensa=0;
					becasEducacionales=0;
					otrasPercepciones=0;
					}else{
						
							premioAsistencia=limiteAplicar;
							otrasPercepciones=otrasPercepciones-limiteAplicar;
							
							if(otrasPercepciones>0)
							{
								
								if(otrasPercepciones>TotalSalarioDF)
								{
									despensa=TotalSalarioDF;
									otrasPercepciones=otrasPercepciones-TotalSalarioDF;
									becasEducacionales=otrasPercepciones;
									otrasPercepciones=0;
									}else{
										despensa=otrasPercepciones;
										becasEducacionales=0;
										otrasPercepciones=0;
										}
									
								}else{
									despensa=0;
									becasEducacionales=0;
									}
							
                            
							}
				}
			
			
			
		
		}else{
			premioPuntualidad=0;
			premioAsistencia=0; 
			despensa=0;
			becasEducacionales=0; 
			}
		
		
		$("#premioPuntualidad_"+this.id_empleado).val(premioPuntualidad.toFixed(2));
		$("#premioAsistencia_"+this.id_empleado).val(premioAsistencia.toFixed(2));
		$("#despensa_"+this.id_empleado).val(despensa.toFixed(2));
		$("#becasEducacionales_"+this.id_empleado).val(becasEducacionales.toFixed(2));
		
		$("#inputpremioPuntualidad_"+this.id_empleado).val(premioPuntualidad.toFixed(2));
		$("#inputpremioAsistencia_"+this.id_empleado).val(premioAsistencia.toFixed(2));
		$("#inputdespensa_"+this.id_empleado).val(despensa.toFixed(2));
		$("#inputbecasEducacionales_"+this.id_empleado).val(becasEducacionales.toFixed(2));	
		
		
		
	}
	

calculosNomina.prototype.calcularISRSUBIMSS=function(){
	this.diasTrabajados=$("#diasTrabajados_"+this.id_empleado).val();
	
	if(this.diasTrabajados==0 || this.diasTrabajados.lenght==0){
		this.ISR=0;
		this.subsidioEmpleo=0;
		this.IMSS=0;
		that=this;
		$("#ISR_"+this.id_empleado).val(this.ISR.toFixed(2));
		$("#SUBSIDIO_"+this.id_empleado).val(this.subsidioEmpleo.toFixed(2));
		$("#IMSS_"+this.id_empleado).val(this.IMSS.toFixed(2));	
		$("#inputISR_"+this.id_empleado).val(this.ISR.toFixed(2));
		$("#inputSUBSIDIO_"+this.id_empleado).val(this.subsidioEmpleo.toFixed(2));
		$("#inputIMSS_"+this.id_empleado).val(this.IMSS.toFixed(2));		
		$.each(that.pila,function(indice,valor){			
			/*
			Esta es una mala solucion al problema de apilado de funciones.
			En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
			que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval(); 			
			
			*/
			eval("that."+that.pila[indice]+"()");
		});
		return false;
		}
	this.sueldoDiarioImss=($("#sueldoDiarioImss_"+this.id_empleado).val()/this.factorImss);
	this.sueldoDiarioImssSinFactor=$("#sueldoDiarioImss_"+this.id_empleado).val();	
	this.tipoNomina=$("#tipoNomina").val();
	
	this.calcularDiasTrabajadosISRSUBIMSS();
	
	this.totalSueldoImss=this.sueldoDiarioImss*this.diasTrabajadosISRSUBIMSS;
	this.totalSueldoImssIntegrado=this.sueldoDiarioImssSinFactor*this.diasTrabajadosISRSUBIMSS;
	
	
	
	
	
	this.calcularISR();
	this.calcularSubsidioEmpleo();
	this.calcularIMSS();	
	}
	
calculosNomina.prototype.calcularDiasTrabajadosISRSUBIMSS=function()
{	
	if(this.tipoNomina==='semanal' && this.diasTrabajados>=8)
	{
		this.diasTrabajadosISRSUBIMSS=this.diasTrabajados/8;
		}else{
			this.diasTrabajadosISRSUBIMSS=this.diasTrabajados;
			}
			
	}

calculosNomina.prototype.ApilarFunciones=function(funcion){
	this.pila.push(funcion);
	}
calculosNomina.prototype.VaciarPila=function(){
	this.pila=Array();
	}
calculosNomina.prototype.calcularISR=function(){	
	var parametros={
		"totalSueldoImss":this.totalSueldoImss,
		"tipoNomina":this.tipoNomina
		};
			
	var that=this;	
	this.init_calculos(parametros,capa="",accion="calcularISR",tipo="POST");
	this.ejecutar(function(RespuestaAjax){	
		that.ISR=RespuestaAjax;		
		$("#ISR_"+that.id_empleado).val(parseFloat(that.ISR).toFixed(2));	
		$("#inputISR_"+that.id_empleado).val(parseFloat(that.ISR).toFixed(2));
		});
	
	}
calculosNomina.prototype.calcularSubsidioEmpleo=function(){	
	var parametros={
		"totalSueldoImss":this.totalSueldoImss,
		"tipoNomina":this.tipoNomina
		};
	var that=this;
	this.init_calculos(parametros,capa="",accion="calcularSubsidioEmpleo",tipo="POST");
	this.ejecutar(function(RespuestaAjax){				
		that.subsidioEmpleo=RespuestaAjax;		
		$("#SUBSIDIO_"+that.id_empleado).val(parseFloat(that.subsidioEmpleo).toFixed(2));
		$("#inputSUBSIDIO_"+that.id_empleado).val(parseFloat(that.subsidioEmpleo).toFixed(2));
		});	
	};
calculosNomina.prototype.calcularIMSS=function(){	
	var parametros={
		"totalSueldoImssIntegrado":this.totalSueldoImssIntegrado,
		"factorIntegracion":this.factorImss,
		"cuotaTrabajador":this.cuotaTrabajador
		};
	var that=this;
	this.init_calculos(parametros,capa="",accion="calcularIMSS",tipo="POST");
	this.ejecutar(function(RespuestaAjax){			
		that.IMSS=RespuestaAjax;
		$("#IMSS_"+that.id_empleado).val(parseFloat(that.IMSS).toFixed(2));		
		$("#inputIMSS_"+that.id_empleado).val(parseFloat(that.IMSS).toFixed(2));
		$.each(that.pila,function(indice,valor){
			/*
			Esta es una mala solucion al problema de apilado de funciones.
			En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
			que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval(); 			
			
			*/
			eval("that."+that.pila[indice]+"()")			
			});			
		});	
	
	};
	
/*DEDUCCIONES*/
calculosNomina.prototype.mostrarOtrasDeducciones=function(){
	var descripcion=$("#descripcionOtrasDeducciones_"+this.id_empleado).val();
	var monto=$("#otrasDeducciones_"+this.id_empleado).val();
	
	var parametros={
		"ventanaEmergente":this.ventana.nombre,
		"descripcion":descripcion,		
		"monto":monto,		
		};
	
	that=this;
	this.init_calculos(parametros,capa="",accion="ventanaEmergente",tipo="POST");
	this.ejecutar(function(RespuestaAjax){
		$.modal(RespuestaAjax,{
			containerCss:{
				height:that.ventana.alto,
				width:that.ventana.ancho
				}
		});
	});
			

	};

calculosNomina.prototype.calcularOtrasDeducciones=function()
{
	this.formularioValidar="formOtrasDeducciones";
	
	if(this.validarCampos())
	{
		var descripcion=$("#descripcion_ot_deducciones").val();
		var cantidad=$("#cantidad_ot_deducciones").val();
		
		$("#descripcionOtrasDeducciones_"+this.id_empleado).val(descripcion);
		$("#otrasDeducciones_"+this.id_empleado).val(cantidad);
		$("#inputdescripcionOtrasDeducciones_"+this.id_empleado).val(descripcion);
		$("#inputotrasDeducciones_"+this.id_empleado).val(cantidad);
		var that=this;    
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });          
		this.cerrarModal();	
		}	
	}
	
calculosNomina.prototype.calcularTotalDeducciones=function()
{
	
	//en sumas en necesario convertir a float
	
	//NORMAL
	var prestamos=parseFloat($("#prestamo_"+this.id_empleado).val());
	var cajaAhorro=parseFloat($("#cajaAhorro_"+this.id_empleado).val());
	var fonacot=parseFloat($("#fonacot_"+this.id_empleado).val());
	var infonavit=parseFloat($("#infonavit_"+this.id_empleado).val());
	var otrasDeducciones=parseFloat($("#otrasDeducciones_"+this.id_empleado).val());
	var prestamoNavitasAscon=parseFloat($("#prestamoNavitas_"+this.id_empleado).val());
	
	//FISCAL
	var isr=parseFloat($("#ISR_"+this.id_empleado).val());
	var imss=parseFloat($("#IMSS_"+this.id_empleado).val());
	
	
	this.totalDeducciones=prestamos+cajaAhorro+fonacot+infonavit+otrasDeducciones+prestamoNavitasAscon;
	
	//en la nomina fiscal, en las deducciones no existe el concepto prestamo navitas(ASCON)
	//adicionalmente a la nomina fiscal,en deducciones, se suma el ISR y el IMSS
	this.totalDeduccionesFiscal=prestamos+cajaAhorro+fonacot+infonavit+otrasDeducciones+isr+imss;
	
	$("#totalDeducciones_"+this.id_empleado).val(this.totalDeducciones.toFixed(2));
	$("#totalDeduccionesFiscal_"+this.id_empleado).val(this.totalDeduccionesFiscal.toFixed(2));
	
		
	
	}
/*DEDUCCIONES*/
	

calculosNomina.prototype.calcularTotalPercepciones=function()
{
	
	var sueldo=parseFloat($("#SueldoTotal_"+this.id_empleado).val());
	var horasExtras=parseFloat($("#TotalHorasExtras_"+this.id_empleado).val());
	var domingosTrabajados=parseFloat($("#TotalDomingosTrabajados_"+this.id_empleado).val());
	var turnosTrabajados=parseFloat($("#TotalTurnosTrabajados_"+this.id_empleado).val());
	var descansosTrabajados=parseFloat($("#TotalDescansosTrabajados_"+this.id_empleado).val());
	var diasFestivos=parseFloat($("#TotalDiasFestivos_"+this.id_empleado).val());
	var vacaciones=parseFloat($("#TotalVacaciones_"+this.id_empleado).val());
	
	var aguinaldo=parseFloat($("#aguinaldo_"+this.id_empleado).val());
	var complementoSueldo=parseFloat($("#complementoSueldo_"+this.id_empleado).val());
	var otrasPercepciones=parseFloat($("#otrasPercepciones_"+this.id_empleado).val());
	
	var sueldoImss=parseFloat($("#SueldoTotalImss_"+this.id_empleado).val());
	var horasExtrasImss=parseFloat($("#TotalHorasExtrasImss_"+this.id_empleado).val());
	var domingosTrabajadosImss=parseFloat($("#TotalDomingosTrabajadosImss_"+this.id_empleado).val());
	var turnosTrabajadosImss=parseFloat($("#TotalTurnosTrabajadosImss_"+this.id_empleado).val());
	var descansosTrabajadosImss=parseFloat($("#TotalDescansosTrabajadosImss_"+this.id_empleado).val());
	var diasFestivosImss=parseFloat($("#TotalDiasFestivosImss_"+this.id_empleado).val());
	var vacacionesImss=parseFloat($("#TotalVacacionesImss_"+this.id_empleado).val());
	var subsidioEmpleo=parseFloat($("#SUBSIDIO_"+this.id_empleado).val());
	
	var puntualidad=parseFloat($("#premioPuntualidad_"+this.id_empleado).val());
	var asistencia=parseFloat($("#premioAsistencia_"+this.id_empleado).val());
	var despensa=parseFloat($("#despensa_"+this.id_empleado).val());
	var becas=parseFloat($("#becasEducacionales_"+this.id_empleado).val());
	
	var otrasPercepcionesImss=puntualidad+asistencia+despensa+becas;
		
	
	
	this.totalPercepciones=
	sueldo+
	horasExtras+
	domingosTrabajados+
	turnosTrabajados+
	descansosTrabajados+
	diasFestivos+
	vacaciones+
	aguinaldo+
	complementoSueldo+
	otrasPercepciones;
	
	//complementoSueldo este concepto no existe en la nomina fiscal
	//adicionalmente se suma el subsidio al empleo a la nomina fiscal
	this.totalPercepcionesFiscal=
	sueldoImss+
	horasExtrasImss+
	domingosTrabajadosImss+
	turnosTrabajadosImss+
	descansosTrabajadosImss+
	diasFestivosImss+
	vacacionesImss+
	aguinaldo+	
	otrasPercepcionesImss+
	subsidioEmpleo
	;
	


	$("#TotalPercepciones_"+this.id_empleado).val(this.totalPercepciones.toFixed(2));
	$("#TotalPercepcionesFiscal_"+this.id_empleado).val(this.totalPercepcionesFiscal.toFixed(2));
	}
	
calculosNomina.prototype.calcularTotalEmpleado=function(){//neto pagar()	
	this.totalEmpleado=this.totalPercepciones-this.totalDeducciones;
	this.totalEmpleadoFiscal=this.totalPercepcionesFiscal-this.totalDeduccionesFiscal;
	$("#totalNominaEmpleado_"+this.id_empleado).val(this.totalEmpleado.toFixed(2));
	$("#totalNominaEmpleadoFiscal_"+this.id_empleado).val(this.totalEmpleadoFiscal.toFixed(2));
	$("#inputtotalNominaEmpleado_"+this.id_empleado).val(this.totalEmpleado.toFixed(2));
	$("#inputtotalNominaEmpleadoFiscal_"+this.id_empleado).val(this.totalEmpleadoFiscal.toFixed(2));	
	}	

calculosNomina.prototype.imprimirV=function(){
	
	
    alert("total: "+$("#totalNominaEmpleado_"+this.id_empleado).val()+"   "+"total fiscal:  "+$("#totalNominaEmpleadoFiscal_"+this.id_empleado).val());
}

calculosNomina.prototype.cancelarModal=function(){
	if($("#no_horas").val()=='0' || $("#no_horas").empty())
	{
		jConfirm('¿Esta seguro que desea cancelar el calculo?', 'Advertencia!', function(r)
		{
			if(r){
				$.modal.close()
				}
			
			});
			
		
		}
	
	}
	
calculosNomina.prototype.cerrarModal=function(){
	$.modal.close();
	}

calculosNomina.prototype.validarCampos=function(){	
	var validado=jQuery("#"+this.formularioValidar).validationEngine("validate");		
	return validado;
	}
	

calculosNomina.prototype.ajustarNominaNaturalFiscal=function(){	//nomina natural - nomina fiscal
	var nominaNatural=$("#totalNominaEmpleado_"+this.id_empleado).val();
	var nominaFiscal=$("#totalNominaEmpleadoFiscal_"+this.id_empleado).val();	
	var diferenciaEntreNominas=nominaNatural-nominaFiscal;	
	var otrasPercepciones=$("#otrasPercepciones_"+this.id_empleado).val()
	var becasEducacionales=parseFloat($("#becasEducacionales_"+this.id_empleado).val());
	
	this.sueldoDiarioImssSinFactor=$("#sueldoDiarioImss_"+this.id_empleado).val();
	this.diasTrabajados=$("#diasTrabajados_"+this.id_empleado).val();	
	this.sueldoIntegrado=this.sueldoDiarioImssSinFactor*this.diasTrabajados;
	
	if(otrasPercepciones>0)//si hay otras percepciones
	{
		if(diferenciaEntreNominas>0)//diferencia positiva, nomina fiscal menor
		{
			becasEducacionales+=diferenciaEntreNominas;
			$("#becasEducacionales_"+this.id_empleado).val(becasEducacionales.toFixed(2));
			$("#inputbecasEducacionales_"+this.id_empleado).val(becasEducacionales.toFixed(2));
			}else{//diferencia negativa,nomina fiscal mayor
				/*????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
				QUE PASARÁ CUANDO NO HAYA OTRAS PERCEPCIONES Y LA DIFERENCIA ENTRA LA NOMINA NOMINA NORMAL MENOS LA NOMINA FISCAL DE NEGATIVO,
				O EN SU DEFECTO, LA NOMINA FISCAL SEA MAYOR QUE LA NOMINA NATURAL(EXCEPCION EN CALCULOS)				
				*/
				}
		
		}else{//si no hay otras percepciones
		
			otrasPercepciones=diferenciaEntreNominas//no importa si es negativo o positivo
			
				
			
			if(otrasPercepciones>0)//si la diferencia entre nominas es positiva
			{
				
				$("#otrasPercepcionesFiscal_"+this.id_empleado).val(otrasPercepciones.toFixed(2));			
				this.calcularDistribucionOtrasPercepcionesFiscal();
				
				}else{//si la diferencia es negativa, fiscal>normal
					
					$("#premioPuntualidad_"+this.id_empleado).val(0);
					$("#premioAsistencia_"+this.id_empleado).val(0);
					$("#despensa_"+this.id_empleado).val(0);
					$("#becasEducacionales_"+this.id_empleado).val(0);
					
					$("#inputpremioPuntualidad_"+this.id_empleado).val(0);
					$("#inputpremioAsistencia_"+this.id_empleado).val(0);
					$("#inputdespensa_"+this.id_empleado).val(0);
					$("#inputbecasEducacionales_"+this.id_empleado).val(0);
					
				}
			
		
			}
		
		//this.calcularTotalDeducciones();
		//this.calcularTotalPercepciones();			
		//this.calcularTotalEmpleado();//neto pagar
		//this.ajustarFiscalNatural();
		//this.calcularTotalEmpleado();
	
	
	

	}
	
	
calculosNomina.prototype.ajustarFiscalNatural=function(){//Ajuste inverso nomina fiscal - nomina nattural
	
	var nominaNatural=$("#totalNominaEmpleado_"+this.id_empleado).val();
	var nominaFiscal=$("#totalNominaEmpleadoFiscal_"+this.id_empleado).val();
	var diferenciaEntreNominas=nominaFiscal-nominaNatural;	
	var subsidio=parseFloat($("#SUBSIDIO_"+this.id_empleado).val());
	var becasEducacionales=parseFloat($("#becasEducacionales_"+this.id_empleado).val());
	
	if(nominaFiscal>nominaNatural)//si nomina fiscal es mayor, diferencia positiva
	{
		subsidio=subsidio-diferenciaEntreNominas;
		$("#SUBSIDIO_"+this.id_empleado).val(subsidio.toFixed(2));
		$("#inputSUBSIDIO_"+this.id_empleado).val(subsidio.toFixed(2));
		}
		
	if(nominaNatural>nominaFiscal)//si nomina fiscal es menor,diferencia negativa,la evaluacion debe ser en cantidad, de lo contrario la diferencia siempre dara negativa
	{
		var faltante=nominaNatural-nominaFiscal;
		becasEducacionales+=faltante;		
		$("#becasEducacionales_"+this.id_empleado).val(becasEducacionales.toFixed(2));
		$("#inputbecasEducacionales_"+this.id_empleado).val(becasEducacionales.toFixed(2));
		}
	
	}



calculosNomina.prototype.calcularTOTALPERCEPCIONES=function(){
	var totalpercepciones=0;
	var totalpercepcionesfiscal=0;
	
	$("output[id*='TotalPercepciones_']").each(function(){		
		totalpercepciones+=parseFloat(this.value);
	});
	
	$("output[id*='TotalPercepcionesFiscal_']").each(function(){
		totalpercepcionesfiscal+=parseFloat(this.value);
	});
	
		
	$("#TOTALPERCEPCIONES").val(totalpercepciones.toFixed(2));
	$("#percepciones").val(totalpercepciones.toFixed(2));
	$("#inputpercepciones").val(totalpercepciones.toFixed(2));
	$("#TOTALPERCEPCIONESFISCAL").val(totalpercepcionesfiscal.toFixed(2));
	
	this.HONORARIOS();
	this.SUBTOTAL();
	this.IVA();
	this.TOTALFACTURA();
	
	
}

calculosNomina.prototype.calcularTOTALDEDUCCIONES=function(){
	var totaldeducciones=0;
	var totaldeduccionesfiscal=0;
	
	$("output[id*='totalDeducciones_']").each(function(){		
		totaldeducciones+=parseFloat(this.value);
	});
	
	$("output[id*='totalDeduccionesFiscal_']").each(function(){
		totaldeduccionesfiscal+=parseFloat(this.value);
	});
	
	$("#TOTALDEDUCCIONES").val(totaldeducciones.toFixed(2));
	$("#TOTALDEDUCCIONESFISCAL").val(totaldeduccionesfiscal.toFixed(2));
}

calculosNomina.prototype.calcularTOTALNOMINA=function(){
	var totalnomina=0;
	var totalnominafiscal=0;
	
	$("output[id*='totalNominaEmpleado_']").each(function(){
		totalnomina+=parseFloat(this.value);
	});
	
	$("output[id*='totalNominaEmpleadoFiscal_']").each(function(){
		totalnominafiscal+=parseFloat(this.value);
	});
	
	$("#TOTALNOMINA").val(totalnomina.toFixed(2));
	$("#TOTALNOMINAFISCAL").val(totalnominafiscal.toFixed(2));
	
	
	
	
}


calculosNomina.prototype.HONORARIOS=function(){	
	var porcentajeHonorarios=parseFloat($("#honorarios_empresa").val())/this.factorHonorarios;
	var honorarios=parseFloat($("#percepciones").val())*porcentajeHonorarios;
	$("#honorarios").val(honorarios.toFixed(2));	
	$("#inputhonorarios").val(honorarios.toFixed(2));
}


calculosNomina.prototype.SUBTOTAL=function(){
	var percepciones=parseFloat($("#percepciones").val());
	var honorarios=parseFloat($("#honorarios").val());
	var relativos=parseFloat($("#relativos").val());	
	var subtotal=percepciones+honorarios+relativos;	
	$("#subtotal").val(subtotal.toFixed(2))
	$("#inputsubtotal").val(subtotal.toFixed(2))

}


calculosNomina.prototype.IVA=function(){
	var porcentajeIva=parseFloat($("#iva_empresa").val())/100;
	var iva=parseFloat($("#subtotal").val())*porcentajeIva;
	$("#iva").val(iva.toFixed(2));
	$("#inputiva").val(iva.toFixed(2));
	
}


calculosNomina.prototype.TOTALFACTURA=function(){
	var subtotal=parseFloat($("#subtotal").val());
	var iva=parseFloat($("#iva").val());
	var total=subtotal+iva;
	
	$("#factura").val(total.toFixed(2));
	$("#inputfactura").val(total.toFixed(2));
	
}

calculosNomina.prototype.recalculoEliminandoColumna=function()
{
	/*
	Esta funcion es implementada en base al recalculo generado por la funcion de sistema "eliminacion de columna",
	ya que este bloque de codigo es el encargado de realizar el recalculo y ajuste de los montos finales de la nomina.
	1.-En el futuro implementar este bloque de codigo como una funcion independiente.
	*/
	var that=this;    
            $.each(that.pila,function(indice,valor){         
            /*
            Esta es una mala solucion al problema de apilado de funciones.
            En el futuro tratar de implementar el api ajax.queue.js o un api de apilado de funciones, 
            que soporte el control de funciones simples (sin ajax) y/o usar callback y eliminar el uso de eval();           
            
            */
            eval("that."+that.pila[indice]+"()");
            });        
	}


	





	
		

	
	
			  
			  
			  
			  

