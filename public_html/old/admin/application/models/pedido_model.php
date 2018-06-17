<?php
class Pedido_model extends CI_Model{

	/**
	 * Guarda la pedido
	 * @param unknown $pedido
	 */
	function guardar_pedido($pedido) {
		$this->db->insert('pedidos', $pedido);
		return mysql_insert_id();
	}

	/**
	 * Guarda los items de la pedido
	 * @param unknown $det_pedido
	 */
	function guardar_det_pedido($det_pedido) {
		$this->db->insert('det_pedido', $det_pedido);
	}

	/**
	 * Se actualiza la pedido
	 * @param unknown $id_pedido
	 * @param unknown $data_pedido
	 */
	function actualizar_pedido($id_pedido, $data_pedido) {
		$this->db->where('id', $id_pedido);
		$this->db->update('pedidos', $data_pedido);
	}

	/**
	 * Obtiene el numero de la ultima pedido
	 * @return unknown
	 */
	function ultimo_pedido() {
		$this->db->select_max('numero_pedido');
		$pedido=$this->db->get('pedidos');

		$valor = 0;
		if ($pedido->num_rows()>0) {
			foreach ($pedido->result() as $row) {
				$valor = $row->numero_pedido;
			}
			return $valor;
		} else {
			return $valor;
		}
	}

	function actualizar($pedido, $id) {
		$this->db->where('id', $id);
		$this->db->update('pedidos', $pedido);
	}

	/**
	 * Obtiene la pedido por id
	 * @param unknown $id_pedido
	 * @return boolean
	 */
	function get_pedido_id($id_pedido){
		$this->db->select('pedidos.id as id_pedido, cliente.nombre as cliente_nombre, pedidos.dia_pedido as dia_pedido, pedidos.hora_pedido as hora_pedido, pedidos.tipo_pago as tipo_pago_pedido, ' .
				'pedidos.numero_pedido as numero_pedido, pedidos.fecha_pedido as fecha_pedido, pedidos.total_pedido as total_pedido, ' .
				'pedidos.id_cliente, pedidos.sub_total_pedido as pedido_sub_total, usuario.nombre as usuario_nombre, ' . 
				'pedidos.observaciones as observaciones_pedido, pedidos.descuento_pedido as total_descuento, pedidos.total_envio as total_envio, ' .
				'pedidos.id_estado_pedido as id_estado_pedido ');
		$this->db->join('cliente', 'pedidos.id_cliente = cliente.id', 'left');
		$this->db->join('usuario', 'pedidos.usuario_ingreso = usuario.id', 'left');
		$this->db->where('pedidos.id', $id_pedido);
		$this->db->where('pedidos.estado_logico', 'A');
		
		$pedido=$this->db->get('pedidos');

		if ($pedido->num_rows()>0) {
			return $pedido->result();
		} else {
			return false;
		}
	}

	function get_pedidos($inicio = FALSE, $limite = FALSE, $id = FALSE){
		$this->db->select('pedidos.id as id_pedido, cliente.nombre as cliente_nombre, pedidos.id_estado_pedido as id_estado_pedido, ' . 
				'pedidos.id_cliente as id_cliente, pedidos.dia_pedido as dia_pedido, pedidos.hora_pedido as hora_pedido, pedidos.id_estado_pedido as id_estado_pedido, pedidos.tipo_pago as tipo_pago_pedido,' .
				'pedidos.numero_pedido as numero_pedido, pedidos.fecha_pedido as fecha_pedido, pedidos.total_pedido as total_pedido, pedidos.total_envio as total_envio, ' .
				'pedidos.observaciones as observaciones_pedido, estado_pedido.descripcion as desc_estado_pedido, estado_pedido.class_btn as class_btn_estado ');
		$this->db->join('cliente', 'pedidos.id_cliente = cliente.id', 'left');
		$this->db->join('estado_pedido', 'pedidos.id_estado_pedido = estado_pedido.id', 'left');
		$this->db->join('usuario', 'pedidos.usuario_ingreso = usuario.id', 'left');
				
		$this->db->where('pedidos.estado_logico', 'A');
		$this->db->order_by('pedidos.id', 'desc');

		if ($id !== FALSE) {
			$this->db->where('pedidos.id', $id);
		}

		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}

		$compra=$this->db->get('pedidos');
		if ($compra->num_rows()>0) {
			return $compra->result();
		} else {
			return false;
		}
	}

	function get_det_pedido($id_pedido){
		$this->db->select('det_pedido.* ');
		
		$this->db->where('det_pedido.id_pedido', $id_pedido);
		$det_pedido=$this->db->get('det_pedido');

		if ($det_pedido->num_rows()>0) {
			return $det_pedido->result();
		} else {
			return false;
		}
	}
	
	function eliminar_det_pedido_id($id_pedido, $data_pedido){
		$this->db->where('id_pedido', $id_pedido);
		$this->db->update('det_pedido', $data_pedido);
	}

	function get_por_filtro($inicio = FALSE, $limite = FALSE, $numero, $cliente, $estado, $telefono_cliente){
		$this->db->select('pedidos.id as id_pedido, cliente.nombre as cliente_nombre, pedidos.id_estado_pedido as id_estado_pedido, ' . 
				'pedidos.id_cliente as id_cliente, pedidos.dia_pedido as dia_pedido, pedidos.hora_pedido as hora_pedido, pedidos.id_estado_pedido as id_estado_pedido, pedidos.tipo_pago as tipo_pago_pedido,' .
				'pedidos.numero_pedido as numero_pedido, pedidos.fecha_pedido as fecha_pedido, pedidos.total_pedido as total_pedido, pedidos.total_envio as total_envio, ' .
				'pedidos.observaciones as observaciones_pedido, estado_pedido.descripcion as desc_estado_pedido, estado_pedido.class_btn as class_btn_estado ');
		$this->db->join('cliente', 'pedidos.id_cliente = cliente.id', 'left');
		$this->db->join('estado_pedido', 'pedidos.id_estado_pedido = estado_pedido.id', 'left');
		$this->db->join('usuario', 'pedidos.usuario_ingreso = usuario.id', 'left');

		if($numero !== null && $numero !== ''){
			$this->db->where('pedidos.numero_pedido', $numero);
		}

		if($cliente !== null && $cliente !== ''){
			$this->db->like('cliente.nombre', $cliente);
		}

		if($telefono_cliente !== null && $telefono_cliente !== ''){
			$this->db->like('cliente.telefono', $telefono_cliente);
		}

		if($estado !== null && $estado !== ''){
			if($estado > 0) {
				$this->db->where('pedidos.id_estado_pedido', $estado);
			}
		}

		$this->db->where('pedidos.estado_logico', 'A');

		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}		

		$compra=$this->db->get('pedidos');
		if ($compra->num_rows()>0) {
			return $compra->result();
		} else {
			return false;
		}
	}

	function get_pedido_puntos($id_pedido){
		$this->db->select('p.*');

		$this->db->where('p.estado_logico', 'A');
		$this->db->where('p.id', $id_pedido);

		$pedido = $this->db->get('pedidos as p');

		$id_cliente = FALSE;
		if ($pedido->num_rows()>0) {
			return $pedido->result();
		} else {
			return FALSE;
		}
	}

	function get_estados() {
		$this->db->where('estado_logico', 'A');

		$consulta = $this->db->get('estado_pedido');
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}
}