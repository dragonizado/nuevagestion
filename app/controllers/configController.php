<?php 
/**
 * Dragonizado 2018
 */
class configController extends Controller
{
	private $model = null;
	protected $nombrecompleto = null;
	function __construct()
	{
		session_start();
		$this->validateSesion();
		$this->model = $this->cargarModelo("config");
		if(isset($_SESSION['username'])){
			$this->nombrecompleto = $_SESSION['firstname']." ".$_SESSION['lastname'];
		}else{
			$this->nombrecompleto = 'Invitado';
		}
	}

	public function index(){
		$this->pageName="Configuracion";
		$this->view('config/index',array());
	}
}
 ?>