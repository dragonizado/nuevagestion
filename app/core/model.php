<?php 
/**
 * Dragonizado 2018
 */
class Model
{
	function __construct(){
		
	}
		
	protected function searchSQL($parameters=null,$className){
		$explode = explode('Model',$className);
		$table = $explode[0]; 
		$sql = "SELECT * FROM ".$table." ";
		if(is_array($parameters)){
			if(isset($parameters['condition'])){
				if($parameters['condition'] != ''){
					$sql .= "WHERE ".$parameters['condition'];
				}else{
					$sql .= "WHERE 1";
				}
			}else{
				throw new Exception("No existen las condiciones de busqueda");
			}
			if(isset($parameters['debug'])){
				return $sql;
				exit;
			}
		}else if($parameters != null){
			$sql .= $parameters;
		}else{
			$sql .= "WHERE 1";
		}
		$query = $this->_db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
}
 ?>