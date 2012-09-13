// Funciones para modificaci�n de registros de los diferentes modulos

function modificar_empresa(clave, razon, titular, zona, rfc, direccion, correo, telefonos, id_usuario, usuario, password, iva, honorarios) {
	//Posiciono los datos en los campos para su modificacion
	document.getElementById('id_empresa').value = clave;
	document.getElementById('razon_social').value = razon;
	document.getElementById('titular').value = titular;
	document.getElementById('zona').value = zona;
	document.getElementById('rfc').value = rfc;
	document.getElementById('direccion').value = direccion;
	document.getElementById('correo').value = correo;
	document.getElementById('telefonos').value = telefonos;
	document.getElementById('id_usuario').value = id_usuario;
	document.getElementById('user').value = usuario;
	document.getElementById('password').value = password;
	document.getElementById('iva').value = iva;
	document.getElementById('honorarios').value = honorarios;

	//deshabilito el boton de guardar
	document.getElementById('modificar').disabled = false;
	document.getElementById('guardar').disabled = true;

}

function modificar_usuario(id_usuario, usuario, password, nombre, tipo, correo) {
	//Posiciono los datos en los campos para su modificacion
	document.getElementById('id_usuario').value = id_usuario;
	document.getElementById('usuario2').value = usuario;
	document.getElementById('password').value = password;
	document.getElementById('nombre').value = nombre;
	document.getElementById('correo').value = correo;
	document.getElementById('tipo').value = tipo;

	//deshabilito el boton de guardar
	document.getElementById('modificar').disabled = false;
	document.getElementById('guardar').disabled = true;

}

function modificar_empleado(id_empleado, curp_empleado, no_seg_social, ap_paterno, ap_materno, nombre, cuenta_imss, fecha_alta_imss, domicilio, fecha_nacimiento, sueldo_diario_imss, estado, observaciones, periodo, sueldo_diario, no_tarjeta, infonavit,fecha_alta) {
	//deshabilito el boton de guardar

	id_empresa = document.getElementById('empresa').value;
	estadoBusquedaa = document.getElementById('estadoBusqueda').value;
	document.getElementById('estadoBusq').value = estadoBusquedaa;

	document.getElementById('modificar').disabled = false;
	document.getElementById('guardar').disabled = true;
	//Posiciono los datos en los campos para su modificacion
	document.getElementById('id_empleado').value = id_empleado;
	document.getElementById('curp_empleado').value = curp_empleado;
	document.getElementById('no_seg_social').value = no_seg_social;
	document.getElementById('ap_paterno').value = ap_paterno;
	document.getElementById('ap_materno').value = ap_materno;
	document.getElementById('nombre').value = nombre;
	document.getElementById('domicilio').value = domicilio;
	document.getElementById('sueldo_diario_imss').value = sueldo_diario_imss;
	document.getElementById('sueldo_diario').value = sueldo_diario;
	document.getElementById('estado').value = estado;
	document.getElementById('no_tarjeta').value = no_tarjeta;
	document.getElementById('observaciones').value = observaciones;
	document.getElementById('infonavit').value = infonavit;

	if(cuenta_imss == "Si") {

		document.getElementById('cuenta_imss_0').checked = true;
	} else {
		document.getElementById('cuenta_imss_1').checked = true;

	}

	//Los siguientes 3 campos forman la fecha_alta_imss
	a = fecha_alta_imss.substring(8);
	b = fecha_alta_imss.substring(5, 7);
	c = fecha_alta_imss.substring(0, 4);

	document.getElementById('fecha_imss').value = a + "/" + b + "/" + c;
	/* var elem2 = fecha_alta_imss.split('/');
	dia2 = elem2[0];
	mes2 = elem2[1];
	anio2 = elem2[2];
	document.getElementById('fecha_imss').value= dia2 + "/" + mes2 + "/" + anio2 ;   */
	//document.getElementById('fecha_nac').value= fecha_nacimiento ;
	//Los siguientes 3 campos forman la fecha_nacimiento
	d = fecha_nacimiento.substring(8);
	e = fecha_nacimiento.substring(5, 7);
	f = fecha_nacimiento.substring(0, 4);

	document.getElementById('fecha_nac').value = d + '/' + e + '/' + f;
	
	
	g = fecha_alta.substring(8);
	h = fecha_alta.substring(5, 7);
	i = fecha_alta.substring(0, 4);

	document.getElementById('fecha_altaEmpleado').value = g + '/' + h + '/' + i;
	//document.getElementById('fecha_imss').value= fecha_alta_imss ;
	/* var elem = fecha_nacimiento.split('/');
	 dia1 = elem[2];
	 mes1 = elem[1];
	 anio1 = elem[0];
	 document.getElementById('fecha_nac').value = dia1 + "/"+ mes1 + "/" + anio1; */

	/* var elem2 = fecha_alta_imss.split('/');
	 dia2 = elem2[0];
	 mes2 = elem2[1];
	 anio2 = elem2[2];
	 document.getElementById('fecha_imss').value = dia2 + "/"+ mes2 + "/" + anio2;
	 */
	document.getElementById(periodo).checked = true;

}

function modificar_empleado_empresa(id_empleado, curp_empleado, no_seg_social, ap_paterno, ap_materno, nombre, cuenta_imss, fecha_alta_imss, domicilio, fecha_nacimiento, sueldo_diario_imss, estado, observaciones, periodo, sueldo_diario, no_tarjeta, infonavit) {
	divResultado = document.getElementById('mainContent');
	//Los siguientes 3 campos forman la fecha_alta_imss
	a = fecha_alta_imss.substring(8);
	b = fecha_alta_imss.substring(5, 7);
	c = fecha_alta_imss.substring(0, 4);
	fecha_imss = a + "/" + b + "/" + c;
	d = fecha_nacimiento.substring(8);
	e = fecha_nacimiento.substring(5, 7);
	f = fecha_nacimiento.substring(0, 4);
	fecha_nac = d + '/' + e + '/' + f;
	ajax = objetoAjax();
	ajax.open("POST", "../admin/empleados_empresas.php", true);

	ajax.onreadystatechange = function() {
		if(ajax.readyState == 4) {
			divResultado.innerHTML = ajax.responseText;
		}
	}

	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_empleado=" + id_empleado + "&curp_empleado=" + curp_empleado + "&no_seg_social=" + no_seg_social + "&ap_paterno=" + ap_paterno + "&ap_materno=" + ap_materno + "&nombre=" + nombre + "&cuenta_imss=" + cuenta_imss + "&fecha_alta_imss=" + fecha_imss + "&domicilio=" + domicilio + "&fecha_nacimiento=" + fecha_nac + "&sueldo_diario_imss=" + sueldo_diario_imss + "&estado=" + estado + "&observaciones=" + observaciones + "&periodo=" + periodo + "&sueldo_diario=" + sueldo_diario + "&no_tarjeta=" + no_tarjeta + "&infonavit=" + infonavit)

}

function buscarEmpleados() {
	divResultado = document.getElementById('empleados');
	estado = document.getElementById('id_estado').value;
	empresa = document.getElementById('empresa').value;
	ajax = objetoAjax();
	//alert(estado + empresa);
	ajax.open("POST", "../clients/empleado_consulta.php", true);

	ajax.onreadystatechange = function() {
		if(ajax.readyState == 4) {
			divResultado.innerHTML = ajax.responseText;
			//alert(""+ajax.responseText);

		}
	}

	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("estado=" + estado + "&empresa=" + empresa)

}//FIN DE LA FUNCION

function buscarEmpleados_porEmpresas() {
	divResultado = document.getElementById('mainContent');
	id_empresa = document.getElementById('id_empresa').value;
	var indice = document.getElementById('id_empresa').selectedIndex;
	nombre = document.getElementById('id_empresa').options[indice].text;
	//alert(nombre);
	ajax = objetoAjax();
	ajax.open("POST", "../admin/empleados_empresas_consulta.php", true);

	ajax.onreadystatechange = function() {
		if(ajax.readyState == 4) {
			divResultado.innerHTML = ajax.responseText;
		}
	}

	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("empresa=" + id_empresa + "&nombre=" + nombre)

} //FIN DE LA FUNCION