<?php
	if(isset($_POST["paciente"]) || isset($_POST["terapia"])){
		include "dataBase/conexion.php";
		$conexion = new createCon();
		$con = $conexion -> connect();
		$queryFill2= "CALL stored_getTiposDe(2)";
		if ($con->multi_query($queryFill)) {
			echo "No. Visita:<input type='text' id='txtVisita' name='txtVisita' maxlength='6'><br/>";
			do {
				if($resultado = $con->store_result()){
					while ($fila = $resultado->fetch_assoc()) {
						echo "<input type='radio' id='rbt_paciente' name='rbt_paciente' value='".$fila["id"]."' required/>";
						echo $fila["tipo"]."<br/>";
					}
					$resultado->free();
				}
			} while ($con->more_results() && $con->next_result());
		}
		else{
			echo $con->error;
		}
	}
	else{
		header("Location:index.php");
	}
?>