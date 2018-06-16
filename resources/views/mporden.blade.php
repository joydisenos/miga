<?php 
			$mp = base_path("vendor\mercadopago\sdk\lib\mercadopago.php");
            require_once $mp; 

                $mp = new MP("1787728543868124", "6nXoG9IfPRwUL4BXWW2IDkweUSH40Hn6");

			    $preference_data = array(
			    

			            "items" => array(
			        array(
			            "id" => $orden->id,
			            "title" => 'Orden '.$orden->id,
			            "currency_id" => "ARS",
			            "category_id" => "Alimentos",
			            "quantity" => 1,
			            "unit_price" => (float)$orden->total
				        )
				    ),

			             "back_urls" => array(
			            "success" => url('pagos'.'/'.$orden->id.'/'.'mercadopago'),
			            "failure" => url('pagos'.'/'.$orden->id.'/'.'fail'),
			            "pending" => url('pagos'.'/'.$orden->id.'/'.'pendiente')
			        )




				);

        $preference = $mp->create_preference($preference_data);

        header("Location: ".$preference["response"]["init_point"]);
		die();

 ?>
