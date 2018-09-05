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
			$technical = $this->model_users->getAllTecnicalUsers();
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
			echo "<td>";
			echo '<select name="technical[]" id="technical" disabled>';
			foreach ($technical as $key => $tech) {
				if($tech->nombre.' '.$tech->apellido == $nombre){
					echo '<option class="form-control" value="'.$tech->id.'" selected>'.$tech->nombre.' '.$tech->apellido.'</option>';
				}else{
					if($nombre == 'Sin técnico'){
						echo '<option class="form-control" value="" selected>'.$nombre.'</option>';
					}
					echo '<option class="form-control" value="'.$tech->id.'">'.$tech->nombre.' '.$tech->apellido.'</option>';
					
				}
			}
			echo '</select>';
			echo "</td>";
			// echo '<td>'.$nombre.'</td>';
			// echo '<td></td>';
			echo '</tr>';
	}
 ?>
