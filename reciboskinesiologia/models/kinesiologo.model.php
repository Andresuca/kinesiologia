<?php

	class KinesiologoModel
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
		
		public function Listar(){
			try{
				$result = array();
				// mandamos llamar un SP para listar kinesiologos vigentes por periodo
				$stm = $this->conn->prepare("CALL stored_listadoKinesiologos( '' ,'' ,'actuales') ");
				$stm->execute();

				foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
					//creamos un obj de tipo Kinesiologo para listar todas sus propiedades.
					$kine = new Kinesiologo();

					$kine->__SET('idKinesiologo', 	$r->idKinesiologo);
					$kine->__SET('matricula', 		$r->matricula);
					$kine->__SET('nombreKinesio', 	$r->nombreKinesio);
					$kine->__SET('apellidoKinesio', $r->apellidoKinesio);
					//$kine->__SET('periodo', 		$r->periodo);
					$kine->__SET('turno',			$r->turno);

					$result[] = $kine;
				}

				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
		/* ------------------------------------------------ */
		public function Obtener($idKinesiologo){
			try{
				
				// mandamos llamar un SP para listar kinesiologos vigentes por periodo
				$stm = $this->conn->prepare("CALL stored_listadoKinesiologos( :idkinesiologo ,'' ,'especifico') ");
				
				$stm->bindparam(":idkinesiologo",		$idKinesiologo);
				$stm->execute();

				$r = $stm->fetch(PDO::FETCH_OBJ);
				//creamos un obj de tipo Kinesiologo para listar todas sus propiedades.
				$kine = new Kinesiologo();

				$kine->__SET('idKinesiologo', 	$r->idKinesiologo);
				$kine->__SET('matricula', 		$r->matricula);
				$kine->__SET('nombreKinesio', 	$r->nombreKinesio);
				$kine->__SET('apellidoKinesio', $r->apellidoKinesio);
				$kine->__SET('turno',			$r->turno);

				

				return $kine;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
		/* ------------------------------------------------ */
		public function Guardar(Kinesiologo $datos){
			try{
				$stmt = $this->conn->prepare("CALL stored_accionesKiensiologos(:txtidkinesiologo, :txtmatricula, :txtnombreKinesio, :txtapellidoKinesio, :txtperiodo,1, :txtturno, 'ingresar')");
				$stmt->bindparam(":txtidkinesiologo",	$datos->__GET('idKinesiologo'));
				$stmt->bindparam(":txtmatricula",		$datos->__GET('matricula'));
				$stmt->bindparam(":txtnombreKinesio",	$datos->__GET('nombreKinesio'));
				$stmt->bindparam(":txtapellidoKinesio",	$datos->__GET('apellidoKinesio'));
				$stmt->bindparam(":txtperiodo",			$datos->__GET('periodo'));
				$stmt->bindparam(":txtturno",			$datos->__GET('turno'));
				
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		public function Actualizar(Kinesiologo $datos){
			try{
				$stmt = $this->conn->prepare("CALL stored_accionesKiensiologos(:txtidkinesiologo, :txtmatricula, :txtnombreKinesio, :txtapellidoKinesio, :txtperiodo,1, :txtturno, 'actualizar')");
				$stmt->bindparam(":txtidkinesiologo",	$datos->__GET('idKinesiologo'));
				$stmt->bindparam(":txtmatricula",		$datos->__GET('matricula'));
				$stmt->bindparam(":txtnombreKinesio",	$datos->__GET('nombreKinesio'));
				$stmt->bindparam(":txtapellidoKinesio",	$datos->__GET('apellidoKinesio'));
				$stmt->bindparam(":txtperiodo",			$datos->__GET('periodo'));
				$stmt->bindparam(":txtturno",			$datos->__GET('turno'));
				
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		public function Eliminar($idKinesiologo){
			try{
				$stmt = $this->conn->prepare("CALL stored_accionesKiensiologos(:txtidkinesiologo,'','','','' ,0,'', 'baja')");
				$stmt->bindparam(":txtidkinesiologo",	$idKinesiologo);
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}