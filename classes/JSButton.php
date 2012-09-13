<?php

class JSButton
{
	private $Label;
	private $JSFunction;
	
	public function __construct($func, $label = "Aceptar")
	{
		$this->Label = $label;
		$this->JSFunction = $func;
	}
	
	public function GetButton()
	{
		$button = new HtmlElement("button");
		$button->InnerText = "Aceptar";
		$button->SetAttribute("type", "button");
		$button->SetAttribute("id", "js-button-" . rand(1000, 4000));
		$button->SetAttribute("onclick", $this->JSFunction);
		
		return $button;
	}
}

?>