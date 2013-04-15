<?php 


//Creamos el encabezado de la tabla a paginar

	$encabezado=array(

		 "Empresa"=>"",
		 
		 "Estado"=>"",
	    
	     "Empleado"=>"",

	      "sueldo Diario"=>"",

	      "Dias Trab."=>"",

	      "Sueldo"=>"",

	      "Domingos T."=>"",
	      
	      "Sub. domingos"=>"",

	      "Prim. Dominical"=>"",

	      "Vacaciones T."=>"",

	      "Sub. Vacaciones"=>"",

	      "Prim. Vacacional"=>"",

	      "Turnos Trab."=>"",

	      "Total Turnos"=>"",

	      "Descansos Trab."=>"",

	      "Total Descansos"=>"",

	      "Horas Ex."=>"",

	      "Total H. E."=>"",

	      "Dias Festivos"=>"",

	      "Total D. F."=>"",

	      "Aguinaldo"=>"",

	      "Prem x Puntualidad"=>"",

	      "Prem x Asistencia"=>"",

	      "Despensa"=>"",

	      "Becas Educ."=>"",

	      "Subsidio al empleo"=>"",

	      "Prestamos"=>"",

	      "Caja Ahorro"=>"",

	      "Fonacot"=>"",

	      "Infonavit"=>"",

	      "ISR"=>"",

	      "IMSS"=>"",

	      "Otras Deducciones"=>"",

	      "Total Fiscal"=>""

		  );


	//instanciamos el paginador

	$paginador=new paginador($encabezado);

?>


<html>
<head>
	<title>reporte nominas fiscales</title>
</head>
<body>

<h1>Reporte General de Nominas Fiscales por Empleado</h1>





	<?php 
	//creamos la cabecera

	$paginador->cabeceraPaginador();
	$paginamos=false;


	while ($row_nominas = $listaNominasFiscales->fetch()){
		$paginamos=true;			
			$parametros=str_replace('"',"'",json_encode(array( "id_nomina"=>$row_nominas['id_empleado']) ));
 	?>

 	<tr>
        
		<td><?php echo $row_nominas['empresa']; ?></td>

		<td><?php echo $row_nominas['estado']; ?></td>
        
        <td ><?php echo $row_nominas['nombre'].' '.$row_nominas['ap_paterno'].' '. $row_nominas['ap_materno'] ; ?></td>

        <td><?php echo $row_nominas['sueldo_diario']; ?></td>

        <td><?php echo $row_nominas['total_dias_trabajados']; ?></td>

        <td align="right"><?php echo redondear($row_nominas['total_sueldo']) ; ?></td>

        <td align="right"><?php echo redondear($row_nominas['num_domingos_trabajados']); ?></td> 

        <td align="right"><?php echo redondear($row_nominas['sub_domingos']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['prima_dominical']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['num_vacaciones']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['sub_vacaciones']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['prima_vacacional']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['num_turnos_trabajados']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['total_turnos_trabajados']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['num_descansos_trabajados']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['total_descansos_trabajados']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['num_horas_extras']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['total_horas_extras']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['num_dias_festivos']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['total_dias_festivos']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['aguinaldo']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['premio_por_puntualidad']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['premio_por_asistencia']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['despensa']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['becas_educacionales']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['subsidio_empleo']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['prestamos']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['caja_ahorro']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['fonacot']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['infonavit']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['isr']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['imss']); ?></td> 

        <td align="right"><?php echo redondear($row_nominas['total_otras_deducciones']); ?></td>

        <td align="right"><?php echo redondear($row_nominas['sum_total_nomina_fiscal']); ?></td>
    </tr>




    <?php 
	
	}//fin del while

    	if($paginamos){

		//creacion del cierre o pie del paginador
		$paginador->piePaginador();

		}

     ?>


</body>
</html>