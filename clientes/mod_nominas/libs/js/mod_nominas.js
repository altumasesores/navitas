/*
MULTIPLES ARGUMNETOS
function sumValues() {
   var sum = 0;
   for (var i = 0; i < arguments.length; i++) {
    sum += arguments[i];
   } 
   return sum;
  }
   
  var R1 = sumValues(3, 5, 6, 2, 7);
  var R2 = sumValues(12, 20);
  */
  
/*extendemos la clase de grupo,para agregarle los metodos que el modulo necesite, sin acumular funciones de otros modulos.
el objetivo es: mantener el orden del codigo js, de cada modulo, y tener en sus respecitvos archivos js, 
solo las funciones que realmente necesita el modulo y que unicamente le pertenecen a el.
*/

/*
		this.init(controlador,accion,parametros,capa,tipo)
		controlador="Nominas"
		accion="consultarNominas"
		parametros={"id":"1","nombre":"juan"}....
		           debe ser un objeto literal o array
		           el objeto literal debe ser: {"id":"1","nombre":"juan"....}
				   el array debe ser: parametros['id']="1" 
				                      parametros['nombre']="juan"
				    NOTA: por facilidad de uso y limpieza de codigo se recomienda un objeto literal.
		capa="cuerpoNomina"
		      debe ser el cuerpo especificado en el contenedor de vistas, no el cuerpo especificado en el index del grupo.
		tipo="GET"/"POST"
		     es el tipo de envío que se usará GET/POST
			 
		*/
  
  
    var atributoJSON=function(atributos)
	{
		this.aguinaldo=atributos.aguinaldo;
		this.cajaAhorro=atributos.cajaAhorro;
		this.complementoSueldo=atributos.complementoSueldo
		this.diasTrabajados=atributos.diasTrabajados
		this.fonacot=atributos.fonacot
		this.idEmpleado=atributos.idEmpleado
		this.infonavit=atributos.infonavit
		this.inputIMSS=atributos.inputIMSS
		this.inputISR=atributos.inputISR
		this.inputNumeroDescansosTrabajados=atributos.inputNumeroDescansosTrabajados
		this.inputNumeroDiasFestivos=atributos.inputNumeroDiasFestivos
		this.inputNumeroDiasVacaciones=atributos.inputNumeroDiasVacaciones
		this.inputNumeroDomingosTrabajados=atributos.inputNumeroDomingosTrabajados
		this.inputNumeroHorasExtras=atributos.inputNumeroHorasExtras
		this.inputNumeroTurnosTrabajados=atributos.inputNumeroTurnosTrabajados
		this.inputPrimaDominical=atributos.inputPrimaDominical
		this.inputPrimaDominicalImss=atributos.inputPrimaDominicalImss
		this.inputPrimaVacacional=atributos.inputPrimaVacacional
		this.inputPrimaVacacionalImss=atributos.inputPrimaVacacionalImss
		this.inputSUBSIDIO=atributos.inputSUBSIDIO
		this.inputSueldoTotal=atributos.inputSueldoTotal
		this.inputSueldoTotalImss=atributos.inputSueldoTotalImss
		this.inputTotalDescansosTrabajados=atributos.inputTotalDescansosTrabajados
		this.inputTotalDescansosTrabajadosImss=atributos.inputTotalDescansosTrabajadosImss
		this.inputTotalDiasFestivos=atributos.inputTotalDiasFestivos
		this.inputTotalDiasFestivosImss=atributos.inputTotalDiasFestivosImss
		this.inputTotalDomingosTrabajados=atributos.inputTotalDomingosTrabajados
		this.inputTotalDomingosTrabajadosImss=atributos.inputTotalDomingosTrabajadosImss
		this.inputTotalHorasExtras=atributos.inputTotalHorasExtras
		this.inputTotalHorasExtrasImss=atributos.inputTotalHorasExtrasImss
		this.inputTotalTurnosTrabajados=atributos.inputTotalTurnosTrabajados
		this.inputTotalTurnosTrabajadosImss=atributos.inputTotalTurnosTrabajadosImss
		this.inputTotalVacaciones=atributos.inputTotalVacaciones
		this.inputTotalVacacionesImss=atributos.inputTotalVacacionesImss
		this.inputbecasEducacionales=atributos.inputbecasEducacionales
		this.inputdescripcionOtrasDeducciones=atributos.inputdescripcionOtrasDeducciones
		this.inputdespensa=atributos.inputdespensa
		this.inputotrasDeducciones=atributos.inputotrasDeducciones
		this.inputpremioAsistencia=atributos.inputpremioAsistencia
		this.inputpremioPuntualidad=atributos.inputpremioPuntualidad
		this.inputsueldoDiario=atributos.inputsueldoDiario
		this.inputsueldoDiarioFiscal=atributos.inputsueldoDiarioFiscal
		this.inputsueldoDiarioImss=atributos.inputsueldoDiarioImss
		this.inputtotalNominaEmpleado=atributos.inputtotalNominaEmpleado
		this.inputtotalNominaEmpleadoFiscal=atributos.inputtotalNominaEmpleadoFiscal
		this.otrasPercepciones=atributos.otrasPercepciones
		this.prestamo=atributos.prestamo
		this.prestamoNavitas=atributos.prestamoNavitas
		}
	
        


	transaccionesClientes.prototype.IDEmpresa=0;
	transaccionesClientes.prototype.IDUsuario=0;	
	transaccionesClientes.prototype.init_mod_nomina=function(parametros,capa,accion,tipo)
	{		
		var controlador="Nomina";
		var capa=capa;
		var parametros=parametros;
		var accion=accion;
		var tipo=tipo;
		
		this.init(controlador,accion,parametros,capa,tipo)		
		this.construir_parametros();
		this.construir_url();		
		
	}
	
	transaccionesClientes.prototype.consultarNominaVistaInicial=function(parametros,capa,accion,tipo)
	{
		this.IDUsuario=parametros.id_usuario;
		var that=this;
		this.abrir_loader();		
		this.init_mod_nomina(parametros,capa,accion,tipo);
		this.ejecutar(function(RespuestaAjax){
			$("#"+capa).html(RespuestaAjax);
			that.cerrar_loader();			
			});
		};
		
	transaccionesClientes.prototype.cargarUPLOAD=function()
	{
		this.IDUsuario
		this.abrir_loader();		
		var parametros={"id_usuario":this.IDUsuario};
		var capa="mainContent";
		var accion="cargarUPLOAD"
		var tipo="POST";
		var that=this;

		this.init_mod_nomina(parametros,capa,accion,tipo);

		this.ejecutar(function(RespuestaAjax){

			$("#"+capa).html(RespuestaAjax);
			that.cerrar_loader();			

			});
		}
	
	transaccionesClientes.prototype.consultarNominaXCliente=function(parametros,capa,accion,tipo)
	{		
		//cacheamos el objeto completo,para tener acceso al ambito de la clase.
		var that=this;
		this.abrir_loader();
		this.init_mod_nomina(parametros,capa,accion,tipo);
		this.ejecutar(function(RespuestaAjax){			
			$("#"+capa).html(RespuestaAjax);
			that.cerrar_loader();								
			});
		
		
		}	
		
	transaccionesClientes.prototype.seleccionarPeriodo=function(parametros,capa,accion,tipo)
	{
		//cacheamos el objeto completo,para tener acceso al ambito de la clase.
		var that=this;
		this.abrir_loader();
		this.init_mod_nomina(parametros,capa,accion,tipo);
		this.ejecutar(function(RespuestaAjax){			
			$("#"+capa).html(RespuestaAjax);
			that.cerrar_loader();								
			});
		
		
		}
		
	transaccionesClientes.prototype.cargarNuevaNominaClienteXPeriodo=function(parametros,capa,accion,tipo)
	{
		//cacheamos el objeto completo,para tener acceso al ambito de la clase.
		var that=this;
		this.abrir_loader();
		this.init_mod_nomina(parametros,capa,accion,tipo);		
		this.ejecutar(function(RespuestaAjax){								
			$("#"+capa).html(RespuestaAjax);
			that.cerrar_loader();								
			});
		
		
		}	
		
	transaccionesClientes.prototype.guardarNominaNueva=function(parametros,capa,accion,tipo){
		//capa="cuerpoNomina"
		
		var id_empresa=parametros.id_empresa;
		var inicio_periodo=$("#inicio_periodo").val();
		var fin_periodo=$("#fin_periodo").val();
		var periodo_nomina=$("#periodo_nomina").val();		
		
		var	estado=$("#estado").val();	
		var	fecha_captura=$("#fecha_captura").val();
		var	tipoNomina=$("#tipoNomina").val();		
		var	observaciones=$("#observaciones").val();
		var	inputpercepciones=$("#inputpercepciones").val();
		var	inputhonorarios=$("#inputhonorarios").val();
		var	inputrelativos=$("#inputrelativos").val();
		var	inputsubtotal=$("#inputsubtotal").val();
		var	inputiva=$("#inputiva").val();
		var	inputfactura=$("#inputfactura").val();	
			
		
		
		
		
		parametros.inicio_periodo=new Object();
		parametros.fin_periodo=new Object();
		parametros.estado=new Object();
		parametros.fecha_captura=new Object();
		parametros.tipoNomina=new Object();
		parametros.observaciones=new Object();
		parametros.inputpercepciones=new Object();
		parametros.inputhonorarios=new Object();
		parametros.inputrelativos=new Object();
		parametros.inputsubtotal=new Object();
		parametros.inputiva=new Object();
		parametros.inputfactura=new Object();

		parametros.inicio_periodo=inicio_periodo;
		parametros.fin_periodo=fin_periodo;
		parametros.estado=estado;
		parametros.fecha_captura=fecha_captura;
		parametros.tipoNomina=tipoNomina;
		parametros.observaciones=observaciones;
		parametros.inputpercepciones=inputpercepciones;
		parametros.inputhonorarios=inputhonorarios;
		parametros.inputrelativos=inputrelativos;
		parametros.inputsubtotal=inputsubtotal;
		parametros.inputiva=inputiva;
		parametros.inputfactura=inputfactura;
		
		
		var parametrosCorreo={
			"id_empresa":id_empresa,
			"inicio_periodo":inicio_periodo,
			"fin_periodo":fin_periodo,
			"periodo_nomina":periodo_nomina,
			"extension":"../../../"			
			};
		
		var atributos={
			aguinaldo:null,
			cajaAhorro:null,
			complementoSueldo:null,
			diasTrabajados:null,
			fonacot:null,
			idEmpleado:null,
			infonavit:null,
			inputIMSS:null,
			inputISR:null,
			inputNumeroDescansosTrabajados:null,
			inputNumeroDiasFestivos:null,
			inputNumeroDiasVacaciones:null,
			inputNumeroDomingosTrabajados:null,
			inputNumeroHorasExtras:null,
			inputNumeroTurnosTrabajados:null,
			inputPrimaDominical:null,
			inputPrimaDominicalImss:null,
			inputPrimaVacacional:null,
			inputPrimaVacacionalImss:null,
			inputSUBSIDIO:null,
			inputSueldoTotal:null,
			inputSueldoTotalImss:null,
			inputTotalDescansosTrabajados:null,
			inputTotalDescansosTrabajadosImss:null,
			inputTotalDiasFestivos:null,
			inputTotalDiasFestivosImss:null,
			inputTotalDomingosTrabajados:null,
			inputTotalDomingosTrabajadosImss:null,
			inputTotalHorasExtras:null,
			inputTotalHorasExtrasImss:null,
			inputTotalTurnosTrabajados:null,
			inputTotalTurnosTrabajadosImss:null,
			inputTotalVacaciones:null,
			inputTotalVacacionesImss:null,
			inputbecasEducacionales:null,
			inputdescripcionOtrasDeducciones:null,
			inputdespensa:null,
			inputotrasDeducciones:null,
			inputpremioAsistencia:null,
			inputpremioPuntualidad:null,
			inputsueldoDiario:null,
			inputsueldoDiarioFiscal:null,
			inputsueldoDiarioImss:null,
			inputtotalNominaEmpleado:null,
			inputtotalNominaEmpleadoFiscal:null,
			otrasPercepciones:null,
			prestamo:null,
			prestamoNavitas:null
			}
			
		aguinaldo=$("input[name='aguinaldo']");
		cajaAhorro=$("input[name='cajaAhorro']");
		complementoSueldo=$("input[name='complementoSueldo']");
		diasTrabajados=$("input[name='diasTrabajados']");
		fonacot=$("input[name='fonacot']");
		idEmpleado=$("input[name='idEmpleado']");
		infonavit=$("input[name='infonavit']");
		inputIMSS=$("input[name='inputIMSS']");
		inputISR=$("input[name='inputISR']");
		inputNumeroDescansosTrabajados=$("input[name='inputNumeroDescansosTrabajados']");
		inputNumeroDiasFestivos=$("input[name='inputNumeroDiasFestivos']");
		inputNumeroDiasVacaciones=$("input[name='inputNumeroDiasVacaciones']");
		inputNumeroDomingosTrabajados=$("input[name='inputNumeroDomingosTrabajados']");
		inputNumeroHorasExtras=$("input[name='inputNumeroHorasExtras']");
		inputNumeroTurnosTrabajados=$("input[name='inputNumeroTurnosTrabajados']");
		inputPrimaDominical=$("input[name='inputPrimaDominical']");
		inputPrimaDominicalImss=$("input[name='inputPrimaDominicalImss']");
		inputPrimaVacacional=$("input[name='inputPrimaVacacional']");
		inputPrimaVacacionalImss=$("input[name='inputPrimaVacacionalImss']");
		inputSUBSIDIO=$("input[name='inputSUBSIDIO']");
		inputSueldoTotal=$("input[name='inputSueldoTotal']");
		inputSueldoTotalImss=$("input[name='inputSueldoTotalImss']");
		inputTotalDescansosTrabajados=$("input[name='inputTotalDescansosTrabajados']");
		inputTotalDescansosTrabajadosImss=$("input[name='inputTotalDescansosTrabajadosImss']");
		inputTotalDiasFestivos=$("input[name='inputTotalDiasFestivos']");
		inputTotalDiasFestivosImss=$("input[name='inputTotalDiasFestivosImss']");
		inputTotalDomingosTrabajados=$("input[name='inputTotalDomingosTrabajados']");
		inputTotalDomingosTrabajadosImss=$("input[name='inputTotalDomingosTrabajadosImss']");
		inputTotalHorasExtras=$("input[name='inputTotalHorasExtras']");
		inputTotalHorasExtrasImss=$("input[name='inputTotalHorasExtrasImss']");
		inputTotalTurnosTrabajados=$("input[name='inputTotalTurnosTrabajados']");
		inputTotalTurnosTrabajadosImss=$("input[name='inputTotalTurnosTrabajadosImss']");
		inputTotalVacaciones=$("input[name='inputTotalVacaciones']");
		inputTotalVacacionesImss=$("input[name='inputTotalVacacionesImss']");
		inputbecasEducacionales=$("input[name='inputbecasEducacionales']");
		inputdescripcionOtrasDeducciones=$("input[name='inputdescripcionOtrasDeducciones']");
		inputdespensa=$("input[name='inputdespensa']");
		inputotrasDeducciones=$("input[name='inputotrasDeducciones']");
		inputpremioAsistencia=$("input[name='inputpremioAsistencia']");
		inputpremioPuntualidad=$("input[name='inputpremioPuntualidad']");
		inputsueldoDiario=$("input[name='inputsueldoDiario']");
		inputsueldoDiarioFiscal=$("input[name='inputsueldoDiarioFiscal']");
		inputsueldoDiarioImss=$("input[name='inputsueldoDiarioImss']");
		inputtotalNominaEmpleado=$("input[name='inputtotalNominaEmpleado']");
		inputtotalNominaEmpleadoFiscal=$("input[name='inputtotalNominaEmpleadoFiscal']");
		otrasPercepciones=$("input[name='otrasPercepciones']");
		prestamo=$("input[name='prestamo']");
		prestamoNavitas=$("input[name='prestamoNavitas']");
		
		
		var vueltas=idEmpleado.length;
		
		
		for(i=0;i<vueltas;i++)
		{
			atributos.aguinaldo=aguinaldo[i].value,
			atributos.cajaAhorro=cajaAhorro[i].value,
			atributos.complementoSueldo=complementoSueldo[i].value,
			atributos.diasTrabajados=diasTrabajados[i].value,
			atributos.fonacot=fonacot[i].value,
			atributos.idEmpleado=idEmpleado[i].value,
			atributos.infonavit=infonavit[i].value,
			atributos.inputIMSS=inputIMSS[i].value,
			atributos.inputISR=inputISR[i].value,
			atributos.inputNumeroDescansosTrabajados=inputNumeroDescansosTrabajados[i].value,
			atributos.inputNumeroDiasFestivos=inputNumeroDiasFestivos[i].value,
			atributos.inputNumeroDiasVacaciones=inputNumeroDiasVacaciones[i].value,
			atributos.inputNumeroDomingosTrabajados=inputNumeroDomingosTrabajados[i].value,
			atributos.inputNumeroHorasExtras=inputNumeroHorasExtras[i].value,
			atributos.inputNumeroTurnosTrabajados=inputNumeroTurnosTrabajados[i].value,
			atributos.inputPrimaDominical=inputPrimaDominical[i].value,
			atributos.inputPrimaDominicalImss=inputPrimaDominicalImss[i].value,
			atributos.inputPrimaVacacional=inputPrimaVacacional[i].value,
			atributos.inputPrimaVacacionalImss=inputPrimaVacacionalImss[i].value,
			atributos.inputSUBSIDIO=inputSUBSIDIO[i].value,
			atributos.inputSueldoTotal=inputSueldoTotal[i].value,
			atributos.inputSueldoTotalImss=inputSueldoTotalImss[i].value,
			atributos.inputTotalDescansosTrabajados=inputTotalDescansosTrabajados[i].value,
			atributos.inputTotalDescansosTrabajadosImss=inputTotalDescansosTrabajadosImss[i].value,
			atributos.inputTotalDiasFestivos=inputTotalDiasFestivos[i].value,
			atributos.inputTotalDiasFestivosImss=inputTotalDiasFestivosImss[i].value,
			atributos.inputTotalDomingosTrabajados=inputTotalDomingosTrabajados[i].value,
			atributos.inputTotalDomingosTrabajadosImss=inputTotalDomingosTrabajadosImss[i].value,
			atributos.inputTotalHorasExtras=inputTotalHorasExtras[i].value,
			atributos.inputTotalHorasExtrasImss=inputTotalHorasExtrasImss[i].value,
			atributos.inputTotalTurnosTrabajados=inputTotalTurnosTrabajados[i].value,
			atributos.inputTotalTurnosTrabajadosImss=inputTotalTurnosTrabajadosImss[i].value,
			atributos.inputTotalVacaciones=inputTotalVacaciones[i].value,
			atributos.inputTotalVacacionesImss=inputTotalVacacionesImss[i].value,
			atributos.inputbecasEducacionales=inputbecasEducacionales[i].value,
			atributos.inputdescripcionOtrasDeducciones=inputdescripcionOtrasDeducciones[i].value,
			atributos.inputdespensa=inputdespensa[i].value,
			atributos.inputotrasDeducciones=inputotrasDeducciones[i].value,
			atributos.inputpremioAsistencia=inputpremioAsistencia[i].value,
			atributos.inputpremioPuntualidad=inputpremioPuntualidad[i].value,
			atributos.inputsueldoDiario=inputsueldoDiario[i].value,
			atributos.inputsueldoDiarioFiscal=inputsueldoDiarioFiscal[i].value,
			atributos.inputsueldoDiarioImss=inputsueldoDiarioImss[i].value,
			atributos.inputtotalNominaEmpleado=inputtotalNominaEmpleado[i].value,
			atributos.inputtotalNominaEmpleadoFiscal=inputtotalNominaEmpleadoFiscal[i].value,
			atributos.otrasPercepciones=otrasPercepciones[i].value,
			atributos.prestamo=prestamo[i].value,
			atributos.prestamoNavitas=prestamoNavitas[i].value
			
			this.ObjetoJson.addProducto(new atributoJSON(atributos));
		
			}
			
		
		
	    
	    //cacheamos el objeto completo,para tener acceso al ambito de la clase.
	    var that=this;	    
	    //this.formularioComoParametro("nuevaNomina");		
        this.abrir_loader();
        this.init_mod_nomina(parametros,capa,accion,tipo);  		
        this.ejecutar(function(RespuestaAjax){   
		console.debug(RespuestaAjax);
		         
          $("#"+capa).html(RespuestaAjax);
		  
		 
		 that.enviarCorreo(parametrosCorreo,"","","POST");
		 
		 that.ObjetoJson.emptyProducto();
		 
		  that.cerrar_loader();                               
            });
	    
	};
	
	transaccionesClientes.prototype.enviarCorreo=function(parametros,capa,accion,tipo){			
	    capa="mainContent";
		this.enlaceExterno="mod_nominas/view/correo_prenomina.php"	    
	    //cacheamos el objeto completo,para tener acceso al ambito de la clase.
	    var that=this;         
        this.init_mod_nomina(parametros,capa,accion,tipo);      
        this.ejecutar(function(RespuestaAjax){
			that.enlaceExterno=null; 
			$("#"+capa).html(RespuestaAjax);			
            });
	    
	};
	
	
	
		
		
var transaccionesNomina= new transaccionesClientes();
transaccionesNomina.setModulo("nominas");




