<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horarios extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('horarios_model');		

		// Hora de Argentina
		date_default_timezone_set('America/Argentina/Buenos_Aires');
	}

	function index() {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['horarios'] = $this->horarios_model->get();

			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('horarios/horarios_view', $data);
			$this->load->view('partial/footer_common');

		}
	}

	function editar() {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['horarios'] = $this->horarios_model->get();

			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('horarios/horarios_edit', $data);
			$this->load->view('partial/footer_common');

		}
	}

	function actualizar() {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');
			$this->load->library('email');
			$this->load->helper('inflector');

			// Validaciones del formulario
			$this->form_validation->set_rules('lunes', 'Lunes', 'required|max_length[40]');
			$this->form_validation->set_rules('martes', 'Martes', 'required|max_length[40]');
			$this->form_validation->set_rules('miercoles', 'Miercoles', 'required|max_length[40]');
			$this->form_validation->set_rules('jueves', 'Jueves', 'required|max_length[40]');
			$this->form_validation->set_rules('viernes', 'Viernes', 'required|max_length[40]');
			$this->form_validation->set_rules('sabado', 'Sabado', 'required|max_length[40]');
			$this->form_validation->set_rules('domingo', 'Domingo', 'required|max_length[40]');

			// Si no pasa las validaciones del formulario vuelve al login
			if (($this->form_validation->run() == FALSE)) {
				$data['horarios'] = $this->horarios_model->get();

				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('horarios/horarios_view', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones
				$horarios = array (
					'lunes' => $this->input->post('lunes'),
					'martes' => $this->input->post('martes'),
					'miercoles' => $this->input->post('miercoles'),
					'jueves' => $this->input->post('jueves'),
					'viernes' => $this->input->post('viernes'),
					'sabado' => $this->input->post('sabado'),
					'domingo' => $this->input->post('domingo'),
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				$this->horarios_model->actualizar($horarios);

				$this->session->set_flashdata('mensaje_horarios', 'M');
				redirect('/horarios/');
			}
		}
	}

	function especiales($pagina = FALSE) {
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

			$data['horarios'] = $this->horarios_model->get_especiales($inicio, $limite, FALSE);

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'horarios/especiales/';
			$config['total_rows'] = count($this->horarios_model->get(FALSE, FALSE, FALSE));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = '&Uacute;ltimo';
			$config['uri_segment'] = 2;
			$config['first_url'] = base_url() . 'horarios/especiales/';
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
			$this->load->view('horarios/horarios_especiales_list', $data);
			$this->load->view('partial/footer_common');
		}
	}

	function agregarespeciales() {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('horarios/horarios_especiales_add');
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Guarda la categoria realizando validaciones
	 */
	function guardarespeciales() {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');
			
			// Validaciones del formulario
			$this->form_validation->set_rules('dia', 'D&iacute;a', 'required|max_length[2]');
			$this->form_validation->set_rules('mes', 'Mes', 'required|max_length[2]');
			$this->form_validation->set_rules('horario', 'Horario', 'required|max_length[40]');

			// Si no pasa las validaciones del formulario vuelve a la pagina de agregar horarios_especiales
			if (($this->form_validation->run() == FALSE)) {
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('horarios/horarios_especiales_add');
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones

				$horarios_especiales = array (
					'dia' => $this->input->post('dia'),
					'mes' => $this->input->post('mes'),
					'horario' => $this->input->post('horario'),
					'estado_logico' => 'A',
					'fecha_ingreso' => date('Y-m-d H:i:s'),
					'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Guarda la categoria
				$id_horarios_especiales = $this->horarios_model->guardar_especiales($horarios_especiales);

				// Muestra el mensaje de agregar y vuelve a la lista de categorias
				$this->session->set_flashdata('mensaje_horarios_especiales', 'A');
				redirect('/horarios/especiales/');
			}
		}
	}

	function verespeciales($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['horarios'] = $this->horarios_model->get_especiales(FALSE, FALSE, $id);

			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('horarios/horarios_especiales_view', $data);
			$this->load->view('partial/footer_common');

		}
	}

	function editarespeciales($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['horarios'] = $this->horarios_model->get_especiales(FALSE, FALSE, $id);

			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('horarios/horarios_especiales_edit', $data);
			$this->load->view('partial/footer_common');

		}
	}

	function actualizarespeciales($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');
			$this->load->library('email');
			$this->load->helper('inflector');

			// Validaciones del formulario
			$this->form_validation->set_rules('dia', 'D&iacute;a', 'required|max_length[2]');
			$this->form_validation->set_rules('mes', 'Mes', 'required|max_length[2]');
			$this->form_validation->set_rules('horario', 'Horario', 'required|max_length[40]');

			// Si no pasa las validaciones del formulario vuelve al login
			if (($this->form_validation->run() == FALSE)) {
				$data['horarios'] = $this->horarios_model->get_especiales(FALSE, FALSE, $id);

				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('horarios/horarios_especiales_edit', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones
				$horarios = array (
					'dia' => $this->input->post('dia'),
					'mes' => $this->input->post('mes'),
					'horario' => $this->input->post('horario'),
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				$this->horarios_model->actualizar_especiales($horarios, $id);

				$this->session->set_flashdata('mensaje_horarios_especiales', 'M');
				redirect('/horarios/especiales/');
			}
		}
	}

	function eliminarespecial($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			if($this->session->userdata($this->config->item('idUsuario')) == $id) {
				$this->session->set_flashdata('mensaje_horarios', 'X');
			} else {
				$horario = array (
					'estado_logico' => 'B',
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				$this->horarios_model->actualizar_especiales($horario, $id);
				$this->session->set_flashdata('mensaje_horarios_especiales', 'B');
			}

			redirect('/horarios/especiales');
		}
	}
}