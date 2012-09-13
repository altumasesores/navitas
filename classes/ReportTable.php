<?php

class ReportTable
{
	protected $Data; //an associative db array
	protected $Columns; //the names of the db columns that will be taken
	protected $Headers; //the headers of the table
	protected $ShowResultRow;
	protected $Results;
	protected $ExtraColumns;
	
	//Vars used for calculations
	//protected $SumFields;
	//protected $CountFields;
	protected $Operations;
	const SUM = "sum";
	const COUNT = "count";
	
	//Types used for the columns
	protected $Types;
	const CURRENCY = "currency";
	
	//Column format: these are only indicators for the client code that displays this table	
	protected $Formats;
	const BOLD = 1;
	const CURSIVE = 2;
	const UNDERLINED= 4;
	
	protected $Alignments;
	const RIGHT = "r";
	const LEFT = "l";
	const CENTER = "c";
	
	public function __construct($data, $columns = null, $headers = null)
	{
		$this->Data = $data;
		$this->Columns = $columns;
		$this->Headers = array();
		$this->Operations = array();
		$this->Types = array();
		$this->Formats = array();
		$this->Alignments = array();
		$this->Results = array();
		$this->ExtraColumns = array();
		
		$this->ShowResultRow = true;
		
		//Filling the columns field with ALL the table columns if the columns are not given
		if($this->Columns == null)
			foreach(($row = $this->Data[0]) as $key => $val)
				$this->Columns[] = $key;
		
		//If the headers weren't specified, we'll put the same name of the db column
		if($headers == null)
			foreach($this->Columns as $col)
				$this->SetColumnHeader($col, $col);
		
		//but if they were asignated, we'll put it in an associative array with its real respective db name
		else
			for($i = 0; $i < count($this->Columns); $i++)
				$this->SetColumnHeader($this->Columns[$i], $headers[$i]);
				
		//Setting everything else as null
		foreach($this->Columns as $col)
		{
			$this->Operations[$col] = null;
			$this->Types[$col] = null;
			$this->Formats[$col] = null;
			$this->Alignments[$col] = null;
			$this->Results[$col] = null;
		}

	}
	
	public function SetColumnHeader($col, $header)
	{
		$this->Headers[$col] = $header;
	}
	
	public function SetColumnOperation($col, $op)
	{
		$this->Operations[$col] = $op;
	}
	
	public function SetColumnType($col, $format)
	{
		$this->Types[$col] = $format;
	}
	
	public function SetColumnAlignment($col, $al)
	{
		$this->Alignments[$col] = $al;
	}
	
	public function GetTable()
	{
		$rowCounter = 1;
		$table = array();
		
		//Original data table properties
		$columns = count($this->Columns);
		$rows = count($this->Data);
		
		//Putting the headers in the table
		$i = 0; //auxiliar var		
		foreach($this->Columns as $col)
			$table[0][$i++] = $this->Headers[$col];
		foreach($this->ExtraColumns as $name => $f)
			$table[0][$i++] = $name;
		
		//Calculando valores iniciales para columna de resultados
		foreach($this->Columns as $col)
			switch($this->Operations[$col])
			{
				case ReportTable::SUM:
					$this->Results[$col] = 0;
					break;
					
				case ReportTable::COUNT:
					$this->Results[$col] = $rows;
					break;
			}	
		
		
		//Rellenando la tabla
		foreach($this->Data as $row)
		{
			$j = 0;
			foreach($this->Columns as $col)
			{
				$value = $row[$col];
				
				//Calculando operaciones
				switch($this->Operations[$col])
				{
					case self::SUM:
						$this->Results[$col] += $value;
						break;
				}
				
				$value = $this->StyleType($col, $value); //Estilizando el valor de una celda				
				$table[$rowCounter][$j++] = $value;
			}
			
			foreach($this->ExtraColumns as $function)
				$table[$rowCounter][$j++] = $function($row);
				
			$rowCounter++;
		}
		
		$k = 0;
		foreach($this->Columns as $col)
			$table[$rowCounter][$k++] = $this->StyleType($col, $this->Results[$col]);
		
		return $table;
	}
	
	public function AddExtraColumn($name, $function)
	{
		$this->ExtraColumns[$name] = $function;
	}
	
	public function StyleType($col, $value)
	{
		if($value === null)
			return "-";
			
		switch($this->Types[$col])
		{
			case self::CURRENCY:
				$value = "$" . $value;
				break;
		}
		
		return $value;
	}
	
	public function GetData()
	{
		return $this->Data;
	}
	
	public function GetColumns()
	{
		return $this->Columns;
	}
}