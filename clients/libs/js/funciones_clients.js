var operaciones_padres=function()
{
	
};    
		   
 operaciones_padres.prototype={     
	 "controlador":"",	 
	 "mensaje":"",
	 "capa":"",
	 "accion":"",
	 "operacion":"",
	 "modulo":"",
	 "parametros":"",
	 "tipo_envio":"",
	
	
	 
	
	 
	 "inicializador":function(parametros_generales,parametros_especificos,operaciones,tipo_envio)
	 {
		 this.controlador=parametros_generales['controlador'];
		 this.mensaje=parametros_generales['mensaje'];
		 this.capa=parametros_generales['capa'];
		 this.modulo=parametros_generales['modulo'];
		 this.accion=operaciones['accion'];	
		 this.operacion=operaciones['operacion'];
		 this.tipo_envio=tipo_envio;
				 
		 this.parametros="modulo="+this.modulo+"&controlador="+this.controlador+"&accion="+this.accion+"&operacion="+this.operacion; 
		
		 var parametros="";
		 
		 
		   $.each(parametros_especificos, function(indice, valor){			 
					parametros+="&"+indice+"="+valor;
					 });
					 
					 
					 this.parametros+=parametros;
					 
					 eval("this."+this.operacion+"()");		
					 
		 },
		 
	 "ejecutar":function()
	 {
		 this.abrir_loader();
		 var capa=this.capa;//ambito de variable superior,incrustada en ambito de metodo.
		 var tipo_envio=this.tipo_envio;
		
		
		jQuery.ajax({
			"url": "../admin/AnteFrontController.php",
			"type": tipo_envio,
			"data": this.parametros,
			"success": function(response)
			{	
			 operaciones2.cerrar_loader();
			$('#nueva_nomina').html(response);
			//div_nomina.innerHTML ="cargando";//response;
				
				}
			});
		 
	 },
	 
	 
	  "abrir_loader":function(){
		  $.loader({
						className:"blue-with-image",
						content:"CARGANDO......"
						});
		 },
	 
	 "cerrar_loader":function(){
		 $.loader('close');
		 },
	 
	 "CargarNominaCliente":function()
	 {
		
			  periodo = document.getElementById('periodo_nomina').value;
					 parametros="&periodo="+periodo;
					 this.parametros=this.parametros+parametros;
					 	 
		 this.ejecutar();
		 
		
		 
     },	 
		 

	 
	 "imprimir_var":function()
	 {
		 mensaje="variables de clase::"+"\n"
		 +"controlador:  "+this.controlador+"\n"
		 +"mensaje:  "    +this.mensaje+"\n"
		 +"capa:  "       +this.capa+"\n"
		 +"modulo:  "     +this.modulo+"\n"
		 +"accion:  "     +this.accion+"\n"
		 +"operacion:  "  +this.operacion+"\n"
		 +"parametros:  " +this.parametros+"\n";
		 
		 alert(mensaje);
	 }
	 
	 
	};
	
	operaciones2=new operaciones_padres();