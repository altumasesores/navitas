<script>

function ajuste(){
	
	var factor=$("#factorVacaciones").val();
		if(factor>1){
		factor=factor/100;		
		$("#factorVacaciones").val(factor);		
	}
	
}
</script>
<?php
$sueldoDiario=redondear($parametros['sueldo']);
$sueldoDiarioImss=redondear($parametros['sueldoImss']);
$factor=redondear($parametros['factor']);
$numeroVacaciones=$parametros['numeroVacaciones'];
?>

<div class="contenedor">

<form id="formVacaciones">


<h1 class="emergente">Vacaciones</h1>  

             
               
               <div class="tablaDomingos">
   <div class="fila">
    <div class="columna" style="width:5px;"></div>  
      <div class="columna" style="width:80px;">No. Dias</div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:60px;">Sueldo</div>
      <div class="columna" style="width:90px; display:none;">Sueldo Imss</div>
       <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>   
      <div class="columna" style="width:130px;">Prima Vacacional(25%)</div>
   </div>
  
   <div class="fila">
   


  <div class="columna" style="width:5px;">(</div>
      <div class="columna" style="width:80px;"><input name="no_vacaciones" id="no_vacaciones" type="text" size="5" maxlength="10" value="<?php echo $numeroVacaciones;?>" class="validate[required]"/></div>
      <div class="columna" style="width:5px;">*</div>
      <div class="columna" style="width:60px;"> <input name="sueldo_vacaciones" id="sueldo_vacaciones" type="text" size="5" maxlength="10"  value="<?php echo $sueldoDiario;?>" readonly="readonly" /></div>
      <div class="columna" style="width:90px; display:none;"> <input name="sueldo_vacaciones_imss" id="sueldo_vacaciones_imss" type=""  size="5" maxlength="10" value="<?php echo $sueldoDiarioImss;?>" readonly="readonly"/></div>
       <div class="columna" style="width:5px;">)</div>
     
      <div class="columna" style="width:5px;">+</div>
      <div class="columna" style="width:130px;"><input name="factorVacaciones" id="factorVacaciones" value="<?php echo $factor;?>" size="5" onchange="ajuste()" readonly="readonly"/></div>


   
   </div>
   
   <div class="fila"> 
   
 <div class="columna" style="width:5px;"></div>
      <div class="columna"  style="width:80px;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna"  style="width:60px;"><input type="button" id="calcular_descansos" value="Calcular" onclick="calculosClientes.calcularVacaciones();"/></div>
      <div class="columna"  style="width:90px; display:none;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:130px;"><input type="button" id="cancelar_descansos_trabajados" value="Cancelar" onclick="calculosClientes.cancelarModal();"/></div>    
   </div>
</div>





              



</form>

</div>

