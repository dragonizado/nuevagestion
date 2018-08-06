<?php 
/**
 * Dragonizado 2018
 */
class typetoolsModel
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

	public function getAllTypeTools(){
		$sql="SELECT * FROM typetools";
		$query = $this->_db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
}
?>