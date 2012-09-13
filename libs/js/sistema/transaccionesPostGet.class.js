



var Empleado=function()
    {
		this.empleado  = new Array();
		}

    Empleado.prototype.addProducto = function(emp){
	 		   this.empleado.push(emp);
		}
	Empleado.prototype.emptyProducto = function(emp){
	 		   this.empleado=null;
			   this.empleado=new Array();
		}			


var transaccionesPostGet=function(grupo_usuario){

	    this.grupo_usuario=grupo_usuario;

		this.modulo;

		this.controlador;

		this.accion;

		this.parametros;

		this.formularioToSerialize=null;

		this.capa;

		this.tipo;

		this.params;

		this.url="../AnteFrontController.php";

		this.enlaceExterno=null;
		
		this.ObjetoJson=new Empleado();	

	}



transaccionesPostGet.prototype={		

	

	"init":function(controlador,accion,parametros,capa,tipo)

	{

		this.controlador=controlador;

		this.accion=accion;

		this.parametros=parametros;

		this.capa=capa;

		this.tipo=tipo;

		},

	"setModulo":function(modulo)

	{

		this.modulo=modulo;		

		},

			

	"evaluarTipoAtributos":function()

	{

		var value=this.parametros;

		var s = typeof value;

		

		if (s === 'object') 

		{

			if (value) 

			{

				if (typeof value.length === 'number' && !(value.propertyIsEnumerable('length')) && typeof value.splice === 'function') 

				{

					s = 'array';

					}

				} else {

					s = 'null';

					}

				}

				return s;

		},

	"empty":function()

	{

		var o=this.parametros;

		if(o==="")

		{

			return true;

			}else{

				return false;

				}		

		},

	"construir_parametros":function()

	{

		var parametros="";

		var parametrosRecibidos=this.parametros;		

		if(this.empty()!=true)

		{

			var tipo=this.evaluarTipoAtributos();

			

			switch(tipo)

			{

				case "array":

				$.each(parametrosRecibidos, function(indice, valor)

				{

					parametros+="&"+indice+"="+valor;

					});				 

				break;

				case "object":

				$.each(parametrosRecibidos, function(indice, valor)

				{

					parametros+="&"+indice+"="+valor;

					});	

				break;

				case "string":

				alert(parametrosRecibidos)

				jAlert("Error: Al enviar parametros internos,se recibio un 'string',se requiere un ID='valor' ","Error");				

				break;

				case "number":

				jAlert("Error: Al enviar parametros internos,se recibio un 'number',se requiere un ID='valor' ","Error");

				break;

				case "boolean":

				jAlert("Error: Al enviar parametros internos,se recibio un 'boolean',se requiere un ID='valor' ","Error");

				break;

				case "undefined":

				jAlert("Error: Al enviar parametros internos,se recibio un 'undefined',se requiere un ID='valor' ","Error");

				break;

				default:

				jAlert("Error: Al enviar parametros internos,se recibio de forma desconocida,se requiere un ID='valor' ","Error");

				break;

				

				}

			}

			this.params=parametros;			

		},

	"construir_url":function()

	{
		/*

		var parametrosFormulario="";
		if(this.formularioToSerialize!="" || this.formularioToSerialize!=null){
			parametrosFormulario=this.serializarFormulario();
			this.params+="&"+parametrosFormulario;
		}
		*/
		var parametros="grupo="+this.grupo_usuario+"&modulo="+this.modulo+"&controlador="+this.controlador+
		               "&accion="+this.accion+"&capa="+this.capa+"&tipo="+this.tipo+this.params;
		this.params=parametros;
		this.formularioToSerialize=null;
		
		if(this.ObjetoJson.empleado.length>0){
		this.params+="&empleados="+$.toJSON(this.ObjetoJson.empleado);
		}
		
		console.debug(this.params)

	
		},

	

	"ejecutar":function(RespuestaAjax)



	{

		/* Este metodo se llama de la siguiente manera:

		1.-se intancia el objeto TransaccionesPostGet

		   var transacciones=new TransaccionesPostGet();

		2.-se envian los parametros.

		3.-y se ejecuta la transaccion de la siguiente manera:

		   transacciones.ejecutar(function(a) {

			   alert(a);

			   });, se debe enviar una funcion como parametro.

		*/

		

		var url=this.url;

		

		if(this.enlaceExterno!=null)

		{

			url=this.enlaceExterno;

			}

			

		$.ajax(

		{

			type:this.tipo,

			url:url,

			data: this.params,

			success: function (response)

			{				

				RespuestaAjax.call(this,response);

				

				}

			});

		},

		

	"formularioComoParametro":function(formulario)

	{

		this.formularioToSerialize=formulario;		

		},

		

	"serializarFormulario":function()

	{

		//crea la siguiente cadena: id="" & nombre=""

		parametrosForm=$('#'+this.formularioToSerialize).serialize();	

		return parametrosForm;

		

	},

		



	/*Obsoleto al crear el metodo formularioComoParametro()
     este metodo me crea un objeto json del formuario
	 mientras serialize crea un objeto string de tipo url para enviar por post
	"serializarFormularioTOJSON":function(formulario){

		$('#'+formulario).serializeObject()

	    resultado=$.toJSON($('#'+formulario).serializeObject());

	   // return resultado;	    

	    

	},*/

	

	

		

	"abrir_loader":function()

	{

		$.loader({

			className:"blue-with-image",

			content:"CARGANDO......"

			});

		},

	"cerrar_loader":function()

	{

		 $.loader('close');

		},
	
	

	"imprimir":function(){
		
		//jAlert(this.params)
		
		

		},	

	"write":function(){}

		

	}

	

	

	







