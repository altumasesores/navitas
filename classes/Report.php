<?php

abstract class Report
{
	protected $Code;
	protected $Name;
	
	public function __construct()
	{
		$class = get_class($this);
		$this->Code = strtolower(substr($class, 0, strlen($class) - 6));
		$this->Name = self::GetNameByCode($this->Code);
	}
	
	public abstract function GetRequestForm();
	public abstract function GetDisplayTable($parameters);
	protected abstract function GetData($params);
	public abstract function GetPDF($params);
	
	public function GetName()
	{
		return $this->Name;
	}
	
	public static function GetNameByCode($abr)
	{
		switch($abr)
		{
			case 'vgrf':
				return 'Ventas Generales por fecha';
				
			case 'varf':
				return 'Venta de Art&iacute;culos por fecha';
				
			case 'dvaf':
				return 'Detalles de Venta de Art&iacute;culos';
				
			case "vcpf":
				return "Ventas a Clientes por fecha";
				
			case "vapf":
				return "Ventas a Afiliados por fecha";
				
			case "dv":
				return "Detalles de venta";
				
			default:
				return null;
		}
	}
}

//Omar Karim Martín Cornejo
?>