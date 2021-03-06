<?php 
	/**
	* Dragonizado 2018
	*/
	class Controller 
	{
		public $db = null;
		public $pageName = "";
		

		function __construct()
		{
			$this->abrirconexionbasedatos();
			
		}

		private function abrirconexionbasedatos(){
			$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
			try {
				$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);	
			} catch (Exception $e) {
				exit("No se puede conectar a la base de datos.");
			}
			
		}

		public function cargarModelo($n_m){
			$this->abrirconexionbasedatos();
			$nombre_modelo = $n_m."Model";
			require APP.'models/'.$nombre_modelo.'.php';
			return new $nombre_modelo($this->db);
		}

		public function cargarComponente($n_c){
			$nombre_componente = $n_c."Component";
			require APP."components/".$nombre_componente.".php";
			return new $nombre_componente();
		}

		public function view($view){
			$folderf = '';
			$default_folder = _DEFAULTFOLDER_TEMPLATE_;
			$argumentos = func_get_args();
			if (isset($argumentos[1])) {
			if(is_array($argumentos[1])){
			    if (count($argumentos[1]) != 0) {
			        foreach ($argumentos[1] as $key => $value) {
			            ${$key} = $value;
			        }
			    }
			    if(isset($argumentos[2])){
			        if (!is_null($argumentos[2]) || !$argumentos[2] == "") {
			            $folderf = $argumentos[2];
			        }else{
			            $folderf = $default_folder;   
			        }
			    }else{
			        $folderf = $default_folder;
			    }
			}else{
			    if(isset($argumentos[2])){
			        if (count($argumentos[2]) != 0) {
			            foreach ($argumentos[2] as $key => $value) {
			                ${$key} = $value;
			            }
			        }
			    }
			    if($argumentos[1] == "" || $argumentos[1] == null){
			        $folderf = $default_folder;
			    }else{
			        $folderf = $argumentos[1];
			    }
			}
			}else{
				$folderf = $default_folder;
			}

			if(is_array($view)){
			    require APP . 'views/_templates/'.$folderf.'/header.php';
			    foreach ($view as $key => $value) {
			       require APP . 'views/'.$value.'.php';
			    }
			    require APP . 'views/_templates/'.$folderf.'/footer.php';
			}else{
			    require APP . 'views/_templates/'.$folderf.'/header.php';
			    require APP . 'views/'.$view.'.php';
			    require APP . 'views/_templates/'.$folderf.'/footer.php';
			}
	    }

	    public function validateLogin(){
	    	// session_start();
			if(isset($_SESSION['username'])){
				return header("location: ".URL."public/index.php?url=default/index");		
			}
	    }

	    public function validateSesion(){
	    	// session_start();
			if(!isset($_SESSION['username'])){
				return header("location: ".URL."public/index.php?url=default/login");		
			}
	    }

	    public function validateAjaxPOST(){
	    	if (!isset($_POST['ajax']) && $_POST['ajax'] != APIKEY) {
	    		return exit("Solicitud incorrecta");
	    	}
	    }

	    public function validateAjaxGET(){
	    	if (!isset($_GET['ajax']) && $_GET['ajax'] != APIKEY) {
	    		return exit("Solicitud incorrecta");
	    	}
	    }
	}

 ?>