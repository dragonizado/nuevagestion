<form action="<?=URL;?>public/index.php?url=tools/register" method="post">
	<div class="form-row">
		<div class="col">
			<div class="form-group">
				<label for="">Herramientas</label>
				<select name="Herramienta" id="" class="form-control">
					<option value="">Seleccione una herramienta</option>
					<?php 
						foreach ($herramientas as $key => $herramienta) {
							echo '<option value="'.$herramienta->id.'">'.$herramienta->nombre.'</option>';
						}
					 ?>
				</select>
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<label for="">Ubicación</label>
				<select name="ubicacion" id="" class="form-control">
					<option value="">Seleccione una herramienta</option>
					<?php 
						foreach ($locations as $key => $location) {
							echo '<option value="'.$location->id.'">'.$location->descripcion.'</option>';
						}
					 ?>
				</select>
			</div>
		</div>
	</div>
	<div class="form-row">
		<button class="btn btn-primary" name="btn-register">Asignar herramienta</button>
	</div>
</form>