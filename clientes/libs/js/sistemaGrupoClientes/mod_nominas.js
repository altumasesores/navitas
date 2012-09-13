function calendarioNaranja(fecha) {
				var f = '#' + fecha;
				
			 $(function() {
				$(f).datepicker({
					showOn: 'both', //Parametro para que se vea el icono del calendario
					buttonImageOnly: true, //Indicamos si queremos que solo se vea el icono y no el botón
					buttonImage: 'calendar.gif', //Indicamos el icono del botón
					firstDay: 1, //El primer día será el 1
					changeMonth: true, //Si se pueden cambiar los meses
					changeYear: true //Si se pueden cambiar los años
				});
			}); 
	}		