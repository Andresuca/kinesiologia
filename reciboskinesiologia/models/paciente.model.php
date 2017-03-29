<?php

	class PacienteModel
	{
		private $conn;

		public function __CONSTRUCT()
		{
			try
			{
				$database = new Database();
				$db = $database->dbConnection();
				$this->conn = $db;       
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
		/* -------------------------------------------------- */
		public function ListarPacientes(){
			try{
				$result = array();
				// mandamos llamar un SP para listar recibos del día
				$qryInsertRecibo = "SELECT  FROM tc_pacientes WHERE";
				$stm = $this->conn->prepare($qrygetRecibos);
				$stm->execute();

				foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
					//creamos un obj de tipo Kinesiologo para listar todas sus propiedades.
					$paciente = new Paciente();

					$paciente->__SET('idRecibo'			, $r->idRecibo);
					$paciente->__SET('idpaciente'		, $r->nombrePaciente);
					$paciente->__SET('fecharegistro'	, $r->fecharegistro);
					$paciente->__SET('domicilio'		, $r->domicilio);
					$paciente->__SET('telefono'			, $r->telefono);
					$paciente->__SET('fecha_prox_sesion', $r->fecha_prox_sesion);
					$paciente->__SET('hora_prox_sesion'	, $r->hora_prox_sesion);
					$paciente->__SET('idkinesiologo'	, $r->idkinesiologo);
					$paciente->__SET('no_visita'		, $r->no_visita);
					$paciente->__SET('idTipopaciente'	, $r->idTipopaciente);
					$paciente->__SET('teriapias'		, $r->teriapias);
					$paciente->__SET('costototal'		, $r->costototal);
					
					$result[] = $paciente;
				}

				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
	}