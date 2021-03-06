<?php 
/**
 * Dragonizado
 */
class toolsController extends Controller
{
	private $model;
	private $model_stateTools;
	private $model_typeTools;
	private $model_logs;
	private $model_movements;
	private $email_component;
	protected $model_users;
	protected $model_locations;
	protected $nombrecompletos = null;
	function __construct()
	{
		date_default_timezone_set('America/Bogota');
		session_start();
		$this->validateSesion();
		$this->model = $this->cargarmodelo("tools");
		$this->model_users = $this->cargarmodelo("users");
		$this->model_logs = $this->cargarmodelo("logs");
		$this->model_movements = $this->cargarmodelo("toolsMovements");
		$this->model_locations = $this->cargarmodelo("locations");
		$this->model_stateTools = $this->cargarmodelo("statetools");
		$this->model_typeTools = $this->cargarmodelo("typetools");
		$this->email_component = $this->cargarComponente('DEmail');
		if(isset($_SESSION['username'])){
			$this->nombrecompleto = $_SESSION['firstname']." ".$_SESSION['lastname'];
		}else{
			$this->nombrecompleto = 'Invitado';
		}
	}

	// public function emailTest(){
	// 	$this->email_component->__SET('email_title','Registro - Control de Herramientas');
	// 	$this->email_component->__SET('email_Body','<p>Esto es una prueba.</p>');
	// 	$response = $this->email_component->loadUsers($this->model_users)->SendEmail();
	// }

	public function create(){
		$this->pageName = "Registrar Herramientas";
		$id = '';
		// create
		if(isset($_POST['btn-register'])){

			$this->model->__SET('stage','create');
			$this->model->__SET('nombre',$_POST['name']);
			$this->model->__SET('tipo',$_POST['type']);
			$this->model->__SET('price',$_POST['price']);
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
			
			if($this->model->save()){
				$this->email_component->__SET('email_title','Creacion - Control de Herramientas');
				$this->email_component->__SET('email_Body','<p>'.$this->nombrecompleto.' Ha creado una herramienta.</p>');
				$response = $this->email_component->loadUsers($this->model_users)->SendEmail();
				$this->model_logs->register($_SESSION['id'],"creacion","Ha creado una herramienta");
			}

			
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

	public function register(){
		$this->pageName="Tecnicos";
		if(isset($_POST['btn-register'])){
			$this->model->searchById($_POST['Herramienta']);
			$this->model->__SET('stage','update');
			$this->model->__SET('ubicacion_actual',$_POST['ubicacion']);
			$this->model->__SET('tecnico',$_SESSION['id']);
			if ($_POST['ubicacion'] == "1") {
				$this->model->__SET('estado_posi','Adentro');
			}else{
				$this->model->__SET('estado_posi','Afuera');
				$this->model->__SET('fecha_salida',date("Y-m-d"));
			}
			if($this->model->save()){
				$this->email_component->__SET('email_title','Asignacion - Control de Herramientas');
				$this->email_component->__SET('email_Body','<p>'.$this->nombrecompleto.' Se ha asignado una herramienta.</p>');
				$response = $this->email_component->loadUsers($this->model_users)->SendEmail();
				$this->model_logs->register($_SESSION['id'],"asignacion","Se ha asignado una herramienta");
			}
		}

		$this->view("tools/register",array(
			"herramientas"=>$this->model->getAllTools_out_user($_SESSION['id']),
			"locations"=>$this->model_locations->getAlllocations(),
			"tbody"=>$this->model->getAllTools_user($_SESSION['id']),
		));
	}

	public function unregister(){
		if (isset($_GET['id']) && $_GET['id'] != '') {
			$this->model->searchById($_GET['id']);
			$this->model->__SET('stage','update');
			$this->model->__SET('tecnico',0);
			$this->model->__SET('estado_posi','Adentro');
			if($this->model->save()){
				$this->email_component->__SET('email_title','Quitar - Control de Herramientas');
				$this->email_component->__SET('email_Body','<p>'.$this->nombrecompleto.' Ha dejado una herramienta.</p>');
				$response = $this->email_component->loadUsers($this->model_users)->SendEmail();
				$this->model_logs->register($_SESSION['id'],"desasignacion","Ha dejado una herramienta");
				header("location: ".URL."public/index.php?url=tools/register");
			}
		}
	}

	public function tools(){
		$this->pageName="Gestionar Herramientas";
		$this->view("tools/tools",array("tbodyAll"=>$this->model->getAllTools()));
	}

	public function multitools(){
		if (isset($_POST['btn_register'])) {
			$locations = $_POST['opt_locations'];
			
			foreach ($_POST['tools'] as $key => $tool) {
				$this->model->searchById($tool);
				$this->model->__SET('stage','update');
				$this->model->__SET('ubicacion_actual',$_POST['opt_locations'][$key]);
				if($_SESSION['rol'] == '3'){
					$this->model->__SET('tecnico',$_SESSION['id']);
				}else{
					$this->model->__SET('tecnico',$_POST['technical'][$key]);
				}
				if ($_POST['opt_locations'][$key] == "1") {
					$this->model->__SET('estado_posi','Adentro');
				}else{
					$this->model->__SET('estado_posi','Afuera');
					$this->model->__SET('fecha_salida',date("Y-m-d"));
				}
				if($this->model->save()){
					if($_SESSION['rol'] == '3'){
						$this->email_component->__SET('email_title','Creacion - Control de Herramientas');
						$this->email_component->__SET('email_Body','<p>'.$this->nombrecompleto.' Se ha asignado la herramienta con el identificador '.$tool.'.</p>');
						$this->model_logs->register($_SESSION['id'],"asignacion","Se ha asignado una herramienta");
					}else{
						$this->email_component->__SET('email_title','Creacion - Control de Herramientas');
						$this->email_component->__SET('email_Body','<p>'.$this->nombrecompleto.' Ha asignado una herramienta a un Técnico.</p>');
						$this->model_logs->register($_SESSION['id'],"asignacion","Ha asignado una herramienta a un Técnico");
					}
					$this->email_component->loadUsers($this->model_users)->SendEmail();
				}
			}
			exit;
			if($_SESSION['rol'] == '3'){
				header("location: ".URL."public/index.php?url=tools/register");
			}else{
				header("location: ".URL."public/index.php?url=default/index");
			}
			exit(0);
		}
		header("location: ".URL."public/index.php?url=tools/tools");
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
					$this->model->__SET('price',$_POST['price']);
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
						$this->model_logs->register($_SESSION['id'],"edicion","Ha editado una herramienta");
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

	public function ajax_Rstage(){
		$this->validateAjaxPOST();
		$this->model_stateTools->__SET("descripcion",$_POST['description']);
		$this->model_logs->register($_SESSION['id'],"creacion","Ha creado un estado.");
		echo json_encode($this->model_stateTools->create());
	}

	public function ajax_Rtype(){
		$this->validateAjaxPOST();
		$this->model_typeTools->__SET("descripcion",$_POST['description']);
		$this->model_logs->register($_SESSION['id'],"creacion","Ha registrado un tipo de herramienta");
		echo json_encode($this->model_typeTools->create());
	}

	public function ajax_Rlocation(){
		$this->validateAjaxPOST();
		$this->model_locations->__SET('descripcion',$_POST['description']);
		$response = array();
		$response['stage'] = $this->model_locations->create();
		$response['ident'] = $this->model_locations->__GET("id");
		$this->model_logs->register($_SESSION['id'],"creacion","Ha registrado una localización");
		echo json_encode($response);
	}
}
 ?>