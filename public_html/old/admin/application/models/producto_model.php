<?php
class Producto_model extends CI_Model {

	/**
	 * Obtiene los productos, si se pasa el id devuelve ese producto
	 * @param string $id
	 */
	function get($inicio = FALSE, $limite = FALSE, $id = FALSE) {
		$consulta = 'p.*, c.descripcion as categoria_desc, cp.descripcion as subcategoria_desc ';
		$this->db->join('categoria as c', 'p.id_categoria=c.id', 'left', 'left');
		$this->db->join('categoria as cp', 'p.id_subcategoria=cp.id', 'left', 'left');
		$this->db->select($consulta);

		if ($id !== FALSE) {
			$this->db->where('p.id', $id);
		}

		$this->db->where('p.estado_logico', 'A');		

		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}

		$this->db->order_by('p.id', 'desc');

		$this->db->from('producto as p');

		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	/**
	 * Guarda el producto
	 * @param producto $producto
	 */
	function guardar($producto) {
		$this->db->insert('producto', $producto);
		return mysql_insert_id();
	}

	/**
	 * Actualiza el producto por id
	 * @param producto $producto
	 * @param int $id
	 */
	function actualizar($producto, $id) {
		$this->db->where('id', $id);
		$this->db->update('producto', $producto);
	}

	function actualizar_masivo($producto, $ids) {
		$this->db->where_in('id', $ids);
		$this->db->update('producto', $producto);
	}

	function get_por_filtro($inicio = FALSE, $limite = FALSE, $codigo, $titulo, $categoria) {
		$consulta = 'p.*, c.descripcion as categoria_desc, cp.descripcion as subcategoria_desc ';
		$this->db->join('categoria as c', 'p.id_categoria=c.id', 'left', 'left');
		$this->db->join('categoria as cp', 'p.id_subcategoria=cp.id', 'left', 'left');
		$this->db->select($consulta);

		if ($limite !== FALSE && $inicio !== FALSE) {
			$this->db->limit($limite, $inicio);
		}

		if($codigo !== null && $codigo !== ''){
			$this->db->where('p.id', $codigo);
		}

		if($titulo !== null && $titulo !== ''){
			$this->db->like('p.nombre_producto', $titulo);
		}

		if($categoria !== null && $categoria !== ''){
			if($categoria > 0) {
				$this->db->like('p.id_categoria', $categoria);
			}
		}

		$this->db->where('p.estado_logico', 'A');

		$this->db->order_by('p.id', 'desc');

		$this->db->from('producto as p');

		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}

	function get_reporte($codigo, $titulo, $categoria) {
		$consulta = 'p.*, c.descripcion as categoria_desc, cp.descripcion as subcategoria_desc ';
		$this->db->join('categoria as c', 'p.id_categoria=c.id', 'left', 'left');
		$this->db->join('categoria as cp', 'p.id_subcategoria=cp.id', 'left', 'left');
		$this->db->select($consulta);

		if($codigo !== null && $codigo !== ''){
			$this->db->where('p.id', $codigo);
		}

		if($titulo !== null && $titulo !== ''){
			$this->db->like('p.nombre_producto', $titulo);
		}

		if($categoria !== null && $categoria !== ''){
			if($categoria > 0) {
				$this->db->like('p.id_categoria', $categoria);
			}
		}

		$this->db->where('p.estado_logico', 'A');
		$this->db->from('producto as p');

		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		}
	}
}