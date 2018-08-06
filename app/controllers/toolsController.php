<?php 
/**
 * Dragonizado
 */
class toolsController extends Controller
{
	private $model;
	protected $model_users;
	protected $model_locations;
	private $model_stateTools;
	private $model_typeTools;
	protected $nombrecompletos = null;
	function __construct()
	{
		$this->model = $this->cargarmodelo("tools");
		$this->model_users = $this->cargarmodelo("users");
		$this->model_locations = $this->cargarmodelo("locations");
		$this->model_stateTools = $this->cargarmodelo("statetools");
		$this->model_typeTools = $this->cargarmodelo("typetools");
		session_start();
		if(isset($_SESSION['username'])){
			$this->nombrecompleto = $_SESSION['firstname']." ".$_SESSION['lastname'];
		}else{
			$this->nombrecompleto = 'Invitado';
		}
	}

	public function create(){
		$this->pageName = "Registrar Herramientas";
		$id = '';
		// create
		if(isset($_POST['btn-register'])){

			$this->model->__SET('stage','create');
			$this->model->__SET('nombre',$_POST['name']);
			$this->model->__SET('tipo',$_POST['type']);
			$this->model->__SET('fabricante',$_POST['maker']);
			$this->model->__SET('modelo',$_POST['model']);
			$this->model->__SET('n_serie',$_POST['n_serie']);
			$this->model->__SET('n_inventario',$_POST['n_inven']);
			$this->model->__SET('tecnico',$_POST['technical']);
			$this->model->__SET('estado_herr',$_POST['es_her']);
			if($_POST['Current_location'] == "1"){
				$this->model->__SET('estado_posi',"Adentro");
			}else{
				$this->model->__SET('estado_posi',"Afuera");
			}
			$this->model->__SET('ubicacion_actual',$_POST['Current_location']);
			$this->model->__SET('fecha_compra',date('Y-m-d',strtotime($_POST['f_C'])));
			$this->model->__SET('fecha_mto',date('Y-m-d',strtotime($_POST['f_M'])));
			$this->model->__SET('descripcion',$_POST['observations']);
			$this->model->__SET('creacion_registro',date('Y-m-d'));
			
			$this->model->save();

			
		}

		$this->view("tools/create",array(
			"id"=>$id,
			"tecnicos"=> $this->model_users->getAllTecnicalUsers(),
			"locations"=>$this->model_locations->getAlllocations(),
			"states"=>$this->model_stateTools->getAllstateTools(),
			"types"=>$this->model_typeTools->getAllTypeTools(),
			"model"=>$this->model,
			"tbody"=>$this->model->getAllTools(),
		));
	}

	public function edit(){
		$this->pageName = "Editar Herramientas";
		$id = '';
		// editar
		if (isset($_GET['id']) && $_GET['id'] != null) {
			$model = $this->model->searchById($_GET['id']);
			if($model){
				if(isset($_POST['btn-save'])){
					$this->model->__SET('stage','update');
					$this->model->__SET('nombre',$_POST['name']);
					$this->model->__SET('tipo',$_POST['type']);
					$this->model->__SET('fabricante',$_POST['maker']);
					$this->model->__SET('modelo',$_POST['model']);
					$this->model->__SET('n_serie',$_POST['n_serie']);
					$this->model->__SET('n_inventario',$_POST['n_inven']);
					$this->model->__SET('tecnico',$_POST['technical']);
					$this->model->__SET('estado_herr',$_POST['es_her']);
					if($_POST['Current_location'] == "Adentro"){
						$this->model->__SET('estado_posi',"Adentro");
					}else{
						$this->model->__SET('estado_posi',"Afuera");
					}
					$this->model->__SET('ubicacion_actual',$_POST['Current_location']);
					$this->model->__SET('fecha_compra',$_POST['f_C']);
					$this->model->__SET('fecha_mto',$_POST['f_M']);
					$this->model->__SET('descripcion',$_POST['observations']);
					$this->model->__SET('fecha_modificacion',date('Y-m-d'));
					if($this->model->save()){
						header("location: ".URL."public/index.php?url=tools/create");
					}else{
						echo "No se guardo la actualización";
					}
				}
				$id = $this->model->__GET('id');
			}else{
				echo "Error ese id no existe";
			}
		}

		$this->view("tools/edit",array(
			"id"=>$id,
			"tecnicos"=> $this->model_users->getAllTecnicalUsers(),
			"locations"=>$this->model_locations->getAlllocations(),
			"states"=>$this->model_stateTools->getAllstateTools(),
			"types"=>$this->model_typeTools->getAllTypeTools(),
			"model"=>$this->model,
			"tbody"=>$this->model->getAllTools(),
		));
	}

	public function ajax(){
		if (isset($_GET["id"]) && $_GET["id"] != '') {
			$model = $this->model->searchById($_GET["id"]);
			$response = array();
			$response = $model;
			echo json_encode($response);
		}else{
			echo "Solicitud Errada";
		}

	}
}
 ?>