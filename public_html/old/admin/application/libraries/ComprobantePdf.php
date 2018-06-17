<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Incluimos el archivo fpdf
require_once APPPATH."/third_party/fpdf/fpdf.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class ComprobantePdf extends FPDF {

	public function __construct() {
		parent::__construct();
	}

	// El encabezado del PDF
	function Header(){
		// src, x, y, w, h, type, link
		$this->Image('img/logo.jpg',8,5,50);
		$this->SetFont('Arial','B',15);
		$this->Ln(8);
		$this->SetFont('Arial','B',18);
		$this->SetTextColor(0,0,0);
		$this->Text(75,25,utf8_decode('sondemiga.com'),0,0,'D');

		$this->SetDrawColor(255,0,0);
		$this->SetLineWidth(1);
		// x, y, w, h

		$this->Rect(135, 13, 60, 20);

		// Recuadro de RUT
		$this->SetFont('Arial','B',12);
		$this->SetTextColor(255,0,0);
		$this->Text(150, 25, utf8_decode('PEDIDO N° ' . $this->numero_comprobante));

		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',12);

		$this->Ln(36);

		$x_cliente = 15;
		$this->SetX($x_cliente);
		$this->Cell(20,3,utf8_decode('Cliente'),0,0,'D');
		$this->Cell(60,3,utf8_decode(' :   ' . $this->cliente),0,0,'D');
		$this->Cell(30,3,utf8_decode('Día Pedido'),0,0,'D');
		$this->Cell(40,3,utf8_decode(' :   ' . $this->dia_pedido),0,0,'D');
		$this->Ln(6);
		$this->SetX($x_cliente);
		$this->Cell(20,3,utf8_decode('Dirección'),0,0,'D');
		$this->Cell(60,3,utf8_decode(' :   ' . $this->direccion_cliente),0,0,'D');
		$this->Cell(30,3,utf8_decode('Hora Pedido'),0,0,'D');
		$this->Cell(40,3,utf8_decode(' :   ' . $this->hora_pedido),0,0,'D');
		$this->Ln(6);
		$this->SetX($x_cliente);
		$this->Cell(20,3,utf8_decode('Teléfono'),0,0,'D');
		$this->Cell(40,3,utf8_decode(' :   ' . $this->telefono_cliente),0,0,'D');
	}

	// El pie del pdf
	function Footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
	}

	function setNumeroComprobante($numero_comprobante) {
		$this->numero_comprobante = $numero_comprobante;
	}

	// Cliente
	function setCliente($cliente) {
		$this->cliente = $cliente;
	}

	function setDireccionCliente($direccion_cliente) {
		$this->direccion_cliente = $direccion_cliente;
	}

	function setTelefonoCliente($telefono_cliente) {
		$this->telefono_cliente = $telefono_cliente;
	}

	function setDiaPedido($dia_pedido) {
		$this->dia_pedido = $dia_pedido;
	}

	function setHoraPedido($hora_pedido) {
		$this->hora_pedido = $hora_pedido;
	}

	function RoundedRect($x, $y, $w, $h, $r, $style = '') {
		$k = $this->k;
		$hp = $this->h;
		if($style=='F') {
			$op='f';
		} else if($style=='FD' || $style=='DF') {
			$op='B';
		} else {
			$op='S';
			$MyArc = 4/3 * (sqrt(2) - 1);
			$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
			$xc = $x+$w-$r ;
			$yc = $y+$r;
			$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

			$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
			$xc = $x+$w-$r ;
			$yc = $y+$h-$r;
			$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
			$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
			$xc = $x+$r ;
			$yc = $y+$h-$r;
			$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
			$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
			$xc = $x+$r ;
			$yc = $y+$r;
			$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
			$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
			$this->_out($op);
		}
	}
	
	function _Arc($x1, $y1, $x2, $y2, $x3, $y3) {
		$h = $this->h;
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
			$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
	}
}
?>