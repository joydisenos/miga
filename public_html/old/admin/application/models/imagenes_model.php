<?php
class Imagenes_model extends CI_Model {
	
	function get($inicio = FALSE, $limite = FALSE, $id = FALSE) {
		$consulta = 'i.*';
		$this->db->select($consulta);
		$this->db->from('imagenes as i');
		if ($id !== FALSE) {
			$this->db->where('i.id', $id);
		}
		
		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}
		
		$this->db->where('i.estado_logico', 'A');
		$this->db->order_by('i.posicion', 'asc');

		$consulta = $this->db->get();

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}
	
	function guardar($imagenes) {
		$this->db->insert('imagenes', $imagenes);
		return mysql_insert_id();
	}
	
	function actualizar($imagenes, $id) {
		$this->db->where('id', $id);
		$this->db->update('imagenes', $imagenes);
	}

}

/* Fin del archivo categoria_model.php */
/* Ubicación: ./application/model/categoria_model.php */