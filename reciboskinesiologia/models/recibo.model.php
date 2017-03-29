<?php

	class RecibosModel
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
		public function ListarHoy(){
			try{
				$result = array();
				// mandamos llamar un SP para listar recibos del día
				$qryInsertRecibo = "CALL stored_getRecibosDeDia('".date("Y-m-d")."')";
				$stm = $this->conn->prepare($qrygetRecibos);
				$stm->execute();

				foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
					//creamos un obj de tipo Kinesiologo para listar todas sus propiedades.
					$recibo = new Recibos();

					$recibo->__SET('idRecibo'			, $r->idRecibo);
					$recibo->__SET('idpaciente'			, $r->nombrePaciente);
					$recibo->__SET('fecharegistro'		, $r->fecharegistro);
					$recibo->__SET('domicilio'			, $r->domicilio);
					$recibo->__SET('telefono'			, $r->telefono);
					$recibo->__SET('fecha_prox_sesion'	, $r->fecha_prox_sesion);
					$recibo->__SET('hora_prox_sesion'	, $r->hora_prox_sesion);
					$recibo->__SET('idkinesiologo'		, $r->idkinesiologo);
					$recibo->__SET('no_visita'			, $r->no_visita);
					$recibo->__SET('idTipopaciente'		, $r->idTipopaciente);
					$recibo->__SET('teriapias'			, $r->teriapias);
					$recibo->__SET('costototal'			, $r->costototal);
					
					$result[] = $recibo;
				}

				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
		/* -------------------------------------------------- */
		public function ProximaCita(Recibo $datos){
			try{
				$stmt = $this->conn->prepare("CALL 	stored_updateNextDate(
						  :txtidRecibo
						, :txtnombreKinesio
						, :txtapellidoKinesio
						)");
				$stmt->bindparam(":txtidRecibo"			,$datos->__GET('txtidRecibo'));
				$stmt->bindparam(":txtFechaProxSesion"	,$datos->__GET('txtFechaProxSesion'));
				$stmt->bindparam(":txtHoraProxSesion"	,$datos->__GET('txtHoraProxSesion'));
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		/* -------------------------------------------------- */
		public function Registrar(Recibo $datos){
			try{
				date_default_timezone_set('America/Mexico_City');
				$stmt =$this->conn->prepare("CALL stored_insRecibo(:txtidpaciente,:txtFechaRegistro,:txtDomicilio,:txtTelefono,:txtFechaProxSesion,:txtHoraProxSesion,:txtNoVista,:txtIdTipoPaciente,:txtTerapias,:txtCostototal,:txtAlumno)");
				/* ************************************************* */
				//$stmt->bindparam('idRecibo',			$datos->__GET('idRecibo'));
				$stmt->bindparam(':txtidpaciente',			$datos->__GET('idpaciente'));
				$stmt->bindparam(':txtFechaRegistro',		$datos->__GET('fecharegistro'));
				$stmt->bindparam(':txtDomicilio',			$datos->__GET('domicilio'));
				$stmt->bindparam('txtTelefono',				$datos->__GET('telefono'));
				$stmt->bindparam(':txtFechaProxSesion',		$datos->__GET('fecha_prox_sesion'));
				$stmt->bindparam(':txtHoraProxSesion',		$datos->__GET('hora_prox_sesion'));
				$stmt->bindparam(':txtAlumno',				$datos->__GET('idkinesiologo'));
				$stmt->bindparam(':txtNoVista',				$datos->__GET('no_visita'));
				$stmt->bindparam(':txtIdTipoPaciente',		$datos->__GET('idTipopaciente'));
				$stmt->bindparam(':txtTerapias',			$datos->__GET('teriapias'));
				$stmt->bindparam(':txtCostototal',			$datos->__GET('costototal'));
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
			
	}