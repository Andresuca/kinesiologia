<?php

	class TerapiasModel
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

		public function LlenaTerapias($categoria){
			try{
				$stmt = $this->conn->prepare("CALL stored_getTiposDe(:categoria)");
				$stmt->bindparam(":categoria",$categoria);
				$stmt->execute();
				foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $r){
					//creamos un obj de tipo Kinesiologo para listar todas sus propiedades.
					$ter = new Terapias();

					$ter->__SET('idterapia'			, $r->id);
					$ter->__SET('nombreterapia'		, $r->tipo);
					
					$result[] = $ter;
				}

				return $result;
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}

		}
	}