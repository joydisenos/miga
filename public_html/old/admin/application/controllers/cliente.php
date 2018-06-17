<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('cliente_model');

		// Hora de Argentina
		date_default_timezone_set('America/Argentina/Buenos_Aires');
	}

	/**
	 * Carga la lista de clientes
	 * @param string $pagina
	 */
	function index($pagina = FALSE) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			// Si esta logueado y se aceptan los permisos
			$this->load->library('table');

			// Paginado
			$inicio = 0;
			$limite = 10;

			$this->session->set_userdata('buscador_nombre_clientes', '');
			$this->session->set_userdata('buscador_correo_clientes', '');
			$this->session->set_userdata('buscador_telefono_clientes', '');

			if ($pagina !== FALSE) {
				$inicio = ($pagina -1) * $limite;
				$this->session->set_userdata($this->config->item('paginaClientes'), $pagina);
			} else {
				$this->session->set_userdata($this->config->item('paginaClientes'), 1);
			}

			$data['clientes'] = $this->cliente_model->get($inicio, $limite, FALSE);

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'cliente/';
			$config['total_rows'] = count($this->cliente_model->get(FALSE, FALSE, FALSE));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = '&Uacute;ltimo';
			$config['uri_segment'] = 2;
			$config['first_url'] = base_url() . 'cliente/';
			$config['next_link'] = '>>';
			$config['prev_link'] = '<<';
			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			$this->pagination->initialize($config);

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('cliente/clientes_list', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Carga la pagina de agregar cliente
	 */
	function agregar() {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('cliente/cliente_add');
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Guarda el cliente realizando validaciones
	 */
	function guardar() {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');

			// Validaciones del formulario
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[50]');
			$this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'max_length[100]');
			$this->form_validation->set_rules('codigo_area', 'Código de Area', 'max_length[26]');
			$this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'max_length[20]');
			$this->form_validation->set_rules('correo', 'Correo', 'valid_email|max_length[70]');
			$this->form_validation->set_rules('puntos_acumulados', 'Puntos Acumulados', 'numeric');

			// Si no pasa las validaciones del formulario vuelve a la pagina de agregar cliente
			if (($this->form_validation->run() == FALSE)) {
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('cliente/cliente_add');
				$this->load->view('partial/footer_common');
			} else {
				$cliente = array (
					'nombre' => $this->input->post('nombre'),
					'direccion' => $this->input->post('direccion'),
					'codigo_area' => $this->input->post('codigo_area'),
					'telefono' => $this->input->post('telefono'),
					'email' => $this->input->post('correo'),
					'puntos_acumulados' => $this->input->post('puntos_acumulados'),
					'estado_logico' => 'A',
					'fecha_ingreso' => date('Y-m-d H:i:s'),
					'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Guarda el cliente
				$this->cliente_model->guardar($cliente);

				// Muestra el mensaje de agregar y vuelve a la lista de clientes
				$this->session->set_flashdata('mensaje_cliente', 'A');
				redirect('/cliente/');
			}
		}
	}

	/**
	 * Carga la pagina de editar cliente
	 */
	function editar($id) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['cliente'] = $this->cliente_model->get(FALSE, FALSE, $id);

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('cliente/cliente_edit', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Edita el cliente realizando validaciones
	 */
	function actualizar($id) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');

			// Validaciones del formulario
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[50]');
			$this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'max_length[100]');
			$this->form_validation->set_rules('codigo_area', 'Código de Area', 'max_length[26]');
			$this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'max_length[20]');
			$this->form_validation->set_rules('correo', 'Correo', 'valid_email|max_length[70]');
			$this->form_validation->set_rules('puntos_acumulados', 'Puntos Acumulados', 'numeric');

			// Si no pasa las validaciones del formulario vuelve a la pagina de editar cliente
			if (($this->form_validation->run() == FALSE)) {
				$data['cliente'] = $this->cliente_model->get(FALSE, FALSE, $id);

				// Carga las vistas
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('cliente/cliente_edit', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones
				$cliente = array (
					'nombre' => $this->input->post('nombre'),
					'direccion' => $this->input->post('direccion'),
					'codigo_area' => $this->input->post('codigo_area'),
					'telefono' => $this->input->post('telefono'),
					'email' => $this->input->post('correo'),
					'puntos_acumulados' => $this->input->post('puntos_acumulados'),
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Actualiza el cliente
				$this->cliente_model->actualizar($cliente, $id);

				// Muestra el mensaje de editar
				$this->session->set_flashdata('mensaje_cliente', 'M');
				redirect('/cliente/' . $this->session->userdata($this->config->item('paginaClientes')));
			}
		}
	}

	/**
	 * Visualiza el cliente por id
	 * @param int $id
	 */
	function ver($id) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['cliente'] = $this->cliente_model->get(FALSE, FALSE, $id);

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('cliente/cliente_view', $data);
			$this->load->view('partial/footer_common');

		}
	}

	function eliminar($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			// Realiza una baja logica
			$usuario = array (
				'estado_logico' => 'B',
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Elimina el cliente
			$this->cliente_model->actualizar($usuario, $id);

			// Muestra el mensaje de eliminar
			$this->session->set_flashdata('mensaje_cliente', 'B');

			// Vuelve a la lista de clientes
			redirect('/cliente/');
		}
	}

	function completarclienterut(){
		$keyword=$this->input->post('keyword');
		$data = $this->cliente_model->get_auto_rut(strtoupper($keyword));
		 
		echo json_encode($data);
	}

	function buscarclientes($pagina = FALSE) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('table');

			$inicio = 0;
			$limite = 10;
			$buscador_telefono_clientes = '';
			$buscador_nombre_clientes = '';
			$buscador_correo_clientes = '';

			if ($pagina !== FALSE) {
				$inicio = ($pagina -1) * $limite;
				$buscador_nombre_clientes = $this->session->userdata('buscador_nombre_clientes');
				$buscador_correo_clientes = $this->session->userdata('buscador_correo_clientes');
				$buscador_telefono_clientes = $this->session->userdata('buscador_telefono_clientes');
			} else {
				$this->session->set_userdata('buscador_nombre_clientes', $this->input->post('nombre'));
				$buscador_nombre_clientes = $this->input->post('nombre');
				$this->session->set_userdata('buscador_correo_clientes', $this->input->post('correo'));
				$buscador_correo_clientes = $this->input->post('correo');
				$this->session->set_userdata('buscador_telefono_clientes', $this->input->post('telefono'));
				$buscador_telefono_clientes = $this->input->post('telefono');
				$this->session->set_userdata($this->config->item('paginaClientes'), 1);
			}

			$data['clientes'] = $this->cliente_model->get_por_filtro($inicio, $limite, FALSE, $buscador_nombre_clientes, $buscador_correo_clientes, $buscador_telefono_clientes);

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'cliente/buscarclientes/';
			$config['total_rows'] = count($this->cliente_model->get_por_filtro(FALSE, FALSE, FALSE, $buscador_nombre_clientes, $buscador_correo_clientes, $buscador_telefono_clientes));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = 'Ãšltimo';
			$config['uri_segment'] = 3;
			$config['first_url'] = base_url() . 'cliente/buscarclientes/';
			$config['next_link'] = '>>';
			$config['prev_link'] = '<<';
			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			$this->pagination->initialize($config);

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('cliente/clientes_list', $data);
			$this->load->view('partial/footer_common');
		}
	}

	function verpuntos() {
		if($this->input->is_ajax_request()){
			//$this->output->enable_profiler($this->config->item('debug_app'));
			$telefono = $this->input->post('telefono');
			$area = $this->input->post('area');

			$puntos = $this->cliente_model->get_puntos($area, $telefono, FALSE);
			echo json_encode($puntos);
		}
	}
}