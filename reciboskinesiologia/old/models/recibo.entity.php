<?php
	class Recibos
	{
		private $idRecibo;
		private $idpaciente;
		private $fecharegistro;
		private $domicilio;
		private $telefono;
		private $fecha_prox_sesion;
		private $hora_prox_sesion;
		private $idkinesiologo;
		private $no_visita;
		private $idTipopaciente;
		private $teriapias;
		private $costototal;
		
		
		public function __GET($k){ return $this->$k; }
		public function __SET($k, $v){ return $this->$k = $v; }
	}
