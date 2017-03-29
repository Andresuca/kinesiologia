<?php
	//header ('Content-type: text/html; charset=utf-8');
	include "models/dbconfig.php";
	//private $conn;
	/* ----------------------------------- */

	$database = new Database();
	$db = $database->dbConnection();
	//$this->conn = $db; 
	
	if(isset($_GET["idpac"]) || isset($_GET["idterap"]) || isset($_GET["act"])){
		switch($_GET["act"]){
			case "getPrc":
				$precioTotal = 0;
				$numTerapias = explode("|",$_GET["idterap"]);//determinamos cuantas terapias o servicios consumira, en base a eso, encerramos 
				
				for($inner=0;$inner<count($numTerapias);$inner++){
					$stmt = $db->prepare("CALL stored_getPrecio(:idtipopac,:tterapia)");
					$stmt->bindparam(':idtipopac',$_GET["idpac"]);
					$stmt->bindparam(':tterapia' ,$numTerapias[$inner]);
					$stmt->execute();
					foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $r){
						$precioTotal = $r["costo"]+$precioTotal;
					}
				}
				if($_GET["rec"]!=""){
					if($_GET["idpac"] == 3){
						$precioTotal = $precioTotal*2;
					}
					else{
						switch($_GET["rec"]){
							case 1:
								$precioTotal = $precioTotal+($precioTotal/2);
							break;
							case 2:
								$precioTotal = $precioTotal*2;
							break;
								
						}
					}
				}
				echo $precioTotal;
			break;
		}
	}
	else{
		echo "Imposible realizar acci&oacute;n";
	}
	//header ('Content-type: text/html; charset=utf-8');
	/*
	include "dataBase/conexion.php";
	$conexion = new createCon();
	$con = $conexion -> connect();
	if(isset($_GET["idpac"]) || isset($_GET["idterap"]) || isset($_GET["act"])){
		switch($_GET["act"]){
			case "getPrc":
				$precioTotal = 0;
				$numTerapias = explode("|",$_GET["idterap"]);//determinamos cuantas terapias o servicios consumira, en base a eso, encerramos 
				for($inner=0;$inner<count($numTerapias);$inner++){
					$qryGetPrecio = "CALL stored_getPrecio('".$_GET["idpac"]."','".$numTerapias[$inner]."') ";
					if ($con->multi_query($qryGetPrecio)) {
						do {
							if($resultado = $con->store_result()){
								while ($fila = $resultado->fetch_assoc()) {
									$precioTotal =$fila["costo"]+$precioTotal;
								}
								$resultado->free();
							}
						} while ($con->more_results() && $con->next_result());
						
					}
					else{
						echo $con->error;
					}
				}
				if($_GET["rec"]!=""){
					if($_GET["idpac"] == 3){
						$precioTotal = $precioTotal*2;
					}
					else{
						switch($_GET["rec"]){
							case 1:
								$precioTotal = $precioTotal+($precioTotal/2);
							break;
							case 2:
								$precioTotal = $precioTotal*2;
							break;
								
						}
					}
				}
				echo $precioTotal;
			break;
		}
	}
	else{
		echo "Imposible realizar acci&oacute;n";
	}
	*/
?>