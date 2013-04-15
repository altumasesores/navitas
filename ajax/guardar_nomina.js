// JavaScript Document



function nueva_nomina() {

	div_nomina = document.getElementById('nueva_nomina');

	periodo = document.getElementById('periodo_nomina').value;

	ajax = objetoAjax();



	ajax.open("POST", "enviar_nomina.php", true);



	div_nomina.innerHTML = 'Obteniendo Lista de Empleados...';



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {



			//obtengo el listado de nominas

			div_nomina.innerHTML = ajax.responseText



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	//enviando los valores

	ajax.send("periodo=" + periodo)



}



function calcula_valores_nomina() {

	campos_empleado = document.getElementsByName("otras_percepciones[]");

	campos_prestamo = document.getElementsByName("prestamos[]");

	//		document.getElementById("campo").f;



	for(var i = 0; i < campos_empleado.length; i++) {

		campos_empleado[i].focus();



	}



	for(var i = 0; i < campos_prestamo.length; i++) {

		campos_prestamo[i].focus();



	}

	document.getElementById("dia_inicio").focus();



}



function obtener_nominas_empresa() {

	div_mensaje = document.getElementById('nominas_empresa');

	id_empresa = document.getElementById('id_empresa').value;

	div_nomina = document.getElementById('nominas_empresa_empleados');

	div_nomina.innerHTML = "";

	ajax = objetoAjax();



	ajax.open("POST", "nominas_empresa.php", true);



	div_mensaje.innerHTML = 'Obteniendo nominas...';



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {



			//obtengo el listado de nominas

			div_mensaje.innerHTML = ajax.responseText



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	//enviando los valores

	ajax.send("id_empresa=" + id_empresa)



}



//Carga la nomina de una empresa con sus empleados, percepciones y deducciones

function cargar_nomina(id_nomina, id_empresa) {

	//alert(id_nomina + id_empresa);

	div_mensaje = document.getElementById('nominas_empresa_empleados');

	div_nominas_empresa = document.getElementById('nominas_empresa');

	ajax = objetoAjax();



	ajax.open("POST", "nominas_empresa_empleados.php", true);



	div_mensaje.innerHTML = 'Obteniendo nomina...';



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {



			//obtengo La nomina procesada

			div_mensaje.innerHTML = ajax.responseText

			div_nominas_empresa.innerHTML = '';

			calcula_valores_nomina();



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	//enviando los valores

	ajax.send("id_nomina=" + id_nomina + "&id_empresa=" + id_empresa)



}//fin de la funcion cargar_nomina



function cargar_nomina_cliente(id_nomina, id_empresa) {

	div_mensaje = document.getElementById('nomina');

	ajax = objetoAjax();



	ajax.open("POST", "mod_nominas/view/cargar_nomina.php", true);



	div_mensaje.innerHTML = 'Obteniendo nomina...';



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {



			//obtengo La nomina procesada

			div_mensaje.innerHTML = ajax.responseText

			document.getElementById('nominas_empresa').innerHTML = "";



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	//enviando los valores

	ajax.send("id_nomina=" + id_nomina + "&id_empresa=" + id_empresa)



}//fin de la funcion cargar_nomina_cliente



function guardar_nomina(id_empresa) {

	//funcion que guarda la nomina de una empresa



	//PRIMERO SE GUARDAN LOS DATOS GENERALES DE LA NOMINA Y SE OBTIENE EL ID DE LA NOMINA GENERADA



	clave_nomina = document.getElementById('id_nomina');

	//Aqui se guardara la clave de la nomina generada

	div_mensaje = document.getElementById('alerta_nomina');



	//Campos Generales para guardar en la factura de la nomina

	percepciones = document.getElementById('percepciones').value;

	honorarios = document.getElementById('honorarios').value;

	relativos = document.getElementById('relativos').value;

	subtotal = document.getElementById('subtotal').value;

	iva = document.getElementById('iva').value;

	total_factura = document.getElementById('total_factura').value;

	fecha_captura = document.getElementById('fecha_captura').value;

	estado = document.getElementById('estado').value;

	observaciones = document.getElementById('observaciones').value;

	periodo_nomina=document.getElementById('periodo').value;


	if(document.getElementById('dia_inicio').value.length == 0) {

		alert("Debe escribir la fecha de inicio de periodo")

		document.getElementById('dia_inicio').focus()

		return false;

	} else {

		var inicio = document.getElementById('dia_inicio').value;

		var elem = inicio.split('/');

		dia1 = elem[0];

		mes1 = elem[1];

		anio1 = elem[2];

		inicio_periodo = anio1 + "/" + mes1 + "/" + dia1;

	}

	if(document.getElementById('dia_final').value.length == 0) {

		alert("Debe escribir la fecha de fin de periodo")

		document.getElementById('dia_final').focus()

		return false;

	} else {

		var fin = document.getElementById('dia_final').value;

		var elem2 = fin.split('/');

		dia2 = elem2[0];

		mes2 = elem2[1];

		anio2 = elem2[2];

		fin_periodo = anio2 + "/" + mes2 + "/" + dia2;

	}

	ajax = objetoAjax();



	ajax.open("POST", "guardar_prenomina.php", true);



	div_mensaje.innerHTML = 'Guardando Nomina...';

	//deshabilito el boton de guardar

	document.getElementById('guardar').disabled = true;



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {



			//obtengo el valor del id_nomina despues de guardar

			clave_nomina.value = ajax.responseText

			



			guardar_empleados_nomina(id_empresa, clave_nomina.value);

			guardar_empleados_nomina_fiscal(id_empresa, clave_nomina.value);



			correo_prenomina(id_empresa, inicio_periodo, fin_periodo, periodo_nomina);



			cargarPagina('consultar_nominas.php', 'mainContent');



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	//enviando los valores

	ajax.send("id_empresa=" + id_empresa + "&inicio_periodo=" + inicio_periodo + "&fin_periodo=" + fin_periodo + "&fecha_captura=" + fecha_captura + "&estado=" + estado + "&percepciones=" + percepciones + "&honorarios=" + honorarios + "&relativos=" + relativos + "&subtotal=" + subtotal + "&iva=" + iva + "&total_factura=" + total_factura + "&observaciones=" + observaciones + "&periodo=" + periodo_nomina)



}//Fin de la funcion Guardar_nomina



function guardar_empleados_nomina(id_empresa, id_nomina) {



	var id_empleado_actual;



	//



	//Se obtiene un vector con los id de empleado que se guardaran en la nomina

	id_empleado_actual = document.getElementsByName("id_empleado[]");



	for(var i = 0; i < id_empleado_actual.length; i++) {

		id_empleado = id_empleado_actual[i].value;

		//Este obtiene el id del empleado

		

		

		//obtengo los valores de los campos percepciones del empleado

		

		//periodo_nomina = document.getElementById('periodo').value;



		sueldo_diario = document.getElementById('sueldo_diario_' + id_empleado).value;

		sueldo_integrado = document.getElementById('sueldo_integrado_' + id_empleado).value;

		dias_trabajados = document.getElementById('dias_trabajados_' + id_empleado).value;		

		total_sueldo = document.getElementById('total_sueldo_' + id_empleado).value;

		

		cantidad_hora=document.getElementById('cantidad_horas_extras_' + id_empleado).value;

		total_horas_extras = document.getElementById('total_horas_extras_' + id_empleado).value;

		

		 cantidad_domingo=document.getElementById('cantidad_domingos_' + id_empleado).value;

		 prima_dominicall=document.getElementById('prima_dominical_' + id_empleado).value;

		total_domingos = document.getElementById('total_domingos_' + id_empleado).value;

		

		cantidad_turno=document.getElementById('cantidad_turnos_' + id_empleado).value;       

		total_turnos = document.getElementById('total_turnos_' + id_empleado).value;

		

		cantidad_descanso=document.getElementById('cantidad_descansos_' + id_empleado).value; 

		total_descansos = document.getElementById('total_descansos_' + id_empleado).value;

		

		cantidad_festivo=document.getElementById('cantidad_festivos_' + id_empleado).value;

		total_festivos = document.getElementById('total_festivos_' + id_empleado).value;

		

		cantidad_vacaciones=document.getElementById('cantidad_vacaciones_' + id_empleado).value;

		prima_vacacionall=document.getElementById('prima_vacacional_' + id_empleado).value;

		total_vacaciones = document.getElementById('total_vacaciones_' + id_empleado).value;

		

		aguinalldo=document.getElementById('aguinaldo_' + id_empleado).value;

		complemento_sueldo = document.getElementById('complemento_sueldo_' + id_empleado).value;

		otras_percepciones = document.getElementById('otras_percepciones_' + id_empleado).value;

		

		

		

		//obtengo los valores de los campos deducciones del empleado

		

		prestamos = document.getElementById('prestamos_' + id_empleado).value;		

		caja_ahorro = document.getElementById('caja_ahorro_' + id_empleado).value;		

		fonacot = document.getElementById('fonacot_' + id_empleado).value;		

		infonavit = document.getElementById('infonavit_' + id_empleado).value;

		otras_deducciones = document.getElementById('otras_deducciones_' + id_empleado).value;

		desc_otras_deducciones="";		

		prestamo_ascon = document.getElementById('prestamo_ascon_' + id_empleado).value;

		

		tipo_nomina="normal";

		guarda_ajax(id_nomina, id_empleado, id_empresa, sueldo_diario, dias_trabajados, total_sueldo, total_horas_extras, total_domingos, total_turnos, total_descansos, total_festivos, total_vacaciones, complemento_sueldo, otras_percepciones, prestamos, caja_ahorro, fonacot, otras_deducciones, prestamo_ascon, infonavit,prima_vacacionall,prima_dominicall,aguinalldo,cantidad_hora,cantidad_domingo,cantidad_turno,cantidad_descanso,cantidad_festivo,cantidad_vacaciones,tipo_nomina,sueldo_integrado,desc_otras_deducciones);



	}//fin del ciclo for

	

	calcular(id_nomina,tipo_nomina,sueldo_integrado,dias_trabajados);

	div_mensaje = document.getElementById('alerta_nomina');

	div_mensaje.innerHTML = 'Nomina Guardada Correctamente...';

	alert("Nomina "+id_nomina+" Guardada Correctamente.")



}//Fin de la funcion guardar_empleados_nomina







function guardar_empleados_nomina_fiscal(id_empresa, id_nomina) {



	var id_empleado_actual;



	//



	//Se obtiene un vector con los id de empleado que se guardaran en la nomina

	id_empleado_actual = document.getElementsByName("id_empleado[]");



	for(var i = 0; i < id_empleado_actual.length; i++) {

		

		//percepciones fiscales

		

		id_nomina=id_nomina;

		id_empleado = id_empleado_actual[i].value;

		

		sueldo_diario = document.getElementById('sueldo_diario_imss_' + id_empleado).value;

		sueldo_integrado = document.getElementById('sueldo_integrado_' + id_empleado).value;

		dias_trabajados = document.getElementById('dias_trabajados_' + id_empleado).value;

		if($("#periodo").val()=="semanal"){

			

			if(dias_trabajados>=8)

			{

				dias_trabajados=dias_trabajados/8;

				

			}

			

		}

		total_sueldo = document.getElementById('total_sueldo_imss_' + id_empleado).value;

		

		cantidad_hora=document.getElementById('cantidad_horas_extras_imss_' + id_empleado).value;	

		total_horas_extras = document.getElementById('total_horas_extras_imss_' + id_empleado).value;

		

		cantidad_domingo=document.getElementById('cantidad_domingos_imss_' + id_empleado).value;		

		prima_dominicall=document.getElementById('prima_dominical_imss_' + id_empleado).value;

		total_domingos = document.getElementById('total_domingos_imss_' + id_empleado).value;



		cantidad_turno=document.getElementById('cantidad_turnos_imss_' + id_empleado).value;  

		total_turnos = document.getElementById('total_turnos_imss_' + id_empleado).value;

		

		cantidad_descanso=document.getElementById('cantidad_descansos_imss_' + id_empleado).value;   

		total_descansos = document.getElementById('total_descansos_imss_' + id_empleado).value;

		

		cantidad_festivo=document.getElementById('cantidad_festivos_imss_' + id_empleado).value; 

		total_festivos = document.getElementById('total_festivos_imss_' + id_empleado).value;

		

		cantidad_vacaciones=document.getElementById('cantidad_vacaciones_imss_' + id_empleado).value;

		prima_vacacionall=document.getElementById('prima_vacacional_imss_' + id_empleado).value;		

		total_vacaciones = document.getElementById('total_vacaciones_imss_' + id_empleado).value;

		

		aguinalldo=document.getElementById('aguinaldo_' + id_empleado).value;		

		complemento_sueldo = document.getElementById('complemento_sueldo_' + id_empleado).value;

		otras_percepciones = document.getElementById('otras_percepciones_' + id_empleado).value;

		

		

		

		//obtengo los valores de los campos deducciones del empleado

		



		prestamos = document.getElementById('prestamos_' + id_empleado).value;		

		caja_ahorro = document.getElementById('caja_ahorro_' + id_empleado).value;		

		fonacot = document.getElementById('fonacot_' + id_empleado).value;		

		infonavit = document.getElementById('infonavit_' + id_empleado).value;

		otras_deducciones = document.getElementById('otras_deducciones_' + id_empleado).value;		

		desc_otras_deducciones = document.getElementById('descripcion_ot_deducciones_' + id_empleado).value;

		prestamo_ascon = document.getElementById('prestamo_ascon_' + id_empleado).value;

		

		

		tipo_nomina="fiscal";

		

	

					

        

		

		



		guarda_ajax(id_nomina, id_empleado, id_empresa, sueldo_diario, dias_trabajados, total_sueldo, total_horas_extras, total_domingos, total_turnos, total_descansos, total_festivos, total_vacaciones, complemento_sueldo, otras_percepciones, prestamos, caja_ahorro, fonacot, otras_deducciones, prestamo_ascon, infonavit,prima_vacacionall,prima_dominicall,aguinalldo,cantidad_hora,cantidad_domingo,cantidad_turno,cantidad_descanso,cantidad_festivo,cantidad_vacaciones,tipo_nomina,sueldo_integrado,desc_otras_deducciones);



	}//fin del ciclo for

	

	calcular(id_nomina,tipo_nomina,sueldo_integrado,dias_trabajados);

	div_mensaje = document.getElementById('alerta_nomina');

	div_mensaje.innerHTML = 'Nomina Guardada Correctamente...';

	alert("Nomina "+id_nomina+" Guardada Correctamente.")



}//Fin de la funcion guardar_empleados_nomina





function calcular(idNomina,tipo_nomina,sueldo_integrado,dias_trabajados) {

	



	//alert(idNomina + tipoNomina)

	modulo = "calculos";

	controlador = "Calculos";

	accion = "calcular";

	parametros = "modulo=" + modulo + "&controlador=" + controlador + "&accion=" + accion + "&idNomina=" + idNomina +"&tipo_nomina="+tipo_nomina+"&sueldo_integrado="+sueldo_integrado+"&dias_trabajados="+dias_trabajados;

	jQuery.ajax({

		"url" : "../admin/AnteFrontController.php",

		"type" : "get",

		"data" : parametros,

		"success" : function(response) {



		

		

		}

	});



}







function guarda_ajax(id_nomina, id_empleado, id_empresa, sueldo_diario, dias_trabajados, total_sueldo, total_horas_extras, total_domingos, total_turnos, total_descansos, total_festivos, total_vacaciones, complemento_sueldo, otras_percepciones, prestamos, caja_ahorro, fonacot, otras_deducciones, prestamo_ascon, infonavit,prima_vacacional,prima_dominical,aguinaldo,cantidad_hora,cantidad_domingo,cantidad_turno,cantidad_descanso,cantidad_festivo,cantidad_vacaciones,tipo_nomina,sueldo_integrado,desc_otras_deducciones) {

	

	ajax = objetoAjax();



	ajax.open("POST", "guardar_nomina_empleado.php", false);



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {		

		    //alert(ajax.responseText+"------"+desc_otras_deducciones)

			empleado = ajax.responseText;

			document.getElementById('sueldo_diario_' + empleado).style.backgroundColor = "#900";

		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");



	//enviando los valores

	ajax.send("sueldo_diario=" + sueldo_diario + "&dias_trabajados=" + dias_trabajados + "&total_sueldo=" + total_sueldo + "&total_horas_extras=" + total_horas_extras + "&total_domingos=" + total_domingos + "&total_turnos=" + total_turnos + "&total_descansos=" + total_descansos + "&total_festivos=" + total_festivos + "&total_vacaciones=" + total_vacaciones + "&complemento_sueldo=" + complemento_sueldo + "&otras_percepciones=" + otras_percepciones + "&prestamos=" + prestamos + "&caja_ahorro=" + caja_ahorro + "&fonacot=" + fonacot + "&otras_deducciones=" + otras_deducciones + "&prestamo_ascon=" + prestamo_ascon + "&id_nomina=" + id_nomina + "&id_empresa=" + id_empresa + "&id_empleado=" + id_empleado + "&infonavit=" + infonavit+"&prima_vacacional="+prima_vacacional+"&prima_dominical="+prima_dominical+"&aguinaldo="+aguinaldo+"&cantidad_hora="+cantidad_hora+"&cantidad_domingo="+cantidad_domingo+"&cantidad_turno="+cantidad_turno+"&cantidad_descanso="+cantidad_descanso+"&cantidad_festivo="+cantidad_festivo+"&cantidad_vacaciones="+cantidad_vacaciones+"&tipo_nomina="+tipo_nomina+"&sueldo_integrado="+sueldo_integrado+"&desc_ot_deducciones="+desc_otras_deducciones);



}//fin de la funcion guardar_empleados_nomina



//FUNCIONES PARA MODIFICAR LOS DATOS DE LA NOMINA



function modificar_nomina(id_empresa) {

	operaciones2.abrir_loader();

	//funcion que guarda la nomina de una empresa



	//PRIMERO SE GUARDAN LOS DATOS GENERALES DE LA NOMINA Y SE OBTIENE EL ID DE LA NOMINA GENERADA



	id_nomina = document.getElementById('id_nomina').value;

	//Aqui se guardara la clave de la nomina generada

	div_mensaje = document.getElementById('alerta_nomina');



	//Campos Generales para guardar en la factura de la nomina

	percepciones = document.getElementById('percepciones').value;

	honorarios = document.getElementById('honorarios').value;

	relativos = document.getElementById('relativos').value;

	subtotal = document.getElementById('subtotal').value;

	iva = document.getElementById('iva').value;

	total_factura = document.getElementById('total_factura').value;

	observaciones = document.getElementById('observaciones').value;

	estado_anterior = document.getElementById('estado_actual').value;

	//INDICA EL ESTADO ANTERIOR

	estado = radiobutton(document.getElementsByName('estado'));

	//INDICA EL NUEVO ESTADO



	/* 		if (document.getElementById('dia_inicio').value.length==0){

	alert("Debe escribir la fecha de inicio de periodo")

	document.getElementById('dia_inicio').focus()

	return false;

	}



	if (document.getElementById('mes_inicio').value.length==0){

	alert("Debe escribir la fecha de inicio de periodo")

	document.getElementById('mes_inicio').focus()

	return false;

	}



	if (document.getElementById('anio_inicio').value.length==0){

	alert("Debe escribir la fecha de inicio de periodo")

	document.getElementById('anio_inicio').focus()

	return false;

	}



	if (document.getElementById('dia_final').value.length==0){

	alert("Debe escribir la fecha de fin de periodo")

	document.getElementById('dia_final').focus()

	return false;

	}



	if (document.getElementById('mes_final').value.length==0){

	alert("Debe escribir la fecha de fin de periodo")

	document.getElementById('mes_final').focus()

	return false;

	}



	if (document.getElementById('anio_final').value.length==0){

	alert("Debe escribir la fecha de fin de periodo")

	document.getElementById('anio_final').focus()

	return false;

	}  */



	//inicio_periodo= document.getElementById('anio_inicio').value + "/"+  document.getElementById('mes_inicio').value + "/" +document.getElementById('dia_inicio').value ;



	//fin_periodo= document.getElementById('anio_final').value + "/"+  document.getElementById('mes_final').value + "/" +document.getElementById('dia_final').value ;



	//	alert("inicio periodo: "+estado)



	if(document.getElementById('dia_inicio').value.length == 0) {

		alert("Debe escribir la fecha de inicio de periodo")

		document.getElementById('dia_inicio').focus()

		return false;

	} else {

		var inicio = document.getElementById('dia_inicio').value;

		var elem = inicio.split('/');

		dia1 = elem[0];

		mes1 = elem[1];

		anio1 = elem[2];

		inicio_periodo = anio1 + "/" + mes1 + "/" + dia1;

	}

	if(document.getElementById('dia_final').value.length == 0) {

		alert("Debe escribir la fecha de fin de periodo")

		document.getElementById('dia_final').focus()

		return false;

	} else {

		var fin = document.getElementById('dia_final').value;

		var elem2 = fin.split('/');

		dia2 = elem2[0];

		mes2 = elem2[1];

		anio2 = elem2[2];

		fin_periodo = anio2 + "/" + mes2 + "/" + dia2;

	}

	

	

				  

	ajax = objetoAjax();



	ajax.open("POST", "nominas_modificar.php", true);



	div_mensaje.innerHTML = 'Guardando Nomina...';



	//deshabilito el boton de guardar

	document.getElementById('guardar').disabled = true;



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {



			//obtengo el valor del id_nomina despues de guardar

			div_mensaje.innerHTML = ajax.responseText



			if(estado == 'FACTURADA') {

				alert("Se ha actualizado el estado de la nomina.")

				cargarPagina('nominas.php', 'mainContent');



			} else {



				modificar_nominas_empleado(id_empresa, id_nomina);

				modificar_nominas_empleado_fiscal(id_empresa, id_nomina);



				generar_reporte_nomina(id_empresa, id_nomina);



				//ENVIAR CORREO

				correo_revision_nomina(id_nomina, estado_anterior);



				cargarPagina('nominas.php', 'mainContent');



			}

			

			operaciones2.cerrar_loader();



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	//enviando los valores

	ajax.send("id_nomina=" + id_nomina + "&id_empresa=" + id_empresa + "&inicio_periodo=" + inicio_periodo + "&fin_periodo=" + fin_periodo + "&estado=" + estado + "&percepciones=" + percepciones + "&honorarios=" + honorarios + "&relativos=" + relativos + "&subtotal=" + subtotal + "&iva=" + iva + "&total_factura=" + total_factura + "&observaciones=" + observaciones)



}//Fin de la funcion modificar_nomina



function generar_reporte_nomina(id_empresa, id_nomina,callback) {

	

	

	ajax = objetoAjax();



	ajax.open("POST", "../admin/imprimir_prenomina.php", true);



	



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {

			

			callback.call(this,ajax.responseText);

			

			



			

		



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	//enviando los valores

	ajax.send("id_nomina=" + id_nomina + "&id_empresa=" + id_empresa)



}



function autorizar_nomina(id_nomina,parametros) {

	

	



	if(document.getElementById('radio_aceptar').checked == false) {

		alert("Debe seleccionar la casilla de aceptacion")

		return false;

	}



	if(confirm("Al autorizar la nomina se procedera a la dispersi�n y generaci�n de recibos. �Desea continuar?")) {

		ajax = objetoAjax();



		ajax.open("POST", "../clients/autorizar_nomina.php", true);



		ajax.onreadystatechange = function() {

			if(ajax.readyState == 4) {



				//alert("  " + ajax.responseText)



				//cargarPagina('../clients/consultar_nominas.php', 'mainContent');

				

				transaccionesNomina.consultarNominaVistaInicial(parametros,'cuerpoNomina','consultarNominasXEmpresa','POST')



			}

		}



		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		//enviando los valores

		ajax.send("id_nomina=" + id_nomina)



	}// fin de la confirmacion

}



function modificar_nominas_empleado(id_empresa, id_nomina) {

	var id_empleado_actual;



	//Se obtiene un vector con los id de empleado que se guardaran en la nomina

	id_empleado_actual = document.getElementsByName("id_empleado[]");



	for(var i = 0; i < id_empleado_actual.length; i++) {

		id_empleado = id_empleado_actual[i].value;

		

	

		





		

		

		//Este obtiene el id del empleado



		//obtengo los valores de los campos percepciones del empleado



		sueldo_diario = document.getElementById('sueldo_diario_' + id_empleado).value;

		sueldo_integrado = document.getElementById('sueldo_integrado_' + id_empleado).value;

		dias_trabajados = document.getElementById('dias_trabajados_' + id_empleado).value;		

		total_sueldo = document.getElementById('total_sueldo_' + id_empleado).value;

		

		cantidad_hora=document.getElementById('cantidad_horas_extras_' + id_empleado).value;

		total_horas_extras = document.getElementById('total_horas_extras_' + id_empleado).value;

		

		 cantidad_domingo=document.getElementById('cantidad_domingos_' + id_empleado).value;

		 prima_dominicall=document.getElementById('prima_dominical_' + id_empleado).value;

		total_domingos = document.getElementById('total_domingos_' + id_empleado).value;

		

		cantidad_turno=document.getElementById('cantidad_turnos_' + id_empleado).value;       

		total_turnos = document.getElementById('total_turnos_' + id_empleado).value;

		

		cantidad_descanso=document.getElementById('cantidad_descansos_' + id_empleado).value; 

		total_descansos = document.getElementById('total_descansos_' + id_empleado).value;

		

		cantidad_festivo=document.getElementById('cantidad_festivos_' + id_empleado).value;

		total_festivos = document.getElementById('total_festivos_' + id_empleado).value;

		

		cantidad_vacaciones=document.getElementById('cantidad_vacaciones_' + id_empleado).value;

		prima_vacacionall=document.getElementById('prima_vacacional_' + id_empleado).value;

		total_vacaciones = document.getElementById('total_vacaciones_' + id_empleado).value;

		

		aguinalldo=document.getElementById('aguinaldo_' + id_empleado).value;

		complemento_sueldo = document.getElementById('complemento_sueldo_' + id_empleado).value;

		otras_percepciones = document.getElementById('otras_percepciones_' + id_empleado).value;

		

		

		

		//obtengo los valores de los campos deducciones del empleado

		

		prestamos = document.getElementById('prestamos_' + id_empleado).value;		

		caja_ahorro = document.getElementById('caja_ahorro_' + id_empleado).value;		

		fonacot = document.getElementById('fonacot_' + id_empleado).value;		

		infonavit = document.getElementById('infonavit_' + id_empleado).value;

		otras_deducciones = document.getElementById('otras_deducciones_' + id_empleado).value;

	    desc_otras_deducciones="";	

		prestamo_ascon = document.getElementById('prestamo_ascon_' + id_empleado).value;

		

		tipo_nomina="normal";

		

		

		

	

		guarda_ajax_2(id_nomina, id_empleado, id_empresa, sueldo_diario, dias_trabajados, total_sueldo, total_horas_extras, total_domingos, total_turnos, total_descansos, total_festivos, total_vacaciones, complemento_sueldo, otras_percepciones, prestamos, caja_ahorro, fonacot, otras_deducciones, prestamo_ascon, infonavit,prima_vacacionall,prima_dominicall,aguinalldo,cantidad_hora,cantidad_domingo,cantidad_turno,cantidad_descanso,cantidad_festivo,cantidad_vacaciones,tipo_nomina,sueldo_integrado,desc_otras_deducciones);



	}//fin del ciclo for



	

	calcular(id_nomina,tipo_nomina,sueldo_integrado,dias_trabajados);

	div_mensaje = document.getElementById('alerta_nomina');

	div_mensaje.innerHTML = 'Nomina Guardada Correctamente...';

	alert("Nomina "+id_nomina+" Guardada Correctamente.")



}//Fin de la funcion guardar_empleados_nomina





function modificar_nominas_empleado_fiscal(id_empresa, id_nomina) {

	var id_empleado_actual;



	//Se obtiene un vector con los id de empleado que se guardaran en la nomina

	id_empleado_actual = document.getElementsByName("id_empleado[]");



	for(var i = 0; i < id_empleado_actual.length; i++) {

		id_nomina=id_nomina;

		id_empleado = id_empleado_actual[i].value;

		

		sueldo_diario = document.getElementById('sueldo_diario_imss_' + id_empleado).value;

		sueldo_integrado = document.getElementById('sueldo_integrado_' + id_empleado).value;

		dias_trabajados = document.getElementById('dias_trabajados_' + id_empleado).value;

		

		if($("#periodo").val()=="semanal"){

			

			if(dias_trabajados>=8)

			{

				dias_trabajados=dias_trabajados/8;

				

			}

			

		}

		

		total_sueldo = document.getElementById('total_sueldo_imss_' + id_empleado).value;

		

		cantidad_hora=document.getElementById('cantidad_horas_extras_imss_' + id_empleado).value;	

		total_horas_extras = document.getElementById('total_horas_extras_imss_' + id_empleado).value;

		

		cantidad_domingo=document.getElementById('cantidad_domingos_imss_' + id_empleado).value;		

		prima_dominicall=document.getElementById('prima_dominical_imss_' + id_empleado).value;

		total_domingos = document.getElementById('total_domingos_imss_' + id_empleado).value;



		cantidad_turno=document.getElementById('cantidad_turnos_imss_' + id_empleado).value;  

		total_turnos = document.getElementById('total_turnos_imss_' + id_empleado).value;

		

		cantidad_descanso=document.getElementById('cantidad_descansos_imss_' + id_empleado).value;   

		total_descansos = document.getElementById('total_descansos_imss_' + id_empleado).value;

		

		cantidad_festivo=document.getElementById('cantidad_festivos_imss_' + id_empleado).value; 

		total_festivos = document.getElementById('total_festivos_imss_' + id_empleado).value;

		

		cantidad_vacaciones=document.getElementById('cantidad_vacaciones_imss_' + id_empleado).value;

		prima_vacacionall=document.getElementById('prima_vacacional_imss_' + id_empleado).value;		

		total_vacaciones = document.getElementById('total_vacaciones_imss_' + id_empleado).value;

		

		aguinalldo=document.getElementById('aguinaldo_' + id_empleado).value;	

		

		complemento_sueldo = document.getElementById('complemento_sueldo_' + id_empleado).value;

		otras_percepciones = document.getElementById('otras_percepciones_' + id_empleado).value;

		

		

		

		//obtengo los valores de los campos deducciones del empleado

		



		prestamos = document.getElementById('prestamos_' + id_empleado).value;		

		caja_ahorro = document.getElementById('caja_ahorro_' + id_empleado).value;		

		fonacot = document.getElementById('fonacot_' + id_empleado).value;		

		infonavit = document.getElementById('infonavit_' + id_empleado).value;

		otras_deducciones = document.getElementById('otras_deducciones_' + id_empleado).value;

		desc_otras_deducciones=document.getElementById('descripcion_ot_deducciones_' + id_empleado).value;

		prestamo_ascon = document.getElementById('prestamo_ascon_' + id_empleado).value;

		

		

		

	

		

		tipo_nomina="fiscal";

		

		

	

		guarda_ajax_2(id_nomina, id_empleado, id_empresa, sueldo_diario, dias_trabajados, total_sueldo, total_horas_extras, total_domingos, total_turnos, total_descansos, total_festivos, total_vacaciones, complemento_sueldo, otras_percepciones, prestamos, caja_ahorro, fonacot, otras_deducciones, prestamo_ascon, infonavit,prima_vacacionall,prima_dominicall,aguinalldo,cantidad_hora,cantidad_domingo,cantidad_turno,cantidad_descanso,cantidad_festivo,cantidad_vacaciones,tipo_nomina,sueldo_integrado,desc_otras_deducciones);



	}//fin del ciclo for



	

	calcular(id_nomina,tipo_nomina,sueldo_integrado,dias_trabajados);

	div_mensaje = document.getElementById('alerta_nomina');

	div_mensaje.innerHTML = 'Nomina Guardada Correctamente...';

	alert("Nomina  "+id_nomina+" Guardada Correctamente.")



}//Fin de la funcion guardar_empleados_nomina



function guarda_ajax_2(id_nomina, id_empleado, id_empresa, sueldo_diario, dias_trabajados, total_sueldo, total_horas_extras, total_domingos, total_turnos, total_descansos, total_festivos, total_vacaciones, complemento_sueldo, otras_percepciones, prestamos, caja_ahorro, fonacot, otras_deducciones, prestamo_ascon, infonavit,prima_vacacional,prima_dominical,aguinaldo,cantidad_hora,cantidad_domingo,cantidad_turno,cantidad_descanso,cantidad_festivo,cantidad_vacaciones,tipo_nomina,sueldo_integrado,desc_otras_deducciones) {

	ajax = objetoAjax();



	ajax.open("POST", "nominas_empleado_modificar.php", false);



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {



			//obtengo el id_empleado_guardado

			

			



			empleado = ajax.responseText;



			document.getElementById('sueldo_diario_' + empleado).style.backgroundColor = "#900";



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");



	//enviando los valores

	ajax.send("sueldo_diario=" + sueldo_diario + "&dias_trabajados=" + dias_trabajados + "&total_sueldo=" + total_sueldo + "&total_horas_extras=" + total_horas_extras + "&total_domingos=" + total_domingos + "&total_turnos=" + total_turnos + "&total_descansos=" + total_descansos + "&total_festivos=" + total_festivos + "&total_vacaciones=" + total_vacaciones + "&complemento_sueldo=" + complemento_sueldo + "&otras_percepciones=" + otras_percepciones + "&prestamos=" + prestamos + "&caja_ahorro=" + caja_ahorro + "&fonacot=" + fonacot + "&otras_deducciones=" + otras_deducciones + "&prestamo_ascon=" + prestamo_ascon + "&id_nomina=" + id_nomina + "&id_empresa=" + id_empresa + "&id_empleado=" + id_empleado + "&infonavit=" + infonavit+"&prima_vacacional="+prima_vacacional+"&prima_dominical="+prima_dominical+"&aguinaldo="+aguinaldo+"&cantidad_hora="+cantidad_hora+"&cantidad_domingo="+cantidad_domingo+"&cantidad_turno="+cantidad_turno+"&cantidad_descanso="+cantidad_descanso+"&cantidad_festivo="+cantidad_festivo+"&cantidad_vacaciones="+cantidad_vacaciones+"&tipo_nomina="+tipo_nomina+"&sueldo_integrado="+sueldo_integrado+"&desc_ot_deducciones="+desc_otras_deducciones);



}



function dispersar_reporte(id_empresa, id_nomina) {

	ajax = objetoAjax();



	ajax.open("POST", "imprimir_dispersion_excel.php", true);



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {



			//obtengo el listado de nominas

			//alert("  " + ajax.responseText)



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	//enviando los valores

	ajax.send("id_empresa=" + id_empresa + "&id_nomina=" + id_nomina)



}



function consultar_reporte() {

	resultado = document.getElementById('reporte');

	tipo = document.getElementById('tipo_reporte').value;



	if(tipo == "empleados") {

		pagina = "../admin/reporte_empleados.php";

	} else if(tipo == "nominas") {

		pagina = "../admin/reporte_nomina_consulta.php";



	} else if(tipo == "clientes") {

		pagina = "../admin/reporte_nomina_consulta.php";



	}

	ajax = objetoAjax();



	ajax.open("POST", pagina, true);



	resultado.innerHTML = 'Obteniendo reporte...';



	ajax.onreadystatechange = function() {

		if(ajax.readyState == 4) {



			//obtengo el listado de nominas

			resultado.innerHTML = ajax.responseText



		}

	}



	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	//enviando los valores

	ajax.send("tipo=" + tipo)



}





















/*

$_post



id_nomina, 

id_empleado, 

p_sueldo_diario, 

p_dias_trabajados, 

p_total_sueldo, 

p_num_domingos_trabajados, 

p_subtotal_domingos, 

p_prima_dominical, 

p_num_vacaciones, 

p_subtotal_vacaciones, 

p_prima_vacacional, 

p_num_turnos_trabajados, 

p_total_turnos_trabajados, 

p_num_descansos_trabajados, 

p_total_descansos_trabajados, 

p_num_horas_extras, 

p_total_horas_extras, 

p_num_dias_festivos, 

p_total_dias_festivos, 

p_aguinaldo, 

p_premio_por_puntualidad, 

p_premio_por_asistencia, 

p_becas_educacionales, 

p_subsidio_empleo, 

d_prestamos, 

d_caja_ahorro, 

d_fonacot, 

d_infonavit, 

d_ISR, d_IMSS, 

d_descripcion_otras_deducciones, 

d_total_otras_deducciones, 

total_nomina_fiscal

*/

