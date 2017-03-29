	<form id="frm1" name="frm1" method="POST" action="" >
		<div class="container shadow1" style="background:#fefefe; margin-top:0; padding: 15px 20px;">
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
					<h1 class="toDaCenter"><span class="glyphicon glyphicon-list-alt"></span>|LISTA KINESIOLOGOS VIGENTES</h1>
				</div>
			</div>
			<div style="min-height:600px;">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-10">
						<h1 class="page-header">
						    <?php echo $kine->__GET('idKinesiologo') != null ? $kine->__GET('matricula') : 'Nuevo Registro'; ?>
						</h1>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtmatricula">MATRICULA:</label>
								<input type="text" id="txtmatricula" name="txtmatricula" placeholder="Ingrese su usuario" class="form-control" value="<?php echo $kine->__GET('matricula');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtpass">NOMBRE:</label>
								<input type="text" id="txtpass" name="txtpass" placeholder="Ingrese su contraseña" class="form-control"  value="<?php echo $kine->__GET('nombreKinesio');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtpass">APELLIDO:</label>
								<input type="text" id="txtpass" name="txtpass" placeholder="Ingrese su contraseña" class="form-control"  value="<?php echo $kine->__GET('apellidoKinesio');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-center">
								<input type="submit" id="btnSubmit" name="btnSubmit" value="INGRESAR" class="btn btn-default">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>