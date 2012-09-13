/*
 * Copyright 2009 Luis Alberto Medina Bravo
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Quita las Ñ's
 */
function removeEnes(texto) {
    return texto.replace(/\u00d1/g,"X");
}

/**
 * Quita las / y las '
 */
function removeDiagonalesComillaSimple(texto) {
    texto = texto.replace(/\//g, " ");
    return texto = texto.replace(/\'/g, " ");
}

/**
 * Quita José y María
 */
function removeMariaYJose(texto) {

    if (((texto.substr(0, 4) == "JOSÉ") || (texto.substr(0, 4) == "JOSE")) && texto.length == 4) {
        return texto;
    }
    if (((texto.substr(0, 5) == "MARÍA") || (texto.substr(0, 5) == "MARIA")) && texto.length == 5 ) {
        return texto;
    }
    return texto;
}

/**
 * Quita Proposiciones
 */
function removeProposiciones(texto) {

    var preposiciones = new Array(21);
    preposiciones[0] = "DA ";
    preposiciones[1] = "DAS ";
    preposiciones[2] = "DE ";
    preposiciones[3] = "DEL ";
    preposiciones[4] = "DER ";
    preposiciones[5] = "DI ";
    preposiciones[6] = "DIE ";
    preposiciones[7] = "DD ";
    preposiciones[8] = "EL ";
    preposiciones[9] = "LA ";
    preposiciones[10] = "LOS ";
    preposiciones[11] = "LAS ";
    preposiciones[12] = "LE ";
    preposiciones[13] = "LES ";
    preposiciones[14] = "MAC ";
    preposiciones[15] = "MC ";
    preposiciones[16] = "VAN ";
    preposiciones[17] = "VON ";
    preposiciones[18] = "Y ";
    preposiciones[19] = "MA ";
    preposiciones[20] = "MA. ";

    for (i = 0; i < preposiciones.length; i++) {
        if (texto.substr(0, preposiciones[i].length) == preposiciones[i]) {
            texto = texto.substr(preposiciones[i].length, texto.length).trim();
            i = 0;
        }
    }

    return texto;
}

/**
 * Quita las palabras compuestas
 */
function removePalabrasCompuestas(texto) {

    for (i = 0; i < texto.length; i++) {
        if (texto.charAt(i) == " ") {
            return texto.substr(0, i);
        }
    }

    return texto;
}

/**
 * Quita las malas palabras
 */
function removeBadWords(texto) {

    var badwords = new Array(84);
    badwords[0] = "BUEI";
    badwords[1] = "BUEY";
    badwords[2] = "CACA";
    badwords[3] = "CACO";
    badwords[4] = "CAGA";
    badwords[5] = "CAGO";
    badwords[6] = "CAKA";
    badwords[7] = "CAKO";
    badwords[8] = "COGE";
    badwords[9] = "COGI";
    badwords[10] = "COJA";
    badwords[11] = "COJE";
    badwords[12] = "COJI";
    badwords[13] = "COJO";
    badwords[14] = "COLA";
    badwords[15] = "CULO";
    badwords[16] = "FALO";
    badwords[17] = "FETO";
    badwords[18] = "GETA";
    badwords[19] = "GUEI";
    badwords[20] = "GUEY";
    badwords[21] = "JETA";
    badwords[22] = "JOTO";
    badwords[23] = "KACA";
    badwords[24] = "KACO";
    badwords[25] = "KAGA";
    badwords[26] = "KAGO";
    badwords[27] = "KAKA";
    badwords[28] = "KAKO";
    badwords[29] = "KOGE";
    badwords[30] = "KOGI";
    badwords[31] = "KOJA";
    badwords[32] = "KOJE";
    badwords[33] = "KOJI";
    badwords[34] = "KOJO";
    badwords[35] = "KOLA";
    badwords[36] = "KULO";
    badwords[37] = "LILO";
    badwords[38] = "LOCA";
    badwords[39] = "LOCO";
    badwords[40] = "LOKA";
    badwords[41] = "LOKO";
    badwords[42] = "MAME";
    badwords[43] = "MAMO";
    badwords[44] = "MEAR";
    badwords[45] = "MEAS";
    badwords[46] = "MEON";
    badwords[47] = "MIAR";
    badwords[48] = "MION";
    badwords[49] = "MOCO";
    badwords[50] = "MOKO";
    badwords[51] = "MULA";
    badwords[52] = "MULO";
    badwords[53] = "NACA";
    badwords[54] = "NACO";
    badwords[55] = "PEDA";
    badwords[56] = "PEDO";
    badwords[57] = "PENE";
    badwords[58] = "PIPI";
    badwords[59] = "PITO";
    badwords[60] = "POPO";
    badwords[61] = "PUTA";
    badwords[62] = "PUTO";
    badwords[63] = "QULO";
    badwords[64] = "RATA";
    badwords[65] = "ROBA";
    badwords[66] = "ROBE";
    badwords[67] = "ROBO";
    badwords[68] = "RUIN";
    badwords[69] = "SENO";
    badwords[70] = "TETA";
    badwords[71] = "VUEI";
    badwords[72] = "VUEY";
    badwords[73] = "WUEI";
    badwords[74] = "WUEY";
    badwords[75] = "BACA";
    badwords[76] = "BAKA";
    badwords[77] = "BAGA";
    badwords[78] = "BAGO";
    badwords[79] = "VAKA";
    badwords[80] = "MIAN";
    badwords[81] = "VACA";
    badwords[82] = "VAGA";
    badwords[83] = "VAGO";

    for (i = 0; i < badwords.length; i++) {
        if (texto == badwords[i]) {
            texto = texto.substr(0, 1) + "X" + texto.substr(2, texto.length);
            return texto;
        }
    }

    return texto;
}

/**
 * Quita acentos del curp
 */
function removeTildes(texto) {
    // ACUTE
    texto = texto.replace(/\u00c1/g,"A");
    texto = texto.replace(/\u00c9/g,"E");
    texto = texto.replace(/\u00cd/g,"I");
    texto = texto.replace(/\u00d3/g,"O");
    texto = texto.replace(/\u00da/g,"U");
    // DIAERESIS
    texto = texto.replace(/\u00c4/g,"A");
    texto = texto.replace(/\u00cb/g,"E");
    texto = texto.replace(/\u00cf/g,"I");
    texto = texto.replace(/\u00d6/g,"O");
    texto = texto.replace(/\u00dc/g,"U");
    return texto;
}

/**
 * Obtiene los dos dígitos de la entidad federativa de nacimiento
 */
function getEntidadFederativaNacimiento(texto) {

    if (texto == "AGUASCALIENTES") {
        return "AS";
    } else if (texto == "BAJA CALIFORNIA") {
        return "BC";
    } else if (texto == "BAJA CALIFORNIA SUR") {
        return "BS";
    } else if (texto == "CAMPECHE") {
        return "CC";
    } else if (texto == "COAHUILA DE ZARAGOZA") {
        return "CL";
    } else if (texto == "COLIMA") {
        return "CM";
    } else if (texto == "CHIAPAS") {
        return "CS";
    } else if (texto == "CHIHUAHUA") {
        return "CH";
    } else if (texto == "DISTRITO FEDERAL") {
        return "DF"
    } else if (texto == "DURANGO") {
        return "DG";
    } else if (texto == "GUANAJUATO") {
        return "GT";
    } else if (texto == "GUERRERO") {
        return "GR";
    } else if (texto == "HIDALGO") {
        return "HG";
    } else if (texto == "JALISCO") {
        return "JC";
    } else if (texto == "ESTADO DE M\u00c9XICO") {
        return "MC";
    } else if (texto == "MICHOAC\u00C1N DE OCAMPO") {
        return "MN";
    } else if (texto == "MORELOS") {
        return "MS";
    } else if (texto == "NAYARIT") {
        return "NT";
    } else if (texto == "NUEVO LE\u00D3N") {
        return "NL";
    } else if (texto == "OAXACA") {
        return "OC";
    } else if (texto == "PUEBLA") {
        return "PL";
    } else if (texto == "QUERETARO") {
        return "QT";
    } else if (texto == "QUINTANA ROO") {
        return "QR";
    } else if (texto == "SAN LUIS POTOSI") {
        return "SP";
    } else if (texto == "SINALOA") {
        return "SL";
    } else if (texto == "SONORA") {
        return "SR";
    } else if (texto == "TABASCO") {
        return "TC";
    } else if (texto == "TAMAULIPAS") {
        return "TS";
    } else if (texto == "TLAXCALA") {
        return "TL";
    } else if (texto == "VERACRUZ") {
        return "VZ";
    } else if (texto == "YUCATAN") {
        return "YN";
    } else if (texto == "ZACATECAS") {
        return "ZS";
    }

    return "NE";
}

/**
 * Obtiene las consonantes internas del CURP
 */
function getConsonantesInternas(texto) {

    if (texto.length == 0) {
        return "X";
    }

    var tmp = "X";
    var vocales = "AEIOU";
    for (i = 1; i < texto.length; i++) {
        if (vocales.indexOf(texto.charAt(i)) == -1) {
            return tmp = texto.charAt(i);
        }
    }

    return tmp;
}

/**
 * Realiza las funciones necesarias sobre los apellidos y nombres de la persona
 */
function prepareNombresApellidos(texto, isNombre) {
    texto = texto.toUpperCase().trim();
    texto = removeTildes(texto);
    texto = removeEnes(texto);
    texto = removeDiagonalesComillaSimple(texto);
    if (isNombre) {
        texto = removeMariaYJose(texto);
    }
    texto = removeProposiciones(texto);
    texto = removePalabrasCompuestas(texto);
    return texto;
}

/**
 * Genera el RFC de una persona
 */
function rfc(primerApellido, segundoApellido, nombres, fechaNacimiento) {

    primerApellido = prepareNombresApellidos(primerApellido, false);
    segundoApellido = prepareNombresApellidos(segundoApellido, false);
    nombres = prepareNombresApellidos(nombres, true);
    nombres = removeTildes(nombres);
    fechaNacimiento = fechaNacimiento.trim();

    var rfc = "";

    if (primerApellido.length == 0) {
        rfc = "XX";
    } else {
        rfc = primerApellido.substr(0, 1);
        var tmp = "X";
        var vocales = "AEIOU";
        for (i = 1; i < primerApellido.length; i++) {
            if (vocales.indexOf(primerApellido.charAt(i)) != -1) {
                tmp = primerApellido.charAt(i);
                break;
            }
        }
        rfc += tmp;
    }

    if (segundoApellido.length == 0) {
        rfc += "X";
    } else {
        rfc += segundoApellido.substr(0, 1);
    }

    if (nombres.length == 0) {
        rfc += "X";
    } else {
        rfc += nombres.substr(0, 1);
    }

    rfc = removeBadWords(rfc);
    rfc += fechaNacimiento.substr(2, 2) + fechaNacimiento.substr(5, 2) + fechaNacimiento.substr(8, 2);
    
    return rfc;
}

/**
 * Genera el CURP de una persona
 */
function curp(primerApellido, segundoApellido, nombres, fechaNacimiento, entidadNacimiento, genero) {

    primerApellido = prepareNombresApellidos(primerApellido, false);
    segundoApellido = prepareNombresApellidos(segundoApellido, false);
    nombres = prepareNombresApellidos(nombres, true);
    fechaNacimiento = fechaNacimiento.trim();
    entidadNacimiento = entidadNacimiento.toUpperCase().trim();
    genero = genero.toUpperCase().trim();

    var curp = rfc(primerApellido, segundoApellido, nombres, fechaNacimiento);
    curp += genero + getEntidadFederativaNacimiento(entidadNacimiento);
    curp += getConsonantesInternas(primerApellido);
    curp += getConsonantesInternas(segundoApellido);
    curp += getConsonantesInternas(nombres);

    return curp;
}

/**
 * Muesta el curp
 */
function generateCurp() {

    if ((document.getElementById("fechaNacimiento").value == "") || ((!document.getElementById("generoF").checked) && (!document.getElementById("generoM").checked))) {
        return;
    }

    var primerApellido = document.getElementById("primerApellido").value;
    var segundoApellido = document.getElementById("segundoApellido").value;
    var nombres = document.getElementById("nombres").value;
    var fechaNacimiento = document.getElementById("fechaNacimiento").value;
    var entidadNacimiento = document.getElementById("estadosNacimiento").options[document.getElementById("estadosNacimiento").selectedIndex].text;
    var genero = "H";
    if (document.getElementById("generoF").checked) {
        genero = "M";
    }

    var tmpCurp = curp(primerApellido, segundoApellido, nombres, fechaNacimiento, entidadNacimiento, genero);
    if (document.getElementById("curp").value.length > 16 && document.getElementById("curp").value.substr(16,2) != "X0") {
        var digitoHomoclave = document.getElementById("curp").value.substr(16,2);
        document.getElementById("curp").value = tmpCurp + digitoHomoclave;
    } else {
        document.getElementById("curp").value = tmpCurp +  "X0";
    }
}
function generaRfcEmp() {
	
    if (document.getElementById("fecha_nac").value=='') {
        return;
    }
	else{
	//var fechaNacimiento= c +'/'+ b +'/'+ a ; 
	var fecha_nacim= document.getElementById("fecha_nac").value; 
	var elem = fecha_nacim.split('/');
		dia1 = elem[0];
		mes1 = elem[1];
		anio1 = elem[2];
		var fechaNacimiento= anio1 + "/"+ mes1 + "/" + dia1 ;
	
	 }

    var primerApellido = document.getElementById("ap_paterno").value;
    var segundoApellido = document.getElementById("ap_materno").value;
    var nombres = document.getElementById("nombre").value;
    //var fechaNacimiento = document.getElementById("fechaNacimiento").value;

    var tmpRfc = rfc(primerApellido, segundoApellido, nombres, fechaNacimiento);
    if (document.getElementById("curp_empleado").value.length > 10 && document.getElementById("curp_empleado").value.substr(10, 3) != "XX0") {
        var homoclave = document.getElementById("curp_empleado").value.substr(10, 3);
        document.getElementById("curp_empleado").value = tmpRfc + homoclave;
    } else {
        document.getElementById("curp_empleado").value = tmpRfc;
    }

}

/**
 * Muestra el rfc
 */
/* function generateRfc() {

    if (document.getElementById("fechaNacimiento").value == "") {
        return;
    }

    var primerApellido = document.getElementById("primerApellido").value;
    var segundoApellido = document.getElementById("segundoApellido").value;
    var nombres = document.getElementById("nombres").value;
    var fechaNacimiento = document.getElementById("fechaNacimiento").value;

    var tmpRfc = rfc(primerApellido, segundoApellido, nombres, fechaNacimiento);

    if (document.getElementById("rfc").value.length > 10 && document.getElementById("rfc").value.substr(10, 3) != "XX0") {
        var homoclave = document.getElementById("rfc").value.substr(10, 3);
        document.getElementById("rfc").value = tmpRfc + homoclave;
    } else {
        document.getElementById("rfc").value = tmpRfc + "XX0";
    }

}
 */
 function generaRfc() {
	/* var a = document.getElementById("dia_nac").value;
	var b = document.getElementById("mes_nac").value;
	var c = document.getElementById("anio_nac").value;
    if (a=='' || b=='' || c=='') {
        return;
    }
	else{
	var fechaNacimiento= c +'/'+ b +'/'+ a ; 
	
	 } */
	 var a = document.getElementById("fecha_nac").value;
    if (a=='') {
        return;
    }
	else{
	var elem = a.split('/');
		dia1 = elem[0];
		mes1 = elem[1];
		anio1 = elem[2];
		var fechaNacimiento= anio1 + "/"+ mes1 + "/" + dia1 ;
	
	 }

    var primerApellido = document.getElementById("ap_paterno").value;
    var segundoApellido = document.getElementById("ap_materno").value;
    var nombres = document.getElementById("nombre").value;
    //var fechaNacimiento = document.getElementById("fechaNacimiento").value;

    var tmpRfc = rfc(primerApellido, segundoApellido, nombres, fechaNacimiento);
    if (document.getElementById("curp_empleado").value.length > 10 && document.getElementById("curp_empleado").value.substr(10, 3) != "XX0") {
        var homoclave = document.getElementById("curp_empleado").value.substr(10, 3);
        document.getElementById("curp_empleado").value = tmpRfc + homoclave;
    } else {
        document.getElementById("curp_empleado").value = tmpRfc;
    }

}
// -- Javascript Trim Member Functions --

/**
 * Añade la función trim a un String
 *
 * Esta función se deshace de los espacios en blanco tanto para el comienzo de
 * la cadena como para el final, o para ambos.
 */
String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g,"");
}

/**
 * Añade la función ltrim a un String
 *
 * Elimina todos los espacios en blanco del comienzo de la cadena.
 */
String.prototype.ltrim = function() {
    return this.replace(/^\s+/,"");
}

/**
 * Añade la función rtrim a un String
 *
 * Elimina todos los espacios en blanco del final de la cadena.
 */
String.prototype.rtrim = function() {
    return this.replace(/\s+$/,"");
}