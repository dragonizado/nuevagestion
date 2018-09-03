<div class="row">
	<div class="masonry-item col-md-12">
		<div class="bgc-white p-20 bd">
			<form action="<?=URL?>public/index.php?url=reports/generatePDF" method="post">
				<div class="form-row">
					<div class="form-group col-md 2">
						<label for="technical">Tecnico</label>
						<select name="technical" id="technical" class="form-control">
							<option value="" selected disabled> Seleccione una opción</option>
							<?php foreach ($tecnicos->model(array("condition"=>'rol_id = "3"')) as $key => $tecnico): ?>
								<option value="<?=$tecnico->id;?>"><?=$tecnico->nombre;?> <?=$tecnico->apellido;?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group col-md 2">
						<label for="location">Ubicación</label>
						<select name="location" id="location" class="form-control">
							<option value="" selected disabled> Seleccione una opción</option>
							<?php foreach ($ubicacions->getAlllocations() as $key => $ubicacion): ?>
								<option value="<?=$ubicacion->id;?>"><?=$ubicacion->descripcion;?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group col-md 2">
						<label for="asigned">Asignado</label>
						<select name="asigned" id="asigned" class="form-control">
							<option value="" selected disabled> Seleccione una opción</option>
							<option value="">Asignado</option>
							<option value="">Sin asignar</option>
						</select>
					</div>
					<div class="form-group col-md 2">
						<label for="date_in">Fecha ingreso</label>
						<input type="date" name="date_in" id="date_in" placeholder="Ingrese una fecha" class="form-control">
					</div>
					<div class="form-group col-md 2">
						<label for="">Fecha salida</label>
						<input type="date" name="date_out" id="date_out" placeholder="Ingrese una fecha" class="form-control">
					</div>
					<div class="form-group col-md 2">
						<label for="">&nbsp;</label>
						<button class="btn btn-primary form-control" name="btn-generate">Generar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="masonry-item col-md-12">
		<div class="bgc-white p-20 bd">
			<table class="table" id="dataTable">
				<thead>
					<tr>
						<th>Herramienta</th>
						<th>Tecnico a cargo</th>
						<th>Ubicación actual</th>
						<th>Precio</th>
						<th>Estado</th>
						<th>Fecha de compra</th>
						<th>Fecha de mantenimiento</th>
						<th>Fecha de Salida</th>
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
							echo 	'<td>'.$body->price.'</td>';
							echo 	'<td>'.$body->estado_herr.'</td>';
							echo 	'<td>'.$body->fecha_compra.'</td>';
							echo 	'<td>'.$body->fecha_mto.'</td>';
							echo 	'<td>'.$body->fecha_salida.'</td>';
							echo '</tr>';
						}
					 ?>
				</tbody>
			</table>
		</div>
	</div>
</div>