<?php
	require_once "models/dbconfig.php";
	/* ---------------------------------- */
	require_once "models/recibo.entity.php";
	require_once "models/recibo.model.php";
	/* ---------------------------------- */
	require_once "models/terapias.entity.php";
	require_once "models/terapias.model.php";
	/* ---------------------------------- */
	require_once "models/tipopaciente.entity.php";
	require_once "models/tipopaciente.model.php";

	class reciboController{
		private $modelR;
		private $modelTP;
		private $modelT;

		public function __CONSTRUCT(){
			$this->modelR = new RecibosModel();
			$this->modelTP = new TipoPacientesModel();
			$this->modelT = new TerapiasModel();
		}
		public function Index(){
			require_once "views/header.php";
			require_once "views/topnavbar.php";
			require_once "views/recibos.php";
			require_once "views/footer.php";
			
		}
		
		public function Crud(){
			$usuario = new Recibos();

			if(isset($_REQUEST['id'])){
				$usuario = $this->model->Obtener($_REQUEST['id']);
			} 
			
			require_once "views/header.php";
			require_once "views/topnavbar.php";
			require_once 'views/datospersonales.php';
			require_once 'views/footer.php';
		}

		public function Guardar(){
			$recibo = new Recibos();
			/*
			private $idRecibo;
			private $idpaciente;
			private $fecharegistro;
			private $domicilio;
			private $telefono;
			private $fecha_prox_sesion;
			private $hora_prox_sesion;
			private $idkinesiologo;
			private $no_visita;
			private $idTipopaciente;
			private $teriapias;
			private $costototal;

			*/
			
			foreach($_REQUEST["chk_terapia"] as $elemento){
				$terapiacPaciente.= $elemento."|";
			}
			if(isset($_REQUEST["rbtRecargos"]) && ($_REQUEST["rbtRecargos"] != "")){
				
			}
			else{
				$_REQUEST["rbtRecargos"] = 0;
			}
			if(isset($_POST["txtNoRecibos"]) && ($_REQUEST["txtNoRecibos"] != "")){
				
			}
			else{
				$_REQUEST["txtNoRecibos"] = 1;
			}
			$terapiacPaciente = substr($terapiacPaciente, 0, -1); //eliminamos el último | de la cadena
			//$recibo->__SET('idRecibo',			trim($_REQUEST['']));
			$recibo->__SET('idpaciente',		trim($_REQUEST['txtNombre']));
			$recibo->__SET('fecharegistro',		trim($_REQUEST['txtFecha']));
			$recibo->__SET('domicilio',			trim($_REQUEST['txtDomicilio']));
			$recibo->__SET('telefono',			trim($_REQUEST['txtTelefono']));
			$recibo->__SET('fecha_prox_sesion',	trim($_REQUEST['txtProximaSesion']));
			$recibo->__SET('hora_prox_sesion',	trim($_REQUEST['txtHora']));
			$recibo->__SET('idkinesiologo',		trim($_REQUEST['txtKinesiologo']));
			$recibo->__SET('no_visita',			trim($_REQUEST['txtVisita']));
			$recibo->__SET('idTipopaciente',	trim($_REQUEST['rbt_paciente']));
			$recibo->__SET('teriapias',			trim($terapiacPaciente));
			$recibo->__SET('costototal',		trim($_REQUEST['txtCosto']));
			
			/* ************************************************* */
			// $catedratico->__SET('activo',	trim($_REQUEST['escuela']));
			 
			$this->model->Guardar($usuario);
			
			require_once "views/header.php";
			require_once "views/topnavbar.php";
			require_once 'views/datospersonales.php';
			require_once 'views/footer.php';
		}
		
	}