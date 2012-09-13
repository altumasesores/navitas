<?php
/**
* Clase Labs_FTP. Gestión de archivos por medio del Protocolo de Transferencia de Archivos (FTP).
* Derechos de autor © 2009 Gilberto Pineda Vanegas <gilberto.pineda@gmail.com>
*
* Este programa es software libre: usted puede redistribuirlo y/o modificarlo bajo los términos de
* la GNU General Public License publicada por la Free Software Foundation, bien de la versión 3 de
* la Licencia, o (a su elección) cualquier versión posterior.
*
* Este programa se distribuye con la esperanza de que sea útil, pero SIN NINGUNA GARANTÍA, incluso
* sin la garantía implícita de COMERCIABILIDAD o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. Consulte
* la GNU General Public License para más detalles.
*
* Usted debería haber recibido una copia de la GNU General Public License junto con este programa.
* De lo contrario, véase <http://www.gnu.org/licenses/>.
**/
class Labs_FTP {
 
	private $_servidor 	= NULL;
	private $_usuario 	= NULL;
	private $_clave 	= NULL;
	/*
		Constructor de la clase.
	*/
	public function __construct( $p_servidor , $p_usuario , $p_clave ) {
 
		if ( ( $p_servidor != NULL ) && ( $p_usuario != NULL ) && ( $p_clave != NULL ) ) {
 
			$this->_servidor 	= $p_servidor;
			$this->_usuario 	= $p_usuario;
			$this->_clave 		= $p_clave;
 
			$this->conectarFTP();
 
		} else {
 
			return false; // FTP_DATOS_DESCONOCIDOS
 
		}
 
	}
	/*
		Intenta abrir una conexion FTP y autenticarse en el Servidor.
	*/
	private function conectarFTP() {
					 // Abre una conexion FTP.
		$this->_id = ftp_connect( $this->_servidor );
					// Inicia sesion en una conexion FTP.
		$ftpLogin = ftp_login( $this->_id , $this->_usuario , $this->_clave );
 
		if( ( !$this->_id ) || ( !$ftpLogin ) ) {
 
			return false; // FTP_CONEXION_FALLO
 
		}
 
	}
	/*
		Cierra una conexion FTP.
	*/
	private function desconectarFTP( $p_ftpId ) {
		//Cierra una conexion FTP.
		ftp_close( $p_ftpId );
 
	}
	/*
		Carga el archivo al Servidor mediante FTP.
	*/
	public function cargarArchivo( $p_ruta , $p_tipo , $p_fuente , $p_cerrar ) {
 
		$this->limpiarCadena( $p_ruta );
 
		$this->obtenerTipo( $p_tipo );
 
		$this->ftpDestino = $this->_ruta . '/' . $this->generarNombreArchivo() . '.' . $this->_tipo;
					// Carga un archivo al servidor FTP.
		$ftpCarga = ftp_put( $this->_id , $this->ftpDestino , $p_fuente , FTP_BINARY );
 
		if( $p_cerrar ) {
 
			$this->desconectarFTP( $this->_id );
 
		}
 
		if( $ftpCarga ) {
 
			return true; // FTP_CARGA_EXITO
 
		} else {
 
			return false; // FTP_CARGA_FALLO
 
		}
 
	}
	/*
		Elimina un archivo del Servidor mediante FTP.
	*/
	public function eliminarArchivo( $p_ruta , $p_cerrar ) {
 
		$this->limpiarCadena( $p_ruta );
					  // Elimina un archivo en el servidor FTP.
		$ftpElimina = ftp_delete( $this->_id , $this->_ruta );
 
		if( $p_cerrar ) {
 
			$this->desconectarFTP( $this->_id );
 
		}
 
		if( $ftpElimina ) {
 
			return true; // FTP_ELIMINACION_EXITO
 
		} else {
 
			return false; // FTP_ELIMINACION_FALLO
 
		}
 
	}
	/*
		Lista los archivos del directorio seleccionado.
	*/
	public function listarArchivos( $p_ruta , $p_cerrar ) {
 
		$this->limpiarCadena( $p_ruta );
 
		$listaArchivos = NULL;
							 // Devuelve una lista de archivos en el directorio dado.
		if( $arrayArchivos = ftp_nlist( $this->_id , $this->_ruta ) ) {
							  // Cuenta los elementos de una matriz o propiedades de un objeto.
			for( $i = 0; $i < count( $arrayArchivos ); $i++ ) {
 
				$listaArchivos .= $arrayArchivos[$i] . '<br />';
 
			}
 
		}
 
		if( $p_cerrar ) {
 
			$this->desconectarFTP( $this->_id );
 
		}
 
		return $listaArchivos;
 
	}
	/*
		Da formato a la cadena de la ruta.
	*/
	private function limpiarCadena( $p_ruta ) {
				  // Elimina espacios en blanco (u otros caracteres) del principio y final de una cadena.
		$p_ruta = trim( $p_ruta );
 
		$this->_ruta = $p_ruta;
 
	}
	/*
		Obtiene el tipo de archivo subido.
	*/
	private function obtenerTipo( $p_tipo ) {
										   // Encuentra la posición de la primera aparición de una cadena.
					   // Devuelve parte de una cadena.
		$this->_tipo = substr( $p_tipo , ( strpos( $p_tipo , '/' ) ) + 1 );
 
	}
	/*
		Genera un nombre unico para el archivo cargado.
	*/
	private function generarNombreArchivo() {
							// Generar un entero aleatorio.
					// Generar un ID único.
			   // Calcula el hash md5 de una cadena.
		return md5( uniqid( rand(), true ) );
 
	}
 
}
 
?>