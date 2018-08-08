<?php 
/**
 * Dragonizado 2018
 */
class locationsModel extends Model
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

	public function getAlllocations(){
		$sql="SELECT * FROM locations";
		$query = $this->_db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getLocation(){
		$sql = "SELECT * FROM locations WHERE id = :id";
		$query = $this->_db->prepare($sql);
		$parametros = array(":id"=>$this->id);
		$query->execute($parametros);
		return $query->fetch();
	}

	public function create(){
		$sql = "INSERT INTO locations (descripcion) VALUES (:description)";
		$query = $this->_db->prepare($sql);
		$parameters = array(
			":description"=>$this->descripcion,
		);
		$response = $query->execute($parameters);
		$this->__SET("id",$this->_db->lastInsertId());
		return $response;
	}

	public function model($parameters = null,$className = __CLASS__){
		return parent::searchSQL($parameters,$className);
	}
}
?>