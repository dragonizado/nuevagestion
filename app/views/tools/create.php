<div class="row">
	<div class="masonry-item col-md-5">
		<div class="bgc-white p-20 bd">
			<?php include "_form.php";?>
		</div>
	</div>
	<div class="masonry-item col-md-7">
		<div class="bgc-white p-20 bd">
			<h3><i class="fa fa-suitcase" aria-hidden="true"></i> Administrador de herramientas</h3>
			<hr>
			<div class="table-responsive">
				<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Tecnico a cargo</th>
							<th>Ubicación actual</th>
							<th>Fecha Salida</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($tbody as $key => $body) {
							$this->model_users->__SET('id',$body->tecnico);
							$this->model_locations->__SET('id',$body->ubicacion_actual);
							$tecnico = $this->model_users->getUser();
							$localizacion = $this->model_locations->getLocation();
							echo '<tr>';
							echo 	'<td>'.$body->nombre.'</td>';
							if ($tecnico) {
								echo 	'<td style="text-transform:uppercase;">'.$tecnico->nombre." ".$tecnico->apellido.'</td>';
							}else{
								echo 	'<td style="text-transform:uppercase;">Sin técnico</td>';
							}
							echo 	'<td style="text-transform:uppercase;">'.$localizacion->descripcion.'</td>';
							echo 	'<td>'.$body->fecha_salida.'</td>';
							echo 	'<td><a href="'.URL.'public/index.php?url=tools/edit&id='.$body->id.'" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a> <button class="btn btn-dark loadTool" data-ajaxid="'.$body->id.'"><i class="fa fa-info-circle" aria-hidden="true"></i>
	</button></td>';
							echo '</tr>';
						}
						?>
					</tbody> 
				</table>
			</div>
		</div>
		<div class="bgc-white p-20 bd " id="infotool" style="margin-top:16px;">
			<center><h3><i class="fa fa-info-circle" aria-hidden="true"></i> No se ha seleccionado una Herramienta</h3></center>
		</div>
		<!-- <div class="bgc-white p-20 bd " style="margin-top:16px;">
			<center><h3 style="text-transform:uppercase;">Taladro </h3></center>
			<div class="row justify-content-center">
				<div class="col-md-7">
					<p><span>Estado:</span></p>
					<p><span>Tipo:</span></p>
					<p><span>Modelo:</span></p>
					<p><span>Nº de serie:</span></p>
					<p><span>Nº inventario:</span></p>
					<p><span>Técnico encargado:</span></p>
				</div>
				<div class="col-md-5">
					<div class="card" style="width: 18rem; margin: 0 auto;">
					  <div class="card-body">
					    <h5 class="card-title">Descripción - Observación</h5>
					    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
					    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					    <a href="#" class="card-link">Card link</a>
					    <a href="#" class="card-link">Another link</a>
					  </div>
					</div>
				</div>
			</div>
			<div class="row row justify-content-end">
				<button class="btn btn-danger" style="margin-right: 16px;">Cerrar</button>
			</div>
		</div> -->
	</div>
</div>
<script type="text/javascript" src="<?=URL;?>public/js/themes/herramientas.js"></script>

