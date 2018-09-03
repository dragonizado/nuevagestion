<?php 
/**
 * Dragonizado
 */
class toolsMovementsModel extends Model
{
	private $id;
	private $tool_id;
	private $description;
	private $date_mto;
	private $date_in;
	private $date_out;

	function __construct($db)
	{
		try {
			$this->_db = $db;
		} catch (Exception $e) {
			exit("No se puede conectar a la base de datos");
		}
	}

	public function __SET($attr,$val){
		$this->$attr = $val;
	}

	public function __GET($attr){
		return $this->$attr;
	}

	public function register(){
		$sql = "INSERT INTO tools_movements (id,tool_id,description,date_mto,date_in,date_out) VALUES (:id,:tool_id,:description,:date_mto,:date_in,:date_out)";
		$query = $this->_db->prepare($sql);
		$parameters = array(
			':id'=>$this->id,
			':tool_id'=>$this->tool_id,
			':description'=>$this->description,
			':date_mto'=>$this->date_mto,
			':date_in'=>$this->date_in,
			':date_out'=>$this->date_out,
		);
		return $query->execute($parameters);
	}

	public function model($parameters = null,$className = __CLASS__){
		return parent::searchSQL($parameters,$className);
	}


}
 ?>