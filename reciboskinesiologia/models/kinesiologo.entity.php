<?php
	class Kinesiologo
	{
		private $idKinesiologo;
		private $matricula;
		private $nombreKinesio;
		private $apellidoKinesio;
		private $periodo;
		private $activo;
		private $turno;
		
		public function __GET($k){ return $this->$k; }
		public function __SET($k, $v){ return $this->$k = $v; }
	}