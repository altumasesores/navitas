<?php
$sueldo=redondear($parametros['sueldo']);
$sueldoImss=redondear($parametros['sueldoImss']);
$numeroTurnos=$parametros['numeroTurnos'];
?>
<div class="contenedor">
<form id="formTurnosTrabajados">
<h1 class="emergente">Turnos Trabajados</h1>
<div class="tablaDomingos">

<div class="fila">
      <div class="columna" style="width:5px;"></div>  
      <div class="columna" style="width:80px;">No. Turnos</div>
      <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:130px;">Sueldo</div>
      <div class="columna" style="width:90px; display:none;">Sueldo Imss</div>
       <div class="columna" style="width:5px;"></div>  
  
</div>

<div class="fila">
      <div class="columna" style="width:5px;">(</div>  
      <div class="columna" style="width:80px;"><input name="no_turnos" id="no_turnos" type="text" size="5" maxlength="10" value="<?php echo $numeroTurnos?>" class="validate[required]"/></div>
      <div class="columna" style="width:5px;">*</div>
      <div class="columna" style="width:130px;"><input name="sueldo_turnos" id="sueldo_turnos" type="text" size="5" maxlength="10"  value="<?php echo $sueldo?>"/></div>
      <div class="columna" style="width:90px; display:none;"> <input name="sueldo_turnos_imss" id="sueldo_turnos_imss" type=""  size="5" maxlength="10" readonly="readonly" value="<?php echo $sueldoImss?>"/></div>
       <div class="columna" style="width:5px;">)</div>     
</div>


<div class="fila">
 <div class="columna" style="width:5px;"></div>       
      <div class="columna" style="width:80px;"><input type="button" id="calcular_turnos" value="Calcular" onclick="calculosClientes.calcularTurnosTrabajados();"/></div>   
       <div class="columna" style="width:5px;"></div>
      <div class="columna" style="width:130px;"><input type="button" id="cancelar_turnos" value="Cancelar" onclick="calculosClientes.cancelarModal()" /></div>   
         <div class="columna" style="width:90px; display:none;"></div>
      <div class="columna" style="width:5px;"></div>
</div>
</div> 
</form>
</div>