<?php

class VAPFReport extends Report
{
	public function GetRequestForm()
	{
	}
	
	public function GetDisplayTable($params)
	{
		$data = $this->GetData($params);
		$titles = array("Venta", "Fecha", "Afiliado", "Importe", "IVA", "Total");
		$columns = array("id_venta", "fecha_venta", "nombre_afiliado", "importe", "iva", "total");
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
		$urlc->AddParam("report", "dv");
		$urlc->AddParam("action", "display");			
		$callback = create_function('$row', '
		$a = new HtmlElement("a", false, "Ver");
		$url = "' . (string) $urlc . '";
		$url .= "&ventaId=" . $row["id_venta"];
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
		
		$titles = array("Venta", "Fecha", "Afiliado", "Importe", "IVA", "Total");
		$columns = array("id_venta", "fecha_venta", "nombre_afiliado", "importe", "iva", "total");
		$widths = array(0.10, 0.15, 0.25, 0.15, 0.15, 0.15);
		$table = new PDFReportTable($data, $columns, $titles, $widths);
		foreach(array("importe", "iva", "total") as $col)
		{
			$table->SetColumnOperation($col, ReportTable::SUM);
			$table->SetColumnType($col, ReportTable::CURRENCY);
		}
		$table->SetColumnOperation("id_venta", ReportTable::COUNT);
		
		$rprt = new DextraPDFReport("Ventas a clientes por fecha");
		$rprt->AddField("Fecha Inicio:", (string) $start);
		$rprt->AddField("Fecha Fin:", (string) $end);
		$almacen = DextraDB::GetByKey(DextraDB::ALMACEN, $_SESSION['id_almacen']);
		$rprt->AddField("Almacén:", $almacen["nombre_almacen"]);
			
		$rprt->SetTable($table);
		$rprt->SetAuthor($_SESSION['usuario']);
				
		$pdf = $rprt->GenerateDocument();
		$pdf->Output();
	}
	
	protected function GetData($params)
	{
		$start = $params['sYear'] . "/" . $params['sMonth'] . "/" . $params['sDate'];
		$end = $params['eYear'] . "/" . $params['eMonth'] . "/" . $params['eDate'];
		$clienteId = $params['clienteId'];
		
		$pdo = DextraPDO::GetInstance();
		$sql = "select t1.id_venta, t1.importe, t1.iva, t1.total, a.nombre_afiliado, t1.fecha_venta from (select vcd.id_venta, sum(vcd.importe) as importe, sum(vcd.importe * vcd.iva) as iva, sum(vcd.importe + vcd.importe * vcd.iva) as total, v.id_afiliado, v.fecha_venta from (select id_venta, (cantidad * precio) - (cantidad * precio * descuento_articulo / 100) - (cantidad * precio * descuento_cliente / 100) as importe, iva / 100 as iva from ventas_articulos) vcd inner join ventas v on vcd.id_venta = v.id_venta where v.id_cliente = ? and v.estado_venta = 'activo' and fecha_venta between ? and ? group by v.id_venta) t1 inner join afiliados a where a.id_afiliado = t1.id_afiliado";
		$query = $pdo->prepare($sql);
		$query->execute(array($clienteId, $start, $end));
		
		$data = $query->fetchAll();
		DextraPDO::Close();
		
		return $data;
	}
}

?>