<?php
define('BARCO_VERSION', '0.1');
define('BARCO_BASE', dirname(__FILE__) . DIRECTORY_SEPARATOR);

class barco {


	/**
	 * Para evitar la construccion accidental de la clase (modo statico solamente)
	 *
	 */
	private function __construct() {}
	private function __clone() {}

	/**
	 * inicializa el barco code base
	 *
	 * @param string $config_file path
	 * @return boolean
	 */
	public static function init($config_file = '') {
		try {
			#permite configurar algunas opciones
			if (is_file($config_file)) {
				require($config_file);
			}
			#requiero los archivos básicos
			require_once(BARCO_BASE . 'code/barco_code.inc.php');
			return true;
		} catch(exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * Retorna un tipo de generador de barcode especifico, base
	 *
	 * @param string $codetype
	 * @return barco_code
	 * @static
	 */
	public static function generate($codetype = 'qr') {
		#comprobamos inicialmente la existencia del adaptador
		$dirname = BARCO_BASE . 'code' . DIRECTORY_SEPARATOR . $codetype . DIRECTORY_SEPARATOR;
		$classname = 'barco_' . $codetype;
		$filename = $dirname . $classname . '.php';
		if (is_dir($dirname)) {
			if (is_file($filename)) {
				require_once($filename);
				if (class_exists($classname, false)) {
					return new $classname();
				} else {
					throw new exception("Barco Barcode error: the class {$classname} for generator {$doctype} is not loaded");
				}
			} else {
				throw new exception("Barco Barcode error: the file {$filename} for generator {$codetype} not exists!");
			}
		} else {
			throw new exception("Barco Barcode error: Directory {$dirname} for generator no exists!");
		}
	}

	public static function scan() {

	}

	/**
	 * Retorna la version actual del paquete
	 *
	 * @return string version
	 */
	public static function version() {
		return BARCO_VERSION;
	}
}
?>