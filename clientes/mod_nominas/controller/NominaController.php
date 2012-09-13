<?php

//echo "NominaController cargado<br/>";

error_reporting(0);

class NominaController extends ControllerBase

{	

	public function model()

	{

		

		$this->ModeloNomina = new ModelNomina();

		

	}
	
	public function cargarUPLOAD($_POST)
	{
		//cargar los datos a evaluar en el plugin.
		$id_usuario=$_POST['id_usuario'];
		$empresas=$this->ModeloNomina->consultarEmpresasDeUsuario($id_usuario);
		$usuarios=$this->ModeloNomina->consultarUsuario($id_usuario);
		$empresa=$empresas->fetch();
		$usuario=$usuarios->fetch();
		$razon_social=$empresa['razon_social'];
		$tipoUSR=$usuario['tipo'];
		$data['razon_social']=$razon_social."/";
		$data['tipoUSR']=$tipoUSR;
		
		$this->view->show("elfinder.php", $data,"mod_articulosFolder");	
		}

	

	public function vistaPrincipal($id_usuario=""){

		$data['id_usr']=$id_usuario;		

		$this->view->show("vistaPrincipal.php", $data,"viewsFolder");	

		}

	public function consultarNominasXEmpresa()

	{

		$id_usuario=$_POST['id_usuario'];

		$data['id_usuario']=$id_usuario;			

		$datosEmpresaXUsuario=$this->ModeloNomina->consultarEmpresaXUsuario($id_usuario);		

		

		$row_empresas=$datosEmpresaXUsuario->fetch();

		$id_empresa=$row_empresas['id_empresa'];					

		$data['id_empresa']=$id_empresa;

		$data['razon_social']= $row_empresas['razon_social'];

		$data['titular']= $row_empresas['titular'];

		

		$datosEmpresaXId=$this->ModeloNomina->consultarEmpresaXId($id_empresa);

		$listaNominasXEmpresa=$this->ModeloNomina->consultarNominasXEmpresa($id_empresa);

				

		while ($row_empresa = $datosEmpresaXId->fetch())

		{

			$data['iva']=	$row_empresa['iva'];

			$data['honorarios']=	$row_empresa['honorarios'];

			}	

			

		$data['listaNominas']=$listaNominasXEmpresa;

		//Finalmente presentamos nuestra plantilla

		$this->view->show("consultar_nominas.php", $data,"viewsFolder");		

		

	}

	

	public function consultarNominaEmpresa($_POST)

	{

		$id_nomina=$_POST['id_nomina'];

		$id_empresa=$_POST['id_empresa'];

		$id_usuario=$_POST['id_usuario'];

		$datosEmpresaXId=$this->ModeloNomina->consultarEmpresaXId($id_empresa);

		$datosNominaXId=$this->ModeloNomina->consultarNominaXId($id_nomina);

		$datosNominaEmpleados=$this->ModeloNomina->consultarNominaEmpleadosEmpresa($id_nomina,$id_empresa);

		

		$data['datosEmpresaXId']=$datosEmpresaXId;

		$data['datosNominaXId']=$datosNominaXId;

		$data['datosNominaEmpleados']=$datosNominaEmpleados;

		$data['id_usuario']=$id_usuario;

		$data['id_nomina']=$id_nomina;

		$data['id_empresa']=$id_empresa;

		

		$this->view->show("cargar_nomina.php", $data,"viewsFolder");

	}

	

	public function seleccionarPeriodo($_POST)

	{

		$data['id_usuario']=$_POST['id_usuario'];

		$this->view->show("seleccionarPeriodo.php",$data,"viewsFolder");

		}

		

	public function cargarNuevaNominaClienteXPeriodo($_POST)

	{

		$id_usuario=$_POST['id_usuario'];

		$periodo = $_POST['periodo'];

			

		$datosEmpresaXUsuario=$this->ModeloNomina->consultarEmpresaXUsuario($id_usuario);

		$datos_empresa=$datosEmpresaXUsuario->fetch();

		$id_empresa=$datos_empresa['id_empresa'];	

		

		$datosEmpresaXId=$this->ModeloNomina->consultarEmpresaXId($id_empresa);

		$datosEmpleadosEmpresaXPeriodo=$this->ModeloNomina->consultarEmpleadosEmpresaXPeriodo($id_empresa, $periodo);

		$datosEmpleadosEmpresaPeriodoXImss=$this->ModeloNomina->consultarEmpleadosEmpresaPeriodoXImss($id_empresa, $periodo);

		

		$detallesEmpresa=$datosEmpresaXId->fetch();

		$iva=$detallesEmpresa['iva'];

		$honorarios=$detallesEmpresa['honorarios'];

		

		$data['periodo']=$periodo;	

		$data['iva']=$iva;		

		$data['id_empresa']=$id_empresa;	

		$data['honorarios']=$honorarios;	

		$data['datosEmpleados']=$datosEmpleadosEmpresaXPeriodo;		

		$data['cantidadEmpleados']=$datosEmpleadosEmpresaXPeriodo->rowCount();

		$data['cantidadEmpleadosImss']=$datosEmpleadosEmpresaPeriodoXImss->rowCount();

		$data['inicio_periodo']=$_POST['inicio_periodo'];

		$data['fin_periodo']=$_POST['fin_periodo'];

		

		//Finalmente presentamos nuestra plantilla

		$this->view->show("nuevaNominaClienteXPeriodo.php", $data,"viewsFolder");		

		}

	

	public function ventanaEmergente($_POST)

	{

		$ventana=$_POST['ventanaEmergente'];

		$data['parametros']=$_POST;

		$this->view->show($ventana, $data,"viewsFolder");

		

		}

	

	public function calcularISR($_POST)

	{

		$totalSueldoImss=$_POST['totalSueldoImss'];

		$tipoNomina=$_POST['tipoNomina'];		

		$ISR=$this->ModeloNomina->calcularISR($totalSueldoImss,$tipoNomina);

		echo $ISR;

		}

	

	public function calcularSubsidioEmpleo($_POST)

	{

		$totalSueldoImss=$_POST['totalSueldoImss'];		

		$tipoNomina=$_POST['tipoNomina'];

		$subsidioEmpleo=$this->ModeloNomina->calcularSubsidioEmpleo($totalSueldoImss,$tipoNomina);

		if($subsidioEmpleo==""){

			if($totalSueldoImss>1699.89){

				$subsidioEmpleo=0;

				}

			}

		echo $subsidioEmpleo;

		}

	

	public function calcularIMSS($_POST)

	{

		$totalSueldoImssIntegrado=$_POST['totalSueldoImssIntegrado'];

		$factorIntegracion=$_POST['factorIntegracion'];

		$cuotaTrabajador=$_POST['cuotaTrabajador'];

		$IMSS=$this->ModeloNomina->calcularIMSS($totalSueldoImssIntegrado,$factorIntegracion,$cuotaTrabajador);

		echo $IMSS;



		}

		

	public function guardarNominaNueva($_POST){
		
		
	


	$this->ModeloNomina->guardarNominaNueva($_POST);	

	$id_usuario=$_POST['id_usuario'];


	$this->vistaPrincipal($id_usuario);

	

	

	}

	

	public function enviarCorreo($_POST)

	{

		$id_empresa=$_POST['id_empresa'];

		$DetallesEmpresas=$this->ModeloNomina->consultarEmpresaXId($id_empresa);

		$Correos=$this->ModeloNomina->consultarCorreosUsuarios($id_empresa);		

		$Empresa=$DetallesEmpresas->fetch();

		

		//$data['razon_social']= $Empresa['razon_social'];	

		$data['id_empresa']= $_POST['id_empresa'];	

		$data['inicio_periodo']= $_POST['inicio_periodo'];	

		$data['fin_periodo']= $_POST['fin_periodo'];

		$data['periodo_nomina']= strtoupper($_POST['periodo_nomina']);

		

		$json=array(

		"razon_social"=>$Empresa['razon_social'],

		""

		);

		$data['Correos']=$Correos;		



		

		//Finalmente presentamos nuestra plantilla

		$this->view->show("correo_prenomina.php", $data,"viewsFolder");

		}

	

	

}

?>