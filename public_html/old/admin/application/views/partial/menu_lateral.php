<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="clearfix"></div>
					<!-- menu prile quick info -->
					<div class="profile">
						<div class="profile_pic">
							<img src="<?php echo base_url();?>img/favicon/favicon.png" alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Bienvenido</span>
							<h2><?php echo $this->session->userdata($this->config->item('nombreUsuario'));?></h2>
						</div>
					</div>
					<!-- /menu prile quick info -->
					<br />
					<!-- sidebar menu -->
					<div id="sidebar-menu"
						class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">
								<li><a href="<?php echo site_url('/producto')?>"><i class="fa fa-home"></i>Home<span class="fa fa-chevron-down"></span></a></li>
								<li>
									<a><i class="fa fa-barcode"></i>Productos<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li class=""><a href="<?php echo site_url('/producto')?>">Productos</a></li>
										<li class=""><a href="<?php echo site_url('/producto/agregar')?>">Agregar Producto</a></li>
									</ul>
								</li>
								<li>
									<a><i class="fa fa-address-card" aria-hidden="true"></i>Clientes<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="<?php echo site_url('/cliente')?>">Clientes</a></li>
										<li><a href="<?php echo site_url('/cliente/agregar')?>">Agregar Cliente</a></li>
									</ul>
								</li>
								<li>
									<a><i class="fa fa-bar-chart" aria-hidden="true"></i>Pedidos<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="<?php echo site_url('/pedidos')?>">Pedidos</a></li>
										<li><a href="<?php echo site_url('/pedidos/agregar')?>">Agregar Pedido</a></li>
									</ul>
								</li>
								<li>
									<a><i class="fa fa-cog" aria-hidden="true"></i>Categor&iacute;as<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="<?php echo site_url('/categoria')?>">Categor&iacute;as</a></li>
										<li><a href="<?php echo site_url('/categoria/agregar')?>">Agregar Categor&iacute;a</a></li>
									</ul>
								</li>
								<li>
									<a><i class="fa fa-clock-o"></i>Horarios<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li class=""><a href="<?php echo site_url('/horarios')?>">Horarios</a></li>
										<li class=""><a href="<?php echo site_url('/horarios/especiales')?>">Horarios especiales</a></li>
									</ul>
								</li>
								<li>
									<a><i class="fa fa-file-image-o" aria-hidden="true"></i>Im&aacute;genes<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="<?php echo site_url('/imagenes')?>">Im&aacute;genes</a></li>
										<li><a href="<?php echo site_url('/imagenes/agregar')?>">Agregar Im&iacute;genes</a></li>
									</ul>
								</li>
								<li>
									<a><i class="fa fa-users" aria-hidden="true"></i>Usuarios<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="<?php echo site_url('/usuario')?>">Usuarios</a></li>
										<li><a href="<?php echo site_url('/usuario/agregar')?>">Agregar Usuario</a></li>
									</ul>
								</li>
								<li>
									<a><i class="fa fa-cog" aria-hidden="true"></i>Configuraciones<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="<?php echo site_url('/configuraciones')?>">Configuraciones</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<!-- /sidebar menu -->
				</div>
			</div>