<?php

class VGRFReport extends Report
{	
	public function GetRequestForm()
	{
		$form = new HtmlElement('form');
		$br = new HtmlElement("br", true);
		
		$cal1 = new JSCalendar("f1-input", "Fecha de Inicio");
		$cal2 = new JSCalendar("f2-input", "Fecha Final");
		
		$submit = new JSButton("Validate.VentasGenerales()");
		
		$form->AppendChild($cal1->GetDiv());
		$form->AppendChild($cal2->GetDiv());
		$form->AppendChild($submit->GetButton());
		
		return $form;
	}
	
	public function GetDisplayTable($params)
	{
		$data = $this->GetData($params);
		$titles = array("Venta", "Fecha", "Total", "Usuario");
		$columns = array("id_venta", "fecha_venta", "total", "usuario");
		$table = new ReportTable($data, $columns, $titles);
		$table->SetColumnOperation("total", ReportTable::SUM);
		$table->SetColumnOperation("id_venta", ReportTable::COUNT);
		$table->SetColumnType("total", ReportTable::CURRENCY);
		
		$rprt = new DextraHTMLReport();
		$rprt->SetTable($table);
		return $rprt->GenerateReport();
	}
	
	protected function GetData($params)
	{
		$start = $params['sYear'] . "/" . $params['sMonth'] . "/" . $params['sDate'];
		$end = $params['eYear'] . "/" . $params['eMonth'] . "/" . $params['eDate'];
		
		$pdo = DextraPDO::GetInstance();
		$sql = "select t1.id_venta, t1.fecha_venta, (t1.total + t1.total * (t1.iva / 100)) as total, u.usuario from (select v.id_venta, v.fecha_venta, va.total, va.iva, v.id_usuario from (select * from ventas where estado_venta = 'activo' and fecha_venta between ? and ?) v inner join (select id_venta, sum(cantidad * precio - cantidad * precio * (descuento_articulo / 100) - cantidad * precio * (descuento_cliente / 100)) as total, iva from ventas_articulos group by id_venta) va on v.id_venta = va.id_venta) t1 inner join usuarios u on u.id_usuario = t1.id_usuario";
		$query = $pdo->prepare($sql);
		$query->execute(array($start, $end));
		
		$data = $query->fetchAll();
		DextraPDO::Close();
		
		return $data;
	}
	
	public function GetPDF($params)
	{
		$data = $this->GetData($params);
		$start = new Date($params['sYear'], $params['sMonth'], $params['sDate']);
		$end = new Date($params['eYear'], $params['eMonth'], $params['eDate']);
		
		$rprt = new DextraPDFReport("Ventas generales por fecha");
		$rprt->AddField("Fecha Inicio:", (string) $start);
		$rprt->AddField("Fecha Fin:", (string) $end);
		$almacen = DextraDB::GetByKey(DextraDB::ALMACEN, $_SESSION['id_almacen']);
		$rprt->AddField("Almacén:", $almacen["nombre_almacen"]);
		
		$titles = array("Venta", "Fecha", "Total", "Usuario");
		$columns = array("id_venta", "fecha_venta", "total", "usuario");
		$widths = array(0.15, 0.15, 0.15, 0.15);
		$table = new PDFReportTable($data, $columns, $titles, $widths);
		$table->SetColumnOperation("total", ReportTable::SUM);
		$table->SetColumnOperation("id_venta", ReportTable::COUNT);
		$table->SetColumnType("total", ReportTable::CURRENCY);
		$table->SetColumnAlignment("total", ReportTable::RIGHT);
		
		$rprt->SetTable($table);
		$rprt->SetAuthor($_SESSION['usuario']);
				
		$pdf = $rprt->GenerateDocument();
		$pdf->Output();
	}
}

?>