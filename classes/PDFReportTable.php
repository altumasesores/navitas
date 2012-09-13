<?php

class PDFReportTable extends ReportTable
{
	private $Widths;
	
	public function __construct($data, $columns = null, $headers = null, $widths = null)
	{
		parent::__construct($data, $columns, $headers);
		$this->Widths = null;
		
		if($widths == null)
		{
			$cols = count($this->Columns);
			$width = 1 / $cols;			
			foreach($this->Columns as $col)
				$this->Widths[$col] = $width;
		}
		
		else
		{
			$i = 0;
			foreach($this->Columns as $col)
				$this->Widths[$col] = $widths[$i++];
		}
	}
	
	public function SetColumnWidth($col, $width)
	{		
		$this->Widths[$col] = $width;			
	}
	
	public function GetColumnWidth($col)
	{
		return $this->Widths[$col];
	}
}