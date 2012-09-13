//Funciones para elimnar datos
//Eliminar Publicacion
function eliminar_publicacion(id_documento){
	divResultado = document.getElementById('publicaciones'); 					
	ajax=objetoAjax();
		
	ajax.open("POST", "../admin/publicacion_eliminar.php",true);

  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

		//mostrar resultados en esta capa
		//alert("  "+ajax.responseText)
		divResultado.innerHTML = ajax.responseText
		cargarPagina('../admin/publicaciones.php', 'mainContent');

		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("id_documento="+id_documento)	
	
	
	}

function eliminar_usuarios_clientes(id_usuario, id_empresa, usuario){
			
			
	ajax=objetoAjax();
		
	ajax.open("POST", "../admin/usuario_empresas_eliminar.php",true);

  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
     	 alert("  "+ajax.responseText)
		 asignar_clientes(id_usuario, usuario);


		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("id_usuario="+id_usuario+"&id_empresa="+id_empresa)	
	
	
	}



//ELIMINAR EMPRESAS
function eliminar_empresa(id_empresa){
   //donde se mostrar el resultado de la eliminacion
   divResultado = document.getElementById('empresas');   
   proceso="eliminar";
   //usaremos un cuadro de confirmacion 
   var eliminar = confirm("Est\u00e1 seguro que desea eliminar esta empresa")
   if ( eliminar ) {
	   //instanciamos el objetoAjax
	   ajax=objetoAjax();

	   ajax.open("POST", "../admin/empresa_procesos.php", true);
	   ajax.onreadystatechange=function() {
		   if (ajax.readyState==4) {
		   //mostrar resultados en esta capa
//		   ivResultado.innerHTML= '<img src="anim.gif">';  PARA USAR UN GIF CARGADOR
		   divResultado.innerHTML = "Eliminando..."	
		   jAlert(ajax.responseText);	   
		   cargarPagina('../admin/empresas.php','mainContent');
		   //divResultado = document.getElementById('empresas');   
		  
		   }
   }

     ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 ajax.send('id_empresa='+id_empresa+'&proceso='+proceso)
   }
}


//ELIMINAR USUARIOS
function eliminar_usuario(id_usuario){
   //donde se mostrar el resultado de la eliminacion
   divResultado = document.getElementById('usuarios');   
   proceso="eliminar";
   //usaremos un cuadro de confirmacion 
   var eliminar = confirm("Est\u00e1 seguro que desea eliminar este usuario")
   if ( eliminar ) {
	   //instanciamos el objetoAjax
	   ajax=objetoAjax();

	   ajax.open("POST", "../admin/usuario_procesos.php", true);
	   ajax.onreadystatechange=function() {
		   if (ajax.readyState==4) {
		   //mostrar resultados en esta capa
//		   ivResultado.innerHTML= '<img src="anim.gif">';  PARA USAR UN GIF CARGADOR
		   divResultado.innerHTML = "Eliminando..."
		   divResultado.innerHTML = ajax.responseText
		   }
   }

     ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 ajax.send('id_usuario='+id_usuario+'&proceso='+proceso)
   }
}



function eliminar_nomina(id_nomina){
   //donde se mostrar el resultado de la eliminacion
   divResultado = document.getElementById('nominas_empresa');   

	
   //usaremos un cuadro de confirmacion 
   var eliminar = confirm("Est\u00e1 seguro que desea eliminar esta nomina definitivamente?")
   
   if ( eliminar ) {
	   //instanciamos el objetoAjax
	   ajax=objetoAjax();

	   ajax.open("POST", "nominas_eliminar.php", true);
	   ajax.onreadystatechange=function() {
		   if (ajax.readyState==4) {
		   //mostrar resultados en esta capa
//		   ivResultado.innerHTML= '<img src="anim.gif">';  PARA USAR UN GIF CARGADOR
		   divResultado.innerHTML = "Eliminando..."
		   cargarPagina('nominas.php', 'mainContent');
		   alert(" "+ ajax.responseText)
		   
		   }
   }

     ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 ajax.send('id_nomina='+id_nomina)
   }
}


 function GetLeftPos (elem) {
	alert(elem);
            var leftPx = elem.style.pixelTop;
            alert ("\n in pixels: " + leftPx); 
        }

function quitar_empleado_nomina(id_empleado, id_empresa, id_nomina){
	
	     
		
  var parametros_basicos={
  "controlador":"Calculos",			    
  "mensaje":"este usuario",
  "capa":"nominas_empresa_empleados",
  "modulo":"calculos"					   
  }
  
  

  
  var operaciones={ 	"operacion":"CargarNomina",
						"accion":"CargarNomina"
						}

var parametros_especificos={
				  "id_nomina":id_nomina,				  
				  "id_empresa":id_empresa
				  }

  
	
	
	divResultado= document.getElementById('nominas_empresa_empleados');
	
	 //usaremos un cuadro de confirmacion 
   var eliminar = confirm("Est\u00e1 seguro que desea quitar al empleado de esta nomina?")
   
   if ( eliminar ) {
	
	ajax=objetoAjax();
		
	ajax.open("POST", "nominas_quitar_empleado.php",true);
	divResultado.innerHTML=  'Eliminando...';

  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
     	alert(ajax.responseText);
		eliminarEmpleado(id_empleado,id_empresa,id_nomina);
		 operaciones2.inicializador(parametros_basicos,parametros_especificos,operaciones,'POST');
		 

		 }
    }

	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("id_empleado="+id_empleado+"&id_empresa="+id_empresa+"&id_nomina="+id_nomina)	
	  
	  
	
   }
		
	}  //fin de la funcion
	
	function eliminarEmpleado(id_empleado, id_empresa, id_nomina) {
		

	//alert(id_empleado + id_empresa + id_nomina)
	modulo = "calculos";
	controlador = "Calculos";
	accion = "ElimEmpleado";
	parametros = "modulo=" + modulo + "&controlador=" + controlador + "&accion=" + accion + "&id_empleado=" + id_empleado +"&id_empresa=" + id_empresa +"&idNomina=" + id_nomina;
	jQuery.ajax({
		"url" : "../admin/AnteFrontController.php",
		"type" : "get",
		"data" : parametros,
		"success" : function(response) {

			//alert('ELIMINANDO DE NOMINA FISCAL ' + response);
		}
	});

	}
