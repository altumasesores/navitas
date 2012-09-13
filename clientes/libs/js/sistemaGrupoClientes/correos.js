// Funciones para el envio de correos

function correo_nueva_empresa(razon_social, usuario, password, correo){
			
			
	//divResultado= document.getElementById('mainContent');
	
	ajax=objetoAjax();
		
	ajax.open("POST", "correo_nueva_empresa.php",true);
	//divResultado.innerHTML=  'Obteniendo Listado de Empresas...';
		
	  ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {		
	
		  //mostrar resultados en esta capa
			  alert(" " + ajax.responseText)			
		// 	 divResultado.innerHTML = ajax.responseText	
			 }
		}


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("usuario="+usuario+"&password="+password+"&razon_social="+razon_social+"&correo="+correo)	
	
	
	}
function correo_nueva_publicacion(archivo,descripcion){
		alert('prueba');	
			
	//divResultado= document.getElementById('mainContent');
	 
		ajax=objetoAjax();
		
	ajax.open("POST", "correo2.php",true);
	//divResultado.innerHTML=  'Obteniendo Listado de Empresas...';
		
  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
		  alert("Respuesta del correo:  " + ajax.responseText)
		
    // 	 divResultado.innerHTML = ajax.responseText


		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	   ajax.send('archivo='+archivo+'&descripcion='+descripcion)
	}


function correo_nuevo_usuario(usuario, password, nombre, correo){
			
			
	//divResultado= document.getElementById('mainContent');
	
		ajax=objetoAjax();
		
	ajax.open("POST", "correo_nuevo_usuario.php",true);
	//divResultado.innerHTML=  'Obteniendo Listado de Empresas...';
		
  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
		  alert("Respuesta del correo:  " + ajax.responseText)
		
    // 	 divResultado.innerHTML = ajax.responseText


		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("usuario="+usuario+"&password="+password+"&nombre="+nombre+"&correo="+correo)	
	
	
	}
	







function correo_prenomina(id_empresa, inicio_periodo, fin_periodo, periodo_nomina ){
			
			
	//divResultado= document.getElementById('mainContent');
	
		ajax=objetoAjax();
		
	ajax.open("POST", "correo_prenomina.php",true);
	//divResultado.innerHTML=  'Obteniendo Listado de Empresas...';
		
  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
	  
		  alert("Respuesta:  " + ajax.responseText)
		
    // 	 divResultado.innerHTML = ajax.responseText


		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("id_empresa="+id_empresa+"&inicio_periodo="+inicio_periodo+"&fin_periodo="+fin_periodo+"&periodo_nomina="+periodo_nomina)	
	
	
	}
	
	
	
function correo_revision_nomina(id_nomina, estado_ant ){
			
			
	//divResultado= document.getElementById('mainContent');
	
		ajax=objetoAjax();
		
	ajax.open("POST", "correo_revision_nomina.php",true);
	//divResultado.innerHTML=  'Obteniendo Listado de Empresas...';
		
  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
	  
		  alert("Respuesta:  " + ajax.responseText)
		
    // 	 divResultado.innerHTML = ajax.responseText


		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("id_nomina="+id_nomina+"&estado_anterior="+estado_ant)	
	
	
	}