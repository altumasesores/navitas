<?php

class VCPFReport extends Report
{
	public function GetRequestForm()
	{
		$form = new HtmlElement('form');
		$br = new HtmlElement("br", true);
		
		$cal1 = new JSCalendar("f1-input", "Fecha de Inicio");
		$cal2 = new JSCalendar("f2-input", "Fecha Final");
		
		$submit = new JSButton("Validate.VentasClientes()");
		
		$form->AppendChild($cal1->GetDiv());
		$form->AppendChild($cal2->GetDiv());
		$form->AppendChild($submit->GetButton());
		
		return $form;
	}
	
	public function GetDisplayTable($params)
	{
		$data = $this->GetData($params);
		$titles = array("Cliente", "Importe", "IVA", "Total");
		$columns = array("razon_social", "importe", "iva", "total");
		$table = new ReportTable($data, $columns, $titles);
		foreach(array("importe", "iva", "total") as $col)
		{
			$table->SetColumnOperation($col, ReportTable::SUM);
			$table->SetColumnType($col, ReportTable::CURRENCY);
		}
		$table->SetColumnOperation("id_venta", ReportTable::COUNT);
		
		//Solución cochina!!!! NECESITO CLOSURES AND PHP 5.3
		$urlc = new URLMaker("/reportes/controller.php", true);
			foreach($params as $param => $val)
				$urlc->AddParam($param, $val);
			$urlc->AddParam("report", "vapf");
			$urlc->AddParam("action", "display");			
		$callback = create_function('$row', '
			$a = new HtmlElement("a", false, "Ver");
			$url = "' . (string) $urlc . '";
			$url .= "&clienteId=" . $row["id_cliente"];
			$a->SetAttribute("onclick", "Page.MakeControllerRequest(\'" . $url . "\')");
			return (string) $a;');
		//TERMINA SOLUCIÓN COCHINA!!!!
		
		$table->AddExtraColumn("Detalles", $callback);
		
		$rprt = new DextraHTMLReport();
		$rprt->SetTable($table);
		return $rprt->GenerateReport();
	}
	
	public function GetPDF($params)
	{
		$data = $this->GetData($params);
		$start = new Date($params['sYear'], $params['sMonth'], $params['sDate']);
		$end = new Date($params['eYear'], $params['eMonth'], $params['eDate']);
		
		$rprt = new DextraPDFReport("Ventas a clientes por fecha");
		$rprt->AddField("Fecha Inicio:", (string) $start);
		$rprt->AddField("Fecha Fin:", (string) $end);
		$almacen = DextraDB::GetByKey(DextraDB::ALMACEN, $_SESSION['id_almacen']);
		$rprt->AddField("Almacén:", $almacen["nombre_almacen"]);
		
		$titles = array("Cliente", "Importe", "IVA", "Total");
		$columns = array("razon_social", "importe", "iva", "total");
		$widths = array(0.25, 0.15, 0.15, 0.15);
		$table = new PDFReportTable($data, $columns, $titles, $widths);
		foreach(array("importe", "iva", "total") as $col)
		{
			$table->SetColumnOperation($col, ReportTable::SUM);
			$table->SetColumnType($col, ReportTable::CURRENCY);
		}
		$table->SetColumnOperation("id_venta", ReportTable::COUNT);
			
		$rprt->SetTable($table);
		$rprt->SetAuthor($_SESSION['usuario']);
				
		$pdf = $rprt->GenerateDocument();
		$pdf->Output();
	}
	
	protected function GetData($params)
	{
		$start = $params['sYear'] . "/" . $params['sMonth'] . "/" . $params['sDate'];
		$end = $params['eYear'] . "/" . $params['eMonth'] . "/" . $params['eDate'];
		
		$pdo = DextraPDO::GetInstance();
		$sql = "select c.razon_social, t1.importe, t1.iva, t1.total, t1.id_cliente from (select sum(va.importe) as importe, sum(va.iva) as iva, sum(va.total) as total, v.id_cliente from ventas v inner join (select vcd.id_venta, vcd.importe, vcd.importe * vcd.iva as iva, vcd.importe + vcd.importe * vcd.iva as total from (select id_venta, (cantidad * precio) - (cantidad * precio * descuento_articulo / 100) - (cantidad * precio * descuento_cliente / 100) as importe, iva / 100 as iva from ventas_articulos) vcd) va on v.id_venta = va.id_venta where v.estado_venta = 'activo' and v.fecha_venta between ? and ? group by v.id_cliente) t1 inner join clientes c on t1.id_cliente = c.id_cliente;";
		$query = $pdo->prepare($sql);
		$query->execute(array($start, $end));
		
		$data = $query->fetchAll();
		DextraPDO::Close();
		
		return $data;
	}
}

?>