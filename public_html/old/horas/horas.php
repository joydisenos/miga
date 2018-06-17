<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

	// REQUIRED
	// Set your default time zone (listed here: http://php.net/manual/en/timezones.php)
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	// Include the store hours class
	require __DIR__ . '/StoreHours.class.php';

	class h{
		private $store_hours;
		private $hours;
		private $exceptions;
		private $config;
		private $t;
		private $mensaje_abierto;
		private $mensaje_cerrado;

		function __construct(){
			$this->t = "";

			/*$hostname_db = "localhost";
			$database_db = "miga";
			$username_db = "root";
			$password_db = "root";*/
			$hostname_db = "localhost";
            $database_db = "sondemig_datos";
            $username_db = "sondemig_user";
            $password_db = "@Reggae91";
			$conex = mysqli_connect($hostname_db, $username_db, $password_db, $database_db);
			error_reporting(E_ALL);
			ini_set("dispay_errors", 1);
			mysqli_set_charset($conex, 'utf8');
			// Consulta de horarios
			$query_horarios = "SELECT * FROM horarios where id = 1";
			$horarios = $conex->query($query_horarios);
			$listaHorarios = array();

			if ($horarios->num_rows > 0) { 
				while($row = $horarios->fetch_assoc()) {
					$listaHorarios = array(
						'lun' => explode(",",$row["lunes"]),
						'mar' => explode(",",$row["martes"]),
						'mie' => explode(",",$row["miercoles"]),
						'jue' => explode(",",$row["jueves"]), // Open lae
						'vie' => explode(",",$row["viernes"]),
						'sab' => explode(",",$row["sabado"]),
						'dom' => explode(",",$row["domingo"])
					);
				}
			}

			$this->hours = $listaHorarios;

			$query_horarios_especiales = "SELECT * FROM horarios_especiales where estado_logico = 'A'";
			$horarios_especiales = $conex->query($query_horarios_especiales);
			$listaHorariosEspeciales = array();
			if ($horarios_especiales->num_rows > 0) { 
				while($row = $horarios_especiales->fetch_assoc()) {
					$listaHorariosEspeciales_while = array(
						$row["mes"] . '/' . $row["dia"] => explode(",",$row["horario"])
					);
					$listaHorariosEspeciales = $listaHorariosEspeciales + $listaHorariosEspeciales_while;
				}
			}

			// Consulta las configuraciones
			$query_configuraciones = "SELECT * FROM configuraciones where estado_logico = 'A'";
			$configuraciones = $conex->query($query_configuraciones);

			$this->mensaje_abierto = '';
			$this->mensaje_cerrado = '';

			if ($configuraciones->num_rows > 0) {
				while($row = $configuraciones->fetch_assoc()) {
					if($row["id"] == 3) {
						$this->mensaje_abierto = $row["valor"];
					}
					if($row["id"] == 4) {
						$this->mensaje_cerrado = $row["valor"];
					}
				}
			}

			// OPTIONAL
			// Add exceptions (great for holidays etc.)
			// MUST be in a format month/day[/year] or [year-]month-day
			// Do not include the year if the exception repeats annually
			$this->exceptions = $listaHorariosEspeciales;

			$this->config = array(
				'separator'			=> ' - ',
				'join'				=> ' y ',
				'format'			=> 'H:i',
				'overview_weekdays'	=> array('Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom')
			);

			$this->store_hours = new StoreHours($this->hours, $this->exceptions, $this->config);

			mysqli_free_result($horarios); 
			mysqli_free_result($horarios_especiales); 
		}

		private function Display(){
			// Display open / closed message
			if($this->store_hours->is_open()) {
				$this->t .= '<div class="alert alert-person"><strong>ESTAMOS ATENDIENDO - ¡ABIERTO!</strong><br>' . $this->mensaje_abierto;
			} else {
				$this->t .= '<div class="alert alert-danger"><strong><font color="yellow">Sondemiga.com - CERRADO</font></strong><br>' . $this->mensaje_cerrado;
			}
		}

		public function returnDisplay(){
			$this->Display();

			return $this->t;
		}
                
                public function openYN(){
                    if($this->store_hours->is_open()) {
                        return 1;
                    } else {
                        return 0;
                    }
                }
	}
?>