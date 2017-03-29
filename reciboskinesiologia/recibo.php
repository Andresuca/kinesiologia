<?php
	//Session Start
	/*session_start();
	
	if(!isset($_SESSION["username"])){
		include "login.php";
		die();
	}
	require_once 'controllers/login.controller.php';*/
	require_once 'controllers/recibo.controller.php';
	// Ruta del proyecto, cambiala por la ruta que vas a usar
	define( 'RUTA_HTTP', 'http://' . $_SERVER['HTTP_HOST'] . '/reciboskinesiologia/' );

	// Todo esta lógica hara el papel de un FrontController
	if(!isset($_REQUEST['c'])){
		
		$controller = new reciboController();
		$controller->Index();    
	} else {
		/* ---------------------------------------------------------------------------
		en la URL cargamos en el parametro $_REQUEST['c'] que control vamos a usar
		asi como tambien podemos mandar el parámetro $_REQUEST["a"] para determinar 
		que accion se ejecutará
		--------------------------------------------------------------------------- */
		// Obtenemos el controlador que queremos cargar
		$controller = $_REQUEST['c'] . 'Controller';
		$accion     = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';


		// Instanciamos el controlador
		$controller = new $controller();

		// Llama la accion
		call_user_func( array( $controller, $accion ) );
	}