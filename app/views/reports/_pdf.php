<?php 
/**
 * 
 */
class pdf extends Controller
{
	private $_model_tools;
	private $_model_users;
	private $_model_locations;
	function __construct($model_tools,$model_users,$model_locations){
		$this->_model_tools = $model_tools;
		$this->_model_users = $model_users;
		$this->_model_locations = $model_locations;
	}

	public function generate(){
		$html = '';
		$html .= ' <style>
 	table{
 		width:100%;
 	}
 </style>';
		$html .= '<table class="table">
				<thead>
					<tr>
						<th>Herramienta</th>
						<th>Tecnico a cargo</th>
						<th>Precio</th>
						<th>Ubicación actual</th>
						<th>Estado</th>
						<th>Fecha de compra</th>
						<th>Fecha de mantenimiento</th>
						<th>Fecha de Salida</th>
					</tr>
				</thead>
				<tbody>';
				$tbody = $this->_model_tools->getAllTools();
				foreach ($tbody as $key => $body) {
							$this->_model_users->__SET('id',$body->tecnico);
							$this->_model_locations->__SET('id',$body->ubicacion_actual);
							$tecnico = $this->_model_users->getUser();
							$localizacion = $this->_model_locations->getLocation();
							$html .= '<tr>';
							$html .= 	'<td>'.$body->nombre.'</td>';
							if ($tecnico) {
								$html .= 	'<td style="text-transform:uppercase;">'.$tecnico->nombre." ".$tecnico->apellido.'</td>';
							}else{
								$html .= 	'<td style="text-transform:uppercase;">Sin técnico</td>';
							}
							$html .= 	'<td>'.$body->price.'</td>';
							$html .= 	'<td style="text-transform:uppercase;">'.$localizacion->descripcion.'</td>';
							$html .= 	'<td>'.$body->estado_herr.'</td>';
							$html .= 	'<td>'.$body->fecha_compra.'</td>';
							$html .= 	'<td>'.$body->fecha_mto.'</td>';
							$html .= 	'<td>'.$body->fecha_salida.'</td>';
							$html .= '</tr>';
						}
			$html .='	</tbody>
			</table>';	

			return $html;
	}	
}

 ?>
