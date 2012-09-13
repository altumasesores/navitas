// Funcion para hacer los vinculos a los modulos
function cargarPagina(_pagina, capa) {
	
	operaciones2.abrir_loader();
						
	var ajax;
	ajax = objetoAjax();
	ajax.open("POST", _pagina, true);

	//document.getElementById(capa).innerHTML = "Cargandoaaa...";
	//document.getElementById(capa).innerHTML = '<img src="../imagenes/loading.gif" />';
	//document.getElementById(capa).innerHTML = '<div class="loader" id="loader" style="left:37%;top:42%;"><img src="../imagenes/loading.gif" /></div>';
	document.getElementById('mainContent').innerHTML = '<BR/><BR/><BR/><BR/><BR/><BR/<BR/><BR/><BR/><BR/<BR/><div style="background-color:#FFFFFF; width: 100%;position:fixed!important; z-index:9999;" align="center" ><img src="../imagenes/loading.gif" /></div><BR/><BR/><BR/><BR/><BR/><BR/<BR/><BR/><BR/><BR/><BR/><BR/<BR/><BR/><BR/><BR/><BR/<BR/>';
//	document.getElementById(capa).innerHTML = document.getElementById('flotante').style.display = 'block';
	ajax.onreadystatechange = function() {
		if(ajax.readyState == 4) {
			if(ajax.status == 200) {
				document.getElementById(capa).innerHTML = ajax.responseText;
				operaciones2.cerrar_loader();
			}
		}
	}
	ajax.send(_pagina);
}
function hola(capa) {
	//alert('dfd'); 
}
function cargarPagina2(_pagina, capa, dato) {

	var ajax;
	ajax = objetoAjax();
	ajax.open("POST", _pagina, true);

	document.getElementById(capa).innerHTML = "Cargando...";
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	ajax.onreadystatechange = function() {
		if(ajax.readyState == 4) {
			if(ajax.status == 200) {
				document.getElementById(capa).innerHTML = ajax.responseText;
			}
		}
	}
	ajax.send(_pagina + "&id_empresa=" + dato);
}

// Funcion para hacer los vinculos a los modulos
function cargarEmpleados(_pagina, capa, id_empresa) {
	var ajax;
	ajax = objetoAjax();
	ajax.open("POST", _pagina, true);

	document.getElementById(capa).innerHTML = "Cargando...";
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	ajax.onreadystatechange = function() {
		if(ajax.readyState == 4) {
			if(ajax.status == 200) {
				document.getElementById(capa).innerHTML = ajax.responseText;
			}
		}
	}
	ajax.send("id_empresa=" + id_empresa);
}