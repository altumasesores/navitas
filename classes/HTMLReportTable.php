<?php

class HTMLReportTable extends ReportTable
{
	private $ExtraColumns;
	
	public function __construct($data, $columns = null, $headers = null)
	{
		parent::__construct($data, $columns, $headers);
		$this->ExtraColumns = array();
	}
	
	public function AddLinkColumn($name, $function)
	{
		$this->ExtraColumns[$name] = $function;
	}
}

?>