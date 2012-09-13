
function facturar(id_nomina, id_empresa){
					
	divResultado= document.getElementById('mainContent');

		ajax=objetoAjax();
		
	ajax.open("POST", "facturacion.php",true);
	
    	 divResultado.innerHTML = "Facturando...";
		 
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {		

	  //mostrar resultados en esta capa
    	 divResultado.innerHTML = ajax.responseText
		 }
    }


	  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  //enviando los valores
	  ajax.send("id_nomina="+id_nomina+"&id_empresa="+id_empresa)		
		
	
} //FIN DE LA FUNCION
