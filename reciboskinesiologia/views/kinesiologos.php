<div class="container" style="margin-top:65px; background:#fefefe; min-height:800px;">
	<div class="row">
		<div class="col-md-12 center-block" >
			<h1 class="page-header text-center">Kinesiologos Disponibles</h1>

			<div class="well well-sm text-right">
				<div class="row">
					<div class="col-sm-6 text-left">
						<a class="btn btn-warning" href="index.php"><i class="fa fa-home fa-fw"></i> Volver al Inicio</a>
					</div>
					<div class="col-sm-6 text-right">
						<a class="btn btn-success" href="?c=kinesiologo&a=Crud"><i class="fa fa-plus fa-fw"></i> Nuevo Kinesiologo</a>
					</div>
				</div>
				
			</div>

			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th style="width:140px;" class="text-center">Matricula</th>
						<th style="width:180px;" class="text-left">Nombre</th>
						<th class="text-left">Apellido</th>
						<th class="text-left">Turno</th>
						<th class="text-center" colspan="2">Acciones</th>
					</tr>
				</thead>
				
				
				<?php foreach($this->model->Listar() as $r): ?>
					<tr>
						

						<td class="text-left"><?php echo $r->__GET('matricula'); ?></td>
						<td class="text-left"><?php echo $r->__GET('nombreKinesio'); ?></td>
						<td class="text-left"><?php echo $r->__GET('apellidoKinesio'); ?></td>
						<td class="text-left">
							<?php
								switch($r->__GET('turno')){
									case 1: 
										echo 'Turno: 08:00 - 11:00';
									break; 
									case 2: 
										echo 'Turno: 11:00 - 14:00';
									break;
									case 3: 
										echo 'Turno: 14:00 - 17:00';
									break; 
									case 4: 
										echo 'Turno: 17:00 - 20:00';
									break;
									case 5: 
										echo 'Turno: Sabatino';
									break;
								}
							?>
						</td>
						<td  class="text-center">
							<a class="btn btn-primary" href="?c=kinesiologo&a=Crud&id=<?php echo $r->idKinesiologo; ?>"><i class="fa fa-pencil fa-fw"></i> Editar</a>
						</td>
						<td class="text-center">
							<a class="btn btn-danger" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Kinesiologo&a=Eliminar&id=<?php echo $r->idKinesiologo; ?>"><i class="fa fa-trash-o fa-fw"></i> Eliminar</a>
						</td>
					</tr>
				<?php endforeach; ?>
				
				<tfoot>
					<tr>
					   
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>