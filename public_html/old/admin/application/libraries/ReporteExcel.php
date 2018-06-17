<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Incluimos el archivo fpdf
require_once APPPATH."/third_party/phpexcel/PHPExcel.php";
 
//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class ReporteExcel extends PHPExcel {

	public function __construct() {
		parent::__construct();
	}

	// El encabezado del PDF
	function setHeader() {
		//Informacion del excel
		$this->getProperties()
			->setCreator("hardesk.com")
			->setLastModifiedBy("ihardesk.com")
			->setTitle("Exportar excel")
			->setSubject("Reportes");
	}
}
?>