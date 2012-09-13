

ocultar_desplegables();//funcion para ocultar los desplegables desde el inicio del modulo


	

/*********************************************************************************************************************************************************/
function consultar_subcategorias() {
	
	Estado= $("#categoria_articulo").val();
	
	var dat = 'controlador=Articulo&accion=Subcategorias&id='+ Estado+'&modulo=articulos';
	$.get('AnteFrontController.php',dat, function(resultado) {
	$('#subcategoria').html(resultado);

	});  

}

function AddToAlmacen(accion){
Almacen= $("#Almacen").val();
Articulo= $("#IdArt").val();
/* String numAlmacen= String.valueOf(Almacen);
alert(numAlmacen); */
NombreAlmacen=$("#Almacen option:selected").text();
if (accion=='Modificar') {
var parametros_basicos=new Array();
parametros_basicos['controlador'] = 'Articulo';
parametros_basicos['capa'] = 'Precios'+ Almacen;
parametros_basicos['modulo'] = 'articulos';

var operaciones=new Array();
operaciones['operacion'] = 'BuscarPrecios';
operaciones['accion'] = 'BuscarPrecioArt';
 
var parametros_especificos = { 
  'id_Almacen': Almacen, 
  'id_Articulo': Articulo
}; 
operaciones2.inicializador(parametros_basicos,parametros_especificos,operaciones); 
} 

div = '<div id="Almacen'+ Almacen +'"></div><BR/><BR/>';
$("#Almacenes").append(div);
if ($('#Art'+ Almacen +'').length) {
jAlert('Ya se han agregado los campos para este almacen, unicamente puede seguir agregando precios', 'Mensaje');
}
else{
campo = '<IMG src="images/home_chica.png" id="Almacen'+ Almacen +'" WIDTH="20" HEIGHT="20" BORDER="0" ALT="Imagen"  TITLE="Imagen" ></img>'+NombreAlmacen+'<input type="hidden" size="10" id="Articulo"  name="Articulo" value="'+ Articulo +'"  /><input type="hidden" size="10" id="Art'+ Almacen +'"  name="Art'+ Almacen +'" value="'+ Almacen +'"  /><br/>Existencia:<input type="text" size="10" id="Exist'+ Almacen +'"  name="Exist'+ Almacen +'" onChange="TipoImpuesto('+ Almacen +');" class="validate[required]"  />Costo:<input type="text" size="10" id="Costo'+ Almacen +'"  name="Costo'+ Almacen +'"  />Minimo:<input type="text" size="10" id="Minimo'+ Almacen +'"  name="Minimo'+ Almacen +'"  />Maximo:<input type="text" size="10" id="Maximo'+ Almacen +'"  name="Maximo'+ Almacen +'"  />Punto de Reorden:<input type="text" size="10" id="Reorden'+ Almacen +'"  name="Reorden'+ Almacen +'"  /><div id="IvaArticulo'+ Almacen +'" ></div><a href="javascript:EliminardeAlmacen('+Almacen+');" ><IMG src="images/icono_baja.png" WIDTH="20" HEIGHT="20" BORDER="0" ALT="Eliminar de Este Almacén" TITLE="Eliminar de Este Almacén" ></img></a>';
$("#Almacen"+ Almacen +"").append(campo);
}

}

function TipoImpuesto(Almacen){
	if ($('#IvaArticulo'+ Almacen +'').length) {
	var dat = 'controlador=Articulo&accion=BuscarTiposImpuestos&modulo=articulos&Almacen='+Almacen;
		$.get('AnteFrontController.php',dat, function(resultado) {
		$('#IvaArticulo'+Almacen).html(resultado);	
	});
	}
}
function AddToPrecio(){

Almacen= $("#Almacen").val();
TipoAfiliado= $("#TipoAfiliado").val();

if ($('#Exist'+ Almacen +'').length) { //Utilice este campo por que este es requerido en articulos almacen, sino existe para que poner precio
if ($('#Precio'+ Almacen+'idAfi'+TipoAfiliado+'').length) {
jAlert('Ya se ha agregado el campo para este tipo de precio a este almacen', 'Mensaje');
}
else{
NombreAfiliado=$("#TipoAfiliado option:selected").text();
campo = '<div id="Precios'+ Almacen+TipoAfiliado+'">Precio para '+NombreAfiliado+':<input type="text" size="10" id="Precio'+ Almacen+'idAfi'+TipoAfiliado+'"  name="Precio'+ Almacen+'idAfi'+TipoAfiliado+'" class="validate[required]"  /><a href="javascript:EliminarPrecio('+ Almacen+TipoAfiliado+');" ><img src="images/icono_eliminar.png" WIDTH="20" HEIGHT="20" BORDER="0" ALT="Eliminar Precio"  TITLE="Eliminar Precio" ></img></a></div>';
$("#Almacen"+ Almacen +"").append(campo);
}
}
else{
jAlert('No ha puesto existencias en este Almacén, es necesario ponerlo antes de asignar precios', 'Mensaje');
}

} 

function EliminardeAlmacen(Almacen){
$("#Almacen"+ Almacen +"").empty();
}
function EliminarPrecio (TipoPrecio){
$("#Precios"+TipoPrecio+"").empty();
//alert(TipoPrecio);
}
function BusqArticulos(){
//alert('Entra');
TipoArticulo = $("#tipo_art").val();
Comp=$("#compuesto").get(0).value;

	if (TipoArticulo=='Compuesto') {
			//if (Comp!='Compuesto') {
			var dat = 'controlador=Articulo&accion=BusqArtNoCompuestos&modulo=articulos';
			$.get('AnteFrontController.php',dat, function(resultado) {
			$('#productos').html(resultado);	
				if (!($('#titulou').length)) {
				titulo = '<p id="titulou" >Productos Agregados</p><input type="button" value="Agregar + Articulos" name="AgregarArt" align="right" onClick="BusqArticulos()" /><BR/><BR/><table id="TableProductos" border="2" ><tr><td>ID Art&iacute;culo</td><td>Nombre</td><td>Categor&iacute;a</td><td>Unidad Medida</td><td>Cantidad Solicitada</td></tr></table>';
				$("#productos_Agregados").append(titulo);
				}
				$("#compuesto").attr('value', 'Compuesto');
			});  	
		$("#productos").modal();
	}
	else{
	
		$("#productos_Agregados").empty();
		$("#productos").empty();
		$("#compuesto").attr('value', '');
	}
}
function agregarArticulo(Articulo,Nombre, Categoria, UniMedida, SubCategoria, idCategoria, idSubCategoria){
	//esta funcion la ocupan 2 módulos Articulos y requisiciones
	if (!($('#Articulo'+ Articulo +'').length)) {
		div = '<tr id="Articulo'+ Articulo +'"></tr>';
		$("#TableProductos").append(div);
		campo = '<td><input type="text" id="Articulo" size="8" name="Articulo" disabled="disabled" value='+ Articulo +'  ></td><td><input type="text" id="NombreArt" size="15" name="NombreArt" disabled="disabled" value='+ Nombre +' ><input type="checkbox" name="ArtSeleccionados[]" id="ChekArt'+ Articulo +'" value="'+ Articulo +'" style="visibility:hidden" checked /></td><td><input type="text" size="15" id="Categoria'+ Articulo +'"  name="Categoria'+ Articulo +'" value="'+ Categoria +'" disabled="disabled" /></td><td><input type="text" size="15" id="UnidadMedida'+ Articulo +'"  name="UnidadMedida'+ Articulo +'" value="'+ UniMedida +'" disabled="disabled"/></td><td><input type="text" size="8" id="Cantidad'+ Articulo +'" name="Cantidad'+ Articulo +'" class="validate[required]" /></td><td><input type="hidden" size="10" id="SubCategoria'+ Articulo +'"  name="SubCategoria'+ Articulo +'" value="'+ SubCategoria +'" /><input type="hidden" size="10" id="IdCategoria'+ Articulo +'"  name="IdCategoria'+ Articulo +'" value="'+ idCategoria +'" /><input type="hidden" size="10" id="IdSubCategoria'+ Articulo +'"  name="IdSubCategoria'+ Articulo +'" value="'+ idSubCategoria +'" /><a href="javascript:ElimArticulo('+Articulo+');" ><img src="images/icono_eliminar.png" WIDTH="20" HEIGHT="20" BORDER="0" ALT="Quitar Artículo"  TITLE="Quitar Artículo" ></img></a></td><td><input type="hidden" size="8" id="CantSurtidaArt'+Articulo+'" name="CantSurtidaArt'+Articulo+'" value="0"  ></td><td><input type="hidden" size="9" id="EstadoArtAct'+Articulo+'" name="EstadoArtAct'+Articulo+'" value="No Surtido"  ></td>';
		$("#Articulo"+ Articulo).append(campo);
	}
	else{
	jAlert('Ya lo agrego', 'Mensaje');
	}
}
function Closee(Cerrar){
	//esta funcion la ocupan 2 módulos Articulos y requisiciones
	$("#productos").css("display", "none")
}
function ElimArticulo(Articulo){
//esta funcion la ocupan 2 módulos Articulos y requisiciones
	
	$("#ListaArticulos"+ Articulo).removeAttr("checked");
	$("#Articulo"+ Articulo).remove();
}
function EstadoCheck(Id, Articulo, Nombre, Categoria, UniMedida, SubCategoria, idCategoria, idSubCategoria ){
//esta funcion la ocupan 2 módulos Articulos,requisiciones,traspasos
	if($("#"+Id).is(':checked')) {  
            agregarArticulo(Articulo,Nombre, Categoria, UniMedida, SubCategoria, idCategoria, idSubCategoria)  
        } else {  
            ElimArticulo(Articulo);
        }
}

//$(document).ready(function(){
	/* $(function(){  
    $("#mostrar").click(function(event) {  
    event.preventDefault();  
    $("#acordion").slideToggle("slow");  
	});  
	$("#acordion a").click(function(event) {  
		event.preventDefault();  
		$("#acordion").slideUp();  
	});  
	
	 $("#mostrar2").click(function(event) {  
    event.preventDefault();  
    $("#acordion2").slideToggle("slow");  
	});  
	$("#acordion2 a").click(function(event) {  
		event.preventDefault();  
		$("#acordion2").slideUp();  
	});  
	});   */ 
	  //$("#lista").tablesorter();
	//alert('yaaa');
	
	 /* $('#Formu').submit(function(event) {
			//alert('aki entro');
			  validar();
			  event.preventDefault();
			  var url = $(this).attr('action');
			  var datos = $(this).serialize();
			  $.post(url, datos, function(resultado) {
				$('#cuerpo').html(resultado);
					alert('Se registraron satisfactoriamente los datos de la empresa'); */
					/* var dat2 = 'controlador=Empresa&accion=agregar';
					$.get('AnteFrontController.php',dat2, function(resultado2) {
					$('#cuerpo').html(resultado2);
					}); 
					alert('Se registraron satisfactoriamente los datos de la empresa'); */
	/* 		  });
	}) */; 
	
 	/*  $('#FormModif').submit(function(event) {
			  validar();
			  event.preventDefault();
			  var url = $(this).attr('action');
			  var datos = $(this).serialize();
			  //alert(url +datos);
			  $.post(url, datos, function(resultado) {
				$('#cuerpo').html(resultado);	 */
					
					/* var dat = '';
					$.get('menu.php',dat, function(resultado2) {
					$('#cuerpo').html(resultado2);
					});  */
				/* 	var dat = 'controlador=Empresa&accion=agregar';
					$.get('AnteFrontController.php',dat, function(resultado) {
					$('#cuerpo').html(resultado);
					});
					alert('Se Modifico satisfacoriamente los datos de la empresa');
			  });
			  
			}); */
//});	

//desplega es llamado desde ajaxxx de empresas



















	
 