<?php 
class defaultController extends controller{

	private $model = null;
	private $model_user = null;
	private $model_tools = null;
	private $model_logs = null;
	protected $loginErrors = null;
	protected $formErrors = null;
	protected $nombrecompleto = null;


	function __construct(){
		$this->model = $this->cargarModelo("default");
		$this->model_user = $this->cargarModelo("users");
		$this->model_tools = $this->cargarModelo("tools");
		$this->model_logs = $this->cargarModelo("logs");
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
			"rol"=>$user_rol,
			"total_tools"=>count($this->model_tools->model()),
			"total_technical"=>count($this->model_user->model(array("condition"=>"rol_id = '3'"))),
			"total_tools_inside"=>count($this->model_tools->model(array("condition"=>" estado_posi = 'Adentro' "))),
			"total_tools_outside"=>count($this->model_tools->model(array("condition"=>" estado_posi = 'Afuera' "))),
			"model_user"=>$this->model_user,
			"model_logs"=>$this->model_logs,
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
			$this->model_user->__SET("usuario",$_POST['nickname']);
			$this->model_user->__SET("documento",$_POST['document']);
			$this->model_user->__SET("correo",$_POST['email']);
			if (isset($_POST['send_email'])) {
				$this->model_user->__SET("send_email",true);
			}else{
				$this->model_user->__SET("send_email",false);
			}
			$this->model_user->__SET("nombre",$_POST['firtsname']);
			$this->model_user->__SET("apellido",$_POST['secondname']);
			$this->model_user->__SET("rol_id",$_POST['rol']);
			$this->model_user->__SET("estado",$_POST['state']);
			$this->model_user->__SET("contra",md5($_POST['password']));
			if($this->model_user->create()){
				//poner aqui el envio de correo
				echo $_POST['document']."  Creado correctamente";
				header("location: ".URL."public/index.php?url=default/signin");
			}

		}

		$id = '';
		$nombre = '';
		$apellido = '';
		$correo = '';
		$send_email = '';
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
				if (isset($_POST['send_email'])) {
					$this->model_user->__SET("send_email",true);
				}else{
					$this->model_user->__SET("send_email",false);
				}
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
					header("location: ".URL."public/index.php?url=default/signin");
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
					$send_email = $user_m->send_email;
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
				$table .= '<td style="width:200px;  word-break: break-all;">'.$user->correo.'</td>';
				if ($user->rol_id == "1") {
					$table .= '<td>Super Admin</td>';
				}else if($user->rol_id == "2"){
					$table .= '<td>Administrador</td>';
				}else if($user->rol_id == "3"){
					$table .= '<td>Tecnico</td>';
				}
				$table .= '<td>'.$user->estado.'</td>';
				if($user->send_email == 0){
					$table .= '<td class="c-red-500">No Autorizado</td>';
				}else if($user->send_email == 1){
					$table .= '<td class="c-green-500">Autorizado</td>';
				}
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
			"send_email" => $send_email,
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
