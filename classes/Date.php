<?php

class Date
{
	public $Year;
	public $Month;
	public $Day;
	private $Separator;
	
	public function __construct($year, $month, $day, $sep = " de ")
	{
		$this->Year = $year;
		$this->Month = $month;
		$this->Day = $day;
		$this->Separator = $sep;
	}
	
	private function GetMonthName($m)
	{
		$months = array();
		$months[1] = "Enero";
		$months[2] = "Febrero";
		$months[3] = "Marzo";
		$months[4] = "Abril";
		$months[5] = "Mayo";
		$months[6] = "Junio";
		$months[7] = "Julio";
		$months[8] = "Agosto";
		$months[9] = "Septiembre";
		$months[10] = "Octubre";
		$months[11] = "Noviembre";
		$months[12] = "Diciembre";
		
		return $months[$m];
	}
	
	public function __toString()
	{
		return $this->Day . $this->Separator . $this->GetMonthName($this->Month) . $this->Separator . $this->Year;
	}
	
	public static function CreateFromString($str)
	{
		$delimiters = array("/", "-", " de ");
		$array = array();
		foreach($delimiters as $del)
			if(count($array = explode($del, $str)) == 3)
				return new Date($array[2], $array[1], $array[0]);
		
		throw new Exception("Could not determine a correct Date object");
	}
	
	public static function GetMySQLString(Date $date)
	{
		return $date->Year . "/" . $date->Month . "/" . $date->Day;
	}		
}

?>