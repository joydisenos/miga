<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pedidos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('table');
		$this->load->model('cliente_model');
		$this->load->model('pedido_model');
		$this->load->model('pedido_temp_model');
		$this->load->model('producto_model');
		$this->load->model('configuraciones_model');

		// Hora de Argentina
		date_default_timezone_set('America/Argentina/Buenos_Aires');
	}

	/**
	 * Carga los pedidos
	 * @param string $pagina
	 */
	function index($pagina = FALSE) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$inicio = 0;
			$limite = 40;

			if ($pagina !== FALSE) {
				$inicio = ($pagina -1) * $limite;
				$this->session->set_userdata($this->config->item('paginaPedidos'), $pagina);
			} else {
				$this->session->set_userdata($this->config->item('paginaPedidos'), 1);
			}

			$this->session->set_userdata('buscador_numero_pedido', '');
			$this->session->set_userdata('buscador_cliente_pedido', '');
			$this->session->set_userdata('buscador_telefono_cliente_pedido', '');
			$this->session->set_userdata('buscador_estado_pedido', '');

			$data['pedidos'] = $this->pedido_model->get_pedidos($inicio, $limite, FALSE);
			$data['estados'] = $this->pedido_model->get_estados();

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'pedidos/';
			$config['total_rows'] = count($this->pedido_model->get_pedidos(FALSE, FALSE, FALSE));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = 'Último';
			$config['uri_segment'] = 2;
			$config['first_url'] = base_url() . 'pedidos/';
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
			$this->load->view('pedido/pedidos_lista', $data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Muestra la pantalla para agregar productos
	 * a la pedido
	 */
	public function agregar(){
		$this->output->enable_profiler($this->config->item('debug_app'));
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->pedido_temp_model->guardar_pedido();
			$id_pedido = mysql_insert_id();

			$data['pedido'] = $this->pedido_temp_model->get_pedido_id($id_pedido);
			$data['id_pedido'] = $id_pedido;
			$data['productos'] = $this->producto_model->get(FALSE, FALSE, FALSE);
			$data['clientes'] = $this->cliente_model->get(FALSE, FALSE, FALSE);
			$data['costo_envio'] = $this->configuraciones_model->get_valor_envio();
			
			$this->load->view('partial/head_common');
			$this->load->view('partial/menu_lateral');
			$this->load->view('partial/menu_superior', $data);
			$this->load->view('pedido/pedido_agregar',$data);
			$this->load->view('partial/footer_common');
		}
	}

	/**
	 * Guarda el item de la pedido 
	 */
	function guardar_det_pedido_item(){
		$this->output->enable_profiler($this->config->item('debug_app'));
		if($this->input->is_ajax_request()) {
			$id_pedido = $this->input->post('txt_id_pedido');
			$id_producto = $this->input->post('id_producto');
			$cantidad_web = $this->input->post('txt_cantidad');
			$descuento_web = $this->input->post('txt_descuento');

			// Si se completo la cantidad
			if($cantidad_web != null) {
				$producto = $this->producto_model->get(FALSE, FALSE, $id_producto);
				$precio_venta = 0;
				$descripcion = '';
				foreach ($producto as $producto_row) {
					$precio_venta = $producto_row->precio_venta;
					$descripcion = $producto_row->nombre_producto;
				}

				$sub_total = $precio_venta * $cantidad_web;

				// Verifica si el producto ya esta agregado a la pedido
				$existe_producto = $this->pedido_temp_model->existe_producto($id_pedido, $id_producto);

				$descuento_monto = round(($precio_venta * $descuento_web) / 100, 0);
				$total = $sub_total - $descuento_monto;

				// Si no existe el detalle lo guarda
				if(!$existe_producto) {
					$descuento_monto = round(($precio_venta * $cantidad_web * $descuento_web) / 100, 0);
					$detalle_pedido = array (
						'id_pedido' => $id_pedido,
						'id_producto' => $id_producto,
						'descripcion' => $descripcion,
						'cantidad' => $cantidad_web,
						'precio_unitario' => $precio_venta,
						'sub_total' => $sub_total,
						'total' => $total,
						'descuento' => $descuento_monto
					);

					$this->pedido_temp_model->guardar_det_pedido($detalle_pedido);

				} else {
					$descuento_monto = round(($precio_venta * $descuento_web) / 100, 0);
					// Si existe el detalle se actualiza
					$cantidad_detalle = 0;
					$total_detalle = 0;
					$id_detalle = 0;

					foreach ($existe_producto as $producto_detalle) {
						$cantidad_detalle = $producto_detalle->cantidad;
						$total_detalle = $producto_detalle->total;
						$id_detalle = $producto_detalle->id;
					}

					$cantidad_total = $cantidad_web + $cantidad_detalle;
					$descuento_monto = ($precio_venta * $cantidad_total * $descuento_web) / 100;
					$total_con_descuento = ($precio_venta * $cantidad_total ) - $descuento_monto;

					$data = array (
						'descuento' => $descuento_monto,
						'cantidad' => $cantidad_web + $cantidad_detalle,
						'precio_unitario' => $precio_venta,
						'sub_total' => $precio_venta * $cantidad_total,
						'total' => $total_con_descuento
					);

					$this->pedido_temp_model->actualizar_detalle($id_detalle, $data);
				}
			}
		}
	}

	/**
	 * Guarda un item manual en la pedido
	 */
	function guardar_det_pedido_item_manual() {
		if($this->input->is_ajax_request()){
			$id_pedido = $this->input->post('txt_id_pedido');
			$desc_producto = ucfirst($this->input->post('txt_producto_manual'));
			$cantidad_web= $this->input->post('txt_cantidad_manual');
			$precio_neto = $this->input->post('txt_precio_neto_manual');
			$porc_descuento = $this->input->post('txt_porc_desc_manual');

			if($this->input->post('txt_precio_neto_manual') == '') {
				$precio_neto = 0;
			}

			$subtotal = $precio_neto*$cantidad_web;
			$descuento = 0;

			if($porc_descuento != '') {
				$descuento = round($subtotal * $porc_descuento / 100 , 0);
				$total = $subtotal - $descuento;
			}
			else {
				$total = $subtotal;
				$porc_descuento = 0;
			}

			$data = array (
				'id_pedido' => $id_pedido,
				'descripcion' => $desc_producto,
				'cantidad' => $cantidad_web,
				'precio_unitario' => $precio_neto,
				'sub_total' => $precio_neto * $cantidad_web,
				'total' => $total,
				'descuento' => $descuento
			);

			$datos=$this->pedido_temp_model->guardar_detalle($data);
		}
	}

	function mostrar_det_pedido(){
		if($this->input->is_ajax_request()){
			$id_pedido= $this->input->post('txt_id_pedido');

			if($datos=$this->pedido_temp_model->get_det_pedido($id_pedido)) {
				echo json_encode($datos);
			} else {
				$datos=null;
				echo json_encode($datos);
			}
		}
	}

	function eliminar_det_pedido(){
		if ($this->input->is_ajax_request()) {
			$id_det_pedido = $this->input->post("id");
			$data=$this->pedido_temp_model->eliminar_det_pedido($id_det_pedido);
		}
	}

	function guardar(){
		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$id_pedido = $this->input->post('txt_id_pedido');
			$id_sucursal = $this->input->post('cb_id_sucursal');

			// Actualiza la pedido temporal con los nuevos montos
			$data_pedido_temp = array (
				'sub_total_pedido' => $this->input->post('txt_sub_total'),
				'total_pedido' => $this->input->post('txt_total'),
				'observaciones' => $this->input->post('txt_observaciones'),
			);

			$this->pedido_temp_model->actualizar_pedido($id_pedido, $data_pedido_temp);

			// SE PASA LA pedido TEMPORAL A LA pedido DEFINITIVA
			// Obtiene la pedido temporal
			$pedido_temporal = $this->pedido_temp_model->get($id_pedido);
			// Ultimo numero de pedido
			$num_pedido_max = $this->pedido_model->ultimo_pedido();

			$data_pedido_real = null;

			$total_envio = 0;
			if($this->input->post('agrega_envio') == 1) {
				$total_envio = 20;
			}

			foreach ($pedido_temporal as $pedido_temporal_for) {
				$data_pedido_real = array (
					'id_cliente' => $this->input->post('id_cliente_pedido'),
					'dia_pedido' => $this->input->post('dia_pedido'),
					'hora_pedido' => $this->input->post('hora_pedido'),
					'id_estado_pedido' => 2,
					'numero_pedido' => $num_pedido_max + 1,
					'sub_total_pedido' => $pedido_temporal_for->sub_total_pedido,
					'total_envio' => $total_envio,
					'descuento_pedido' => $this->input->post('txt_descuento_total'),
					'total_pedido' => $pedido_temporal_for->total_pedido,
					'fecha_pedido' => $pedido_temporal_for->fecha_pedido,
					'observaciones' => $pedido_temporal_for->observaciones,
					'tipo_pago' => $this->input->post('tipo_pago'),
					'estado_logico' => 'A',
					'fecha_ingreso' => date('Y-m-d H:i:s'),
					'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
				);
			}

			$id_pedido_nuevo = $this->pedido_model->guardar_pedido($data_pedido_real);

			// SE PASAN LOS ITEMS DE LA pedido TEMPORAL A LA pedido REAL
			// Obtiene todos los items de la pedido temporal
			$detalle_pedido_temporal = $this->pedido_temp_model->get_detalle($id_pedido);

			$total_descuento = 0;
			// Se guarda cada item de la pedido temporal en la pedido real
			foreach ($detalle_pedido_temporal as $det_pedido_for) {
				// Suma los descuentos en cada item
				//$total_descuento = $total_descuento + $det_pedido_for->descuento;
				// Se genera cada item de la pedido real en base a la pedido temporal
				$detalle_pedido_real = array (
					'id_pedido' => $id_pedido_nuevo,
					'descripcion' => $det_pedido_for->descripcion,
					'id_producto' => $det_pedido_for->id_producto,
					'cantidad' => $det_pedido_for->cantidad,
					'precio_unitario' => $det_pedido_for->precio_unitario,
					'sub_total' => $det_pedido_for->sub_total,
					'total' => $det_pedido_for->total,
					'descuento' => $det_pedido_for->descuento,
					'estado_logico' => 'A',
					'fecha_ingreso' => date('Y-m-d H:i:s'),
					'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
				);

				$this->pedido_model->guardar_det_pedido($detalle_pedido_real);
			}

			// Se actualiza el descuento en la pedido
			$data_pedido_desc = array (
				'descuento_pedido' => $total_descuento + $this->input->post('txt_descuento_total'),
			);

			$this->pedido_model->actualizar_pedido($id_pedido_nuevo, $data_pedido_desc);
			
			// Muestra el mensaje de agregar
			$this->session->set_flashdata('mensaje_pedido', 'A');

			redirect('/pedidos');
		}
	}

	/**
	 * Funcion del boton cancelar
	 */
	function eliminar_toda_pedido(){
		if ($this->input->is_ajax_request()) {
			$id_nota_venta = $this->input->post("id");
			$this->pedido_temp_model->eliminar_nota_venta($id_nota_venta);
			$this->pedido_temp_model->eliminar_detalle_nota_venta($id_nota_venta);
		}
	}

	function eliminar($id) {
		$this->output->enable_profiler($this->config->item('debug_app'));
	
		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			// Realiza una baja logica
			$pedido = array (
				'estado_logico' => 'B',
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Elimina la pedido
			$this->pedido_model->actualizar_pedido($id, $pedido);
			$this->pedido_model->eliminar_det_pedido_id($id, $pedido);

			// Muestra el mensaje de eliminar
			$this->session->set_flashdata('mensaje_pedido', 'B');

			// Vuelve a la lista de pedidoes
			redirect('/pedidos/');
		}
	}

	function view($id_pedido) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$fecha = date('Y-m-d');
			$total = 0;
			$data['pedido'] = $this->pedido_model->get_pedido_id($id_pedido);
			$data['detalle_factura'] = $this->pedido_model->get_det_pedido($id_pedido);
			
			if($data['pedido'] != false) {
				$id_cliente = 0;
				foreach ($data['pedido'] as $pedido) {
					$id_cliente = $pedido->id_cliente;
				}

				$data['cliente'] = $this->cliente_model->get(FALSE, FALSE, $id_cliente);
				$this->load->view('partial/head_common');
				$this->load->view('partial/menu_lateral');
				$this->load->view('partial/menu_superior');
				$this->load->view('pedido/pedido_ver',$data);
				$this->load->view('partial/footer_common');

			} else {
				// Si no tiene permisos va a la pagina pedido
				redirect('/pedidos/');
			}
		}
	}

	function verpedidomodal() {
		if($this->input->is_ajax_request()){
			//$this->output->enable_profiler($this->config->item('debug_app'));
			$id_pedido= $this->input->post('id_pedido');

			if ($this->session->userdata($this->config->item('idUsuario')) == null) {
				redirect('login');
			} else {
				$fecha = date('Y-m-d');
				$total = 0;
				$pedido = $this->pedido_model->get_pedido_id($id_pedido);
				$detalle_pedido = $this->pedido_model->get_det_pedido($id_pedido);
				
				if($pedido != false) {
					$id_cliente = 0;
					foreach ($pedido as $pedido_row) {
						$id_cliente = $pedido_row->id_cliente;
					}

					$cliente = $this->cliente_model->get(FALSE, FALSE, $id_cliente);					
					$datos = array( 'cliente' => $cliente, 'id_pedido' => $id_pedido, 'pedido' => $pedido, 'detalle_pedido' => $detalle_pedido );
					echo json_encode($datos);
				} else {
					$datos = null;
					echo json_encode($datos);
				}
			}
		}
	}

	function cambiarestado() {
		$this->output->enable_profiler($this->config->item('debug_app'));
	
		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$ok_puntos_acumulados = 0;
			$id_cliente = 0;
			$total_importe = 0;
			$pedido_puntos = $this->pedido_model->get_pedido_puntos($this->input->post('id_serv'));

			if($pedido_puntos) {
				foreach ($pedido_puntos as $row_pedido_puntos) {
					$id_cliente = $row_pedido_puntos->id_cliente;
					$total_importe = $row_pedido_puntos->sub_total_pedido;
					$ok_puntos_acumulados = $row_pedido_puntos->ok_puntos_acumulados;
				}
				
				if($ok_puntos_acumulados == 0 && $this->input->post('estado_pedido') == 3) {
					$porcentaje_puntos = $this->configuraciones_model->get_porcentaje_puntos();
					$puntos_a_acumular = round($total_importe * $porcentaje_puntos / 100);
					$puntos_cliente = $this->cliente_model->get_puntos(FALSE, $id_cliente);

					// Actualiza los puntos
					$cliente = array (
						'puntos_acumulados' => $puntos_cliente + $puntos_a_acumular,
						'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
						'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
					);

					// Actualiza el cliente
					$this->cliente_model->actualizar($cliente, $id_cliente);
					$ok_puntos_acumulados = 1;
				}
			}

			$pedido = array (
				'id_estado_pedido' => $this->input->post('estado_pedido'),
				'ok_puntos_acumulados' => $ok_puntos_acumulados,
				'ultima_fecha_modificacion' => date('Y-m-d H:i:s'),
				'usuario_ultima_modificacion' => $this->session->userdata($this->config->item('idUsuario'))
			);

			// Actualiza el pedido
			$this->pedido_model->actualizar_pedido($this->input->post('id_serv'), $pedido);

			// Muestra el mensaje de cambiar estado
			$this->session->set_flashdata('mensaje_pedido', 'E');

			// Vuelve a la lista de pedidoes
			redirect('/pedidos/');
		}
	}

	function buscarpedido($pagina = FALSE) {
		$this->output->enable_profiler($this->config->item('debug_app'));

		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('table');

			$inicio = 0;
			$limite = 10;
			$buscador_numero_pedido = '';
			$buscador_cliente_pedido = '';
			$buscador_estado_pedido = '';

			if ($pagina !== FALSE) {
				$inicio = ($pagina -1) * $limite;
				$buscador_numero_pedido = $this->session->userdata('buscador_numero_pedido');
				$buscador_cliente_pedido = $this->session->userdata('buscador_cliente_pedido');
				$buscador_telefono_cliente_pedido = $this->session->userdata('buscador_telefono_cliente_pedido');
				$buscador_estado_pedido = $this->session->userdata('buscador_estado_pedido');
				$this->session->set_userdata($this->config->item('paginapedido'), $pagina);
			} else {
				$this->session->set_userdata('buscador_numero_pedido', $this->input->post('numero'));
				$buscador_numero_pedido = $this->input->post('numero');
				$this->session->set_userdata('buscador_cliente_pedido', $this->input->post('cliente'));
				$buscador_cliente_pedido = $this->input->post('cliente');

				$this->session->set_userdata('buscador_telefono_cliente_pedido', $this->input->post('telefono_cliente'));
				$buscador_telefono_cliente_pedido = $this->input->post('telefono_cliente');

				$this->session->set_userdata('buscador_estado_pedido', $this->input->post('estado'));
				$buscador_estado_pedido = $this->input->post('estado');
				$this->session->set_userdata($this->config->item('paginaPedidos'), 1);
			}

			$data['pedidos'] = $this->pedido_model->get_por_filtro($inicio, $limite, $buscador_numero_pedido, $buscador_cliente_pedido, $buscador_estado_pedido, $buscador_telefono_cliente_pedido);
			$data['estados'] = $this->pedido_model->get_estados();

			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'pedidos/buscarpedido/';
			$config['total_rows'] = count($this->pedido_model->get_por_filtro(FALSE, FALSE, $buscador_numero_pedido, $buscador_cliente_pedido, $buscador_estado_pedido, $buscador_telefono_cliente_pedido));
			$config['per_page'] = $limite;
			$config['first_link'] = 'Primera';
			$config['last_link'] = 'Último';
			$config['uri_segment'] = 3;
			$config['first_url'] = base_url() . 'pedidos/buscarpedido/';
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
			$this->load->view('pedido/pedidos_lista', $data);
			$this->load->view('partial/footer_common');
		}
	}

	function agregarcliente() {
		if($this->input->is_ajax_request()){
			$this->load->library('form_validation');
			$this->load->library('email');
			$this->load->helper('inflector');

			// Verifica login
			if ($this->session->userdata($this->config->item('idUsuario')) == null) {
				redirect('login');
			} else {
				$cliente = array (
					'nombre' => humanize($this->input->post('nombre-agregar')),
					'codigo_area' => $this->input->post('area-agregar'),
					'telefono' => $this->input->post('telefono-agregar'),
					'email' => $this->input->post('correo-agregar'),
					'direccion' => $this->input->post('direccion-agregar'),
					'estado_logico' => 'A',
					'fecha_ingreso' => date('Y-m-d H:i:s'),
					'usuario_ingreso' => $this->session->userdata($this->config->item('idUsuario'))
				);

				$this->cliente_model->guardar($cliente);
				$id_cliente = mysql_insert_id();
					
				$cliente_return = $this->cliente_model->get_json();

				echo json_encode($cliente_return);
			}
		}
	}

	function verpdf($id_pedido) {
		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->__pdf($id_pedido, 'I');
		}
	}

	function descargarpdf($id_pedido) {
		// Verifica login
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->__pdf($id_pedido, 'D');
		}
	}

	function __pdf($id_pedido, $descargar){
		$this->output->enable_profiler($this->config->item('debug_app'));
		// Se carga la libreria fpdf
		$this->load->library('ComprobantePdf');
		// Creacion del PDF

		// Variables para el pdf
		$pedido = $this->pedido_model->get_pedido_id($id_pedido);
		$detalle_pedido = $this->pedido_model->get_det_pedido($id_pedido);

		$subtotal_pedido = 0;
		$total_envio = 0;
		$total_pedido = 0;
		$total_descuento = 0;
		$fecha_pedido = '';
		$dia_pedido = '';
		$hora_pedido = '';

		if($pedido != false) {
			$id_cliente = 0;
			foreach ($pedido as $for_nota) {
				$subtotal_pedido = $for_nota->pedido_sub_total;
				$total_envio = $for_nota->total_envio;
				$total_pedido = $for_nota->total_pedido;
				$fecha_pedido = $for_nota->fecha_pedido;
				$total_descuento = $for_nota->total_descuento;
				$dia_pedido = $for_nota->dia_pedido;
				$hora_pedido = $for_nota->hora_pedido;
				$id_cliente = $for_nota->id_cliente;
			}

			$cliente = $this->cliente_model->get(FALSE, FALSE, $id_cliente);

			$nombre_cliente = '';
			$direccion_cliente = '';
			$telefono_cliente = '';

			foreach ($cliente as $fila_cliente) {
				$nombre_cliente = $fila_cliente->nombre;
				$direccion_cliente = $fila_cliente->direccion;
				$telefono_cliente = $fila_cliente->telefono;
			}

			/*
			 * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
			 * hered� todos las variables y m�todos de fpdf
			 */
			$this->pdf = new ComprobantePdf();

			$this->pdf->setNumeroComprobante($id_pedido);

			$this->pdf->setCliente($nombre_cliente);
			$this->pdf->setDireccionCliente($direccion_cliente);
			$this->pdf->setTelefonoCliente($telefono_cliente);
			$this->pdf->setDiaPedido($dia_pedido);
			$this->pdf->setHoraPedido($hora_pedido);

			// Agregamos una p�gina
			$this->pdf->AddPage('P', 'A4');
			// Define el alias para el n�mero de p�gina que se imprimir� en el pie
			$this->pdf->AliasNbPages();

			$this->pdf->SetFont('Arial','',10);
			$this->pdf->Text(140, 40, utf8_decode('Fecha Pedido: ' . date("d/m/Y", strtotime($fecha_pedido))));

			$this->pdf->SetLineWidth(0.5);
			$this->pdf->SetFillColor(255);
			// x, y, w, h, r, style
			$this->pdf->RoundedRect(10, 50, 190, 25, 3.5, 'D');

			$this->pdf->Ln(14);
			$this->pdf->SetFillColor(10,90,179);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFont('Arial','B',12);
			$this->pdf->Cell(3,7,'','TB',0,'L','1');
			$this->pdf->Cell(110,7,utf8_decode('Descripción'),'TB',0,'L','1');
			$this->pdf->Cell(20,7,utf8_decode('Cant'),'TB',0,'L','1');
			$this->pdf->Cell(28,7,utf8_decode('P. Unitario'),'TB',0,'L','1');
			$this->pdf->Cell(29,7,utf8_decode('Total Importe'),'TB',0,'L','1');
			$this->pdf->Ln(7);
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',12);

			$this->pdf->Rect(10,80,190,150);

			$this->pdf->Line(118,80,118,230);
			$this->pdf->Line(140,80,140,230);
			$this->pdf->Line(168,80,168,230);

			$precio_unitario = 0;
			$descuento = 0;
			$precio_total = 0;
			$cantidad = 0;

			foreach ($detalle_pedido as $detalle) {
				// Se imprimen los datos de cada producto
				if($detalle->cantidad > 0) {
					$cantidad = $detalle->cantidad;
				} else {
					$cantidad = '';
				}

				if($detalle->precio_unitario > 0) {
					$precio_unitario = '$ ' . number_format($detalle->precio_unitario, 0, ",", ".");
				} else {
					$precio_unitario = '';
				}

				if($detalle->total > 0) {
					$precio_total = '$ ' . number_format($detalle->total, 0, ",", ".");
				} else {
					$precio_total = '';
				}

				if($detalle->descuento > 0) {
					$descuento = '$ ' . number_format($detalle->descuento, 0, ",", ".");
				} else {
					$descuento = '';
				}

				$this->pdf->SetFont('Arial','',12);
				$this->pdf->Cell(5,8,'','0',0,'L',0);
				$this->pdf->Cell(110,8,utf8_decode($detalle->descripcion),'0',0,'L',0);
				$this->pdf->Cell(20,8,utf8_decode($cantidad),'0',0,'L',0);
				$this->pdf->Cell(25,8,utf8_decode($precio_unitario),'0',0,'L',0);
				$this->pdf->Cell(20,8,utf8_decode($precio_total),'0',0,'L',0);
				//Se agrega un salto de linea
				$this->pdf->Ln(6);
			}

			$this->pdf->SetFont('Arial','',8);

			$this->pdf->SetLineWidth(0.5);
			$this->pdf->SetFillColor(255);
			// x, y, w, h, r, style
			$this->pdf->RoundedRect(135, 240, 65, 40, 2.5, 'D');

			$this->pdf->Ln(40);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Text(140, 248, 'Subtotal: ' . '$ ' . number_format($subtotal_pedido, 0, ",", "."));
			$this->pdf->Text(140, 254, utf8_decode('Envío: ' . '$ ' . number_format($total_envio, 0, ",", ".")));
			$this->pdf->Text(140, 260, 'Total Descuento: ' . '$ ' . number_format($total_descuento, 0, ",", "."));
			$this->pdf->Text(140, 266, 'Total: ' . '$ ' . number_format($total_pedido, 0, ",", "."));

			/*
			 * Se manda el pdf al navegador
			 *
			 * $this->pdf->Output(nombredelarchivo, destino);
			 *
			 * I = Muestra el pdf en el navegador
			 * D = Envia el pdf para descarga
			 *
			 */
			$this->pdf->Output("pedido_" . $id_pedido . ".pdf", $descargar);
		} else {
			redirect('/pedido/');
		}
	}

	function ticket($id_pedido){
		if ($this->session->userdata($this->config->item('idUsuario')) == null) {
			redirect('login');
		} else {
			$this->load->library('ReporteExcel');

			$pedido = $this->pedido_model->get_pedido_id($id_pedido);
			$detalle_pedido = $this->pedido_model->get_det_pedido($id_pedido);

			$total_envio = 0;
			$subtotal_pedido = 0;
			$descuento_pedido = 0;
			$total_pedido = 0;

			if($pedido != false) {
				$id_cliente = 0;
				foreach ($pedido as $row_pedido) {
					$id_cliente = $row_pedido->id_cliente;
					$total_envio = $row_pedido->total_envio;
					$subtotal_pedido = $row_pedido->pedido_sub_total;
					$descuento_pedido = $row_pedido->total_descuento;
					$total_pedido = $row_pedido->total_pedido;
				}

				$cliente = $this->cliente_model->get(FALSE, FALSE, $id_cliente);
			}

			$nombre_cliente = '';
			$direccion_cliente = '';
			$localidad_cliente = 'AZUL';
			$telefono_cliente = '';
			if($cliente != false) {
				$id_cliente = 0;
				foreach ($cliente as $row_cliente) {
					$nombre_cliente = $row_cliente->nombre;
					$direccion_cliente = $row_cliente->direccion;
					$telefono_cliente = $row_cliente->telefono;
				}
			}

			$this->excel = new ReporteExcel();
			$this->excel->setHeader();

			// Ancho de columnas
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(12);
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(21.8);
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(12);
		
			// Centrado
			$style_center = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
				'font' => array(
					'name'  => 'Fontb11',
					'size' => 10
				)
			);

			// Centrado vertical
			$style_center_vertical_horizontal = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'font' => array(
					'name'  => 'Fontb11',
					'size' => 10
				)
			);

			// Centrado y negrita
			$style_font = array(
				'font' => array(
					'name'  => 'Fontb11',
					'size' => 10
				)
			);

			// Negrita
			$style_bold = array(
				'font' => array(
					'bold' => true
				)
			);			

			// Son de miga
			$this->excel->setActiveSheetIndex(0)->mergeCells('A2:C2');
			$this->excel->setActiveSheetIndex(0)->setCellValue('A2', 'SONDEMIGA.COM');
			$this->excel->setActiveSheetIndex(0)->getStyle("A2")->applyFromArray($style_center);

			// Telefono
			$this->excel->setActiveSheetIndex(0)->mergeCells('A3:C3');
			$this->excel->setActiveSheetIndex(0)->setCellValue('A3', 'TEL.: 0228 - 15 318667');
			$this->excel->setActiveSheetIndex(0)->getStyle("A3")->applyFromArray($style_center);

			// Fabrica
			$this->excel->setActiveSheetIndex(0)->mergeCells('A4:C4');
			$this->excel->setActiveSheetIndex(0)->setCellValue('A4', 'FABRICA DE SANDWICHES');
			$this->excel->setActiveSheetIndex(0)->getStyle("A4")->applyFromArray($style_center);

			// Linea
			$this->excel->setActiveSheetIndex(0)->mergeCells('A5:C5');
			$this->excel->setActiveSheetIndex(0)->setCellValue('A5', '---------------------------------------------');
			$this->excel->setActiveSheetIndex(0)->getStyle("A5")->applyFromArray($style_center);

			// Fecha y Hora
			$this->excel->setActiveSheetIndex(0)->setCellValue('B6', '=NOW()');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C6', '=TODAY()');
			$this->excel->setActiveSheetIndex(0)->getStyle("B6")->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->getStyle("C6")->applyFromArray($style_font);

			// Linea
			$this->excel->setActiveSheetIndex(0)->mergeCells('A7:C7');
			$this->excel->setActiveSheetIndex(0)->setCellValue('A7', '---------------------------------------------');
			$this->excel->setActiveSheetIndex(0)->getStyle("A7")->applyFromArray($style_center);

			// Pedido
			$this->excel->setActiveSheetIndex(0)->setCellValue('A8', 'PEDIDO NRO');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C8', '#' . $id_pedido);
			$this->excel->setActiveSheetIndex(0)->getStyle("A8")->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->getStyle("C8")->applyFromArray($style_font);

			// Nombre Cliente
			$this->excel->setActiveSheetIndex(0)->setCellValue('A9', 'CLIENTE');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C9', $nombre_cliente);
			$this->excel->setActiveSheetIndex(0)->getStyle("A9")->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->getStyle("C9")->applyFromArray($style_font);

			// Direccion
			$this->excel->setActiveSheetIndex(0)->setCellValue('A10', 'DIRECCION:');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C10', $direccion_cliente);
			$this->excel->setActiveSheetIndex(0)->getStyle("A10")->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->getStyle("C10")->applyFromArray($style_font);

			// Localidad
			$this->excel->setActiveSheetIndex(0)->setCellValue('A11', 'LOC:');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C11', $localidad_cliente);
			$this->excel->setActiveSheetIndex(0)->getStyle("A11")->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->getStyle("C11")->applyFromArray($style_font);

			// Telefono
			$this->excel->setActiveSheetIndex(0)->setCellValue('A12', 'TELEFONO');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C12', $telefono_cliente);
			$this->excel->setActiveSheetIndex(0)->getStyle("A12")->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->getStyle("C12")->applyFromArray($style_font);

			// Linea
			$this->excel->setActiveSheetIndex(0)->mergeCells('A13:C13');
			$this->excel->setActiveSheetIndex(0)->setCellValue('A13', '---------------------------------------------');

			// Titulo detalles del pedido
			$this->excel->setActiveSheetIndex(0)->mergeCells('A14:C15');
			$this->excel->setActiveSheetIndex(0)->setCellValue('A14', 'DETALLES DEL PEDIDO');
			$this->excel->setActiveSheetIndex(0)->getStyle("A14")->applyFromArray($style_center_vertical_horizontal);

			// Titulo detalles del pedido
			$this->excel->setActiveSheetIndex(0)->setCellValue('A16', 'CANT');
			$this->excel->setActiveSheetIndex(0)->setCellValue('B16', 'SABORES/PEDIDO');
			$this->excel->setActiveSheetIndex(0)->setCellValue('C16', 'IMPORTE');
			$this->excel->setActiveSheetIndex(0)->getStyle("A16")->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->getStyle("B16")->applyFromArray($style_center);
			$this->excel->setActiveSheetIndex(0)->getStyle("C16")->applyFromArray($style_center);

			
			// Comienza en fila 17
			$fila_excel = 17;

			foreach($detalle_pedido as $row_detalle_pedido) {
				$this->excel->setActiveSheetIndex(0)->setCellValue('A'.$fila_excel, $row_detalle_pedido->cantidad);
				$this->excel->setActiveSheetIndex(0)->getStyle('A'. $fila_excel)->applyFromArray($style_center);
				$this->excel->setActiveSheetIndex(0)->setCellValue('B'.$fila_excel, $row_detalle_pedido->descripcion);
				$this->excel->setActiveSheetIndex(0)->getStyle('B'. $fila_excel)->applyFromArray($style_font);
				$this->excel->setActiveSheetIndex(0)->setCellValue('C'.$fila_excel, '$ ' . number_format($row_detalle_pedido->precio_unitario, 2, ",", ""));
				$this->excel->setActiveSheetIndex(0)->getStyle('C'. $fila_excel)->applyFromArray($style_center);
				$fila_excel++;
			}
			
			// Linea
			$fila_linea_despues_detalle = $fila_excel + 2;
			$this->excel->setActiveSheetIndex(0)->mergeCells('A' . $fila_linea_despues_detalle . ':C' . $fila_linea_despues_detalle);
			$this->excel->setActiveSheetIndex(0)->setCellValue('A' . $fila_linea_despues_detalle, '---------------------------------------------');

			$fila_envio = $fila_excel + 3;
			$fila_subtotal = $fila_excel + 4;
			$fila_descuento = $fila_excel + 5;
			$fila_total = $fila_excel + 6;
			$fila_linea_despues_totales = $fila_excel + 8;
			$fila_gracias_por_su_compra = $fila_excel + 9;
			$fila_linea_despues_gracias = $fila_excel + 10;
			$fila_ticket_no_valido = $fila_excel + 11;
			$fila_linea_despues_ticket = $fila_excel + 12;
			$fila_horarios = $fila_excel + 13;
			$fila_pagina_web = $fila_excel + 14;

			// Subtotal
			$this->excel->setActiveSheetIndex(0)->setCellValue('A'.$fila_envio, 'ENVIO:');
			$this->excel->setActiveSheetIndex(0)->getStyle('A'. $fila_envio)->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->setCellValue('C'.$fila_envio, '$ ' . number_format($total_envio, 2, ",", ""));
			$this->excel->setActiveSheetIndex(0)->getStyle('C'. $fila_envio)->applyFromArray($style_center);

			// Subtotal
			$this->excel->setActiveSheetIndex(0)->setCellValue('A'.$fila_subtotal, 'SUBTOTAL:');
			$this->excel->setActiveSheetIndex(0)->getStyle('A'. $fila_subtotal)->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->setCellValue('C'.$fila_subtotal, '$ ' . number_format($subtotal_pedido, 2, ",", ""));
			$this->excel->setActiveSheetIndex(0)->getStyle('C'. $fila_subtotal)->applyFromArray($style_center);

			// Descuento
			$this->excel->setActiveSheetIndex(0)->setCellValue('A'.$fila_descuento, 'DESC:');
			$this->excel->setActiveSheetIndex(0)->getStyle('A'. $fila_descuento)->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->setCellValue('C'.$fila_descuento, '$ ' . number_format($descuento_pedido, 2, ",", ""));
			$this->excel->setActiveSheetIndex(0)->getStyle('C'. $fila_descuento)->applyFromArray($style_center);

			// Total
			$this->excel->setActiveSheetIndex(0)->setCellValue('A'.$fila_total, 'TOTAL:');
			$this->excel->setActiveSheetIndex(0)->getStyle('A'. $fila_total)->applyFromArray($style_font);
			$this->excel->setActiveSheetIndex(0)->setCellValue('C'.$fila_total, '$ ' . number_format($total_pedido, 2, ",", ""));
			$this->excel->setActiveSheetIndex(0)->getStyle('C'. $fila_total)->applyFromArray($style_center);

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="ticket.xlsx"');
			header('Cache-Control: max-age=0');

			$objWriter=PHPExcel_IOFactory::createWriter($this->excel,'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
	}
}