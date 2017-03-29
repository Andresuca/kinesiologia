<?php
	class TipoPacientes
	{
		private $idTipoPaciente;
		private $tipoPaciente;
		
		
		
		public function __GET($k){ return $this->$k; }
		public function __SET($k, $v){ return $this->$k = $v; }
	}
