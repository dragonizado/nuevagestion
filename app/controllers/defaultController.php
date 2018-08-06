<?php 
class defaultController extends controller{

	private $model = null;
	private $model_user = null;
	protected $loginErrors = null;
	protected $formErrors = null;
	protected $nombrecompleto = null;

	function __construct(){
		$this->model = $this->cargarModelo("default");
		$this->model_user = $this->cargarModelo("users");
		session_start();
			if(isset($_SESSION['username'])){
				$this->nombrecompleto = $_SESSION['firstname']." ".$_SESSION['lastname'];
			}else{
				$this->nombrecompleto = 'Invitado';
			}
	}

	public function index(){
		// session_start();
		$this->validateSesion();
		$this->pageName="Pagina Principal";
		$usuario_id = $_SESSION['id'];
		$user_rol = $_SESSION['rol'];

		if($user_rol == "3"){
			header("location: ".URL."public/index.php?url=tools/register");
		}
		
		$this->view('default/index',array(
			"rol"=>$user_rol
		));
	

	}


	public function login(){
		$this->pageName = "Herramientas Admin";
		$this->validateLogin();

		if(isset($_POST["username"])){
			// $username = strtolower($_POST["username"]);
			$username = $_POST["username"];
		    $exp = "/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/";
		    $exp_dos = "/^\d+$/";

		    if(preg_match($exp,$username)) {
				$this->model_user->__SET("correo",$username);
		    }else if(preg_match($exp_dos,$username)){
				$this->model_user->__SET("documento",$username);
		    }else{
				$this->model_user->__SET("usuario",$username);
		    }
			$this->model_user->__SET("contra",$_POST["password"]);
			
			if($usersession = $this->model_user->validate()){
				$_SESSION['id'] = $usersession->id;
				$_SESSION['username'] = $usersession->usuario;
				$_SESSION['firstname'] = $usersession->nombre;
				$_SESSION['lastname'] = $usersession->apellido;
				$_SESSION['login_name'] = $usersession->nombre ." ".$usersession->apellido;
				$_SESSION['rol'] = $usersession->rol_id;
				header("location: ".URL."public/index.php?url=default/index");
			}else{
				$this->loginErrors = "Datos de inicio incorrectos.";
				session_destroy();
			}
		}
		$this->view("users/login",'login');
	}

	public function signin(){
		if(isset($_POST['document']) && isset($_POST['btn-register']) ){
			echo "Registrar";
			exit;
			$this->model_user->__SET("usuario",$_POST['nickname']);
			$this->model_user->__SET("documento",$_POST['document']);
			$this->model_user->__SET("correo",$_POST['email']);
			$this->model_user->__SET("nombre",$_POST['firtsname']);
			$this->model_user->__SET("apellido",$_POST['secondname']);
			$this->model_user->__SET("rol_id",$_POST['rol']);
			$this->model_user->__SET("estado",$_POST['state']);
			$this->model_user->__SET("contra",md5($_POST['password']));
			if($this->model_user->create()){
				echo $_POST['document']."  Creado correctamente";
			}

		}

		$id = '';
		$nombre = '';
		$apellido = '';
		$correo = '';
		$documento = '';
		$estado = '';
		$rol = '';

		//edit
		if(isset($_GET['id']) && $_GET['id'] != null){
			// $this->model_user->__SET('id',$_GET['id']);
			 $this->model_user->searchById($_GET['id']);
			if(isset($_POST['btn-save'])){
				// Cargar el modelo para guardar la edicion
				$this->model_user->__SET("usuario",$_POST['nickname']);
				$this->model_user->__SET("documento",$_POST['document']);
				$this->model_user->__SET("correo",$_POST['email']);
				$this->model_user->__SET("nombre",$_POST['firtsname']);
				$this->model_user->__SET("apellido",$_POST['secondname']);
				$this->model_user->__SET("rol_id",$_POST['rol']);
				$this->model_user->__SET("estado",$_POST['state']);

				if($_POST['password']!=''){
					$this->model_user->__SET("contra",md5($_POST['password']));
				}

				$user_m = $this->model_user->save();
				if($user_m){
					$this->formErrors = "Si se Actualizó";
				}

			}else{
				// Cargar el modelo para el formulario de edicion
				$user_m = $this->model_user->getUser();
				// var_dump($user_m);
				// exit;
				if($user_m){
					$id = $user_m->id;
					$nombre = $user_m->nombre;
					$apellido = $user_m->apellido;
					$correo = $user_m->correo;
					$documento = $user_m->documento;
					$estado = $user_m->estado;
					$rol = $user_m->rol_id;
				}else{
					$this->formErrors = "Error no se encuentra el sistema";
				}	
			}
	
		}

		$model = $this->model_user->getAllUsers();
		$table = null;
		if ($model) {
			foreach ($model as $key => $user) {
				$table .= '<tr>';
				$table .= '<td>'.$user->nombre.' '.$user->apellido.'</td>';
				$table .= '<td>'.$user->documento.'</td>';
				$table .= '<td>'.$user->correo.'</td>';
				if ($user->rol_id == "1") {
					$table .= '<td>Super Admin</td>';
				}else if($user->rol_id == "2"){
					$table .= '<td>Administrador</td>';
				}else if($user->rol_id == "3"){
					$table .= '<td>Tecnico</td>';
				}
				$table .= '<td>'.$user->estado.'</td>';
				$table .= '<td><a href="'.URL.'public/index.php?url=default/signin&id='.$user->id.'"><button class="btn btn-info">Editar</button></a></td>';
				$table .= '</tr>';
			}
		}
		$this->view("users/sign_in",array(
			"tableBody"=>$table,
			"id" => $id,
			"nombre" => $nombre,
			"apellido" => $apellido,
			"correo" => $correo,
			"documento" => $documento,
			"estado" => $estado,
			"rol" => $rol,

		));
	}

	public function logout(){
		session_start();
		$_SESSION = array(); 
		if (isset($_COOKIE[session_name()])) {
		   setcookie(session_name(), '', time()-42000, '/');
		} 
		session_destroy();
		header("location: ".URL."public/index.php?url=default/index");
	}

}
 ?>
