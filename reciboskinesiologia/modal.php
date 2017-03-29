<?php
	if(isset($_GET["id"])){
?>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="Evaluación docente de la Universidad Cuauhtémoc Plantel Aguascalientes">
		<meta name="author" content="Javier Amezcua|Desarrollo Web UCA">
		<title>U.C.A.|Kinesiología</title>
		<link rel="stylesheet" type="text/css" href="../coreFiles/cssStuff/css/styleDefOne.css">
		<link rel="stylesheet" type="text/css" href="../coreFiles/cssStuff/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../coreFiles/cssStuff/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../coreFiles/cssStuff/bootstrap/css/bootstrap-theme.css">
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
		<?php
			date_default_timezone_set('America/Mexico_City');
			include "dataBase/conexion.php";
			$conexion = new createCon();
			$con = $conexion -> connect();
			if(isset($_POST["btnUpdate"]) && $_POST["btnUpdate"]=="REGISTRAR E IMPRIMIR"){
				$qryFijarSigCita  = "CALL stored_updateNextDate('".$_POST["txtIdRecibo"]."','".date_format(date_create($_POST["txtProximaSesion"]),"Y-m-d")."','".$_POST["txtHora"]."')";
				if ($con->multi_query($qryFijarSigCita)) {
					//echo "<br>entro en el if";
					do {
						//echo "<br>entro en el do";
						if($resultado = $con->store_result()){
							$resultado->free();
						}
						else{
							//echo "entro en el else";
							//echo "<br/><h4>".count($resultado)."</h4>";
							echo '
								<script>
									alert("¡Recibo Registrado exitosamente!");
									window.open("recibopdf.php?id='.$_POST["txtIdRecibo"].'","","titlebars=0,toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=1,width=650,height=700");
									window.location.href = "modal.php";
								</script>
							';

						}
					} while ($con->more_results() && $con->next_result());
				}
				else{
					echo $con->error;
				}
			}
		?>
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
	</head>
	<body>
		<form action="" method="post">
			<table class="datosGenerales">
				<tr>
					<td style="width:50%;">
						<label for="txtCarrera">PROX. SESI&Oacute;N:</label>
						<div class="form-group">
							<div class='input-group date' id='datetimepicker1'>
								<input type='text'id="txtProximaSesion" name="txtProximaSesion" class="form-control" required/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker1').datetimepicker({
									locale: 'es',
									format: 'DD-MM-YYYY'
								});
							});
						</script>
					</td>
					<td style="width:50%;">
						<label for="txtCarrera">HORA:</label>
						<div class="form-group">
							<div class='input-group date' id='datetimepicker2'>
								<input type='text' id="txtHora" name="txtHora" class="form-control" required/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
						</div>
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker2').datetimepicker({
									locale: 'es',
									format: 'LT'
								});
							});
						</script>
					</td>
					<tr>
						<td>
							<input type="hidden" id="txtIdRecibo" name="txtIdRecibo" value="<?php echo $_GET["id"]; ?>">
						</td>
					</tr>
				</tr>
				<tr>
					<td style="width:50%;" colspan="2">
						<input type="submit" value="REGISTRAR E IMPRIMIR" id="btnUpdate" name="btnUpdate" class="btn btn-success">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php
	}
	else{
		
	}
?>