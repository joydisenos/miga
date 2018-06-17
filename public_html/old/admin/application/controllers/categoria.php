<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Categoria extends CI_Controller {

	function __construct() {
		parent::__construct ();
		$this->load->model ('categoria_model');
		
		// Hora de Argentina
		date_default_timezone_set('America/Argentina/Buenos_Aires');
	}

	/**
	 * Carga la lista de categorias
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

			if ($pagina !== FALSE) {
				$inicio = ($pagina -1) * $limite;
				$this->session->set_userdata($this->config->item('paginaCategorias'), $pagina);
			} else {
				$this->session->set_userdata($this->config->item('paginaCategorias'), 1);
			}
						
			$data['categorias'] = $this->categoria_model->get_categoria_padre($inicio, $limite, FALSE);

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'categorias/';
			$config['total_rows'] = count($this->categoria_model->get_categoria_padre(FALSE, FALSE, FALSE));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = '&Uacute;ltimo';
			$config['uri_segment'] = 2;
			$config['first_url'] = base_url() . 'categorias/';
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
			$this->load->view('categoria/categorias_list', $data);
			$this->load->view('partial/footer_common');
		}
	}

	function sub($id_categoria_padre = FALSE, $pagina = FALSE) {
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

			if ($pagina !== FALSE) {
				$inicio = ($pagina -1) * $limite;
				$this->session->set_userdata($this->config->item('paginaSubCategorias'), $pagina);
			} else {
				$this->session->set_userdata($this->config->item('paginaSubCategorias'), 1);
			}

			if($id_categoria_padre != FALSE) {
				$data['categoria_selec'] = $id_categoria_padre;
			} else {
				$data['categoria_selec'] = '';
			}
						
			$data['categorias'] = $this->categoria_model->get_por_padre($inicio, $limite, $id_categoria_padre);

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'categorias/';
			$config['total_rows'] = count($this->categoria_model->get_por_padre(FALSE, FALSE, $id_categoria_padre));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = '&Uacute;ltimo';
			$config['uri_segment'] = 2;
			$config['first_url'] = base_url() . 'categorias/';
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
			$this->load->view('categoria/subcategorias_list', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Carga la pagina de agregar categoria
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
			$this->load->view('categoria/categoria_add');
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Carga la pagina de agregar categoria
	 */
	function agregarsub($id_categoria_padre = FALSE) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['categorias_padre'] = $this->categoria_model->get_categoria_padre();

			if($id_categoria_padre != FALSE) {
				$data['categoria_selec'] = $id_categoria_padre;
			}

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior');
			$this->load->view('categoria/subcategoria_add', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Guarda la categoria realizando validaciones
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
			$this->form_validation->set_rules('descripcion', 'Descripci&oacute;n', 'required|max_length[100]');
			$this->form_validation->set_rules('href', 'Href', 'required|max_length[20]');
			$this->form_validation->set_rules('texto', 'Texto', 'max_length[200]');

			// Si no pasa las validaciones del formulario vuelve a la pagina de agregar categoria
			if (($this->form_validation->run() == FALSE)) {
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('categoria/categoria_add');
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones

				$categoria = array (
					'descripcion' => $this->input->post('descripcion'),
					'descripcion_web' => $this->input->post('descripcion'),
					'href' => $this->input->post('href'),
					'texto' => $this->input->post('texto'),
					'id_padre' => 0,
					'estado_logico' => 'A',
					'fecha_ingreso' => date('Y-m-d H:i:s'),
					'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Guarda la categoria
				$id_categoria = $this->categoria_model->guardar($categoria);
								
				$codigo = '000' . $id_categoria;
				$largo_codigo = strlen($codigo);
				$codigo = substr($codigo, $largo_codigo - 3, 3);

				$keys = array (
					'codigo' => $codigo
				);

				$this->categoria_model->actualizar($keys, $id_categoria);

				// Muestra el mensaje de agregar y vuelve a la lista de categorias
				$this->session->set_flashdata('mensaje_categoria', 'A');
				redirect('/categoria/');
			}
		}
	}

	/**
	 * Guarda la categoria realizando validaciones
	 */
	function guardarsub() {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');
			
			// Validaciones del formulario
			$this->form_validation->set_rules('descripcion', 'Descripci&oacute;n', 'required|max_length[100]');
			$this->form_validation->set_rules('href', 'Href', 'required|max_length[20]');
			$this->form_validation->set_rules('texto', 'Texto', 'max_length[200]');

			// Si no pasa las validaciones del formulario vuelve a la pagina de agregar categoria
			if (($this->form_validation->run() == FALSE)) {
				$data['categorias_padre'] = $this->categoria_model->get_categoria_padre();

				$data['categoria_selec'] = $this->input->post('categoria');

				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('categoria/subcategoria_add', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones

				$id_padre = $this->input->post('categoria');

				$categoria = array (
					'descripcion' => $this->input->post('descripcion'),
					'descripcion_web' => $this->input->post('descripcion'),
					'href' => $this->input->post('href'),
					'texto' => $this->input->post('texto'),
					'id_padre' => $id_padre,
					'estado_logico' => 'A',
					'fecha_ingreso' => date('Y-m-d H:i:s'),
					'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Guarda la categoria
				$id_categoria = $this->categoria_model->guardar($categoria);
								
				$codigo = '000' . $id_categoria;
				$largo_codigo = strlen($codigo);
				$codigo = substr($codigo, $largo_codigo - 3, 3);

				$keys = array (
					'codigo' => $codigo
				);

				$this->categoria_model->actualizar($keys, $id_categoria);

				// Muestra el mensaje de agregar y vuelve a la lista de categorias
				$this->session->set_flashdata('mensaje_categoria', 'A');
				redirect('/categoria/sub/' . $id_padre);
			}
		}
	}

	/**
	 * Carga la pagina de editar categoria
	 */
	function editar($id) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['categoria'] = $this->categoria_model->get(FALSE, FALSE, $id);

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('categoria/categoria_edit', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Carga la pagina de editar subcategoria
	 */
	function editarsub($id, $id_categoria_padre) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['categoria'] = $this->categoria_model->get(FALSE, FALSE, $id);
			$data['categorias_padre'] = $this->categoria_model->get_categoria_padre();

			if($id_categoria_padre != FALSE) {
				$data['categoria_selec'] = $id_categoria_padre;
			}

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('categoria/subcategoria_edit', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Edita el categoria realizando validaciones
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
			$this->form_validation->set_rules('descripcion', 'Descripci&oacute;n', 'required|max_length[100]');
			$this->form_validation->set_rules('href', 'Href', 'required|max_length[20]');
			$this->form_validation->set_rules('texto', 'Texto', 'max_length[200]');

			// Si no pasa las validaciones del formulario vuelve a la pagina de editar categoria
			if (($this->form_validation->run() == FALSE)) {
				$data['categoria'] = $this->categoria_model->get(FALSE, FALSE, $id);

				// Carga las vistas
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('categoria/categoria_edit', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones
				$categoria = array (
					'descripcion' => $this->input->post('descripcion'),
					'descripcion_web' => $this->input->post('descripcion'),
					'href' => $this->input->post('href'),
					'texto' => $this->input->post('texto'),
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Actualiza la categoria
				$this->categoria_model->actualizar($categoria, $id);

				// Muestra el mensaje de editar
				$this->session->set_flashdata('mensaje_categoria', 'M');

				// Vuelve a la lista de categorias
				redirect('/categoria/' . $this->session->userdata($this->config->item('paginaCategorias')));
			}
		}
	}

	/**
	 * Edita el categoria realizando validaciones
	 */
	function actualizarsub($id, $id_categoria_padre) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');

			// Validaciones del formulario
			$this->form_validation->set_rules('descripcion', 'Descripci&oacute;n', 'required|max_length[100]');
			$this->form_validation->set_rules('href', 'Href', 'required|max_length[20]');
			$this->form_validation->set_rules('texto', 'Texto', 'max_length[200]');

			// Si no pasa las validaciones del formulario vuelve a la pagina de editar categoria
			if (($this->form_validation->run() == FALSE)) {
				$data['categoria'] = $this->categoria_model->get(FALSE, FALSE, $id);
				$data['categorias_padre'] = $this->categoria_model->get_categoria_padre();
				$data['categoria_selec'] = $this->input->post('categoria');

				// Carga las vistas
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('categoria/categoria_edit', $data);
				$this->load->view('partial/footer_common');
			} else {
				$id_padre = $this->input->post('categoria');
				// Si paso las validaciones
				$categoria = array (
					'descripcion' => $this->input->post('descripcion'),
					'descripcion_web' => $this->input->post('descripcion'),
					'id_padre' => $id_padre,
					'href' => $this->input->post('href'),
					'texto' => $this->input->post('texto'),
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Actualiza la categoria
				$this->categoria_model->actualizar($categoria, $id);

				// Muestra el mensaje de editar
				$this->session->set_flashdata('mensaje_categoria', 'M');

				// Vuelve a la lista de categorias
				redirect('/categoria/sub/' . $id_padre);
			}
		}
	}

	/**
	 * Visualiza la categoria por id
	 * @param int $id
	 */
	function ver($id) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['categoria'] = $this->categoria_model->get(FALSE, FALSE, $id);
			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('categoria/categoria_view', $data);
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
			$categoria = array (
				'estado_logico' => 'B',
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Elimina el categoria
			$this->categoria_model->actualizar($categoria, $id);

			// Muestra el mensaje de eliminar
			$this->session->set_flashdata('mensaje_categoria', 'B');

			// Vuelve a la lista de categorias
			redirect('/categoria/');
		}
	}
}