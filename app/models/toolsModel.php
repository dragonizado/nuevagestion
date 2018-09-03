<?php 
/**
 * Dragonizado
 */
class toolsModel extends Model
{

	private $stage;
	private $sql = null;
	private $id = null;
	private $nombre;
	private $tipo = null;
	private $price = null;
	private $fabricante = null;
	private $modelo = null;
	private $n_serie = null;
	private $n_inventario = null;
	private $tecnico = null;
	private $estado_herr;
	private $estado_posi;
	private $ubicacion_actual;
	private $fecha_compra;
	private $fecha_mto = null;
	private $fecha_salida = null;
	private $descripcion = null;
	private $creacion_registro;
	private $fecha_modificacion = null;

	function __construct($db)
	{
		try {
			$this->_db = $db;
		} catch (PDOException $e) {
			exit("IMposible contactar la base de datos");
		}
	}

	public function __SET($attr,$val){
		$this->$attr = $val;
	}

	public function __GET($attr){
		return $this->$attr;
	}

	public function searchById($id){
		$sql = "SELECT * FROM tools WHERE id=:id";
		$query = $this->_db->prepare($sql);
		$parametro = array(
			":id"=>$id,
		);
		$query->execute($parametro);
		$response = $query->fetch();

		$this->__SET('id',$response->id);
		$this->__SET('nombre',$response->nombre);
		$this->__SET('tipo',$response->tipo);
		$this->__SET('price',$response->price);
		$this->__SET('fabricante',$response->fabricante);
		$this->__SET('modelo',$response->modelo);
		$this->__SET('n_serie',$response->n_serie);
		$this->__SET('n_inventario',$response->n_inventario);
		$this->__SET('tecnico',$response->tecnico);
		$this->__SET('estado_herr',$response->estado_herr);
		$this->__SET('estado_posi',$response->estado_posi);
		$this->__SET('ubicacion_actual',$response->ubicacion_actual);
		$this->__SET('fecha_compra',$response->fecha_compra);
		$this->__SET('fecha_mto',$response->fecha_mto);
		$this->__SET('fecha_salida',$response->fecha_salida);
		$this->__SET('descripcion',$response->descripcion);
		$this->__SET('creacion_registro',$response->creacion_registro);
		$this->__SET('fecha_modificacion',$response->fecha_modificacion);

		return $response;
	}

	public function save(){
		if($this->stage == "update"){
			$this->sql = "UPDATE tools SET nombre = :nombre, tipo = :tipo, price = :price, fabricante = :fabricante, modelo = :modelo, n_serie = :n_serie, n_inventario = :n_inventario, tecnico = :tecnico, estado_herr = :estado_herr, estado_posi = :estado_posi, ubicacion_actual = :ubicacion_actual, fecha_compra = :fecha_compra, fecha_mto = :fecha_mto, fecha_salida = :fecha_salida, descripcion = :descripcion, creacion_registro = :creacion_registro, fecha_modificacion = :fecha_modificacion WHERE id=:id";
		}else if($this->stage == "create"){
			$this->sql = "INSERT INTO tools (id,nombre,tipo,price,fabricante,modelo,n_serie,n_inventario,tecnico,estado_herr,estado_posi,ubicacion_actual,fecha_compra,fecha_mto,fecha_salida,descripcion,creacion_registro,fecha_modificacion) VALUES (:id,:nombre,:tipo,:price,:fabricante,:modelo,:n_serie,:n_inventario,:tecnico,:estado_herr,:estado_posi,:ubicacion_actual, :fecha_compra,:fecha_mto,:fecha_salida,:descripcion,:creacion_registro,:fecha_modificacion)";
		}else{
			return "no esta entrando al if";
		}
		$sql = $this->sql;
		$query = $this->_db->prepare($sql);
		$parameters = array(
			':id'=>$this->id,
			':nombre'=>$this->nombre,
			':tipo'=>$this->tipo,
			':price'=>$this->price,
			':fabricante'=>$this->fabricante,
			':modelo'=>$this->modelo,
			':n_serie'=>$this->n_serie,
			':n_inventario'=>$this->n_inventario,
			':tecnico'=>$this->tecnico,
			':estado_herr'=>$this->estado_herr,
			':estado_posi'=>$this->estado_posi,
			':ubicacion_actual'=>$this->ubicacion_actual,
			':fecha_compra'=>$this->fecha_compra,
			':fecha_mto'=>$this->fecha_mto,
			':fecha_salida'=>$this->fecha_salida,
			':descripcion'=>$this->descripcion,
			':creacion_registro'=>$this->creacion_registro,
			':fecha_modificacion'=>$this->fecha_modificacion,
		);
		$result = $query->execute($parameters);
		$this->clearattr();
		return $result;
	}

	public function getAllTools(){
		$sql = "SELECT * FROM tools";
		$query = $this->_db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getAllTools_out_user($id){
		$sql = "SELECT * FROM tools WHERE tecnico != :id  OR tecnico != 0";
		$query = $this->_db->prepare($sql);
		$parameters = array(
			":id"=>$id
		);
		$query->execute($parameters);
		return $query->fetchAll();
	}

	public function getAllTools_user($id){
		$sql = "SELECT * FROM tools WHERE tecnico = :id";
		$query = $this->_db->prepare($sql);
		$parameters = array(
			":id"=>$id
		);
		$query->execute($parameters);
		return $query->fetchAll();
	}

	private function clearattr(){
		$this->stage = null;
		$this->sql = null;
		$this->id = null;
		$this->nombre = null;
		$this->tipo = null;
		$this->price = null;
		$this->fabricante = null;
		$this->modelo = null;
		$this->n_serie = null;
		$this->n_inventario = null;
		$this->tecnico = null;
		$this->estado_herr = null;
		$this->estado_posi = null;
		$this->ubicacion_actual = null;
		$this->fecha_compra = null;
		$this->fecha_mto = null;
		$this->fecha_salida = null;
		$this->descripcion = null;
		$this->creacion_registro = null;
		$this->fecha_modificacion = null;
	}

	public function model($parameters=null, $className = __CLASS__){
		return parent::searchSQL($parameters,$className);
	}

}
 ?>