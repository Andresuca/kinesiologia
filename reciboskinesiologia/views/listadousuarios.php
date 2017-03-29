<div class="container" style="margin-top:65px; background:#fefefe; min-height:800px;">
	<div class="row">
		<div class="col-md-10 center-block" >
			<h1 class="page-header">Kinesiologos Disponibles</h1>

			<div class="well well-sm text-right">
				<a class="btn btn-primary" href="?c=usuario&a=Crud">Nuevo Usuario</a>
			</div>

			<table class="table table-striped">
				<thead>
					<tr>
						<th style="width:300px;"  class="text-left">Nombre De Usuario</th>
						<th style="width:180px;" class="text-left">Nombre Completo</th>
						<th class="text-left">Rol</th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
					</tr>
				</thead>
				
				
				<?php foreach($this->model->ListarUsers() as $r): ?>
					<tr>
						

						<td class="text-left"><?php echo $r->__GET('username'); ?></td>
						<td class="text-left"><?php echo $r->__GET('nombrecompleto'); ?></td>
						<td class="text-left"><?php echo $r->__GET('rol') ==1 ? 'Admin' : 'Cajas'; ?></td>
						<td>
							<a href="?c=usuario&a=Crud&id=<?php echo $r->idusuario; ?>">Editar</a>
						</td>
						<td>
							<a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Kinesiologo&a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
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