<?php if ($id == ''): ?>
	<form action="<?=URL?>public/index.php?url=tools/create" method="post" >
		<div class="form-group">
			<h3><i class="fa fa-wrench" aria-hidden="true"></i> Registro de Herramientas</h3>
		</div>
<?php else: ?>
	<form action="<?=URL?>public/index.php?url=tools/edit&id=<?=$id;?>" method="post" >
		<div class="form-group">
			<h3><i class="fa fa-pencil" aria-hidden="true"></i> Editar Herramienta</h3>
		</div>
<?php endif ?>
	<div class="form-row">
		<div class="col">
			<div class="form-group">
				<label for="">Nombre Herramienta: <span style="color:red;">*</span></label>
				<input type="text" name="name" class="form-control" value="<?=$model->nombre;?>">
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<label for="">Fecha de compra:</label>
				<input type="date" name="f_C"	class="form-control" value="<?=$model->fecha_compra;?>">
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col">
			<div class="form-group">
				<label for="">Estado herramienta: <span style="color:red;">*</span></label>
				<div class="input-group">
					<select name="es_her" id="es_her" class="form-control" required>
						<option value="" disabled selected>Seleccione una opción</option>
						<option value="Bueno" <?php echo ($id != '' && $model->estado_herr=='Bueno')?'selected="selected"':''; ?>>Bueno</option>
						<option value="Regular" <?php echo ($id != '' && $model->estado_herr=='Regular')?'selected="selected"':''; ?>>Regular</option>
						<option value="Mantenimiento" <?php echo ($id != '' && $model->estado_herr=='Mantenimiento')?'selected="selected"':''; ?>>Mantenimiento</option>
						<option value="No funciona" <?php echo ($id != '' && $model->estado_herr=='No funciona')?'selected="selected"':''; ?>>No funciona</option>
						<?php 
							foreach ($states as $key => $state) {
								if ($model->estado_herr == $state->descripcion) {
									echo '<option value="'.$state->descripcion.'" selected="selected">'.$state->descripcion.'</option>';
								}else{
									echo '<option value="'.$state->descripcion.'">'.$state->descripcion.'</option>';
								}
							}
						 ?>
					</select>
					<div class="input-group-prepend">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mstagetools">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</button>
			        </div>
				</div>
				
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<label for="">Fecha de Mantenimiento:</label>
				<input type="date" name="f_M" class="form-control" value="<?=$model->fecha_mto;?>">
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col">
			<div class="form-group">
				<label for="">Tipo:</label>
				<div class="input-group">
					<select name="type" id="type" class="form-control">
						<option value="">Seleccione una opción</option>
						<?php 
							foreach ($types as $key => $type) {
								if ($model->tipo == $type->descripcion) {
									echo '<option value="'.$type->descripcion.'" selected="selected">'.$type->descripcion.'</option>';
								}else{
									echo '<option value="'.$type->descripcion.'">'.$type->descripcion.'</option>';
								}
							}
						 ?>
					</select>
					<div class="input-group-prepend">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mtypetool">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</button>
			        </div>
				</div>
			</div>
			<div class="form-group">
				<label for="">Fabricante:</label>
				<input type="text" name="maker" class="form-control" value="<?=$model->fabricante;?>">
			</div>
			<div class="form-group">
				<label for="">Modelo:</label>
				<input type="text" name="model" class="form-control" value="<?=$model->modelo;?>">
			</div>
			<div class="form-group">
				<label for="">Nº Serie:</label>
				<input type="text" name="n_serie" class="form-control" value="<?=$model->n_serie;?>">
			</div>
			<div class="form-group">
				<label for="">Nº Inventario:</label>
				<input type="number" name="n_inven" class="form-control"  value="<?=$model->n_inventario;?>">
			</div>
			<div class="form-group">
				<label for="">Técnico a cargo:</label>
				<div class="input-group">
					<select name="technical" id="" class="form-control">
						<option value="">Sin técnico</option>
						<?php 
							foreach ($tecnicos as $key => $tecnico) {
								if ($model->tecnico == $tecnico->id) {
									echo '<option value="'.$tecnico->id.'" selected="selected">'.$tecnico->nombre.' '.$tecnico->apellido.'</option>';
								}else{
									echo '<option value="'.$tecnico->id.'">'.$tecnico->nombre.' '.$tecnico->apellido.'</option>';
								}
							}
						 ?>
					</select>
					<!-- <div class="input-group-prepend">
						<a href="<?=URL;?>public/index.php?url=default/signin" class="btn btn-primary">+</a>
			        </div> -->
				</div>
			</div>
		</div>
			<div class="col">
				<div class="form-group">
					<label for="">Descripción - Observación:</label>
					<textarea name="observations" id="" cols="30" rows="10" class="form-control"><?=$model->descripcion;?></textarea>
				</div>
				<div class="form-group">
				<label for="">Ubicación actual:</label>
				<div class="input-group">
					<select name="Current_location" id="Current_location" class="form-control">
						
						<?php 
							foreach ($locations as $key => $location) {
								if ($model->ubicacion_actual == $location->id) {
									echo '<option value="'.$location->id.'" selected="selected">'.$location->descripcion.'</option>';
								}else{
									echo '<option value="'.$location->id.'">'.$location->descripcion.'</option>';
								}
							}
						 ?>
					</select>
					<div class="input-group-prepend">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mcurrentlocation">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
						</button>
			        </div>
				</div>
			</div>
			</div>
	</div>
	<hr>
	<div class="form-row">
		<?php if ($id == ''): ?>
			<button type="submit" class="btn btn-primary" name="btn-register">Registrar</button>
			<?php else: ?>
			<button type="submit" class="btn btn-success" name="btn-save">Guardar</button>
			<a href="<?=URL?>public/index.php?url=tools/create" class="btn btn-danger">Cancelar</a>
		<?php endif ?>
	</div>
</form>