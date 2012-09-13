<?php

class VARFReport extends Report
{	
	public function GetRequestForm()
	{
		$form = new HtmlElement('form');
		$br = new HtmlElement("br", true);
		
		$cal1 = new JSCalendar("f1-input", "Fecha de inicio");
		$cal2 = new JSCalendar("f2-input", "Fecha final");
		
		$submit = new JSButton("Validate.VentasArticulos()");
		
		$form->AppendChild($cal1->GetDiv());
		$form->AppendChild($cal2->GetDiv());
		$form->AppendChild($submit->GetButton());
		
		return $form;
	}
	
	protected function GetData($params)
	{
		$table = new HtmlElement('table');
		$start = new Date($params['sYear'], $params['sMonth'], $params['sDate']);
		$end = new Date($params['eYear'], $params['eMonth'], $params['eDate']);
		
		$sql = "select t2.vendidos, ca.nombre_articulo, ca.codigo_barras, t2.importe_total, t2.iva, (t2.importe_total + t2.iva) as total, t2.id_articulo from (select count(t1.id_articulo) as vendidos, t1.id_articulo, sum(t1.importe) as importe_total, sum(t1.importe * (iva / 100)) as iva from (select id_articulo, (cantidad * precio - cantidad * precio * (descuento_articulo / 100) - cantidad * precio * (descuento_cliente / 100)) as importe, iva from ventas_articulos va inner join (select id_venta from ventas where estado_venta = 'activo' and fecha_venta between ? and ?) v on va.id_venta = v.id_venta) t1 group by t1.id_articulo) t2 inner join catalogo_articulos ca on ca.id_articulo = t2.id_articulo order by t2.vendidos desc";
		
		$pdo = DextraPDO::GetInstance();
		$query = $pdo->prepare($sql);
		$query->execute(array(Date::GetMySQLString($start), Date::GetMySQLString($end)));
		
		$rows = $query->fetchAll();
		DextraPDO::Close();
		
		return $rows;
	}
	
	public function GetDisplayTable($params)
	{
		$data = $this->GetData($params);		
		$titles = array("C&oacute;digo", "Art&iacute;culo", "Vendidos", "Importe", "IVA", "Total", "Detalle");
		$columns = array("codigo_barras", "nombre_articulo", "vendidos", "importe_total", "iva", "total");
		
		$table = new ReportTable($data, $columns, $titles);
		$table->SetColumnOperation("vendidos", ReportTable::COUNT);
		foreach(array("importe_total", "iva", "total") as $total)
		{
			$table->SetColumnOperation($total, ReportTable::SUM);
			$table->SetColumnType($total, ReportTable::CURRENCY);
		}
		
		//Solución cochina!!!! NECESITO CLOSURES AND PHP 5.3
		$urlc = new URLMaker("/reportes/controller.php", true);
			foreach($params as $param => $val)
				$urlc->AddParam($param, $val);
			$urlc->AddParam("report", "dvaf");
			$urlc->AddParam("action", "pdf");			
		$callback = create_function('$row', '
			$a = new HtmlElement("a", false, "Ver");
			$url = "' . (string) $urlc . '";
			$url .= "&productId=" . $row["id_articulo"];
			$url .= "&productName=" . base64_encode($row["nombre_articulo"]);
			$a->SetAttribute("href", $url);
			$a->SetAttribute("target", "_blank");
			return (string) $a;');
		//TERMINA SOLUCIÓN COCHINA!!!!
		
		$table->AddExtraColumn("Link", $callback);
		
		$rprt = new DextraHTMLReport();
		$rprt->SetTable($table);
		
		return $rprt->GenerateReport();
	}
	
	public function GetPDF($params)
	{
		$data = $this->GetData($params);
		$start = new Date($params['sYear'], $params['sMonth'], $params['sDate']);
		$end = new Date($params['eYear'], $params['eMonth'], $params['eDate']);
		
		$rprt = new DextraPDFReport("Venta de artículos por fecha");
		$rprt->AddField("Fecha Inicio", (string) $start);
		$rprt->AddField("Fecha Fin", (string) $end);
		$almacen = DextraDB::GetByKey(DextraDB::ALMACEN, $_SESSION["id_almacen"]);
		$rprt->AddField("Almacén", $almacen["nombre_almacen"]);
		
		$titles = array("Código", "Artículo", "Vendidos", "Importe", "IVA", "Total");
		$columns = array("codigo_barras", "nombre_articulo", "vendidos", "importe_total", "iva", "total");
		$widths = array(0.15, 0.45, 0.1, 0.1, 0.1, 0.1);
		$table = new PDFReportTable($data, $columns, $titles);
		
		foreach(array("importe_total", "iva", "total") as $col)
		{
			$table->SetColumnOperation($col, ReportTable::SUM);
			$table->SetColumnType($col, ReportTable::CURRENCY);
		}
		$table->SetColumnOperation("vendidos", ReportTable::COUNT);
		for($i = 0; $i < count($columns); $i++)
			$table->SetColumnWidth($columns[$i], $widths[$i]);

		$rprt->SetTable($table);
		$rprt->SetAuthor($_SESSION['usuario']);
		
		$pdf = $rprt->GenerateDocument();
		$pdf->Output();
	}
}

?>