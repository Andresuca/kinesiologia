<?php
	class Usuarios
	{
		private $idusuario;
		private $username;
		private $nombrecompleto;
		private $pass;
		private $rol;
		
		public function __GET($k){ return $this->$k; }
		public function __SET($k, $v){ return $this->$k = $v; }
	}
