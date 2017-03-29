<?php
	require_once "models/dbconfig.php";
	require_once "models/kinesiologo.entity.php";
	require_once "models/kinesiologo.model.php";
	
	class kinesiologoController{
		private $model;

		public function __CONSTRUCT(){
			$this->model = new KinesiologoModel();
		}
		public function Index(){
			require_once "views/header.php";
			require_once "views/topnavbar.php";
			require_once 'views/kinesiologos.php';
			require_once 'views/footer.php';
			
		}
		
		public function Crud(){
			$kine = new Kinesiologo();

			if(isset($_REQUEST['id'])){
				$kine = $this->model->Obtener($_REQUEST['id']);
			}
			
			require_once "views/header.php";
			require_once "views/topnavbar.php";
			require_once 'views/kinesiologo.php';
			require_once 'views/footer.php';
		}

		public function Guardar(){
			$kine = new Kinesiologo();
			
			$periodo = "2017-2";

			$kine->__SET('idKinesiologo',	trim($_REQUEST['txtidkinesiologo']));
			$kine->__SET('matricula',		trim($_REQUEST['txtmatricula']));
			$kine->__SET('nombreKinesio',	trim($_REQUEST['txtnombreKinesio']));
			$kine->__SET('apellidoKinesio',	trim($_REQUEST['txtapellidoKinesio']));
			$kine->__SET('periodo',			$periodo);
			$kine->__SET('turno',			trim($_REQUEST['txtturno']));
			
			
			if($kine->__GET('idKinesiologo') != '' ? 
			   $this->model->Actualizar($kine) : 
			   $this->model->Guardar($kine));
			
			header("Location:kinesiologo.php");
		}
		public function Eliminar(){
			$this->model->Eliminar($_REQUEST["id"]);
			header("Location:kinesiologo.php");
		}
	}