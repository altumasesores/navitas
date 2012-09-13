<?php
$sueldoDiario=redondear($parametros['sueldoDiario']);
$sueldoDiarioImss=redondear($parametros['sueldoDiarioImss']);
$factorHorasExtras=redondear($parametros['factor']);
$numeroHoras=$parametros['numeroHoras'];
?>

<div class="contenedor">

<form id="formHorasExtras">


<h1 class="emergente">Horas extras</h1>  

             
               
               <div class="tabla">
   <div class="fila">
    <div class="columna" style="width:5px;"></div>  
      <div class="columna" style="width:80px;">No. Horas</div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:60px;">Sueldo</div>
      <div class="columna" style="width:90px; display:none;">Sueldo Imss</div>
       <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>   
      <div class="columna" style="width:60px;">Factor</div>
   </div>
  
   <div class="fila">
   


  <div class="columna" style="width:5px;">(</div>
      <div class="columna" style="width:80px;"><input name="no_horas" id="no_horas" type="text" size="5" maxlength="10" value="<?php echo $numeroHoras;?>" class="validate[required]"/></div>
      <div class="columna" style="width:5px;">*</div>
      <div class="columna" style="width:60px;"><input name="sueldo_hora" id="sueldo_hora" type="text" size="5" maxlength="10" value="<?php echo $sueldoDiario;?>" /></div>
      <div class="columna" style="width:90px; display:none;"><input name="sueldo_hora_imss" id="sueldo_hora_imss" type=""  size="5" maxlength="10" value="<?php echo $sueldoDiarioImss;?>" readonly="readonly"/></div>
       <div class="columna" style="width:5px;">)</div>
     
      <div class="columna" style="width:5px;">*</div>
      <div class="columna" style="width:60px;"><input name="factor" id="factor" type="text" size="5" maxlength="10" value="<?php echo $factorHorasExtras;?>" /></div>


   
   </div>
   
   <div class="fila"> 
   
 <div class="columna" style="width:5px;"></div>
      <div class="columna"  style="width:80px;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna"  style="width:60px;"><input type="button" id="calcular_horas_extras" value="Calcular" onclick="calculosClientes.calcularHorasExtras();"/></div>
      <div class="columna"  style="width:90px; display:none;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:60px;"><input type="button" id="cancelar_horas_extras" value="Cancelar" onclick="calculosClientes.cancelarModal();"/></div>    
   </div>
</div>





              



</form>

</div>