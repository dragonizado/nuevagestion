<?php 
/**
 * Dragonizado
 */
class configModel extends Model
{
	
	function __construct($db)
	{
		
		try {
			$this->_db = $db;
		} catch (PDOException $e) {
			exit("No se pudo conectar a la base de datos.");
		}
	}

	public function getconfig($configname){
		$sql = "SELECT * FROM config WHERE name = :cname";
		$query = $this->_db->prepare($sql);
		$parametros = array(':cname'=>$configname);
		$query->execute($parametros);
		return $query->fetch();
	}

	public function validateDBexits($name){
		$model = Configuracion::model()->find(array("condition"=>" nombre = '".$name."'"));
		if ($model) {
			return $model;
		}else{
			return false;
		}
	}

	public function registerConfig($_class,$_paramm){
		$model = new Configuracion;
		$model->nombre = $_class;
		$model->parametro = $_paramm;
		$model->fecha_creacion = date('Y:m:d H:i:s');
		if($model->save()){
			return true;
		}else{
			return false;
		}
	}

	public function getconfigwithdefault($configname,$defaultvalue = "Sin registrar"){
		if($this->validateDBexits($configname)){
		 return $this->getconfig($configname);
		}else{
			$this->registerConfig($configname,$defaultvalue);
			return $defaultvalue;
		}
	}
}
 ?>