<?php

class DVReport extends Report
{
	public function GetRequestForm()
	{
	}
	
	public function GetDisplayTable($params)
	{
		$data = $this->GetData($params);
		$columns = array("nombre_articulo", "cantidad", "precio", "importe", "iva", "total");
		$titles = array("Art&iacute;culo", "Cantidad", "Precio", "Importe", "IVA", "Total");
		$table = new ReportTable($data, $columns, $titles);
		foreach(array("precio", "importe", "iva", "total") as $col)
		{
			$table->SetColumnOperation($col, ReportTable::SUM);
			$table->SetColumnType($col, ReportTable::CURRENCY);
		}
		$table->SetColumnOperation("cantidad", ReportTable::SUM);
		
		$rprt = new DextraHTMLReport();
		$rprt->SetTable($table);
		return $rprt->GenerateReport();
	}
	
	public function GetPDF($params)
	{
		$data = $this->GetData($params);
		$ventaId = $params['ventaId'];
		
		$rprt = new DextraPDFReport("Detalle de venta");
		$almacen = DextraDB::GetByKey(DextraDB::ALMACEN, $_SESSION['id_almacen']);
		$rprt->AddField("Almacén:", $almacen["nombre_almacen"]);
		$rprt->AddDescription("Venta Número " . $ventaId);
		
		$columns = array("nombre_articulo", "cantidad", "precio", "importe", "iva", "total");
		$titles = array("Artículo", "Cantidad", "Precio", "Importe", "IVA", "Total");
		$widths = array(0.40, 0.12, 0.12, 0.12, 0.12, 0.12);
		$table = new PDFReportTable($data, $columns, $titles, $widths);
		foreach(array("precio", "importe", "iva", "total") as $col)
		{
			$table->SetColumnOperation($col, ReportTable::SUM);
			$table->SetColumnType($col, ReportTable::CURRENCY);
		}
		$table->SetColumnOperation("cantidad", ReportTable::SUM);
			
		$rprt->SetTable($table);
		$rprt->SetAuthor($_SESSION['usuario']);
				
		$pdf = $rprt->GenerateDocument();
		$pdf->Output();
	}
	
	protected function GetData($params)
	{
		$ventaId = $params['ventaId'];
		
		$pdo = DextraPDO::GetInstance();
		$sql = "select vcd.id_venta, vcd.importe, vcd.importe * vcd.iva as iva, vcd.importe + vcd.importe * vcd.iva as total, ca.nombre_articulo, vcd.cantidad, vcd.precio from (select id_venta, precio, (cantidad * precio) - (cantidad * precio * descuento_articulo / 100) - (cantidad * precio * descuento_cliente / 100) as importe, iva / 100 as iva, id_articulo, cantidad from ventas_articulos where id_venta = ?) vcd inner join catalogo_articulos ca on ca.id_articulo = vcd.id_articulo";
		$query = $pdo->prepare($sql);
		$query->execute(array($ventaId));
		
		$data = $query->fetchAll();
		DextraPDO::Close();
		
		return $data;
	}
}

?>