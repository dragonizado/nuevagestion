<?php 
/**
 * Dragonizado 2018
 */
class statetoolsModel extends Model
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

	public function create(){
		$sql="INSERT INTO statetools (descripcion) VALUES (:descripcion)";
		$query = $this->_db->prepare($sql);
		$parameters = array(
			":descripcion"=>$this->descripcion,
		);
		return $query->execute($parameters);
	}

	public function model($parameters = null,$className = __CLASS__){
		return parent::searchSQL($parameters,$className);
	}
}
?>