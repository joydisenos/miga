<?php
class Cliente_model extends CI_Model {

	/**
	 * Obtiene los clientes, si se pasa el id devuelve ese cliente
	 * @param string $id
	 */
	function get($inicio = FALSE, $limite = FALSE, $id = FALSE) {
		$consulta = 'c.* ';
		$this->db->select($consulta);
		$this->db->from('cliente as c');

		if ($id !== FALSE) {
			$this->db->where('c.id', $id);
		}

		$this->db->where('c.estado_logico', 'A');
	
		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}

		$this->db->order_by('c.id', 'desc');

		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	/**
	 * Guarda el cliente
	 * @param cliente $cliente
	 */
	function guardar($cliente) {
		$this->db->insert('cliente', $cliente);
	}

	/**
	 * Actualiza el cliente por id
	 * @param cliente $cliente
	 * @param int $id
	 */
	function actualizar($cliente, $id) {
		$this->db->where('id', $id);
		$this->db->update('cliente', $cliente);
	}

	/**
	 * Obtiene los clientes, si se pasa el id devuelve ese cliente
	 * @param string $id
	 */
	function get_por_filtro($inicio = FALSE, $limite = FALSE, $id = FALSE, $nombre, $correo, $telefono) {
		$consulta = 'c.* ';
		$this->db->select($consulta);
		$this->db->from('cliente as c');

		if ($id !== FALSE) {
			$this->db->where('c.id', $id);
		}

		if($nombre !== null && $nombre !== ''){
			$this->db->like('c.nombre', $nombre);
		}

		if($correo !== null && $correo !== ''){
			$this->db->like('c.email', $correo);
		}

		if($telefono !== null && $telefono !== ''){
			$this->db->like('c.telefono', $telefono);
		}

		$this->db->where('c.estado_logico', 'A');

		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}

		$this->db->order_by('c.id', 'desc');

		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	/**
	 * Obtiene los clientes, si se pasa el id devuelve ese cliente
	 * @param string $id
	 */
	function get_json() {
		$consulta = 'c.id, c.nombre ';
		$this->db->select($consulta);
		$this->db->from('cliente as c');

		$this->db->order_by('c.id', 'desc');

		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	function get_puntos($area = FALSE, $telefono = FALSE, $id = FALSE) {
		$consulta = 'c.* ';
		$this->db->select($consulta);
		$this->db->from('cliente as c');

		if ($telefono !== FALSE && $telefono !== FALSE) {
			$this->db->where('c.telefono', $telefono);
			$this->db->where('c.codigo_area', $area);
		}

		if ($id !== FALSE) {
			$this->db->where('c.id', $id);
		}
		$this->db->where('c.estado_logico', 'A');

		$consulta = $this->db->get();
		$puntos = 0;
		if ($consulta->num_rows() > 0) {
			foreach ($consulta->result() as $row) {
				$puntos = $row->puntos_acumulados;
			}
		}

		return $puntos;
	}
}