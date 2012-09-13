<?php

class DVAFReport extends Report
{	
	public function GetRequestForm()
	{
	}
	
	public function GetDisplayTable($params)
	{
	}
	
	public function GetPDF($params)
	{
		$data = $this->GetData($params);
		
		$report = new DextraPDFReport("Detalle de ventas por fecha");		
		$report->AddDescription("Artículo: " . base64_decode($params["productName"]));
				
		$report->AddField("Fecha Inicio", new Date($params["sYear"], $params["sMonth"], $params["sDate"]));
		$report->AddField("Fecha Fin", new Date($params["eYear"], $params["eMonth"], $params["eDate"]));
		$almacen = DextraDB::GetByKey(DextraDB::ALMACEN, $_SESSION['id_almacen']);
		$report->AddField("Almacén", $almacen["nombre_almacen"]);
		
		$sql_cols = array("id_venta", "fecha_venta", "cantidad", "importe", "iva", "total");
		$headers = array("Venta", "Fecha", "Cantidad", "Importe", "IVA", "Total");
		$table = new PDFReportTable($data, $sql_cols, $headers);
		
		foreach(array("cantidad", "importe", "iva") as $col)
		{
			$table->SetColumnOperation($col, ReportTable::SUM);
			$table->SetColumnType($col, ReportTable::CURRENCY);
		}
		$table->SetColumnOperation("id_venta", ReportTable::COUNT);
		
		$report->SetTable($table);
		$report->SetAuthor($_SESSION['usuario']);
		
		$doc = $report->GenerateDocument();
		$doc->Output();
	}
	
	protected function GetData($params)
	{
		$start = $params['sYear'] . "/" . $params['sMonth'] . "/" . $params['sDate'];
		$end = $params['eYear'] . "/" . $params['eMonth'] . "/" . $params['eDate'];
		$id = $params["productId"];
		
		$sql = "select t1.id_venta, t1.fecha_venta, t1.cantidad, t1.importe, (t1.importe * (t1.iva / 100)) as iva, (t1.importe + t1.importe * (t1.iva / 100)) as total from (select va.id_venta, v.fecha_venta, va.cantidad, (va.cantidad * va.precio - va.cantidad * va.precio *(va.descuento_articulo / 100) - va.cantidad * va.precio * (va.descuento_cliente / 100)) as importe, va.iva, va.id_articulo from ventas_articulos va inner join (select id_venta, fecha_venta from ventas where estado_venta = 'activo' and fecha_venta between ? and ?) v on va.id_venta = v.id_venta where va.id_articulo = ?) t1";
		
		$pdo = DextraPDO::GetInstance();
		$query = $pdo->prepare($sql);
		$query->execute(array($start, $end, $id));
		
		$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		//DextraPDO::Close();
		
		return $rows;
	}
	
	public function Render($params, RenderStrategy $strategy)
	{
		echo "hey";
	}
}

?>