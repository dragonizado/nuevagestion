<?php 
/**
 * Dragonizado 2018
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class DEmailComponent
{
	private $email_Body;
	private $email_title;
	private $email_AltBody;
	private $email_to = array();
	private $email_tocopy = array();
	private $email_tocopyB = array();
	private $email_from;
	private $email_is_html;

	private $email_host;
	private $email_SMTPDebug;
	private $email_SMTPAuth;
	private $email_Username;
	private $email_Password;
	private $email_SMTPSecure;
	private $email_Port;

	function __construct()
	{
		$this->email_from = array('donotreply@braincoding.com.co'=> APP_NAME.' - NOTIFICACION');
		$this->email_host = 'smtp.gmail.com;smtp2.example.com';
		$this->email_SMTPDebug = 0;
		$this->email_SMTPAuth = true;
		$this->email_Username = 'espm.ftra.yii@gmail.com';
		$this->email_Password = 'Espumas2016';
		$this->email_SMTPSecure = 'tls';
		$this->email_Port = 587;
		$this->email_is_html = true;

		$this->email_title = 'Here is the subject';
		$this->email_Body = 'This is the HTML message body <b>in bold!</b>';
		$this->email_AltBody = 'This is the body in plain text for non-HTML mail clients';
	}

	public function __SET($attr,$val){
		$this->$attr = $val;
	}

	public function __GET($attr){
		return $this->$attr;
	}

	public function loadUsers($model){
		$users = $model->model(array("condition"=>'send_email = 1'));
		if ($users) {
			foreach ($users as $key => $user) {
				array_push($this->email_to, $user->correo);
			}
		}
		return $this;
	}

	public function SendEmail(){
		require APP.'vendor/PHPMailer/src/Exception.php';
		require APP.'vendor/PHPMailer/src/PHPMailer.php';
		require APP.'vendor/PHPMailer/src/SMTP.php';

		$mail = new PHPMailer(true);  

		try {
		//Server settings
		$mail->SMTPDebug = $this->email_SMTPDebug;
		$mail->isSMTP();
		$mail->Host = $this->email_host;
		$mail->SMTPAuth = $this->email_SMTPAuth;
		$mail->Username = $this->email_Username;
		$mail->Password = $this->email_Password;
		$mail->SMTPSecure = $this->email_SMTPSecure;
		$mail->Port = $this->email_Port;

		//Recipients
		foreach ($this->email_from as $key => $name) {
			$mail->setFrom($key,$name);
		}

		foreach ($this->email_to as $email) {
			if(!is_null($email)){
				$mail->addAddress($email);
			}
		}

		foreach ($this->email_tocopy as $copy) {
			if (!is_null($copy)) {
				$mail->addCC($copy);
			}
		}

		foreach ($this->email_tocopyB as $copyB) {
			if(!is_null($copyB)){
				$mail->addBCC($copyB);
			}
		}

	    $mail->isHTML($this->email_is_html);
		$mail->Subject = $this->email_title;
		$mail->Body = $this->email_Body;
	    $mail->AltBody = $this->email_AltBody;
		
		$mail->send();
		return true;
		} catch (Exception $e) {
		return exit("El correo se ha enviado correctamente.".$mail->ErrorInfo);
		}
	}

}
 ?>