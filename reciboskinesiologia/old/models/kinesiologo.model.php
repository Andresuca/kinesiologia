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
					$kine->__SET('periodo', 		$r->periodo);

					$result[] = $kine;
				}

				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}

		public function Guardar(Kinesiologo $datos){
			try{
				$stm = $this->conn->prepare("CALL stored_accionesKiensiologos(
						''
						, :txtmatricula
						, :txtnombreKinesio
						, :txtapellidoKinesio
						, :txtperiodo
						,  1
						, 'ingresar')");
				$stmt->bindparam(":txtmatricula",		$datos->__GET('txtmatricula'));
				$stmt->bindparam(":txtnombreKinesio",	$datos->__GET('txtnombreKinesio'));
				$stmt->bindparam(":txtapellidoKinesio",	$datos->__GET('txtapellidoKinesio'));
				$stmt->bindparam(":txtperiodo",			$datos->__GET('txtperiodo'));
				$stmt->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
	}