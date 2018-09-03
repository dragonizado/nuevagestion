<?php 
date_default_timezone_set('America/Bogota');
$_dia = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
$_mes = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$_mes_ = array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
 ?>

 <div class="row">
	<div class="masonry-item col-md-12">
		<div class="bd bgc-white pl-3">
			<h1>Notificaciones</h1>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="masonry-item col-md-12">
		<div class="bd bgc-white">
			<div class="table-responsive p-20">
				<table class="table">
					<thead>
						<tr>
							<th class="bdwT-0">Usuario</th>
							<th class="bdwT-0">Descripcion</th>
							<th class="bdwT-0">Fecha</th>
							<th class="bdwT-0">Hora</th>
						</tr>
					</thead>
					<tbody>
						<?php $_logs = $model_logs->model(array("condition"=>" creado >= '".date("Y-m-d")."' ORDER BY creado DESC "));?>
						<?php if ($_logs): ?>
						 	<?php foreach ($_logs as $key => $log): ?>
								<tr>
									<td class="fw-600">
										<?php
											$user = $model_user->searchById($log->user_id);
											echo $user->nombre." ".$user->apellido;
										?>	
										</td>
									<td>
										<?php 
										$class_css_text = '';
											switch ($log->tipo) {
												case 'asignacion':
													$class_css_text = 'bgc-deep-purple-50 c-deep-purple-700';
													break;
												case 'desasignacion':
													$class_css_text = 'bgc-red-50 c-red-700';
													break;
												case 'edicion':
													$class_css_text = 'bgc-orange-50 c-orange-700';
													break;
												default:
													$class_css_text = 'bgc-green-50 c-green-700';
													break;
											}
										 ?>
										<span class="badge <?=$class_css_text;?> p-10 lh-0 tt-c badge-pill"><?=$log->descripcion;?></span>
									</td>
									<td><?= $_mes_[date("n",strtotime($log->creado))]." ".date("y",strtotime($log->creado));?></td>
									<td>
										<span class="text-success"><?=date("h:i A",strtotime($log->creado));?></span>
									</td>
								</tr>
							<?php endforeach ?>
						<?php else: ?>
							<tr>
								<td>No hay registro</td>
							</tr>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>