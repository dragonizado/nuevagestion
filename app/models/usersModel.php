<?php 
/**
* Dragonizado 2018
*/
class usersModel extends Model
{
	private $id = null;
	private $usuario  = null;
	private $contra  = null;
	private $nombre  = null;
	private $apellido  = null;
	private $correo  = null;
	private $send_email = false;
	private $documento  = null;
	private $estado  = null;
	private $rol_id  = null;
	private $queryB  = null;
	private $attr  = null;

	function __construct($db)
	{
		$this->estado = "Activo";
		$this->rol_id = 1;
		try {
			$this->_db = $db;
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}

	public function __SET($attr,$data){
		$this->$attr = $data;
	}

	public function __GET($attr){
		return $this->$attr;
	}

	public function create(){
		$sql = "INSERT INTO users (usuario,contra,nombre,apellido,correo,send_email,documento,estado,rol_id) VALUES (:usuario,:contra,:nombre,:apellido,:correo,:send_email,:documento,:estado,:rol_id)";
		$query = $this->_db->prepare($sql);
		$params = array(
			':usuario'=>$this->usuario,
			':contra'=>$this->contra,
			':nombre'=>$this->nombre,
			':apellido'=>$this->apellido,
			':correo'=>$this->correo,
			':send_email'=>$this->send_email,
			':documento'=>$this->documento,
			':estado'=>$this->estado,
			':rol_id'=>$this->rol_id,
			);
		$query->execute($params);
	}

	public function validate(){
		if (!is_null($this->usuario)) {
			$this->queryB = "usuario";
			$this->attr = $this->usuario;
		}else if(!is_null($this->correo)){
			$this->queryB = "correo";
			$this->attr = $this->correo;
		}else if(!is_null($this->documento)){
			$this->queryB = "id";
			$this->attr = $this->documento;
		}

		$user = $this->searchUser();
		if ($user) {
			if(md5($this->contra) == $user->contra){
				return $user;
			}else{
				return false;
			}
		}else{
			return false;
		}

	}

	public function login(){
		$sql="SELECT * FROM users WHERE ";
		$query = $this->_db->prepare($sql);
		$params = array();
		$query->execute($params);
	}

	public function searchById($id){
		$sql = "SELECT * FROM users WHERE id=:id";
		$query = $this->_db->prepare($sql);
		$parametros = array(
			":id"=>$id
		);
		$query->execute($parametros);
		$response = $query->fetch();

		$this->__SET('id',$response->id);
		$this->__SET('usuario',$response->usuario);
		$this->__SET('contra',$response->contra);
		$this->__SET('nombre',$response->nombre);
		$this->__SET('apellido',$response->apellido);
		$this->__SET('correo',$response->correo);
		$this->__SET('send_email',$response->send_email);
		$this->__SET('documento',$response->documento);
		$this->__SET('estado',$response->estado);
		$this->__SET('rol_id',$response->rol_id);
	
		return $response;
	}

	public function getAllUsers(){
		$sql="SELECT * FROM users WHERE id!= 1 AND documento != 123456789";
		$query = $this->_db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getAllTecnicalUsers(){
		$sql="SELECT * FROM users WHERE rol_id = 3";
		$query = $this->_db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getUser(){
		$sql = "SELECT * FROM users WHERE id = :id";
		$query = $this->_db->prepare($sql);
		$parametros = array(":id"=>$this->id);
		$query->execute($parametros);
		return $query->fetch();
	}

	public function save(){
		$sql = "UPDATE users SET usuario = :user, contra = :pass, nombre = :name, apellido = :lastname, correo = :email, send_email = :send_email, documento = :document, estado = :state, rol_id = :rol WHERE id = :id";
		$query = $this->_db->prepare($sql);
		$parametros = array(
			":id"=>$this->id, 
			":user"=>$this->usuario, 
			":pass"=>$this->contra, 
			":name"=>$this->nombre, 
			":lastname"=>$this->apellido, 
			":email"=>$this->correo, 
			":send_email"=>$this->send_email, 
			":document"=>$this->documento, 
			":state"=>$this->estado, 
			":rol"=>$this->rol_id, 
		);
		return $query->execute($parametros);
	}

	private function searchUser(){
		$sql="SELECT * FROM users WHERE ".$this->queryB." = :attr";
		$query = $this->_db->prepare($sql);
		$params = array(":attr"=>$this->attr);
		$query->execute($params);
		return $query->fetch();
	}

	public function sing_in(){
		$sql = "INSERT INTO users (usuario,contra,nombre,apellido,correo,id) VALUES(:usuario,:contra,:nombre,:apellido,:correo,:documento)";
		$query = $this->db->prepare($sql);
		$params = array(
			':usuario'=>$value,
			':contra'=>$value,
			':nombre'=>$value,
			':apellido'=>$value,
			':correo'=>$value,
			':send_email'=>$value,
			':documento'=>$value,
		);
		return $query->execute($params);
	}

	public function model($parameters=null,$className = __CLASS__){
		return parent::searchSQL($parameters,$className);
	}
}

 ?>