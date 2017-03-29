<?php

	require_once "models/dbconfig.php";
	require_once "models/login.entity.php";
	require_once "models/login.model.php";


	class usuarioController{
		private $model;

		public function __CONSTRUCT(){
			$this->model = new usuariosModel();
		}
		public function Login(){
			require_once "views/header.php";
			//require_once "views/topnavbar.php";
			require_once "views/login.php";
			require_once "views/footer.php";
			
		}
		public function ListarUsuarios(){
			require_once "views/header.php";
			require_once "views/topnavbar.php";
			require_once "views/listadousuarios.php";
			require_once "views/footer.php";
		}
		public function Crud(){
			$usr = new Usuarios();

			if(isset($_REQUEST['id'])){
				$usuario = $this->model->Obtener($_REQUEST['id']);
			}
			
			require_once "views/header.php";
			require_once "views/topnavbar.php";
			require_once 'views/usuario.php';
			require_once 'views/footer.php';
		}

		public function Guardar(){
			$usuario = new Usuario();
			
			
			$usuario->__SET('idusuario',	trim($_REQUEST['txtidusuario']));
			$usuario->__SET('username',		trim($_REQUEST['txtusername']));
			$usuario->__SET('nombreusuario',trim($_REQUEST['txtnombreusuario']));
			$usuario->__SET('pass',			trim($_REQUEST['txtpass']));
			$usuario->__SET('rol',			trim($_REQUEST['txtrol']));
			
			// $catedratico->__SET('activo',			trim($_REQUEST['escuela']));
			
			if($usuario->__GET('idOfertaeducativa') != '' ? 
			   $this->model->Actualizar($usuario) : 
			   $this->model->Registrar($usuario));
			
			require_once "views/header.php";
			require_once "views/topnavbar.php";
			require_once 'views/listadousuarios.php';
			require_once 'views/footer.php';
		}
		public function Accesar(){
			require_once "views/header.php";
			if(($_REQUEST["txtusuario"] == "") && ($_REQUEST["txtpass"]== "")){
				require_once "views/login.php";
			}
			else{
				require_once "views/header.php";
				
				$resultado = new Usuarios();
				$usr = trim($_REQUEST["txtusuario"]);
				$psw = trim($_REQUEST["txtpass"]);
				$resultado = $this->model->Accesar($usr,$psw);

				//var_dump($resultado);
				if($resultado->__GET("idusuario")!=""){
					require_once "views/topnavbar.php";
					session_start();
					$_SESSION["username"]		= $resultado->__GET("idusuario");
					$_SESSION["nombreusuario"]	= $resultado->__GET("nombrecompleto");
					$_SESSION["rol"]			= $resultado->__GET("rol");
					header("Location:inicio.php");
				}
				else{
					// cuando no hay registro
					echo '<div class="container shadow1" style="background:#fefefe; margin-top:0; padding: 15px 20px;">
							<!-- ******** encabezado de la pág. ********* -->
							<div class="row toDaCenter" style="margin-left: 0;">
								<div class="col-md-12">
			    					<img src="http://www.ucuauhtemoc.edu.mx/site/styleUCA/logosInstitucionales/univ_cuauhtemoc_plantel_ags.png" width="80%">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<hr style="border: 3px solid #013668;">
									<!-- ***************************************** -->
									<h1 class="toDaCenter"><span class="glyphicon glyphicon-list-alt"></span>|CITAS KINESIOLOG&Iacute;A </h1>
								</div>
							</div>';
					echo "<div class='row' style='min-height:600px;''>
							<h2>USUARIO NO ENCONTRADO HAGA CLIC <a href='login.php'>AQU&Iacute;</a> PARA CONTINUAR</h2>
						</div>
					</div>";
				}
			}
			require_once "views/footer.php";
		}
	}