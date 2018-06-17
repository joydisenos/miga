<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('usuarios_model');

		// Hora de Argentina
		date_default_timezone_set('America/Argentina/Buenos_Aires');
	}

	function index($pagina = FALSE) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('table');

			$inicio = 0;
			$limite = 10;

			if ($pagina !== FALSE) {
				$inicio = ($pagina -1) * $limite;
			}

			$data['usuarios'] = $this->usuarios_model->get($inicio, $limite, FALSE);

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'usuario/';
			$config['total_rows'] = count($this->usuarios_model->get(FALSE, FALSE, FALSE));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = '&Uacute;ltimo';
			$config['uri_segment'] = 2;
			$config['first_url'] = base_url() . 'usuario/';
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

			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('usuario/usuarios_list', $data);
			$this->load->view('partial/footer_common');
		}
	}

	function agregar() {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('usuario/add_usuarios');
			$this->load->view('partial/footer_common');
		}
	}

	function guardar() {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');
			$this->load->library('email');
			$this->load->helper('inflector');

			// Validaciones del formulario
			$this->form_validation->set_rules('usuario', 'Usuario', 'required|max_length[20]');
			$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required|max_length[20]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[50]');

			$this->form_validation->set_error_delimiters('<div class="messages-error">', '</div>');

			// Si no pasa las validaciones del formulario vuelve al login
			if (($this->form_validation->run() == FALSE)) {
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('usuario/add_usuarios');
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones busca el email y pass en la base				
				$usuario = null;
				$existeUsuario = false;

				$existeUsuario = $this->usuarios_model->validar_correo_rut($this->input->post('usuario'));

				if (!$existeUsuario) {
					$usuario = array (
						'usuario' => $this->input->post('usuario'),
						'password' => $this->input->post('password'),
						'nombre' => humanize($this->input->post('nombre')),
						'estado_logico' => 'A',
						'fecha_ingreso' => date('Y-m-d H:i:s'),
						'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
					);

					$this->usuarios_model->guardar($usuario);

					$this->session->set_flashdata('mensaje_usuario', 'A');
					redirect('/usuario/');
				} else { //  Si no logr� validar
					$data['errorUsuario'] = "Usuario existente";

					$this->load->view('partial/head_common');
					$this->load->view('partial/menu_lateral');
					$this->load->view('partial/menu_superior');
					$this->load->view('usuario/add_usuarios', $data);
					$this->load->view('partial/footer_common');
				}
			}
		}
	}

	function editar($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['usuario'] = $this->usuarios_model->get(FALSE, FALSE, $id);

			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('usuario/edit_usuarios', $data);
			$this->load->view('partial/footer_common');

		}
	}

	function actualizar($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');
			$this->load->library('email');
			$this->load->helper('inflector');

			// Validaciones del formulario
			$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required|max_length[20]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[50]');
			$this->form_validation->set_error_delimiters('<div class="messages-error">', '</div>');

			// Si no pasa las validaciones del formulario vuelve al login
			if (($this->form_validation->run() == FALSE)) {
				$data['usuario'] = $this->usuarios_model->get(FALSE, FALSE, $id);

				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('usuario/edit_usuarios', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones busca el email y pass en la base
				$usuario = array (
					'password' => $this->input->post('password'),
					'nombre' => humanize($this->input->post('nombre')),
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				$this->usuarios_model->actualizar($usuario, $id);

				$this->session->set_flashdata('mensaje_usuario', 'M');
				redirect('/usuario/');
			}
		}
	}
	
	function view($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['usuario'] = $this->usuarios_model->get(FALSE, FALSE, $id);

			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('usuario/view_usuarios', $data);
			$this->load->view('partial/footer_common');
		}
	}

	function eliminar($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			if($this->session->userdata($this->config->item('idUsuario')) == $id) {
				$this->session->set_flashdata('mensaje_usuario', 'X');
			} else {
				$usuario = array (
					'estado_logico' => 'B',
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				$this->usuarios_model->actualizar($usuario, $id);
				$this->session->set_flashdata('mensaje_usuario', 'B');
			}

			redirect('/usuario/');
		}
	}
}