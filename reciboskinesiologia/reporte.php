<!DOCTYPE html>
<html>
	<head>
		<!-- <meta charset="utf-8"> -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="Evaluación docente de la Universidad Cuauhtémoc Plantel Aguascalientes">
		<meta name="author" content="Javier Amezcua|Desarrollo Web UCA">
		<title>U.C.A.|Kinesiolog&iacute;a</title>
		<link rel="stylesheet" type="text/css" href="../coreFiles/cssStuff/css/styleDefOne.css">
		<link rel="stylesheet" type="text/css" href="../coreFiles/cssStuff/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../coreFiles/cssStuff/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../coreFiles/cssStuff/bootstrap/css/bootstrap-theme.css">
		<link rel="stylesheet" type="text/css" href="../coreFiles/cssStuff/fontAwesome/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.css">
		<style>
			.datosGenerales{
				width: 100%;
				margin-bottom: 5px;
			}
			.datosGenerales tr{
				border-bottom: 1px solid #1F5A74;
			}
			.datosGenerales td{
				color: #1F5A74;
				padding: 5px 10px;
				text-align: left;
			}
		</style>
		<script src="//code.jquery.com/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="http://momentjs.com/downloads/moment.js"></script>
		<script src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
		<script src="../coreFiles/jsStuff/validMotorEngine/lib/jquery.js"></script>
		<script src="../coreFiles/jsStuff/validMotorEngine/dist/jquery.validate.js"></script>
		<script src="../coreFiles/jsStuff/validMotorEngine/dist/additional-methods.min.js"></script>
		<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
		<script type="text/javascript" src="../coreFiles/jsStuff/fancyBox/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../coreFiles/jsStuff/fancyBox/jquery.fancybox.css?v=2.1.5" media="screen" />
		<script type="text/javascript" src="bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js"></script>
		<?php
			date_default_timezone_set('America/Mexico_City');
			//header ('Content-type: text/html; charset=utf-8');
			include "dataBase/conexion.php";
			$conexion = new createCon();
			$con = $conexion -> connect();
			$listaTerapias = array();
			$qryGetTerapias = "CALL stored_getTiposDe(2)";
			//echo $qryInsertRecibo."<br/>";
			//echo date_format(date_create($_POST["txtFecha"]),"m-d-Y");

			if ($con->multi_query($qryGetTerapias)) {
				//echo "<br>entro en el if";
				do {
					//echo "<br>entro en el do";
					if($resultado = $con->store_result()){
						while($fila = mysqli_fetch_assoc($resultado)){
							$listaTerapias[$fila["id"]] = $fila["tipo"];
						}
						$resultado->free();
					}
					else{}
				} while ($con->more_results() && $con->next_result());
			}
			else{
				echo $con->error;
			}
		?>
		<style>
			.desplegadoKine{
				margin: 0 auto;
			}
			.desplegadoKine tr{
				border-bottom: #106eb8 solid 2px;
			}
			.desplegadoKine tr:nth-child(even) {background: #9a9f9f}
			.desplegadoKine tr:nth-child(odd) {background: #FFF}
			.desplegadoKine th{
				padding: 10px 15px;
				color: beige;
				background: #041f34;
			}
			.desplegadoKine td{
				padding: 10px 15px;
				color: 151623;
			}
		</style>
	</head>
	<body class="forMainGreenBody">
		<form id="frm1" name="frm1" method="POST"action="" >
			<div class="container shadow1" style="background:#fefefe; margin-top:0; padding: 15px 20px;">
				<!-- ******** encabezado de la pág. ********* -->
				<div class="row toDaCenter" style="margin-left: 0;">
					<div class="col-md-12">
    					<img src="http://www.ucuauhtemoc.edu.mx/site/styleUCA/logosInstitucionales/univ_cuauhtemoc_plantel_ags.png" width="80%">
					</div>
				</div>
				<hr style="border: 3px solid #013668;">
				<!-- ***************************************** -->
				<h1 class="toDaCenter"><span class="glyphicon glyphicon-th-list"></span>|RECIBOS KINESIOLOG&Iacute;A </h1>
				<hr style="border:none; padding-bottom:15px; ">
				<div class="customJJADwrapp ">
					<div class="row " style="min-height:500px;">
						<?php
							//var_dump($listaTerapias);
						?>
						<table style="border: #106eb8 solid 2px" class="desplegadoKine">
							<tr>
								<th>NO. RECIBO</th>
								<th>FECHA REGISTRO</th>
								<th>FOLIO</th>
								<th>NOMBRE PACIENTE</th>
								<th>ATENDI&Oacute;</th>
								<th>NO. VISITA</th>
								<th>COSTO TOTAL</th>
								<th>OBSERVACIONES</th>
							</tr>
							<?php
								$qryGetTerapias = "CALL stored_getWeekReport()";
								if ($con->multi_query($qryGetTerapias)) {
									//echo "<br>entro en el if";
									do {
										//echo "<br>entro en el do";
										if($resultado = $con->store_result()){
											while($fila = mysqli_fetch_assoc($resultado)){
												echo "<tr>";
												echo "<td>".$fila["idRecibo"]."</td>";
												echo "<td>".$fila["fecharegistro"]."</td>";
												echo "<td>".($fila["idRecibo"]+58285)."</td>";
												echo "<td>".$fila["nombrePaciente"]."</td>";
												echo "<td>".$fila["alumno"]."</td>";
												echo "<td>".$fila["no_visita"]."</td>";
												echo "<td>".$fila["costototal"]."</td>";
												$tmpTerapiaRaw = explode("|",$fila["terapias"]);
												$tmpTerapiasNombre = "";
												for($inn=0;$inn<count($tmpTerapiaRaw);$inn++){
													$tmpKey = $tmpTerapiaRaw[$inn];
													$tmpTerapiasNombre.= $listaTerapias[$tmpKey].",";
												}
												echo "<td>".
														$fila["tipoPaciente"]
													.", ".
														$tmpTerapiasNombre
													."</td>";
												echo "</tr>";
												$tmpTerapiaRaw="";
											}
											$resultado->free();
										}
										else{}
									} while ($con->more_results() && $con->next_result());
								}
								else{
									echo $con->error;
								}
							?>
						</table>
					</div>
				</div>
			</div>
			<!-- pie de página -->
			<?php
				include "../footer.php";
			?>
		</form>
	</body>
</html>