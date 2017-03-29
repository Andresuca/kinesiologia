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
				$stmt =$this->conn->prepare("CALL stored_insRecibo(
										':txtNombrePaciente'
										,':txtFechaRegistro'
										,':txtDomicilio'
										,':txtTelefono'
										,':txtFechaProxSesion'
										,':txtHoraProxSesion'
										,':txtNoVista'
										,':txtIdTipoPaciente'
										,':txtTerapias'
										,':txtCostototal'
										,':txtAlumno'
									)");
				$stmt->bindparam(":txtNombrePaciente",	$datos->__GET('txtmatricula'));
				$stmt->bindparam(":txtFechaRegistro",	$datos->__GET('txtnombreKinesio'));
				$stmt->bindparam(":txtDomicilio",		$datos->__GET('txtapellidoKinesio'));
				$stmt->bindparam(":txtTelefono",		$datos->__GET('txtperiodo'));
				$stmt->bindparam(":txtFechaProxSesion",	$datos->__GET('txtmatricula'));
				$stmt->bindparam(":txtNoVista",			$datos->__GET('txtnombreKinesio'));
				$stmt->bindparam(":txtIdTipoPaciente",	$datos->__GET('txtIdTipoPaciente'));
				$stmt->bindparam(":txtTerapias",		$datos->__GET('txtmatricula'));
				$stmt->bindparam(":txtCostototal",		$datos->__GET('txtnombreKinesio'));
				$stmt->bindparam(":txtAlumno",			$datos->__GET('txtIdTipoPaciente'));
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		public function LlenaCategorias($categoria){
			
			$stmt = $this->conn->prepare("CALL stored_getTiposDe(:categoria)");
			$stmt->bindparam(":categoria",$categoria);
			
		}
			
	}