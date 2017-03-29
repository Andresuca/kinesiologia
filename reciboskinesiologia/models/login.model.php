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
		
		public function ListarUsers(){
			try{
				$result = array();
				$stmt =  $this->conn->prepare("SELECT idUsuario,username,nombrecompleto,rol FROM tc_usuarios WHERE activo = 1");
				$stmt->execute();
				$usr =  new Usuarios();
				foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $r){
					$usr->__SET('idusuario'			,$r->idUsuario);
					$usr->__SET('username'			,$r->username);
					$usr->__SET('nombrecompleto'	,$r->nombrecompleto);
					$usr->__SET('rol'				,$r->rol);
				}
				$result[] = $usr;
				return $result;
				

			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		/* ------------------------------------------------ */
		public function Obtener($idusuario){
			try{
				
				// mandamos llamar un SP para listar kinesiologos vigentes por periodo
				$stm = $this->conn->prepare("SELECT idUsuario,username,nombrecompleto,rol,AES_DECRYPT(pass,'UCUAUHTE-2017') AS 'pass' FROM tc_usuarios WHERE idUsuario = :idusuario");
				
				$stm->bindparam(":idusuario",$idusuario);
				$stm->execute();

				$r = $stm->fetch(PDO::FETCH_OBJ);
				
				$usr = new Usuarios();

				$usr->__SET('idusuario'			,$r->idUsuario);
				$usr->__SET('username'			,$r->username);
				$usr->__SET('nombrecompleto'	,$r->nombrecompleto);
				$usr->__SET('rol'				,$r->rol);
				$usr->__SET('pass'				,$r->pass);
				
				return $usr;
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
