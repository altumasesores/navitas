<script>

function ajuste(){
	
	var factor=$("#factorDomingo").val();
		if(factor>1){
		factor=factor/100;		
		$("#factorDomingo").val(factor);		
	}
	
}

</script>
<?php
$sueldoDomingo=redondear($parametros['sueldoDomingo']);
$sueldoDomingoImss=redondear($parametros['sueldoDomingoImss']);
$factorDomingos=redondear($parametros['factor']);
$numeroDomingos=$parametros['numeroDomingos'];
?>
<div class="contenedor">
<form id="formDomingosTrabajados">
<h1 class="emergente">Domingos Trabajados</h1>
<div class="tablaDomingos">

<div class="fila">
      <div class="columna" style="width:5px;"></div>  
      <div class="columna" style="width:80px;">Domingos</div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:60px;">Sueldo</div>
      <div class="columna" style="width:90px; display:none;">Sueldo Imss</div>
       <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>   
      <div class="columna" style="width:130px;">Prima Dominical(25%)</div>
</div>

<div class="fila">
      <div class="columna" style="width:5px;">(</div>  
      <div class="columna" style="width:80px;"><input name="no_domingos" id="no_domingos" type="text" size="5" maxlength="10" value="<?php echo $numeroDomingos;?>" class="validate[required]"/></div>
      <div class="columna" style="width:5px;">*</div>
      <div class="columna" style="width:60px;"><input name="sueldo_domingos" id="sueldo_domingos" type="text" size="5" maxlength="10" value="<?php echo $sueldoDomingo;?>"  /></div>
      <div class="columna" style="width:90px; display:none;"><input name="sueldo_domingos_imss" id="sueldo_domingos_imss" type="text"  size="5" maxlength="10" value="<?php echo $sueldoDomingoImss;?>" readonly="readonly" /></div>
       <div class="columna" style="width:5px;">)</div>
      <div class="columna" style="width:5px;">+</div>   
      <div class="columna" style="width:130px;"><input name="factorDomingo" id="factorDomingo" value="<?php echo $factorDomingos;?>" size="5" onchange="ajuste()" /></div>
</div>


<div class="fila">
 <div class="columna" style="width:5px;"></div>  
      <div class="columna" style="width:80px;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:60px;"> <input type="button" id="calcular_domingos" value="Calcular" onclick="calculosClientes.calcularDomingosTrabajados();" /></div>
      <div class="columna" style="width:90px; display:none;"></div>
       <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>   
      <div class="columna" style="width:130px;"><input type="button" id="cancelar_domingos_trabajados" value="Cancelar" onclick="calculosClientes.cancelarModal()" /></div>
</div>
</div> 
</form>
</div>


             
                         
              
