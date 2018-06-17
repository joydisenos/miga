<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('security');
		$this->load->model('usuarios_model');

		// Hora de Argentina
		date_default_timezone_set('America/Argentina/Buenos_Aires');
	}

	/**
	 * Se muestra pantalla de login
	 */
	public function index()	{
		$this->load->view('login/loginView');
	}

	function ingresar() {
		$this->output->enable_profiler($this->config->item('debug_app'));

		$this->load->library('form_validation');
		// Si no se recibe el parametro de sess es porque no viene del formulario
		if (!$this->input->post('sess')) {
			$this->load->view('login/loginView');
		} else {
			// Validaciones del formulario
			$this->form_validation->set_rules('usuario', 'Usuario', 'required');
			$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required');

			$this->form_validation->set_error_delimiters('<div class="messages-error">', '</div>');

			// Si no pasa las validaciones del formulario vuelve al login
			if (($this->form_validation->run() == FALSE)) {
				$this->load->view('login/loginView');
			} else {
				// Si paso las validaciones busca el email y pass en la base
				$usuario = null;
				$usuario = $this->usuarios_model->login($this->input->post('usuario'), $this->input->post('password'));

				$ExisteUsuarioyPassword = false;
				$id_usuario = 0;
				$nombre = '';				
				
				if ($usuario) {
					foreach ($usuario as $row) {
						$ExisteUsuarioyPassword = true;
					}
				}

				// Si el usuario existe va al perfil
				if ($ExisteUsuarioyPassword) {
					foreach ($usuario as $row) {
						$ExisteUsuarioyPassword = true;
						$id_usuario = $row->id;
						$nombre = $row->nombre;
					}

					$this->session->set_userdata($this->config->item('idUsuario'), $id_usuario);
					$this->session->set_userdata($this->config->item('nombreUsuario'), $nombre);

						redirect('/producto', 'refresh');
				} else { //  Si no logro validar
					$data['error'] = 'Correo o password incorrecta, por favor vuelva a intentar';
					$this->load->view('login/loginView', $data);
				}
			}
		}
	}

	function salir() {
		$this->session->sess_destroy();
		redirect('/login');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */

?>