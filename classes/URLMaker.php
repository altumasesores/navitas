<?php

class URLMaker
{
	private $RootURL;
	private $FQP; //fully qualified path
	private $Params;
	
	public function __construct($append, $client = false)
	{
		$this->RootURL = ($client ? "/dextra_pos" : $_SERVER["DOCUMENT_ROOT"] . "/dextra_pos");
		$this->FQP = $this->RootURL . $append;
		$this->Params = array();
	}
	
	public function AddParam($name, $val)
	{
		$this->Params[$name] = $val;
	}
	
	public function __toString()
	{
		$str = $this->FQP;
		if(count($this->Params) > 0)
		{
			$str .= '?';
			foreach($this->Params as $name => $val)
				$str .= $name . '=' . $val . '&';
			$str = substr($str, 0, strlen($str) - 1);
		}
		
		return $str;
	}
}

//Omar Karim Martín Cornejo - @omarkhd
?>