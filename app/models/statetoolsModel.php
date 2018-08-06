<?php 
/**
 * Dragonizado 2018
 */
class statetoolsModel
{
	private $id;
	private $descripcion;

	function __construct($db)
	{
		try {
			$this->_db = $db;
		} catch (PDOException $e) {
			exit("Imposible conectar con la base de datos");
		}
	}

	public function __SET($attr,$val){
		$this->$attr = $val;
	}

	public function __GET($attr){
		return $this->$attr;
	}

	public function getAllstateTools(){
		$sql="SELECT * FROM statetools";
		$query = $this->_db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
}
?>