	<?php
		session_start();
		
		require_once "views/header.php";
		require_once "views/topnavbar.php";
		
		
	?>
    		<div class="container" style="background:#fefefe; margin-top:0; padding: 15px 20px;">
				<div class="row toDaCenter" style="margin-left: 0;">
					<div class="col-md-12">
    					<img src="http://www.ucuauhtemoc.edu.mx/site/styleUCA/logosInstitucionales/univ_cuauhtemoc_plantel_ags.png" width="80%">
					</div>
				</div>
				<hr style="border: 3px solid #013668;">
				<h1 class="toDaCenter"><span class="glyphicon glyphicon-th-list"></span>|RECIBOS KINESIOLOG&Iacute;A </h1>
				<hr style="border:none; padding-bottom:15px; ">
				<div class="row toDaCenter" style="margin-left: 0; min-height:700px;">
       				<div class="col-md-6 ">
        				<div class="panel panel-default panel-profile">
							<div class="panel-body text-center">
								<span class="glyphicon glyphicon-paperclip fa-5x"></span>        
								<h5 class="panel-title">RECIBOS KINESIOLOGÍA</h5>
								<p class="m-b"><br/></p>
								<a href="recibo.php" class="btn btn-primary-outline" data-toggle="tooltip" data-placement="top" title="GENERA RECIBOS DE PAGO">
									ACCESAR
								</a>
            				</div>
        				</div>
        			</div>
        			<!-- glyphicon glyphicon-edit -->
        			<div class="col-md-6 ">
        				<div class="panel panel-default panel-profile">
							<div class="panel-body text-center">
								<span class="glyphicon glyphicon-calendar fa-5x"></span>        
								<h5 class="panel-title">AGENDA KINESIOLOGÍA</h5>
								<p class="m-b"><br/></p>
								<a href="agenda.php" class="btn btn-primary-outline" data-toggle="tooltip" data-placement="top" title="AGENDA DE PACIENTES">
									ACCESAR
								</a>
            				</div>
        				</div>
        			</div>
        			
					<div class="col-md-6 ">
						<div class="panel panel-default panel-profile">
							<div class="panel-body text-center">
								<span class="glyphicon glyphicon-education fa-5x"></span>        
								<h5 class="panel-title">KINESIOLOGOS</h5>
								<p class="m-b"><br/></p>
								<a href="kinesiologo.php" class="btn btn-primary-outline" data-toggle="tooltip" data-placement="top" title="">
									ACCESAR
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-6 ">
						<div class="panel panel-default panel-profile">
							<div class="panel-body text-center">
								<span class="glyphicon glyphicon-briefcase fa-5x"></span>        
								<h5 class="panel-title">USUARIOS</h5>
								<p class="m-b"><br/></p>
								<a href="usuarios.php" class="btn btn-primary-outline" data-toggle="tooltip" data-placement="top" title="">
									ACCESAR
								</a>
							</div>
						</div>
					</div>
						
				</div>
			</div>
	<?php
		require_once 'views/footer.php';
	?>
