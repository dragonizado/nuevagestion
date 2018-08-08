<?php 
/**
 * Dragonizado
 */
class logsModel extends Model
{
	
	function __construct($db)
	{
		date_default_timezone_set('America/Bogota');
		try {
			$this->_db = $db;
		} catch (PDOException $e) {
			exit("No se ha establecido una conexion con la base de datos.");
		}
	}

	public function register($id,$tipo,$des){
		$sql = "INSERT INTO logs (descripcion,user_id,tipo,creado) VALUES (:des,:id,:tipo,:creado)";
		$query = $this->_db->prepare($sql);
		$parameters = array(
			":des"=>$des,
			":id"=>$id,
			"tipo"=>$tipo,
			":creado"=>date("Y-m-d H:i:s"),
		);
		return $query->execute($parameters);
	}

	public function model($parameters = null,$className = __CLASS__){
		return parent::searchSQL($parameters,$className);
	}
}
 ?>