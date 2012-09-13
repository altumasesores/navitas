//**HEREDANDO el manejador de transacciones**//
//contruimos la clase del grupo.
var transaccionesClientes=function(){};
//heredamos del manejador y enviamos el grupo al que pertenece el conjunto de modulos.
transaccionesClientes.prototype=new transaccionesPostGet("clientes");
//intanciamos el contructor de la clase del grupo,para evitar errores durante la herencia.
transaccionesClientes.prototype.constructor=transaccionesClientes;
/*
instanciamos la clase del grupo en la vistaPrincipal.php, que será la contenedora de todas las vistas,
ademas que será donde extenderemos la nueva clase de grupo "transaccionesClientes()" y le agregaremos los metodos 
que necesite el modulo especificado.
cada modulo dentro del grupo,tendra su propio contenedor de vistas, el cual realiza la misma funcion descrita arriba,
sin embargo en cada una extenderemos la clase y la instanciaremos segun los requerimientos de cada modulo,el fin de esto 
es separar los metodos requeridos por cada modulo, sin amontonar las funciones en un solo lugar.
*/





