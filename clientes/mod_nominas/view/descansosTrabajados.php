<?php
$sueldoDiario=redondear($parametros['sueldo']);
$sueldoDiarioImss=redondear($parametros['sueldoImss']);
$factor=redondear($parametros['factor']);
$numeroDescansos=$parametros['numeroDescansos'];
?>

<div class="contenedor">

<form id="formDescansosTrabajados">


<h1 class="emergente">Descansos Trabajados</h1>  

             
               
               <div class="tabla">
   <div class="fila">
    <div class="columna" style="width:5px;"></div>  
      <div class="columna" style="width:80px;">No. Descansos</div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:60px;">Sueldo</div>
      <div class="columna" style="width:90px; display:none;">Sueldo Imss</div>
       <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>   
      <div class="columna" style="width:60px;">Factor</div>
   </div>
  
   <div class="fila">
   


  <div class="columna" style="width:5px;">(</div>
      <div class="columna" style="width:80px;"><input name="no_descansos" id="no_descansos" type="text" size="5" maxlength="10" value="<?php echo $numeroDescansos;?>" class="validate[required]"/></div>
      <div class="columna" style="width:5px;">*</div>
      <div class="columna" style="width:60px;"> <input name="sueldo_descansos" id="sueldo_descansos" type="text" size="5" maxlength="10" value="<?php echo $sueldoDiario;?>" readonly="readonly"/></div>
      <div class="columna" style="width:90px; display:none;"> <input name="sueldo_descansos_imss" id="sueldo_descansos_imss" type=""  size="5" maxlength="10"  value="<?php echo $sueldoDiarioImss;?>" readonly="readonly"/></div>
       <div class="columna" style="width:5px;">)</div>
     
      <div class="columna" style="width:5px;">*</div>
      <div class="columna" style="width:60px;"><input name="factor_descansos" id="factor_descansos" type="text" size="5" maxlength="10" value="<?php echo $factor;?>" readonly="readonly" /></div>


   
   </div>
   
   <div class="fila"> 
   
 <div class="columna" style="width:5px;"></div>
      <div class="columna"  style="width:80px;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna"  style="width:60px;"><input type="button" id="calcular_descansos" value="Calcular" onclick="calculosClientes.calcularDescansosTrabajados();"/></div>
      <div class="columna"  style="width:90px; display:none;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:60px;"><input type="button" id="cancelar_descansos_trabajados" value="Cancelar" onclick="calculosClientes.cancelarModal();"/></div>    
   </div>
</div>





              



</form>

</div>