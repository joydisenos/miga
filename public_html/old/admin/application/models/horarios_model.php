<?php
class Horarios_model extends CI_Model {

	function get() {		
		$this->db->where('id', 1);

		$consulta = $this->db->get('horarios');
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return false;
		}
	}

	function actualizar($horarios) {
		$this->db->where('id', 1);
		$this->db->update('horarios', $horarios);
	}

	function get_especiales($inicio = FALSE, $limite = FALSE, $id = FALSE) {
		$consulta = 'u.* ';
		$this->db->select($consulta);
		$this->db->from('horarios_especiales as u');

		if ($id !== FALSE) {
			$this->db->where('u.id', $id);
		}

		$this->db->where('u.estado_logico', 'A');

		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}

		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return false;
		}
	}

	function guardar_especiales($horarios_especiales) {
		$this->db->insert('horarios_especiales', $horarios_especiales);
	}

	function actualizar_especiales($horarios_especiales, $id) {
		$this->db->where('id', $id);		
		$this->db->update('horarios_especiales', $horarios_especiales);
	}
}

/* Fin del archivo horarios_model.php */
/* Ubicación: ./application/model/horarios_model.php */