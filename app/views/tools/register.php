<div class="row">
	<div class="masonry-item col-md-5">
		<div class="bgc-white p-20 bd">
			<h3><i class="fa fa-plus" aria-hidden="true"></i> Asignar herramientas</h3>
			<hr>
			<?php include "_registerForm.php" ?>
		</div>
	</div>
	<div class="masonry-item col-md-7">
		<div class="bgc-white p-20 bd">
			<h3><i class="fa fa-suitcase" aria-hidden="true"></i> Ver herramientas asignadas</h3>
			<hr>
			<!-- <ul class="nav nav-tabs">
			  <li class="nav-item">
			    <a class="nav-link active" data-toggle="tab" href="#content-one">Herramientas Asignadas</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#content-two">Todas las Herramientas</a>
			  </li>
			</ul> -->

			<div class="tab-content">
					<div id="content-one" role="tabpanel" class="table-responsive tab-pane fade show active">
						<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Ubicación</th>
									<th>Obciones</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($tbody as $key => $tool) {
										$this->model_locations->__SET('id',$tool->ubicacion_actual);
										$localizacion = $this->model_locations->getLocation();
										echo '<tr>';
										echo '<td>'.$tool->nombre.'</td>';
										echo '<td>'.$localizacion->descripcion.'</td>';
										echo '<td><a href="'.URL.'public/index.php?url=tools/unregister&id='.$tool->id.'" class="btn btn-primary"><i class="fa fa-reply-all" aria-hidden="true"></i></a></td>';
										echo '</tr>';
									}
								 ?>
							</tbody>
							
						</table>
					</div>
				
				<!-- <div id="content-two" class="tab-pane fade" role="tabpanel">
					
				</div> -->
			</div>
		</div>
	</div>
</div>
<!-- modales -->
<?php include "_modals.php"; ?>
