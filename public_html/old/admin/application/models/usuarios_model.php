<?php
class Usuarios_model extends CI_Model {

	function get($inicio = FALSE, $limite = FALSE, $id = FALSE) {
		$consulta = 'u.* ';
		$this->db->select($consulta);
		$this->db->from('usuario as u');

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

	function login($usuario, $password){
		$this->db->select('usuario.* ');
		$where_custom = "usuario.estado_logico='A' AND usuario.usuario='". $usuario . "' " . 
			"AND usuario.password = '" . $password . "' " .
			"AND usuario.estado_logico = 'A' ";
		$this->db->where($where_custom, NULL, FALSE);

		$query = $this->db->get('usuario');

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function guardar($usuario) {
		$this->db->insert('usuario', $usuario);
	}

	function actualizar($usuario, $id) {
		$this->db->where('id', $id);		
		$this->db->update('usuario', $usuario);
	}

	function validar_correo_rut($usuario) {
		$this->db->from('usuario');
		$where_custom = "estado_logico='A' AND usuario='". $usuario . "' ";;
		$this->db->where($where_custom, NULL, FALSE);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}

/* Fin del archivo usuarios_model.php */
/* Ubicación: ./application/model/usuarios_model.php */