function calcular_isr(salario,periodo)
{
	modulo="calculos";
	controlador="Calculos";
	accion="CalcularCalculos";
	
	parametros="modulo="+modulo+"&controlador="+controlador+"&accion="+accion+"&salario="+salario+"&periodo="+periodo;
		jQuery.ajax({
			"url": "AnteFrontController.php",
			"type": "get",
			"data": parametros,
			"success": function(response)
			{
				alert(response)
				//$("#"+capa).html(response);
				}
			});

	}
	
	function calcular_neto_pagar(id_empleado,id_nomina)
{
	modulo="calculos";
	controlador="Calculos";
	accion="calcular_neto_pagar";
	
	parametros="modulo="+modulo+"&controlador="+controlador+"&accion="+accion+"&id_empleado="+id_empleado+"&id_nomina="+id_nomina;
		jQuery.ajax({
			"url": "AnteFrontController.php",
			"type": "get",
			"data": parametros,
			"success": function(response)
			{
				alert(response)
				//$("#"+capa).html(response);
				}
			});

	}
	
	function calcular_(idNomina)
	{
		//alert(idNomina + tipoNomina)
		modulo="calculos";
		controlador="Calculos";
		accion="calcular";
	
		parametros="modulo="+modulo+"&controlador="+controlador+"&accion="+accion+"&idNomina="+idNomina;
		jQuery.ajax({
			"url": "AnteFrontController.php",
			"type": "get",
			"data": parametros,
			"success": function(response)
			{
				alert('CALCULAR  '+response)
				//$("#"+capa).html(response);
				}
			});

	}
	function consultarNominaFiscal(IdEmpresa,idNomina,idTipoNomina)
	{
		//alert(IdEmpresa+idNomina+idTipoNomina)
		modulo="calculos";
		controlador="Calculos";
		accion="NominaFiscal";
	
		parametros="modulo="+modulo+"&controlador="+controlador+"&accion="+accion+"&idNomina="+idNomina+"&idEmpresa="+IdEmpresa+"&TipoNomina="+idTipoNomina;
		jQuery.ajax({
			"url": "AnteFrontController.php",
			"type": "get",
			"data": parametros,
			"success": function(response)
			{
				//alert('Nomina Fiscal  '+response)
				$("#nominas_empresa_empleados").html(response);
				}
			}); 

	}
	
	
	