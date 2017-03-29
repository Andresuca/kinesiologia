<?php

	class TipoPacientesModel
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

		public function LlenaTipoPacientes($categoria){
			try{
				$stmt = $this->conn->prepare("CALL stored_getTiposDe(:categoria)");
				$stmt->bindparam(":categoria",$categoria);
				$stmt->execute();
				foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $r){
					//creamos un obj de tipo Kinesiologo para listar todas sus propiedades.
					$ter = new TipoPacientes();

					$ter->__SET('idTipoPaciente'	, $r->id);
					$ter->__SET('tipoPaciente'		, $r->tipo);
					
					$result[] = $ter;
				}

				return $result;
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}

		}
	}