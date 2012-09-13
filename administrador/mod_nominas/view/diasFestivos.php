<?php
$sueldoDiario=redondear($parametros['sueldo']);
$sueldoDiarioImss=redondear($parametros['sueldoImss']);
$factor=redondear($parametros['factor']);
$numeroDias=$parametros['numeroFestivos'];
?>

<div class="contenedor">

<form id="formDiasFestivos">


<h1 class="emergente">Dias Festivos</h1>  

             
               
               <div class="tabla">
   <div class="fila">
    <div class="columna" style="width:5px;"></div>  
      <div class="columna" style="width:80px;">No. Dias</div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:60px;">Sueldo</div>
      <div class="columna" style="width:90px; display:none;">Sueldo Imss</div>
       <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>   
      <div class="columna" style="width:60px;">Factor</div>
   </div>
  
   <div class="fila">
   


  <div class="columna" style="width:5px;">(</div>
      <div class="columna" style="width:80px;"><input name="no_festivos" id="no_festivos" type="text" size="5" maxlength="10" value="<?php echo $numeroDias;?>" class="validate[required]"/></div>
      <div class="columna" style="width:5px;">*</div>
      <div class="columna" style="width:60px;"> <input name="sueldo_festivos" id="sueldo_festivos" type="text" size="5" maxlength="10" value="<?php echo $sueldoDiario;?>" /></div>
      <div class="columna" style="width:90px; display:none;"> <input name="sueldo_festivos_imss" id="sueldo_festivos_imss" type=""  size="5" maxlength="10"  value="<?php echo $sueldoDiarioImss;?>" readonly="readonly"/></div>
       <div class="columna" style="width:5px;">)</div>
     
      <div class="columna" style="width:5px;">*</div>
      <div class="columna" style="width:60px;"><input name="factor_festivos" id="factor_festivos" type="text" size="5" maxlength="10" value="<?php echo $factor;?>" /></div>


   
   </div>
   
   <div class="fila"> 
   
 <div class="columna" style="width:5px;"></div>
      <div class="columna"  style="width:80px;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna"  style="width:60px;"><input type="button" id="calcular_descansos" value="Calcular" onclick="calculosClientes.calcularDiasFestivos();"/></div>
      <div class="columna"  style="width:90px; display:none;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:60px;"><input type="button" id="cancelar_descansos_trabajados" value="Cancelar" onclick="calculosClientes.cancelarModal();"/></div>    
   </div>
</div>





              



</form>

</div>





