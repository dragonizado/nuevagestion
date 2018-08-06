<?php 
/**
 * Dragonizado
 */
class logsModel
{
	
	function __construct($db)
	{
		try {
			$this->_db = $db;
		} catch (PDOException $e) {
			exit("No se ha establecido una conexion con la base de datos.");
		}
	}

	public function register($id,$des){
		$sql = "INSERT INTO logs (descripcion,user_id) VALUES (:des,:id)";
		$query = $this->_db->prepare($sql);
		$parameters = array(
			":des"=>$des,
			":id"=>$id
		);
		return $query->execute($parameters);
	}
}
 ?>