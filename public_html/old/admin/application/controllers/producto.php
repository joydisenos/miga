<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require(APPPATH.'libraries/slim.php');

class Producto extends CI_Controller {

	function __construct() {
		parent::__construct ();
		$this->load->model ('producto_model');
		$this->load->model ('categoria_model');

		$this->load->helper ('text');	
		
		// Hora de Argentina
		date_default_timezone_set('America/Argentina/Buenos_Aires');
	}

	/**
	 * Carga la lista de productos
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
			$limite = 55;

			$this->session->set_userdata('buscador_codigo_productos', '');
			$this->session->set_userdata('buscador_titulo_productos', '');
			$this->session->set_userdata('buscador_categoria_productos', '');

			if ($pagina !== FALSE) {
				$inicio = ($pagina -1) * $limite;
				$this->session->set_userdata($this->config->item('paginaProductos'), $pagina);
			} else {
				$this->session->set_userdata($this->config->item('paginaProductos'), 1);
			}
			
			$data['productos'] = $this->producto_model->get($inicio, $limite, FALSE);
			$data['categorias'] = $this->categoria_model->get_categoria_padre(FALSE, FALSE, FALSE);

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'producto/';
			$config['total_rows'] = count($this->producto_model->get(FALSE, FALSE, FALSE));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = '&Uacute;ltimo';
			$config['uri_segment'] = 2;
			$config['first_url'] = base_url() . 'producto/';
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
			$this->load->view('producto/productos_list', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Carga la pagina de agregar producto
	 */
	function agregar() {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			// Si esta logueado y se aceptan los permisos			
			$data['categorias'] = $this->categoria_model->get(FALSE, FALSE, FALSE);
			$data['categorias_padre'] = $this->categoria_model->get_categoria_padre(FALSE, FALSE, FALSE);

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('producto/producto_add', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Guarda el producto realizando validaciones
	 */
	function guardar() {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');
			$this->load->helper('inflector');
			
			// Validaciones del formulario
			$this->form_validation->set_rules('nombre_producto', 'Nombre Producto', 'required|max_length[150]');
			$this->form_validation->set_rules('desc_producto', 'Descripci&oacute;n Producto', 'required|max_length[150]');
			$this->form_validation->set_rules('cantidad', 'Cantidad', 'required|max_length[30]');
			$this->form_validation->set_rules('cantidad_descripcion', 'Descripci&oacute;n Cantidad', 'max_length[30]');
			$this->form_validation->set_rules('precio_venta', 'Precio Venta', 'required|numeric');

			// Si no pasa las validaciones del formulario vuelve a la pagina de agregar producto
			if (($this->form_validation->run() == FALSE)) {
				$data['subcategorias'] = $this->categoria_model->get_por_padre($this->input->post('categoria'));
				$data['categorias_padre'] = $this->categoria_model->get_categoria_padre(FALSE, FALSE, FALSE);

				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior', $data);
				$this->load->view('producto/producto_add', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones
				$categoria = null;
				if($this->input->post('categoria') != '0') {
					$categoria = $this->input->post('categoria');
				}

				$subcategoria = null;
				if($this->input->post('subcategoria') != '0') {
					$subcategoria = $this->input->post('subcategoria');
				}

				$producto = array (
					'id_categoria' => $categoria,
					'id_subcategoria' => $subcategoria,
					'nombre_producto' => $this->input->post('nombre_producto'),
					'desc_producto' => $this->input->post('desc_producto'),
					'precio_venta' => $this->input->post('precio_venta'),
					'cantidad' => $this->input->post('cantidad'),
					'cantidad_descripcion' => $this->input->post('cantidad_descripcion'),
					'disponible' => (int)$this->input->post('disponible'),
					'estado_logico' => 'A',
					'fecha_ingreso' => date('Y-m-d H:i:s'),
					'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Guarda el producto
				$id_producto = $this->producto_model->guardar($producto);

				$image = @Slim::getImages('slim')[0];
				
				if (isset($image['output']['data'])) {
					$name = $image['input']['name'];

					// Base64 of the image
					$data = $image['output']['data'];

					// Server path
					$path = '../img/productos';

					// Save the file to the server
					$file = Slim::saveFile($data, $name, $path, $id_producto);
				}

				// Muestra el mensaje de agregar y vuelve a la lista de productos
				$this->session->set_flashdata('mensaje_producto', 'A');
				redirect('/producto/');
			}
		}
	}

	/**
	 * Carga la pagina de editar producto
	 */
	function editar($id) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['producto'] = $this->producto_model->get(FALSE, FALSE, $id);

			$data['categorias'] = $this->categoria_model->get(FALSE, FALSE, FALSE);
			$data['categorias_padre'] = $this->categoria_model->get_categoria_padre(FALSE, FALSE, FALSE);

			if($data['producto']){
				$id_categoria_padre;
				foreach($data['producto'] as $producto){
					$id_categoria_padre = $producto->id_categoria;
				}
				$data['subcategorias'] = $this->categoria_model->get_por_padre_admin($id_categoria_padre);
			}
			else {
				redirect('/');
			}

			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('producto/producto_edit', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Edita el producto realizando validaciones
	 */
	function actualizar($id) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('form_validation');
			$this->load->helper('inflector');

			// Validaciones del formulario
			$this->form_validation->set_rules('nombre_producto', 'Nombre Producto', 'max_length[150]');
			$this->form_validation->set_rules('desc_producto', 'Descripci&oacute;n Producto', 'max_length[150]');
			$this->form_validation->set_rules('cantidad', 'Cantidad', 'required|max_length[30]');
			$this->form_validation->set_rules('cantidad_descripcion', 'Descripci&oacute;n Cantidad', 'max_length[30]');
			$this->form_validation->set_rules('precio_venta', 'Precio Venta', 'required|numeric');

			// Si no pasa las validaciones del formulario vuelve a la pagina de editar producto
			if (($this->form_validation->run() == FALSE)) {
				$data['producto'] = $this->producto_model->get(FALSE, FALSE, $id);
				$data['subcategorias'] = $this->categoria_model->get_por_padre($this->input->post('categoria'));
				$data['categorias_padre'] = $this->categoria_model->get_categoria_padre(FALSE, FALSE, FALSE);

				// Carga las vistas
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior', $data);
				$this->load->view('producto/producto_edit', $data);
				$this->load->view('partial/footer_common');
			} else {
				// Si paso las validaciones
				$categoria = null;
				if($this->input->post('categoria') != '0') {
					$categoria = $this->input->post('categoria');
				}

				$subcategoria = null;
				if($this->input->post('subcategoria') != '0') {
					$subcategoria = $this->input->post('subcategoria');
				}

				$producto = array (
					'id_categoria' => $categoria,
					'id_subcategoria' => $subcategoria,
					'nombre_producto' => $this->input->post('nombre_producto'),
					'desc_producto' => $this->input->post('desc_producto'),
					'cantidad' => $this->input->post('cantidad'),
					'cantidad_descripcion' => $this->input->post('cantidad_descripcion'),
					'precio_venta' => $this->input->post('precio_venta'),
					'disponible' => (int)$this->input->post('disponible'),
					'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
					'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
				);

				// Actualiza el producto
				$this->producto_model->actualizar($producto, $id);

				$image = @Slim::getImages('slim')[0];
				
				if (isset($image['output']['data'])) {
					$name = $image['input']['name'];

					// Base64 of the image
					$data = $image['output']['data'];

					// Server path
					$path = '../img/productos';

					// Save the file to the server
					$file = Slim::saveFile($data, $name, $path, $id);
				}
				// Muestra el mensaje de editar
				$this->session->set_flashdata('mensaje_producto', 'M');

				// Vuelve a la lista de productos
				redirect('/producto/' . $this->session->userdata($this->config->item('paginaProductos')));
			}
		}
	}

	/**
	 * Visualiza el producto por id
	 * @param int $id
	 */
	function ver($id) {
		// Activar/Desactivar informacion para desarrollo
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$data['producto'] = $this->producto_model->get(FALSE, FALSE, $id);
			// Carga las vistas
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('producto/producto_view', $data);
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
			$producto = array (
				'estado_logico' => 'B',
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Elimina el producto
			$this->producto_model->actualizar($producto, $id);

			// Muestra el mensaje de eliminar
			$this->session->set_flashdata('mensaje_producto', 'B');

			// Vuelve a la lista de productos
			redirect('/producto/');
		}
	}

	function habilitar($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			// Realiza una baja logica
			$producto = array (
				'disponible' => 1,
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Elimina el producto
			$this->producto_model->actualizar($producto, $id);

			// Muestra el mensaje de eliminar
			$this->session->set_flashdata('mensaje_producto', 'E');

			// Vuelve a la lista de productos
			redirect('/producto/');
		}
	}

	function habilitar_masivo(){
		$this->output->enable_profiler($this->config->item('debug_app'));
		if($this->input->is_ajax_request()) {
			$ids_eliminar = $this->input->post('ids_eliminar');
			$ids_eliminar_array = explode("|", $ids_eliminar);

			$producto = array (
				'disponible' => 1,
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Actualiza el producto
			$this->producto_model->actualizar_masivo($producto, $ids_eliminar_array);

			$return_json = "1";
		} else {
			$return_json = "0";
		}
		echo json_encode($return_json);
	}

	function deshabilitar_masivo(){
		$this->output->enable_profiler($this->config->item('debug_app'));
		if($this->input->is_ajax_request()) {
			$ids_eliminar = $this->input->post('ids_eliminar');
			$ids_eliminar_array = explode("|", $ids_eliminar);

			$producto = array (
				'disponible' => 0,
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Actualiza el producto
			$this->producto_model->actualizar_masivo($producto, $ids_eliminar_array);

			$return_json = "1";
		} else {
			$return_json = "0";
		}
		echo json_encode($return_json);
	}

	function deshabilitar($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			// Realiza una baja logica
			$producto = array (
				'disponible' => 0,
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Elimina el producto
			$this->producto_model->actualizar($producto, $id);

			// Muestra el mensaje de eliminar
			$this->session->set_flashdata('mensaje_producto', 'E');

			// Vuelve a la lista de productos
			redirect('/producto/');
		}
	}

	public function llena_categorias() {
		$options = "";
		if($this->input->post('categoria')) {
			$categoria = $this->input->post('categoria');
			$subcategorias = $this->categoria_model->get_por_padre_admin($categoria);
			echo '<span class="">Seleccione..</span>';
			foreach($subcategorias as $fila_subcategorias) {
				echo '<option value="'.$fila_subcategorias->id .'">'.$fila_subcategorias->descripcion .'</option>';
			}
			if(count($subcategorias) == 0){
				echo '<span class="filter-option pull-left">Selecciona la categoría principal</span>';
			}
		}
	}

	function buscarproducto($pagina = FALSE) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('table');

			$inicio = 0;
			$limite = 10;
			$buscador_codigo_productos = '';
			$buscador_titulo_productos = '';
			$buscador_categoria_productos = '';

			if ($pagina !== FALSE) {
				$inicio = ($pagina -1) * $limite;
				$buscador_codigo_productos = $this->session->userdata('buscador_codigo_productos');
				$buscador_titulo_productos = $this->session->userdata('buscador_titulo_productos');
				$buscador_categoria_productos = $this->session->userdata('buscador_categoria_productos');
				$this->session->set_userdata($this->config->item('paginaProductos'), $pagina);
			} else {
				$this->session->set_userdata('buscador_codigo_productos', $this->input->post('codigo'));
				$buscador_codigo_productos = $this->input->post('codigo');
				$this->session->set_userdata('buscador_titulo_productos', $this->input->post('titulo'));
				$buscador_titulo_productos = $this->input->post('titulo');
				$this->session->set_userdata('buscador_categoria_productos', $this->input->post('categoria'));
				$buscador_categoria_productos = $this->input->post('categoria');
				$this->session->set_userdata($this->config->item('paginaProductos'), 1);
			}

			$data['categorias'] = $this->categoria_model->get_categoria_hija();
			$data['productos'] = $this->producto_model->get_por_filtro($inicio, $limite, $buscador_codigo_productos, $buscador_titulo_productos, $buscador_categoria_productos);

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'producto/buscarproducto/';
			$config['total_rows'] = count($this->producto_model->get_por_filtro(FALSE, FALSE, $buscador_codigo_productos, $buscador_titulo_productos, $buscador_categoria_productos));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = 'Ãšltimo';
			$config['uri_segment'] = 3;
			$config['first_url'] = base_url() . 'producto/buscarproducto/';
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
			$this->load->view('producto/productos_list', $data);
			$this->load->view('partial/footer_common');
		}
	}

	function verproductomodal() {
		if($this->input->is_ajax_request()){
			//$this->output->enable_profiler($this->config->item('debug_app'));
			$id_producto = $this->input->post('id_producto');
			$producto = $this->producto_model->get(FALSE, FALSE, $id_producto);
			echo json_encode($producto);
		}
	}

	function excel(){
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('ReporteExcel');

			$buscador_codigo_productos = $this->session->userdata('buscador_codigo_productos');
			$buscador_titulo_productos = $this->session->userdata('buscador_titulo_productos');
			$buscador_categoria_productos = $this->session->userdata('buscador_categoria_productos');
			$ordenar_productos = $this->session->userdata('ordenar_productos');
			$ordenar_productos_sentido = $this->session->userdata('ordenar_productos_sentido');

			$productos = $this->producto_model->get_reporte($buscador_codigo_productos, $buscador_titulo_productos, $buscador_categoria_productos);

			$this->excel = new ReporteExcel();
			$this->excel->setHeader();
		
			// Centrado
			$style_center = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
			);

			// Centrado y negrita
			$style_bold_center = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
				'font' => array(
					'bold' => true
				)
			);

			// Negrita
			$style_bold = array(
				'font' => array(
					'bold' => true
				)
			);

			// Titulos
			$this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Codigo');
			$this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Categoria');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Subcategoria');
			$this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Nombre Producto');
			$this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'DescripcionProducto');			
			$this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Precio Venta');
			$this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Disponible');

			// Estilos para el titulo
			$this->excel->setActiveSheetIndex(0)->getStyle("A1")->applyFromArray($style_bold_center);
			$this->excel->setActiveSheetIndex(0)->getStyle("B1")->applyFromArray($style_bold);
			$this->excel->setActiveSheetIndex(0)->getStyle("C1")->applyFromArray($style_bold);
			$this->excel->setActiveSheetIndex(0)->getStyle("D1")->applyFromArray($style_bold);
			$this->excel->setActiveSheetIndex(0)->getStyle("E1")->applyFromArray($style_bold_center);
			$this->excel->setActiveSheetIndex(0)->getStyle("F1")->applyFromArray($style_bold_center);
			$this->excel->setActiveSheetIndex(0)->getStyle("G1")->applyFromArray($style_bold_center);

			// Colores de fila
			$this->excel->setActiveSheetIndex(0)->getStyle('A1:G1')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => 'F28A8C'
				)
			));

			// Comienza en fila 2, fila 1 para el titulo
			$fila_excel = 2;

			foreach($productos as $producto) {
				$this->excel->setActiveSheetIndex(0)->setCellValue('A'.$fila_excel, $producto->id);
				$this->excel->setActiveSheetIndex(0)->getStyle('A'. $fila_excel)->applyFromArray($style_center);
				$this->excel->setActiveSheetIndex(0)->setCellValue('B'.$fila_excel, $producto->categoria_desc);
				$this->excel->setActiveSheetIndex(0)->setCellValue('C'.$fila_excel, $producto->subcategoria_desc);
				$this->excel->setActiveSheetIndex(0)->setCellValue('D'.$fila_excel, $producto->nombre_producto);
				$this->excel->setActiveSheetIndex(0)->setCellValue('E'.$fila_excel, $producto->desc_producto);
				$this->excel->setActiveSheetIndex(0)->setCellValue('F'.$fila_excel, $producto->precio_venta);
				$this->excel->setActiveSheetIndex(0)->getStyle('F'. $fila_excel)->applyFromArray($style_center);
				$this->excel->setActiveSheetIndex(0)->setCellValue('G'.$fila_excel, $producto->disponible);
				$this->excel->setActiveSheetIndex(0)->getStyle('G'. $fila_excel)->applyFromArray($style_center);
				$fila_excel++;
			}

			// Ancho de columnas
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(10);
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(40);
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(40);
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(50);
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(50);
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(20);
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(20);

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="productos.xlsx"');
			header('Cache-Control: max-age=0');

			$objWriter=PHPExcel_IOFactory::createWriter($this->excel,'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
	}
}