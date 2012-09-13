<?php 
if (!isset($_SESSION)) {
		  session_start();
	}

	$id_usuario= $_SESSION['id_usuario'];

	include_once("../admin/empresa_clase.php");
	include_once("../funcion_redondear.php");	
	
	$objEmpresa = new cEmpresa(); //Creamos el objeto $objEmpresa de la clase cEmpresa
	$listaEmpresas= $objEmpresa->consultar_empresas_x_usuario($id_usuario);  //Consulto todas las empresas y las guardo en $lista empresas
		
?>
<h1>Reportes</h1>
<form name="f1" > 
<table>
<tr><td><label>Empresa
  <select name="id_empresa" id="id_empresa">
  <option value="selecionar" disabled="disabled">Seleccionar:</option>
  <option value="todas" >Consultar todas</option>
  <?php while ($row_empresas = mysql_fetch_assoc($listaEmpresas)){
      
    
	  
	 // $inicio=$row_empresas[''];
	  //$fin=$row_empresas[''];
	  
	   ?>
  <option value="<?php echo $row_empresas['id_empresa']; ?>"><?php echo $row_empresas['razon_social']; ?></option>  
  <?php }?>
  </select>
</label></td><td><span id="fecha_inicio" >Fecha de Inicio
	<input type="text" id="dia_inicio" size="10" onMouseOver="javascript:calendarioNaranja('dia_inicio');" >
	</span><span id="fecha_fin" >Fecha de Final<input type="text" id="dia_final" size="10" onMouseOver="javascript:calendarioNaranja('dia_final');" ></span></td>
</tr>
<tr><td colspan="2" ><span id="eleccion" ><font size="2" color="Navy" ><b>Prestaciones:</b></font></span>
<font size="2" >Sueldo<input type="checkbox" name="arregloCheck[]" id="Sueldo" value="percepciones_empleado.total_sueldo" />
Hr Extras<input type="checkbox" name="arregloCheck[]" id="Hr Estras" value="percepciones_empleado.total_horas_extras"  />
Domingos<input type="checkbox" name="arregloCheck[]" id="Domingos trabajados" value="percepciones_empleado.total_domingos_trabajados" />
Turnos<input type="checkbox" name="arregloCheck[]" id="Turnos Trabajados" value="percepciones_empleado.total_turnos_trabajados" />
Descansos<input type="checkbox" name="arregloCheck[]" id="Descansos Trabajados" value="percepciones_empleado.total_descanso_trabajado" />
Dias festivos<input type="checkbox" name="arregloCheck[]" id="Dias Festivos" value="percepciones_empleado.total_dias_festivos"  />
Vacaciones<input type="checkbox" name="arregloCheck[]" id="Vacaciones" value="percepciones_empleado.total_vacaciones" />
Complemento Sueldo<input type="checkbox" name="arregloCheck[]" id="Completo" value="percepciones_empleado.complemento_sueldo"  />
Otras Percepciones<input type="checkbox" name="arregloCheck[]" id="Otros" value="percepciones_empleado.otras_percepciones"  /></font>
</td>
</tr>
<tr><td colspan="2"><span id="eleccion" ><font size="2" color="Navy" ><b>Deducciones:</b></font></span>
<font size="2" >Prestamo<input type="checkbox" name="arregloCheckded[]" id="Prestamos" value="deducciones_empleado.prestamos" />
Caja Ahorro<input type="checkbox" name="arregloCheckded[]" id="Caja Ahorro" value="deducciones_empleado.caja_ahorro" />
Fonacot<input type="checkbox" name="arregloCheckded[]" id="Fonacot" value="deducciones_empleado.fonacot" />
Infonavit<input type="checkbox" name="arregloCheckded[]" id="Infonavit" value="deducciones_empleado.infonavit"  />
Otras deducciones<input type="checkbox" name="arregloCheckded[]" id="Otras Deducciones" value="deducciones_empleado.otras_deducciones" />
Prestamo navitas<input type="checkbox" name="arregloCheckded[]" id="Prestamo Navitas" value="deducciones_empleado.prestamo_ascon" /></font>
Selecionar Todos<input type="checkbox" name="todos" id="todos" onClick="seleccionar_todo();" /> 
Deselecionar Todos<input type="checkbox" name="deseleccionar" id="deseleccionar" onClick="deseleccionar_todo();" />
<img src="../imagenes/buscarReporte.png" width="24" height= "24" onclick="buscarNominas('normal')" alt="Buscar" title="Buscar" /><a onclick= "buscarNominas('normal')" >Buscar</a>
</td>
</tr>
</table>
</form>


<div id="reporte"> <?php include_once("../admin/reporte_nomina_consulta2.php")?>   </div>


