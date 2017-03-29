<?php
	include "dataBase/conexion.php";
	$conexion = new createCon();
	$con = $conexion -> connect();
	$nombre = $_GET["name"];
	$qryGetNombre = "SELECT FROM WHERE";
?>