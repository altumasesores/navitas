<?php

class ModelCalculos extends ModelBase

{

	/*atributos para el calculo del isr*/

	public $salario;

	public $limite_inferior;

	public $limite_superior;

	public $excedente_limite_inferior;

	public $factor_excedente;

	public $resultado_excedente;

	public $cuota_fija;

	public $resultado_cuota;

	public $subsidio;

	public $ISR;


	/*atributos para el calculo del imss*/

	public $factor_integracion = 1.0452;

	public $resultado_factor_integracion;

	public $cuota_trabajador = 2.375;

	public $cuota_adicional = 0.40;

	public $salario_df=64.76;





	public $IMSS;



		public function ConsultarNomina($idNomina,$idEmpresa,$TipoNomina){
				//realizamos la consulta 



					$consulta = $this->db->prepare("SELECT tipo_nomina FROM nominas WHERE nominas.id_nomina= $id_nomina ");



					$consulta->execute();



					foreach($consulta as $Row){



						$tipoNomina= $Row['tipo_nomina'];



					}



					$this->EmpleadosNomina($id_nomina,$tipoNomina);



					//devolvemos la coleccion para que la vista la presente.



					//return $consulta;



		}


		public function ConsultarPeriodoNomina($id_nomina,$tipo_nom,$sueldo_integrado,$dias_trabajados)

		{//id_nomina=1,2,3...   tipo_nom=normal,fiscal

					//realizamos la consulta 



					$consulta = $this->db->prepare("SELECT tipo_nomina FROM nominas WHERE id_nomina= $id_nomina ");



					$consulta->execute();				

					foreach($consulta as $Row){



						$tipoNomina= $Row['tipo_nomina'];



					}


					if($tipo_nom=="noFiscal")//para la clase que se carga al inicio de una nomina antigua



					{



						return $tipoNomina;



					}



					else //normal o fiscal al guardar una nomina nueva,llamada desde la fucnion guardar_nomina del archivo guradar_nomina.js



					{

					$this->EmpleadosNomina($id_nomina,$tipoNomina,$tipo_nom,$sueldo_integrado,$dias_trabajados);


					}
		}

     	public function nominaFiscalEmpleado($id_nomina, $id_empleado)

    	{

                //realizamos la consulta 



                $consulta = $this->db->prepare("SELECT * FROM nomina_fiscal WHERE nomina_fiscal.id_nomina= $id_nomina AND nomina_fiscal.id_empleado= $id_empleado");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    	}   


       	public function EliminarEmpleadoNominaFiscal($id_empleado,$id_empresa,$idNomina)
    	{



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("DELETE FROM nomina_fiscal WHERE id_nomina='$idNomina' AND id_empleado='$id_empleado'");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



	    } 

	 	public function EliminareNominaFiscal($idNomina)
	    {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("DELETE FROM nomina_fiscal WHERE id_nomina='$idNomina' ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    	} 


	public function EmpleadosNomina($id_nomina,$tipoNomina,$tipo_nom,$sueldo_integrado,$dias_trabajados)

        {



					



			//ID Y "SEMANAL"



				



                //realizamos la consulta 



                $consulta2 = $this->db->prepare("SELECT perc.id_empleado, perc.sueldo_diario_emp, perc.dias_trabajados ,emp.sueldo_diario_imss



												FROM percepciones_empleado perc



												INNER JOIN empleados emp on perc.id_empleado= emp.id_empleado



												WHERE id_nomina= $id_nomina ");



                $consulta2->execute();



				



				



				



				foreach($consulta2 as $Row2){



					



					$id_empleado= $Row2['id_empleado'];



					$SueldoDiario=$Row2['sueldo_diario_emp'];//salario



					$SueldoDiarioImss= $Row2['sueldo_diario_imss'];//salarioimss{con factor}					



					$DiasTrabajados=$Row2 ['dias_trabajados'];



					



						if($tipoNomina=='semanal' AND $DiasTrabajados>=8){



							$DiasTrabajados=$this->redondear($DiasTrabajados/8);



						}



						



						



					$Salario=$this->redondear($SueldoDiario);



					$SalarioImss=$this->redondear($SueldoDiarioImss/1.0452);



					



					$TotalSueldo=$this->redondear($Salario*$DiasTrabajados);



					$TotalSueldoImss=$this->redondear($SalarioImss*$DiasTrabajados);//con factor imss



					



					$SueldoparaIMSS=$this->redondear($SueldoDiarioImss*$DiasTrabajados);//integrado



					



					







					$ISR=$this->getISR($TotalSueldo,$tipoNomina);



					$Subsidio=$this->getSubsidioEmpleo($TotalSueldo,$tipoNomina);



					$IMSS=$this->getIMSS($SueldoparaIMSS, $DiasTrabajados); //FALTA ENVIAR DIAS TRABAJADOS
			

					if($DiasTrabajados!=0 AND $DiasTrabajados!=''){//solucion de lucely  reinicia valores..error.

						$ISR_Imss=$this->getISR($TotalSueldoImss,$tipoNomina);



						$Subsidio_Imss=$this->getSubsidioEmpleo($TotalSueldoImss,$tipoNomina);



						$IMSS_Imss=$this->getIMSS($SueldoparaIMSS,$DiasTrabajados);	



					}

					else{

						$ISR_Imss=0;

						$Subsidio_Imss=0;

						$IMSS_Imss=0;	

					}

					$consulta5 = $this->db->prepare("UPDATE  nomina_fiscal SET d_ISR='$ISR_Imss', d_IMSS='$IMSS_Imss', p_subsidio_empleo='$Subsidio_Imss' WHERE id_nomina= $id_nomina AND id_empleado=$id_empleado ");



					$consulta5->execute();

					$bandera_break=true;

					$bandera_break2=true;


					$this->NetoPagar($id_empleado,$id_nomina,$tipoNomina,$tipo_nom,$bandera_break,$bandera_break2,$sueldo_integrado,$dias_trabajados);

					$this->ajustar_calculos_fixed($id_nomina,$id_empleado);


					$this->NetoPagar($id_empleado,$id_nomina,$tipoNomina,$tipo_nom,$bandera_break,$bandera_break2,$sueldo_integrado,$dias_trabajados);


				}

               //devolvemos la coleccion para que la vista la presente.

        }



	public function ConsultarDatosNomina($id_nomina)



    {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("SELECT * FROM nominas WHERE nominas.id_nomina= $id_nomina ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    }



/*********TABLAS Y TARIFAS POR CANTIDAD DE TRABAJO REALIZADO *******************/







	public function listadoTarifaTrabajoRealizado()
        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_trabajo_realizado



				 ORDER BY id_tarifa_trabajo_realizado ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }

	public function getLimitesTarifaTrabajoRealizado($sueldo)
        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_trabajo_realizado



					WHERE $sueldo BETWEEN limite_inferior AND limite_superior



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }


	public function listadoTablaSubsidio1B()
        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tabla_subsidio_1b



				 ORDER BY id_tabla_subsidio_1b ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }

	public function getLimitesTablaSubsidio1B($sueldo)
        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tabla_subsidio_1b



					WHERE $sueldo BETWEEN ingresos_de AND ingresos_hasta



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }


	public function listadoTarifaSubsidio1B()
    {


                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_subsidio_1b



				 ORDER BY id_tarifa_subsidio_1b ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    }

	public function getLimitesTarifaSubsidio1B($sueldo)
    {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_subsidio_1b



					WHERE $sueldo BETWEEN limite_inferior_1 AND limite_superior



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    }

/*********TABLAS Y TARIFAS PERIODO 7 DIAS *******************/

	public function listadoTarifa7Dias()
    {

                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_7_dias



				 ORDER BY id_tarifa_7_dias ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    }


	public function getLimitesTarifa7Dias($sueldo)
    {


                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_7_dias



					WHERE $sueldo BETWEEN limite_inferior AND limite_superior



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    }


	public function listadoTablaSubsidio2B()
    {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tabla_subsidio_2b



				 ORDER BY id_tabla_subsidio_2b ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    }


	public function getLimitesTablaSubsidio2B($sueldo)
    {

            //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tabla_subsidio_2b



					WHERE $sueldo BETWEEN ingresos_de AND ingresos_hasta



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    }


	public function listadoTarifaSubsidio2B()
    {

                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_subsidio_2b



				 ORDER BY id_tarifa_subsidio_2b ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



    }


	public function getLimitesTarifaSubsidio2B($sueldo)
    {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_subsidio_2b



					WHERE $sueldo BETWEEN limite_inferior_1 AND limite_superior



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;

    }

/*devuelve el ISR calculado de acuerdo a un sueldo y tipo de nomina indicados*/



	public function getISR($sueldo, $periodo)
	{	


		$this->salario= $sueldo;		



		



		



		switch ($periodo){



			



		



			case 'semanal':		



		







				$limites2=$this->getLimitesTarifa7Dias($this->salario);			 			 



			



			break;



			



			



			case 'quincenal':



			



				$limites2=$this->getLimitesTarifa15Dias($this->salario);



			 



			



			break;



			



			



			case 'catorcenal':



			



				$limites2=$this->getLimitesTarifa15Dias($this->salario);		 



			



			break;

	} //fin switch


		 foreach($limites2 as $limites)



    	   		 {



					$this->limite_inferior=  $limites['limite_inferior'];



					$this->limite_superior=  $limites['limite_superior'];



					$this->cuota_fija=  $limites['cuota_fija'];



					$this->factor_excedente=  $limites['porcentaje_excedente'];



					



				}



			



			



			



			$this->excedente_limite_inferior= $this->salario - $this->limite_inferior;



			



			$this->resultado_excedente= $this->excedente_limite_inferior * ($this->factor_excedente/100);



			



			$this->resultado_cuota= $this->resultado_excedente + $this->cuota_fija;



	



			$this->ISR= $this->resultado_cuota;



			



			



		



			return $this->ISR;  //se devuelve el resultado del isr



		



		}//fin function















/*Devuelve el subsidio al empleado de acuerdo a un salario indicado y tipo de nomina*/



public function getSubsidioEmpleo($salario, $periodo ){











	switch ($periodo){



		



		case 'semanal':		/**obtengo el subsidio semanal**/



		



			$subsidio_result= $this->getLimitesTablaSubsidio2B($salario);



			 



			 foreach($subsidio_result as $subsidios )



       		 {



				$this->subsidio=  $subsidios['subsidio_semanal'];				



				



				}



		break;



		



		



		case 'quincenal':



			



			$subsidio_result= $this->getLimitesTablaSubsidio4B($salario);



			 



			 foreach($subsidio_result as $subsidios )



       		 {



				$this->subsidio=  $subsidios['subsidio_quincenal'];				



				



				}



		



		break;



		



		



		case 'catorcenal':



		



			$subsidio_result= $this->getLimitesTablaSubsidio4B($salario);



			 



			 foreach($subsidio_result as $subsidios )



       		 {



				$this->subsidio=  $subsidios['subsidio_quincenal'];				



				



				}



		



		break;



		



		



		} //fin switch











			return $this->subsidio;







} //fin funcion











public function getIMSS($sueldo_diario, $dias_trabajados){

	//aqui recibo el salario integrado imss = $73

	//aqui debe enviarse como parametro el salario diario integrado multiplicado por los dias.  $73*7

	if ($sueldo_diario < ($this->salario_df*3)) {
		//cuando el sueldo imss es menor a 3 salarios mínimos del df
		//$this->resultado_factor_integracion = $sueldo_diario * $this->factor_integracion;


		$this->IMSS = ($this->sueldo_diario * ($this->cuota_trabajador/100) ) * $dias_trabajados;

	} else {
		//cuando el sueldo imss es mayor o igual a 3 salarios minimos del df
		//$this->resultado_factor_integracion = $sueldo_diario * $this->factor_integracion;


		$resul_cuota_adicional =  ($this->sueldo_diario - ($this->salario_df*3)) * ($this->cuota_adicional * $dias_trabajados);

		$this->IMSS = (($this->sueldo_diario * ($this->cuota_trabajador/100) ) * $dias_trabajados) + $resul_cuota_adicional;


	}
	
	//return $this->IMSS;

	return 100;

	}







































/****TABLAS Y TARIFAS PERIODO 10 DIAS *******/















	public function listadoTarifa10Dias()



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_10_dias



				 ORDER BY id_tarifa_10_dias ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }















	public function getLimitesTarifa10Dias($sueldo)



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_10_dias



					WHERE $sueldo BETWEEN limite_inferior AND limite_superior



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }























	public function listadoTablaSubsidio3B()



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tabla_subsidio_3b



				 ORDER BY id_tabla_subsidio_3b ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }















	public function getLimitesTablaSubsidio3B($sueldo)



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tabla_subsidio_3b



					WHERE $sueldo BETWEEN ingresos_de AND ingresos_hasta



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }



















	public function listadoTarifaSubsidio3B()



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_subsidio_3b



				 ORDER BY id_tarifa_subsidio_3b ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }















	public function getLimitesTarifaSubsidio3B($sueldo)



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_subsidio_3b



					WHERE $sueldo BETWEEN limite_inferior_1 AND limite_superior



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }



























/*********TABLAS Y TARIFAS PERIODO 15 DIAS *******************/



















	public function listadoTarifa15Dias()



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_15_dias



				 ORDER BY id_tarifa_15_dias ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }















	public function getLimitesTarifa15Dias($sueldo)



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_15_dias



					WHERE $sueldo BETWEEN limite_inferior AND limite_superior



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }























	public function listadoTablaSubsidio4B()



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tabla_subsidio_4b



				 ORDER BY id_tabla_subsidio_4b ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }















	public function getLimitesTablaSubsidio4B($sueldo)



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tabla_subsidio_4b



					WHERE $sueldo BETWEEN ingresos_de AND ingresos_hasta



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }



















	public function listadoTarifaSubsidio4B()



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_subsidio_4b



				 ORDER BY id_tarifa_subsidio_4b ASC ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }















	public function getLimitesTarifaSubsidio4B($sueldo)



        {



				



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				SELECT * FROM tarifa_subsidio_4b



					WHERE $sueldo BETWEEN limite_inferior_1 AND limite_superior



				 ");



                $consulta->execute();



                //devolvemos la coleccion para que la vista la presente.



                return $consulta;



        }



		



		



/********************************TOTALES*************************/











	



	public function NetoPagar($id_empleado,$id_nomina,$tipoNomina,$tipo_nom,$bandera_break,$bandera_break2,$sueldo_integrado,$dias_trabajados){



		



		



		



  



     if($tipo_nom=="normal"){



 



		



		 $Neto = $this->db->prepare("



									  select



									  (total_sueldo+									  



									  total_domingos_trabajados+	



									  total_vacaciones+ 	



									  total_turnos_trabajados+ 	



									  total_descanso_trabajado+



									  total_horas_extras+



									  otras_percepciones+ 



									  complemento_sueldo+ 	



									  total_dias_festivos+									  



									  aguinaldo)



									  -



									  (infonavit+									 



									  prestamos+



									  caja_ahorro+



									  otras_deducciones+



									  fonacot+



									  prestamo_ascon 



									  ) as neto



									  



									  from 



									  percepciones_empleado pe inner join deducciones_empleado de 



									  on pe.id_empleado=de.id_empleado 



									  and 



									  pe.id_nomina=de.id_nomina



									  



									  where



									  pe.id_empleado='$id_empleado'



									  and



									  pe.id_nomina='$id_nomina'



				 ");



                $Neto->execute();



				



				



				foreach($Neto as $monto)



				{



					$total=$monto['neto'];



					}



					



					



				



				$this->guardar_total_ReciboNomina($total,$id_empleado,$id_nomina,$tipo_nom,$tipoNomina,$bandera_break,$bandera_break2,$sueldo_integrado,$dias_trabajados);



				



				



				



	 }else{



				



				



				 $Neto_fiscal = $this->db->prepare("



									  select									  



									 (p_total_sueldo+



									  p_subtotal_domingos+



									  p_subtotal_vacaciones+



									  p_total_turnos_trabajados+ 



									  p_total_descansos_trabajados+  



									  p_total_horas_extras+  



									  p_total_dias_festivos+



									  p_aguinaldo+



									  p_premio_por_puntualidad+



									  p_premio_por_asistencia+



									  p_despensa+



									  p_becas_educacionales+



									  p_subsidio_empleo)							  



									  -									  



									  (d_infonavit+	



									  d_IMSS+



									  d_ISR +



									  d_prestamos+



									  d_caja_ahorro+



									  d_total_otras_deducciones+



									  d_fonacot) as neto_fiscal



									  



									  from



									  nomina_fiscal



									  where id_nomina='$id_nomina' 



									  and  



									  id_empleado='$id_empleado'



										   



									  



									 



				 ");



                $Neto_fiscal->execute();



				



				



				



					



					foreach($Neto_fiscal as $monto_fiscal)



				{



					



					$total_fiscal=$monto_fiscal['neto_fiscal'];

					

						//echo "<br />--id empleado '$id_empleado'  ffff ".$total_fiscal;



					}



					



					



					$this->guardar_total_ReciboNomina($total_fiscal,$id_empleado,$id_nomina,$tipo_nom,$tipoNomina,$bandera_break,$bandera_break2,$sueldo_integrado,$dias_trabajados);		



					



	 }



		



		



	 



		}



	



		



		public function guardar_total_ReciboNomina($total,$id_empleado,$id_nomina,$tipo_nom,$tipoNomina,$bandera_break,$bandera_break2,$sueldo_integrado,$dias_trabajados)



        {



			



				if($tipo_nom=="normal"){



                //realizamos la consulta 



                $consulta = $this->db->prepare("



				update percepciones_empleado 



				set total_ReciboNomina='$total' 



				where 



				id_nomina='$id_nomina' 



				and  



				id_empleado='$id_empleado'



				 ");



				 



                $consulta->execute();



				



				}else{



				



				$consulta2 = $this->db->prepare("



				update nomina_fiscal 



				set 



				total_nomina_fiscal='$total' 



				where 



				id_nomina='$id_nomina' 



				and  



				id_empleado='$id_empleado'



				 ");



				 



                $consulta2->execute();



                //devolvemos la coleccion para que la vista la presente.



				}



				



				/* comente if($bandera_break2){



				



				$this->ajustar_totales($id_empleado,$id_nomina,$bandera_break,$bandera_break2,$sueldo_integrado,$dias_trabajados);



				}*/



                



        }



		



		



		public function ajustar_totales($id_empleado,$id_nomina,$bandera_break,$bandera_break2,$sueldo_integrado1,$dias_trabajados)



		{

		echo "<script>alert('aki en ajustar totales".$id_empleado.'nomina'.$id_nomina.'aa'.$bandera_break.'aa'.$bandera_break2.'sueldo para imss'.$sueldo_integrado1.'a'.$dias_trabajados."')</script>";  



			 $consulta = $this->db->prepare("



				select total_ReciboNomina,total_nomina_fiscal,(total_ReciboNomina-total_nomina_fiscal) as total



from percepciones_empleado pe inner join nomina_fiscal nf on pe.id_nomina=nf.id_nomina and pe.id_empleado=nf.id_empleado



where pe.id_nomina='$id_nomina' and pe.id_empleado='$id_empleado' 



				 ");



				 



                $consulta->execute();



				



				foreach($consulta as $total)



				{				



					$total_agregar=$total['total'];



					$RN=$total['total_ReciboNomina'];



					$NF=$total['total_nomina_fiscal'];



					}



					



					



				



					



					



					



					



					



			$consulta_op = $this->db->prepare("



				select 



				otras_percepciones



				from 



				percepciones_empleado 				



				where 



				id_nomina='$id_nomina' 



				and 



				id_empleado='$id_empleado' 



				 ");				 



             $consulta_op->execute();



				



			  foreach($consulta_op as $ot_op)



			  {



				  $ot_p=$ot_op['otras_percepciones'];



				  



				  



				  }



				  



				 



					



					



					if($ot_p>0){



					if($total_agregar>0)//si es positivo



					{

					echo "<script>alert('Agregando a Becas educacionales'".$id_empleado.")</script>";  

						



						



						



						$consulta2 = $this->db->prepare("



				update nomina_fiscal 



				set 



				p_becas_educacionales=p_becas_educacionales+'$total_agregar'



				where 



				id_nomina='$id_nomina' 



				and  



				id_empleado='$id_empleado'



				 ");



				 



                $consulta2->execute();



						



						



						}



						



					}else{



						



						



						$otras_percepciones=$total_agregar;



					$sueldo_integgrado=$sueldo_integrado1;



					



					



					



					



						



						



						/**********************************BLOQUE DISTRIBUCION OTRAS PERCEPCIONES***********************************/



				if($otras_percepciones>0)



			{



				



				



				echo "<script>alert('Otras percepciones mayor a cero '".$id_empleado.")</script>";  



				$sueldo_integrado=$sueldo_integgrado*$dias_trabajados;



				$limite_aplicar=$sueldo_integrado*.10;



				$salario_df=59.82;



				$salario_df_total=($salario_df*.4)*$dias_trabajados;



				if($otras_percepciones<=$limite_aplicar){

				

				echo "<script>alert('Otras percepciones menor a limite '".$id_empleado.")</script>";  



					    $p_premio_por_puntualidad=$otras_percepciones;



						$p_premio_por_asistencia=0; 



						$p_despensa=0;



                        $p_becas_educacionales=0;



					



					}else{



					echo "<script>alert('Otras percepciones mayor a limite '".$id_empleado.")</script>";  

						$p_premio_por_puntualidad=$limite_aplicar;



						$otras_percepciones=$otras_percepciones-$limite_aplicar;



						



						



						



						if($otras_percepciones<=$limite_aplicar){



							$p_premio_por_asistencia=$otras_percepciones; 



							$despensa=0;



                            $p_becas_educacionales=0;



							}else{



							$p_premio_por_asistencia=$limite_aplicar;



							$otras_percepciones=$otras_percepciones-$limite_aplicar; 							



							



							if($otras_percepciones>0)



							{



								if($otras_percepciones>$salario_df_total){



							$despensa=$salario_df_total;



							$otras_percepciones=$otras_percepciones-$salario_df_total;



							$p_becas_educacionales=$otras_percepciones;



							}else{



								$despensa=$otras_percepciones;



								$p_becas_educacionales=0;



								}



								}



								else



								{



								$despensa=0;



							    $p_becas_educacionales=0;



									}



							



                            



							}



						



						



						



						



						}



						



						



						$consultax = $this->db->prepare("



				update nomina_fiscal 



				set 



				p_premio_por_puntualidad='$p_premio_por_puntualidad',



				p_premio_por_asistencia='$p_premio_por_asistencia',



				p_despensa='$despensa',



				p_becas_educacionales='$p_becas_educacionales'



				where 



				id_nomina='$id_nomina'



				and  



				id_empleado='$id_empleado'



				 ");



				 



                $consultax->execute();



				



				





				



				}



				else



				{

				

				echo "<script>alert('Otras percepciones 00 '".$id_empleado.")</script>";  



					



					    $p_premio_por_puntualidad=0;



						$p_premio_por_asistencia=0; 



						$despensa=0;



                        $p_becas_educacionales=0;



						//**SE REPITIO LA SIGUIENTE CONSULTA, YA QUE POR EL MOMENTO ERA LA MEJOR SOLUCION PARA HACER FRENTE AL PROBLEMA DE RECALCULO DESPUES DE RESTARLE A SUBSIDIO.LA CLASE Y LAS FUNCIONES NO ESTAN BIEN DISEÑADAS PARA REUTILIZAR EL CODIGO*/



						$consultax = $this->db->prepare("



				update nomina_fiscal 



				set 



				p_premio_por_puntualidad=p_premio_por_puntualidad+'$p_premio_por_puntualidad',



				p_premio_por_asistencia=p_premio_por_asistencia+'$p_premio_por_asistencia',



				p_despensa=p_despensa+'$despensa',



				p_becas_educacionales=p_becas_educacionales+'$p_becas_educacionales'



				where 



				id_nomina='$id_nomina'



				and  



				id_empleado='$id_empleado'



				 ");



				 



                $consultax->execute();

				

				

				



				}



				



				/****************************DISTRIBUCION OTRAS PERCEPCIONES*******************************************/



				



				



					   



				



				



				



				



						



			



						



						



						



						}//if principal



						



						



						



						



						



						if($bandera_break2){



							$bandera_break2=false;



							}



						



						$this->NetoPagar($id_empleado,$id_nomina,$tipoNomina,$tipo_nom,$bandera_break,$bandera_break2,$sueldo_integrado1,$dias_trabajados);



			



			}



		



		



		



		



		



		public function redondear($valor){



		$float_redondeado=round($valor * 100) / 100;



		return $float_redondeado;



		} 



















public function ajustar_calculos_fixed($id_nomina,$id_empleado){



	



	try{



	$consulta = $this->db->prepare("



				select nf.id_empleado,total_ReciboNomina,total_nomina_fiscal,(total_nomina_fiscal-total_ReciboNomina) as total



from percepciones_empleado pe inner join nomina_fiscal nf on pe.id_nomina=nf.id_nomina and pe.id_empleado=nf.id_empleado



where pe.id_nomina='$id_nomina' and pe.id_empleado='$id_empleado' 



				 ");



				 



				  $consulta->execute();



				 



				 foreach($consulta as $total)



				{	 $emp=$total['id_empleado'];			



					 $total_agregar=$total['total'];



					 $RN=$total['total_ReciboNomina'];



					 $NF=$total['total_nomina_fiscal'];

					 

					



				}



					



					



				 



               



				} catch (PDOException $e) {



                   $Mensaje="Insercion Erronea:  </br></br>";					   			  



				   $Mensaje.="Error En la linea:_____".$e->getLine()."</br></br>";					   	  



				   $Mensaje.="Error capturado:_____".$e->getMessage()." </br></br> ";



				   $Mensaje.="Error capturado:_____".$e->getCode()." </br></br> ";



				   $Mensaje=str_replace("'","",$Mensaje);



				  				



				 echo $Mensaje;



				   }



             

					if($NF>$RN){



						try{



						 $consulta = $this->db->prepare("



						                                update nomina_fiscal 



														set 



														p_subsidio_empleo=p_subsidio_empleo-$total_agregar



														where id_empleado='$id_empleado' and



														id_nomina='$id_nomina'



						                               "); 

				 



                $consulta->execute();



						



						



						} catch (PDOException $e) {



                   $Mensaje="Insercion Erronea:  </br></br>";					   			  



				   $Mensaje.="Error En la linea:_____".$e->getLine()."</br></br>";					   	  



				   $Mensaje.="Error capturado:_____".$e->getMessage()." </br></br> ";



				   $Mensaje.="Error capturado:_____".$e->getCode()." </br></br> ";



				   $Mensaje=str_replace("'","",$Mensaje);



				  				



				 echo $Mensaje;



				/*   echo "update nomina_fiscal 



														set 



														p_subsidio_empleo=p_subsidio_empleo-$total_agregar



														where id_empleado='$id_empleado' and



														id_nomina='$id_nomina'";  */



				   }



					}elseif($RN>$NF){

					// echo "<br />--id empleadorrr  ".$emp."NORMAL".$RN."FISCAL".$NF;

					 $Faltante=$RN-$NF;

						 $consultat = $this->db->prepare("



						                                update nomina_fiscal 



														set 



														p_becas_educacionales=p_becas_educacionales+'$Faltante'



														where id_empleado='$id_empleado' and



														id_nomina='$id_nomina'



						                               "); 

				 



						$consultat->execute(); 

					} 



                   



                  



	



	



	}



















			



}

/*FIN DE LA CLASE*/







/*	



	public function NetoPagarxxx($id_empleado,$id_nomina,$tipoNomina)



        {



				



                //realizamos la consulta 



                $percepciones = $this->db->prepare("



												SELECT



												 												



												emp.id_empleado,



												emp.nombre,



												emp.ap_paterno,



												emp.ap_materno,



												emp.sueldo_diario_imss,



												



												peremp.id_nomina,



												peremp.id_empresa,	



																							



												peremp.sueldo_diario_emp as sueldoDiarioEmp,



												



												peremp.dias_trabajados,												



												peremp.total_vacaciones as vacaciones,



												peremp.prima_vacacional as prima_vacacional,



												peremp.otras_percepciones,



												peremp.subsidio_empleo,



												peremp.total_domingos_trabajados as domingos,



												peremp.total_horas_extras as hr_extras,



												peremp.prima_dominical as prima_dominical,



												peremp.dias_festivos,



												peremp.aguinaldo as aguinaldo



												



												FROM empleados emp 



												inner join percepciones_empleado peremp on emp.id_empleado=peremp.id_empleado



												where 



												emp.id_empleado='$id_empleado'



												and



												peremp.id_nomina='$id_nomina'



				 ");



                $percepciones->execute();



				



				foreach($percepciones as $monto)



       		 {



				$Sueldo=$monto['sueldo_diario_imss'];



				$DiasTrabajados=$monto ['dias_trabajados'];



					if($tipoNomina=='semanal' AND $DiasTrabajados>=8){



						$DiasTrabajados=$this->redondear($DiasTrabajados/8);



					}



				$Salario=$this->redondear($Sueldo/1.0452);



				



				$TotalSueldo=$this->redondear($Salario*$DiasTrabajados);







				$vacaciones=$monto['vacaciones'];



				$prima_vacacional=$monto['prima_vacacional'];



				$otras_percepciones=$monto['otras_percepciones'];



				$subsidio=$monto['subsidio_empleo'];



				$domingos=$monto['domingos'];



				$hr_extras=$monto['hr_extras'];



				$prima_dominical=$monto['prima_dominical'];



				$dias_festivos=$monto['dias_festivos'];



				$aguinaldo=$monto['aguinaldo'];



				



				



				



				}



			



				$total_percepciones=$TotalSueldo+$vacaciones+$prima_vacacional+$otras_percepciones+$subsidio+$domingos+$hr_extras+$prima_dominical+$dias_festivos+$aguinaldo;



				$deducciones = $this->db->prepare("



												SELECT 



												id_nomina,



												id_empresa,



												id_empleado,



												(infonavit+



												imss+



												isr+prestamos+caja_ahorro+otras_deducciones+fonacot) as deducciones



												from deducciones_empleado



												where id_nomina='$id_nomina'



												and



												id_empleado='$id_empleado'



				 ");



                $deducciones->execute();



				



				foreach($deducciones as $deduccion)



       		 {



				$deducciones=$deduccion['deducciones'];



				



				



				}



				



				if($deducciones<0)



				{



					$monto_final=($total_percepciones)+($deducciones);



					}



					else



					{



						$monto_final=$total_percepciones-$deducciones;



					}



				



				



				



				$this->guardar_total_ReciboNomina($monto_final,$id_empleado,$id_nomina);



				



				



				



                



        }



		



		*/



?>