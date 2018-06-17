<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require(APPPATH.'libraries/slim.php');

class Imagenes extends CI_Controller {

	function __construct() {
		parent::__construct ();
		$this->load->model ('imagenes_model');
		
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
				$this->session->set_userdata($this->config->item('paginaImagenes'), $pagina);
			} else {
				$this->session->set_userdata($this->config->item('paginaImagenes'), 1);
			}

			$data['imagenes'] = $this->imagenes_model->get($inicio, $limite, FALSE);

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'categoria/';
			$config['total_rows'] = count($this->imagenes_model->get(FALSE, FALSE, FALSE));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = '&Uacute;ltimo';
			$config['uri_segment'] = 2;
			$config['first_url'] = base_url() . 'categoria/';
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
			$this->load->view('imagenes/imagenes_list', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Carga la pagina de agregar imagenes
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
			$this->load->view('imagenes/imagenes_add');
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
			$this->form_validation->set_rules('descripcion_imagen', 'Descripci&oacute;n Imágen', 'max_length[60]');
			$this->form_validation->set_rules('posicion', 'Posicion', 'numeric|max_length[2]');
			$this->form_validation->set_rules('link', 'Link', 'max_length[100]');

			// Si no pasa las validaciones del formulario vuelve a la pagina de agregar categoria
			if (($this->form_validation->run() == FALSE)) {
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('imagenes/imagenes_add');
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones
				
				$url_imagen = 'noimage.jpg';
					
				if($this->input->post('url_imagen') != '') {
					if (file_exists('./img/upload_temp/' .$this->input->post('url_imagen'))) {
						$copy_from = './img/upload_temp/' . $this->input->post('url_imagen');
						$copy_to = './img/slides/' . $this->input->post('url_imagen');

						if (copy($copy_from , $copy_to)) {
							$url_imagen = $this->input->post('url_imagen');
							unlink($copy_from);
						}
						else {
							$url_imagen = 'noimage.jpg';
						}
					}
				}

				$imagen = array (
					'descripcion_imagen' => $this->input->post('descripcion_imagen'),
					'posicion' => $this->input->post('posicion'),
					'link' => $this->input->post('link'),
					'url_imagen' => $this->input->post('url_imagen'),
					'estado_logico' => 'A',
					'fecha_ingreso' => date('Y-m-d H:i:s'),
					'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Guarda la imagen
				$id_imagen = $this->imagenes_model->guardar($imagen);

				// Muestra el mensaje de agregar y vuelve a la lista de categorias
				$this->session->set_flashdata('mensaje_imagen', 'A');
				redirect('/imagenes/');
			}
		}
	}

	/**
	 * Carga la pagina de editar imagen
	 */
	function editar($id) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {			
			$data['imagen'] = $this->imagenes_model->get(FALSE, FALSE, $id);			

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('imagenes/imagenes_edit', $data);
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
			$this->form_validation->set_rules('descripcion_imagen', 'Descripci&oacute;n Imágen', 'max_length[60]');
			$this->form_validation->set_rules('posicion', 'Posicion', 'numeric|max_length[2]');
			$this->form_validation->set_rules('link', 'Link', 'max_length[100]');

			// Si no pasa las validaciones del formulario vuelve a la pagina de editar categoria
			if (($this->form_validation->run() == FALSE)) {
				$data['imagen'] = $this->imagenes_model->get(FALSE, FALSE, $id);

				// Carga las vistas
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior', $data);
				$this->load->view('imagenes/imagenes_edit', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones
				$url_imagen = $this->input->post('url_imagen');

				if($this->input->post('no_modifica_imagen') == 0) {
					if($this->input->post('url_imagen') != '') {
						if (file_exists('./img/upload_temp/' .$this->input->post('url_imagen'))) {
							$copy_from = './img/upload_temp/' . $this->input->post('url_imagen');
							$copy_to = './img/slides/' . $this->input->post('url_imagen');

							if (copy($copy_from , $copy_to)) {
								$url_imagen = $this->input->post('url_imagen');
								unlink($copy_from);
							}
							else {
								$url_imagen = 'noimage.jpg';
							}
						}
					}
				}

				$categoria = array (
					'descripcion_imagen' => $this->input->post('descripcion_imagen'),
					'posicion' => $this->input->post('posicion'),
					'link' => $this->input->post('link'),
					'url_imagen' => $url_imagen,
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Actualiza la categoria
				$this->imagenes_model->actualizar($categoria, $id);

				// Muestra el mensaje de editar
				$this->session->set_flashdata('mensaje_imagen', 'M');

				// Vuelve a la lista de categorias
				redirect('/imagenes/' . $this->session->userdata($this->config->item('paginaImagenes')));
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
			$data['imagen'] = $this->imagenes_model->get(FALSE, FALSE, $id);
			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('imagenes/imagenes_view', $data);
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
			$imagen = array (
				'estado_logico' => 'B',
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Elimina la imagen
			$this->imagenes_model->actualizar($imagen, $id);

			// Muestra el mensaje de eliminar
			$this->session->set_flashdata('mensaje_imagen', 'B');

			// Vuelve a la lista de categorias
			redirect('/imagenes/');
		}
	}

	function subirimagen() {
		if (isset($_FILES["file"])) {
			$exp_reg="[^A-Z0-9]";
			$longitud = 10;
			$codigo = substr(preg_replace($exp_reg, "", md5(rand())) .
				preg_replace($exp_reg, "", md5(rand())) .
				preg_replace($exp_reg, "", md5(rand())), 0, $longitud);

			$file = $_FILES["file"];
			$nombre = $codigo . '-' . $file["name"];
			$tipo = $file["type"];
			$ruta_provisional = $file["tmp_name"];
			$size = $file["size"];
			$dimensiones = getimagesize($ruta_provisional);
			$width = $dimensiones[0];
			$height = $dimensiones[1];
			$carpeta = "img/upload_temp/";

			if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
				echo "Error, el archivo no es una imagen";
			}
			else if ($size > 4096*4096) {
				echo "Error, el tamaño máximo permitido es un 2MB";
			}
			else if ($width > 2000 || $height > 2000) {
				echo "Error la anchura y la altura maxima permitida es 1000px";
			}
			else if($width < 60 || $height < 60) {
				echo "Error la anchura y la altura mínima permitida es 60px";
			}
			else {
				$src = $carpeta.$nombre;
				move_uploaded_file($ruta_provisional, $src);
				echo '<img class="img img-responsive" src="' . base_url() . $src . '"><input type="hidden" name="url_imagen" value="' . $nombre . '"><input type="hidden" name="no_modifica_imagen" value="0">';
			}
		}
	}
}