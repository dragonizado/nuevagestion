<?php 
/**
** Dragonizado 2018
**/
use Dompdf\Dompdf;
class reportsController extends Controller{
	private $model;
	private $model_tools;
	private $model_logs;
	protected $model_users;
	protected $model_locations;
	function __construct(){
		session_start();
		$this->validateSesion();
		$this->model = $this->cargarModelo('reports');
		$this->model_tools = $this->cargarModelo('tools');
		$this->model_users = $this->cargarModelo('users');
		$this->model_locations = $this->cargarModelo('locations');
		$this->model_logs = $this->cargarmodelo("logs");

		if(isset($_SESSION['username'])){
				$this->nombrecompleto = $_SESSION['firstname']." ".$_SESSION['lastname'];
			}else{
				$this->nombrecompleto = 'Invitado';
			}
	}
 	
	public function generate(){
		$this->pageName="Generar Reportes";
		$this->view('reports/generate',array(
			"tecnicos"=>$this->model_users,
			"ubicacions"=>$this->model_locations,
			"tbody"=>$this->model_tools->getAllTools(),
		));
	}

	public function generatePDF(){
		if(isset($_POST['btn-generate'])){
			// $technical = $_POST['technical'];
			// $location = $_POST['location'];
			// $asigned = $_POST['asigned'];
			// $date_in = $_POST['date_in'];
			// $date_out = $_POST['date_out'];
			include APP."views/reports/_pdf.php";
			$pdf = new pdf($this->model_tools,$this->model_users,$this->model_locations);
			$html = $pdf->generate(); 

			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->render();
			// $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
			$dompdf->stream('Reporte-'.date('YmdHis').'.pdf');
			
		}
	}

	public function notification(){
		$this->pageName="Notificaciones";


		$this->view('reports/notifications',array(
			"tbody"=>$this->model_tools->getAllTools(),
			"model_user"=>$this->model_users,
			"model_logs"=>$this->model_logs
		));
	}

}
 ?>
