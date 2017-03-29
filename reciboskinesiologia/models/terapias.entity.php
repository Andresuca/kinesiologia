<?php
	class Terapias
	{
		private $idterapia;
		private $nombreterapia;
		
		
		
		public function __GET($k){ return $this->$k; }
		public function __SET($k, $v){ return $this->$k = $v; }
	}
