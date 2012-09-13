<?php

class ModelCalculosDatos extends modelBase

{	
		public function ConsultarDatosNomina($id_nomina)
        {
				
                //realizamos la consulta 
                $consulta = $this->db->prepare("
				SELECT nominas.*, 
				       empresas.razon_social, 
					   empresas.titular, 
					   empresas.zona 
					   FROM nominas
					   INNER JOIN empresas on nominas.id_empresa= empresas.id_empresa
					   WHERE nominas.id_nomina= $id_nomina ");
                $consulta->execute();
                //devolvemos la coleccion para que la vista la presente.
                return $consulta;
        }
		
		public function ConsultarPercepDeduc($idEmpresa,$idNomina)
        {
				
                //realizamos la consulta 
                $consulta = $this->db->prepare("SELECT percepciones_empleado.*, deducciones_empleado.*, empleados.nombre, empleados.ap_paterno, empleados.ap_materno, empleados.no_tarjeta, empleados.curp_empleado, empleados.no_seg_social, empleados.sueldo_diario_imss FROM percepciones_empleado										
												INNER JOIN deducciones_empleado on  percepciones_empleado.id_empleado= deducciones_empleado.id_empleado
												INNER JOIN empleados on  percepciones_empleado.id_empleado= empleados.id_empleado
												WHERE  percepciones_empleado.id_nomina= $idNomina AND percepciones_empleado.id_empresa= $idEmpresa AND  deducciones_empleado.id_nomina= $idNomina ");
                $consulta->execute();
                //devolvemos la coleccion para que la vista la presente.
                return $consulta;
        }
		
		public function ConsultarNominaFiscal($idEmpresa,$idNomina)
        {
				
                //realizamos la consulta 
                $consulta = $this->db->prepare("
				                                SELECT 
												nomina_fiscal.id_nomina_fiscal, 
												nomina_fiscal.id_nomina, 
												nomina_fiscal.id_empleado, 
												nomina_fiscal.p_sueldo_diario, 
												nomina_fiscal.p_dias_trabajados, 
												nomina_fiscal.p_total_sueldo, 
												nomina_fiscal.p_num_domingos_trabajados,									 
												nomina_fiscal.p_prima_dominical, 
												nomina_fiscal.p_subtotal_domingos-nomina_fiscal.p_prima_dominical as p_subtotal_domingos,
												nomina_fiscal.p_num_vacaciones, 
												nomina_fiscal.p_prima_vacacional,
												nomina_fiscal.p_subtotal_vacaciones-nomina_fiscal.p_prima_vacacional as p_subtotal_vacaciones,	 
												nomina_fiscal.p_num_turnos_trabajados,  
												nomina_fiscal.p_total_turnos_trabajados, 
												nomina_fiscal.p_num_descansos_trabajados, 
												nomina_fiscal.p_total_descansos_trabajados, 
												nomina_fiscal.p_num_horas_extras, 
												nomina_fiscal.p_total_horas_extras, 
												nomina_fiscal.p_num_dias_festivos, 
												nomina_fiscal.p_total_dias_festivos, 
												nomina_fiscal.p_aguinaldo, 
												nomina_fiscal.p_premio_por_puntualidad, 
												nomina_fiscal.p_premio_por_asistencia, 
												nomina_fiscal.p_despensa,
												nomina_fiscal.p_becas_educacionales, 
												nomina_fiscal.p_subsidio_empleo, 
												nomina_fiscal.d_prestamos, 
												nomina_fiscal.d_caja_ahorro, 
												nomina_fiscal.d_fonacot, 
												nomina_fiscal.d_infonavit, 
												nomina_fiscal.d_ISR, 
												nomina_fiscal.d_IMSS, 
												nomina_fiscal.d_descripcion_otras_deducciones, 
												nomina_fiscal.d_total_otras_deducciones, 
												nomina_fiscal.total_nomina_fiscal,
												
											
												empleados.nombre, 
												empleados.ap_paterno, 
												empleados.ap_materno, 
												empleados.no_tarjeta, 
												empleados.curp_empleado, 
												empleados.no_seg_social, 
												empleados.sueldo_diario_imss 
												FROM nomina_fiscal	
												INNER JOIN empleados on nomina_fiscal.id_empleado= empleados.id_empleado
												WHERE nomina_fiscal.id_nomina=$idNomina 
												");
                $consulta->execute();
                //devolvemos la coleccion para que la vista la presente.
                return $consulta;
        }
		public function SqlNominaFiscalEmpleado($idEmpresa,$idNomina,$idEmpleado)
        {
				
                //realizamos la consulta 
                $consulta = $this->db->prepare("
				                                SELECT 
												nomina_fiscal.id_nomina_fiscal, 
												nomina_fiscal.id_nomina, 
												nomina_fiscal.id_empleado, 
												nomina_fiscal.p_sueldo_diario, 
												nomina_fiscal.p_dias_trabajados, 
												nomina_fiscal.p_total_sueldo, 
												nomina_fiscal.p_num_domingos_trabajados,									 
												nomina_fiscal.p_prima_dominical, 
												nomina_fiscal.p_subtotal_domingos-nomina_fiscal.p_prima_dominical as p_subtotal_domingos,
												nomina_fiscal.p_num_vacaciones, 
												nomina_fiscal.p_prima_vacacional,
												nomina_fiscal.p_subtotal_vacaciones-nomina_fiscal.p_prima_vacacional as p_subtotal_vacaciones,	 
												nomina_fiscal.p_num_turnos_trabajados,  
												nomina_fiscal.p_total_turnos_trabajados, 
												nomina_fiscal.p_num_descansos_trabajados, 
												nomina_fiscal.p_total_descansos_trabajados, 
												nomina_fiscal.p_num_horas_extras, 
												nomina_fiscal.p_total_horas_extras, 
												nomina_fiscal.p_num_dias_festivos, 
												nomina_fiscal.p_total_dias_festivos, 
												nomina_fiscal.p_aguinaldo, 
												nomina_fiscal.p_premio_por_puntualidad, 
												nomina_fiscal.p_premio_por_asistencia, 
												nomina_fiscal.p_despensa,
												nomina_fiscal.p_becas_educacionales, 
												nomina_fiscal.p_subsidio_empleo, 
												nomina_fiscal.d_prestamos, 
												nomina_fiscal.d_caja_ahorro, 
												nomina_fiscal.d_fonacot, 
												nomina_fiscal.d_infonavit, 
												nomina_fiscal.d_ISR, 
												nomina_fiscal.d_IMSS, 
												nomina_fiscal.d_descripcion_otras_deducciones, 
												nomina_fiscal.d_total_otras_deducciones, 
												nomina_fiscal.total_nomina_fiscal,
												empleados.nombre, 
												empleados.ap_paterno, 
												empleados.ap_materno, 
												empleados.no_tarjeta, 
												empleados.curp_empleado, 
												empleados.no_seg_social, 
												empleados.sueldo_diario_imss 
												FROM nomina_fiscal	
												INNER JOIN empleados on nomina_fiscal.id_empleado=empleados.id_empleado
												WHERE nomina_fiscal.id_nomina=$idNomina AND nomina_fiscal.id_empleado=$idEmpleado
												");
                $consulta->execute();
                //devolvemos la coleccion para que la vista la presente.
                return $consulta;
        }
		public function TotalRegistros($idEmpresa,$idNomina)
        {
				
                //realizamos la consulta 
                $consulta = $this->db->prepare("
				                                SELECT 
												COUNT(*) AS todo 
												FROM nomina_fiscal		
												WHERE id_nomina= $idNomina ");
                $consulta->execute();
                //devolvemos la coleccion para que la vista la presente.
                return $consulta;
        }	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/* public function TotalRegistros($idEmpresa,$idNomina)
        {
				
                //realizamos la consulta 
                $consulta = $this->db->prepare("SELECT COUNT(*) AS todo FROM percepciones_empleado										
												INNER JOIN deducciones_empleado on  percepciones_empleado.id_empleado= deducciones_empleado.id_empleado
												INNER JOIN empleados on  percepciones_empleado.id_empleado= empleados.id_empleado
												WHERE  percepciones_empleado.id_nomina= $idNomina AND percepciones_empleado.id_empresa= $idEmpresa AND  deducciones_empleado.id_nomina= $idNomina ");
                $consulta->execute();
                //devolvemos la coleccion para que la vista la presente.
                return $consulta;
        }	 */	
}
?>
