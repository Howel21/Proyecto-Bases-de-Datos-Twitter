<?php  
	class conexion{
		private $host = "localhost/XE";
		private $user = "twitter";
		private $pass = "twitter";

		function conectar(){
			$conn = oci_connect($this->user, $this->pass, $this->host);
			if (!$conn) {
				$e = oci_error();   // Para errores de oci_connect errors, no pase un gestor
				trigger_error(htmlentities($e['message']), E_USER_ERROR);
			}	
			return $conn;
		}

		function consultar($con, $query){
			$st = oci_parse($con, $query);
			oci_execute($st);
			return $st;
		}

		function actualizar($con, $query){
			$st = oci_parse($con, $query);
			oci_execute($st);
		}

		function guardar($con, $query){
			$st = oci_parse($con, $query);
			oci_execute($st);
		}

		function eliminar($con, $query){
			$st = oci_parse($con, $query);
			oci_execute($st);
		}

	}
?>