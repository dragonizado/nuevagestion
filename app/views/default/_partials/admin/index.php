<?php 
date_default_timezone_set('America/Bogota');
$_dia = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
$_mes = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$_mes_ = array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
 ?>
<div class="row gap-20">
	<div class="col-md-3">
		<div class="layers bd bgc-white p-20">
			<div class="layer w-100 mB-10">
				<h6 class="lh-1">Total de herramientas</h6>
			</div>
			<div class="layer w-100">
				<div class="peers ai-sb fxw-nw">
					<div class="peer peer-greed">
						<span id="sparklinedash"></span>
					</div>
					<div class="peer">
						<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">
							<?= $total_tools; ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="layers bd bgc-white p-20">
			<div class="layer w-100 mB-10">
				<h6 class="lh-1">Total de técnicos</h6>
			</div>
			<div class="layer w-100">
				<div class="peers ai-sb fxw-nw">
					<div class="peer peer-greed">
						<span id="sparklinedash2"></span>
					</div>
					<div class="peer">
						<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">
							<?= $total_technical; ?>	
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="layers bd bgc-white p-20">
			<div class="layer w-100 mB-10">
				<h6 class="lh-1">Herramientas en álmacen</h6>
			</div>
			<div class="layer w-100">
				<div class="peers ai-sb fxw-nw">
					<div class="peer peer-greed">
						<span id="sparklinedash3"></span>
					</div>
					<div class="peer">
						<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">
							<?= $total_tools_inside; ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="layers bd bgc-white p-20">
			<div class="layer w-100 mB-10">
				<h6 class="lh-1">Herramientas afuera</h6>
			</div>
			<div class="layer w-100">
				<div class="peers ai-sb fxw-nw">
					<div class="peer peer-greed">
						<span id="sparklinedash4"></span>
					</div>
					<div class="peer">
						<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">
							<?= $total_tools_outside; ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row gap-20">
	<div class="masonry-item col-md-6">
		<div class="bd bgc-white">
			<div class="layers">
				<div class="layer w-100 p-20">
					<h6 class="lh-1">Notificaciones</h6>
				</div>
				<div class="layer w-100">
					<div class="bgc-light-blue-500 c-white p-20">
						<div class="peers ai-c jc-sb gap-40">
							<div class="peer peer-greed">
								<h5><?= $_mes[date("n")]." ".date("Y") ?></h5>
								<p class="mB-0">Hoy</p>
							</div>
							<div class="peer">
								<h3 class="text-right"><?= $_dia[date("w")];?></h3>
							</div>
						</div>
					</div>
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
								<?php 
									$_logs = $model_logs->model(array("condition"=>" creado >= '".date("Y-m-d")."' ORDER BY creado DESC LIMIT 7"))
								 ?>
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
		<div class="ta-c bdT w-100 p-20">
			<a href="<?=URL?>public/index.php?url=reports/notification">Ver todas la notificaciones</a>
		</div>
	</div>
</div>
</div>