<html>
	<head>
		<title>UCA|Recibos Kinesiologia</title>
		<style>
			*{
				font-family: sans-serif;
				font-size: 14px;
				letter-spacing: 1px;
				
			}
		</style>
	</head>
	<body>
		<?php
			date_default_timezone_set('America/Mexico_City');
			$_qryGetData = ""; 
			if(!isset($_GET["id"])){
				$_GET["id"] = 0;
			}
			if($_GET["id"]==0){
					$_qryGetData = "SELECT
										nombrePaciente
										,fechaRegistro
										,domicilio
										,telefono
										,fecha_prox_sesion
										,hora_prox_sesion
										,alumno
										,no_visita
										,idTipoPaciente
										,terapias
										,costototal
									FROM tr_recibos
									ORDER BY idRecibo DESC LIMIT 0, 1
								";
			}
			else{
				$_qryGetData = "SELECT
										nombrePaciente
										,fechaRegistro
										,domicilio
										,telefono
										,fecha_prox_sesion
										,hora_prox_sesion
										,alumno
										,no_visita
										,idTipoPaciente
										,terapias
										,costototal
									FROM tr_recibos
									WHERE idRecibo = '".$_GET["id"]."'
								";
			}
			//require("../coreFiles/fpdflib/fpdf.php");
			include "dataBase/conexion.php";
			$conexion = new createCon();
			$con = $conexion -> connect();
			$rsDatosRecibo = mysqli_query($con,$_qryGetData) or die(mysqli_error($con));
			$filas = mysqli_fetch_assoc($rsDatosRecibo);
			//var_dump($filas);
			$terapias = explode("|",$filas["terapias"]);
			$baropodometria = 0;
			$puncionSeca = 0;
			$mep =0;
			$nutricion = 0;
			$valoracion = 0;
			$terapia = 0;
			for($innerF=0;$innerF<count($terapias);$innerF++){
				switch($terapias[$innerF]){
					case 1:
						$baropodometria = 1;
					break;
					case 2:
						$puncionSeca = 1;
					break;
					case 3:
						$mep = 1;
					break;
					case 4:
						$nutricion = 1;
					break;
					case 5:
						$valoracion = 1;
					break;
					case 6:
						$terapia = 1;
					break;	
				}
			}
			//$pdf->Image('images/formatopagokine.jpg',0,0,138,108);
			//background:url(images/formatopagokine2.jpg); background-size:640px;
			echo "
				<div style=' width:770px; '><!-- background:url(images/formatopagokine2.jpg); background-size:730px;  padding-top:130px; padding-top:80px; padding-left:10px;' -->
					<table width='100%' style='border-bottom:0px solid black;  margin-top:25px;'>
						<tr style='margin-top:15px; border:1px solid black;'>
							<td width='70%'>".$filas["nombrePaciente"]."</td>
							<td width='30%' style=' padding-left:15px; '>".$filas["fechaRegistro"]."</td>
						</tr>
					</table>
					<table width='100%' style='border-bottom:0px solid black; margin-top:20px;'>
						<tr style='margin-top:15px; border:1px solid black;'>
							<td width='50%'>".$filas["domicilio"]."</td>
							<td width='50%' style=' padding-left:15px; '>".$filas["telefono"]."</td>
						</tr>
					</table>
					<table width='100%' style='border-bottom:0px solid black; margin-top:25px;'>
						<tr style='margin-top:15px; border:0px solid black;'>
							<td width='70%'>".(($filas["fecha_prox_sesion"]!=date('Y-m-d'))?$filas["fecha_prox_sesion"]:"-----------------")."</td>
							<td width='30%' style=' padding-left:15px; '>".(($filas["hora_prox_sesion"]!="00:00:00")?$filas["hora_prox_sesion"]:"----------")."</td>
						</tr>
					</table>
					<table width='100%' style='border-bottom:0px solid black; margin-top:18px;'>
						<tr>
							<td width='100%'>".$filas["alumno"]."</td>
						</tr>
					</table>
					<table width='100%' cellspacing='0' style='border:0px solid black;'>
						<tr>
							<td colspan='3' style='text-align:center;'>&nbsp;</td>
						</tr>
						<tr style='border-bottom:1px solid black; margin: -1px 0px;'>
							<td width='25%' style='border:0px solid red; text-align:right; padding-right:15px;'>".$filas["no_visita"]."</td>
							<td width='25%' style='border:0px solid red; padding-left:25px; vertical-align:top; font-size:11px;'>".(($baropodometria=="1")?"X":"&nbsp;")."</td>
							<td width='50%'></td>
						</tr>
						<tr style=' border-bottom:1px solid black; margin: -1px 0px;'>
							<td width='25%' style='border:0px solid red; padding-left:22px; vertical-align:top; font-size:11px;'>".(($filas["idTipoPaciente"]=="1")?"X":"&nbsp;")."</td>
							<td width='25%' style='border:0px solid red; padding-left:25px; vertical-align:top; font-size:11px;'>".(($puncionSeca=="1")?"X":"&nbsp;")."</td>
							<td width='50%' style=' padding-left:155px;'>".number_format($filas["costototal"],2)."</td>
						</tr>
						<tr style=' border-bottom:1px solid black; margin: -1px 0px;'>
							<td width='25%' style='border:0px solid red; padding-left:22px; padding-top:0px; vertical-align:top; font-size:11px;'>".(($filas["idTipoPaciente"]=="2")?"X":"&nbsp;")."</td>
							<td width='25%' style='border:0px solid red; padding-left:25px; padding-top:0px; vertical-align:top; font-size:11px;'>".(($mep=="1")?"X":"&nbsp;")."</td>
							<td width='50%'></td>
						</tr>
						<tr style='border-bottom:1px solid black; margin: -1px 0px;'>
							<td width='25%' style='border:0px solid red; padding-left:22px; padding-top:0px; vertical-align:top; font-size:11px;'>".(($filas["idTipoPaciente"]=="3")?"X":"&nbsp;")."</td>
							<td width='25%' style='border:0px solid red; padding-left:25px; padding-top:0px; vertical-align:top; font-size:11px;'>".(($nutricion=="1")?"X":"&nbsp;")."</td>
							<td width='50%'></td>
						</tr>
						<tr style='border-bottom:1px solid black; margin: -1px 0px;'>
							<td width='25%' style='border:0px solid red; padding-left:22px; padding-top:0px; vertical-align:top; font-size:11px;'>".(($filas["idTipoPaciente"]=="4")?"X":"&nbsp;")."</td>
							<td width='25%' style='border:0px solid red; padding-left:25px; padding-top:0px; vertical-align:top; font-size:11px;'>".(($valoracion=="1")?"X":"&nbsp;")."</td>
							<td width='50%'></td>
						</tr>
						<tr style='border-bottom:1px solid black; margin: -1px 0px;'>
							<td width='25%' style='border:0px solid red; padding-left:22px; padding-top:0px; vertical-align:top; font-size:11px;'></td>
							<td width='25%' style='border:0px solid red; padding-left:25px; vertical-align:top; font-size:11px;'>".(($terapia=="1")?"X":"&nbsp;")."</td>
							<td width='50%'></td>
						</tr>
					</table>
				</div>
			";
			mysqli_free_result($rsDatosRecibo);
			mysqli_close($con);
		?>
		<ta
	</body>
</html>
