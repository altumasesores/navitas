// Funciones para guardar los datos de todos los modulos
//GUARDAR Y MODIFICAR EMPRESAS
function guardar_empresa(){

		//Valido los campos obligatorios			
		if (document.getElementById('razon_social').value.length==0){ 
			   alert("Debe escribir la Razon Social") 
			   document.frmEmpresas.razon_social.focus() 
			   return false; 
			} 
		if (document.getElementById('titular').value.length==0){ 
			   alert("Debe escribir el nombre del Titular") 
			   document.frmEmpresas.titular.focus() 
			   return false; 
			} 
					
	divResultado= document.getElementById('empresas');
	
	//Se obtienen los datos del formulario y se validan si estan disponibles	
	razon_social= document.getElementById('razon_social').value;
	titular= document.getElementById('titular').value;
	zona= document.getElementById('zona').value;
	rfc= document.getElementById('rfc').value;
	direccion= document.getElementById('direccion').value;
	correo= document.getElementById('correo').value;
	telefonos= document.getElementById('telefonos').value;
	iva= document.getElementById('iva').value;
	honorarios= document.getElementById('honorarios').value;
	usuario= document.getElementById('user').value;
	password= document.getElementById('password').value;




		 proceso="guardar";
		ajax=objetoAjax();
		
		ajax.open("POST", "empresa_guardar.php",true);
		divResultado.innerHTML=  'Guardando...';
		
		//deshabilito el boton de guardar
		document.getElementById('guardar').disabled=true;

	  ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
//    	 divResultado.innerHTML = ajax.responseText
		//alert(""+ajax.responseText);

		correo_nueva_empresa(razon_social, usuario, password, correo);
		
		cargarPagina('empresas.php','mainContent');
		
		//limpiar campos	 
		 limpiarEmpresa();

		//deshabilito el boton de guardar
		document.getElementById('guardar').disabled=false;
		//deshabilito el boton de guardar
		document.getElementById('modificar').disabled=true;

		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores
	  ajax.send("razon_social="+razon_social+"&titular="+titular+"&zona="+zona+"&rfc="+rfc+"&direccion="+direccion+"&correo="+correo+"&telefonos="+telefonos+"&usuario="+usuario+"&password="+password+"&proceso="+proceso+"&iva="+iva+"&honorarios="+honorarios)		
		
	
} //FIN DE LA FUNCION
	
	
	
function empresa_modificar(){
	
		//Valido los campos obligatorios
			
		if (document.getElementById('razon_social').value.length==0){ 
			   alert("Debe escribir la Razon Social") 
			   document.frmEmpresas.razon_social.focus() 
			   return false; 
			} 
		if (document.getElementById('titular').value.length==0){ 
			   alert("Debe escribir el nombre del Titular") 
			   document.frmEmpresas.titular.focus() 
			   return false; 
			} 
					
	divResultado= document.getElementById('empresas');
	
	//Se obtienen los datos del formulario y se validan si estan disponibles	
	id_empresa= document.getElementById('id_empresa').value;
	razon_social= document.getElementById('razon_social').value;
	titular= document.getElementById('titular').value;
	zona= document.getElementById('zona').value;
	rfc= document.getElementById('rfc').value;
	direccion= document.getElementById('direccion').value;
	correo= document.getElementById('correo').value;
	telefonos= document.getElementById('telefonos').value;
	iva= document.getElementById('iva').value;
	honorarios= document.getElementById('honorarios').value;
	
	id_usuario= document.getElementById('id_usuario').value;
	usuario= document.getElementById('user').value;
	password= document.getElementById('password').value;



	proceso="actualizar";
		
	//deshabilito el boton de guardar
	document.getElementById('modificar').disabled=false;
		
	ajax=objetoAjax();
		
	ajax.open("POST", "empresa_modificar.php",true);
	divResultado.innerHTML=  'Guardando...';
	  	
	//deshabilito el boton de guardar
	document.getElementById('modificar').disabled=true;
		
		
	  ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {		

	  
	  //mostrar resultados en esta capa
	//     	 divResultado.innerHTML = ajax.responseText
		//alert(""+ajax.responseText);
		cargarPagina('empresas.php','mainContent');
			 //limpiar campos	 
 		 limpiarEmpresa();
			 //deshabilito el boton de guardar
		document.getElementById('guardar').disabled=false;
		
		
		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores
	  ajax.send("id_empresa="+id_empresa+"&razon_social="+razon_social+"&titular="+titular+"&zona="+zona+"&rfc="+rfc+"&direccion="+direccion+"&correo="+correo+"&telefonos="+telefonos+"&id_usuario="+id_usuario+"&usuario="+usuario+"&password="+password+"&proceso="+proceso+"&iva="+iva+"&honorarios="+honorarios)			
	
	
	
	}	
	
	
	
	
	
function limpiarEmpresa(){
		document.getElementById('id_empresa').value="";
		document.getElementById('razon_social').value="";
		document.getElementById('titular').value="";
		document.getElementById('zona').value="zona";
		document.getElementById('rfc').value="";
		document.getElementById('direccion').value="";
		document.getElementById('correo').value="";
		document.getElementById('telefonos').value="";
		document.getElementById('user').value="";
		document.getElementById('iva').value="11";
		document.getElementById('honorarios').value="6";
		document.getElementById('password').value="";
		
				//habilito el boton de guardar
		document.getElementById('guardar').disabled=false;
			//deshabilito el boton de modificar
		document.getElementById('modificar').disabled=true;
	
	}	





//GUARDAR Y MODIFICAR USUARIOS
function guardar_usuario(boton){

		//Valido los campos obligatorios
		
		if (document.getElementById('usuario2').value.length==0){ 
			   alert("Debe escribir el usuario") 
			   document.frmUsuarios.usuario2.focus() 
			   return false; 
			} 
		if (document.getElementById('password').value.length==0){ 
			   alert("Debe escribir el password") 
			   document.frmUsuarios.password.focus() 
			   return false; 
			} 

		if (document.getElementById('nombre').value.length==0){ 
			   alert("Debe escribir el nombre completo del usuario") 
			   document.frmUsuarios.nombre.focus() 
			   return false; 
			} 
			
		if (document.getElementById('correo').value.length==0){ 
			   alert("Debe escribir el correo del usuario") 
			   document.frmUsuarios.correo.focus() 
			   return false; 
			} 

		if (document.getElementById('tipo').value=="Seleccionar..."){ 
			   alert("Debe seleccionar el tipo de usuario") 
			   document.frmUsuarios.tipo.focus() 
			   return false; 
			} 

	divResultado= document.getElementById('usuarios');
	
	//Se obtienen los datos del formulario y se validan si estan disponibles	
	id_usuario= document.getElementById('id_usuario').value;
	usuario= document.getElementById('usuario2').value;
	password= document.getElementById('password').value;
	nombre= document.getElementById('nombre').value;
	correo= document.getElementById('correo').value;
	tipo= document.getElementById('tipo').value;



if(boton== 'guardar'){
	 proceso="guardar";
		ajax=objetoAjax();
		
	ajax.open("POST", "usuario_procesos.php",true);
	divResultado.innerHTML=  'Guardando...';
		
		//deshabilito el boton de guardar
		document.getElementById('guardar').disabled=true;

  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
     	 divResultado.innerHTML = ajax.responseText
		 
		 correo_nuevo_usuario(usuario, password, nombre, correo);

			 //limpiar campos	 
			 limpiarUsuario();

		//deshabilito el boton de guardar
		document.getElementById('guardar').disabled=false;

		//deshabilito el boton de guardar
		document.getElementById('modificar').disabled=true;

		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores
	  ajax.send("id_usuario="+id_usuario+"&usuario="+usuario+"&password="+password+"&nombre="+nombre+"&tipo="+tipo+"&proceso="+proceso+"&correo="+correo)	
		
		
		
	} else if(boton== 'modificar'){
		 proceso="actualizar";
		
			//deshabilito el boton de guardar
	document.getElementById('modificar').disabled=false;
		
			ajax=objetoAjax();
		
	ajax.open("POST", "usuario_procesos.php",true);
	divResultado.innerHTML=  'Guardando...';
	  	
			//deshabilito el boton de guardar
		document.getElementById('modificar').disabled=true;
		
		
  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  
	  //mostrar resultados en esta capa
     	 divResultado.innerHTML = ajax.responseText
				 
			 //limpiar campos	 
			 limpiarUsuario();
			 //deshabilito el boton de guardar
		document.getElementById('guardar').disabled=false;
		
		
		 }
    }

	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores
	  ajax.send("id_usuario="+id_usuario+"&usuario="+usuario+"&password="+password+"&nombre="+nombre+"&tipo="+tipo+"&proceso="+proceso+"&correo="+correo)	
		
		
	}
		
	
	}
	
	
	
function limpiarUsuario(){
	
		document.getElementById('usuario2').value="";
		document.getElementById('password').value="";
		document.getElementById('nombre').value="";
		document.getElementById('correo').value="";
		document.getElementById('tipo').value="Seleccionar...";		
		
				//habilito el boton de guardar
		document.getElementById('guardar').disabled=false;
			//deshabilito el boton de modificar
		document.getElementById('modificar').disabled=true;
	
	}	

function radiobutton(ctrl){
	for(i=0; i<ctrl.length; i++)
		if(ctrl[i].checked) return ctrl[i].value;
	
	}


//GUARDAR Y MODIFICAR EMPRESAS
function guardar_empleado(boton){
			
			
		//Valido los campos obligatorios
		if (document.getElementById('nombre').value.length==0){ 
			   alert("Debe escribir el nombre del empleado") 
			   document.frmEmpleados.nombre.focus() 
			   return false; 
			} 
		if (document.getElementById('ap_paterno').value.length==0){ 
			   alert("Debe escribir el apellido paterno") 
			   document.frmEmpleados.ap_paterno.focus() 
			   return false; 
			} 
		if (document.getElementById('ap_materno').value.length==0){ 
			   alert("Debe escribir el apellido materno") 
			   document.frmEmpleados.ap_materno.focus() 
			   return false; 
			} 	
			
		if (document.getElementById('curp_empleado').value.length==0){ 
			   alert("Tiene que escribir la CURP del empleado") 
			   document.frmEmpleados.curp_empleado.focus()
			   return false; 
			} 

		if (document.getElementById('infonavit').value.length==0){ 
			   alert("Debe indicar un monto de infonavit") 
			   document.frmEmpleados.infonavit.focus()
			   return false; 
			} 


	if (radiobutton(document.getElementsByName('cuenta_imss'))==""){ 
			   alert("Seleccione si el empleado cuenta con imss") 
			   return false; 
			} 

			
	divResultado= document.getElementById('empleados');
	
	//Se obtienen los datos del formulario y se validan si estan disponibles	

	id_empleado= 		document.getElementById('id_empleado').value;
	id_empresa= 		document.getElementById('id_empresa').value;
	curp_empleado= 		document.getElementById('curp_empleado').value;
	no_seg_social= 		document.getElementById('no_seg_social').value;
	ap_paterno= 		document.getElementById('ap_paterno').value;
	ap_materno= 		document.getElementById('ap_materno').value;
	nombre= 			document.getElementById('nombre').value;
	cuenta_imss= 		radiobutton(document.getElementsByName('cuenta_imss'));	
	domicilio= 			document.getElementById('domicilio').value;
	sueldo_diario_imss= document.getElementById('sueldo_diario_imss').value;
	sueldo_diario= document.getElementById('sueldo_diario').value;
	estado=             document.getElementById('estado').value;
	infonav=             document.getElementById('infonavit').value;
	no_tarjeta=             document.getElementById('no_tarjeta').value;
	observaciones= 		document.getElementById('observaciones').value;
	periodo_nomina= 		radiobutton(document.getElementsByName('periodo'));	
	//fecha_alta_imss_= 	document.getElementById('anio_alta').value +"/"+ document.getElementById('mes_alta').value +"/"+ document.getElementById('dia_alta').value;
	//fecha_nacimiento_= 	document.getElementById('anio_nac').value +"/"+ document.getElementById('mes_nac').value +"/"+ document.getElementById('dia_nac').value ;
		///////////////Fecha_NACIMIENTO////////////////////////////////////
		var fecha_nacim = 	document.getElementById('fecha_nac').value;
		var elem = fecha_nacim.split('/');
		dia1 = elem[0];
		mes1 = elem[1];
		anio1 = elem[2];
		fecha_nacimiento_= anio1 + "/"+ mes1 + "/" + dia1 ;
		///////////////Fecha_IMSS////////////////////////////////////
		fecha_imsss = 	document.getElementById('fecha_imss').value ;
		var elem2 = fecha_imsss.split('/');
		dia2 = elem2[0];
		mes2 = elem2[1];
		anio2 = elem2[2];
		fecha_alta_imss_= anio2 + "/"+ mes2 + "/" + dia2 ;
	
	

if(boton== 'guardar'){
	 proceso="guardar";
		ajax=objetoAjax();
		
	ajax.open("POST", "empleado_procesos.php",true);
	divResultado.innerHTML=  'Guardando...';
		
		//deshabilito el boton de guardar
		document.getElementById('guardar').disabled=true;

  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
     	 divResultado.innerHTML = ajax.responseText

			 //limpiar campos	 
			 limpiarEmpleado();

		//deshabilito el boton de guardar
		document.getElementById('guardar').disabled=false;

		//deshabilito el boton de guardar
		document.getElementById('modificar').disabled=true;
		cargarPagina2('empleados.php','mainContent',id_empresa);	

		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores
	  
  
	  ajax.send("id_empresa="+id_empresa+"&curp_empleado="+curp_empleado+"&no_seg_social="+no_seg_social+"&ap_paterno="+ap_paterno+"&ap_materno="+ap_materno+"&nombre="+nombre+"&cuenta_imss="+cuenta_imss+"&fecha_alta_imss="+fecha_alta_imss_+"&domicilio="+domicilio+"&fecha_nacimiento="+fecha_nacimiento_+"&sueldo_diario_imss="+sueldo_diario_imss+"&estado="+estado+"&observaciones="+observaciones+"&proceso="+proceso+"&periodo_nomina="+periodo_nomina+"&sueldo_diario="+sueldo_diario+"&no_tarjeta="+no_tarjeta+"&infonavit="+infonav)	
		
		
		
	} else if(boton== 'modificar'){
		
		 proceso="actualizar";
		//estado=document.getElementById('estadoBusq').value;
		
			//deshabilito el boton de guardar
	document.getElementById('modificar').disabled=false;
		
			ajax=objetoAjax();
		
	ajax.open("POST", "empleado_procesos.php",true);
	divResultado.innerHTML=  'Guardando...';
	  	
			//deshabilito el boton de guardar
		document.getElementById('modificar').disabled=true;
		
		
  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  
	  //mostrar resultados en esta capa
     	 divResultado.innerHTML = ajax.responseText
				 
			 //limpiar campos	 
			 limpiarEmpleado();
			 //deshabilito el boton de guardar
		document.getElementById('guardar').disabled=false;
		
		
		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores
	  ajax.send("id_empresa="+id_empresa+"&id_empleado="+id_empleado+"&curp_empleado="+curp_empleado+"&no_seg_social="+no_seg_social+"&ap_paterno="+ap_paterno+"&ap_materno="+ap_materno+"&nombre="+nombre+"&cuenta_imss="+cuenta_imss+"&fecha_alta_imss="+fecha_alta_imss_+"&domicilio="+domicilio+"&fecha_nacimiento="+fecha_nacimiento_+"&sueldo_diario_imss="+sueldo_diario_imss+"&estado="+estado+"&observaciones="+observaciones+"&proceso="+proceso+"&periodo_nomina="+periodo_nomina+"&sueldo_diario="+sueldo_diario+"&no_tarjeta="+no_tarjeta+"&infonavit="+infonav)	
		
	//cargarPagina2('empleados.php','mainContent',id_empresa,estado);	
	cargarPagina2('empleados.php','mainContent',id_empresa);	
	}
		
	
	}
	
	
//GUARDAR Y MODIFICAR EMPRESAS
function guardar_empleado_modif(boton){
			
			
		//Valido los campos obligatorios
		if (document.getElementById('nombre').value.length==0){ 
			   alert("Debe escribir el nombre del empleado") 
			   document.frmEmpleados.nombre.focus() 
			   return false; 
			} 
		if (document.getElementById('ap_paterno').value.length==0){ 
			   alert("Debe escribir el apellido paterno") 
			   document.frmEmpleados.ap_paterno.focus() 
			   return false; 
			} 
		if (document.getElementById('ap_materno').value.length==0){ 
			   alert("Debe escribir el apellido materno") 
			   document.frmEmpleados.ap_materno.focus() 
			   return false; 
			} 	
			
		if (document.getElementById('curp_empleado').value.length==0){ 
			   alert("Tiene que escribir la CURP del empleado") 
			   document.frmEmpleados.curp_empleado.focus()
			   return false; 
			} 

		if (document.getElementById('infonavit').value.length==0){ 
			   alert("Debe indicar un monto de infonavit") 
			   document.frmEmpleados.infonavit.focus()
			   return false; 
			} 


	if (radiobutton(document.getElementsByName('cuenta_imss'))==""){ 
			   alert("Seleccione si el empleado cuenta con imss") 
			   return false; 
			} 

			
	divResultado= document.getElementById('mainContent');
	
	//Se obtienen los datos del formulario y se validan si estan disponibles	

	id_empleado= 		document.getElementById('id_empleado').value;
	id_empresa= 		document.getElementById('id_empresa').value;
	curp_empleado= 		document.getElementById('curp_empleado').value;
	no_seg_social= 		document.getElementById('no_seg_social').value;
	ap_paterno= 		document.getElementById('ap_paterno').value;
	ap_materno= 		document.getElementById('ap_materno').value;
	nombre= 			document.getElementById('nombre').value;
	cuenta_imss= 		radiobutton(document.getElementsByName('cuenta_imss'));	
	domicilio= 			document.getElementById('domicilio').value;
	sueldo_diario_imss= document.getElementById('sueldo_diario_imss').value;
	sueldo_diario= document.getElementById('sueldo_diario').value;
	estado=             document.getElementById('estado').value;
	infonav=             document.getElementById('infonavit').value;
	no_tarjeta=             document.getElementById('no_tarjeta').value;
	observaciones= 		document.getElementById('observaciones').value;
	periodo_nomina= 		radiobutton(document.getElementsByName('periodo'));	
	
		///////////////Fecha_NACIMIENTO////////////////////////////////////
		var fecha_nacim = 	document.getElementById('fecha_nac').value;
		var elem = fecha_nacim.split('/');
		dia1 = elem[0];
		mes1 = elem[1];
		anio1 = elem[2];
		fecha_nacimiento_= anio1 + "/"+ mes1 + "/" + dia1 ;
		///////////////Fecha_IMSS////////////////////////////////////
		fecha_imsss = 	document.getElementById('fecha_imss').value ;
		var elem2 = fecha_imsss.split('/');
		dia2 = elem2[0];
		mes2 = elem2[1];
		anio2 = elem2[2];
		fecha_alta_imss_= anio2 + "/"+ mes2 + "/" + dia2 ;

		 proceso="act";
		
			ajax=objetoAjax();
		
	ajax.open("POST", "empleado_procesos.php",true);
	divResultado.innerHTML=  'Guardando...';
		
	
  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  
	  //mostrar resultados en esta capa
     	 divResultado.innerHTML = ajax.responseText
		 cargarPagina('empleados_empresas_consulta.php','mainContent');

		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores
	  ajax.send("id_empresa="+id_empresa+"&id_empleado="+id_empleado+"&curp_empleado="+curp_empleado+"&no_seg_social="+no_seg_social+"&ap_paterno="+ap_paterno+"&ap_materno="+ap_materno+"&nombre="+nombre+"&cuenta_imss="+cuenta_imss+"&fecha_alta_imss="+fecha_alta_imss_+"&domicilio="+domicilio+"&fecha_nacimiento="+fecha_nacimiento_+"&sueldo_diario_imss="+sueldo_diario_imss+"&estado="+estado+"&observaciones="+observaciones+"&proceso="+proceso+"&periodo_nomina="+periodo_nomina+"&sueldo_diario="+sueldo_diario+"&no_tarjeta="+no_tarjeta+"&infonavit="+infonav)	
		
	}
	
function limpiarEmpleado(){

		document.getElementById('curp_empleado').value="";
		document.getElementById('no_seg_social').value="";
		document.getElementById('ap_paterno').value="";
		document.getElementById('ap_materno').value="";
		document.getElementById('nombre').value="";
		document.getElementById('no_tarjeta').value="";
		document.getElementById('cuenta_imss_0').checked=false;
		document.getElementById('cuenta_imss_1').checked=false;
		document.getElementById('semanal').checked=false;
		document.getElementById('quincenal').checked=false;
		document.getElementById('catorcenal').checked=false;
		document.getElementById('mensual').checked=false;
		document.getElementById('infonavit').value="";

		/*document.getElementById('anio_nac').value="";
		document.getElementById('mes_nac').value= "";
		document.getElementById('dia_nac').value= "";*/
		document.getElementById('fecha_nac').value= "";
		document.getElementById('domicilio').value="";
		/* document.getElementById('anio_alta').value="";
		document.getElementById('mes_alta').value= "";
		document.getElementById('dia_alta').value= ""; */
		document.getElementById('fecha_imss').value= "";
		document.getElementById('sueldo_diario_imss').value="";
		document.getElementById('sueldo_diario').value="";
		document.getElementById('observaciones').value="";	
		document.getElementById('estado').value="ACTIVO";	

		//habilito el boton de guardar
		document.getElementById('guardar').disabled=false;
			//deshabilito el boton de modificar
		document.getElementById('modificar').disabled=true;
	
	}	
	
	
	
	//ESTA FUNCION SE USA CUANDO UN CLIENTE QUIERE DAR DE ALTA AL EMPLEADO
function alta_empleado(){
			
			
		//Valido los campos obligatorios
		if (document.getElementById('nombre').value.length==0){ 
			   alert("Debe escribir el nombre del empleado") 
			   document.frmEmpleados.nombre.focus() 
			   return false; 
			} 
		if (document.getElementById('ap_paterno').value.length==0){ 
			   alert("Debe escribir el apellido paterno") 
			   document.frmEmpleados.ap_paterno.focus() 
			   return false; 
			} 
		if (document.getElementById('ap_materno').value.length==0){ 
			   alert("Debe escribir el apellido materno") 
			   document.frmEmpleados.ap_materno.focus() 
			   return false; 
			} 	
			
		if (document.getElementById('curp_empleado').value.length==0){ 
			   alert("Tiene que escribir la CURP del empleado") 
			   document.frmEmpleados.curp_empleado.focus()
			   return false; 
			} 

	if (radiobutton(document.getElementsByName('cuenta_imss'))==""){ 
			   alert("Seleccione si el empleado cuenta con imss") 
			   return false; 
			} 

if (radiobutton(document.getElementsByName('periodo'))==""){ 
			   alert("Seleccione el periodo de pago de nomina del empleado") 
			   return false; 
			} 
			
	divResultado= document.getElementById('empleados');
	
	//Se obtienen los datos del formulario y se validan si estan disponibles	


	id_empresa= 		document.getElementById('id_empresa').value;
	curp_empleado= 		document.getElementById('curp_empleado').value;
	no_seg_social= 		document.getElementById('no_seg_social').value;
	ap_paterno= 		document.getElementById('ap_paterno').value;
	ap_materno= 		document.getElementById('ap_materno').value;
	nombre= 			document.getElementById('nombre').value;
	cuenta_imss= 		radiobutton(document.getElementsByName('cuenta_imss'));	
	periodo_nomina= 		radiobutton(document.getElementsByName('periodo'));	
	//fecha_alta_imss= 	document.getElementById('anio_alta').value +"/"+ document.getElementById('mes_alta').value +"/"+ document.getElementById('dia_alta').value;
	domicilio= 			document.getElementById('domicilio').value;
	//fecha_nacimiento= 	document.getElementById('anio_nac').value +"/"+ document.getElementById('mes_nac').value +"/"+ document.getElementById('dia_nac').value ;
	
	sueldo_diario_imss= document.getElementById('sueldo_diario_imss').value;
	estado= 			document.getElementById('estado').value;;
	observaciones= 		document.getElementById('observaciones').value;
	sueldo_diario= document.getElementById('sueldo_diario').value;
		///////////////Fecha_NACIMIENTO////////////////////////////////////
		var fecha_nacim = 	document.getElementById('fecha_nac').value;
		var elem = fecha_nacim.split('/');
		dia1 = elem[0];
		mes1 = elem[1];
		anio1 = elem[2];
		fecha_nacimiento= anio1 + "/"+ mes1 + "/" + dia1 ;
		///////////////Fecha_IMSS////////////////////////////////////
		fecha_imsss = 	document.getElementById('fecha_imss').value ;
		var elem2 = fecha_imsss.split('/');
		dia2 = elem2[0];
		mes2 = elem2[1];
		anio2 = elem2[2];
		fecha_alta_imss= anio2 + "/"+ mes2 + "/" + dia2 ;


		ajax=objetoAjax();
		
	ajax.open("POST", "empleado_alta.php",true);
	divResultado.innerHTML=  'Guardando...';
		
		//deshabilito el boton de guardar
		document.getElementById('guardar').disabled=true;

  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
//     	 divResultado.innerHTML = ajax.responseText
		 
		 //alert(" " + ajax.responseText)
		
		cargarPagina('empleados.php','mainContent');
		 

			 //limpiar campos	 
			 limpiarEmpleado_cliente();

		//deshabilito el boton de guardar
		document.getElementById('guardar').disabled=false;

		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores
	  
  
	  ajax.send("id_empresa="+id_empresa+"&curp_empleado="+curp_empleado+"&no_seg_social="+no_seg_social+"&ap_paterno="+ap_paterno+"&ap_materno="+ap_materno+"&nombre="+nombre+"&cuenta_imss="+cuenta_imss+"&fecha_alta_imss="+fecha_alta_imss+"&domicilio="+domicilio+"&fecha_nacimiento="+fecha_nacimiento+"&sueldo_diario_imss="+sueldo_diario_imss+"&estado="+estado+"&observaciones="+observaciones+"&periodo_nomina="+periodo_nomina+"&sueldo_diario="+sueldo_diario)	
	
	
	}
	
	
	
function limpiarEmpleado_cliente(){

		document.getElementById('curp_empleado').value="";
		document.getElementById('no_seg_social').value="";
		document.getElementById('ap_paterno').value="";
		document.getElementById('ap_materno').value="";
		document.getElementById('nombre').value="";
		document.getElementById('cuenta_imss_0').checked=false;
		document.getElementById('cuenta_imss_1').checked=false;
		document.getElementById('semanal').checked=false;
		document.getElementById('quincenal').checked=false;
		document.getElementById('catorcenal').checked=false;
		document.getElementById('mensual').checked=false;

		document.getElementById('fecha_nac').value="";
		document.getElementById('domicilio').value="";
		document.getElementById('fecha_imss').value="";
		document.getElementById('sueldo_diario_imss').value="";
		document.getElementById('sueldo_diario').value="";
		document.getElementById('observaciones').value="";	

		//habilito el boton de guardar
		document.getElementById('guardar').disabled=false;

	
	}	
	
	


function asignar_clientes(id_usuario, usuario){
			
			
	divResultado= document.getElementById('mainContent');
	
		ajax=objetoAjax();
		
	ajax.open("POST", "usuario_empresas.php",true);
	divResultado.innerHTML=  'Obteniendo Listado de Empresas...';
		


  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
     	 divResultado.innerHTML = ajax.responseText


		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("id_usuario="+id_usuario+"&usuario="+usuario)	
	
	
	}



function usuario_clientes(id_usuario, usuario){
			

	divResultado= document.getElementById('mensaje');
	empresas=	  document.getElementsByName('asignar[]');
	
	  CamposRellenos = 0;
	
		ajax=objetoAjax();
		
	
	for (var i=0; i < empresas.length; i++){
               if (empresas[i].checked){
				   CamposRellenos = 1; 
	
					id_empresa= empresas[i].value;
		
	ajax.open("POST", "usuario_empresas_guardar.php", false);
				
		


  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
     	 //divResultado.innerHTML = ajax.responseText
		 divResultado.innerHTML=  'GUARDANDO CAMBIOS...';		 
			

		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("id_usuario="+id_usuario+"&id_empresa="+id_empresa)	
		
		}//cierro if
	}//cierro for
	
	if (CamposRellenos==1){
			
			alert("Los cambios han sido guardados")
			asignar_clientes(id_usuario, usuario);
			
				return true;  

		}else {
                alert("Debe de seleccionar un cliente.")  
              return false;  
        }	
	

	
	
	} //fin de la funcion usuario_clientes




function agregar_empleado_nomina(){
	

	
	divResultado= document.getElementById('nominas_empresa_empleados');
	id_emple= document.getElementById('id_empleado_nuevo').value;
	id_empre= document.getElementById('id_empresaa').value;
	id_nom=  document.getElementById('id_nomina').value;
	//alert(id_emple + id_empre + id_nom );
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
				  "id_nomina":id_nom,				  
				  "id_empresa":id_empre
				  }

	ajax=objetoAjax();
		
	ajax.open("POST", "nominas_agregar_empleado.php",true);
	divResultado.innerHTML=  'Agregando...';

  ajax.onreadystatechange=function() {
	if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
     	//alert(" "+ ajax.responseText);
		 //cargar_nomina(id_nom, id_empre);
		  operaciones2.inicializador(parametros_basicos,parametros_especificos,operaciones,'POST');
		 

		 }
    }

	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores	  
  
	  ajax.send("id_empleado="+id_emple+"&id_empresa="+id_empre+"&id_nomina="+id_nom)	
	

	}  //fin de la funcion
	
	function respaldarBD(){	
		
		if (confirm('Realmente desea hacer un respaldo de la Base de Datos')) {
		divResultado= document.getElementById('mainContent');
		respaldo= 'senal';
		ajax=objetoAjax();
			
			ajax.open("POST", "respaldoBD.php",true);
			divResultado.innerHTML=  'Respaldando...';

		  ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {		
			//divResultado.innerHTML = ajax.responseText
			//alert(""+ajax.responseText);
			nombreArchivo=ajax.responseText;
			respaldarBDRutaUsuario(nombreArchivo);
			alert("La base de datos ha sido respaldada");
			}
		}
		  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		  //enviando los valores
		  ajax.send("Respaldo="+respaldo)		
		}
	} //FIN DE LA FUNCION
	function respaldarBDRutaUsuario(nombreArchivo){	
		/* divResultado= document.getElementById('mainContent');
		ajax=objetoAjax();
			
			ajax.open("POST", "respaldoBDRutaUsuario.php",true);
			divResultado.innerHTML=  'Respaldando en su directorio...';

		  ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {		
			//divResultado.innerHTML = ajax.responseText
			//alert(""+ajax.responseText);
			nombreArchivo=ajax.responseText;
			alert(nombreArchivo);
			//alert("La base de datos ha sido respaldada en su directorio");
			cargarPagina('nominas.php','mainContent');
			}
		}
		  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		  //enviando los valores
		  ajax.send("nombreArchivo="+nombreArchivo)	 */	
		  window.location.href = "respaldoBDRutaUsuario.php?nombreArchivo="+nombreArchivo;
	
	} //FIN DE LA FUNCION
	function reporte(numero){
			if(numero=='1'){
			cargarPagina('reportes.php','mainContent');
			} 
			else{
			cargarPagina('reportes2.php','mainContent');
			} 
	} //FIN DE LA FUNCION
	
	function buscarNominas(){	
		id_empresa= document.getElementById('id_empresa').value;
		dia_inicio= document.getElementById('dia_inicio').value;
		dia_final= document.getElementById('dia_final').value;
		
		var elem = dia_inicio.split('/');
		dia1 = elem[0];
		mes1 = elem[1];
		anio1 = elem[2];
		dia_inicio= anio1 + "-"+ mes1 + "-" + dia1 ;
		
		var elem2 = dia_final.split('/');
		dia2 = elem2[0];
		mes2 = elem2[1];
		anio2 = elem2[2];
		dia_final= anio2 + "-"+ mes2 + "-" + dia2 ;
		var Sueldo;
		var Horas_extras;
		var Domingos_trabajados;
		var Turnos_trabajados;
		var Descansos_Trabajados;
		var Dias_Festivo;
		var Vacaciones;
		var Complemento_Sueldo;
		var Otras_Percep;
		
		var Prestamos;
		var Caja_Ahorro;
		var Fonacot;
		var Infonavit;
		var Otras_deducciones;
		var Prestamo_navitas; 
		
		if (document.getElementById('Sueldo').value) {
			Sueldo='Si';
		} 
		if (document.getElementById('Horas_extras').value) {
			Horas_extras='Si';
		} 
		if (document.getElementById('Domingos_trabajados').value) {
			Domingos_trabajados='Si';
		} 
		if (document.getElementById('Turnos_trabajados').value) {
			Turnos_trabajados='Si';
		} 
		if (document.getElementById('Descansos_Trabajados').value) {
			Descansos_Trabajados='Si';
		} 
		if (document.getElementById('Dias_Festivo').value) {
			Dias_Festivo='Si';
		} 
		if (document.getElementById('Vacaciones').value) {
			Vacaciones='Si';
		} 
		if (document.getElementById('Complet_Sueldo').value) {
			Complemento_Sueldo='Si';
		} 
		if (document.getElementById('Otras_Percep').value) {
			Otras_Percep='Si';
		} 
		if (document.getElementById('Prestamos').value) {
			Prestamos='Si';
		} 
		if (document.getElementById('Caja_Ahorro').value) {
			Caja_Ahorro='Si';
		}
		if (document.getElementById('Fonacot').value) {
			Fonacot='Si';
		}
		if (document.getElementById('Infonavit').value) {
			Infonavit='Si';
		}
		if (document.getElementById('Otras_deducciones').value) {
			Otras_deducciones='Si';
		}
		if (document.getElementById('Prestamo_navitas').value) {
			Prestamo_navitas='Si';
		}

		divResultado= document.getElementById('reporte');
		ajax=objetoAjax();
			
		ajax.open("POST", "reporte_nomina_consulta2.php",true);

		  ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {		
			divResultado.innerHTML = ajax.responseText
			totales1();
			totales2();
			}
		}
		  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		  //enviando los valores
		  ajax.send("Sueldo="+Sueldo+"&id_empresa="+id_empresa+"&dia_inicio="+dia_inicio+"&dia_final="+dia_final+"&Horas_extras="+Horas_extras+"&Domingos_trabajados="+Domingos_trabajados+"&Turnos_trabajados="+Turnos_trabajados+"&Descansos_Trabajados="+Descansos_Trabajados+"&Dias_Festivo="+Dias_Festivo+"&Vacaciones="+Vacaciones+"&Complemento_Sueldo="+Complemento_Sueldo+"&Otras_Percep="+Otras_Percep+"&Prestamos="+Prestamos+"&Caja_Ahorro="+Caja_Ahorro+"&Fonacot="+Fonacot+"&Infonavit="+Infonavit+"&Otras_deducciones="+Otras_deducciones+"&Prestamo_navitas="+Prestamo_navitas)		
		
	} //FIN DE LA FUNCION
	function totales1(){
		var table = document.getElementById('box-table-a');
        var filas = table.rows.length;
		columnas = table.rows[0].cells.length;
		filas=filas - 1;
		a=1;
		for(a;a<columnas;a++){
			i=1;
			for(i;i<filas;i++){
						//Se obtienen los datos
						id_insum=table.rows[i].cells[a].innerHTML;
						id_insum= parseFloat(id_insum);
							if (i==1) {
							id_insum2=id_insum;
							} 
							else{
							id_insum2 += id_insum;
							} 
					}	
				table.rows[filas].cells[a].innerHTML=id_insum2;		
		}
		//alert(columnas);	
	} //FIN DE LA FUNCION
	
	function totales2(){
		var table = document.getElementById('box-table-c');
        var filas = table.rows.length;
		columnas = table.rows[0].cells.length;
		filas=filas - 1;
		a=1;
		for(a;a<columnas;a++){
			i=1;
			for(i;i<filas;i++){
						//Se obtienen los datos
						id_insum=table.rows[i].cells[a].innerHTML;
						id_insum= parseFloat(id_insum);
							if (i==1) {
							id_insum2=id_insum;
							} 
							else{
							id_insum2 += id_insum;
							} 
					}	
				table.rows[filas].cells[a].innerHTML=id_insum2;		
		}
		//alert(columnas);	
	} //FIN DE LA FUNCION
	
	function seleccionar_todo(){ 
	for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=1  
	} 
	function deseleccionar_todo(){ 
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=0 
	}
	
	function regresar(){	
	divResultado= document.getElementById('mainContent');
	id_empre= document.getElementById('id_empresa').value;
		ajax=objetoAjax();
			
			ajax.open("POST", "nominas.php",true);

		  ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {		
			divResultado.innerHTML = ajax.responseText
			}
		}
		  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		  //enviando los valores
		  ajax.send("id_empresa="+id_empre)
	}
