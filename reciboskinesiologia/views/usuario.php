<div class="container shadow1" style="margin-top:65px; background:#fefefe; min-height:800px;">	
	<form id="frm1" name="frm1"  action="?c=kinesiologo&a=Guardar"  method="post" enctype="multipart/form-data">
		<div class="" style="">
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
					<h2 class="toDaCenter"><span class="glyphicon glyphicon-list-alt"></span>|LISTA USUARIOS VIGENTES</h2>
				</div>
			</div>
			<div style="min-height:600px;">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-10">
						<h3 class="page-header">
						    <?php echo $usr->__GET('idusuario') != null ? $usr->__GET('nombrecompleto') : 'Nuevo Registro'; ?>
						</h3>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<a href="usuarios.php" class="btn btn-lg btn-default">REGRESAR</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtusername">NOMBRE DE USUARIO:</label>
								<input type="text" id="txtusername" name="txtusername" placeholder="" class="form-control" value="<?php echo $usr->__GET('username');?>">
								<input type="hidden" id="txtidusuario" name="txtidusuario" placeholder="" class="form-control" value="<?php echo $usr->__GET('idusuario');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtnombrecompleto">NOMBRE COMPLETO:</label>
								<input type="text" id="txtnombrecompleto" name="txtnombrecompleto" placeholder="" class="form-control"  value="<?php echo $usr->__GET('nombrecompleto');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtpass">CONTRASEÑA:</label>
								<input type="password" id="txtpass" name="txtpass" placeholder="" class="form-control"  value="<?php echo $usr->__GET('pass');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-left">
								<label for="txtturno">ROL:</label>
								<select name="txtrol" id="txtrol" class="form-control">
									<option value="1" <?php echo $usr->__GET('rol') == 1 ? 'selected' : '';?> >Administrador</option>
									<option value="2" <?php echo $usr->__GET('rol') == 2 ? 'selected' : '';?> >Caja</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group text-center">
								<input type="submit" id="btnSubmit" name="btnSubmit" value="<?php echo $usr->__GET('idusuario') == "" ? 'INGRESAR' : 'ACTUALIZAR';?>" class="btn btn-primary">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>