<div class="container" style="margin-top:70px;">	
	<form id="frm1" name="frm1"  action="?c=kinesiologo&a=Guardar"  method="post" enctype="multipart/form-data">
		<div class="container shadow1" style="background:#fefefe; padding: 15px 20px;">
			<!-- ******** encabezado de la pág. ********* -->
			<div class="row toDaCenter" style="margin-left: 0;">
				<div class="col-md-12">
					<img src="http://www.ucuauhtemoc.edu.mx/site/styleUCA/logosInstitucionales/univ_cuauhtemoc_plantel_ags.png" width="80%">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr style="border: 3px solid #013668;">
					<!-- ***************************************** -->
					<h2 class="toDaCenter"><span class="glyphicon glyphicon-list-alt"></span>|LISTA KINESIOLOGOS VIGENTES</h2>
				</div>
			</div>
			<div style="min-height:600px;">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="well well-sm">
							<div class="row">
								<div class="col-xs-4 text-left">
									<a href="kinesiologo.php" class="btn btn-lg btn-warning"><i class="fa fa-chevron-circle-left"></i> REGRESAR</a>
								</div>
								<div class="col-xs-8 text-left">
									<h4 class="">
										<?php echo $kine->__GET('idKinesiologo') != null ? $kine->__GET('nombreKinesio')." ".$kine->__GET('apellidoKinesio') : 'Nuevo Registro'; ?>
									</h4>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtmatricula">MATRICULA:</label>
								<input type="text" id="txtmatricula" name="txtmatricula" placeholder="" class="form-control" value="<?php echo $kine->__GET('matricula');?>">
								<input type="hidden" id="txtidkinesiologo" name="txtidkinesiologo" placeholder="" class="form-control" value="<?php echo $kine->__GET('idKinesiologo');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtnombreKinesio">NOMBRE:</label>
								<input type="text" id="txtnombreKinesio" name="txtnombreKinesio" placeholder="" class="form-control"  value="<?php echo $kine->__GET('nombreKinesio');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtapellidoKinesio">APELLIDO:</label>
								<input type="text" id="txtapellidoKinesio" name="txtapellidoKinesio" placeholder="" class="form-control"  value="<?php echo $kine->__GET('apellidoKinesio');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtturno">TURNO:</label>
								<select name="txtturno" id="txtturno" class="form-control">
									<option value="1" <?php echo $kine->__GET('turno') == 1 ? 'selected' : '';?> >Turno: 08:00 - 11:00</option>
									<option value="2" <?php echo $kine->__GET('turno') == 2 ? 'selected' : '';?> >Turno: 11:00 - 14:00</option>
									<option value="3" <?php echo $kine->__GET('turno') == 3 ? 'selected' : '';?> >Turno: 14:00 - 17:00</option>
									<option value="4" <?php echo $kine->__GET('turno') == 4 ? 'selected' : '';?> >Turno: 17:00 - 20:00</option>
									<option value="5" <?php echo $kine->__GET('turno') == 5 ? 'selected' : '';?> >Turno: Sabatino</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-center">
								<input type="submit" id="btnSubmit" name="btnSubmit" value="<?php echo $kine->__GET('idKinesiologo') == "" ? 'INGRESAR' : 'ACTUALIZAR';?>" class="btn btn-primary">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>