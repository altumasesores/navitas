<?php
class paginador{
	public $encabezado;
	public $titulos;
	function __construct($encabezado){
		$this->encabezado=$encabezado;	
		$this->crearEncabezado();	
		}
	public function crearEncabezado()
	{
		foreach($this->encabezado as $titulo=>$sort)
		{
			if($sort!="")
			{
				$this->titulos.="<th class='nosort'>$titulo</th>";
				}else{
					$this->titulos.="<th><h3>$titulo</h3></th>";
					}
				}
		}
	public function cabeceraPaginador()
	{
		echo "<div id='tablewrapper'>
		<div id='tableheader'>
        	<div class='search'>
                <select id='columns' onchange='sorter.search(\"query\")'></select>
                <input type='text' id='query' onkeyup='sorter.search(\"query\")' />
            </div>
            <span class='details'>
				<div>Registros<span id='startrecord'></span>-<span id='endrecord'></span> de <span id='totalrecords'></span></div>
        		<div><a href='javascript:sorter.reset()'>Reset</a></div>
        	</span>
        </div>
<table cellpadding='0' cellspacing='0' border='0' id='table' class='tinytable' align='left'>
<thead>
<tr>$this->titulos
</tr>
</thead>
<tbody>";
		}
		
	public function piePaginador()
	{
		echo ' </tbody>
    </table>
    <div id="tablefooter">
<div id="tablenav">
            	<div>
                    <img src="../libs/js/tablas/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="../libs/js/tablas/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="../libs/js/tablas/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="../libs/js/tablas/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">Ver todos</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Registros por P&aacute;gina</span>
                </div>
                <div class="page">P&aacute;gina<span id="currentpage"></span> de <span id="totalpages"></span></div>
            </div>
        </div>
    </div>
<script type="text/javascript">
	var sorter = new TINY.table.sorter(\'sorter\',\'table\',{
		headclass:\'head\',
		ascclass:\'asc\',
		descclass:\'desc\',
		evenclass:\'evenrow\',
		oddclass:\'oddrow\',
		evenselclass:\'evenselected\',
		oddselclass:\'oddselected\',
		paginate:true,
		size:10,
		colddid:\'columns\',
		currentid:\'currentpage\',
		totalid:\'totalpages\',
		startingrecid:\'startrecord\',
		endingrecid:\'endrecord\',
		totalrecid:\'totalrecords\',
		hoverid:\'selectedrow\',
		pageddid:\'pagedropdown\',
		navid:\'tablenav\',
		init:true
	});
  </script>';
		}
	}
?>