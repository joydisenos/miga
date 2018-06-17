<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('configuraciones_model');

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
			$this->load->library('table');
			$data['configuraciones'] = $this->configuraciones_model->get(FALSE, FALSE, FALSE);

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('configuraciones/configuraciones_list', $data);
			$this->load->view('partial/footer_common');
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
			$data['configuraciones'] = $this->configuraciones_model->get(FALSE, FALSE, $id);

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('configuraciones/configuraciones_edit', $data);
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
			$this->form_validation->set_rules('valor', 'Valor', 'required|max_length[500]');

			// Si no pasa las validaciones del formulario vuelve a la pagina de editar cliente
			if (($this->form_validation->run() == FALSE)) {
				$data['configuraciones'] = $this->configuraciones_model->get(FALSE, FALSE, 1);

				// Carga las vistas
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('configuraciones/configuraciones_edit', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones
				$configuraciones = array (
					'valor' => $this->input->post('valor'),
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Actualiza el configuraciones
				$this->configuraciones_model->actualizar($configuraciones, $id);

				// Muestra el mensaje de editar
				$this->session->set_flashdata('mensaje_configuracion', 'M');
				redirect('/configuraciones/' . $this->session->userdata($this->config->item('paginaClientes')));
			}
		}
	}
}