<?php
	require_once "models/dbconfig.php";
	require_once "models/kinesiologo.entity.php";
	require_once "models/kinesiologo.model.php";
	
	class catedraticoController{
		private $model;

		public function __CONSTRUCT(){
			$this->model = new CatedraticoModel();
		}
		public function Index(){
			require_once "views/top_headers.php";
			require_once "views/topBanner.php";
			require_once "views/portada.php";
			require_once "views/footer.php";
			
		}
		
		public function Crud(){
			$catedratico = new Catedratico();

			if(isset($_REQUEST['id'])){
				$catedratico = $this->model->Obtener($_REQUEST['id']);
			}
			
			require_once "views/top_headers.php";
			require_once "views/topBanner.php";
			require_once 'views/datospersonales.php';
			require_once 'views/footer.php';
		}

		public function Guardar(){
			$catedratico = new Catedratico();
			
			$catedratico->__SET('idregdocente',		trim($_REQUEST['txtidRegDocente']));
			$catedratico->__SET('iddocente',		trim($_REQUEST['nombreOferta']));
			$catedratico->__SET('nombre',			trim($_REQUEST['txtNombre']));
			$catedratico->__SET('apellido',			trim($_REQUEST['txtApellido']));
			$catedratico->__SET('direccion',		trim($_REQUEST['txtDireccion']));
			$catedratico->__SET('telefonocasa',		trim($_REQUEST['txtCasa']));
			$catedratico->__SET('telefonomovil',	trim($_REQUEST['txtMovil']));
			$catedratico->__SET('mail',				trim($_REQUEST['txtCorreoElectronico']));
			$catedratico->__SET('lugarnacimiento',	trim($_REQUEST['txtLugarNacimiento']));
			$catedratico->__SET('fechanacimiento',	trim($_REQUEST['txtFechaNacimiento']));
			$catedratico->__SET('perfil_linkedin',	trim($_REQUEST['txtLinkedIn']));
			$catedratico->__SET('perfil_facebook',	trim($_REQUEST['txtFacebook']));
			$catedratico->__SET('perfil_otro',		trim($_REQUEST['txtOtroPerfil']));
			$catedratico->__SET('imagen',			trim($_REQUEST['imagen']));
			// $catedratico->__SET('activo',			trim($_REQUEST['escuela']));
			
			if($oferta->__GET('idOfertaeducativa') != '' ? 
			   $this->model->Actualizar($oferta) : 
			   $this->model->Registrar($oferta));
			
			require_once "views/top_headers.php";
			require_once "views/topBanner.php";
			require_once 'views/datospersonales.php';
			require_once 'views/footer.php';
		}
	}