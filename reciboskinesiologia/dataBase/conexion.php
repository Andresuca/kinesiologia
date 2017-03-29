<?php
	class createCon  {
		var $host = 'localhost';
		var $user = 'root';
		var $pass = 'juanawais1101';
		var $db = 'ucuauhte_reciboskine';
		var $miConecion;
		function connect() {
			$Conecion = new mysqli($this->host, $this->user, $this->pass, $this->db);
			/* comprobar la conexión */
			if ($Conecion->connect_errno) {
				printf("Falló la conexión: %s\n", $Conecion->connect_error);
				exit();
			}
			else{
				$this->miConecion = $Conecion;
				return $this->miConecion;
			}
		}
	}
?>