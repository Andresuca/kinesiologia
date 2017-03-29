<?php
	class Kinesiologo
	{
		private $idkinesiologo;
		private $matricula;
		private $nombreKinesio;
		private $apellidoKinesio;
		private $periodo;
		private $activo;
		
		public function __GET($k){ return $this->$k; }
		public function __SET($k, $v){ return $this->$k = $v; }
	}