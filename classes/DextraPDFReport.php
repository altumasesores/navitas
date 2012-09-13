<?php

class DextraPDFReport
{
	private $Name;
	private $Date;
	private $Time;
	private $User;
	private $Description;
	private $Fields;
	private $Profile;
	private $Table;

	public function __construct($name)
	{
		$this->Name = $name;
		$this->Date = null;
		$this->Time = null;
		$this->User = null;
		$this->Description = null;
		$this->Fields = array();
		$this->Profile = new PDFProfile();
		$this->Table = null;
	}
	
	public function GenerateDocument()
	{
		//Before starting to generate the document,
		//we have to add the date and time of the momento of the generation!
		$this->AddDateTime();
		
		//Configuraciones
		$tm = 0; //test margin
		$dh = 6; //default height
		$uw = 196; //usable width
	
		$pdf = $this->Profile->GetDocument();
		$pdf->AddPage();
		
		//title
		$this->Profile->SetToTitle();
		$pdf->Cell(0, $dh, $this->Name, $tm, 1, "C");
		$pdf->Ln();
		
		//description
		if($this->Description != null)
		{
			$this->Profile->SetToNormal();
			$pdf->Cell($uw, $dh, $this->Description, $tm);
			$pdf->Ln();
		}
		
		//adding fields
		$ln = false;
		foreach($this->Fields as $field => $value)
		{
			$this->Profile->SetToSubtitle();
			$pdf->Cell(($uw / 2) * 0.3, $dh, $field, $tm); //using the 30% of the middle
			$this->Profile->SetToNormal();
			$pdf->Cell(($uw / 2) * 0.7, $dh, $value, $tm); //using the 70% of the middle
			
			if($ln)
				$pdf->Ln();
			$ln = !$ln;
		}
		
		//contenido (tabla)		
		if($this->Table != null)
		{
			$pdf->Ln();
			$pdf->Ln();
			$columns = $this->Table->GetColumns(); // columns db names
			$table = $this->Table->GetTable();
			
			//Printing subtitles
			$this->Profile->SetToSubtitle();
			$i = 0;
			foreach($columns as $column)
				$pdf->Cell($this->Table->GetColumnWidth($column) * $uw, $dh, $table[0][$i++], $tm, 0, "L");			
			$pdf->Ln();
			
			//Printing body values
			$this->Profile->SetToNormal();
			for($j = 1, $k = 0; $j < count($table) - 1; $j++, $k = 0, $pdf->Ln())
				foreach($columns as $column)
					$pdf->Cell($this->Table->GetColumnWidth($column) * $uw, $dh, $table[$j][$k++], $tm, 0, "L");
			
			//Printing results
			$this->Profile->SetToSubtitle();
			$i = 0; $rIndex = count($table) - 1;
			foreach($columns as $column)
				$pdf->Cell($this->Table->GetColumnWidth($column) * $uw, $dh, $table[$rIndex][$i++], "T", 0, "L");			
		}
		
		//footer
		if($this->User != null || $this->Date != null || $this->Time != null)
		{
			$pdf->SetAutoPageBreak(false);
			$pdf->SetXY(10, 268);
			$fnw = (int) (($uw / 3) * 0.4);
			$fvw = (int) (($uw / 3) * 0.6);
			
			$pdf->Cell($fnw, $dh, "Usuario:", $tm, null, "R");
			$pdf->Cell($fvw, $dh, $this->User, $tm, null, "L");
			$pdf->Cell($fnw, $dh, "Fecha:", $tm, null, "R");
			$pdf->Cell($fvw, $dh, $this->Date, $tm, null, "L");
			$pdf->Cell($fnw, $dh, "Hora:", $tm, null, "R");
			$pdf->Cell($fvw, $dh, $this->Time, $tm, null, "L");
		}
		
		//document's finished!
		return $this->Profile->GetDocument();
	}
	
	private function WriteCell($col, $value, $width, $dh, $tm)
	{
		$align = "L";
		
		if(in_array($col, $this->Table->GetMoneyFields()))
			$value = "$" . $value . "   "; //Pinche solución indecente pecadora! hahaha 
		
				
		$alignments = $this->Table->GetAlignments();
		if(isset($alignments[$col]))
			$align = $alignments[$col];
			
		$this->Profile->GetDocument()->Cell($width, $dh, $value, $tm, 0, $align);				
	}
	
	public function AddDescription($str)
	{
		$this->Description = $str;
	}
	
	public function AddDateTime()
	{
		$this->Date = DextraDB::GetServerDate();
		$this->Time = DextraDB::GetServerTime();
	}
	
	public function AddField($field, $val)
	{
		$this->Fields[$field] = (string) $val;
	}
	
	public function SetAuthor($author)
	{
		$this->User = $author;
	}
	
	public function SetTable(PDFReportTable $table)
	{
		$this->Table = $table;
	}
}

?>