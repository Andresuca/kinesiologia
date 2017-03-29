<?php
	class Paciente
	{
		private $idpaciente;
		private $nombrepaciente;
		private $domiciliopaciente;
		private $telefono;
		private $fecharegistro;
		
		public function __GET($k){ return $this->$k; }
		public function __SET($k, $v){ return $this->$k = $v; }
		
	}
