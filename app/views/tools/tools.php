<div class="row">
	<div class="col-md-12">
		<div class="bgc-white p-20 bd">
			<h2>Herramientas</h2>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col-md-12">
		<div class="bgc-white p-20 bd">
			<form action="<?=URL;?>public/index.php?url=tools/multitools" method="post">
			<table id="dataTable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Selección</th>
						<th>Nombre</th>
						<th>Ubicación</th>
						<th>Técnico</th>
						<!-- <th>Opciones</th> -->
					</tr>
				</thead>
				<tbody>
						
					<?php 
						foreach ($tbodyAll as $key => $tool) {
							$this->model_locations->__SET('id',$tool->ubicacion_actual);
							$this->model_users->__SET('id',$tool->tecnico);
								$user = $this->model_users->getUser();
								if ($user) {
									$nombre = $user->nombre.' '.$user->apellido;
								}else{
									$nombre = 'Sin técnico';
								}
								
								$localizacion = $this->model_locations->getLocation();
								$localizacions = $this->model_locations->getAlllocations();

								echo '<tr>';
								if($nombre == 'Sin técnico'){
									echo '<td><input type="checkbox" class="form-control tools_check" value="'.$tool->id.'" name="tools[]"></td>';
								}else{
									echo '<td style="text-align:center;">No disponible</td>';
								}
								
								echo '<td>'.$tool->nombre.'</td>';
								if($nombre == 'Sin técnico'){
									echo '<td>';
									echo '<select name="opt_locations[]" id="" disabled>';
									foreach ($localizacions as $key => $loc) {
										if($loc->descripcion == $localizacion->descripcion){
											echo '<option class="form-control" value="'.$loc->id.'" selected>'.$loc->descripcion.'</option>';
										}else{
											echo '<option class="form-control" value="'.$loc->id.'">'.$loc->descripcion.'</option>';
										}
									}
									echo '</select>';
									echo '</td>';
								}else{
									echo '<td>'.$localizacion->descripcion.'</td>';
								}
								echo '<td>'.$nombre.'</td>';
								// echo '<td></td>';
								echo '</tr>';
						}
					 ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-12">
					<button id="btn-search-outtech" class="btn btn-info" name="btn_register" disabled>Agregar</button>
				</div>
			</div>
			</form>

		</div>
	</div>
</div>

<script>
	$('.tools_check').click(function(){
		let obj = $(this);
		let submit = 0;
		if (obj.is(':checked')){
			obj.parent().parent().find("select").prop('disabled',false);
		}else{
			obj.parent().parent().find("select").prop('disabled',true);
		}
		$(".tools_check").each(function(index,value){
			if(value.checked == true){
				submit = submit + 1;
			console.log(value.checked);
			}
		});
		if(submit >= 1){
			$("#btn-search-outtech").prop('disabled',false);
		}else{
			$("#btn-search-outtech").prop('disabled',true);
		}
	});
</script>

