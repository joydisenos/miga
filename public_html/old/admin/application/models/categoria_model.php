<?php
class Categoria_model extends CI_Model {
	
	function get($inicio = FALSE, $limite = FALSE, $id = FALSE) {
		if ($id !== FALSE) {
			$this->db->where('id', $id);
		}
		
		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}
		
		$this->db->where('estado_logico', 'A');
		$this->db->order_by('codigo', 'asc');

		$consulta = $this->db->get('categoria');
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}
	
	function get_categoria_hija() {
		$this->db->where_not_in('id_padre', 0);
		
		$this->db->where('estado_logico', 'A');
		$this->db->order_by('codigo', 'asc');

		$consulta = $this->db->get('categoria');
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}
	
	function get_categoria_padre() {
		$this->db->where('estado_logico', 'A');
		$this->db->where('id_padre', 0);
		$this->db->order_by('codigo', 'asc');

		$consulta = $this->db->get('categoria');
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}
	
	function get_por_padre($inicio = FALSE, $limite = FALSE, $id_categoria_padre) {
		$consulta = 'c.*, cp.descripcion as categoria_padre_desc ';		
		$this->db->join('categoria as cp', 'c.id_padre=cp.id', 'left', 'left');
		
		$this->db->where('c.estado_logico', 'A');
		$this->db->where('c.id_padre', $id_categoria_padre);
		$this->db->order_by('c.codigo', 'asc');

		$this->db->select($consulta);

		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}

		$consulta = $this->db->get('categoria as c');
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	function get_por_padre_admin($id_categoria_padre) {
		$this->db->where('estado_logico', 'A');
		$this->db->where('id_padre', $id_categoria_padre);
		$this->db->order_by('codigo', 'asc');

		$consulta = $this->db->get('categoria');
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}
	
	function get_productos_categoria($inicio = FALSE, $limite = FALSE, $id_categoria, $todos) {
		$consulta = 'p.*, cat.descripcion as categoria_desc ';
		$this->db->select($consulta);
		$this->db->from('producto as p');
		$this->db->join('categoria as cat', 'p.id_categoria=cat.id', 'left', 'left');		

		if($todos == 'all'){
			$this->db->where('cat.id_padre', $id_categoria);
		} else {
			$this->db->where('p.id_categoria', $id_categoria);
		}

		$this->db->where('p.estado_logico', 'A');
		
		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}
		
		$this->db->order_by('p.precio_venta', 'asc');

		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}
	
	
	function guardar($categoria) {
		$this->db->insert('categoria', $categoria);
		return mysql_insert_id();
	}
	
	function actualizar($categoria, $id) {
		$this->db->where('id', $id);
		$this->db->update('categoria', $categoria);
	}

}

/* Fin del archivo categoria_model.php */
/* Ubicación: ./application/model/categoria_model.php */