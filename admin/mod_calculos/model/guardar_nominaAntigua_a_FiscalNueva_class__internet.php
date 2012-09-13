<?php 

class NominaFiscal extends ModelCalculos

{

	public $id_empleado;

	public $id_nomina;

	public $id_empresa;

	

	public $sueldo_diario_imss;

	public $sueldo_integrado;

	public $sueldo_imss;

	public $dias_trabajados;

	public $dias_trabajados_imssisrsub;

	public $total_sueldo;

	

	

	public $cantidad_horas_extra;

	public $total_horas_extra;

	

	public $cantidad_domingos;

	public $prima_dominical;

	public $total_domingos;

	

	public $cantidad_turnos;

	public $total_turnos;

	

	public $cantidad_descanso;

	public $total_descanso;

	

	public $cantidad_festivos;

	public $total_festivos;

	

	public $cantidad_vacaciones;

	public $prima_vacacional;

	public $total_vacaciones;

	

	public $puntualidad;

	public $asistencia;

	public $despensa;

	public $becas_educacionales;

	

	public $aguinaldo;

	public $complemento_sueldo;//no se usa en nomina fiscal

	public $otras_percepciones;

	

	public $prestamos;

	public $caja_ahorro;

	public $fonacot;

	public $infonavit;

	public $descripcion_ot_deducciones="";

	public $otras_deducciones;

	public $prestamo_ascon;

	

	public $imss;

	public $isr;

	public $subsidio;

	

		

	

	

	public $total_percepciones_empleado;

	public $total_deducciones_empleado;

	

	public $total_neto_empleado;

	

	public $total_percepciones;

	public $total_deducciones;

	

	public $TOTAL;

	

	

	

	public $factor_imss=1.0452;

	public $factor_horas_extra=2;

	public $factor_prima_dominical=.25;

	public $factor_descanso=2;

	public $factor_festivos=2;

	public $factor_prima_vacacional=.25;

	public $factor_salario_df=.4;

	public $salario_df=59.82;

	

	

	public $tipo_nomina;

	public $tipo_nomina_fiscal="noFiscal";

	

	public $SalarioImss;

	public $TotalSueldoImss;

	public $SueldoparaIMSS;

	

	/************FIXED AGREGAR EMPLEADO NUEVO*************/

	public $query_fixed;

	

	

	/*************************/

		

	function no_construct($id_nomina,$id_empresa) {		

		$this->id_nomina=$id_nomina;

		$this->id_empresa=$id_empresa;		

		$this->verificar_existencia_fiscal();

		}

		

	function verificar_existencia_fiscal()

	{

		$query="

										SELECT *								

										FROM 

										nomina_fiscal							

										WHERE  id_nomina=$this->id_nomina										 

								";

	

		$consulta =$this->db->prepare($query);

		$consulta->execute();

		$numero_registros = $consulta->rowCount();

		

		if($numero_registros==0){		

			

			$this->consultar_nomina_natural();		

			

			}

			else{

				$this->fixed_agregar_empleado_recalculo_inicial();

				}

			

		

		}

		

	function fixed_agregar_empleado_recalculo_inicial(){

		$query="

		select 

		pemp.id_empleado

		from percepciones_empleado pemp

		inner join deducciones_empleado demp on pemp.id_empleado=demp.id_empleado and pemp.id_nomina=demp.id_nomina

		where pemp.id_nomina='$this->id_nomina'

		and pemp.id_empleado not in(select 

		nf.id_empleado

		from nomina_fiscal nf

		where nf.id_nomina='$this->id_nomina')";

		

		try{

		$consulta = $this->db->prepare($query);

		$consulta->execute();

		$numero_registros = $consulta->rowCount();

		

		if($numero_registros>0){		

			

			foreach($consulta as $Row){

			$this->id_empleado=$Row['id_empleado'];

			$this->fixed_agregar_empleado_nuevo($this->id_nomina,$this->id_empleado,$this->id_empresa);

			}

			

			}	

		

		

		

		

		

		} catch (PDOException $e) {

                   $Mensaje="Insercion Erronea:  </br></br>";					   			  

				   $Mensaje.="Error En la linea:_____".$e->getLine()."</br></br>";					   	  

				   $Mensaje.="Error capturado:_____".$e->getMessage()." </br></br> ";

				   $Mensaje.="Error capturado:_____".$e->getCode()." </br></br> ";

				   $Mensaje=str_replace("'","",$Mensaje);

				    echo "<script>jAlert(\"$Mensaje\")</script>";					

				 

				   }

		

		}	

		

	

	function fixed_agregar_empleado_nuevo($id_nomina,$id_empleado,$id_empresa){		

		$this->id_nomina=$id_nomina;

		$this->id_empleado=$id_empleado;

		$this->id_empresa=$id_empresa;	

		$this->query_fixed=" and percepciones_empleado.id_empleado='".$this->id_empleado."'";

		$this->consultar_nomina_natural();

		}

		

	

	function consultar_nomina_natural()

	{

		 $query="

										SELECT 

										percepciones_empleado.*, 

										deducciones_empleado.*,									

										empleados.sueldo_diario_imss

										

										FROM 

										percepciones_empleado

										 

										INNER JOIN deducciones_empleado 

										on  percepciones_empleado.id_empleado= deducciones_empleado.id_empleado	

															

										INNER JOIN empleados 

										on  percepciones_empleado.id_empleado= empleados.id_empleado								

										

										WHERE  percepciones_empleado.id_nomina= '$this->id_nomina' 

										AND percepciones_empleado.id_empresa= '$this->id_empresa' 

										AND  deducciones_empleado.id_nomina= '$this->id_nomina'

										

								".$this->query_fixed;

		try{

		$consulta = $this->db->prepare($query);

		$consulta->execute();	

		} catch (PDOException $e) {

                   $Mensaje="Insercion Erronea:  </br></br>";					   			  

				   $Mensaje.="Error En la linea:_____".$e->getLine()."</br></br>";					   	  

				   $Mensaje.="Error capturado:_____".$e->getMessage()." </br></br> ";

				   $Mensaje.="Error capturado:_____".$e->getCode()." </br></br> ";

				   $Mensaje=str_replace("'","",$Mensaje);

				    echo "<script>jAlert(\"$Mensaje\")</script>";					

				 

				   }

		

		$this->obtener_tipo_nomina();	

		

		foreach($consulta as $Row){

			$this->id_empleado=$Row['id_empleado'];

			$this->sueldo_diario_imss=$Row['sueldo_diario_imss'];

			$this->sueldo_integrado=$Row['sueldo_diario_imss'];

			$this->sueldo_imss=$Row['sueldo_diario_imss'];

			$this->dias_trabajados=$Row['dias_trabajados'];

			

			

			if($this->tipo_nomina=="semanal")

			{

				if($this->dias_trabajados>=8)

				{

					$this->dias_trabajados=$this->dias_trabajados/8;

					}

								

				}

			

			$this->cantidad_horas_extra=$Row['horas_extras'];			

			$this->cantidad_domingos=$Row['domingos_trabajados'];			

			$this->cantidad_turnos=$Row['turnos_trabajados'];			

			$this->cantidad_descanso=$Row['descanso_trabajado'];			

			$this->cantidad_festivos=$Row['dias_festivos'];			

			$this->cantidad_vacaciones=$Row['vacaciones'];	

			

			$this->aguinaldo=$Row['aguinaldo'];

			$this->complemento_sueldo=$Row['complemento_sueldo'];

			$this->otras_percepciones=$Row['otras_percepciones'];

			

			$this->prestamos=$Row['prestamos'];

			$this->caja_ahorro=$Row['caja_ahorro'];

			$this->fonacot=$Row['fonacot'];

			$this->infonavit=$Row['infonavit'];

			$this->otras_deducciones=$Row['otras_deducciones'];

			$this->prestamo_ascon=$Row['prestamo_ascon'];//no se usa en nomina fiscal

									

			$this->calcular_sueldo();

			$this->calcular_horas_extras();

			$this->calcular_domingos();

			$this->calcular_turno_trabajados();

			$this->calcular_descanso_trabajados();

			$this->calcular_dias_festivos();

			$this->calcular_vacaciones();

			$this->calcular_otras_percepciones();

			

			$this->obtener_dias_trabajados_imssisrsub();

			$this->calcular_datos_imssisrsub();

			

			$this->calcular_isr();

			$this->calcular_imss();

			$this->calcular_subsidio();

			

			$this->total_percepciones_empleado();

			$this->total_deducciones_empleado();

			$this->TOTAL_NETO();			

			$this->ajuste_decimales();

			$this->guardar_nominaAntigua_fiscalNueva();

			$this->recalculo_neto();
			
			

			

			

			

			

			

			

			

			

			

				

			}

			

			

			

			

				

		

					

		}

		

	function calcular_sueldo()

	{ 

	    $this->sueldo_diario_imss=$this->sueldo_diario_imss/$this->factor_imss;

		$this->sueldo_integrado=$this->sueldo_integrado*$this->dias_trabajados;

		$this->total_sueldo=$this->sueldo_diario_imss*$this->dias_trabajados;

		}	

		

	function calcular_horas_extras()

	{

		$this->total_horas_extra=($this->cantidad_horas_extra*$this->sueldo_diario_imss/8)*$this->factor_horas_extra;

		}

		

	function calcular_domingos()

	{		

		$this->prima_dominical=($this->cantidad_domingos*$this->sueldo_diario_imss)*$this->factor_prima_dominical;

		$this->total_domingos=($this->cantidad_domingos*$this->sueldo_diario_imss)+$this->prima_dominical;

		}

		

	function calcular_turno_trabajados()

	{

		$this->total_turnos=$this->cantidad_turnos*$this->sueldo_diario_imss;

		}	

		

	function calcular_descanso_trabajados()

	{

		$this->total_descanso=($this->cantidad_descanso*$this->sueldo_diario_imss)*$this->factor_descanso;

		}

		

	function calcular_dias_festivos()

	{

		$this->total_festivos=($this->cantidad_festivos*$this->sueldo_diario_imss)*$this->factor_festivos;

		}

		

	function calcular_vacaciones()

	{

		$this->prima_vacacional=($this->cantidad_vacaciones*$this->sueldo_diario_imss)*$this->factor_prima_vacacional;

		$this->total_vacaciones=($this->cantidad_vacaciones*$this->sueldo_diario_imss)+$this->prima_vacacional;

		}

		

	function calcular_otras_percepciones()

	{

		

	    

	    

	

		if($this->otras_percepciones>0)

			{

				

				$limite_aplicar=$this->sueldo_integrado*.10;

				$salario_df_total=($this->salario_df*$this->factor_salario_df)*$this->dias_trabajados;

				

				if($this->otras_percepciones<=$limite_aplicar){

					    $this->puntualidad=$this->otras_percepciones;

						$this->asistencia=0; 

						$this->despensa=0;

                        $this->becas_educacionales=0;

					

					}else{

						$this->puntualidad=$limite_aplicar;

						$this->otras_percepciones=$this->otras_percepciones-$limite_aplicar;

						

						if($this->otras_percepciones<=$limite_aplicar){

							$this->asistencia=$this->otras_percepciones;

							$this->despensa=0; 

                            $this->becas_educacionales=0;

							}else{

							$this->asistencia=$limite_aplicar;

							$this->otras_percepciones=$this->otras_percepciones-$limite_aplicar; 

                            

							

							if($this->otras_percepciones>0)

							{

								

								

								if($this->otras_percepciones>$salario_df_total){

								

							$this->despensa=$salario_df_total;

							$this->otras_percepciones=$this->otras_percepciones-$salario_df_total;

							$this->becas_educacionales=$this->otras_percepciones;

							}else{

								$this->despensa=$this->otras_percepciones;

								$this->becas_educacionales=0;

								}

								

							

							

							

							

								}

								else

								{

								$this->despensa=0;

							    $this->becas_educacionales=0;

									}

							

							

							

							

							

							

							}

						

						

						

						

						}

				

				

				

				}

				else

				{

					    $this->puntualidad=0;

						$this->asistencia=0; 

						$this->despensa=0;

                        $this->becas_educacionales=0;

				}

		

		}

		

	function obtener_tipo_nomina()

	{

		$this->tipo_nomina=$this->ConsultarPeriodoNomina($this->id_nomina,$this->tipo_nomina_fiscal,$this->sueldo_integrado,$this->dias_trabajados);

		}

		

	function obtener_dias_trabajados_imssisrsub()

	{

		if($this->tipo_nomina=='semanal' AND $this->dias_trabajados>=8)

		{ 	

		$this->dias_trabajados_imssisrsub=$this->dias_trabajados/8;

		}

		else

		{

			$this->dias_trabajados_imssisrsub=$this->dias_trabajados;

		}

		

		}

		

	function calcular_datos_imssisrsub()

	{

		$this->SalarioImss= $this->sueldo_diario_imss;					

		$this->TotalSueldoImss=$this->SalarioImss*$this->dias_trabajados_imssisrsub;					

		$this->SueldoparaIMSS=$this->sueldo_imss*$this->dias_trabajados_imssisrsub;	

		}

		

	function calcular_isr()

	{

		$this->isr=$this->getISR($this->TotalSueldoImss,$this->tipo_nomina);



	}

	

	function calcular_imss()

	{

		$this->imss=$this->getIMSS($this->SueldoparaIMSS);

		

	}

	

	function calcular_subsidio()

	{

		$this->subsidio=$this->getSubsidioEmpleo($this->TotalSueldoImss,$this->tipo_nomina);

		

	}

	

	function total_percepciones_empleado()

	{

		$this->total_percepciones_empleado= $this->total_sueldo+

											$this->total_domingos+

											$this->total_vacaciones+

											$this->total_turnos+ 

											$this->total_descanso+  

											$this->total_horas_extra+  

											$this->total_festivos+

											$this->aguinaldo+

											$this->puntualidad+

											$this->asistencia+

											$this->becas_educacionales+

											$this->subsidio;

		}

		

	function total_deducciones_empleado()

	{

		$this->total_deducciones_empleado=$this->infonavit+	

										  $this->prestamos+

										  $this->caja_ahorro+

										  $this->otras_deducciones+

										  $this->fonacot+

										  $this->imss+

										  $this->isr;

;

		}

		

	function TOTAL_NETO()

	{

		$this->total_neto_empleado=$this->total_percepciones_empleado-$this->total_deducciones_empleado;

		}

		

	function TOTAL_PERCEPCIONES(){

		$this->total_percepciones=$this->total_percepciones+$this->total_percepciones_empleado;

		}

		

	function TOTAL_DEDUCCIONES(){

		$this->total_deducciones=$this->total_deducciones+$this->total_deducciones_empleado;

		}

	

	function TOTAL_NOMINA(){

		$this->TOTAL=$this->total_percepciones-$this->total_deducciones;

		}

		

	function ajuste_decimales()

	{

		      

			  $this->sueldo_diario_imss=redondear($this->sueldo_diario_imss); 

			  $this->dias_trabajados=redondear($this->dias_trabajados); 

			  $this->total_sueldo=redondear($this->total_sueldo); 

			  $this->cantidad_domingos=redondear($this->cantidad_domingos); 

			  $this->total_domingos=redondear($this->total_domingos); 

			  $this->prima_dominical=redondear($this->prima_dominical); 

			  $this->cantidad_vacaciones=redondear($this->cantidad_vacaciones); 

			  $this->total_vacaciones=redondear($this->total_vacaciones); 

			  $this->prima_vacacional=redondear($this->prima_vacacional); 

			  $this->cantidad_turnos=redondear($this->cantidad_turnos); 

			  $this->total_turnos=redondear($this->total_turnos); 

			  $this->cantidad_descanso=redondear($this->cantidad_descanso); 

			  $this->total_descanso=redondear($this->total_descanso); 

			  $this->cantidad_horas_extra=redondear($this->cantidad_horas_extra); 

			  $this->total_horas_extra=redondear($this->total_horas_extra); 

			  $this->cantidad_festivos=redondear($this->cantidad_festivos); 

			  $this->total_festivos=redondear($this->total_festivos); 

			  $this->aguinaldo=redondear($this->aguinaldo); 

			  $this->puntualidad=redondear($this->puntualidad); 

			  $this->asistencia=redondear($this->asistencia); 

			  $this->becas_educacionales=redondear($this->becas_educacionales); 

			  $this->subsidio=redondear($this->subsidio); 

			  $this->prestamos=redondear($this->prestamos); 

			  $this->caja_ahorro=redondear($this->caja_ahorro); 

			  $this->fonacot=redondear($this->fonacot); 

			  $this->infonavit=redondear($this->infonavit); 

			  $this->isr=redondear($this->isr); 

			  $this->imss=redondear($this->imss); 			  

			  $this->otras_deducciones=redondear($this->otras_deducciones); 

			  $this->total_neto_empleado=redondear($this->total_neto_empleado);

		}

		

	function guardar_nominaAntigua_fiscalNueva()

	{

		try{

		$consulta = $this->db->prepare("

		INSERT INTO nomina_fiscal

			(

			  id_nomina, 

			  id_empleado, 

			  p_sueldo_diario, 

			  p_dias_trabajados, 

			  p_total_sueldo, 

			  p_num_domingos_trabajados, 

			  p_subtotal_domingos, 

			  p_prima_dominical, 

			  p_num_vacaciones, 

			  p_subtotal_vacaciones, 

			  p_prima_vacacional, 

			  p_num_turnos_trabajados, 

			  p_total_turnos_trabajados, 

			  p_num_descansos_trabajados, 

			  p_total_descansos_trabajados, 

			  p_num_horas_extras, 

			  p_total_horas_extras, 

			  p_num_dias_festivos, 

			  p_total_dias_festivos, 

			  p_aguinaldo, 

			  p_premio_por_puntualidad, 

			  p_premio_por_asistencia, 

			  p_despensa,

			  p_becas_educacionales, 

			  p_subsidio_empleo, 

			  d_prestamos, 

			  d_caja_ahorro, 

			  d_fonacot, 

			  d_infonavit, 

			  d_ISR, 

			  d_IMSS, 

			  d_descripcion_otras_deducciones, 

			  d_total_otras_deducciones, 

			  total_nomina_fiscal

			  )  

		VALUES (

		      '$this->id_nomina', 

			  '$this->id_empleado', 

			  '$this->sueldo_diario_imss', 

			  '$this->dias_trabajados', 

			  '$this->total_sueldo', 

			  '$this->cantidad_domingos', 

			  '$this->total_domingos', 

			  '$this->prima_dominical', 

			  '$this->cantidad_vacaciones', 

			  '$this->total_vacaciones', 

			  '$this->prima_vacacional', 

			  '$this->cantidad_turnos', 

			  '$this->total_turnos', 

			  '$this->cantidad_descanso', 

			  '$this->total_descanso', 

			  '$this->cantidad_horas_extra', 

			  '$this->total_horas_extra', 

			  '$this->cantidad_festivos', 

			  '$this->total_festivos', 

			  '$this->aguinaldo', 

			  '$this->puntualidad', 

			  '$this->asistencia', 

			  '$this->despensa',

			  '$this->becas_educacionales', 

			  '$this->subsidio', 

			  '$this->prestamos', 

			  '$this->caja_ahorro', 

			  '$this->fonacot', 

			  '$this->infonavit', 

			  '$this->isr', 

			  '$this->imss', 

			  '$this->descripcion_ot_deducciones', 

			  '$this->otras_deducciones', 

			  '$this->total_neto_empleado'

		)

		");

		$consulta->execute();

		

		} catch (PDOException $e) {

                   $Mensaje="Insercion Erronea:  </br></br>";					   			  

				   $Mensaje.="Error En la linea:_____".$e->getLine()."</br></br>";					   	  

				   $Mensaje.="Error capturado:_____".$e->getMessage()." </br></br> ";

				   $Mensaje.="Error capturado:_____".$e->getCode()." </br></br> ";

				   $Mensaje=str_replace("'","",$Mensaje);

				    echo "<script>jAlert(\"$Mensaje\")</script>";					

				 

				   }

		}

		

		

		function recalculo_neto(){

			

			$bandera_break=true;

			$bandera_break2=true;			

			

			$this->NetoPagar($this->id_empleado,$this->id_nomina,$this->tipo_nomina,$this->tipo_nomina_fiscal,$bandera_break,$bandera_break2,$this->sueldo_integrado,$this->dias_trabajados);

			

			$this->ajustar_calculos_fixed($this->id_nomina,$this->id_empleado);

			

			$bandera_break=true;

			$bandera_break2=true;	

			

			$this->NetoPagar($this->id_empleado,$this->id_nomina,$this->tipo_nomina,$this->tipo_nomina_fiscal,$bandera_break,$bandera_break2,$this->sueldo_integrado,$this->dias_trabajados);

			

			}

							  							  

									 

		

		

	function imprimir_valores()

	{

		echo "---------------------valores---------------------";

		echo "<br />--id empleado  ".$this->id_empleado;

		echo "<br />--id nomina  ".$this->id_nomina;

		echo "<br />--id_empresa  ".$this->id_empresa;

		

		echo "<br />--sueldo_diario_imss  ".$this->sueldo_diario_imss;

		echo "<br />--dias_trabajados  ".$this->dias_trabajados;

		echo "<br />--total_sueldo  ".$this->total_sueldo;

		

		

		echo "<br />--cantidad_horas_extra  ".$this->cantidad_horas_extra;

		echo "<br />--total_horas_extra  ".$this->total_horas_extra;

		

		echo "<br />--cantidad_domingos  ".$this->cantidad_domingos;

		echo "<br />--prima_dominical  ".$this->prima_dominical;

		echo "<br />--total_domingos  ".$this->total_domingos;

		

		echo "<br />--cantidad_turnos  ".$this->cantidad_turnos;

		echo "<br />--total_turnos  ".$this->total_turnos;

		

		echo "<br />--cantidad_descanso  ".$this->cantidad_descanso;

		echo "<br />--total_descanso  ".$this->total_descanso;

		

		echo "<br />--cantidad_festivos  ".$this->cantidad_festivos;

		echo "<br />--total_festivos  ".$this->total_festivos;

		

		echo "<br />--cantidad_vacaciones  ".$this->cantidad_vacaciones;

		echo "<br />--prima_vacacional  ".$this->prima_vacacional;

		echo "<br />--total_vacaciones  ".$this->total_vacaciones;

		

		echo "<br />--AGUINALDO  ".$this->aguinaldo;

		echo "<br />--COMPLEMENTO_SUELDO  ".$this->complemento_sueldo;

		echo "<br />--OTRAS PERCEPCIONES  ".$this->otras_percepciones;

		

		echo "<br />--puntualidad  ".$this->puntualidad;

		echo "<br />--asistencia  ".$this->asistencia;

		echo "<br />--becas  ".$this->becas_educacionales;

	

		

		echo "<br />--total_percepciones_empleados  ".$this->total_percepciones_empleado;

		echo "<br />--total_deducciones_empleado  ".$this->total_deducciones_empleado;

		

		echo "<br />--total_final_empleado  ".$this->total_final_empleado;

		

		echo "<br />--total_percepciones  ".$this->total_percepciones;

		echo "<br />--total_deducciones  ".$this->total_deducciones;

		

		echo "<br />--TOTAL  ".$this->TOTAL;

		

		

		

		echo "<br />--factor_imss  ".$this->factor_imss;

		echo "<br />--factor_horas_extra  ".$this->factor_horas_extra;

		echo "<br />--factor_prima_dominical  ".$this->factor_prima_dominical;

		echo "<br />--factor_descanso  ".$this->factor_descanso;

		echo "<br />--factor_festivos  ".$this->factor_festivos;

		echo "<br />--factor_prima_vacacional  ".$this->factor_prima_vacacional;

		

		echo "<br />--dias_trabajados_imssisrsub  ".$this->dias_trabajados_imssisrsub;

		echo "<br />--SalarioImss  ".$this->SalarioImss;

		echo "<br />--TotalSueldoImss  ".$this->TotalSueldoImss;

		echo "<br />--SueldoparaIMSS  ".$this->SueldoparaIMSS;

		

		echo "<br />--isr  ".$this->isr;

		echo "<br />--imss  ".$this->imss;

		echo "<br />--sub  ".$this->subsidio;

		

		echo "<br />--percepciones  empleado   ".$this->total_percepciones_empleado;

		echo "<br />--deducciones empleado   ".$this->total_deducciones_empleado;

		echo "<br />--neto empleado   ".$this->total_neto_empleado;

		echo "<br />--total percepciones   ".$this->total_percepciones;

		echo "<br />--total deducciones    ".$this->total_deducciones;

		echo "<br />--TOTAL NOMINA  ".$this->TOTAL;

		

		echo "<br />---------------------valores---------------------";

		}		

		

}







	

	

	

?>