function crear( id ) {
 
	form = document.getElementById( 'formFTP' );
 
	file = document.getElementById( id );
 
	span = document.getElementById( 'mensaje');
 
}
 
function cargar( obj ) {
 
	crear( obj.id );
 
	mostrar( obj.id , 'WAIT' );
 
	form.submit();
 
	file.style.display = 'none';
 
}
 
function mostrar( id , str ) {
 
	crear( id );
 
	switch ( str ) {
 
		case 'WAIT' :
 
			mensaje = 'Cargando archivo...';
 
		break;
 
		default :
 
			mensaje = 'Archivo cargado Exitosamente.';
 
	}
 
	span.innerHTML = mensaje;
 
}







function enviar_documento(){
	alert('enviando');
	if (document.getElementById('descripcion').value.length==0){ 
			   alert("Debe escribir la descripcion del documento") 
			   document.frmFTP.descripcion.focus() 
			   return false; 
			} 
		if (document.getElementById('archivo').value.length==0){ 
			   alert("Debe buscar un Archivo") 
			   document.frmFTP.archivo.focus() 
			   return false; 
			} 
	
	archivo= document.getElementById('archivo').value;
	descripcion= document.getElementById('descripcion').value;
	
	
   //donde se mostrar el resultado de la eliminacion
   divResultado = document.getElementById('publicaciones');   

	   //instanciamos el objetoAjax
	   ajax=objetoAjax();

	   ajax.open("POST", "publicaciones_enviar.php", true);
	   ajax.onreadystatechange=function() {
		   if (ajax.readyState==4) {
		   //mostrar resultados en esta capa
//		   ivResultado.innerHTML= '<img src="anim.gif">';  PARA USAR UN GIF CARGADOR
		   divResultado.innerHTML = "Enviando..."
		   divResultado.innerHTML = ajax.responseText
		  // correo_nueva_publicacion(archivo,descripcion);
		   }
   }

     ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 ajax.send('archivo='+archivo+'&descripcion='+descripcion)

}
