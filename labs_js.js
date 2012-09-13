function crear( id ) {
 
	form = document.getElementById( 'form_' + id );
 
	file = document.getElementById( id );
 
	span = document.getElementById( 'span_' + id );
 
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
 
			mensaje = 'Archivo cargado - <a href="controlador.php?caso=eliminar&amp;ruta=' + str + '&amp;id=' + id + '" target="iframe_' + id + '" >Eliminar</a>';
 
	}
 
	span.innerHTML = mensaje;
 
}
 
function eliminar( id ) {
 
	crear( id );
 
	span.style.display = 'none';
 
	file.value = '';
 
	file.style.display = 'block';
 
}