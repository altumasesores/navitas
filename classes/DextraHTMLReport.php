<?php

class DextraHTMLReport
{
	private $Table;
	private $HTMLTable;
	public $Name;

	public function __construct($name = null)
	{
		$this->Name = $name;
	}
	
	public function SetTable(ReportTable $table)
	{
		$this->Table = $table->GetTable();
	}
	
	public function GenerateReport()
	{
		$this->HTMLTable = new HtmlElement("table");
		
		//Printing titles		
		$trTitles = new HtmlElement("tr");
		foreach($this->Table[0] as $title)
		{
			$th = new HtmlElement("th");
			$th->InnerText = $title;
			$trTitles->AppendChild($th);
		}
		$this->HTMLTable->AppendChild($trTitles);
		
		//Printing body values
		for($i = 1; $i < count($this->Table) - 1; $i++)
		{
			$tr = new HtmlElement("tr");
			foreach($this->Table[$i] as $value)
			{
				$td = new HtmlElement("td");
				$td->InnerText = $value;
				$tr->AppendChild($td);
			}
			$this->HTMLTable->AppendChild($tr);
		}
		
		//printing results
		$trResults = new HtmlElement("tr");
		foreach($this->Table[count($this->Table) -1] as $result)
		{
			$th = new HtmlElement("th");
			$th->InnerText = $result;
			$trResults->AppendChild($th);
		}
		$this->HTMLTable->AppendChild($trResults);
		
		return $this->HTMLTable;
	}
}

?>