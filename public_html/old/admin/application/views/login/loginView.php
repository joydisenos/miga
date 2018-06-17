<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Somos una empresa de servicios informáticos y desarrollo de software, la cual se destaca no solo por trabajar con las últimas tecnologías, sino también por estar a la par de la constante evolución en las prácticas de la ingeniería del software">
	<link rel="shortcut icon" href="<?php echo base_url();?>img/logos/favicon.jpg">
    <meta name="author" content="Hardesk">

    <title>Sondemiga.com</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/styles.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<!-- Comienza site_content -->
	<div id="site_content" class="container">
<!-- Modal -->
<div id="modalErrorIniciarSesion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p><?=$error?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>

  </div>
</div>
<div class="row">
	<div id="loginbox" style="margin-top:50px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
		<div class="panel panel-info" >
			<div class="panel-heading">
				<div class="panel-title">Ingresar a SondeMiga.com</div>
				<img src="../logo.svg" width="100%" height="auto">
			</div>  
			<div style="padding-top:30px" class="panel-body" >
				<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
				<?php $attributes = array('id' => 'loginform', 'class' => 'form-horizontal', 'role' => 'form'); ?>
				<?php echo form_open('login/ingresar', $attributes); ?>
					<input name="sess" type="hidden" value="login">
					<?php echo form_error('usuario'); ?>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="usuario" type="text" class="form-control" name="usuario" value="<?php echo set_value('usuario');?>" placeholder="Usuario">
					</div>
					<?php echo form_error('password'); ?>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">
					</div>
					<!-- <div class="input-group">
						<div class="checkbox">
							<label>
								<input id="login-remember" type="checkbox" name="remember" value="1"> Recordarme
							</label>
						</div>
					</div> -->
					<div style="margin-top:10px" class="form-group">
						<!-- Button -->
						<div class="col-sm-12 controls">
							<input class="btn btn-success" name="submit" id="submit" tabindex="5" value="Ingresar" type="submit">
						</div>
					</div>
				</form>
			</div>
		</div>  
	</div>
</div>
<?php if(isset($error)){?>
	<script type="text/javascript">
		$("#modalErrorIniciarSesion").modal()
	</script>
<?php
	}
?> 
		</div> <!-- fin de div site_content -->
</body>
</html>