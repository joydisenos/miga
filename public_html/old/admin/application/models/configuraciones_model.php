<?php
class Configuraciones_model extends CI_Model {

	/**
	 * Obtiene los clientes, si se pasa el id devuelve ese configuraciones
	 * @param string $id
	 */
	function get($inicio = FALSE, $limite = FALSE, $id = FALSE) {
		$consulta = 'c.* ';
		$this->db->select($consulta);
		$this->db->from('configuraciones as c');

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

	function get_porcentaje_puntos() {
		$consulta = 'c.* ';
		$this->db->select($consulta);
		$this->db->from('configuraciones as c');

		$this->db->where('c.id', 2);

		$this->db->where('c.estado_logico', 'A');

		$this->db->order_by('c.id', 'desc');

		$consulta = $this->db->get();
		$valor = 0;
		if ($consulta->num_rows() > 0) {
			foreach ($consulta->result() as $row) {
				$valor = $row->valor;
			}
		}
		return $valor;
	}

	function get_valor_envio() {
		$consulta = 'c.* ';
		$this->db->select($consulta);
		$this->db->from('configuraciones as c');

		$this->db->where('c.id', 1);

		$this->db->where('c.estado_logico', 'A');

		$this->db->order_by('c.id', 'desc');

		$consulta = $this->db->get();
		$valor = 0;
		if ($consulta->num_rows() > 0) {
			foreach ($consulta->result() as $row) {
				$valor = $row->valor;
			}
		}
		return $valor;
	}

	/**
	 * Actualiza el configuraciones por id
	 * @param configuraciones $configuraciones
	 * @param int $id
	 */
	function actualizar($configuraciones, $id) {
		$this->db->where('id', $id);
		$this->db->update('configuraciones', $configuraciones);
	}
}