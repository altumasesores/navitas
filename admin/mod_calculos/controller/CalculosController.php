<?php

class CalculosController extends ControllerBase{	

	public function model(){	

		$this->Modelo = new ModelCalculos();

		$this->ModeloCalculos = new ModelCalculosDatos();
	}

	

	public function CargarNomina($_POST){

		$data['id_nomina'] = $_POST['id_nomina'];

		$data['id_empresa'] =$_POST['id_empresa'];

		//Finalmente presentamos nuestra plantilla

		$this->view->show("nominas_empresa_empleados.php", $data,"../admin/");

	}



	public function EliminarNominaFiscal($_POST){

		$idNomina= $_POST['id_nomina'];

		$data['id_nomina'] = $idNomina;

		$data['id_empresa'] =$_POST['id_empresa'];

		//Finalmente presentamos nuestra plantilla

		$listado=$this->Modelo->EliminareNominaFiscal($idNomina);

		//$this->view->show("nominas_empresa_empleados.php", $data,"../admin/");

	}

	

	public function CargarNominaCliente($_POST){ //movido al nuevo mvc [seleccionarPeriodo.php][nuevaNominaClienteXPeriodo.php]

		$data['periodo'] = $_POST['periodo'];
		//Finalmente presentamos nuestra plantilla

		$this->view->show("enviar_nomina.php", $data,"viewsclients");
	}

	

	public function calcular_neto_pagar($id_empleado,$id_nomina){

		$listado=$this->Modelo->NetoPagar($id_empleado,$id_nomina);
	}

	

	public function CalcularCalculos($salario,$periodo){

		$listado=$this->Modelo->getISR($salario,$periodo);

		echo $listado;
	}

	

	public function NominaFiscal($idNomina,$idEmpresa,$TipoNomina)

	{

		$listado1=$this->ModeloCalculos->ConsultarDatosNomina($idNomina);

		$listado2=$this->ModeloCalculos->ConsultarNominaFiscal($idEmpresa,$idNomina);

		

		$data['DatosNomina'] = $listado1;

		$data['EmpleadosNomina'] = $listado2;

	

		//Finalmente presentamos nuestra plantilla

		$this->view->show("listar_nomina_fiscal.php", $data,"viewsFolder");

	}

	

	public function calcular($idNomina,$tipo_nomina,$sueldo_integrado,$dias_trabajados){

		$listado=$this->Modelo->ConsultarPeriodoNomina($idNomina,$tipo_nomina,$sueldo_integrado,$dias_trabajados);

		echo $listado;
	}



	public function ElimEmpleado($id_empleado,$id_empresa,$idNomina){

		$listado=$this->Modelo->EliminarEmpleadoNominaFiscal($id_empleado,$id_empresa,$idNomina);

	}

}

?>