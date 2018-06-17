<?php
class Pedido_temp_model extends CI_Model{

	/**
	 * Obtiene el pedido por id
	 * @param string $id
	 */
	function get($id) {
		$this->db->where('id', $id);
		
		$consulta = $this->db->get('pedidos_temp');
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	/**
	 * Guarda el pedido inicial en temporal
	 * @param unknown $id_cliente
	 */
	function guardar_pedido() {
		$data['sub_total_pedido'] = 0;
		$data['descuento_pedido'] = 0;
		$data['total_pedido'] = 0;
		$data['fecha_pedido'] = date('Y-m-d');

		$this->db->insert('pedidos_temp', $data);
	}

	/**
	 * Obtiene todos los items de un pedido
	 * @param unknown $id_pedido
	 */
	function get_detalle($id_pedido) {
		$this->db->where('id_pedido', $id_pedido);

		$consulta = $this->db->get('det_pedido_temp');
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	/**
	 * Obtiene el pedido por id
	 * @param unknown $id_pedido
	 * @return boolean
	 */
	function get_pedido_id($id_pedido){
		$this->db->select('pedidos_temp.id as id_pedido, ' . 
			'pedidos_temp.numero_pedido as numero_pedido ');
		$this->db->where('pedidos_temp.id', $id_pedido);
		$cotizacion=$this->db->get('pedidos_temp');

		if ($cotizacion->num_rows()>0) {
			return $cotizacion->result();
		} else {
			return false;
		}
	}

	/**
	 * Guarda el detalle del pedido temporal
	 * @param unknown $det_pedido
	 */
	function guardar_det_pedido($det_pedido) {
		$this->db->insert ( 'det_pedido_temp', $det_pedido );
	}

	/**
	 * Trae los detalles de un pedido
	 * @param unknown $id_pedido
	 * @return boolean
	 */
	function get_det_pedido($id_pedido){
		$this->db->where('id_pedido', $id_pedido);
		$det_pedido = $this->db->get('det_pedido_temp');

		if ($det_pedido->num_rows()>0) {
			return $det_pedido->result();
		} else {
			return false;
		}
	}

	/**
	 * Elimina un item de un pedido
	 * @param unknown $id_det_pedido
	 */
	function eliminar_det_pedido($id_det_pedido){
		$this->db->where('id', $id_det_pedido);
		$this->db->delete('det_pedido_temp');
	}

	/**
	 * Elimina los items de un pedido al cambiar de sucursal
	 * @param unknown $id_pedido
	 */
	function eliminar_det_cotizacion_sucursal($id_pedido){
		$this->db->where('id_pedido', $id_pedido);
		$this->db->delete('det_pedido_temp');
	}

	/**
	 * Actualiza el pedido temporal para pasar a el pedido real
	 * @param unknown $id
	 * @param unknown $pedido
	 */
	function actualizar_cotizacion($id, $pedido) {
		$this->db->where ( 'id', $id );
		$this->db->update ( 'pedidos_temp', $pedido );
	}

	/**
	 * Verifica si el producto que se va a agregar ya existe
	 * @param unknown $id_pedido
	 * @param unknown $id_producto
	 * @return boolean
	 */
	function existe_producto($id_pedido, $id_producto) {
		$this->db->where('id_pedido', $id_pedido);
		$this->db->where('id_producto', $id_producto);
		$det_cotizacion = $this->db->get ( 'det_pedido_temp' );

		$valor = 0;
		if ($det_cotizacion->num_rows () > 0) {
			return $det_cotizacion->result();
		} else {
			return false;
		}
	}

	/**
	 * Actualiza el item del pedido
	 * @param unknown $id
	 * @param unknown $detalle
	 */
	function actualizar_detalle($id, $detalle) {
		$this->db->where ('id', $id);
		$this->db->update ('det_pedido_temp', $detalle );
	}

	/**
	 * Guarda un item en el pedido
	 * @param unknown $detalle_pedido
	 */
	function guardar_detalle($detalle_pedido) {
		$this->db->insert ( 'det_pedido_temp', $detalle_pedido );
	}

	/**
	 * Se actualiza la pedido
	 * @param unknown $id_pedido
	 * @param unknown $data_pedido
	 */
	function actualizar_pedido($id_pedido, $data_pedido) {
		$this->db->where('id', $id_pedido);
		$this->db->update('pedidos_temp', $data_pedido);
	}
}