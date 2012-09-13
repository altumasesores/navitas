<?php
$descripcion=redondear($parametros['descripcion']);
$monto=redondear($parametros['monto']);
?>


<div class="contenedor">

<form id="formOtrasDeducciones">


<h1 class="emergente">Horas extras</h1>  

             
               
               <div class="tabla">
   <div class="fila">
   
      <div class="columna" style="width:180px;">Descripción</div>
     
      <div class="columna" style="width:60px;">Monto</div>
     
   </div>
  
   <div class="fila">
   
   
     <div class="columna" style="width:180px;"><input name="descripcion_ot_deducciones" id="descripcion_ot_deducciones" type="text" size="20" maxlength="30" style="height:20px" value="<?php  echo $descripcion;?>" class="validate[required]"/>
</div>
     
      <div class="columna" style="width:60px;"><input name="cantidad_ot_deducciones" id="cantidad_ot_deducciones" type="text" size="5"  maxlength="10" value="<?php echo $monto;?>" class="validate[required]" /> 
</div>
   



   
   </div>
   
   <div class="fila"> 
   
 
     
      <div class="columna"  style="width:180px;"><input type="button" id="calcular_descansos" value="Calcular" onclick="calculosClientes.calcularOtrasDeducciones();"/></div>     
      <div class="columna" style="width:60px;"><input type="button" id="cancelar_descansos_trabajados" value="Cancelar" onclick="calculosClientes.cancelarModal();"/></div>    
   </div>
</div>





              



</form>

</div>

    
    
     
		
     
    
            
         
