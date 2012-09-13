<?php

class HtmlReportsList
{
	private $ListElement;
	
	public function __construct($reports)
	{
		$rurl = '/reportes/controller.php';
		$this->ListElement = new HtmlElement('ul');
		foreach($reports as $report)
		{
			$url = new URLMaker($rurl, true);
			$url->AddParam('report', $report);
			$url->AddParam('action', 'request');
			$li = new HtmlElement('li');
			$a = new HtmlElement('a');
			
			//$a->SetAttribute('href', $url->__toString());
			//$a->SetAttribute('href', '');
			//$a->SetAttribute('target', '_blank'); //not xhtml compliant
			$url = $url->__toString();
			$onclick = <<<EOT
javascript:cargarPagina('$url', 'cuerpo')
EOT;
			$a->SetAttribute('onclick', $onclick);
			$a->InnerText = Report::GetNameByCode($report);
			$li->AppendChild($a);
			$this->ListElement->AppendChild($li);
		}
	}
	
	public function __toString()
	{
		return $this->ListElement->__toString();
	}
	
	public function GetList()
	{
		return $this->ListElement;
	}
}

//Omar Karim Martín Cornejo - @omarkhd
?>