<!DOCTYPE html>
<html>
	<head>
		<?php
			//Session Start
			session_start();
			if(!isset($_SESSION["username"])){
				include "login.php";
				die();
			}
			include "headers.php";
		?>
        <script>
			$(document).ready(function(){
				$("#btnCalcula").click(function() {
					$(this).after('<div id="loader"><img src="images/LoaderIcon.gif" alt="loading subcategory" width="50px"/></div>');
					var terapia = "";
					var paciente = "";
					var recargos = "";
					//esta sección devuelve los elementos checados de las terapias
					$('input[type=checkbox][id^="chk_terapia"]:checked').each(function (index,item) {      
						if (terapia.length == 0) {
							terapia =$(item).val();
						}
						else {
							terapia += "|" + $(item).val();
						}
					});
					//en esta otra sección obtenemos el valor de el tipo de paciente
					$('input[type=radio][id^="rbt_paciente"]:checked').each(function(index,item){
						if (paciente.length == 0) {
							paciente =$(item).val();
						}
						else {
							paciente += "|" + $(item).val();
						}
					});
					$('input[type=radio][id^="rbtRecargos"]:checked').each(function(index,item){
						if (recargos.length == 0) {
							recargos =$(item).val();
						}
						else {
							recargos += "|" + $(item).val();
						}
					});
					
					//alert('crudRecibos.php?idpac='+paciente+'&idterap='+terapia+'&act=getPrc');
					$.get('crudRecibos.php?idpac='+paciente+'&idterap='+terapia+'&act=getPrc'+'&rec='+recargos, function(data) {
						$("#txtCosto").attr("value",data);
						$('#loader').slideUp(200, function() {
							$(this).remove();
						});
					});	
				});
				
			});	
		</script>
		<?php
			date_default_timezone_set('America/Mexico_City');
			//header ('Content-type: text/html; charset=utf-8');
			include "dataBase/conexion.php";
			$conexion = new createCon();
			$con = $conexion -> connect();
			if(isset($_POST["btnRegistra"]) && $_POST["btnRegistra"]=="Registrar"){
				$terapiacPaciente="";
				foreach($_POST["chk_terapia"] as $elemento){
					$terapiacPaciente.= $elemento."|";
				}
				if(isset($_POST["rbtRecargos"]) && ($_POST["rbtRecargos"] != "")){
					
				}
				else{
					$_POST["rbtRecargos"] = 0;
				}
				if(isset($_POST["txtNoRecibos"]) && ($_POST["txtNoRecibos"] != "")){
					
				}
				else{
					$_POST["txtNoRecibos"] = 1;
				}
				$terapiacPaciente = substr($terapiacPaciente, 0, -1);
				$qryInsertRecibo = "CALL stored_insRecibo(
										'".$_POST["txtNombre"]."'
										,'".date_format(date_create($_POST["txtFecha"]),"Y-m-d")."'
										,'".$_POST["txtDomicilio"]."'
										,'".$_POST["txtTelefono"]."'
										,'".date_format(date_create($_POST["txtProximaSesion"]),"Y-m-d")."'
										,'".$_POST["txtHora"]."'
										,'".$_POST["txtVisita"]."'
										,'".$_POST["rbt_paciente"]."'
										,'".$terapiacPaciente."'
										,'".$_POST["txtCosto"]."'
										,'".$_POST["txtKinesiologo"]."'
										,'0'
										,'".$_POST["rbtRecargos"]."'
									)";
				//echo $qryInsertRecibo."<br/>";
				//echo date_format(date_create($_POST["txtFecha"]),"m-d-Y");

				if ($con->multi_query($qryInsertRecibo)) {
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
									window.open("recibopdf.php?id=0","","titlebars=0,toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=1,width=650,height=700");
									window.location.href = "index.php";
								</script>
							';

						}
					} while ($con->more_results() && $con->next_result());
				}
				else{
					echo $con->error;
				}
			}
			/* ******* fin de acción para boton de registro de recibo ******* */
		?>
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
						<div class="col-md-10 center-block">
							<div class="panel panel-default">
								<table>
									<tr>
										<td style="width:50%;">
											<img src="http://www.ucuauhtemoc.edu.mx/site/styleUCA/logosInstitucionales/logo_nuevo_uca.jpg" width="40%">
										</td>
										<td style="width:50%;">
											<span style="font-size:1.5em; line-height:4; font-weight:bold;">BOLETA DE PAGO</span>
										</td>
									</tr>
								</table>
								<!-- ******************************************** -->
								<table >
									<tr>
										<td style="width:25%;">
											<span style="font-size:1em; line-height:1.2;">ADOLFO LOPEZ MATEOS No. 102 EL LLANO JESUS MARIA, AGS.</span>
										</td>
										<td style="width:50%;">
											<span style="font-size:1.5em; line-height:4; font-weight:bold;">CL&Iacute;NICA DE KINESIOLOG&Iacute;A</span>
										</td>
										<td style="width:25%;">
											<span style="font-size:1em; line-height:1.2;">TEL: 146-5508.</span>
										</td>
									</tr>
								</table>
								<table class="datosGenerales">
									<tr>
										<td style="width:70%;">
											<label for="txtCarrera">NOMBRE:</label>
											<input type="hidden" id="txt">
											<input type="text" id="txtNombre" name="txtNombre" value="" class="form-control" required style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
										</td>
										<td style="width:30%;">
											<label for="txtCarrera">FECHA:</label>
											<input type="text" id="txtFecha" name="txtFecha" value="<?php echo date("d-m-Y"); ?>" class="form-control" readonly>
										</td>
									</tr>
								</table>
								<table class="datosGenerales">
									<tr>
										<td style="width:50%;">
											<label for="txtCarrera">DOMICILIO:</label>
											<input type="text" id="txtDomicilio" name="txtDomicilio" value="" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
										</td>
										<td style="width:50%;">
											<label for="txtCarrera">TEL&Eacute;FONO:</label>
											<input type="text" id="txtTelefono" name="txtTelefono" value="" class="form-control" required>
										</td>
									</tr>
								</table>
								<table class="datosGenerales">
									<tr>
										<td style="width:50%;">
											<label for="txtCarrera">PROX. SESI&Oacute;N:</label>
											<div class="form-group">
												<div class='input-group date' id='datetimepicker1'>
													<input type='text'id="txtProximaSesion" name="txtProximaSesion" class="form-control" />
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
													<input type='text' id="txtHora" name="txtHora" class="form-control" />
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
									</tr>
								</table>
								<table class="datosGenerales">
									<tr>
										<td style="width:70%;">
											<label for="txtCarrera">ALUMNO:</label>
											<input type="text" id="txtKinesiologo" name="txtKinesiologo" value="<?php //echo $_POST["txtKinesiologo"];?>" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
										</td>
										
									</tr>
								</table>
								<div class="row" style="margin-left: 0;">
									<div class="form-group col-lg-12 col-md-12 center-block">
										<label>DESCRIPCI&Oacute;N DE LA SESI&Oacute;N</label>
										<div style="display:block;">
											<table style="width:60%; float:left;"  class="datosGenerales">
												<tr>
													<td style="width:33.33%;">PACIENTE</td>
													<td style="width:33.33%;">TERAPIA</td>
													<td style="width:33.33%;">RECARGOS</td>
												</tr>
												<tr>
													<td>
														<?php
															$queryFill = "CALL stored_getTiposDe(1);";
															$queryFill2= "CALL stored_getTiposDe(2)";
															if ($con->multi_query($queryFill)) {
																echo "No. Visita:  <input type='text' id='txtVisita' name='txtVisita' maxlength='6' value=''><br/>";
																do {
																	if($resultado = $con->store_result()){
																		while ($fila = $resultado->fetch_assoc()) {
																			echo "<input type='radio' id='rbt_paciente' name='rbt_paciente' value='".$fila["id"]."' />  ";
																			/*colocar la siguiente línea si se desea mantener los valores despues del submit */
																			/*".($_POST["rbt_paciente"]==$fila["id"]?" checked ":"")."*/
																			echo $fila["tipo"]."<br/>";
																		}
																		$resultado->free();
																	}
																} while ($con->more_results() && $con->next_result());
															}
															else{
																echo $con->error;
															}
															echo "</td>";
															echo "<td>";
															if ($con->multi_query($queryFill2)) {
																do {
																	if($resultado = $con->store_result()){
																		$incont =1;
																		while ($fila = $resultado->fetch_assoc()) {
																			echo "<input type='checkbox' id='chk_terapia[".$fila["id"]."]' name='chk_terapia[".$fila["id"]."]' value='".$fila["id"]."' />  ";
																			echo $fila["tipo"]."<br/>";
																			$incont++;
																		}
																		$resultado->free();
																	}

																} while ($con->more_results() && $con->next_result());
															}
															else{
																echo $con->error;
															}
														?>
													</td>
													<td>
														<div class="col-xs-12">
															<input type="radio" id="rbtRecargos" name="rbtRecargos" value="1" class="">&nbsp;Cancelaci&oacute;n Mismo D&iacute;a
														</div>
														<div class="col-xs-12">
															<input type="radio" id="rbtRecargos" name="rbtRecargos" value="2" class="">&nbsp;Inasistencia a cita previa
														</div>
													</td>
												</tr>
											</table>
											<table style="width:40%; float:left; border-left:1px solid #1F1F1F;" class="datosGenerales">
												<tr>
													<td>COSTO</td>
												</tr>
												<tr>
													<td>
														<input type="text" id="txtCosto" name="txtCosto" value="" class="form-control" readonly required>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<!-- ******************************************** -->
								<hr/>
								<div class="row" style="margin-left: 0;">
									<div class=" col-lg-12 col-md-12"><h3>OPERACIONES GENERALES</h3></div>
									<div class="form-group col-lg-4 col-md-4">
										<input type="reset" id="btnReset" name="btnReset" class="btn btn-danger" value="Limpiar Campos" data-toggle="tooltip" data-placement="bottom" title="ELIMINA LOS DATOS DEL FORMULARIO">
									</div>
									<div class="form-group col-lg-4 col-md-4">
										<input type="button" id="btnCalcula" name="btnCalcula" class="btn btn-primary" value="Calcular" data-toggle="tooltip" data-placement="bottom" title="CALCULA EL MONTO EN BASE A LOS CONCEPTOS">
									</div>
									<div class="form-group col-lg-4 col-md-4">
										<input type="submit" id="btnRegistra" name="btnRegistra" class="btn btn-success" value="Registrar" data-toggle="tooltip" data-placement="bottom" title="REGISTRA LOS DATOS Y GENERA RECIBO">
									</div>
								</div>
								<hr/>
								<div class="row" style="margin-left: 0;">
									<div class=" col-lg-12 col-md-12"><h3>FUNCIONES ADMINISTRATIVAS</h3></div>
									<div class="form-group col-lg-4 col-md-4">
										<input type="button" id="btnReporteSemanal" name="btnReporteSemanal" class="btn btn-primary" value="REPORTE SEMANAL" disabled data-toggle="tooltip" data-placement="bottom" title="GENERA REPORTE SEMANAL">
									</div>
									<div class="form-group col-lg-4 col-md-4">
										<input type="button" id="btnCorteTurno" name="btnCorteTurno" class="btn btn-primary" value="CORTE DE TURNO" disabled data-toggle="tooltip" data-placement="bottom" title="SACA LA RELACIÓN DE CITAS/INGRESOS DEL TURNO">
									</div>
									
								</div>
								<hr/>
								<div class="row" style="margin-left: 0;">
									<div class="col-lg-7 col-md-9 center-block">
										<h3>REGISTROS DEL D&Iacute;A</h3>
									</div>
								</div>
								<?php
									$qryInsertRecibo = "CALL stored_getRecibosDeDia('".date("Y-m-d")."')";
										//echo $qryInsertRecibo."<br/>";
										//echo date_format(date_create($_POST["txtFecha"]),"m-d-Y");
										
										if ($con->multi_query($qryInsertRecibo)) {
											do {
												if($resultado = $con->store_result()){
													while ($fila = $resultado->fetch_assoc()) {
														echo '
															<div class="row" style="margin-left: 0;">
																<div class="col-lg-11 col-md-11 center-block" style="text-align:justify; border-bottom:2px solid #a52a2a; margin-bottom:3px;">
																	<div class="row">
																		<div class="col-md-6">
																			<b>FOLIO</b>:&nbsp;'.$fila["idRecibo"].'
																			<br/><b>NOMBRE DEL PACIENTE:</b>&nbsp;'.$fila["nombrePaciente"].'
																			<br/><b>PR&Oacute;XIMA CITA:</b>&nbsp;'.(($fila["fecha_prox_sesion"])==date('Y-m-d')?" ---- ":$fila["fecha_prox_sesion"]).'
																			<br/><b>ALUMNO QUE ATENDI&Oacute;:</b>&nbsp;'.$fila["alumno"];
																			if($fila["fecha_prox_sesion"]==date('Y-m-d')){
															?>
																					<a id="fancybox-manual-<?php echo $fila['idRecibo'];?>" href="javascript:;" >FIJAR PROXIMA CITA</a>
																					<script type="text/javascript">
																						$(document).ready(function() {
																							/**  Simple image gallery. **/
																							/**  Uses default settings **/
																							$('.fancybox').fancybox();
																							/**  Different effects 	   **/
																							/**********************************/
																							$("#fancybox-manual-<?php echo $fila['idRecibo'];?>").click(function() {
																								$.fancybox.open({
																									href : 'modal.php?id=<?php echo $fila['idRecibo'];?>',
																									type : 'iframe',
																									padding : 5,
																									afterClose: function(){window.location.href = "index.php";}
																								});
																							});
																							/*********************************/
																						});
																					</script>
															<?php
																	}
														
														echo'	
																		</div>
																		<div class="col-md-3 linkBco">
																			'.(($fila["isCancel"])==1?'<span> RECIBO CANCELADO </span>':'<a href="#" class="btn btn-danger"><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i> CANCELAR RECIBO</a>').'
																		</div>
																		<div class="col-md-3 linkBco">
																			<a href="recibopdf.php?id='.$fila['idRecibo'].'" target="_blank" class="btn btn-primary"> <i class="fa fa-print fa-2x" aria-hidden="true"></i> IMPRIMIR RECIBO</a>
																		</div>
																	</div>
																</div>
															</div>
														';
													}
													$resultado->free();
												}
											} while ($con->more_results() && $con->next_result());
										}
										else{
											echo $con->error;
										}
									/* ******* acción para boton de registro de recibo ******* */
									//foreach($_POST["chk_terapia[]"])
									
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$("#txtVisita").change(function(){
						var valorActual = $('#txtVisita').val();
						if(valorActual!=""){
							if($.isNumeric(valorActual)){

							}
							else{
								$('#txtVisita').val("");
								alert("No se permiten otros valores que no sean números");
								
							}
						}
					});
					$("#txtNoRecibos").change(function(){
						var valorActual = $('#txtNoRecibos').val();
						if(valorActual!=""){
							if($.isNumeric(valorActual)){

							}
							else{
								$('#txtNoRecibos').val("");
								alert("No se permiten otros valores que no sean números");
								
							}
						}
					});
					//$('[data-toggle="tooltip"]').tooltip();
				});
			</script>
			<!-- pie de página -->
			<?php
				include "../footer.php";
			?>
		</form>
	</body>
</html>