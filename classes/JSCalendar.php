<?php

class JSCalendar
{
	private $InputId;
	private $HtmlDiv;
	private $Label;
	
	
	public function __construct($inputId, $label = "Fecha:")
	{
		$this->Label = $label;
		$this->InputId = $inputId;
	}
	
	public function GetDiv()
	{
		$this->HtmlDiv = new HtmlElement("div");		
		
		$br = new HtmlElement("br", true);
		
		$span = new HtmlElement('span');
		$span->InnerText = $this->Label;
		
		$input = new HtmlElement('input');
		$input->SetAttribute('type', 'text');
		$input->SetAttribute('disabled', 'disabled');
		$input->SetAttribute("id", $this->InputId);
		
		$btn = new HtmlElement('button');
		$btn->SetAttribute("type", 'button');
		$btn->InnerText = "Escoger";
		
		$calDiv = new HtmlElement("div");
		$calDiv->SetAttribute("id", "div-rand-" . rand(1000, 4000));
		$calDiv->AddClass("form-calendar");
		
		$btn->SetAttribute("onclick", "CalendarInput.Open('" . $calDiv->GetAttribute("id") . "', '" . $input->GetAttribute("id") ."')");
		
		$this->HtmlDiv->AppendChild($span);
		$this->HtmlDiv->AppendChild($br);
		$this->HtmlDiv->AppendChild($input);
		$this->HtmlDiv->AppendChild($btn);
		$this->HtmlDiv->AppendChild($br);
		$this->HtmlDiv->AppendChild($calDiv);
		
		return $this->HtmlDiv;
	}
}

?>