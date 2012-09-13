// funciones para los calculos de n�mina
var id_empleado_global_para_uso_nominas = "";

/////////CALCULOS DE HORAS EXTRAS///////////////////


function calcular_sueldo(sueldo_diario,sueldo_diario_imss,dias_trabajados, total_sueldo,total_sueldo_imss) {
	
	sueldo_total = 	parseFloat(document.getElementById(sueldo_diario).value) * 	parseFloat(document.getElementById(dias_trabajados).value);
	d_trabajados=$("#"+dias_trabajados).val();
	
	if($("#periodo").val()=="semanal")
	{
		
		if(d_trabajados>=8){
			d_trabajados=d_trabajados/8;
			
		}
		
		
	}
	
	sueldo_total_imss = parseFloat(document.getElementById(sueldo_diario_imss).value) *	parseFloat(d_trabajados);	
	document.getElementById(total_sueldo).value = sueldo_total;
	document.getElementById(total_sueldo_imss).value = sueldo_total_imss;

}



function calcular_total_percepciones(sueldo, horas_extras, domingos, turnos, descansos, festivos, vacaciones, aguinaldo, complemento, otras_percepciones, total_percepciones, total_deducciones, total_empleado) {
	percepciones_totales = 
	parseFloat(document.getElementById(sueldo).value) + 
	parseFloat(document.getElementById(horas_extras).value) + 
	parseFloat(document.getElementById(domingos).value) + 
	parseFloat(document.getElementById(turnos).value) + 
	parseFloat(document.getElementById(descansos).value) + 
	parseFloat(document.getElementById(festivos).value) + 
	parseFloat(document.getElementById(vacaciones).value) + 
	parseFloat(document.getElementById(aguinaldo).value) + 
	parseFloat(document.getElementById(complemento).value) + 
	parseFloat(document.getElementById(otras_percepciones).value);

	document.getElementById(total_percepciones).value = percepciones_totales;

	//Llamo funcion para calcular el gran total del empleado
	calcular_total_empleado(total_percepciones, total_deducciones, total_empleado);
}









/*****************************************************************************************************************************************************/








function calcular_honorarios() {
	//calculo honorarios  Convertir a funcion porque el .06 puede variar
	porc_honorario = parseFloat(document.getElementById('honorarios_empresa').value) / 100;
	hon = parseFloat(document.getElementById('percepciones').value) * porc_honorario
	document.getElementById('honorarios').value = redondea(hon);
}

function calcular_subtotal_factura() {
	subtotal_factura = parseFloat(document.getElementById('percepciones').value) + parseFloat(document.getElementById('honorarios').value) + parseFloat(document.getElementById('relativos').value);

	document.getElementById('subtotal').value = redondea(subtotal_factura);

}

function calcular_iva_factura() {
	porc_iva = parseFloat(document.getElementById('iva_empresa').value) / 100;
	iva_factura = parseFloat(document.getElementById('subtotal').value) * porc_iva;
	document.getElementById('iva').value = redondea(iva_factura);

}

function calcular_total_factura() {

	factura_total = parseFloat(document.getElementById('subtotal').value) + parseFloat(document.getElementById('iva').value);
	document.getElementById('total_factura').value = redondea(factura_total);

}


function redondea(numero) {
	var original = parseFloat(numero);
	var result = Math.round(original * 100) / 100;
	return result;
}



/******************************************************/



function calcular_total_deducciones(prestamos, caja_ahorro, fonacot, otras_deducciones, prestamo_ascon, total_percepciones, total_deducciones, total_empleado, infonavit) {
	deducciones_totales = parseFloat(document.getElementById(prestamos).value) + parseFloat(document.getElementById(caja_ahorro).value) + parseFloat(document.getElementById(fonacot).value) + parseFloat(document.getElementById(otras_deducciones).value) + parseFloat(document.getElementById(infonavit).value) + parseFloat(document.getElementById(prestamo_ascon).value);

	document.getElementById(total_deducciones).value = deducciones_totales;

	//Llamo funcion para calcular el gran total del empleado
	calcular_total_empleado(total_percepciones, total_deducciones, total_empleado);
}




function calcular_total_empleado(total_percepciones, total_deducciones, total_empleado) {
	gran_total = parseFloat(document.getElementById(total_percepciones).value) - parseFloat(document.getElementById(total_deducciones).value);

	document.getElementById(total_empleado).value = gran_total;

	calcular_total_percepciones_nomina();
	//Calcula el total de las percepciones de la nomina
	calcular_total_deducciones_nomina();
	calcular_total_empleados_nomina();

}

function calcular_total_percepciones_nomina() {
	//Calcula el total de las percepciones de la nomina

	var subtotales_percepciones;
	var subtotales_percepciones_imss;
	var gran_total = 0;
	var gran_total_imss = 0;
	subtotales_percepciones = document.getElementsByName("total_percepciones[]");
	subtotales_percepciones_imss = document.getElementsByName("total_percepciones_imss[]");

	for(var i = 0; i < subtotales_percepciones.length; i++) {
		gran_total += parseFloat(subtotales_percepciones[i].value);

	}
	
	for(var i = 0; i < subtotales_percepciones_imss.length; i++) {
		gran_total_imss += parseFloat(subtotales_percepciones_imss[i].value);

	}

	document.getElementById('total_percepciones_nomina').value = redondea(gran_total);
	document.getElementById('total_percepciones_nomina_imss').value = redondea(gran_total_imss);
	document.getElementById('percepciones').value = redondea(gran_total);
	//total de percepciones de la factura
	calcular_honorarios();
	calcular_subtotal_factura();
	calcular_iva_factura()
	calcular_total_factura();

}

function calcular_total_deducciones_nomina() {

	//Calcula el total de las percepciones de la nomina

	var subtotales_deducciones;
	var subtotales_deducciones_imss;
	var gran_total = 0;
	var gran_total_imss = 0;
	
	subtotales_deducciones = document.getElementsByName("total_deducciones[]");
    subtotales_deducciones_imss = document.getElementsByName("total_deducciones[]");

	for(var i = 0; i < subtotales_deducciones.length; i++) {
		gran_total += parseFloat(subtotales_deducciones[i].value);

	}
	
	for(var i = 0; i < subtotales_deducciones_imss.length; i++) {
		gran_total_imss += parseFloat(subtotales_deducciones_imss[i].value);

	}

	document.getElementById('total_deducciones_nomina').value = gran_total;
	document.getElementById('total_deducciones_nomina_imss').value = gran_total_imss;
}

function calcular_total_empleados_nomina() {
	//Calcula el total de las percepciones de la nomina

	var subtotales_empleado;
	var subtotales_empleado_imss;
	var gran_total = 0;
	var gran_total_imss = 0;
	subtotales_empleado = document.getElementsByName("total_empleado[]");
	subtotales_empleado_imss = document.getElementsByName("total_empleado_imss[]");

	for(var i = 0; i < subtotales_empleado.length; i++) {
		gran_total += parseFloat(subtotales_empleado[i].value);

	}
	
	for(var i = 0; i < subtotales_empleado_imss.length; i++) {
		gran_total_imss += parseFloat(subtotales_empleado_imss[i].value);

	}

	document.getElementById('total_empleados_nomina').value = gran_total;
	document.getElementById('total_empleados_nomina_imss').value = gran_total_imss;

}






function mostrar_otras_deducciones(checkbox,id_empleado) {
	id_empleado_global_para_uso_nominas = id_empleado;
	
	$("#descripcion_ot_deducciones").val(
		$("#descripcion_ot_deducciones_"+id_empleado_global_para_uso_nominas).val());
	$("#cantidad_ot_deducciones").val(
		$("#otras_deducciones_"+id_empleado_global_para_uso_nominas).val());
	
		mostrardiv('root_ot_deducciones', 'handle_ot_deducciones');
	

		

	
}


function cancelar_otras_deducciones() {
	
	
	//Se obtienen los id de los campos
	checkboxx = document.getElementById('chk_ot_deducciones_'+id_empleado_global_para_uso_nominas);
		//alert(checkboxx.id)

	document.getElementById("cantidad_ot_deducciones").value = "0";
	document.getElementById("descripcion_ot_deducciones").value = "";
	checkboxx.checked = false

	//Se limpia el checkbox
	//document.getElementById("prestamo_ascon_"+id_empleado_global_para_uso_nominas).focus();
	cerrarDiv('root_ot_deducciones', 'handle_ot_deducciones');
	//Cierro el div flotante

}


function mostrar_hora_extra(checkbox, total_horas_extras,total_horas_extras_imss, sueldo_diario,sueldo_diario_imss, id_empleado) {
	id_empleado_global_para_uso_nominas = id_empleado;
	
	
	if(document.getElementById(checkbox).checked == false) {
		document.getElementById(total_horas_extras).value = "0";
		document.getElementById(total_horas_extras_imss).value = "0";
		document.getElementById("cantidad_horas_extras_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("cantidad_horas_extras_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById(campo_total_horas_extras).focus();
	} else {//Se abre la ventana flotante
		mostrardiv('root_hora', 'handle_hora');

		document.getElementById('sueldo_hora').value = document.getElementById(sueldo_diario).value / 8;
		document.getElementById('sueldo_hora_imss').value = document.getElementById(sueldo_diario_imss).value / 8;
		document.getElementById('no_horas').value = "0";
		document.getElementById('id_total_he').value = total_horas_extras;
		document.getElementById('id_total_he_imss').value = total_horas_extras_imss;
		document.getElementById('id_checkbox').value = checkbox;

	}
}

function cancelar_hora_extra() {
	campo_total_horas_extras = document.getElementById('id_total_he').value;
	campo_total_horas_extras_imss = document.getElementById('id_total_he_imss').value;
	//Se obtienen los id de los campos
	checkbox = document.getElementById('id_checkbox').value;

	document.getElementById(campo_total_horas_extras).value = "0";
	document.getElementById(campo_total_horas_extras_imss).value = "0";
	document.getElementById(checkbox).checked = false;
	//Se limpia el checkbox
	document.getElementById(campo_total_horas_extras).focus();
	cerrarDiv('root_hora', 'handle_hora');
	//Cierro el div flotante

}

function calcular_horas_extras() {
	horas = document.getElementById('no_horas').value;
	sueldo = document.getElementById('sueldo_hora').value;
	sueldo_imss = document.getElementById('sueldo_hora_imss').value;
	fact = document.getElementById('factor').value;
	total_horas_extra = 0;
	total_horas_extra_imss = 0;
	total_horas_extra = horas * sueldo * fact;
	total_horas_extra_imss = horas * sueldo_imss * fact;
	campo_total_horas_extras = document.getElementById('id_total_he').value;
	campo_total_horas_extras_imss = document.getElementById('id_total_he_imss').value;
	//con esto se obtiene el id del campo dinamico

	document.getElementById(campo_total_horas_extras).value = total_horas_extra;
	document.getElementById(campo_total_horas_extras_imss).value = total_horas_extra_imss;
	document.getElementById('cantidad_horas_extras_' + id_empleado_global_para_uso_nominas).value = horas;
	document.getElementById('cantidad_horas_extras_imss_' + id_empleado_global_para_uso_nominas).value = horas;
	//Muestro el resultado del calculo en el campo
	document.getElementById(campo_total_horas_extras).focus();

	cerrarDiv('root_hora', 'handle_hora');
	
	

}



//////////CALCULOS DE DOMINGOS TRABAJADOS//////////////////

function mostrar_domingos(checkbox, total_domingos,total_domingos_imss, sueldo_diario,sueldo_diario_imss, id_empleado) {
	id_empleado_global_para_uso_nominas = id_empleado;
	if(document.getElementById(checkbox).checked == false) {
		document.getElementById(total_domingos).value = "0";
		document.getElementById(total_domingos_imss).value = "0";
		document.getElementById("cantidad_domingos_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("cantidad_domingos_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("prima_dominical_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("prima_dominical_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById(campo_total_domingos).focus();
	} else {//Se abre la ventana flotante
		mostrardiv('root_domingos', 'handle_domingos');

		document.getElementById('sueldo_domingos').value = document.getElementById(sueldo_diario).value;
		document.getElementById('sueldo_domingos_imss').value = document.getElementById(sueldo_diario_imss).value;

		document.getElementById('id_total_domingos').value = total_domingos;
		document.getElementById('id_total_domingos_imss').value = total_domingos_imss;
		document.getElementById('id_checkbox').value = checkbox;

	}
}

function cancelar_domingos() {
	campo_total_domingos = document.getElementById('id_total_domingos').value;
	campo_total_domingos_imss = document.getElementById('id_total_domingos_imss').value;
	//Se obtienen los id de los campos
	checkbox = document.getElementById('id_checkbox').value;

	document.getElementById(campo_total_domingos).value = "0";
	document.getElementById(campo_total_domingos_imss).value = "0";
	document.getElementById(checkbox).checked = false;
	//Se limpia el checkbox
	document.getElementById(campo_total_domingos).focus();
	cerrarDiv('root_domingos', 'handle_domingos');
	//Cierro el div flotante

}

function calcular_domingos() {
	sueldo = document.getElementById('sueldo_domingos').value;
	sueldo_imss = document.getElementById('sueldo_domingos_imss').value;
	//alert("sueldo"+sueldo)
	no_domingos_trab = document.getElementById('no_domingos').value;
	//alert("no_domingos_trab"+no_domingos_trab)

	total_domingos_trab = 0;
	total_domingos_trab_imss = 0;
	//alert("total_domingos_trab"+total_domingos_trab)
	prima_dom = (parseFloat(no_domingos_trab) * parseFloat(sueldo)) * .25;
	prima_dom_imss = (parseFloat(no_domingos_trab) * parseFloat(sueldo_imss)) * .25;
	//alert("prima dominical"+prima_dom)
	total_domingos_trab = (parseFloat(no_domingos_trab) * parseFloat(sueldo)) + parseFloat(prima_dom);
	total_domingos_trab_imss = (parseFloat(no_domingos_trab) * parseFloat(sueldo_imss)) + parseFloat(prima_dom_imss);
	//alert("total_domingos_trab"+total_domingos_trab)
	campo_total_domingos = document.getElementById('id_total_domingos').value;
	campo_total_domingos_imss = document.getElementById('id_total_domingos_imss').value;
	//con esto se obtiene el id del campo dinamico
	//alert("campo_total_domingos"+campo_total_domingos)

	document.getElementById('cantidad_domingos_' + id_empleado_global_para_uso_nominas).value = no_domingos_trab;
	document.getElementById('cantidad_domingos_imss_' + id_empleado_global_para_uso_nominas).value = no_domingos_trab;

	document.getElementById(campo_total_domingos).value = total_domingos_trab;
	document.getElementById(campo_total_domingos_imss).value = total_domingos_trab_imss;
	//Muestro el resultado del calculo en el campo
	document.getElementById("prima_dominical_" + id_empleado_global_para_uso_nominas).value = prima_dom;
	document.getElementById("prima_dominical_imss_" + id_empleado_global_para_uso_nominas).value = prima_dom_imss;
	document.getElementById(campo_total_domingos).focus();
	cerrarDiv('root_domingos', 'handle_domingos');

}


//////////CALCULOS DE TURNOS TRABAJADOS//////////////////

function mostrar_turnos(checkbox, total_turnos, total_turnos_imss, sueldo_diario,sueldo_diario_imss, id_empleado) {
	id_empleado_global_para_uso_nominas = id_empleado;

	if(document.getElementById(checkbox).checked == false) {
		document.getElementById(total_turnos).value = "0";
		document.getElementById(total_turnos_imss).value = "0";
		document.getElementById("cantidad_turnos_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("cantidad_turnos_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById(campo_total_turnos).focus();
	} else {//Se abre la ventana flotante
		mostrardiv('root_turnos', 'handle_turnos');

		document.getElementById('sueldo_turnos').value = document.getElementById(sueldo_diario).value;
		document.getElementById('sueldo_turnos_imss').value = document.getElementById(sueldo_diario_imss).value;

		document.getElementById('id_total_turnos').value = total_turnos;
		document.getElementById('id_total_turnos_imss').value = total_turnos_imss;
		document.getElementById('id_checkbox').value = checkbox;

	}
}

function cancelar_turnos() {
	campo_total_turnos = document.getElementById('id_total_turnos').value;
	campo_total_turnos_imss = document.getElementById('id_total_turnos_imss').value;
	//Se obtienen los id de los campos
	checkbox = document.getElementById('id_checkbox').value;

	document.getElementById(campo_total_turnos).value = "0";
	document.getElementById(campo_total_turnos_imss).value = "0";
	document.getElementById(checkbox).checked = false;
	//Se limpia el checkbox
	document.getElementById(campo_total_turnos).focus();
	cerrarDiv('root_turnos', 'handle_turnos');
	//Cierro el div flotante

}

function calcular_turnos() {
	sueldo = document.getElementById('sueldo_turnos').value;
	sueldo_imss = document.getElementById('sueldo_turnos_imss').value;
	turnos = document.getElementById('no_turnos').value;
	total_turnos_trab = 0;
	total_turnos_trab_imss = 0;
	total_turnos_trab = parseFloat(sueldo) * parseFloat(turnos);
	total_turnos_trab_imss = parseFloat(sueldo_imss) * parseFloat(turnos);
	campo_total_turnos = document.getElementById('id_total_turnos').value;
	campo_total_turnos_imss = document.getElementById('id_total_turnos_imss').value;
	//con esto se obtiene el id del campo dinamico

	document.getElementById('cantidad_turnos_' + id_empleado_global_para_uso_nominas).value = turnos;
	document.getElementById('cantidad_turnos_imss_' + id_empleado_global_para_uso_nominas).value = turnos;

	document.getElementById(campo_total_turnos).value = total_turnos_trab;
	document.getElementById(campo_total_turnos_imss).value = total_turnos_trab_imss;
	//Muestro el resultado del calculo en el campo
	document.getElementById(campo_total_turnos).focus();
	cerrarDiv('root_turnos', 'handle_turnos');

}



//////////CALCULOS DE DESCANSOS TRABAJADOS//////////////////

function mostrar_descansos(checkbox, total_descansos,total_descansos_imss, sueldo_diario,sueldo_diario_imss, id_empleado) {
	id_empleado_global_para_uso_nominas = id_empleado;
	if(document.getElementById(checkbox).checked == false) {
		document.getElementById(total_descansos).value = "0";
		document.getElementById(total_descansos_imss).value = "0";
		document.getElementById("cantidad_descansos_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("cantidad_descansos_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById(campo_total_descansos).focus();
	} else {//Se abre la ventana flotante
		mostrardiv('root_descansos', 'handle_descansos');

		document.getElementById('sueldo_descansos').value = document.getElementById(sueldo_diario).value;
		document.getElementById('sueldo_descansos_imss').value = document.getElementById(sueldo_diario_imss).value;
		document.getElementById('factor_descansos').value = 2;

		document.getElementById('id_total_descansos').value = total_descansos;
		document.getElementById('id_total_descansos_imss').value = total_descansos_imss;
		document.getElementById('id_checkbox').value = checkbox;

	}
}

function cancelar_descansos() {
	campo_total_descansos = document.getElementById('id_total_descansos').value;
	campo_total_descansos_imss = document.getElementById('id_total_descansos_imss').value;
	//Se obtienen los id de los campos
	checkbox = document.getElementById('id_checkbox').value;

	document.getElementById(campo_total_descansos).value = "0";
	document.getElementById(campo_total_descansos_imss).value = "0";
	document.getElementById(checkbox).checked = false;
	//Se limpia el checkbox
	document.getElementById(campo_total_descansos).focus();
	cerrarDiv('root_descansos', 'handle_descansos');
	//Cierro el div flotante

}

function calcular_descansos() {
	sueldo = document.getElementById('sueldo_descansos').value;
	sueldo_imss = document.getElementById('sueldo_descansos_imss').value;
	fact_descansos = document.getElementById('factor_descansos').value;
	no_descansos_trab = document.getElementById('no_descansos').value;
	total_descansos_trab = 0;
	total_descansos_trab_imss = 0;
	total_descansos_trab = (parseFloat(no_descansos_trab) * parseFloat(sueldo)) * parseFloat(fact_descansos);
	total_descansos_trab_imss = (parseFloat(no_descansos_trab) * parseFloat(sueldo_imss)) * parseFloat(fact_descansos);
	campo_total_descansos = document.getElementById('id_total_descansos').value;
	campo_total_descansos_imss = document.getElementById('id_total_descansos_imss').value;
	//con esto se obtiene el id del campo dinamico

	document.getElementById('cantidad_descansos_' + id_empleado_global_para_uso_nominas).value = no_descansos_trab;
	document.getElementById('cantidad_descansos_imss_' + id_empleado_global_para_uso_nominas).value = no_descansos_trab;
	document.getElementById(campo_total_descansos).value = total_descansos_trab;
	document.getElementById(campo_total_descansos_imss).value = total_descansos_trab_imss;
	//Muestro el resultado del calculo en el campo
	document.getElementById(campo_total_descansos).focus();
	cerrarDiv('root_descansos', 'handle_descansos');

}



//////////CALCULOS DE VACACIONES//////////////////

function mostrar_vacaciones(checkbox, total_vacaciones,total_vacaciones_imss, sueldo_diario,sueldo_diario_imss, id_empleado) {
	id_empleado_global_para_uso_nominas = id_empleado;
	
	if(document.getElementById(checkbox).checked == false) {
		document.getElementById(total_vacaciones).value = "0";
		document.getElementById(total_vacaciones_imss).value = "0";
		
		document.getElementById("cantidad_vacaciones_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("cantidad_vacaciones_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("prima_vacacional_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("prima_vacacional_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById(campo_total_vacaciones).focus();
	} else {//Se abre la ventana flotante
		mostrardiv('root_vacaciones', 'handle_vacaciones');

		document.getElementById('sueldo_vacaciones').value = document.getElementById(sueldo_diario).value;
		document.getElementById('sueldo_vacaciones_imss').value = document.getElementById(sueldo_diario_imss).value;

		document.getElementById('id_total_vacaciones').value = total_vacaciones;
		document.getElementById('id_total_vacaciones_imss').value = total_vacaciones_imss;
		document.getElementById('id_checkbox').value = checkbox;

	}
}

function cancelar_vacaciones() {
	campo_total_vacaciones = document.getElementById('id_total_vacaciones').value;
	campo_total_vacaciones_imss = document.getElementById('id_total_vacaciones_imss').value;
	//Se obtienen los id de los campos
	checkbox = document.getElementById('id_checkbox').value;

	document.getElementById(campo_total_vacaciones).value = "0";
	document.getElementById(campo_total_vacaciones_imss).value = "0";
	document.getElementById("cantidad_vacaciones_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("cantidad_vacaciones_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("prima_vacacional_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("prima_vacacional_imss_"+id_empleado_global_para_uso_nominas).value = "0";
	
	document.getElementById(checkbox).checked = false;
	//Se limpia el checkbox
	document.getElementById(campo_total_vacaciones).focus();
	cerrarDiv('root_vacaciones', 'handle_vacaciones');
	//Cierro el div flotante

}

function calcular_vacaciones() {
	sueldo = document.getElementById('sueldo_vacaciones').value;
	sueldo_imss = document.getElementById('sueldo_vacaciones_imss').value;
	dias_vacaciones = document.getElementById('no_dias_vac').value;
	total_vacaciones_trab = 0;
	total_vacaciones_trab_imss = 0;
	sueldo_vac = parseFloat(sueldo) * parseFloat(dias_vacaciones);
	sueldo_vac_imss = parseFloat(sueldo_imss) * parseFloat(dias_vacaciones);
	prima_vac = sueldo_vac * .25;
	prima_vac_imss = sueldo_vac_imss * .25;
	total_vacaciones_trab = sueldo_vac + prima_vac;
	total_vacaciones_trab_imss = sueldo_vac_imss + prima_vac_imss;
	campo_total_vacaciones = document.getElementById('id_total_vacaciones').value;
	campo_total_vacaciones_imss = document.getElementById('id_total_vacaciones_imss').value;
	//con esto se obtiene el id del campo dinamico

	document.getElementById('cantidad_vacaciones_' + id_empleado_global_para_uso_nominas).value = dias_vacaciones;
	document.getElementById('cantidad_vacaciones_imss_' + id_empleado_global_para_uso_nominas).value = dias_vacaciones;

	document.getElementById(campo_total_vacaciones).value = total_vacaciones_trab;
	document.getElementById(campo_total_vacaciones_imss).value = total_vacaciones_trab_imss;
	//Muestro el resultado del calculo en el campo
	document.getElementById("prima_vacacional_" + id_empleado_global_para_uso_nominas).value = prima_vac;
	document.getElementById("prima_vacacional_imss_" + id_empleado_global_para_uso_nominas).value = prima_vac_imss;
	document.getElementById(campo_total_vacaciones).focus();
	cerrarDiv('root_vacaciones', 'handle_vacaciones');

}





//////////CALCULOS DE DIAS FESTIVOS TRABAJADOS//////////////////

function mostrar_festivos(checkbox, total_festivos,total_festivos_imss, sueldo_diario,sueldo_diario_imss, id_empleado) {
	id_empleado_global_para_uso_nominas = id_empleado;

	if(document.getElementById(checkbox).checked == false) {
		document.getElementById(total_festivos).value = "0";
		document.getElementById(total_festivos_imss).value = "0";
		document.getElementById("cantidad_festivos_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("cantidad_festivos_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById(campo_total_festivos).focus();
	} else {//Se abre la ventana flotante
		mostrardiv('root_festivos', 'handle_festivos');

		document.getElementById('sueldo_festivos').value = document.getElementById(sueldo_diario).value;
		document.getElementById('sueldo_festivos_imss').value = document.getElementById(sueldo_diario_imss).value;
		document.getElementById('factor_festivos').value = 2;

		document.getElementById('id_total_festivos').value = total_festivos;
		document.getElementById('id_total_festivos_imss').value = total_festivos_imss;
		document.getElementById('id_checkbox').value = checkbox;

	}
}

function cancelar_festivos() {
	campo_total_festivos = document.getElementById('id_total_festivos').value;
	campo_total_festivos_imss = document.getElementById('id_total_festivos_imss').value;
	//Se obtienen los id de los campos
	checkbox = document.getElementById('id_checkbox').value;

	document.getElementById(campo_total_festivos).value = "0";
	document.getElementById(campo_total_festivos_imss).value = "0";
	document.getElementById("cantidad_festivos_"+id_empleado_global_para_uso_nominas).value = "0";
		document.getElementById("cantidad_festivos_imss_"+id_empleado_global_para_uso_nominas).value = "0";
		
	document.getElementById(checkbox).checked = false;
	//Se limpia el checkbox
	document.getElementById(campo_total_festivos).focus();
	cerrarDiv('root_festivos', 'handle_festivos');
	//Cierro el div flotante

}

function calcular_festivos() {
	sueldo = document.getElementById('sueldo_festivos').value;
	sueldo_imss = document.getElementById('sueldo_festivos_imss').value;
	fact_festivos = document.getElementById('factor_festivos').value;
	no_festivos_trab = document.getElementById('no_festivos').value;
	total_festivos_trab = 0;
	total_festivos_trab_imss = 0;
	total_festivos_trab = (parseFloat(no_festivos_trab) * parseFloat(sueldo) ) * parseFloat(fact_festivos);
	total_festivos_trab_imss = (parseFloat(no_festivos_trab) * parseFloat(sueldo_imss) ) * parseFloat(fact_festivos);
	campo_total_festivos = document.getElementById('id_total_festivos').value;
	campo_total_festivos_imss = document.getElementById('id_total_festivos_imss').value;
	//con esto se obtiene el id del campo dinamico

	document.getElementById('cantidad_festivos_' + id_empleado_global_para_uso_nominas).value = no_festivos_trab;
	document.getElementById('cantidad_festivos_imss_' + id_empleado_global_para_uso_nominas).value = no_festivos_trab;

	document.getElementById(campo_total_festivos).value = total_festivos_trab;
	document.getElementById(campo_total_festivos_imss).value = total_festivos_trab_imss;
	//Muestro el resultado del calculo en el campo
	document.getElementById(campo_total_festivos).focus();
	cerrarDiv('root_festivos', 'handle_festivos');

}


function aceptar_ot_deducciones(){
		document.getElementById('otras_deducciones_'+id_empleado_global_para_uso_nominas).value=document.getElementById('cantidad_ot_deducciones').value
		document.getElementById('descripcion_ot_deducciones_'+id_empleado_global_para_uso_nominas).value=document.getElementById('descripcion_ot_deducciones').value;
		document.getElementById('otras_deducciones_'+id_empleado_global_para_uso_nominas).focus();
	cerrarDiv('root_ot_deducciones', 'handle_ot_deducciones');
		
		
	
}
