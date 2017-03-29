<?php
	class CitaMedica
	{
		private $idcitamedica;
		private $idpaciente;
		private $iddia;
		private $hora;
		private $idKinesiologo;
		private $valoracion;
		
		public function __GET($k){ return $this->$k; }
		public function __SET($k, $v){ return $this->$k = $v; }
		
	}