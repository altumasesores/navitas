function calendarioNaranja(fecha) {
				var f = '#' + fecha;
				
			 $(function() {
				$(f).datepicker({
					showOn: 'both', //Parametro para que se vea el icono del calendario
					buttonImageOnly: true, //Indicamos si queremos que solo se vea el icono y no el bot�n
					buttonImage: 'calendar.gif', //Indicamos el icono del bot�n
					firstDay: 1, //El primer d�a ser� el 1
					changeMonth: true, //Si se pueden cambiar los meses
					changeYear: true //Si se pueden cambiar los a�os
				});
			}); 
	}		