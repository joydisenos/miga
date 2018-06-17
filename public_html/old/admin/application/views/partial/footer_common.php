	
	<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
	<script src="<?= $this->config->base_url();?>js/custom.js"></script>	
	<script src="<?php echo base_url();?>js/jquery.prettynumber.js"></script>

	<script src="<?php echo $this->config->base_url();?>slim/slim.commonjs.js" type="text/javascript"></script>
	<script src="<?php echo $this->config->base_url();?>slim/slim.amd.js" type="text/javascript"></script>
	<script src="<?php echo $this->config->base_url();?>slim/slim.global.js" type="text/javascript"></script>
	<script src="<?php echo $this->config->base_url();?>slim/slim.kickstart.js" type="text/javascript"></script>
	<script>
		$(function(){
			$("input[name='file']").on("change", function(){
				var formData = new FormData($("#formulario")[0]);
				$.ajax({
					url: "<?php echo base_url()?>imagenes/subirimagen",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function(datos)
					{
						$("#respuesta").html(datos);
					}
				});
			});
		});
	</script>
</body>
</html>