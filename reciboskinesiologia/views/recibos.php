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
					
					$.get('crudRecibos.php?idpac='+paciente+'&idterap='+terapia+'&act=getPrc'+'&rec='+recargos, function(data) {
						$("#txtCosto").attr("value",data);
						$('#loader').slideUp(200, function() {
							$(this).remove();
						});
					});	
				});
				
			});	
		</script>
		<div class="container" style="margin-top:70px; background:#fefefe; padding: 15px 20px;">
			<form action="?c=recibo&a=Guardar" method="post">
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
							<input type="text" id="txtKinesiologo" name="txtKinesiologo" value="" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
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
										No. Visita:  <input type='text' id='txtVisita' name='txtVisita' maxlength='6' value=''><br/>
										<?php foreach($this->modelTP->LlenaTipoPacientes(1) as $r): ?>
											<input type='radio' id='rbt_paciente' name='rbt_paciente' value='<?php echo $r->__GET('idTipoPaciente'); ?>' /> 
											<?php echo $r->__GET('tipoPaciente'); ?><br/>
										<?php endforeach; ?>
									</td>
									<td>
										<?php foreach($this->modelT->LlenaTerapias(2) as $r): ?>
											<input type='checkbox' id='chk_terapia[<?php echo $r->__GET('idterapia'); ?>]' name='chk_terapia[<?php echo $r->__GET('idterapia'); ?>]' value='<?php echo $r->__GET('idterapia'); ?>' />
											<?php echo $r->__GET('nombreterapia'); ?><br/>
										<?php endforeach; ?>
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
					<div class="form-group col-lg-4 col-md-4  col-sm-4">
						<input type="reset" id="btnReset" name="btnReset" class="btn btn-danger" value="Limpiar Campos" data-toggle="tooltip" data-placement="bottom" title="ELIMINA LOS DATOS DEL FORMULARIO">
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4">
						<input type="button" id="btnCalcula" name="btnCalcula" class="btn btn-primary" value="Calcular" data-toggle="tooltip" data-placement="bottom" title="CALCULA EL MONTO EN BASE A LOS CONCEPTOS">
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4">
						<input type="submit" id="btnRegistra" name="btnRegistra" class="btn btn-success" value="Registrar" data-toggle="tooltip" data-placement="bottom" title="REGISTRA LOS DATOS Y GENERA RECIBO">
					</div>
				</div>
			</form>
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