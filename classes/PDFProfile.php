<?php

class PDFProfile
{
	protected $Document;
	protected $SmallSize;
	protected $NormalSize;
	protected $BigSize;
	protected $Orientation;
	protected $MeasureUnit;
	protected $Format;
	protected $Font;
	
	public function __construct($s = 8, $n = 10, $b = 14)
	{
		$this->SmallSize = $s;
		$this->NormalSize = $n;
		$this->BigSize = $b;
		
		$this->Orientation = "P";
		$this->MeasureUnit = "mm";
		$this->Format = "Letter";
		$this->Font = "Arial";
		
		$this->Document = null;
	}
	
	public function GetDocument()
	{
		if($this->Document == null)
		{
			$this->Document = new FPDF($this->Orientation, $this->MeasureUnit, $this->Format);
			$this->SetToNormal();
		}
			
		return $this->Document;
	}
	
	public function SetToNormal()
	{
		$this->Document->SetFont($this->Font, "", $this->NormalSize);
	}
	
	public function SetToTitle()
	{
		$this->Document->SetFont($this->Font, "B", $this->BigSize);
	}
	
	public function SetToSubtitle()
	{
		$this->Document->SetFont($this->Font, "B", $this->NormalSize);
	}
}

?>