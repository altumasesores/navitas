<?php

//echo "NominaController cargado<br/>";

error_reporting(0);

class NominaAdminController extends ControllerBase

{	

	public function model()

	{

		

		$this->ModeloNomina = new ModelNominaAdmin();

		

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
		//$data['razon_social']="";
		$data['tipoUSR']=$tipoUSR;
		
		$this->view->show("elfinder.php", $data,"mod_articulosFolder");	
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

	

	public function vistaPrincipal($id_usuario=""){		
		
		$data['id_usr']=$id_usuario;		

		$this->view->show("vistaPrincipal.php", $data,"viewsFolder");	

		}

		

	public function ventanaEmergente($_POST)

	{

		$ventana=$_POST['ventanaEmergente'];

		$data['parametros']=$_POST;

		$this->view->show($ventana, $data,"viewsFolder");

		

		}

		

	public function consultarEmpresasXUsuario($_POST)

	{

		

		$id_usuario=$_POST['id_usuario'];

		$id_empresa=$_POST['id_empresa'];

		$data['id_usuario']=$id_usuario;			

		$data['id_empresa']=$id_empresa;

		$datosEmpresaXUsuario=$this->ModeloNomina->consultarEmpresasXUsuario($id_usuario);	

		

		$data['empresas']=$datosEmpresaXUsuario;

						

		//Finalmente presentamos nuestra plantilla

		$this->view->show("listaEmpresas.php", $data,"viewsFolder");	

		

	}

	

	public function consultarNominasXEmpresaProceso($_POST)

	{

		$id_empresa=$_POST['id_empresa'];

		if($id_empresa!='')

		{

			$this->consultarNominasXEmpresa($_POST);

			} else{ 

			$this->consultarTodasNominasXProceso();

			}	

	}

	

	public function consultarNominasXEmpresa($_POST){

		$id_empresa=$_POST['id_empresa'];	

		$listaNominas=$this->ModeloNomina->consultarNominasXEmpresa($id_empresa);

		

		$data['listaNominas']=$listaNominas;

		

		//Finalmente presentamos nuestra plantilla

		$this->view->show("nominas_empresa.php", $data,"viewsFolder");

		}

	public function consultarTodasNominasXProceso(){

		

		$listaNominas=$this->ModeloNomina->consultarTodasNominasXProceso();		

		$data['listaNominas']=$listaNominas;

		

		//Finalmente presentamos nuestra plantilla

		$this->view->show("nominas_consultar_periodo.php", $data,"viewsFolder");	

		}

	/************************************VISTA NOMINA************************************************************/

	public function consultarNominaXIdNomina($_POST){		

		$id_nomina=$_POST['id_nomina'];

		$id_empresa=$_POST['id_empresa'];

		

		$detallesNomina=$this->ModeloNomina->consultarDetallesNominaXId($id_nomina);	

		$detallesEmpresa=$this->ModeloNomina->consultardetallesEmpresaXId($id_empresa);

		$numeroAfiliadosImss=$this->ModeloNomina->consultarNumeroEmpleadosAfiliadosImss($id_nomina,$id_empresa);

		$listaEmpleadosFueraDeNomina=$this->ModeloNomina->consultarEmpleadosFueraDeNomina($id_nomina,$id_empresa);

		

		$detallesNominaNatural=$this->ModeloNomina->consultarDetallesNominaEmpleados($id_nomina,$id_empresa);

		$numeroEmpleadosAfiliadosImss=$numeroAfiliadosImss->fetch();

		$numeroEmpleadosEnNomina=$detallesNominaNatural->rowCount();

		$detallesNominaDepurada=$detallesNominaNatural->fetchall(PDO::FETCH_ASSOC);

		$detallesEmpleadosCompleto=array();

		$totalesNomina=array();

		

		

		

		foreach($detallesNominaDepurada as $posicion=>$empleado)//gira n empleados	(gira 8 veces)

		{

		    

			$id_empleado=$empleado['id_empleado'];

			$detallesNominaFiscal=$this->ModeloNomina->consultarDetallesNominaFiscalEmpleados($id_nomina,$id_empleado);

			$totalesNominas=$this->ModeloNomina->consultarTotalNominaEmpleadoXIdNomina($id_nomina,$id_empleado);

			$totalNomina=$totalesNominas->fetch(PDO::FETCH_ASSOC);

			$detallesNominaFiscalDepurada=$detallesNominaFiscal->fetchall(PDO::FETCH_ASSOC);

			$detallesEmpleadosCompleto[$posicion]=array();

			

			

			foreach($empleado as $nombreCampo=>$valor)//gira n atributos (gira 33 veces)

			{

				/*

				$a[0]=array("nombre"=>"juan","apellido_p"=>"perez","apellido_m"=>"martinez");.....n

				$a[1]=array("nombre"=>"jose","apellido_p"=>"gonzalez","apellido_m"=>"zamora");.....n

				.

				.

				.

				n

				*/

				

				$detallesEmpleadosCompleto[$posicion][$nombreCampo]=$valor;

				}

				

			

			foreach($detallesNominaFiscalDepurada as $posicionFiscal=>$empleadoFiscal)

			{				

				foreach($empleadoFiscal as $nombreCampoFiscal=>$valorFiscal)

				{

					$detallesEmpleadosCompleto[$posicion][$nombreCampoFiscal]=$valorFiscal;	

					}

				}

				

				

				/*EXTRAER Y CALCULAR*/			

				$percepcionEmpleado=$totalNomina['percepciones'];

				$percepcionesFiscalEmpleado=$totalNomina['percepciones_fiscales'];

				$deduccionEmpleado=$totalNomina['deducciones'];

				$deduccionesFiscalEmpleado=$totalNomina['deducciones_fiscales'];

				$totalNominaEmpleado=$percepcionEmpleado-$deduccionEmpleado;

				$totalNominaFiscalEmpleado=$percepcionesFiscalEmpleado-$deduccionesFiscalEmpleado;

				

				/*ASIGNAR EN LA CONSULTA [ARRAY]*/

				

				$detallesEmpleadosCompleto[$posicion]['totalPercepcionesEmpleado']=redondear($percepcionEmpleado);

				$detallesEmpleadosCompleto[$posicion]['totalPercepcionesFiscalEmpleado']=redondear($percepcionesFiscalEmpleado);

				$detallesEmpleadosCompleto[$posicion]['totalDeduccionesEmpleado']=redondear($deduccionEmpleado);

				$detallesEmpleadosCompleto[$posicion]['totalDeduccionesFiscalEmpleado']=redondear($deduccionesFiscalEmpleado);

				$detallesEmpleadosCompleto[$posicion]['totalNominaEmpleado']=redondear($totalNominaEmpleado);

				$detallesEmpleadosCompleto[$posicion]['totalNominaFiscalEmpleado']=redondear($totalNominaFiscalEmpleado);	

				

				/*CALCULAR TOTALES DE NOMINA*/

				

				$totalPercepciones+=$percepcionEmpleado;

				$totalPercepcionesFiscal+=$percepcionesFiscalEmpleado;

				$totalDeducciones+=$deduccionEmpleado;

				$totalDeduccionesFiscal+=$deduccionesFiscalEmpleado;

				$TotalNomina+=$totalNominaEmpleado;

				$TotalNominaFiscal+=$totalNominaFiscalEmpleado;

				

				

			}//foreach principal

			

			/*ASIGANR TOTALES FINALES A CONSULTA [ARRAY]*/

			

			$totalesNomina['TOTALPERCEPCIONES']=redondear($totalPercepciones);

			$totalesNomina['TOTALPERCEPCIONESFISCAL']=redondear($totalPercepcionesFiscal);

			$totalesNomina['TOTALDEDUCCIONES']=redondear($totalDeducciones);

			$totalesNomina['TOTALDEDUCCIONESFISCAL']=redondear($totalDeduccionesFiscal);

			$totalesNomina['TOTALNOMINANORMAL']=redondear($TotalNomina);

			$totalesNomina['TOTALNOMINAFISCAL']=redondear($TotalNominaFiscal);

			

			

		

		

		

		$data['detallesNomina']=$detallesNomina;

		$data['detallesEmpresa']=$detallesEmpresa;

		$data['empleadosFueraNomina']=$listaEmpleadosFueraDeNomina;

		$data['datosEmpleados']=$detallesEmpleadosCompleto;

		$data['totalesNomina']=$totalesNomina;

		

		$data['numeroEmpleados']=$numeroEmpleadosEnNomina;

		$data['numeroEmpleadosAfiliados']=$numeroEmpleadosAfiliadosImss['numero'];

		

		$data['id_nomina']=$id_nomina;

		$data['id_empresa']=$id_empresa;

		

		

		

		//Finalmente presentamos nuestra plantilla

	    $this->view->show("nominas_empresa_empleados.php", $data,"viewsFolder");	

		}

	

	public function eliminarNominaXIdNomina($_POST){

		

		$id_nomina=$_POST['id_nomina'];		

		$this->ModeloNomina->eliminarNominaXIdNomina($id_nomina);

		

		$this->vistaPrincipal($_POST['id_usuario']);

		

		

		}	

		

	public function agregarEmpleadoNuevo($_POST)

	{

		$id_empleado=$_POST['id_empleado'];

		$id_empresa=$_POST['id_empresa'];

		$id_nomina=$_POST['id_nomina'];

		

		$detallesEmpleado=$this->ModeloNomina->consultarEmpleadoXId($id_empleado);

		$empleado=$detallesEmpleado->fetch();

		

		$sueldoDiario=redondear($empleado['sueldo_diario']);		

		$sueldoFiscal=redondear($empleado['sueldo_diario_imss']/1.0452);

		

		

		$this->ModeloNomina->guardarDatosNominaNormalNuevaPercepciones($id_nomina,$id_empresa,$id_empleado,$sueldoDiario);

		$this->ModeloNomina->guardarDatosNominaNormalNuevaDeducciones($id_nomina,$id_empresa,$id_empleado);

		$this->ModeloNomina->guardarDatosNominaFiscalNueva($id_nomina,$id_empleado,$sueldoFiscal);

		

		$this->consultarNominaXIdNomina($_POST);

		

		

		}

		

	

	public function modificarNomina($_POST)

	{

		

		echo "<script>alert('estado: $_POST[estado]')</script>";

		

		$id_usuario=$_POST['id_usuario'];		

		$this->ModeloNomina->modificarNomina($_POST);		

		$this->vistaPrincipal($id_usuario);



		}

		

	public function eliminarEmpleadoDeNomina($_POST)

	{

		$id_empresa=$_POST['id_empresa'];

		$id_nomina=$_POST['id_nomina'];

		$id_empleado=$_POST['id_empleado'];

		

		$this->ModeloNomina->eliminarEmpleadoDeNomina($id_empresa,$id_nomina,$id_empleado);		

		$this->RECALCULARTotalesXEmpleadoEliminado($_POST);

		}

	public function RECALCULARTotalesXEmpleadoEliminado($_POST)

	{

		$id_empresa=$_POST['id_empresa'];

		$id_nomina=$_POST['id_nomina'];

		$id_empleado=$_POST['id_empleado'];		

		

		

		$totalesNominas=$this->ModeloNomina->RECALCULARTotalesXEmpleadoEliminado($id_empresa,$id_nomina);

		$totalNomina=$totalesNominas->fetch(PDO::FETCH_ASSOC);

		$percepciones=$totalNomina['percepciones'];

		

		$totalesNomina=$this->ModeloNomina->consultarDetallesNominaXId($id_nomina);

		$totales=$totalesNomina->fetch(PDO::FETCH_ASSOC);		

		$relativos=$totales['relativos'];

		

		$totalesEmpresas=$this->ModeloNomina->consultarDetallesEmpresaXId($id_empresa);

		$totalEmpresa=$totalesEmpresas->fetch(PDO::FETCH_ASSOC);

		$honorarios=$totalEmpresa['honorarios'];

		$iva=$totalEmpresa['iva'];

		

		/*HONORARIOS*/		

		$honorarios=$honorarios/100;

		$honorarios=$percepciones*$honorarios;

		

		/*SUBTOTAL*/

		$subtotal=$percepciones+$honorarios+$relativos;

		

		/*IVA*/

		$iva=$iva/100;

		$iva=$subtotal*$iva;

		

		/*FACTURA*/

	    $total_factura=$subtotal+$iva;

		

		$this->ModeloNomina->modificarTotalesNominaXEmpleadoEliminado($id_empresa,$id_nomina,$percepciones,$honorarios,$relativos,$subtotal,$iva,$total_factura);

		

		}

	

	

	

	

}









?>