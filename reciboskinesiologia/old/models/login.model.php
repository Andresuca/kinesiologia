<?php

	class usuariosModel
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
		
		public function Registrar(Usuarios $datos){
			try{
				$stmt = $this->conn->prepare("CALL stored_accionesUsuarios('' , :txtusername , :txtnombrecompleto, :txtpass, :txtperiodo , :txtrol, :txtaccion )");
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		public function Accesar($usr,$psw){
			try{
				$result = array();
				$usuario = new Usuarios();
				$stmt = $this->conn->prepare("CALL  stored_accionesUsuarios('',:txtusername,'',:txtpass,'',:txtaccion)");
				$accion = "login";
				$stmt->bindparam(":txtusername", 	$usr);
				$stmt->bindparam(":txtpass", 		$psw);
				$stmt->bindparam(":txtaccion", 		$accion);
				
				$stmt->execute();	

				
				if($stmt->rowCount() > 0){
					$r = $stmt->fetch(PDO::FETCH_OBJ);
					$usuario->__SET('idusuario'			,$r->idUsuario);
					$usuario->__SET('nombrecompleto'	,$r->nombrecompleto);
					$usuario->__SET('rol'				,$r->rol);
				}
				return $usuario;
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

	}
